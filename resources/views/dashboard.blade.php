@extends('layouts.liberty')

<body>
<div class="discover-items">
<div class=container>
<div class="row">
    
    
        <form action="{{ route('dashboard') }}" method="GET" role="search" id="search-form" name="gs">
    <div class="row align-items-center">
        <!-- Search Inputs (Same for Everyone) -->
        <div class="col-lg-2"><input type="text" name="title" placeholder="Title" value="{{ request('title') }}" style="padding: 15px; width: 180px;"></div>
        <div class="col-lg-2"><input type="text" name="artist" placeholder="Artist" value="{{ request('artist') }}" style="padding: 15px; width: 180px;"></div>
        <div class="col-lg-2">
            <select name="genre" class="form-select" style="padding: 10px; width: 180px;">
                <option value="">Genre</option>
                <option value="Pop" {{ request('genre') == 'Pop' ? 'selected' : '' }}>Pop</option>
                <option value="Hip-hop" {{ request('genre') == 'Hip-hop' ? 'selected' : '' }}>Hip-hop</option>
                <option value="Jazz" {{ request('genre') == 'Jazz' ? 'selected' : '' }}>Jazz</option>
                <option value="Electronic" {{ request('genre') == 'Electronic' ? 'selected' : '' }}>Electronic</option>
                <option value="Country" {{ request('genre') == 'Country' ? 'selected' : '' }}>Country</option>
                <option value="Classical" {{ request('genre') == 'Classical' ? 'selected' : '' }}>Classical</option>
                <option value="Rock" {{ request('genre') == 'Rock' ? 'selected' : '' }}>Rock</option>
            </select>
        </div>
        <div class="col-lg-2"><input type="text" name="language" placeholder="Language" value="{{ request('language') }}" style="padding: 15px; width: 180px;"></div>
        <div class="col-lg-1"><input type="number" name="year_min" placeholder="Min" value="{{ request('year_min') }}" style="padding: 15px; width: 90px;"></div>
        <div class="col-lg-1"><input type="number" name="year_max" placeholder="Max" value="{{ request('year_max') }}" style="padding: 15px; width: 90px;"></div>

        <!-- Action Buttons Column -->
        <div class="col-lg-2 d-flex align-items-center gap-2 ms-auto" style="margin-top: 8px; justify-content: flex-end;">
            <button type="submit" style="width: 80px; height: 50px;">Search</button>

            <a href="{{ route('dashboard') }}">
                <button type="button" style="width: 80px; height: 44px;">Clear</button>
            </a>
            
             @auth
                <a href="{{ route('songs.create') }}">
                    <button type="button" class="action-btn" style="height: 44px; width: 44px;">New </button>
                </a>
            @endauth
        </div>
    </div>
</form>


    <div class="item" style="background: transparent; box-shadow: none; padding: 0;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div style="margin-top: 20px; padding: 0;">
                @if(session('success'))
                    <div style="color: green; margin-bottom: 10px;">
                        {{ session('success') }}
                    </div>
                @endif
                <div style="max-width: 1100px; margin: 0 auto;">
                    <table class="table" style="width: 100%; background: transparent;">
                        <thead>
                            <tr style="color: #f7f7f7;">
                                <th class="text-left" style="font-size: 1.35rem;">Title</th>
                                <th class="text-left" style="font-size: 1.35rem;">Artist</th>
                                <th class="text-center" style="font-size: 1.35rem;">Year</th>
                                <th class="text-center" style="font-size: 1.35rem;">Genre</th>
                                <th class="text-center" style="font-size: 1.35rem;">Language</th>
                                <th class="text-center" style="width: 280px; font-size: 1.35rem;">Actions</th>
                            </tr>
                           
                        </thead>
                        <tbody>
                        @foreach ($songs as $song)
                            <tr style="color: #f7f7f7; background: transparent;">
                                <td class="text-left p-3">{{ $song->title }}</td>
                                <td class="text-left p-3">{{ $song->artist }}</td>
                                <td class="text-center p-3">{{ $song->year }}</td>
                                <td class="text-center p-3">{{ $song->genre }}</td>
                                <td class="text-center p-3">{{ $song->language }}</td>
                                <td class="text-center p-3">
                                    <div class="song-actions">

                                        <!-- Play -->
                                        <button
                                            onclick="playSong('{{ Storage::url($song->audio_path) }}', '{{ $song->title }} by {{ $song->artist }}')"
                                            class="action-btn song-action">
                                            Play
                                        </button>

                                        @auth
                                            <!-- Edit -->
                                            <a href="{{ route('songs.edit', $song->id) }}"
                                               class="action-btn song-action text-decoration-none">
                                                Edit
                                            </a>

                                            <!-- Delete -->
                                            <form action="{{ route('songs.destroy', $song->id) }}"
                                                  method="POST"
                                                  style="margin: 0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="action-btn song-action"
                                                        onclick="return confirm('Are you sure?')">
                                                    Del
                                                </button>
                                            </form>

                                            <!-- Add to playlist -->
                                            <form action="{{ route('playlists.addSong') }}"
                                                  method="POST"
                                                  style="margin: 0;">
                                                @csrf
                                                <input type="hidden" name="song_id" value="{{ $song->id }}">

                                                <select name="playlist_id"
                                                        class="song-action"
                                                        onchange="this.form.submit()">
                                                    <option value="">+ Playlist</option>
                                                    @foreach($userPlaylists as $playlist)
                                                        <option style="color: #000000ff;"  value="{{ $playlist->id }}">
                                                            {{ $playlist->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        @endauth

                                    </div>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>
</div>
</div>
    


    <!-- Music Player Section -->
    <div id="music-player-container" style="position: fixed; bottom: 0; left: 0; width: 100%; background-color: #301e2fff; padding: 10px; box-shadow: 0 -2px 5px rgba(0,0,0,0.1); display: none;">
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
</body>
