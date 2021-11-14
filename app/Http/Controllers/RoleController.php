<?php

namespace App\Http\Controllers;

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

        return redirect()->route('roles.index');
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

        $role->update($valid);

        return redirect()->route('roles.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index');
    }
}
