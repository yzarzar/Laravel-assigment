<?php

namespace App\Repositories\Category;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class CategoryRepository implements CategoryRepositoryInterface 
{
    /**
     * @var Categories
     */
    protected $model;

    /**
     * CategoryRepository constructor.
     *
     * @param Categories $model
     */
    public function __construct(Categories $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    public function getAllCategories(?int $perPage = null)
    {
        return $perPage 
            ? $this->model->latest()->paginate($perPage)
            : $this->model->latest()->get();
    }

    /**
     * @inheritDoc
     */
    public function store(array $data): Categories
    {
        return $this->model->create($data);
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): ?Categories
    {
        return $this->model->find($id);
    }

    /**
     * @inheritDoc
     */
    public function update(array $data, int $id): ?Categories
    {
        $category = $this->findById($id);
        
        if (!$category) {
            return null;
        }

        if (isset($data['image']) && $category->image) {
            $this->deleteImage($category->image);
        }

        $category->update($data);
        return $category;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): bool
    {
        $category = $this->findById($id);
        
        if (!$category) {
            return false;
        }

        if ($category->products()->count() > 0) {
            return false;
        }

        if ($category->image) {
            $this->deleteImage($category->image);
        }

        return $category->delete();
    }

    /**
     * @inheritDoc
     */
    public function getCategoryWithProducts(int $id): ?Categories
    {
        return $this->model->with('products')->find($id);
    }

    /**
     * Delete image from storage
     *
     * @param string $imageName
     * @return void
     */
    protected function deleteImage(string $imageName): void
    {
        $imagePath = public_path('images/' . $imageName);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
}
