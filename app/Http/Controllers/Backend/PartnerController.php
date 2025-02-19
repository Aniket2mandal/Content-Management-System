<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PartnerController extends Controller
{
    public function index()
    {
        $partnerdata = Partner::all();
        $partners = getLatestPartners(); // Fetch testimonials using helper function
        return view('backend.partner.index', compact('partners', 'partnerdata'));
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

        $partner = new Partner;
        $partner->name = $request->name;
        $partner->url = $request->url;
        $partner->image = $imagePath;
        $partner->published = $request->Status;
        $partner->save();
        if ($request->Status == 1) {
            $partnerdata = Partner::where('published', 1)->latest()->first();
            // dd($request->all());
            $newPartner = [];
            if ($partnerdata) {
                $newPartner = [
                    'db_id' => $partnerdata->id,
                    'name' => $partnerdata->name,
                    'url' => $partnerdata->url,
                    'image' => $imagePath,
                    'published' => $partnerdata->published ?? 0
                ];
            }
            // dd($newPartner);
            savePartners($newPartner);
        }
        return redirect()->route('partner.index')->with('success', 'Partner created successfully!');
    }

    public function statusUpdate(Request $request, $id)
    {
        //   Log::info('Received request for testimonial ID: ' . $id);
        //     Log::info('Received status: ' . $request->Status);
        $request->validate([
            'Status' => 'integer',
        ]);
        $partner = Partner::find($id);
        $partner->published = $request->Status;
        $partner->save();

        $newPartner = [
            'db_id' => $id,
            'published' => $request->Status
        ];
        // dd($newPartner);
        // Log::info('Received array:', $newPartner);
        updatePartnersStatus($newPartner);
        if ($partner) {
            return response()->json(['success' => 'Partner status updated successfully!']);
        } else {
            return response()->json(['success' => 'Fail to update status ']);
        }
    }

    public function edit($id)
    {

        // $newPartner=[
        //     'id'=>$id
        // ];
        $partner = Partner::find($id);
        // $partner=editPartners($newPartner);
        // dd($partner);
        if ($partner) {
            return view('backend.partner.edit', compact('partner'));
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
            $imagePath = $request->file('image')->store('partners', 'public');
        } else {
            $imagePath = null;
        }

        $partner = Partner::find($id);
        // dd($testimonial);
        $partner->name = $request->name;
        $partner->url = $request->url;
        $partner->image = $imagePath;
        $partner->published = $request->Status;
        $partner->save();
        $newPartner = [];
        if ($partner) {
            $newPartner = [
                'db_id' => $partner->id,
                'name' => $partner->name,
                'url' => $partner->url,
                'image' => $imagePath,
                'published' => $partner->published ?? 0
            ];
            updatePartners($newPartner);
        }
        if ($partner) {
            // Log::info('Testimonial updated successfully!');
            return redirect()->route('partner.index')->with('success', 'partner updated successfully!');
        } else {
            // Log::error('Error updating testimonial: ' . $result);
            return redirect()->back()->with('error', 'Error updating partner: ');
        }
    }

    public function delete($id)
    {

        $partner = Partner::find($id);
        $partner->delete();
        $newPartner = [
            'db_id' => $id,
        ];

        deletePartners($newPartner);
        if ($partner) {
            // Log::info('Testimonial updated successfully!');
            return redirect()->route('partner.index')->with('success', 'partner deleted successfully!');
        } else {
            // Log::error('Error updating testimonial: ' . $result);
            return redirect()->back()->with('error', 'Error deleting partner: ');
        }
    }
}
