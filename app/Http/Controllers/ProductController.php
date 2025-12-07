<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function show($slug)
    {
        // Incerement berdasarkan user
        $product = Product::with('images')->where('slug', $slug)->firstOrFail();
        if(Auth::check()){
            $product->increment('views');
        }

        return view('product.show', compact('product'));
    }

    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'like', '%' . $query . '%')->paginate(10);

        return view('products.search', compact('products', 'query'));
    }

    public function filterByCategory($categoryId)
    {
        $products = Product::where('category_id', $categoryId)->paginate(10);

        return view('products.category', compact('products', 'categoryId'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            // 'sku' => 'required|string',
            'category_id' => 'required|integer',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'sale_price' => 'required|numeric',
            // 'is_active' => 'required|boolean',
            // 'views' => 'required|string',
        ]);

        $slug = strtolower(str_replace(' ', '-', $request->name));
        if ($request->stock < 0) {
            $isActive = false;
        } else {
            $isActive = true;
        }
        // Create sku code otomation
        $sku = 'SKU-' . rand(3, 9999);
        // $view = Auth::user()->name . '-' . time();
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->slug = $slug;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->sale_price = $request->sale_price;
        $product->sku = $sku;
        $product->is_active = $isActive;
        $product->views = 0;

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/images/products'), $imageName);
            $product->image = $imageName;
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product berhasil dibuat.');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|integer',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'sale_price' => 'required|numeric',
            'sku' => 'required'
        ]);

        $slug = strtolower(str_replace(' ', '-', $request->name));
        $product = Product::find($id);
         if ($request->stock < 0) {
            $isActive = false;
        } else {
            $isActive = true;
        }
        $product->name = $request->name;
        $product->slug = $slug;
        if ($request->sku != $product->sku) {
            $product->sku = $request->sku;
        }
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->sale_price = $request->sale_price;
        $product->is_active = $isActive;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/images/products'), $imageName);
            $product->image = $imageName;
        }
        $product->update();
        return redirect()->route('admin.products.index')->with('success', 'Product berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product berhasil dihapus.');
    }
}
