<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Login;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'staff_name' => 'required|string|max:255',
            'mobile' => 'required|digits:10', 
        ], [
            'staff_name.required' => 'The Staff Name field is required.',
            'staff_name.string' => 'The Staff Name must be a string.',
            'staff_name.max' => 'The Staff Name may not be greater than 255 characters.',
            'mobile.required' => 'The Mobile Number field is required.',
            'mobile.digits' => 'The Mobile Number must be a 10-digit number.',
        ]);

        // Insert into Staff table
        $staff =  Staff::create([
            'staff_id' => $request->input('staff_id'),
            'staff_name' => $request->input('staff_name'),
            'role_id' => $request->input('role'),
            'warehouse_code' => $request->input('warehouse'),
            'address' => $request->input('address'),
            'mobile' => $request->input('mobile'),
            'email' => $request->input('email'),
        ]);

        // Insert into Login table
        Login::create([
            'staff_id' => $staff->staff_id,
            'password' => bcrypt('123456'),
            'is_admin' => $request->is_admin ?? 0,
        ]);

        return redirect()->back()->with('success', 'Staff profile saved successfully!');
    }
}
