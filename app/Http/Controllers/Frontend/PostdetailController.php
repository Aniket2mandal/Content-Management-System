<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostdetailController extends Controller
{
    public function index($id)
    {
        $posts = Post::with(['categories' => function ($query) {
            $query->where('Status', 1); // Fetch only active posts
        }])->has('categories')->with('authors')->where('id', $id)->where('Status',1)->first();
        // dd($posts);
        $latestpost = Post::where('Status', 1)->latest()->get();
        
        // dd($latestpost);
        // dd($posts->categories->first()->Title);
        // dd($categories);

        // $singlepost = $posts->firstOrFail();
        // dd($singlepost);
        //    dd($singlepost->categories->first()->Title);
     
        // dd($posts);
        return view('frontend.post.postdetailsingle', compact('posts','latestpost'));
    }


    public function search(Request $request)
    {
        // Validate the search query
        $request->validate([
            'search' => 'nullable|string|min:2', // Make search term optional and ensure at least 3 characters
        ]);

        // If no search query, return an empty result or some default data
        $query = $request->input('search', '');

        // Get the first post based on the search query, allowing partial matching using LIKE
        $posts = Post::where('Title', 'LIKE', "%{$query}%")
            ->with(['categories', 'authors']) // Eager load categories and authors
            ->paginate(4); // Fetch only one post matching the search query

        // dd($posts);
        // If no post is found, return an appropriate message or redirect
        if (!$posts) {
            return redirect()->route('front.home')->with('message', 'No post found matching your search.');
        }

        // Pass the post to the viewroute
        return view('frontend.post.searchedpost', compact('posts'));
    }
}
