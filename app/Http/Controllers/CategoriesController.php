<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index() {
        $categories = Categories::all();
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

        Categories::create($validatedData);
        return redirect()->route('categories.index');
    }

    public function destroy($id) {
        $category = Categories::find($id);
        $category->delete();
        return redirect()->route('categories.index');
    }

    public function show($id) {
        $category = Categories::find($id);
        return view('categories.show', compact('category'));
    }

    public function edit($id) {
        $category = Categories::find($id);
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $id) {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validatedData = array_merge($validatedData, ['image' => $imageName]);
        }

        $category = Categories::find($id);
        $category->update($validatedData);
        return redirect()->route('categories.index');
    }
}
