<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyProfile;
use App\Http\Controllers\view;

class CompanyProfileController extends Controller
{
    public function index()
    {   
        $companyProfile = CompanyProfile::latest('_id')->first();
        return view('masters.company_profile', compact('companyProfile'));
    }
    public function store(Request $request)
    {
        CompanyProfile::create([
            'company_name' => $request->input('company_name'),
            'address1' => $request->input('address_one'),
            'address2' => $request->input('address_two'),
            'address3' => $request->input('address_three'),
            'mobile' => $request->input('mobile'),
            'email' => $request->input('mail'),
            'phone' => $request->input('phone'),
            'website' => $request->input('website'),
            'person_name' => $request->input('preson'),
            'company_reg_no' => $request->input('reg'),
            'currency' => $request->input('currency'), 
            'tin_no' => $request->input('gst'),
        ]);
    
        // Redirect back or to a success page
        return redirect()->back()->with('success', 'Company profile saved successfully!');
    }
}
