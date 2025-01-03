<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Categories;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CategoriesController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->middleware('auth');
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of categories
     */
    public function index(): View
    {
        $categories = $this->categoryRepository->getAllCategories(10);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category
     */
    public function create(): View
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category
     */
    public function store(CreateCategoryRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validatedData['image'] = $imageName;
        }

        $this->categoryRepository->store($validatedData);
        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully');
    }

    /**
     * Display the specified category
     */
    public function show(int $id): View
    {
        $category = $this->categoryRepository->getCategoryWithProducts($id);
        abort_if(!$category, 404, 'Category not found');

        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category
     */
    public function edit(int $id): View
    {
        $category = $this->categoryRepository->findById($id);
        abort_if(!$category, 404, 'Category not found');

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified category
     */
    public function update(UpdateCategoryRequest $request, int $id): RedirectResponse
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validatedData['image'] = $imageName;
        }

        $category = $this->categoryRepository->update($validatedData, $id);
        abort_if(!$category, 404, 'Category not found');

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified category
     */
    public function destroy(int $id): RedirectResponse|View
    {
        $category = $this->categoryRepository->getCategoryWithProducts($id);
        abort_if(!$category, 404, 'Category not found');

        if ($category->products()->count() > 0) {
            return view('categories.confirm-delete', [
                'category' => $category,
                'products' => $category->products
            ]);
        }

        $this->categoryRepository->delete($id);
        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully');
    }

    /**
     * Force delete category and its products
     */
    public function forceDelete(int $id): RedirectResponse
    {
        $category = $this->categoryRepository->getCategoryWithProducts($id);
        abort_if(!$category, 404, 'Category not found');

        $category->products()->delete();
        $this->categoryRepository->delete($id);

        return redirect()->route('categories.index')
            ->with('success', 'Category and its products deleted successfully');
    }
}
