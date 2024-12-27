<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserRepository implements UserRepositoryInterface
{
    public function index()
    {
        return User::latest()->paginate(5);
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function store(array $data)
    {
        if (isset($data['image'])) {
            $imageName = time() . '.' . $data['image']->extension();
            $data['image']->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        return User::create($data);
    }

    public function update(array $data, $id)
    {
        $user = User::findOrFail($id);

        if (isset($data['image'])) {
            if ($user->image) {
                $oldImagePath = public_path('images/') . $user->image;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $imageName = time() . '.' . $data['image']->extension();
            $data['image']->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        if ($user->image) {
            $imagePath = public_path('images/') . $user->image;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        return $user->delete();
    }

    public function updateAnotherUser(array $data, $id)
    {
        $user = User::findOrFail($id);

        if (isset($data['image'])) {
            if ($user->image) {
                $oldImagePath = public_path('images/') . $user->image;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $imageName = time() . '.' . $data['image']->extension();
            $data['image']->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        // Specific validation for another user
        $updateData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'] ?? null,
            'phone' => $data['phone'] ?? null
        ];

        if (isset($data['image'])) {
            $updateData['image'] = $data['image'];
        }

        $user->update($updateData);
        return $user;
    }

    public function getAdminProfile($id)
    {
        return User::where('id', $id)->firstOrFail();
    }

    public function updateAdminProfile(array $data, $id)
    {
        $user = User::findOrFail($id);

        if (isset($data['image'])) {
            if ($user->image) {
                $oldImagePath = public_path('images/') . $user->image;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $imageName = time() . '.' . $data['image']->extension();
            $data['image']->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        // Specific validation for admin
        $updateData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'] ?? null,
            'phone' => $data['phone'] ?? null
        ];

        if (isset($data['image'])) {
            $updateData['image'] = $data['image'];
        }

        if (!empty($data['password'])) {
            $updateData['password'] = bcrypt($data['password']);
        }

        $user->update($updateData);
        return $user;
    }
}
