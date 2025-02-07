<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permission=Permission::paginate(5);
        return view('Back.Permission.index',compact('permission'));
    }

    public function create()
    {
     
        return view('Back.Permission.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'Name' => 'required|string',
            'Slug'=>'required|string'
        ]);
        $permission = new Permission();
        $permission->Name = $request->Name;
        $permission->Slug = $request->Slug;
        $permission->save();
        return redirect()->route('permission.index')->with('success', $request->Name.'/n'.'Permission Created Successfully');
    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        return view('Back.Permission.edit', compact('permission'));
    }
}
