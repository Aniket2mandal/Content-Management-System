<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['Title', 'Slug', 'Description', 'Status'];

   
    protected $casts = [
        'Status' => 'boolean',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_categories', 'category_id', 'post_id');
    }
}
