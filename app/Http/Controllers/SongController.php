<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class SongController extends Controller implements HasMiddleware


{
    // Render the Livewire dashboard view with a custom layout
    public function render()
    {
       return view('livewire.dashboard')
           ->layout('layouts.liberty'); 
    }

    
    //allowing song play ONLY for outside users
     public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['index', 'show']),
        ];
    }   

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $songsQuery = Song::query();
        if (!empty($request->input('title'))) 
            {
            $songsQuery->where('title', 'like', '%'. $request->input('title') .'%');
            }  

        if (!empty($request->input('artist'))) 
            {
            $songsQuery->where('artist', 'like', '%'. $request->input('artist') .'%');
            }
               
        if (!empty($request->input('genre'))) 
            {
            $songsQuery->where('genre', 'like', '%'. $request->input('genre') .'%');
            }
        
         if (!empty($request->input('language'))) 
            {
            $songsQuery->where('language', 'like', '%'. $request->input('language') .'%');
            }   

        $minYear = $request->input('year_min');
        $maxYear = $request->input('year_max');
        if (!empty($minYear) && !empty($maxYear)) 
            {
            $songsQuery->whereBetween('year', [$minYear, $maxYear]);
            } 
        elseif (!empty($minYear)) 
            {
            $songsQuery->where('year', '>=', $minYear);
            } 
        elseif (!empty($maxYear)) 
            {
            $songsQuery->where('year', '<=', $maxYear);
            }
               
        $songs = $songsQuery->get();
        $userPlaylists = Auth::check() ? Auth::user()->playlists()->get() : collect();
        return view('dashboard', compact('songs','userPlaylists'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();
        return view('songs.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'genre_id' => 'required|exists:genres,id',
            'language' => 'required|string|max:255',
            'year' => 'required|integer|max:' . date('Y'),
            'audio_file' => 'required|file|mimes:mp3,wav|max:20000',
        ]);

        $songDataToSave = $validated;

        if ($request->hasFile('audio_file')) {
            $path = $request->file('audio_file')->store('audio_files', 'public');
            $songDataToSave['audio_path'] = $path;
        }

        // Get the genre name from the selected genre_id
        $genre = Genre::find($validated['genre_id']);
        $songDataToSave['genre'] = $genre->name;

        unset($songDataToSave['audio_file']);

        Song::create($songDataToSave);

        return redirect()->route('dashboard')
                         ->with('success', 'Song created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Song $song)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $song = Song::findOrFail($id);
        $genres = Genre::all();
        return view('songs.edit', compact('song', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $song = Song::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'genre_id' => 'required|exists:genres,id',
            'language' => 'required|string|max:255',
            'year' => 'required|integer|max:' . date('Y'),
            'audio_file' => 'nullable|file|mimes:mp3,wav|max:20000',
        ]);
        
    $songDataToUpdate = $validated;

    if ($request->hasFile('audio_file')) {
        // 1. Delete the old file if it exists
        if ($song->audio_path) {
            Storage::disk('public')->delete($song->audio_path);
        }

        // 2. Upload the new file
        $path = $request->file('audio_file')->store('audio_files', 'public');
        $songDataToUpdate['audio_path'] = $path;
    }


        // Get the genre name from the selected genre_id
        $genre = Genre::find($validated['genre_id']);
        $songDataToUpdate['genre'] = $genre->name;

        unset($songDataToUpdate['audio_file']);

        $song->update($songDataToUpdate);

        return redirect()->route('dashboard')
                         ->with('success', 'Song updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $song = Song::findOrFail($id);
        $song->delete();

        return redirect()->route('dashboard')
                         ->with('success', 'Song deleted successfully!');
    }
}
