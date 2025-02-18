<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    public function index()
    {
        
        $sliders = getLatestSliders(); // Fetch testimonials using helper function
        return view('backend.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('backend.slider.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'Status' => 'integer',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('sliders', 'public');
        } else {
            $imagePath = null;
        }
        // dd($request->all());
        $newSlider = [
            'name' => $request->name,
            'url' => $request->url,
            'image' => $imagePath,
            'published' => $request->Status ?? 0
        ];
        // dd($newPartner);
        saveSliders($newSlider);
        return redirect()->route('slider.index')->with('success', 'Slider created successfully!');
    }

    public function statusUpdate(Request $request,$id){
        //   Log::info('Received request for testimonial ID: ' . $id);
        //     Log::info('Received status: ' . $request->Status);
            $newSlider = [
                'id' => $id,
                'published'=>$request->Status
            ];
            // dd($newPartner);
            // Log::info('Received array:', $newPartner);
            $slider=updateSlidersStatus($newSlider);
            if($slider){
                return response()->json(['success' => 'Slider status updated successfully!']);
            }
            else{
                return response()->json(['success' => 'Fail to update status ']);
            }
        }

        public function edit($id){
            $newSlider=[
                'id'=>$id
            ];
            $slider=editSliders($newSlider);
            if($slider){
                return view('backend.slider.edit', compact('slider'));
            }
        }


        public function update(Request $request,$id){
            $request->validate([
                'name' => 'required|string|max:255',
                'url' => 'nullable|url|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'Status' => 'integer',
            ]);
    
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('sliders', 'public');
            } else {
                $imagePath = null;
            }
            $newSlider = [
                'id'=>$id,
                'name' => $request->name,
                'url' => $request->url,
                'image' => $imagePath,
                'published' => $request->Status ?? 0
            ];

            $slider=updateSliders($newSlider);
            if ($slider === true) {
                // Log::info('Testimonial updated successfully!');
                return redirect()->route('slider.index')->with('success', 'slider updated successfully!');
            } else {
                // Log::error('Error updating testimonial: ' . $result);
                return redirect()->back()->with('error', 'Error updating slider: ');
            }
        }
        

    public function delete($id){
     $newSlider=[
        'id'=>$id,
     ];
     
     $slider=deleteSliders($newSlider);
     if ($slider === true) {
        // Log::info('Testimonial updated successfully!');
        return redirect()->route('slider.index')->with('success', 'slider deleted successfully!');
    } else {
        // Log::error('Error updating testimonial: ' . $result);
        return redirect()->back()->with('error', 'Error deleting slider: ');
    }
    }

}
