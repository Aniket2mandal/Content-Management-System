<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;
    protected $fillable = ['type', 'label', 'name','value'];

    // Cast the field_name attribute to an array so it's stored as JSON
  
}
