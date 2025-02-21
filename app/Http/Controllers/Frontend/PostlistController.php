<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class PostlistController extends Controller
{
    public function index($id){
        $categories = Category::with(['posts' => function($query) {
            $query->where('Status', 1)->latest(); // Fetch only active posts
        }])->has('posts') ->where('id',$id)->get();
        // dd($categories);
        return view('frontend.post.postindex',compact('categories'));
    }
}
