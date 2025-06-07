<?php

namespace App\Http\Controllers;

use App\Models\Petty;
use Illuminate\Http\Request;

class PettyController extends Controller
{
    public function index()
    {   
        $petty = Petty::all();
        return view('masters.petty', compact('petty'));
    }
    public function addindex()
    {   
       return view('masters.add.petty_add');
    }
    public function store(Request $request)
    {     
        $request->validate([
            'petty_account_name' => 'required|string|max:255', 
        ], [
            'petty_account_name.required' => 'The Petty Account Name field is required.',
            'petty_account_name.string' => 'The Petty Account Name must be a string.',
            'petty_account_name.max' => 'The SPetty Account Name may not be greater than 255 characters.',
        ]);       

        $categoryMap = [
            'income' => 1,  
            'expense' => 2,
        ];
        Petty::create([
            'petty_account_code' => $request->input('petty_account_code'),
            'petty_account_name' => $request->input('petty_account_name'),
            'category' => $categoryMap[$request->input('category')],
            
        ]);
        return redirect()->back()->with('success', 'Petty profile saved successfully!');
    }
    public function editindex($id)
    {
        $petty = Petty::find($id);

        return view('masters.edit.petty_edit', compact('petty'));
    }
    public function edit(Request $request, $id)
    {
        $request->validate([
            'petty_account_name' => 'required|string|max:255', 
        ], [
            'petty_account_name.required' => 'The Petty Account Name field is required.',
            'petty_account_name.string' => 'The Petty Account Name must be a string.',
            'petty_account_name.max' => 'The Petty Account Name may not be greater than 255 characters.',
        ]);         
        $categoryMap = [
            'income' => 1, 
            'expense' => 2,
        ];

        $petty = Petty::findOrFail($id);
        $petty->update([
            'petty_account_code' => $request->input('petty_account_code'),
            'petty_account_name' => $request->input('petty_account_name'),
            'category' => $categoryMap[$request->input('category')],
        ]);

        return redirect()->back()->with('success', 'Petty profile updated successfully!');
    }
    public function delete($id)
    {
        try {
            $staff = Petty::findOrFail($id);

            $staff->delete();

            return redirect()->back()->with('success', 'Petty updated successfully.');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete staff'], 500);
        }
    }
}
