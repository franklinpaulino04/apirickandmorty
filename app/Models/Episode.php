<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Episode extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'episodes';

    protected $fillable = [
        'name',
        'air_date',
        'episode',
    ];

    protected $hidden = [
        "updated_at",
        "deleted_at",
    ];

    public function characters()
    {
        return $this->hasMany(CharacterEpisode::class,'episode_id');
    }
}
