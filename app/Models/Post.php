<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'desc',
        'content',
        'published',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'post_tags');
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

}
