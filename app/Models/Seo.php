<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;
    protected $fillable = ['field_type', 'label_name', 'field_name', 'value'];

    // Cast the field_name attribute to an array so it's stored as JSON
    protected $casts = [
        'field_name' => 'array',
    ];
}
