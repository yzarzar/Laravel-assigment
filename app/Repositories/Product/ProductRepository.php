<?php

namespace App\Repositories\Product;

use App\Models\Products;
use App\Repositories\Product\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface {
    public function index() {
        $products = Products::with('category')->get();
        return $products;
    }

    public function store(array $data) {
        return Products::create($data);
    }

    public function update(array $data, $id) {
        $product = Products::find($id);

        if (isset($data['image'])) {
            $imagePath = public_path('images/' . $product->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

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
        $product = Products::with('category')->find($id);
        return $product;
    }
}
