<x-app-layout>
    <x-slot name="header">
        <h2>Name: {{ $playlist->name }}</h2>
        <a href="{{ route('playlists.index') }}">Back to Playlists</a>
    </x-slot>

    <div class="p-6">
        <h3>Songs in this Playlist</h3>
        <ul>
            @foreach($playlist->songs as $song)
                <li>
                    {{ $song->title }} by {{ $song->artist }}
                    <form action="{{ route('playlists.removeSong', [$playlist->id, $song->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Remove</button>
                    </form>
                    <button 
                         onclick="playSong('{{ Storage::url($song->audio_path) }}', '{{ $song->title }} by {{ $song->artist }}')"
                         class="action-btn">
                         Play
                    </button>
                </li>
                
            @endforeach
        </ul>
    </div>
    <!-- Music Player Section -->
    <div id="music-player-container" style="position: fixed; bottom: 0; left: 0; width: 100%; background-color: #f7f7f7; padding: 10px; box-shadow: 0 -2px 5px rgba(0,0,0,0.1); display: none;">
        <p>Now Playing: <strong id="now-playing-info">None</strong></p>
        <audio controls id="audio-player" style="width: 100%;">
            Your browser does not support the audio element.
        </audio>
    </div>


    <!-- Music Player logic -->
    <script>
        function playSong(audioUrl, songInfo) {
            const player = document.getElementById('audio-player');
            const info = document.getElementById('now-playing-info');
            const container = document.getElementById('music-player-container');

            // Set the audio source and info text
            player.src = audioUrl;
            info.textContent = songInfo;
            
            // Make sure the player UI is visible
            container.style.display = 'block';

            // Play the audio
            player.play();
        }
    </script>
    
</x-app-layout>
