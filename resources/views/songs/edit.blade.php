<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Song</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 20px; }
        .container { max-width: 500px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { margin-bottom: 20px; color: #333; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        input[type="text"],
        input[type="number"],
        select { 
            width: 100%; 
            padding: 10px; 
            border: 1px solid #ddd; 
            border-radius: 4px; 
            font-size: 14px;
            font-family: Arial, sans-serif;
        }
        input:focus,
        select:focus { outline: none; border-color: #007bff; box-shadow: 0 0 5px rgba(0,123,255,0.3); }
        button { 
            width: 100%; 
            padding: 12px; 
            background-color: #007bff; 
            color: white; 
            border: none; 
            border-radius: 4px; 
            cursor: pointer; 
            font-size: 16px;
            font-weight: bold;
        }
        button:hover { background-color: #0056b3; }
        .error-message { color: #dc3545; font-size: 12px; margin-top: 3px; }
        .error-box { background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 12px; border-radius: 4px; margin-bottom: 20px; }
        .cancel-link { display: inline-block; margin-top: 10px; text-align: center; }
        .cancel-link a { color: #6c757d; text-decoration: none; }
        .cancel-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
    <h1>Edit Song</h1>
        <form action="{{ route('songs.update', $song->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="{{ old('title', $song->title) }}" required>
            @error('title')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="artist">Artist:</label>
            <input type="text" id="artist" name="artist" value="{{ old('artist', $song->artist) }}" required>
            @error('artist')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="genre_id">Genre:</label>
            <select name="genre_id" id="genre_id" required>
                <option value="">-- Select a Genre --</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" {{ old('genre_id', $song->genre_id) == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
                @endforeach
            </select>
            @error('genre_id')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="language">Language:</label>
            <input type="text" id="language" name="language" value="{{ old('language', $song->language) }}" required>
            @error('language')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="year">Year:</label>
            <input type="number" id="year" name="year" value="{{ old('year', $song->year) }}" required>
            @error('year')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
                <label for="audio_file">Audio File (MP3/WAV):</label>
                <input type="file" name="audio_file" id="audio_file" accept="audio/mpeg, audio/wav">
        </div>

        <button type="submit">Update Song</button>
    </form>
        <div class="cancel-link">
            <a href="{{ route('dashboard') }}"><button type="button">Cancel</button></a>
        </div>
    </div>
</body>
</html>