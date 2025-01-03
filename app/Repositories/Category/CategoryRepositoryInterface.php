<?php

namespace App\Repositories\Category;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface CategoryRepositoryInterface
{
    /**
     * Get all categories with optional pagination
     *
     * @param int|null $perPage
     * @return Collection|LengthAwarePaginator
     */
    public function getAllCategories(?int $perPage = null);

    /**
     * Create a new category
     *
     * @param array $data
     * @return Categories
     */
    public function store(array $data): Categories;

    /**
     * Find category by ID
     *
     * @param int $id
     * @return Categories|null
     */
    public function findById(int $id): ?Categories;

    /**
     * Update category
     *
     * @param array $data
     * @param int $id
     * @return Categories|null
     */
    public function update(array $data, int $id): ?Categories;

    /**
     * Delete category
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * Get category with its products
     *
     * @param int $id
     * @return Categories|null
     */
    public function getCategoryWithProducts(int $id): ?Categories;
}
