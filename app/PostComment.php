<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    protected $fillable  = ['post_id', 'user_id', 'message', 'title', 'approved'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
