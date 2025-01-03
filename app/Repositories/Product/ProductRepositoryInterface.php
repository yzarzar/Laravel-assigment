<?php

namespace App\Repositories\Product;

use App\Models\Products;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    /**
     * Get all products with optional pagination and category relation
     *
     * @param int|null $perPage
     * @param array $relations
     * @return Collection|LengthAwarePaginator
     */
    public function getAllProducts(?int $perPage = null, array $relations = []);

    /**
     * Create a new product
     *
     * @param array $data
     * @return Product
     */
    public function store(array $data): Products;

    /**
     * Find product by ID
     *
     * @param int $id
     * @param array $relations
     * @return Product|null
     */
    public function findById(int $id, array $relations = []): ?Products;

    /**
     * Update product
     *
     * @param array $data
     * @param int $id
     * @return Products|null
     */
    public function update(array $data, int $id): ?Products;

    /**
     * Delete product
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * Get products by category ID
     *
     * @param int $categoryId
     * @param int|null $perPage
     * @return Collection|LengthAwarePaginator
     */
    public function getProductsByCategory(int $categoryId, ?int $perPage = null);

    /**
     * Search products by name or description
     *
     * @param string $query
     * @param int|null $perPage
     * @return Collection|LengthAwarePaginator
     */
    public function searchProducts(string $query, ?int $perPage = null);
}
