<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {   
        $role = Role::all();
        return view('masters.role', compact('role'));
    }
    public function addindex()
    {   
        return view('masters.add.role');
    }
    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
        ], [
            'role_name.required' => 'The Role Name field is required.',
            'role_name.string' => 'The Role Name must be a string.',
            'role_name.max' => 'The Role Name may not be greater than 255 characters.',
        ]);
        
        Role::create([
            'role_id' => $request->input('role_id'),
            'role_name' => $request->input('role_name')
        ]);
    
        return redirect()->back()->with('success', 'Company profile saved successfully!');
    }

    public function editindex($id)
    {
        $role = Role::find($id);

        return view('masters.edit.role_edit', compact('role'));
    }
    public function edit(Request $request, $id)
    {

        $request->validate([
            'role_name' => 'required|string|max:255',
        ], [
            'role_name.required' => 'The Role Name field is required.',
            'role_name.string' => 'The Role Name must be a string.',
            'role_name.max' => 'The Role Name may not be greater than 255 characters.',
        ]);
        Role::where('_id', $id)->update([
            'role_id' => $request->input('role_id'),
            'role_name' => $request->input('role_name')
        ]);

        return redirect()->route('role.index')->with('success', 'Role updated successfully');
    }
    public function delete($id)
    {
        try {
            $role = Role::findOrFail($id);

            $role->delete();

            return redirect()->back()->with('success', 'role updated successfully.');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete role'], 500);
        }
    }
}
