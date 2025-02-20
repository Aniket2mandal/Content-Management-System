<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Userimage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $user = User::with('userimage')->where('email', '!=', 'super@gmail.com')->where('email','!=',auth()->user()->email)->latest()->paginate(20);
        return view('backend.user.index', compact('user'));
    }

    public function create()
    {
        $user = null;
        $roles = Role::all();
        return view('backend.user.create', compact('roles', 'user'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'Name' => 'required|string',
            'Email' => 'required|email',
            'password' => 'required|min:8|confirmed', // No need for custom rules here
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'Status' => 'integer',
            'Role' => 'required|string'
        ]);

        // dd($request->Role);
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/user'), $imageName);
        } else {
            $imageName = null;
        }

        // dd($request->all());
        $user = new User;
        $user->Name = $request->Name;
        $user->Email = $request->Email;
        $user->password = Hash::make($request->password);
        if (!$request->Role) {
            $user->assignRole('user');
        }
        $user->assignRole($request->Role);
        $user->Status = $request->Status;
        $user->save();

        $image = new Userimage;
        $image->user_id = $user->id;
        $image->image = $imageName;
        $image->save();
        return redirect()->route('user.index')->with('success', $request->Name . ' ' . 'User Created Successfully with Role');
    }

    public function status(Request $request, $id)
    {

        $request->validate([
            'Status' => 'integer',
        ]);
        // dd($request->Status);
        $user = User::find($id);
        // dd($user->id);
        if ($user) {
            // Update the status field
            $user->Status = $request->Status;
            $user->save();  // Save the changes to the database
            return response()->json(['success' => true]);
            // Check if the status is being set to inactive
            if ($request->Status == 0) {  // Assuming 0 means inactive
                DB::table('sessions')->where('user_id', $user->id)->delete();
                  // Log out the user
                return response()->json(['success' => true, 'logout' => true]);
            }
        }
    
        return response()->json(['success' => false], 404);
    }

    public function edit($id)
    {
        $user = User::with('userimage')->find($id);
        // dd($user->roles);
        $roles = Role::all();
        return view('backend.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        if ($request->password) {
            $request->validate([
                'Name' => 'required|string',
                'Email' => 'required|email',
                'password' => '|min:8|confirmed', // No need for custom rules here
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'existing_image' => 'nullable|string',
                'Status' => 'integer',
                'Role' => 'required|string'
            ]);
        } else {
            $request->validate([
                'Name' => 'required|string',
                'Email' => 'required|email',
                // 'password' => '|min:8|confirmed', // No need for custom rules here
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'existing_image' => 'nullable|string',
                'Status' => 'integer',
                'Role' => 'required|string'
            ]);
        }
        // dd($request->Role);
        //  dd($request->existing_image);
        $user = User::find($id);
        // dd($user->password);

        if ($request->hasFile('image')) {
            if ($user->userimage && file_exists(public_path('images/user') . $user->userimage->image)) {
                if (is_file(public_path('images/user') . '/' . $user->userimage->image)) {
                    unlink(public_path('images/user') . '/' . $user->userimage->image); // Delete the old image
                }
                // unlink(public_path('images'). $user->userimage->image); // Delete the old image
            }
            // Store the new image
            // $imageName = $request->file('image')->store('images', 'public');
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/user'), $imageName);
        } else {
            $imageName = $request->input('existing_image');
        }
        // dd($request->all());

        $user->Name = $request->Name;
        $user->Email = $request->Email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
            DB::table('sessions')->where('user_id', $user->id)->delete();
        }
        if ($user->roles->isNotEmpty()) {
            // Remove the first role in the collection
            $user->removeRole($user->roles->first());
            $user->assignRole($request->Role);
        }
        $user->assignRole($request->Role);
        $user->Status = $request->Status;
        $user->save();

        $image = Userimage::where('user_id', $id)->first();
        if ($image) {
            $image->image = $imageName;
            $image->save();
        } else {
            $image = new Userimage;
            $image->user_id = $id;
            $image->image = $imageName;
            $image->save();
        }

        return redirect()->route('user.index')->with('success', $request->Name . ' ' . 'User Updated Successfully with Role');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User Deleted Successfully');
    }
}
