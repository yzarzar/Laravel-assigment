<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
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

    public function store(ProductRequest $request) {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validatedData = array_merge($validatedData, ['image' => $imageName]);
        }

        $validatedData['status'] = $request->has('status');

        Products::create($validatedData);
        return redirect()->route('products.index');
    }

    public function edit($id) {
        $product = Products::find($id);
        return view('products.edit', compact('product'));
    }

    public function update(ProductRequest $request, $id) {
        $validatedData = $request->validated();

        $validatedData['status'] = $request->has('status');

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validatedData = array_merge($validatedData, ['image' => $imageName]);
        }

        $product = Products::find($id);
        $product->update($validatedData);
        return redirect()->route('products.index');
    }
}
