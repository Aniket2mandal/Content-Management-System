<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $fillable = ['Name', 'Description', 'Status','image'];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_authors', 'author_id', 'post_id');
    }
}
