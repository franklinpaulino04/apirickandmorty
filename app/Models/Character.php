<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Character extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'characters';

    protected $fillable = [
        'name',
        'status',
        'species',
        'type',
        'gender',
        'origin_id',
        'location_id',
        'image',
    ];

    protected $hidden = [
        "updated_at",
        "deleted_at",
    ];

    public function episode()
    {
        return $this->hasMany(CharacterEpisode::class,'character_id');
    }
}
