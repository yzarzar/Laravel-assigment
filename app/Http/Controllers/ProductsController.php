<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Categories;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProductsController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->middleware('auth');
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of products
     */
    public function index(Request $request): View
    {
        $products = $this->productRepository->getAllProducts(
            10,
            ['category']
        );
        $categories = Categories::all();

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new product
     */
    public function create(): View
    {
        $categories = Categories::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created product
     */
    public function store(CreateProductRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validatedData['image'] = $imageName;
        }

        // Status is already converted to boolean in CreateProductRequest
        $this->productRepository->store($validatedData);
        return redirect()->route('products.index')
            ->with('success', 'Product created successfully');
    }

    /**
     * Display the specified product
     */
    public function show(int $id): View
    {
        $product = $this->productRepository->findById($id, ['category']);
        abort_if(!$product, 404, 'Product not found');

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product
     */
    public function edit(int $id): View
    {
        $product = $this->productRepository->findById($id);
        abort_if(!$product, 404, 'Product not found');

        $categories = Categories::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product
     */
    public function update(UpdateProductRequest $request, int $id): RedirectResponse
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validatedData['image'] = $imageName;
        }

        // Status is already converted to boolean in UpdateProductRequest
        $product = $this->productRepository->update($validatedData, $id);
        abort_if(!$product, 404, 'Product not found');

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified product
     */
    public function destroy(int $id): RedirectResponse
    {
        $product = $this->productRepository->findById($id);
        abort_if(!$product, 404, 'Product not found');

        $this->productRepository->delete($id);
        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }

    /**
     * Filter products by category
     */
    public function filterByCategory(Request $request): View
    {
        $categoryId = $request->input('category_id');
        $products = $this->productRepository->getProductsByCategory($categoryId, 10);
        $categories = Categories::all();

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Search products
     */
    public function search(Request $request): View
    {
        $query = $request->input('query');
        $products = $this->productRepository->searchProducts($query, 10);
        $categories = Categories::all();

        return view('products.index', compact('products', 'categories'));
    }
}
