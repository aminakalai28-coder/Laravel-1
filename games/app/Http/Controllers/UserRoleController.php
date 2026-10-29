<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->orderBy('id')->get();

        return view('user-roles.index', compact('users'));
    }

    public function create()
    {
        $users = User::orderBy('id')->get();

        $roles = Role::where('guard_name', 'web')
            ->orderBy('name')->get();

        return view('user-roles.create', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'role_id' => ['required', 'integer', 'exists:roles,id'],
        ]);

        $user = User::findOrFail($validated['user_id']);

        $role = Role::where('guard_name', 'web')
            ->findOrFail($validated['role_id']);

        $user->assignRole($role);

        return redirect()->route('admin.user-roles.index')
            ->with('success', 'Rol toegewezen aan gebruiker!');
    }

    public function destroy(string $id)
    {
        $ids = explode('-', $id);

        if (count($ids) !== 2 ||
            !ctype_digit($ids[0]) ||
            !ctype_digit($ids[1])) {
            abort(404);
        }

        [$userId, $roleId] = $ids;

        $user = User::findOrFail($userId);

        $role = Role::where('guard_name', 'web')->findOrFail($roleId);

        $user->removeRole($role);

        return redirect()->route('admin.user-roles.index')
            ->with('success', 'Rol verwijderd bij gebruiker!');
    }
}
