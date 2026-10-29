
@extends('base')

@section('title', 'Permissies koppelen aan rollen')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.role-permissions.create') }}"
       class="btn btn-primary mb-3">Nieuwe koppeling</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Rol-ID</th>
                <th>Rol</th>
                <th>Permissie-ID</th>
                <th>Permissie</th>
                <th>Actie</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roles as $role)
                @forelse ($role->permissions as $permission)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>
                            <form method="POST"
                                  action="{{ route('admin.role-permissions.destroy', $role->id . '-' . $permission->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Koppeling verwijderen?')">
                                    Ontkoppelen
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td colspan="3">Geen permissies gekoppeld.</td>
                    </tr>
                @endforelse
            @empty
                <tr><td colspan="5">Geen rollen gevonden.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
