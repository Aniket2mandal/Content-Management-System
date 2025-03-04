<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\Seo;
use Illuminate\Http\Request;


class HeaderController extends Controller
{
    public function index()
    {
        // $seo=Seo::all();
        // $seo = json_decode(json_encode(Seo::all()->toArray()));
        // dd( $seo);
        $seo=Seo::all();
        $seoData = $seo->keyBy('name');
        // dd($seoData);
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

        // Check if the file exists
        if (file_exists($filePath)) {
            // Get the content of the JSON file
            $jsonContent = file_get_contents($filePath);

            // Decode the JSON data
            $testimonialData = json_decode($jsonContent, true);

            // Ensure testimonials exist
            if (isset($testimonialData['testimonials']) && is_array($testimonialData['testimonials'])) {
                // Get the latest 2 testimonials
                $testimonials = array_slice($testimonialData['testimonials'], 0, 2);
                // dd($testimonials);
            } else {
                $testimonials = [];
            }
        } else {
            $testimonials = [];
        }

        // dd($testimonials); // Debug the result

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
        return view('frontend.index', compact('categories', 'latestPost', 'categorieslist', 'testimonials', 'sliders'));
    }
}
