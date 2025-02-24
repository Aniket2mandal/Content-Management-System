<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostdetailController extends Controller
{
    public function index($id){
        $posts = Post::with(['categories' => function($query) {
            $query->where('Status', 1); // Fetch only active posts
        }])->has('categories')->with('authors')->where('id',$id)->get();
        // dd($posts);
        // dd($categories);

        // dd($posts);
        return view('frontend.post.postdetail',compact('posts'));
    }
}
