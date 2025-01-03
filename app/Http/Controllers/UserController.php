<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\User\UserRepositoryInterface;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        try {
            $users = $this->userRepository->getAllUsers();
            return view('users.index', compact('users'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error fetching users: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $user = $this->userRepository->findUserById($id);
            return view('users.show', compact('user'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error loading user: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $roles = $this->userRepository->getAllRoles();
            return view('users.create', compact('roles'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error loading roles: ' . $e->getMessage());
        }
    }

    public function store(CreateUserRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();

            if ($request->hasFile('image')) {
                $data['image'] = $this->userRepository->handleImageUpload($request->file('image'));
            }

            $user = $this->userRepository->createUser($data);

            if ($request->has('role')) {
                $user->assignRole($request->role);
            }

            DB::commit();
            return redirect()->route('users.index')
                ->with('success', 'User created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error creating user: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $user = $this->userRepository->findUserById($id);
            $roles = $this->userRepository->getAllRoles();
            return view('users.edit', compact('user', 'roles'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error loading user: ' . $e->getMessage());
        }
    }

    public function update(UpdateUserRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();
            $user = $this->userRepository->findUserById($id);

            if ($request->hasFile('image')) {
                $data['image'] = $this->userRepository->handleImageUpload(
                    $request->file('image'),
                    $user->image
                );
            }

            $user = $this->userRepository->updateUser($data, $id);

            if ($request->has('role')) {
                $user->syncRoles([$request->role]);
            }

            DB::commit();
            return redirect()->route('users.show', ['id' => $id])
                ->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error updating user: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $this->userRepository->deleteUser($id);

            DB::commit();
            return redirect()->route('users.index')
                ->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error deleting user: ' . $e->getMessage());
        }
    }
}
