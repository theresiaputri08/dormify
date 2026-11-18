<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $fillable = [
        'report_id',
        'response',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}