<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Request;

class FrontpageController extends Controller
{
    public function pagedetail($slug){
    // dd($slug);
    $pages=Page::where('Page_slug',$slug)->first();
    $posts=Post::where('Status',1)->latest()->get();
    return view('frontend.post.aboutus',compact('pages','posts'));
    }
}
