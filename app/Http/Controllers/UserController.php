<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return inertia('Users/Index', [
            'users' => User::with('roles')
                ->when($request->search, function ($query, $search) {
                    $query->where('name', 'LIKE', "%{$search}%")
                        ->orWhereHas('roles', function ($relation) use ($search) {
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
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }

    public function assignRolesForm(User $user)
    {
        $roles = Role::all();

        return inertia('Users/AssignRole', [
            'user' => $user,
            'roles' => $roles,
            'assigned' => $user->roles
        ]);
    }

    public function assignRoles(Request $request, User $user)
    {
        $roles = $request->input('roles');

        $user->roles()->detach();

        foreach ($roles as $key => $role) {
            $user->roles()->sync($roles[$key], false);
        }

        return redirect()->route('users.index')->with('success', 'Roles Assigned');
    }
}
