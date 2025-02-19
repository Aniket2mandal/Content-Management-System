<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostAuthor;
use App\Models\PostCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index()
    {
      
        // FOR POLICY
        $this->authorize('viewany', Post::class);
        // $post = Post::paginate(5);
        $post = Post::with('authors', 'categories')->paginate(5);
        return view('backend.post.index', compact('post'));
     
    }

    //FOR CREATING POSTS
    public function create()
    {
        try{
        $category = Category::where('Status', 1)->get();
        // dd($category);
        $author = Author::where('Status', 1)->get();
        return view('backend.post.create', compact('category', 'author'));
        }catch (\Exception $exception) {
            Log::channel('user')->error('User Error', [
                'user_id' => auth()->id(),
                'email' => auth()->user()->email ?? 'N/A',
                'error_message' => $exception->getMessage(),
                'error_line' => $exception->getLine(),
                'error_file' => $exception->getFile(),
                // 'stack_trace' => $exception->getTraceAsString(),
            ]);
    
            return response()->view('backend.errors.error', [
                'loggerdata' => [
                    'user_id' => auth()->id(),
                    'email' => auth()->user()->email ?? 'N/A',
                    'error_message' => $exception->getMessage(),
                    'error_line' => $exception->getLine(),
                    'error_file' => $exception->getFile(),
                    // 'stack_trace' => $exception->getTraceAsString(),
                ]
            ]);
        }
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // $this->authorize('create',Post::class);
try{
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
            $request->image->move(public_path('images/post'), $imageName);
        } else {
            $imageName = null;
        }

        $post = new Post();
        $post->Title = $request->Title;
        $post->Description = \strip_tags($request->Description);
        $post->Summary = \strip_tags($request->Summary);
        $post->Status = $request->Status;
        $post->image = $imageName;
        $post->save();

        // Sync Categories (Assuming Category IDs are passed in the request)
        $post->categories()->sync($request->Category);

        // Sync Authors (Assuming Author IDs are passed in the request)
        $post->authors()->sync($request->Author);

        return redirect()->route('post.index')->with('success', 'Post Created Successfully');
    }catch (\Exception $exception) {
        Log::channel('user')->error('User Error', [
            'user_id' => auth()->id(),
            'email' => auth()->user()->email ?? 'N/A',
            'error_message' => $exception->getMessage(),
            'error_line' => $exception->getLine(),
            'error_file' => $exception->getFile(),
            // 'stack_trace' => $exception->getTraceAsString(),
        ]);

        return response()->view('backend.errors.error', [
            'loggerdata' => [
                'user_id' => auth()->id(),
                'email' => auth()->user()->email ?? 'N/A',
                'error_message' => $exception->getMessage(),
                'error_line' => $exception->getLine(),
                'error_file' => $exception->getFile(),
                // 'stack_trace' => $exception->getTraceAsString(),
            ]
        ]);
    }
    }



    // FOR UPDATING POSTS
    public function edit($id)
    {
        try{
        // dd($id);
        // dd(auth()->user()->permissions);
        $post = Post::find($id);

        $category = Category::where('Status', 1)->get();
        // dd($category);
        $author = Author::where('Status', 1)->get();
        return view('backend.post.edit', compact('post', 'category', 'author'));
        }catch (\Exception $exception) {
            Log::channel('user')->error('User Error', [
                'user_id' => auth()->id(),
                'email' => auth()->user()->email ?? 'N/A',
                'error_message' => $exception->getMessage(),
                'error_line' => $exception->getLine(),
                'error_file' => $exception->getFile(),
                // 'stack_trace' => $exception->getTraceAsString(),
            ]);
    
            return response()->view('backend.errors.error', [
                'loggerdata' => [
                    'user_id' => auth()->id(),
                    'email' => auth()->user()->email ?? 'N/A',
                    'error_message' => $exception->getMessage(),
                    'error_line' => $exception->getLine(),
                    'error_file' => $exception->getFile(),
                    // 'stack_trace' => $exception->getTraceAsString(),
                ]
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try{
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
        $post->Description = \strip_tags($request->Description);
        $post->Summary = \strip_tags($request->Summary);
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
    }catch (\Exception $exception) {
        Log::channel('user')->error('User Error', [
            'user_id' => auth()->id(),
            'email' => auth()->user()->email ?? 'N/A',
            'error_message' => $exception->getMessage(),
            'error_line' => $exception->getLine(),
            'error_file' => $exception->getFile(),
            // 'stack_trace' => $exception->getTraceAsString(),
        ]);

        return response()->view('backend.errors.error', [
            'loggerdata' => [
                'user_id' => auth()->id(),
                'email' => auth()->user()->email ?? 'N/A',
                'error_message' => $exception->getMessage(),
                'error_line' => $exception->getLine(),
                'error_file' => $exception->getFile(),
                // 'stack_trace' => $exception->getTraceAsString(),
            ]
        ]);
    }
    }


    // TO UPDATE THE STATUS OF POST
    public function status(Request $request, $id)
    {
        try{
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
    }catch (\Exception $exception) {
        Log::channel('user')->error('User Error', [
            'user_id' => auth()->id(),
            'email' => auth()->user()->email ?? 'N/A',
            'error_message' => $exception->getMessage(),
            'error_line' => $exception->getLine(),
            'error_file' => $exception->getFile(),
            // 'stack_trace' => $exception->getTraceAsString(),
        ]);

        return response()->view('backend.errors.error', [
            'loggerdata' => [
                'user_id' => auth()->id(),
                'email' => auth()->user()->email ?? 'N/A',
                'error_message' => $exception->getMessage(),
                'error_line' => $exception->getLine(),
                'error_file' => $exception->getFile(),
                // 'stack_trace' => $exception->getTraceAsString(),
            ]
        ]);
    }
    }



    public function delete($id)
    {
        try{
        //   dd($id);
        $post =  Post::find($id);
        // $this->authorize('delete',$post);
        $post->delete();

        return response()->json(['success' => true]);
        // return redirect()->route('post.index')->with('success', 'Post Deleted Successfully');
    }catch (\Exception $exception) {
        Log::channel('user')->error('User Error', [
            'user_id' => auth()->id(),
            'email' => auth()->user()->email ?? 'N/A',
            'error_message' => $exception->getMessage(),
            'error_line' => $exception->getLine(),
            'error_file' => $exception->getFile(),
            // 'stack_trace' => $exception->getTraceAsString(),
        ]);

        return response()->view('backend.errors.error', [
            'loggerdata' => [
                'user_id' => auth()->id(),
                'email' => auth()->user()->email ?? 'N/A',
                'error_message' => $exception->getMessage(),
                'error_line' => $exception->getLine(),
                'error_file' => $exception->getFile(),
                // 'stack_trace' => $exception->getTraceAsString(),
            ]
        ]);
    }
}
}
