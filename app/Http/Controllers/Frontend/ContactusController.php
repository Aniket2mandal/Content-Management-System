<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Post;
use Illuminate\Http\Request;

class ContactusController extends Controller
{
    public function index(){
        $posts=Post::where('Status',1)->latest()->get();
        return view('frontend.contactus',compact('posts'));
    }

    public function store(Request $request){
        // dd($request);
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'website' => 'string',
            'msg' => 'required|string',
        ]);
        // dd($request);
        $contact=new Contact();
        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->website=$request->website;
        $contact->msg=$request->msg;
        $contact->save();

        return redirect()->route('front.contactus')->with('success', 'Message Sent Successfully');
    }
}
