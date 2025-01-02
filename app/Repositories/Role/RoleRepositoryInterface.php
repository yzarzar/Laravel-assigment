<?php

namespace App\Repositories\Role;

interface RoleRepositoryInterface
{
    public function index();
    public function getPermissions();
    public function create(array $data);
}
