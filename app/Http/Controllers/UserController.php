<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'CUSTOMER')
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }
    public function admin()
    {
        $admins = User::where('role', 'ADMIN')
            ->where('id', '!=', Auth::id())
            ->paginate(10);

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

        if($request->role == "ADMIN") {
            return redirect()->route('admin.users.admin')->with('success', 'Admin berhasil ditambahkan');
        }

        return redirect()->route('admin.users.index')->with('success', 'Penguna berhasil ditambahkan');
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
        $data->save();

        return redirect()->route('admin.users.index')->with('success', 'Penguna berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = User::find($id);
        $data->delete();

        if($data->role == "ADMIN") {
            return redirect()->route('admin.users.admin')->with('success', 'Pengguna berhasil dihapus');
        }

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus');
    }
}
