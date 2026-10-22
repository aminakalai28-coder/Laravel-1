
@extends('base')

@section('content')

<h1>Games</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@role('admin')
    <a href="{{ route('games.create') }}" class="btn btn-primary mb-3">
        Add Game
    </a>
@endrole

<table class="table">
    <thead>
        <tr>
            <th>Game name</th>
            <th>Platform</th>
            <th>Genre</th>
            <th>Rating</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($games as $game)
            <tr>
                <td>{{ $game->game_name }}</td>
                <td>{{ $game->platform }}</td>
                <td>{{ $game->genre }}</td>
                <td>{{ $game->rating }}</td>

                <td>
                    @auth
                        @can('product bekijken')
                            <a href="{{ route('games.show', $game->id) }}"
                               class="btn btn-info btn-sm">
                                Show
                            </a>
                        @endcan
                    @endauth

                    @role('admin')
                        <a href="{{ route('games.edit', $game->id) }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('games.destroy', $game->id) }}"
                              method="POST"
                              style="display: inline;">
                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Weet je het zeker?')"
                                class="btn btn-danger btn-sm"
                                type="submit">
                                Delete
                            </button>
                        </form>
                    @endrole
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
