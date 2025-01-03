<?php

namespace App\Repositories\User;

use App\Models\User;

interface UserRepositoryInterface
{
    public function show($id);
    public function update(array $data, $id);
    public function store(array $data);
    public function index();
    public function delete($id);
}
