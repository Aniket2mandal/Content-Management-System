<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostlistController extends Controller
{
    public function index($id){
        $categories = Category::where('id', $id)->first();
// dd($categories);
if (!$categories) {
    abort(404, 'Category not found');
}

        $posts = $categories->posts()->where('Status', 1)->latest()->paginate(4); 
        // dd($posts);
        return view('frontend.post.postindex',compact('categories','posts'));
    }

    public function latestpost(){
        $posts = Post::with(['categories' => function($query) {
            $query->where('Status', 1); // Fetch only active posts
        }])->has('categories')->latest()->paginate(4);
        return view('frontend.post.latestpost',compact('posts'));
    }
}
