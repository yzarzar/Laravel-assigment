<?php

namespace App\Repositories\Permission;

interface PermissionRepositoryInterface
{
    /**
     * Get all permissions with their associated roles.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllPermissions();

    /**
     * Find a permission by its ID.
     *
     * @param int $id
     * @return \Spatie\Permission\Models\Permission
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findPermissionById($id);

    /**
     * Create a new permission.
     *
     * @param array $data
     * @return \Spatie\Permission\Models\Permission
     */
    public function createPermission(array $data);

    /**
     * Update an existing permission.
     *
     * @param int $id
     * @param array $data
     * @return \Spatie\Permission\Models\Permission
     */
    public function updatePermission($id, array $data);

    /**
     * Delete a permission.
     *
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function deletePermission($id);

    /**
     * Check if permission has any roles.
     *
     * @param int $id
     * @return bool
     */
    public function hasRoles($id);

    /**
     * Get roles associated with a permission.
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPermissionRoles($id);
}
