@extends('base')

@section('content')

<h1>Games</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<a href="/games/create" class="btn btn-primary mb-3">Add Game</a>

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
                    <a href="/games/show/{{ $game->id }}" class="btn btn-info btn-sm">
                        Show
                    </a>

                    <a href="/games/edit/{{ $game->id }}" class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form action="/games/destroy/{{ $game->id }}" method="post" style="display:inline;">
                        @csrf

                        <button
                            onclick="return confirm('Weet je het zeker?')"
                            class="btn btn-danger btn-sm"
                            type="submit">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>

        @endforeach

    </tbody>
</table>

@endsection