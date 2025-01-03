<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Illuminate\Http\UploadedFile;

class UserRepository implements UserRepositoryInterface
{
    protected $userModel;
    protected $roleModel;

    public function __construct(User $user, Role $role)
    {
        $this->userModel = $user;
        $this->roleModel = $role;
    }

    public function getAllUsers()
    {
        return $this->userModel->with('roles')
            ->latest()
            ->paginate(5);
    }

    public function findUserById($id)
    {
        return $this->userModel->with('roles')->findOrFail($id);
    }

    public function createUser(array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $this->userModel->create($data);
    }

    public function updateUser(array $data, $id)
    {
        $user = $this->findUserById($id);

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        return $user->fresh('roles');
    }

    public function deleteUser($id)
    {
        $user = $this->findUserById($id);
        
        if ($user->image) {
            $this->deleteImage($user->image);
        }
        
        return $user->delete();
    }

    public function handleImageUpload(UploadedFile $image, $oldImage = null)
    {
        if ($oldImage) {
            $this->deleteImage($oldImage);
        }

        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);
        
        return $imageName;
    }

    public function getAllRoles()
    {
        return $this->roleModel->all();
    }

    protected function deleteImage($imageName)
    {
        $imagePath = public_path('images/' . $imageName);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
}
