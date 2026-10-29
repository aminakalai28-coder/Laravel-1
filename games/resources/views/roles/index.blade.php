
@extends('base')

@section('title', 'Rollen beheren')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary mb-3">
        Nieuwe rol
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Naam</th>
                <th>Guard</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->guard_name }}</td>
                    <td>
                        <a class="btn btn-warning btn-sm"
                           href="{{ route('admin.roles.edit', $role->id) }}">
                            Bewerken
                        </a>

                        <form method="POST"
                              action="{{ route('admin.roles.destroy', $role->id) }}"
                              style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Rol verwijderen?')">
                                Verwijderen
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Geen rollen gevonden.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
