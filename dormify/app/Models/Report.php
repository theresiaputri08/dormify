<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'dormitory_id',
        'sender_name',
        'title',
        'description',
        'is_anonymous',
        'proof_image',
        'status',
        'admin_response',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function dormitory()
    {
        return $this->belongsTo(Dormitory::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}