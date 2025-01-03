<?php

namespace App\Repositories\Role;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleRepository implements RoleRepositoryInterface
{
    protected $roleModel;
    protected $permissionModel;

    public function __construct(Role $role, Permission $permission)
    {
        $this->roleModel = $role;
        $this->permissionModel = $permission;
    }

    public function getAllRoles()
    {
        return $this->roleModel->with('permissions')->get();
    }

    public function getAllPermissions()
    {
        return $this->permissionModel->all();
    }

    public function createRole(array $data, ?array $permissions = null)
    {
        $role = $this->roleModel->create($data);
        
        if ($permissions) {
            $role->syncPermissions($permissions);
        }
        
        return $role->load('permissions');
    }

    public function findRoleById($id)
    {
        return $this->roleModel->with('permissions')->findOrFail($id);
    }

    public function updateRole(array $data, $id, ?array $permissions = null)
    {
        $role = $this->findRoleById($id);
        $role->update($data);
        
        if ($permissions !== null) {
            $role->syncPermissions($permissions);
        }
        
        return $role->fresh('permissions');
    }

    public function deleteRole($id)
    {
        $role = $this->findRoleById($id);
        
        if ($role->name === 'admin') {
            throw new \Exception('Cannot delete admin role');
        }
        
        return $role->delete();
    }

    public function hasUsers($id)
    {
        $role = $this->findRoleById($id);
        return $role->users()->exists();
    }

    public function getRoleUsers($id)
    {
        $role = $this->findRoleById($id);
        return $role->users;
    }
}
