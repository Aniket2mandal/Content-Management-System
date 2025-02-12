<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(20);
        // $permission=$roles->permissions;
        return view('backend.role.index',compact('roles'));
    }
    public function create()
    {
      
        $permissions=Permission::all();
        return view('backend.role.create',compact('permissions',));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'Name' => 'required|string',
            'Slug' => 'required|string',
            'Permission'=>'nullable|array'
        ]);
        // dd($request->Permission);
        // dd($request->all());
       $role=new Role;
       $role->Name=$request->Name;
       $role->Slug=$request->Slug;
       if ($request->has('Permission') && !empty($request->Permission)) {
       
        $role->syncPermissions($request->Permission);  
    }
       $role->save();
        return redirect()->route('role.index')->with('success', $request->Name.' '.'Role Created Successfully with permission');
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        return view('backend.role.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
     
        
        $request->validate([
            'Name' => 'required|string',
            'Slug' => 'required|string',
            'Permission'=>'nullable|array'
        ]);
        $role = Role::find($id);
        $role->name = $request->Name;
        $role->slug = $request->Slug;
        if ($request->has('Permission') && !empty($request->Permission)) {
            $role->syncPermissions($request->Permission);
        }
        $role->save();
        return redirect()->route('role.index')->with('success', $request->Name.' '.'Role Updated Successfully with permission');
    }

    public function delete($id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect()->route('role.index')->with('success', 'Role Deleted Successfully');
    }
}
