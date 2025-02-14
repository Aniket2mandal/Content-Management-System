<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PDO;

class SeoController extends Controller
{
    public function index()
    {
        $fields = Seo::all();
        return view('backend.seo.information', compact('fields'));
    }

    public function create()
    {

        return view('backend.seo.createfield');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        $request->validate([
            'fields' => 'required|array',
            'fields.*.field_type' => ['required', 'string', Rule::in(['text', 'textarea', 'number'])],
            'fields.*.label_name' => 'required|string|max:255',
            'fields.*.field_name' => 'required|string|regex:/^[a-z0-9_]+$/',
        ]);
        // dd($request->all());
        //     'field_type' => 'required|array',
        //     'label_name' => 'required|array',
        //     'field_name' => 'required|array',
        //     'field_name.*' => 'regex:/^[a-z0-9_]+$/'
        // ]);
        // dd($request->all());
        foreach ($request->fields as $field) {
            $seo = new Seo;
            // $fieldName = str_replace('"', '', $request->field_name[$i]);
            $seo->field_type = $field['field_type'];  // Store the field type
            $seo->label_name = $field['label_name'];  // Store the label name
            $cleanedFieldName = str_replace('"', '', $field['field_name']);
            $seo->field_name = $cleanedFieldName;  // Store the field name
            $seo->save();  // Save the record
        }
        return redirect()->route('seo.infocreate')->with('success', 'Field Created Successfully');
    }

    public function update(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'fields' => 'required|array',
            'fields.*.value' => 'nullable|string|max:255', // Adjust based on your database column type
        ]);
        // dd($request->all());
        // Loop through each field to update
        foreach ($request->fields as $field_name => $data) {
            // Get value or fallback to default
            $value = $data['value'] ?? 'default value';
            $field = preg_replace('/^"|"$/', '', $field_name);
            // dd($field);

            // Find SEO field by field_name
            $seo = Seo::where('field_name',   $field)->first();
            dd($seo);
            // If the field exists, update its value
            if ($seo) {
                $seo->update([
                    'value' => $value,
                ]);
            }
        }

        return redirect()->route('seo.infocreate')->with('success', 'Fields Updated Successfully');
    }



    public function delete($id)
    {
        $seo = Seo::find($id);
        if ($seo) {
            $seo->delete();
            return response()->json(['success' => true], 200);
        }
        //   return response()->json(['success' => false], 404);
    }
}
