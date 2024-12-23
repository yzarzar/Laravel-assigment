<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Categories;
use App\Models\Products;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private $productRepository;
    private $categoriesRepository;

    public function __construct(ProductRepositoryInterface $productRepository, CategoryRepositoryInterface $categoriesRepository) {
        $this->middleware('auth');
        $this->productRepository = $productRepository;
        $this->categoriesRepository = $categoriesRepository;
    }

    public function index() {
        $products = $this->productRepository->index();
        return view('products.index', compact('products'));
    }

    public function create() {
        $categories = $this->categoriesRepository->index();
        return view('products.create', compact('categories'));
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
        $categories = $this->categoriesRepository->index();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, $id) {
        $validatedData = $request->validated();

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
