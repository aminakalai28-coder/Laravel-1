
@extends('base')

@section('title', 'Rol toevoegen')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.roles.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Naam van de rol</label>
            <input class="form-control" id="name" name="name"
                   value="{{ old('name') }}" required maxlength="255">
        </div>

        <p>Guard name: web (automatisch)</p>

        <button class="btn btn-success">Opslaan</button>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Terug</a>
    </form>
@endsection
