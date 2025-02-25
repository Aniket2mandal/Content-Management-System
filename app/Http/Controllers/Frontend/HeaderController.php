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
    public function index(){
        // Fetch active categories
        $categories = Category::with(['posts' => function($query) {
            $query->where('Status', 1)->latest(); // Fetch only active posts
        },'posts.authors'])->has('posts')->where('Status',1)->get();
    
        // // Fetch the latest post
        $latestPost = Post::where('Status', 1)->latest()->first();
        $categorieslist=Category::where('Status',1)->latest()->get();
        // dd($categorieslist);
        return view('frontend.index',compact('categories','latestPost','categorieslist'));
    }
}
