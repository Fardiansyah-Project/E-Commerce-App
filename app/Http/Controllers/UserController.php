<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'CUSTOMER')
            ->paginate(10);

        $title = 'Hapus!';
        $text = "Kamu Yakin menghapus ini?";
        confirmDelete($title, $text);
        return view('admin.users.index', compact('users'));
    }

    public function admin()
    {
        $admins = User::where('role', 'ADMIN')
            ->where('id', '!=', Auth::id())
            ->paginate(10);

        $title = 'Hapus!';
        $text = "Kamu Yakin menghapus ini?";
        confirmDelete($title, $text);
        return view('admin.users.admin', compact('admins'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required',
        ], [
            'name.required' => 'Nama pengguna wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'role.required' => 'Role wajib diisi',
        ]);

        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->role = $request->role;
        $data->save();

        if ($request->role == "ADMIN") {

            Alert::success('success', 'Admin berhasil ditambahkan');
            return redirect()->route('admin.users.admin')->with('success', 'Admin berhasil ditambahkan');
        }

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = User::find($id);

        return view('admin.users.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required|min:8',
            'role' => 'required',
        ], [
            'name.required' => 'Nama pengguna wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'role.required' => 'Role wajib diisi',
        ]);

        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        if ($request->password != null) {
            $data->password = Hash::make($request->password);
        }
        $data->role = $request->role;
        if ($request->role == "ADMIN") {
            Alert::success('success', 'Admin berhasil diperbarui');
            return redirect()->route('admin.users.admin')->with('success', 'Admin berhasil diperbarui');
        }
        $data->save();

        Alert::success('success', 'Pengguna berhasil diperbarui');
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = User::find($id);
        $data->delete();

        if ($data->role == "ADMIN") {
            Alert::success('success', 'Admin berhasil dihapus');
            return redirect()->route('admin.users.admin')->with('success', 'Admin berhasil dihapus');
        }
        Alert::success('success', 'Pengguna berhasil dihapus');
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus');
    }

    public function profile($id)
    {
        $user = User::findOrFail($id);
        return view('profile.profile', compact('user'));
    }

    public function editProfile($id)
    {
        $user = User::findOrFail($id);
        return view('profile.edit', compact('user'));
    }

    public function editPassword($id)
    {
        $user = User::findOrFail($id);
        return view('admin.profile.changePassword', compact('user'));
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'new_password' => 'required|min:8|confirmed',
            'current_password' => 'required',
        ], [
            'current_password.required' => 'Kata sandi saat ini wajib diisi',
            'new_password.required' => 'Password wajib diisi',
            'new_password.min' => 'Password minimal 8 karakter',
            'new_password.confirmed' => 'Konfirmasi password tidak sesuai',
        ]);
        $user = User::findOrFail($id);
        if (!Hash::check($request->current_password, $user->password)) {

            Alert::warning('Warning', 'Kata sandi saat ini salah!');
            return redirect()->back()->withErrors(['current_password' => 'Kata sandi saat ini salah.']);
        }

        $user->password = Hash::make($request->new_password);
        if ($request->new_password != $request->new_password_confirmation) {

            Alert::warning('Warning', 'Password baru berbeda dengan konfirmasi password!');
            return redirect()->back();
        }
        $user->update();

        Alert::success('Success', 'Password berhasil diperbarui!');
        return redirect()->route('admin.profile.edit_password', $id)->with('success', 'Password berhasil diperbarui!');
    }

    public function adminProfile($id)
    {
        $user = User::findOrFail($id);
        return view('admin.profile.index', compact('user'));
    }

    public function adminEditProfile($id)
    {
        $user = User::findOrFail($id);

        return view('admin.profile.edit', compact('user'));
    }

    public function updateProfile(Request $request, $id)
    {
        // $request->validate([
        //     'address' => ['required', 'string', 'max:255'],
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users,email,' . $id,
        //     'phone' => 'required|numeric|min:11|max:13|unique:users,phone,' . $id,
        //     'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        // ], [
        //     'address.required' => 'Alamat wajib diisi',
        //     'phone.required' => 'No. Telepon wajib diisi',
        //     'phone.numeric' => 'No. Telepon harus berupa angka',
        //     'phone.min' => 'No. Telepon minimal 10 karakter',
        //     'phone.max' => 'No. Telepon maksimal 13 karakter',
        //     'name.required' => 'Nama wajib diisi',
        //     'email.required' => 'Email wajib diisi',
        //     'email.email' => 'Email tidak valid',
        //     'email.unique' => 'Email sudah terdaftar',
        //     'avatar.image' => 'File harus berupa gambar',
        //     'avatar.mimes' => 'File harus berupa gambar dengan format jpeg, png, jpg, atau gif',
        //     'avatar.max' => 'Ukuran file maksimal 2MB',
        // ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($user->role != 'ADMIN') {
            $user->address = $request->address;
            $user->phone = $request->phone;
            if (empty($request->address) || empty($request->name) || empty($request->email) || empty($request->phone)) {
                Alert::Warning('Warning', 'Periksa inputan anda!');
                return redirect()->back();
            }
            $user->update();
            Alert::success('Success', 'Perubahan berhasil disimpan!');
            return redirect()->route('user.profile', $id)->with('success', 'Data berhasil diperbarui!');
        }
        if ($request->password) {
            $user->password = Hash::make($request->password);
            return redirect()->route('user.profile', $id)->with('success', 'Password berhasil diperbarui!');
        }
        if ($request->hasFile('avatar')) {
            $imageName = time() . '_' . $request->file('avatar')->getClientOriginalName();
            $request->file('avatar')->move(public_path('storage/images/profile'), $imageName);
            $user->avatar = $imageName;
        }
        if (empty($request->name) || empty($request->email)) {
            Alert::Warning('Warning', 'Periksa inputan anda!');
            return redirect()->back();
        }
        $user->update();
        Alert::success('Success', 'Perubahan berhasil disimpan!');
        return redirect()->route('admin.profile.index', $id)->with('success', 'Data berhasil diperbarui!');
    }
}
