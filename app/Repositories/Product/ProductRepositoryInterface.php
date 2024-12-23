<?php

namespace App\Repositories\Product;

interface ProductRepositoryInterface
{
    public function index();
    public function store(array $data);
    public function update(array $data, $id);
    public function delete($id);
    public function show($id);
}
