<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::where('guard_name', 'web')
            ->orderBy('name')
            ->get();

        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'name')
                    ->where('guard_name', 'web'),
            ],
        ]);

        Role::create([
            'name' => $validated['name'],
            'guard_name' => 'web',
        ]);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Rol toegevoegd!');
    }

    public function edit(string $id)
    {
        $role = Role::where('guard_name', 'web')->findOrFail($id);

        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, string $id)
    {
        $role = Role::where('guard_name', 'web')->findOrFail($id);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'name')
                    ->where('guard_name', 'web')
                    ->ignore($role->id),
            ],
        ]);

        $role->update(['name' => $validated['name']]);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Rol gewijzigd!');
    }

    public function destroy(string $id)
    {
        $role = Role::where('guard_name', 'web')->findOrFail($id);

        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('success', 'Rol verwijderd!');
    }
}
