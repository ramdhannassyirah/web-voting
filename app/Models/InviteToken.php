<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InviteToken extends Model
{
    protected $fillable = ['token', 'user_id', 'used', 'used_at', 'email'];
    
    protected $casts = [
        'used' => 'boolean',
        'used_at' => 'datetime'
    ];

    public function vote()
    {
        return $this->hasOne(Vote::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}