<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Repositories\Role\RoleRepositoryInterface;

class RoleController extends Controller
{
    private $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->middleware('auth');
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        try {
            $roles = $this->roleRepository->getAllRoles();
            return view('roles.index', compact('roles'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error fetching roles: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $permissions = $this->roleRepository->getAllPermissions();
            return view('roles.create', compact('permissions'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error loading permissions: ' . $e->getMessage());
        }
    }

    public function store(CreateRoleRequest $request)
    {
        try {
            DB::beginTransaction();

            $role = $this->roleRepository->createRole(
                ['name' => $request->name],
                $request->permissions
            );

            DB::commit();
            return redirect()->route('roles.index')->with('success', 'Role created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error creating role: ' . $e->getMessage());
        }
    }

    public function edit(Role $role)
    {
        try {
            $permissions = $this->roleRepository->getAllPermissions();
            return view('roles.edit', compact('role', 'permissions'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error loading permissions: ' . $e->getMessage());
        }
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        try {
            DB::beginTransaction();

            $role->update(['name' => $request->name]);
            if($request->has('permissions')) {
                $role->syncPermissions($request->permissions);
            }

            DB::commit();
            return redirect()->route('roles.index')->with('success', 'Role updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error updating role: ' . $e->getMessage());
        }
    }

    public function destroy(Role $role)
    {
        try {
            if($role->name === 'admin') {
                return redirect()->route('roles.index')
                    ->with('error', 'Cannot delete admin role');
            }

            if($role->users()->count() > 0) {
                $users = $role->users()->pluck('name')->implode(', ');
                return view('roles.confirm-delete', compact('role', 'users'));
            }

            $role->delete();
            return redirect()->route('roles.index')
                ->with('success', 'Role deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting role: ' . $e->getMessage());
        }
    }

    public function forceDelete($id)
    {
        try {
            $role = $this->roleRepository->findRoleById($id);
            $role->users()->delete(); // Delete associated users
            $role->delete();
            return redirect()->route('roles.index')->with('success', 'Role and its users deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting role and its users: ' . $e->getMessage());
        }
    }
}
