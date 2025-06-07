<?php

namespace App\Http\Controllers;

use App\Models\VehicleMain;
use App\Models\VehicleSub;
use App\Models\vehicle_expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VehicleExpenseController extends Controller
{
    public function index()
    {   
        $expense = vehicle_expense::all();
        return view('Transactions.vehicle_expense', compact('expense'));
    }
    public function getVehicleExpenses()
    {
        $expenses = vehicle_expense::all(['vehicle_expense_code', 'vehicle_expense_name']);
        return response()->json($expenses);
    }
    public function store(Request $request)
    {
        $formattedDate = \Carbon\Carbon::createFromFormat('d/M/Y', $request->input('current_date'))->format('Y-m-d');
    
        DB::beginTransaction();
        Log::info($request->all());
    
        try {
            $vehicleMain = VehicleMain::create([
                'date_field' => $formattedDate,
                'vehicle_no' => $request->input('vehicle_no'),
                'vehicle_expense_no' => $request->input('expense_no'),
            ]);
    
            $subData = json_decode($request->input('products'), true);
    
            foreach ($subData as $data) {
                VehicleSub::create([
                    'vehicle_expense_no' => $vehicleMain->vehicle_expense_no,
                    'vehicle_expense_code' => $data['vehicle_expense_code'],
                    'amount' => $data['amount'],
                    'remark' => $data['remarks'], // Adjusted key name
                ]);
                Log::info('Inserted VehicleSub record: ', $data);
            }
    
            DB::commit();
    
            return redirect()->back()->with('success', 'Vehicle expense saved successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to save vehicle expense: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to save vehicle expense: ' . $e->getMessage()]);
        }
    }
    }
