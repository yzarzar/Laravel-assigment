<?php

namespace App\Repositories\Product;

use App\Models\Products;
use App\Repositories\Product\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface {
    public function index() {
        $products = Products::all();
        return $products;
    }

    public function store(array $data) {
        return Products::create($data);
    }

    public function update(array $data, $id) {
        $product = Products::find($id);
        $product->update($data);
        return $product;
    }

    public function delete($id) {
        $product = Products::find($id);
        if (isset($product->image)) {
            $imagePath = public_path('images/' . $product->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $product->delete();
        return $product;
    }

    public function show($id) {
        $product = Products::find($id);
        return $product;
    }
}
