<?php

namespace App\Repositories\Role;

interface RoleRepositoryInterface
{
    /**
     * Get all roles with their permissions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllRoles();

    /**
     * Get all available permissions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllPermissions();

    /**
     * Create a new role with optional permissions.
     *
     * @param array $data
     * @param array|null $permissions
     * @return \Spatie\Permission\Models\Role
     */
    public function createRole(array $data, ?array $permissions = null);

    /**
     * Find a role by its ID.
     *
     * @param int $id
     * @return \Spatie\Permission\Models\Role
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findRoleById($id);

    /**
     * Update a role and its permissions.
     *
     * @param array $data
     * @param int $id
     * @param array|null $permissions
     * @return \Spatie\Permission\Models\Role
     */
    public function updateRole(array $data, $id, ?array $permissions = null);

    /**
     * Delete a role by its ID.
     *
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function deleteRole($id);

    /**
     * Check if role has any users.
     *
     * @param int $id
     * @return bool
     */
    public function hasUsers($id);

    /**
     * Get users associated with a role.
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRoleUsers($id);
}
