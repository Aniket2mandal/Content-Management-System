<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use HTMLPurifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthorController extends Controller
{
    public function index()
    {
        $author = Author::latest()->paginate(20);
    
        return view('backend.author.index', compact('author'));
    }
    public function create()
    {
        return view('backend.author.create');
    }
    public function store(Request $request)
    {
        //  dd($request->all());
        $request->validate([
            'Name' => 'required|string',
            'Description' => 'required|string',
            'Status' => 'integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/author'), $imageName);
        } else {
            $imageName = null;
        }
        $purifier = new HTMLPurifier();
        $cleanDescription = $purifier->purify($request->Description);
        $author = new Author;
        $author->Name = $request->Name;
        $author->Description = $cleanDescription;
        $author->Status = $request->Status;
        $author->image = $imageName;
        $author->save();
        return redirect()->route('author.index')->with('success', 'Author Created Successfully');
    }

    public function edit($id)
    {
        $author = Author::find($id);
        return view('backend.author.edit', compact('author'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Name' => 'required|string',
            'Description' => 'required|string',
            'Status' => 'integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/author'), $imageName);
        } else {
            $imageName = null;
        }
        $purifier = new HTMLPurifier();
        $cleanDescription = $purifier->purify($request->Description);
        $author = Author::find($id);
        $author->Name = $request->Name;
        $author->Description = $cleanDescription;
        $author->Status = $request->Status;
        $author->image = $imageName;
        $author->save();
        return redirect()->route('author.index')->with('success', 'Author Updated Successfully');
    }

    public function status(Request $request, $id)
    {
        // Log::info('Received request with status: ' . $request->Status);
        $request->validate([
            'Status' => 'integer',
        ]);
        // dd($request->Status);
        $author = Author::find($id);

        if ($author) {
            // Update the status field
            $author->Status = $request->Status;
            $author->save();  // Save the changes to the database

            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }



    public function delete($id)
    {
        $author = Author::find($id);
        $author->delete();
        return redirect()->route('author.index')->with('success', 'Author Deleted Successfully');
    }
}
