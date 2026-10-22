
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Klanten en admins mogen het overzicht bekijken
Route::get('/games', [GameController::class, 'index'])
    ->middleware(['auth', 'role:admin|klant'])
    ->name('games.index');

// Alleen admins mogen games beheren
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/games/create', [GameController::class, 'create'])
        ->name('games.create');

    Route::post('/games', [GameController::class, 'store'])
        ->name('games.store');

    Route::get('/games/{game}', [GameController::class, 'show'])
        ->name('games.show');

    Route::get('/games/{game}/edit', [GameController::class, 'edit'])
        ->name('games.edit');

    Route::put('/games/{game}', [GameController::class, 'update'])
        ->name('games.update');

    Route::delete('/games/{game}', [GameController::class, 'destroy'])
        ->name('games.destroy');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profiel
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// Geheime pagina
Route::get('/geheim', function () {
    return view('geheim');
})->middleware('auth');

require __DIR__.'/auth.php';
