
@extends('base')

@section('title', 'Permissies beheren')

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

    <a href="{{ route('admin.permissions.create') }}"
       class="btn btn-primary mb-3">Nieuwe permissie</a>

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
            @forelse ($permissions as $permission)
                <tr>
                    <td>{{ $permission->id }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->guard_name }}</td>
                    <td>
                        <a class="btn btn-warning btn-sm"
                           href="{{ route('admin.permissions.edit', $permission->id) }}">
                            Bewerken
                        </a>

                        <form method="POST"
                              action="{{ route('admin.permissions.destroy', $permission->id) }}"
                              style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Permissie verwijderen?')">
                                Verwijderen
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Geen permissies gevonden.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
