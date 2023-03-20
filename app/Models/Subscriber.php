<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'website_id',
    ];

    public function post()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function website()
    {
        return $this->belongsTo(Website::class, 'id', 'website_id');
    }

}
