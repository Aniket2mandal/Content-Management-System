<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::paginate(20);
        return view('Back.Pages.index', compact('pages'));
    }

    public function create()
    {
        return view('Back.Pages.create');
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string',
            'Status' => 'integer',
            'summary' => 'required|string',
            'Description' => 'required|string'
        ]);
        Log::info('Form Data:', $request->all());
        $page = new Page;
        $page->Page_title = $request->title;
        $page->Page_slug = $request->slug;
        $page->Page_status = $request->Status;
        $page->Page_summary = $request->summary;
        $page->Page_description = \strip_tags($request->Description);
        $page->save();

        return response()->json(['success' => true]);
    }


    public function edit($id)
    {
        $page = Page::find($id);
        return response()->json(['success' => true,'data'=>$page]);
    }

    public function update(Request $request,$id){
        $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string',
            'Status' => 'integer',
            'summary' => 'required|string',
            'Description' => 'required|string'
        ]);
        $page = Page::find($id);
        $page->Page_title = $request->title;
        $page->Page_slug = $request->slug;
        $page->Page_status = $request->Status;
        $page->Page_summary = $request->summary;
        $page->Page_description = \strip_tags($request->Description);
        $page->save();
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
