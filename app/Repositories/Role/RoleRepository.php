<?php

namespace App\Repositories\Role;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleRepository implements RoleRepositoryInterface
{
    public function index()
    {
        return Role::with('permissions')->get();
    }

    public function getPermissions()
    {
        return Permission::all();
    }

    public function create(array $data)
    {
        return Role::create($data);
    }
}
