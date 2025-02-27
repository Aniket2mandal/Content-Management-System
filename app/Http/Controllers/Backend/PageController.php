<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use HTMLPurifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::latest()->paginate(20);
        return view('backend.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('backend.pages.create');
    }

    public function store(Request $request)
    {
        Log::info('Form Data:', $request->all());
        $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/|unique:pages,Page_slug',
            'Status' => 'integer',
            'summary' => 'required|string',
            'Description' => 'required'
        ]);
        
        // dd($request->Description)
        // Log::info('Form Data:', $request->all());

        $purifier = new HTMLPurifier();
        $cleanDescription = $purifier->purify($request->Description);
        // $cleanSummary = $purifier->purify($request->Summary);
        $page = new Page;
        $page->Page_title = $request->title;
        $page->Page_slug = $request->slug;
        $page->Page_status = $request->Status;
        $page->Page_summary = $request->summary;
        $page->Page_description =  $cleanDescription ;
        $page->save();

        return response()->json(['success' => true]);
    }


    public function edit($id)
    {
        $page = Page::find($id);
        return response()->json(['success' => true,'data'=>$page]);
    }

    public function update(Request $request,$id){
    //     die("Controller method reached!"); // If this does not show, the request is not reaching this function.
    // print_r("controller reached");
     Log::info('Form Data:', $request->all());

        $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/|unique:pages,Page_slug,' . $id,
            'Status' => 'integer',
            'summary' => 'required',
            'Description' => 'required|string'
        ]);
        Log::info('Form Data:', $request->all());
        $purifier = new HTMLPurifier();
        $cleanDescription = $purifier->purify($request->Description);
        $page = Page::find($id);
        $page->Page_title = $request->title;
        $page->Page_slug = $request->slug;
        $page->Page_status = $request->Status;
        $page->Page_summary = $request->summary;
        $page->Page_description =  $cleanDescription ;
        $page->save();
        return response()->json(['success' => true,'data'=>$page]);
    }


    public function status(Request $request, $id)
    {
        // Log::info('Received request with status: ' . $request->Status);
        $request->validate([
            'Status' => 'integer',
        ]);
        // dd($request->Status);
        $page = Page::find($id);

        if ($page) {
            // Update the status field
            $page->Page_status = $request->Status;
            $page->save();  // Save the changes to the database

            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

    public function delete($id){
        $page = Page::find($id);
        $page->delete();
        return response()->json(['success' => true]);
    }
}
