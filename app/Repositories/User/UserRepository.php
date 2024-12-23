<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function show($id)
    {
       $user = User::find($id);
       return $user;
    }

    public function update(array $data, $id)
    {
        $user = User::find($id);
        $user->update($data);
        return $user;
    }

    public function store(array $data)
    {
        return User::create($data);
    }

    public function index()
    {
        return User::all();
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return $user;
    }

    public function updateAnotherUser(array $data, $id)
    {
        $user = User::find($id);
        $user->update($data);
        return $user;
    }
}
