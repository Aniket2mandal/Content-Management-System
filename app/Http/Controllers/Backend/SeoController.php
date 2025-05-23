<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use PDO;

class SeoController extends Controller
{
    public function index()
    {
        $seoFields = Seo::latest()->paginate(10);
        return view('backend.seo.index', compact('seoFields'));
    }
    function create()
    {
        return view('backend.seo.createfield');
    }
    public function store(Request $request)
    {
        $request->validate([
            'fields' => 'required|array',
            'fields.*.type' => ['required', 'string', Rule::in(['text', 'textarea', 'number'])],
            'fields.*.label' => 'required|string|max:255',
            'fields.*.name' => 'required|string|regex:/^[a-z0-9_]+$/',
        ]);
        // dd($request->all());
        $names = array_column($request->fields, 'name');
        $duplicates = array_diff_assoc($names, array_unique($names));

        if (!empty($duplicates)) {
            // If there are duplicates, redirect back with an error
            return redirect()->back()->with('error', 'Duplicate names found: ' . implode(', ', $duplicates));
        }


        foreach ($request->fields as $field) {
            // dd($field['type']);
            Seo::create([
                'type' => $field['type'],
                'label' => $field['label'],
                'name' => $field['name'],
                // 'value' => null,
            ]);
        }


        return redirect()->route('seo.index')->with('success', 'Fields added successfully!');
    }

    public function fieldedit($id)
    {
        $seofield = Seo::find($id);
        return view('backend.seo.edutfield', compact('seofield'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        foreach ($request->fields as $id => $data) {
            // dd($data['value']);
            $seoField = Seo::find($id);
            // dd($seoField);
            if ($seoField) {
                //   dd($data['value']);
                $seoField->update([
                    'type' => $data['type'],
                    'label' => $data['label'],
                    'value' => \strip_tags($data['value']) ?? null,
                ]);
            }
        }

        return redirect()->route('seo.index')->with('success', 'SEO Fields updated successfully!');
    }

    public function fieldupdate(Request $request)
    {

        $fieldType = $request->fieldType;
        $id = $request->id;

        // dd($data['value']);
        $seoField = Seo::where('id', $id)->first();
        Log::info('Received request for testimonial ID: ' . $seoField);
        // dd($seoField);
        if ($seoField) {
            //   dd($data['value']);
            $seoField->update([
                'type' => $fieldType,
                // 'label' => $data['label'],
                // 'value' => \strip_tags($data['value']) ?? null,
            ]);
        }


        return redirect()->route('seo.index')->with('success', 'SEO Fields updated successfully!');
    }


    function delete($id)
    {
        $seoField = Seo::find($id);
        if ($seoField) {
            $seoField->delete();
            return response()->json(['success' => true, 'message' => 'SEO Field deleted successfully!']);
        }
        // return response()->json(['success' => true, 'message' => 'SEO Field deleted successfully!']);
    }
}
