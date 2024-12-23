<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoriesController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository) {
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

    public function destroy($id) {
        $this->categoryRepository->delete($id);
        return redirect()->route('categories.index');
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

        $category = $this->categoryRepository->show($id);
        if (isset($category->image)) {
            $imagePath = public_path('images/' . $category->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validatedData = array_merge($validatedData, ['image' => $imageName]);
        }

        $this->categoryRepository->update($validatedData, $id);
        return redirect()->route('categories.index');
    }
}
