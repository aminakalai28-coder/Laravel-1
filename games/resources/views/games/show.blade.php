@extends('base')

@section('content')

<h1>Game details</h1>

<table class="table">
    <tr>
        <th>Game name</th>
        <td>{{ $game->game_name }}</td>
    </tr>

    <tr>
        <th>Platform</th>
        <td>{{ $game->platform }}</td>
    </tr>

    <tr>
        <th>Genre</th>
        <td>{{ $game->genre }}</td>
    </tr>

    <tr>
        <th>Rating</th>
        <td>{{ $game->rating }}</td>
    </tr>
</table>

<a href="/games" class="btn btn-secondary">
    Back to games
</a>

@endsection