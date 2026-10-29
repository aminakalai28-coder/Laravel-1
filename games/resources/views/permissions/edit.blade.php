
@extends('base')

@section('title', 'Permissie bewerken')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST"
          action="{{ route('admin.permissions.update', $permission->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Naam</label>
            <input class="form-control" id="name" name="name"
                   value="{{ old('name', $permission->name) }}"
                   required maxlength="255">
        </div>

        <p>Guard name: {{ $permission->guard_name }}</p>

        <button class="btn btn-success">Wijzigingen opslaan</button>
        <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">
            Terug
        </a>
    </form>
@endsection
