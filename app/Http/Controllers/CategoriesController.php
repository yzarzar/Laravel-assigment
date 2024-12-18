<?php

namespace App\Http\Controllers;

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

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Categories::create($request->all());

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

    public function update(Request $request, $id) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ]);

        $category = Categories::find($id);
        $category->update($validatedData);
        return redirect()->route('categories.index');
    }
}
