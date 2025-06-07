<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\vehicle_expense;

class VehicleExpense extends Controller
{
    public function index()
    {   
        $VehicleExpense = vehicle_expense::all();
        return view('masters.vehicle_expense', compact('VehicleExpense'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'newExpense' => 'required|string|max:255',
        ], [
            'newExpense.required' => 'The Vehicle Expense field is required.',
            'newExpense.string' => 'The Vehicle Expense must be a string.',
            'newExpense.max' => 'The Vehicle Expense may not be greater than 255 characters.',
        ]);
        $lastExpense = vehicle_expense::orderBy('_id', 'desc')->first();

        $lastCode = ($lastExpense) ? $lastExpense->vehicle_expense_code : 'A0';

        preg_match('/(\d+)$/', $lastCode, $matches);
        $nextNumber = intval($matches[0]) + 1;

        $newexpensecode = 'RA' . $nextNumber;
        vehicle_expense::create([
            'vehicle_expense_name' => $request->input('newExpense'),
            'vehicle_expense_code' => $newexpensecode,
        ]);
    
        return redirect()->back()->with('success', 'Expense created successfully!');
    }
    public function update(Request $request)
    {
        
        $ExpenseID = $request->input('editExpense');
        $newName = $request->input('newExpense');

        $Expense = vehicle_expense::find($ExpenseID);

        if (!$Expense) {
            return redirect()->back()->with('error', 'Expense not found.');
        }
        $Expense->vehicle_expense_name = $newName;

        $Expense->save();

        return redirect()->back()->with('success', 'Expense updated successfully.');
    }
    public function delete($id)
    {
        try {
            $Expense = vehicle_expense::findOrFail($id);

            $Expense->delete();

            return redirect()->back()->with('success', 'Expense updated successfully.');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete Expense'], 500);
        }
    }
}
