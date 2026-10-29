
@extends('base')

@section('title', 'Permissie toevoegen')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.permissions.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Naam</label>
            <input class="form-control" id="name" name="name"
                   value="{{ old('name') }}" required maxlength="255">
        </div>

        <p>Guard name: web (automatisch)</p>

        <button class="btn btn-success">Opslaan</button>
        <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">
            Terug
        </a>
    </form>
@endsection
