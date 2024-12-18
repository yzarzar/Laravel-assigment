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

        Products::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);
        return redirect()->route('products.index');
    }
}
