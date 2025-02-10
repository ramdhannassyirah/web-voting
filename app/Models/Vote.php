<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
        'candidate_id',
        'invite_token_id',
        'user_id'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function inviteToken()
    {
        return $this->belongsTo(InviteToken::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}