
@extends('base')

@section('title', 'Permissie koppelen aan rol')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.role-permissions.store') }}">
        @csrf

        <div class="form-group">
            <label for="role_id">Rol</label>
            <select class="form-control" id="role_id" name="role_id" required>
                <option value="">Kies een rol</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}"
                        @selected(old('role_id') == $role->id)>
                        {{ $role->name }} (ID: {{ $role->id }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="permission_id">Permissie</label>
            <select class="form-control" id="permission_id"
                    name="permission_id" required>
                <option value="">Kies een permissie</option>
                @foreach ($permissions as $permission)
                    <option value="{{ $permission->id }}"
                        @selected(old('permission_id') == $permission->id)>
                        {{ $permission->name }} (ID: {{ $permission->id }})
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Koppelen</button>
        <a href="{{ route('admin.role-permissions.index') }}"
           class="btn btn-secondary">Terug</a>
    </form>
@endsection
