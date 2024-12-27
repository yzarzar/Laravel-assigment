<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
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
        $user = $this->userRepository->show($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Delete old image if exists
            if ($user->image && file_exists(public_path('images/' . $user->image))) {
                unlink(public_path('images/' . $user->image));
            }

            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $this->userRepository->update($data, $id);
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $this->userRepository->store($data);
        return redirect()->route('users.index')->with('success', 'User created successfully');
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

    // public function updateAnotherUser(UserRequest $request, $id)
    // {
    //     $data = $request->validated();

    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $imageName = time() . '_' . $image->getClientOriginalName();

    //         // Delete old image if exists
    //         $user = $this->userRepository->show($id);
    //         if ($user->image && file_exists(public_path('images/' . $user->image))) {
    //             unlink(public_path('images/' . $user->image));
    //         }

    //         // Store new image
    //         $image->move(public_path('images'), $imageName);
    //         $data['image'] = $imageName;
    //     }

    //     $this->userRepository->updateAnotherUser($data, $id);
    //     return redirect()->route('users.index')->with('success', 'User updated successfully');
    // }

    public function updateAnotherUser(UserRequest $request, $id)
    {
        $data = $request->validated();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Ensure directory exists
            if (!file_exists(public_path('images'))) {
                mkdir(public_path('images'), 0755, true);
            }

            // Delete old image if it exists
            $user = User::findOrFail($id);
            if ($user->image && file_exists(public_path('images/' . $user->image))) {
                unlink(public_path('images/' . $user->image));
            }

            // Save new image
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        // Update user
        User::findOrFail($id)->update($data);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }
}
