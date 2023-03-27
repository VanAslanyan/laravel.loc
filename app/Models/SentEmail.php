<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SentEmail extends Model
{
    use HasFactory;

    protected $table = 'sent_email';
    protected $fillable = [
        'id',
        'user_id',
        'post_id',
        'sent_email'
    ];

    public function posts()
    {
        return $this->belongsTo(Post::class, 'id', 'post_id');
    }

    public function usersSentEmials()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
