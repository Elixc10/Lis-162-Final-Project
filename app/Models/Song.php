<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Song extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title',
        'artist',
        'genre',
        'language',
        'year',
        'genre_id',
        'audio_path',
    ];

    public function genreRelation(): BelongsTo
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }

    public function playlists(): BelongsToMany
    {
        return $this->belongsToMany(Playlist::class);
    } 
}

