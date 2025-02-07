<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostAuthor;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // FOR POLICY
     $this->authorize('viewany',Post::class);
        // $post = Post::paginate(5);
        $post = Post::with('authors', 'categories')->paginate(5);
        return view('Back.Post.index', compact('post'));
    }

    //FOR CREATING POSTS
    public function create()
    {
        $category = Category::all();
        $author = Author::all();
        return view('Back.Post.create', compact('category', 'author'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // $this->authorize('create',Post::class);

        $request->validate([
            'Title' => 'required|string',
            'Description' => 'required|string',
            'Summary' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'Status' => 'integer',
            'Category' => 'required|string',
            'Author' => 'required|integer',

        ]);
        // dd($request->file('image'));
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = null;
        }

        $post = new Post();
        $post->Title = $request->Title;
        $post->Description = $request->Description;
        $post->Summary = $request->Summary;
        $post->Status = $request->Status;
        $post->image = $imageName;
        $post->save();

        $post_author = new PostAuthor();
        $post_author->post_id = $post->id;
        $post_author->author_id = $request->Author;
        $post_author->save();

        $post_category = new PostCategory();
        $post_category->post_id = $post->id;
        $post_category->category_id = $request->Category;
        $post_category->save();

        return redirect()->route('post.index')->with('success', 'Post Created Successfully');
    }


    // FOR UPDATING POSTS
    public function edit($id)
    {
        // dd($id);
        $post = Post::find($id);
        $category = Category::all();
        $author = Author::all();
        return view('Back.Post.edit', compact('post', 'category', 'author'));
    }

    public function update(Request $request, $id)
    {
      
        
        // dd($request->all());
        $request->validate([
            'Title' => 'required|string',
            'Description' => 'required|string',
            'Summary' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'Status' => 'integer',
            'Category' => 'required|string',
            'Author' => 'required|integer',

        ]);
        $post = Post::find($id);

     $this->authorize('edit',$post);
     
        // dd($request->file('image'));
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = old('image', $post->image);
        }


        if (!$post) {
            return redirect()->route('post.index')->with('error', 'Post Not Found');
        }
        $post->Title = $request->Title;
        $post->Description = $request->Description;
        $post->Summary = $request->Summary;
        $post->Status = $request->Status;
        $post->image = $imageName;
        $post->save();

        // FOR POST AUTHOR 
        $post_author = PostAuthor::where('post_id', $post->id)->first();
        if (!$post_author) {
            $post_author = new PostAuthor();
        }
        $post_author->post_id = $post->id;
        $post_author->author_id = $request->Author;
        $post_author->save();

        // FOR POST CATEGORY
        $post_category = PostCategory::where('post_id', $post->id)->first();
        if (!$post_category) {
            $post_category = new PostCategory();
        }
        $post_category->post_id = $post->id;
        $post_category->category_id = $request->Category;
        $post_category->save();

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
      
        // dd($id);
        Post::find($id)->delete();
        return redirect()->route('post.index')->with('success', 'Post Deleted Successfully');
    }
}
