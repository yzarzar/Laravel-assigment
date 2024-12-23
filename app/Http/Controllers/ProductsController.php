<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Products;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository) {
        $this->productRepository = $productRepository;
    }

    public function index() {
        $products = $this->productRepository->index();
        return view('products.index', compact('products'));
    }

    public function create() {
        return view('products.create');
    }

    public function show($id) {
        $product = $this->productRepository->show($id);
        return view('products.show', compact('product'));
    }

    public function destroy($id) {
        $this->productRepository->delete($id);
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

        $this->productRepository->store($validatedData);
        return redirect()->route('products.index');
    }

    public function edit($id) {
        $product = $this->productRepository->show($id);
        return view('products.edit', compact('product'));
    }

    public function update(ProductRequest $request, $id) {
        $validatedData = $request->validated();

        $product = $this->productRepository->show($id);
        if (isset($product->image)) {
            $imagePath = public_path('images/' . $product->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $validatedData['status'] = $request->has('status');

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validatedData = array_merge($validatedData, ['image' => $imageName]);
        }

        $this->productRepository->update($validatedData, $id);
        return redirect()->route('products.index');
    }
}
