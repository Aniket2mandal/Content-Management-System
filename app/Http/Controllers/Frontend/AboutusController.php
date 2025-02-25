<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Request;

class AboutusController extends Controller
{
    public function index(){
        $posts=Post::where('Status',1)->latest()->get();
        $pages=Page::where('Page_status',1)->where('Page_slug', 'about-page')->first();
        // dd($pages);
        return view('frontend.post.aboutus',compact('pages','posts'));
    }
}
