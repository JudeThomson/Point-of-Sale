<?php

namespace App\Http\Controllers;

use App\Models\vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {   $vendor = vendor::all();
        return view('masters.vendor', compact('vendor'));
    }
    public function addindex()
    {   
        return view('masters.add.vendoradd');
    }
    public function store(Request $request)
    {
        vendor::create([
            'vendor_code' => $request->input('vendor_code'),
            'vendor_name' => $request->input('vendor_name'),
            'address' => $request->input('address'),
            'mobile' => $request->input('mobile'),
            'email' => $request->input('mail')
        ]);
    
        return redirect()->back()->with('success', 'Company profile saved successfully!');
    }
    public function editindex($id)
    {
        $vendor = vendor::find($id);

        return view('masters.edit.vendor_edit', compact('vendor'));
    }
    public function edit(Request $request, $id)
    {

        vendor::where('_id', $id)->update([
            'vendor_code' => $request->input('vendor_code'),
            'vendor_name' => $request->input('vendor_name'),
            'address' => $request->input('address'),
            'mobile' => $request->input('mobile'),
            'email' => $request->input('email')
        ]);

        return redirect()->route('vendor.index')->with('success', 'Vendor updated successfully');
    }
    public function delete($id)
    {
        try {
            $vendor = vendor::findOrFail($id);

            $vendor->delete();

            return redirect()->back()->with('success', 'vendor updated successfully.');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete vendor'], 500);
        }
    }
}
