<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostAuthor;
use App\Models\PostCategory;
use Exception;
use HTMLPurifier;
use HTMLPurifier_Config;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index()
    {
      
        // FOR POLICY
        $this->authorize('viewany', Post::class);
        // $post = Post::paginate(5);
        $post = Post::with('authors', 'categories')->latest()->paginate(5);
        return view('backend.post.index', compact('post'));
     
    }

    //FOR CREATING POSTS
    public function create()
    {
     
        $category = Category::where('Status', 1)->get();
        // dd($category);
        $author = Author::where('Status', 1)->get();
        return view('backend.post.create', compact('category', 'author'));
        
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // $this->authorize('create',Post::class);

        $request->validate([
            'Title' => 'required|string',
            'Description' => 'required',
            'Summary' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'Status' => 'integer',
            'Category' => 'required|array',
            'Author' => 'array',

        ]);
        // dd($request->file('image'));
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/post'), $imageName);
        } else {
            $imageName = null;
        }
        $purifier = new HTMLPurifier();
        $cleanDescription = $purifier->purify($request->Description);
        $cleanSummary = $purifier->purify($request->Summary);

        $post = new Post();
        $post->Title = $request->Title;
        $post->Description = $cleanDescription;
        $post->Summary =  $cleanSummary;
        $post->Status = $request->Status;
        $post->image = $imageName;
        $post->save();

        // Sync Categories (Assuming Category IDs are passed in the request)
        $post->categories()->sync($request->Category);

        // Sync Authors (Assuming Author IDs are passed in the request)
        $post->authors()->sync($request->Author);

        return redirect()->route('post.index')->with('success', 'Post Created Successfully');

    }



    // FOR UPDATING POSTS
    public function edit($id)
    {
        
        // dd($id);
        // dd(auth()->user()->permissions);
        $post = Post::with('authors','categories')->where('Status',1)->find($id);

        $category = Category::where('Status', 1)->get();
        // dd($category);
        $author = Author::where('Status', 1)->get();
        return view('backend.post.edit', compact('post', 'category', 'author'));
        
    }

    public function update(Request $request, $id)
    {
        
        // dd($request->all());
        $request->validate([
            'Title' => 'required|string',
            'Description' => 'required',
            'Summary' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'Status' => 'integer',
            'Category' => 'required|array',
            'Author' => 'array',

        ]);

        $purifier = new HTMLPurifier();
        $cleanDescription = $purifier->purify($request->Description);
        $cleanSummary = $purifier->purify($request->Summary);
        // dd($cleanDescription);
        $post = Post::find($id);
        // CHECK THE USER IS AUTHORIZE OR NOT BEFOR EDITING POST
        //  $this->authorize('edit',$post);

        // dd($request->file('image'));
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/post'), $imageName);
        } else {
            $imageName = old('image', $post->image);
        }


        if (!$post) {
            return redirect()->route('post.index')->with('error', 'Post Not Found');
        }
        $post->Title = $request->Title;
        $post->Description = $cleanDescription ;
        $post->Summary =  $cleanSummary;
        $post->Status = $request->Status;
        $post->image = $imageName;
       
// FOR POST CATEGORY
$post->categories()->sync($request->input('Category'));
        // FOR POST AUTHOR 
        $post->authors()->sync($request->input('Author'));
        $post->save();
        // $post_author = PostAuthor::where('post_id', $post->id)->first();
        // if (!$post_author) {
        //     $post_author = new PostAuthor();
        // }
        // $post_author->post_id = $post->id;
        // $post_author->author_id = $request->Author;
        // $post_author->save();

        // FOR POST CATEGORY
        // $post_category = PostCategory::where('post_id', $post->id)->first();
        // if (!$post_category) {
        //     $post_category = new PostCategory();
        // }
        // $post_category->post_id = $post->id;
        // $post_category->category_id = $request->Category;
        // $post_category->save();

        return redirect()->route('post.index')->with('success', 'Post Updated Successfully');
    
    }


    // TO UPDATE THE STATUS OF POST
    public function status(Request $request, $id)
    {
        
        // Log::info('Received request with status: ' . $request->Status);
        $request->validate([
            'Status' => 'integer',
        ]);
        // dd($request->Status);
        $post = Post::find($id);

        if ($post) {
            // Update the status field
            $post->Status = $request->Status;
            $post->save();  // Save the changes to the database

            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);

    }



    public function delete($id)
    {
       
        //   dd($id);
        $post =  Post::find($id);
        // $this->authorize('delete',$post);
        $post->delete();

        return response()->json(['success' => true]);
        // return redirect()->route('post.index')->with('success', 'Post Deleted Successfully');
   

   
}
}
