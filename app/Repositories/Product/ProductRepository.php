<?php

namespace App\Repositories\Product;

use App\Models\Products;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @var Product
     */
    protected $model;

    /**
     * ProductRepository constructor.
     *
     * @param Product $model
     */
    public function __construct(Products $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    public function getAllProducts(?int $perPage = null, array $relations = [])
    {
        $query = $this->model->with($relations)->latest();
        return $perPage ? $query->paginate($perPage) : $query->get();
    }

    /**
     * @inheritDoc
     */
    public function store(array $data): Products
    {
        return $this->model->create($data);
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id, array $relations = []): ?Products
    {
        return $this->model->with($relations)->find($id);
    }

    /**
     * @inheritDoc
     */
    public function update(array $data, int $id): ?Products
    {
        $product = $this->findById($id);

        if (!$product) {
            return null;
        }

        if (isset($data['image']) && $product->image) {
            $this->deleteImage($product->image);
        }

        $product->update($data);
        return $product;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): bool
    {
        $product = $this->findById($id);

        if (!$product) {
            return false;
        }

        if ($product->image) {
            $this->deleteImage($product->image);
        }

        return $product->delete();
    }

    /**
     * @inheritDoc
     */
    public function getProductsByCategory(int $categoryId, ?int $perPage = null)
    {
        $query = $this->model->where('category_id', $categoryId)->with('category')->latest();
        return $perPage ? $query->paginate($perPage) : $query->get();
    }

    /**
     * @inheritDoc
     */
    public function searchProducts(string $query, ?int $perPage = null)
    {
        $searchQuery = $this->model->where(function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%")
              ->orWhere('description', 'LIKE', "%{$query}%");
        })->with('category')->latest();

        return $perPage ? $searchQuery->paginate($perPage) : $searchQuery->get();
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
