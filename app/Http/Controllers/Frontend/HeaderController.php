<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Page;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    public function index(){
         $categories=Category::where('Status', 1)->get();
         $pages=Page::where('Page_status',1)->get();
        return view('frontend.layout.app',compact('categories','pages'));
    }
}
