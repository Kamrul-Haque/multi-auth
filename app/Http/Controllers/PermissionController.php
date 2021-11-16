<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        return inertia('Permissions/Index', [
            'permissions' => Permission::query()
                ->when($request->search, function ($query, $search) {
                    $query->where('name', 'LIKE', "%{$search}%");
                })
                ->orderBy('name')
                ->paginate()
                ->withQueryString(),
            'filter' => $request->search
        ]);
    }

    public function create()
    {
        return inertia('Permissions/Create');
    }

    public function store(Request $request)
    {
        $valid = $request->validate([
            'name' => ['required', 'min:4', 'unique:permissions']
        ]);

        Permission::create($valid);

        return redirect()->route('permissions.index')->with('success', 'Permission Created');
    }

    public function edit(Permission $permission)
    {
        return inertia('Permissions/Edit', [
            'permission' => $permission
        ]);
    }

    public function update(Request $request, Permission $permission)
    {
        $valid = $request->validate([
            'name' => ['required', 'min:4', 'unique:permissions,name,' . $permission->id]
        ]);

        $permission->update($valid);

        return redirect()->route('permissions.index')->with('success', 'Permission Updated');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return back()->with('success', 'Permission Deleted');
    }
}
