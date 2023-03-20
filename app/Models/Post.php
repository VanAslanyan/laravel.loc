<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
//protected $table = 'posts';
    protected $fillable = [
        'id',
        'website_id',
        'title',
        'description',
    ];

    public function website()
    {
        return $this->belongsTo(Website::class,'id','website_id');
    }
}
