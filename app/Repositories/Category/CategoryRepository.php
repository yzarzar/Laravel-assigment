<?php

namespace App\Repositories\Category;

use App\Models\Categories;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface {
    public function index() {
        $categories = Categories::all();
        return $categories;
    }

    public function store(array $data) {
        return Categories::create($data);
    }

    public function show($id) {
        $category = Categories::find($id);
        return $category;
    }

    public function update(array $data, $id) {
        $category = Categories::find($id);

        if (isset($data['image'])) {
            $imagePath = public_path('images/' . $category->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $category->update($data);
        return $category;
    }

    // public function delete($id) {
    //     $category = Categories::find($id);

    //     if (isset($category->image)) {
    //         $imagePath = public_path('images/' . $category->image);
    //         if (file_exists($imagePath)) {
    //             unlink($imagePath);
    //         }
    //     }

    //     $category->delete();
    //     return $category;
    // }

    public function delete($id) {
        $category = Categories::find($id);

        if ($category->products()->count() > 0) {
            echo "error";
            dd($category->products()->count());
        }

        if (isset($category->image)) {
            $imagePath = public_path('images/' . $category->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $category->delete();
        return [
            'success' => true,
            'message' => 'Category deleted successfully',
            'data' => $category
        ];
    }
}
