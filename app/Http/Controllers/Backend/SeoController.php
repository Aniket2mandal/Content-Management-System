<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use Illuminate\Http\Request;
use PDO;

class SeoController extends Controller
{
    public function index()
    {
        $fields = Seo::all();  
        return view('backend.seo.information',compact('fields'));
    }

    public function create()
    {

        return view('backend.seo.createfield');
    }

    public function fieldstore(Request $request)
    {

        $request->validate([
            'field_type' => 'required|array',
            'label_name' => 'required|array',
            'field_name' => 'required|array',
            'field_name.*' => 'regex:/^[a-z0-9_]+$/'
        ]);
        // dd($request->all());
        for ($i = 0; $i < count($request->field_type); $i++) {
            $seo = new Seo;
            $seo->field_type = $request->field_type[$i];  // Store the field type
            $seo->label_name = $request->label_name[$i];  // Store the label name
            $seo->field_name = $request->field_name[$i];  // Store the field name
            $seo->save();  // Save the record
        }
      return redirect()->route('seo.infocreate')->with('success', 'Field Created Successfully');
    }
}
