<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::all();

        return view('games.index', compact('games'));
    }

    public function create()
    {
        return view('games.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'game_name' => 'required',
            'platform' => 'required',
            'genre' => 'required',
            'rating' => 'required|numeric|min:0|max:10',
        ]);

        Game::create([
            'game_name' => $request->game_name,
            'platform' => $request->platform,
            'genre' => $request->genre,
            'rating' => $request->rating,
        ]);

        return redirect('/games')->with('success', 'Game added!');
    }

    public function edit($id)
    {
        $game = Game::find($id);

        return view('games.edit', compact('game'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'game_name' => 'required',
            'platform' => 'required',
            'genre' => 'required',
            'rating' => 'required|numeric|min:0|max:10',
        ]);

        $game = Game::find($id);

        $game->update([
            'game_name' => $request->game_name,
            'platform' => $request->platform,
            'genre' => $request->genre,
            'rating' => $request->rating,
        ]);

        return redirect('/games')->with('success', 'Game updated!');
    }

    public function destroy($id)
    {
        $game = Game::find($id);

        $game->delete();

        return redirect('/games')->with('success', 'Game deleted!');
    }

    public function show($id)
    {
        $game = Game::find($id);

        return view('games.show', compact('game'));
    }
}