<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Categories;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Models\Category;

class CategoriesController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository) {
        $this->middleware('auth');
        $this->categoryRepository = $categoryRepository;
    }

    public function index() {
        $categories = $this->categoryRepository->index();
        return view('categories.index', compact('categories'));
    }

    public function create() {
        return view('categories.create');
    }

    public function store(CategoryRequest $request) {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validatedData = array_merge($validatedData, ['image' => $imageName]);
        }

        $this->categoryRepository->store($validatedData);
        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        $category = Categories::findOrFail($id);
        $productsCount = $category->products()->count();

        if ($productsCount > 0) {
            $products = $category->products;
            return view('categories.confirm-delete', compact('category', 'products'));
        }

        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }

    public function forceDelete($id)
    {
        $category = Categories::findOrFail($id);
        $category->products()->delete(); // Delete associated products
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category and its products deleted successfully');
    }

    public function show($id) {
        $category = $this->categoryRepository->show($id);
        return view('categories.show', compact('category'));
    }

    public function edit($id) {
        $category = $this->categoryRepository->show($id);
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $id) {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validatedData = array_merge($validatedData, ['image' => $imageName]);
        }

        $this->categoryRepository->update($validatedData, $id);
        return redirect()->route('categories.index');
    }
}
