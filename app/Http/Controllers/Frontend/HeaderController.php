<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    public function index(){
        // Fetch active categories
        $categories = Category::with(['posts' => function($query) {
            $query->where('Status', 1)->latest(); // Fetch only active posts
        }])->has('posts')->get();
    
        // dd($categories);
        // $categories = Category::where('status', 'active')->get();

        // // Fetch posts for each category
        // $postsByCategory = [];
        // foreach ($categories as $category) {
        //     $postsByCategory[$category->id] = Post::where('category_id', $category->id)
        //         ->where('status', 'published')
        //         ->latest()
        //         ->take(5) // Get the latest 5 posts per category
        //         ->get();
        // }

        // // Fetch the latest post
        $latestPost = Post::where('Status', 1)->latest()->first();
        return view('frontend.index',compact('categories','latestPost'));
    }
}
