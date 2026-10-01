
@extends('base')

@section('title', '🎮 Add Game')

@section('content')

<div class="container" style="margin:40px;">



    <form action="/games/create" method="post">
        @csrf

        <div class="form-group">
            <label>Game name</label>
            <input type="text" name="game_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Platform</label>
            <input type="text" name="platform" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Genre</label>
            <input type="text" name="genre" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Rating</label>
            <input type="number" name="rating" class="form-control" min="0" max="10" step="0.1" required>
        </div>

        <button type="submit" class="btn btn-success">
            Add Game
        </button>

        <a href="/games" class="btn btn-secondary">
            Cancel
        </a>
    </form>

</div>

@endsection