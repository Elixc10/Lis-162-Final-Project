@extends('layouts.app')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- create new playlist -->
                    <form action="{{ route('playlists.store') }}" method="POST">
                        @csrf
                        <input type="text" name="name" placeholder="New Playlist Name" required>
                        <button type="submit" class="action-btn" style="margin-left: 10px" >Create Playlist</button>
                    </form>

                    @if(session('success'))
                      <div style="color: green; margin-top: 10px;">{{ session('success') }}</div>
                    @endif

                    <table style="margin-top: 20px;">
                      @foreach($playlists as $playlist)
                         <tr>
                                <td>
                                    <a href="{{ route('playlists.show', $playlist->id) }}">
                                     {{ $playlist->name }} ({{ $playlist->songs_count }} songs)
                                 </a>
                                </td>
                         </tr>
                        @endforeach
                    </table>

                </div>    
            </div>    
        </div>
    </div>