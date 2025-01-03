<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Repositories\Permission\PermissionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    protected $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->middleware('auth');
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        try {
            $permissions = $this->permissionRepository->getAllPermissions();
            return view('permissions.index', compact('permissions'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error fetching permissions: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(CreatePermissionRequest $request)
    {
        try {
            DB::beginTransaction();

            $permission = $this->permissionRepository->createPermission($request->validated());

            DB::commit();
            return redirect()->route('permissions.index')
                ->with('success', 'Permission created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error creating permission: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $permission = $this->permissionRepository->findPermissionById($id);
            return view('permissions.edit', compact('permission'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error loading permission: ' . $e->getMessage());
        }
    }

    public function update(UpdatePermissionRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $this->permissionRepository->updatePermission($id, $request->validated());

            DB::commit();
            return redirect()->route('permissions.index')
                ->with('success', 'Permission updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error updating permission: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $permission = $this->permissionRepository->findPermissionById($id);
            $roles = $this->permissionRepository->getPermissionRoles($id);
            
            if ($roles->isNotEmpty()) {
                return view('permissions.confirm-delete', [
                    'permission' => $permission,
                    'roles' => $roles
                ]);
            }

            DB::beginTransaction();
            $this->permissionRepository->deletePermission($id);
            DB::commit();

            return redirect()->route('permissions.index')
                ->with('success', 'Permission deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error deleting permission: ' . $e->getMessage());
        }
    }

    public function forceDelete($id)
    {
        try {
            DB::beginTransaction();

            $permission = $this->permissionRepository->findPermissionById($id);
            $permission->roles()->detach();
            $this->permissionRepository->deletePermission($id);

            DB::commit();
            return redirect()->route('permissions.index')
                ->with('success', 'Permission and its role associations deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error force deleting permission: ' . $e->getMessage());
        }
    }
}
