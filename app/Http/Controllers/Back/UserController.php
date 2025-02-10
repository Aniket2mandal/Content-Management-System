<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Userimage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $user = User::with('userimage')->paginate(20);
        return view('Back.User.index', compact('user'));
    }
    public function create()
    {
        $user = null;
        $roles = Role::all();
        return view('Back.User.create', compact('roles', 'user'));
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
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = null;
        }

        // dd($request->all());
        $user = new User;
        $user->Name = $request->Name;
        $user->Email = $request->Email;
        $user->password = Hash::make($request->password);
        if (!$request->Role){
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

        if ($user) {
            // Update the status field
            $user->Status = $request->Status;
            $user->save();  // Save the changes to the database

            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

    public function edit($id)
    {
        $user = User::with('userimage')->find($id);
        // dd($user->roles);
        $roles = Role::all();
        return view('Back.User.create', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Name' => 'required|string',
            'Email' => 'required|email',
            // 'password' => 'required|min:8|confirmed', // No need for custom rules here
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'existing_image' => 'nullable|string',
            'Status' => 'integer',
            'Role' => 'required|string'
        ]);
        // dd($request->Role);
        //  dd($request->existing_image);
        $user = User::find($id);
      
        if ($request->hasFile('image')) {
            if ($user->userimage && file_exists(public_path('images'). $user->userimage->image)){
                if (is_file(public_path('images') . '/' . $user->userimage->image)) {
                    unlink(public_path('images') . '/' . $user->userimage->image); // Delete the old image
                }
                // unlink(public_path('images'). $user->userimage->image); // Delete the old image
            }
            // Store the new image
            // $imageName = $request->file('image')->store('images', 'public');
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = $request->input('existing_image');
        }
        // dd($request->all());

        $user->Name = $request->Name;
        $user->Email = $request->Email;
        // $user->Password = bcrypt($request->Password);
        if ($user->roles->isNotEmpty()) {
            // Remove the first role in the collection
            $user->removeRole($user->roles->first());
            $user->assignRole($request->Role);
        }
        $user->assignRole($request->Role);
        // if ($request->has('Role') && !empty($request->Role)) {
        //     // $user->removeRole($user->roles);
        //     $user->assignRole($request->Role);
        // }
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
