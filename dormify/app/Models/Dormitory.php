<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dormitory extends Model
{
    protected $fillable = [
        'name',
        'location',
        'total_room',
    ];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}