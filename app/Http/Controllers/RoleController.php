<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        return inertia('Roles/Index', [
            'roles' => Role::with('permissions')
                ->when($request->search, function ($query, $search) {
                    $query->where('name', 'LIKE', "%{$search}%")
                        ->orWhereHas('permissions', function ($relation) use ($search) {
                            $relation->where('name', 'LIKE', "%{$search}%");
                        });
                })
                ->orderBy('name')
                ->paginate()
                ->withQueryString(),
            'filter' => $request->search
        ]);
    }

    public function create()
    {
        return inertia('Roles/Create');
    }

    public function store(Request $request)
    {
        $valid = $request->validate([
            'name' => ['required', 'min:4', 'unique:roles']
        ]);

        Role::create($valid);

        return redirect()->route('roles.index')->with('success', 'Role Created');
    }

    public function edit(Role $role)
    {
        return inertia('Roles/Edit', ['role' => $role]);
    }

    public function update(Request $request, Role $role)
    {
        $valid = $request->validate([
            'name' => ['required', 'min:4', 'unique:roles,name,' . $role->id]
        ]);

        if (!auth()->user()->hasRole($role)) {
            $role->update($valid);

            return redirect()->route('roles.index')->with('success', 'Role Updated');
        }
        else
            return back()->with('error', "Can't edit your Role");
    }

    public function destroy(Role $role)
    {
        if (!auth()->user()->hasRole($role)) {
            $role->delete();

            return redirect()->route('roles.index')->with('success', 'Role Deleted');
        }
        else
            return back()->with('error', "Can't delete your Role");
    }

    public function assignPermissionsForm(Role $role)
    {
        $permissions = Permission::all();

        return inertia('Roles/AssignPermission', [
            'role' => $role,
            'permissions' => $permissions,
            'assigned' => $role->permissions
        ]);
    }

    public function assignPermissions(Request $request, Role $role)
    {
        $permissions = $request->input('permissions');

        $role->permissions()->detach();

        foreach ($permissions as $key => $permission) {
            $role->permissions()->sync($permissions[$key], false);
        }

        return redirect()->route('roles.index')->with('success', 'Permissions Assigned');
    }
}
