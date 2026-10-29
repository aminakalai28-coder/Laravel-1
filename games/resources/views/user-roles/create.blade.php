
@extends('base')

@section('title', 'Rol koppelen aan gebruiker')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.user-roles.store') }}">
        @csrf

        <div class="form-group">
            <label for="user_id">Gebruiker</label>
            <select class="form-control" id="user_id" name="user_id" required>
                <option value="">Kies een gebruiker</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}"
                        @selected(old('user_id') == $user->id)>
                        {{ $user->name }} — {{ $user->email }}
                        (ID: {{ $user->id }})
                    </option>
                @endforeach
            </select>
        </div>

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

        <button class="btn btn-success">Rol toewijzen</button>
        <a href="{{ route('admin.user-roles.index') }}"
           class="btn btn-secondary">Terug</a>
    </form>
@endsection
