<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index() {
        $products = Products::all();
        return view('products.index', compact('products'));
    }

    public function create() {
        return view('products.create');
    }

    public function show($id) {
        $product = Products::find($id);
        return view('products.show', compact('product'));
    }

    public function destroy($id) {
        $product = Products::find($id);
        $product->delete();
        return redirect()->route('products.index');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|unique:products,name|string|max:255',
            'price' => 'required|numeric|between:0,999999.99',
            'description' => 'required|string|max:2048',
        ]);

        Products::create($validatedData);
        return redirect()->route('products.index');
    }

    public function edit($id) {
        $product = Products::find($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $id,
            'price' => 'required|numeric|between:0,999999.99',
            'description' => 'required|string|max:2048',
        ]);

        $product = Products::find($id);
        $product->update($validatedData);
        return redirect()->route('products.index');
    }
}
