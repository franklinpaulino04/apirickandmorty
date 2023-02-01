<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LocationResident extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'location_residents';

    protected $fillable = [
        'location_id',
        'character_id',
    ];

    protected $hidden = [
        "updated_at",
        "deleted_at",
    ];
}
