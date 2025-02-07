<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category=Category::paginate(5);
        return view('Back.Category.index',compact('category'));
    }
    public function create()
    {
        return view('Back.Category.create');
    }
    public function store(Request $request)
{
   
    $request->validate([
        'Title' => 'required|string',
        'Slug' => 'required|string',
        'Description' => 'string',
        'Status' => 'integer', 
    ]);
   
    // dd($request->all());
    // $status = $request->has('Status') ? 1 : 0; 

    
    $category = new Category();
    $category->Title = $request->Title;
    $category->Slug = $request->Slug;
    $category->Description = $request->Description;
    $category->Status = $request->Status;
    $category->save();

    
    return redirect()->route('category.index')->with('success', 'Category Created Successfully');
}

public function edit($id)
{
    $category = Category::find($id);
    return view('Back.Category.edit',compact('category'));
}

public function update(Request $request, $id)
{
    
    $request->validate([
        'Title' => 'required|string',
        'Slug' => 'required|string',
        'Description' => 'required|string',
        'Status' => 'integer', 
    ]);

    // dd($request->all());

    $category = Category::find($id);
    $category->Title = $request->Title;
    $category->Slug = $request->Slug;
    $category->Description = $request->Description;
    $category->Status = $request->Status;
    $category->save();
    return redirect()->route('category.index')->with('success', 'Category Updated Successfully');

}

public function status(Request $request, $id)
    {
        // Log::info('Received request with status: ' . $request->Status);
        $request->validate([
            'Status' => 'integer',
        ]);
        // dd($request->Status);
        $category = Category::find($id);

        if ($category) {
            // Update the status field
            $category->Status = $request->Status;
            $category->save();  // Save the changes to the database

            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

public function delete($id)
{
    Category::find($id)->delete();
    return redirect()->route('category.index')->with('success', 'Category Deleted Successfully');
}
}