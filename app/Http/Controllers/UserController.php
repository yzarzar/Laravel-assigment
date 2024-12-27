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
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Delete old image if exists
            $user = $this->userRepository->show($id);
            if ($user->image && file_exists(public_path('images/' . $user->image))) {
                unlink(public_path('images/' . $user->image));
            }

            // Store new image
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $user = $this->userRepository->update($data, $id);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully',
                'user' => $user
            ]);
        }

        return redirect()->route('user.show', $id)->with('success', 'Profile updated successfully');
    }

    public function store(UserRequest $request)
    {
        $lastUser = $this->userRepository->store($request->all());

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $this->userRepository->update(['image' => $imageName], $lastUser->id);
        }

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

    public function edit($id)
    {
        $user = $this->userRepository->show($id);
        return view('users.edit', compact('user'));
    }

    public function updateAnotherUser(UserRequest $request, $id)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Delete old image if exists
            $user = $this->userRepository->show($id);
            if ($user->image && file_exists(public_path('images/' . $user->image))) {
                unlink(public_path('images/' . $user->image));
            }

            // Store new image
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $this->userRepository->updateAnotherUser($data, $id);
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }
}
