<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use HTMLPurifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonialdata = Testimonial::latest()->paginate(20);
        $testimonials = getLatestTestimonials(); // Fetch testimonials using helper function
        return view('backend.testimonial.index', compact('testimonials', 'testimonialdata'));
    }

    public function create()
    {
        return view('backend.testimonial.create');
    }

    public function store(Request $request)
    {
        // Validate form data
        $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'Status' => 'integer'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('testimonials', 'public');
        } else {
            $imagePath = null;
        }
        $purifier = new HTMLPurifier();
        $cleanDescription = $purifier->purify($request->message);
        
        $testimonial = new Testimonial;
        $testimonial->name = $request->name;
        $testimonial->message = $cleanDescription;
        $testimonial->image = $imagePath;
        $testimonial->published = $request->Status;
        $testimonial->save();

        if ($request->Status == 1) {
            $testimonialdata = Testimonial::where('published', 1)->latest()->first();
            // dd($testimonialdata);
            // Initialize $newTestimonial
            $newTestimonial = [];

            if ($testimonialdata) {
                $newTestimonial = [
                    'db_id' => $testimonialdata->id,  // Corrected from $testimonial->id to $testimonialdata->id
                    'name' => $testimonialdata->name,
                    'message' => $cleanDescription,
                    'image' => $testimonialdata->image,  // Adjust based on how your images are stored
                    'published' => $testimonialdata->published ?? 0,
                ];
            }
            // Use helper function to save testimonial
            saveTestimonials($newTestimonial);
        }
        return redirect()->route('testimonial.index')->with('success', 'Testimonial created successfully!');
    }


    public function edit($id)
    {
        // dd($id);
        // $newTestimonial = [
        //     'id' => $id,
        // ];
        $testimonial = Testimonial::find($id);
        // dd($testimonial);
        // $testimonial = editTestimonials($newTestimonial);
        if ($testimonial) {
            return view('backend.testimonial.edit', compact('testimonial'));
        }
    }


    public function update(Request $request, $id)
    {
        // dd($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'Status' => 'nullable|integer'
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('testimonials', 'public');
        } else {
            $imagePath = null; // If no image is uploaded, keep it null
        }

        $purifier = new HTMLPurifier();
        $cleanDescription = $purifier->purify($request->message);
        $testimonial = Testimonial::find($id);
        // dd($testimonial);
        $testimonial->name = $request->name;
        $testimonial->message = $cleanDescription;
        $testimonial->image = $imagePath;
        $testimonial->published = $request->Status;
        $testimonial->save();
        // Prepare the testimonial data
        $newTestimonial = [];
        // dd($testimonial);
        if ($testimonial) {
            $newTestimonial = [
                'db_id' => $testimonial->id,  // Corrected from $testimonial->id to $testimonialdata->id
                'name' => $testimonial->name,
                'message' => $cleanDescription,
                'image' => $testimonial->image,  // Adjust based on how your images are stored
                'published' => $testimonial->published ?? 0,
            ];
        }
        // Log::info('Updating testimonial:', $newTestimonial);
        // Call the update function
        $result = updateTestimonials($newTestimonial);
        // Log::info('Testimonial update result:', ['result' => $result]);

        if ($testimonial) {
            // Log::info('Testimonial updated successfully!');
            return redirect()->route('testimonial.index')->with('success', 'Testimonial updated successfully!');
        } else {
            // Log::error('Error updating testimonial: ' . $result);
            return redirect()->back()->with('error', 'Error updating testimonial: ' . $result);
        }
        if ($result) {
            return response()->json(['success' => 'Testimonial  updated successfully!']);
        }
    }


    // TO UPDATE THE STATUS OF POST
    public function statusUpdate(Request $request, $id)
    {
        // dd($id);
        // Log::info('Received request for testimonial ID: ' . $id);
        // Log::info('Received status: ' . $request->Status);
        $request->validate([
            'Status' => 'integer',
        ]);
        $testimonial = Testimonial::find($id);
        // Update the status field
        $testimonial->published = $request->Status;
        $testimonial->save();
        // dd($request->Status);
        $newTestimonialStatus = [
            'db_id' => $id,
            'published' => $request->Status
        ];

        $updated = updateTestimonialsStatus($newTestimonialStatus);
        if ($testimonial) {
            return response()->json(['success' => 'Testimonial status updated successfully!']);
        } else {
            return response()->json(['error' => 'Testimonial not found!'], 404);
        }
    }


    public function delete($id)
    {
        $testimonial = Testimonial::find($id);
        $testimonial->delete();
        $newTestimonial = [
            'db_id' => $id,
            // 'published' => $request->Status
        ];

        $deleted = deleteTestimonials($newTestimonial);
        if ($deleted) {
            return response()->json(['success' => 'Testimonial deleted successfully!']);
        } else {
            return response()->json(['error' => 'Testimonial not found!'], 404);
        }
    }
}
