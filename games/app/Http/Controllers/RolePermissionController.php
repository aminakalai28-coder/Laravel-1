<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::where('guard_name', 'web')
            ->with('permissions')
            ->orderBy('name')
            ->get();

        return view('role-permissions.index', compact('roles'));
    }

    public function create()
    {
        $roles = Role::where('guard_name', 'web')
            ->orderBy('name')->get();

        $permissions = Permission::where('guard_name', 'web')
            ->orderBy('name')->get();

        return view('role-permissions.create', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'role_id' => ['required', 'integer', 'exists:roles,id'],
            'permission_id' => [
                'required', 'integer', 'exists:permissions,id',
            ],
        ]);

        $role = Role::where('guard_name', 'web')
            ->findOrFail($validated['role_id']);

        $permission = Permission::where('guard_name', 'web')
            ->findOrFail($validated['permission_id']);

        $role->givePermissionTo($permission);

        return redirect()->route('admin.role-permissions.index')
            ->with('success', 'Permissie gekoppeld aan rol!');
    }

    public function destroy(string $id)
    {
        $ids = explode('-', $id);

        if (count($ids) !== 2 ||
            !ctype_digit($ids[0]) ||
            !ctype_digit($ids[1])) {
            abort(404);
        }

        [$roleId, $permissionId] = $ids;

        $role = Role::where('guard_name', 'web')->findOrFail($roleId);

        $permission = Permission::where('guard_name', 'web')
            ->findOrFail($permissionId);

        $role->revokePermissionTo($permission);

        return redirect()->route('admin.role-permissions.index')
            ->with('success', 'Koppeling verwijderd!');
    }
}
