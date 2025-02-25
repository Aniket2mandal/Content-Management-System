<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $fillable = ['Page_title', 'Page_slug', 'Page_summary', 'Page_description', 'Page_status'];

    // If the database column uses snake_case (e.g., page_slug), you can explicitly specify it:
    protected $casts = [
        'Page_slug' => 'string',
    ];
}
