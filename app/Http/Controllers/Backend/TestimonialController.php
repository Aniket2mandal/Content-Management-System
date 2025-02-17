<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = getLatestTestimonials(); // Fetch testimonials using helper function
        return view('backend.testimonial.index', compact('testimonials'));
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

        // Prepare testimonial data
        $newTestimonial = [
            'name' => $request->name,
            'message' =>  \strip_tags($request->message),
            'image' => $imagePath,
            'published' => $request->Status ?? 0
        ];

        // Use helper function to save testimonial
        saveTestimonials($newTestimonial);

        return redirect()->route('testimonial.index')->with('success', 'Testimonial created successfully!');
    }

    public function edit($id)
    {
        $newTestimonial = [
            'id' => $id,
        ];
        $testimonial = editTestimonials($newTestimonial);
        if ($testimonial) {
            return view('backend.testimonial.edit', compact('testimonial'));
        }
    }


    public function update(Request $request, $id)
    {
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

        // Prepare the testimonial data
        $newTestimonial = [
            'id' => $id,
            'name' => $request->name,
            'message' => \strip_tags($request->message),
            'image' => $imagePath,
            'published' => $request->Status ?? 0
        ];
        // Log::info('Updating testimonial:', $newTestimonial);

        // Call the update function
        $result = updateTestimonials($newTestimonial);
        // Log::info('Testimonial update result:', ['result' => $result]);
        if ($result === true) {
            // Log::info('Testimonial updated successfully!');
            return redirect()->route('testimonial.index')->with('success', 'Testimonial updated successfully!');
        } else {
            // Log::error('Error updating testimonial: ' . $result);
            return redirect()->back()->with('error', 'Error updating testimonial: ' . $result);
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

        // dd($request->Status);
        $newTestimonialStatus = [
            'id' => $id,
            'published' => $request->Status
        ];
        $updated = updateTestimonialsStatus($newTestimonialStatus);

        if ($updated) {
            return response()->json(['success' => 'Testimonial status updated successfully!']);
        } else {
            return response()->json(['error' => 'Testimonial not found!'], 404);
        }
    }

    public function delete($id)
    {
        $newTestimonial = [
            'id' => $id,
            // 'published' => $request->Status
        ];

        $deleted = deleteTestimonials($newTestimonial);
        if ($deleted) {
            return response()->json(['success' => 'Testimonial status updated successfully!']);
        } else {
            return response()->json(['error' => 'Testimonial not found!'], 404);
        }
    }
}
