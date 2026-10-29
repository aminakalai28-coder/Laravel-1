
@extends('base')

@section('title', 'Rol bewerken')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.roles.update', $role->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Naam van de rol</label>
            <input class="form-control" id="name" name="name"
                   value="{{ old('name', $role->name) }}" required maxlength="255">
        </div>

        <p>Guard name: {{ $role->guard_name }}</p>

        <button class="btn btn-success">Wijzigingen opslaan</button>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Terug</a>
    </form>
@endsection
