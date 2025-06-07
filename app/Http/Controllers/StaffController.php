<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Staff;
use App\Models\warehouse;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::with('role', 'warehouse')->get();
        return view('masters.staff', compact('staff'));
    }
    public function addindex()
    {   
        $role = Role::all();
        $warehouse = warehouse::all();
        return view('masters.add.staff_add', ['role' => $role, 'warehouse' =>$warehouse]);
    }
    public function store(Request $request)
    {            
        $request->validate([
            'staff_name' => 'required|string|max:255',
            'mobile' => 'required|digits:10', 
        ], [
            'staff_name.required' => 'The Staff Name field is required.',
            'staff_name.string' => 'The Staff Name must be a string.',
            'staff_name.max' => 'The Staff Name may not be greater than 255 characters.',
            'mobile.required' => 'The Mobile Number field is required.',
            'mobile.digits' => 'The Mobile Number must be a 10-digit number.',
        ]);
        Staff::create([
            'staff_id' => $request->input('staff_id'),
            'staff_name' => $request->input('staff_name'),
            'role_id' => $request->input('role'),
            'warehouse_code' => $request->input('warehouse'),
            'address' => $request->input('address'),
            'mobile' => $request->input('mobile'),
            'email' => $request->input('email'),
            
        ]);
        return redirect()->back()->with('success', 'Staff profile saved successfully!');
    }
    public function editindex($id)
    {
        $staff = Staff::find($id);
        $role = Role::all();
        $warehouse = warehouse::all();

        return view('masters.edit.staff_edit', compact('staff', 'role', 'warehouse'));
    }
    public function edit(Request $request, $id)
    {
        $request->validate([
            'staff_name' => 'required|string|max:255',
            'mobile' => 'required|digits:10', 
        ], [
            'staff_name.required' => 'The Staff Name field is required.',
            'staff_name.string' => 'The Staff Name must be a string.',
            'staff_name.max' => 'The Staff Name may not be greater than 255 characters.',
            'mobile.required' => 'The Mobile Number field is required.',
            'mobile.digits' => 'The Mobile Number must be a 10-digit number.',
        ]);
        Staff::where('_id', $id)->update([
            'staff_id' => $request->input('staff_id'),
            'staff_name' => $request->input('staff_name'),
            'role_id' => $request->input('role'),
            'warehouse_code' => $request->input('warehouse'),
            'address' => $request->input('address'),
            'mobile' => $request->input('mobile'),
            'email' => $request->input('email'),
        ]);
        return redirect()->route('staff.index')->with('success', 'Staff updated successfully');
    }
    public function delete($id)
    {
        try {
            $staff = Staff::findOrFail($id);

            $staff->delete();

            return redirect()->back()->with('success', 'staff updated successfully.');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete staff'], 500);
        }
    }
}
