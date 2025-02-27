<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Request;


class HeaderController extends Controller
{
    public function index()
    {
        // Fetch active categories
        $categories = Category::with(['posts' => function ($query) {
            $query->where('Status', 1)->latest(); // Fetch only active posts
        }, 'posts.authors'])->has('posts')->where('Status', 1)->get();

        // // Fetch the latest post
        $latestPost = Post::where('Status', 1)->latest()->first();
        $categorieslist = Category::where('Status', 1)->latest()->get();
        // dd($categorieslist);


        // Path to the JSON file
        $folderPath = storage_path('app/public/cache');
        $filePath = $folderPath . '/testimonial.json';
        $jsonPath = $filePath;
      
        // Check if the file exists
        if (file_exists($jsonPath)) {
            // Get the content of the JSON file
            $jsonContent = file_get_contents($jsonPath);

            // Decode the JSON data
            $testimonials = json_decode($jsonContent, true);
        } else {
            $testimonials = [];
        }
// dd($testimonials);


// FOR SLIDER
$foldersliderPath = storage_path('app/public/cache');
$filesliderPath = $foldersliderPath . '/slider.json';
$jsonsliderPath = $filesliderPath;

// Check if the file exists
if (file_exists($jsonsliderPath)) {
    // Get the content of the JSON file
    $jsonsliderContent = file_get_contents($jsonsliderPath);

    // Decode the JSON data
    $sliders = json_decode($jsonsliderContent, true);
} else {
    $sliders = [];
}
// dd($sliders);
        return view('frontend.index', compact('categories', 'latestPost', 'categorieslist','testimonials','sliders'));
    }

    
}
