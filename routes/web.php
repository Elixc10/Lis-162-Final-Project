<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongController;
use App\Http\Controllers\PlaylistController;
use App\Models\Song; 
use App\Models\Genre; 
use App\Models\Playlist; 

//landing page where outside users can play songs
Route::get('/', [SongController::class, 'index'])->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');



// routes for controllers
Route::resource('songs', SongController::class);

Route::resource('playlists', PlaylistController::class)
    ->middleware(['auth']);

Route::post('/playlists/add-song-dashboard', [PlaylistController::class, 'addSong'])
    ->middleware(['auth'])
    ->name('playlists.addSong');

Route::delete('/playlists/{playlist}/songs/{song}', [PlaylistController::class, 'removeSong'])
    ->middleware(['auth'])
    ->name('playlists.removeSong');

Route::post('/logout', function () {
    auth()->guard('web')->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

require __DIR__.'/auth.php';
