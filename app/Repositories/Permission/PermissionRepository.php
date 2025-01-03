<?php

namespace App\Repositories\Permission;

use Spatie\Permission\Models\Permission;
use App\Repositories\Permission\PermissionRepositoryInterface;

class PermissionRepository implements PermissionRepositoryInterface
{
    protected $permissionModel;

    public function __construct(Permission $permission)
    {
        $this->permissionModel = $permission;
    }

    public function getAllPermissions()
    {
        return $this->permissionModel->with('roles')->get();
    }

    public function findPermissionById($id)
    {
        return $this->permissionModel->with('roles')->findOrFail($id);
    }

    public function createPermission(array $data)
    {
        return $this->permissionModel->create($data);
    }

    public function updatePermission($id, array $data)
    {
        $permission = $this->findPermissionById($id);
        $permission->update($data);
        return $permission->fresh();
    }

    public function deletePermission($id)
    {
        $permission = $this->findPermissionById($id);
        
        if ($permission->roles()->count() > 0) {
            throw new \Exception('Cannot delete permission with associated roles');
        }
        
        return $permission->delete();
    }

    public function hasRoles($id)
    {
        return $this->getPermissionRoles($id)->isNotEmpty();
    }

    public function getPermissionRoles($id)
    {
        $permission = $this->findPermissionById($id);
        return $permission->roles()->get();
    }
}
