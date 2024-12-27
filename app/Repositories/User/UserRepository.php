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
        return User::create($data);
    }

    public function update(array $data, $id)
    {
        $user = User::findOrFail($id);
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
}
