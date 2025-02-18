<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
class PartnerController extends Controller
{
    public function index()
    {
       
        $partners = getLatestPartners(); // Fetch testimonials using helper function
        return view('backend.partner.index', compact('partners'));
    }


    public function create()
    {
        return view('backend.partner.create');
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
            $imagePath = $request->file('image')->store('partners', 'public');
        } else {
            $imagePath = null;
        }
        // dd($request->all());
        $newPartner = [
            'name' => $request->name,
            'url' => $request->url,
            'image' => $imagePath,
            'published' => $request->Status ?? 0
        ];
        // dd($newPartner);
        savePartners($newPartner);
        return redirect()->route('partner.index')->with('success', 'Partner created successfully!');
    }

    public function statusUpdate(Request $request,$id){
    //   Log::info('Received request for testimonial ID: ' . $id);
    //     Log::info('Received status: ' . $request->Status);
        $newPartner = [
            'id' => $id,
            'published'=>$request->Status
        ];
        // dd($newPartner);
        // Log::info('Received array:', $newPartner);

        $partner=updatePartnersStatus($newPartner);
        if($partner){
            return response()->json(['success' => 'Partner status updated successfully!']);
        }
        else{
            return response()->json(['success' => 'Fail to update status ']);
        }
    }

    public function edit($id){
        $newPartner=[
            'id'=>$id
        ];

        $partner=editPartners($newPartner);
        // dd($partner);
        if($partner){
            return view('backend.partner.edit', compact('partner'));
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
            $imagePath = $request->file('image')->store('partners', 'public');
        } else {
            $imagePath = null;
        }
        $newPartner = [
            'id'=>$id,
            'name' => $request->name,
            'url' => $request->url,
            'image' => $imagePath,
            'published' => $request->Status ?? 0
        ];
        $partner=updatePartners($newPartner);
        if ($partner === true) {
            // Log::info('Testimonial updated successfully!');
            return redirect()->route('partner.index')->with('success', 'partner updated successfully!');
        } else {
            // Log::error('Error updating testimonial: ' . $result);
            return redirect()->back()->with('error', 'Error updating partner: ');
        }
    }

    public function delete($id){
     $newPartner=[
        'id'=>$id,
     ];

     $partner=deletePartners($newPartner);
     if ($partner === true) {
        // Log::info('Testimonial updated successfully!');
        return redirect()->route('partner.index')->with('success', 'partner deleted successfully!');
    } else {
        // Log::error('Error updating testimonial: ' . $result);
        return redirect()->back()->with('error', 'Error deleting partner: ');
    }
    }
}
