<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CharacterEpisode extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'character_episodes';

    protected $fillable = [
        'character_id',
        'episode_id',
    ];

    protected $hidden = [
        "updated_at",
        "deleted_at",
    ];
}
