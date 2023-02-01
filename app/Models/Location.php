<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'locations';

    protected $fillable = [
        'name',
        'type',
        'dimension',
    ];

    protected $hidden = [
        "updated_at",
        "deleted_at",
    ];

    public function residents()
    {
        return $this->hasMany(LocationResident::class,'location_id');
    }
}
