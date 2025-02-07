<?php

namespace App\Models;

use App\Models\PostAuthor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['Title','Description','Summary','Status','image'];

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'post_authors', 'post_id', 'author_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_categories', 'post_id', 'category_id');
    }
    
}

