<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliderdata = Slider::all();
        $sliders = getLatestSliders(); // Fetch testimonials using helper function
        return view('backend.slider.index', compact('sliders', 'sliderdata'));
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

        $slider = new Slider;
        $slider->name = $request->name;
        $slider->url = $request->url;
        $slider->image = $imagePath;
        $slider->published = $request->Status;
        $slider->save();
        if ($request->Status == 1) {
            $sliderdata = Slider::where('published', 1)->latest()->first();
            // dd($request->all());
            $newSlider = [];
            if ($sliderdata) {
                $newSlider = [
                    'db_id' => $sliderdata->id,
                    'name' => $sliderdata->name,
                    'url' => $sliderdata->url,
                    'image' => $imagePath,
                    'published' => $sliderdata->published ?? 0
                ];
            }
            // dd($newPartner);
            saveSliders($newSlider);
        }
        // dd($newPartner);

        return redirect()->route('slider.index')->with('success', 'Slider created successfully!');
    }

    public function statusUpdate(Request $request, $id)
    {
        //   Log::info('Received request for testimonial ID: ' . $id);
        //     Log::info('Received status: ' . $request->Status);

        $request->validate([
            'Status' => 'integer',
        ]);
        $slider = Slider::find($id);
        $slider->published = $request->Status;
        $slider->save();
        $newSlider = [
            'db_id' => $id,
            'published' => $request->Status
        ];

        // dd($newPartner);
        // Log::info('Received array:', $newPartner);
        updateSlidersStatus($newSlider);
        if ($slider) {
            return response()->json(['success' => 'Slider status updated successfully!']);
        } else {
            return response()->json(['success' => 'Fail to update status ']);
        }
    }

    public function edit($id)
    {
        // $newSlider=[
        //     'id'=>$id
        // ];
        // $slider=editSliders($newSlider);
        $slider = Slider::find($id);
        if ($slider) {
            return view('backend.slider.edit', compact('slider'));
        }
    }


    public function update(Request $request, $id)
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
        $slider = Slider::find($id);
        // dd($testimonial);
        $slider->name = $request->name;
        $slider->url = $request->url;
        $slider->image = $imagePath;
        $slider->published = $request->Status;
        $slider->save();
        $newSlider = [];
        if ($slider) {
            $newSlider = [
                'db_id' => $slider->id,
                'name' => $slider->name,
                'url' => $slider->url,
                'image' => $imagePath,
                'published' => $slider->published ?? 0
            ];
            updateSliders($newSlider);
        }

        if ($slider) {
            // Log::info('Testimonial updated successfully!');
            return redirect()->route('slider.index')->with('success', 'slider updated successfully!');
        } else {
            // Log::error('Error updating testimonial: ' . $result);
            return redirect()->back()->with('error', 'Error updating slider: ');
        }
    }


    public function delete($id)
    {
        $slider = Slider::find($id);
        $slider->delete();

        $newSlider = [
            'db_id' => $id,
        ];

        deleteSliders($newSlider);
        if ($slider) {
            // Log::info('Testimonial updated successfully!');
            return redirect()->route('slider.index')->with('success', 'slider deleted successfully!');
        } else {
            // Log::error('Error updating testimonial: ' . $result);
            return redirect()->back()->with('error', 'Error deleting slider: ');
        }
    }
}
