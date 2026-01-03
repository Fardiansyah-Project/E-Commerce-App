<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(7);
        
        $title = 'Hapus!';
        $text = "Kamu Yakin menghapus ini?";
        confirmDelete($title, $text);
        return view('admin.categories.index', compact('categories', 'title', 'text'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
        ], [
            'name.required' => 'Nama kategori harus diisi',
            'name.unique' => 'Nama kategori sudah ada',
        ]);

        $category = Category::create($request->all());
        Alert::success('success', 'Kategori berhasil ditambahkan');

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $id,
        ], [
            'name.required' => 'Nama kategori harus diisi',
            'name.unique' => 'Nama kategori sudah ada',
        ]);

        $category = Category::find($id);
        // $category->update($request->all());
        $category->name = $request->name;
        $category->save();
        Alert::success('success', 'Kategori berhasil diperbarui');

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        Alert::success('success', 'Kategori berhasil dihapus');
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus');
    }
}
