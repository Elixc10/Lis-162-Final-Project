<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $playlistsQuery = Auth::user()->playlists()->withCount('songs');
        
        if (!empty($request->input('name'))) 
            {
            $playlistsQuery->where('name', 'like', '%'. $request->input('name') .'%');
            }  
        $playlists = $playlistsQuery->get();
        return view('playlists.index', compact('playlists'));
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        
        Auth::user()->playlists()->create($validated);
    
        return redirect()->route('playlists.index')->with('success', 'Playlist created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Playlist $playlist)
    {
        if ($playlist->user_id !== Auth::id()) {abort(403, 'Unauthorized action.');}

        $playlist->load('songs');

        $availableSongs = Song::all(); 

        return view('playlists.show', compact('playlist', 'availableSongs'));
        

    }

    //Add song to playlist
    public function addSong(Request $request) 
    {
            $validated = $request->validate([
                'song_id' => 'required|exists:songs,id',
                'playlist_id' => 'required|exists:playlists,id',
            ]);
            
            $playlistId = $validated['playlist_id'];
            $songId = $validated['song_id'];
    
            $playlist = Playlist::findOrFail($playlistId);
            $authenticatedUserId = Auth::id();
    
            if ($playlist->user_id !== $authenticatedUserId) {
                abort(403, 'Unauthorized action.'); 
            }
           
            // If no mismatch, proceed with adding the song
            if (!$playlist->songs()->where('song_id', $songId)->exists()) {
                 $playlist->songs()->attach($songId);
                 $message = 'Song added to playlist.';
            } else {
                 $message = 'Song is already in that playlist.';
            }
           
            return back()->with('success', $message); 
}    


    //Remove song from playlist
    public function removeSong(Playlist $playlist, Song $song)
    {
        if ($playlist->user_id !== Auth::id()) {abort(403, 'Unauthorized action.');}
        $playlist->songs()->detach($song->id);
        return redirect()->route('playlists.show', $playlist)->with('success', 'Song removed from playlist.');
    }   


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Playlist $playlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Playlist $playlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Playlist $playlist)
    {
        if ($playlist->user_id !== Auth::id()) {abort(403, 'Unauthorized action.');}
        $playlist->delete();
        return redirect()->route('playlists.index')->with('success', 'Playlist deleted.');
    }
}
