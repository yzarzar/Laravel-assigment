<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\UploadedFile;

interface UserRepositoryInterface
{
    /**
     * Get paginated list of all users with their roles.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllUsers();

    /**
     * Find a user by their ID.
     *
     * @param int $id
     * @return \App\Models\User
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findUserById($id);

    /**
     * Create a new user.
     *
     * @param array $data
     * @return \App\Models\User
     */
    public function createUser(array $data);

    /**
     * Update a user's information.
     *
     * @param array $data
     * @param int $id
     * @return \App\Models\User
     */
    public function updateUser(array $data, $id);

    /**
     * Delete a user and their image.
     *
     * @param int $id
     * @return bool
     */
    public function deleteUser($id);

    /**
     * Handle user image upload.
     *
     * @param \Illuminate\Http\UploadedFile $image
     * @param string|null $oldImage
     * @return string
     */
    public function handleImageUpload(UploadedFile $image, $oldImage = null);

    /**
     * Get all available roles.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllRoles();
}
