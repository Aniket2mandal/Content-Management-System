<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        return view('Back.Pages.index');
    }

    public function create(){
        return view('Back.Pages.create');
    }
}
