<?php

namespace App\Repositories\Category;

use App\Models\Categories;

interface CategoryRepositoryInterface
{
    public function index();
    public function store(array $data);
    public function show($id);
    public function update(array $data, $id);
    public function delete($id);
}
