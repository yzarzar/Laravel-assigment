<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function show($id)
    {
        $user = $this->userRepository->show($id);
        return view('users.show', compact('user'));
    }

    public function update(UserRequest $request, $id)
    {
        $this->userRepository->update($request->all(), $id);
        return redirect()->route('user.show', $id);
    }

    public function store(UserRequest $request)
    {
        $this->userRepository->store($request->all());
        return redirect()->route('users.index');
    }

    public function create()
    {
        return view('users.create');
    }

    public function index()
    {
        $users = $this->userRepository->index();
        return view('users.index', compact('users'));
    }

    public function destroy($id)
    {
        $this->userRepository->delete($id);
        return redirect()->route('users.index');
    }

    public function updateAnotherUser(UserRequest $request, $id)
    {
        $this->userRepository->updateAnotherUser($request->all(), $id);
        return redirect()->route('users.index', $id);
    }
}
