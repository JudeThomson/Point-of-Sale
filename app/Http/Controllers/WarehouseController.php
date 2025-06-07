<?php

namespace App\Http\Controllers;

use App\Models\warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {   
        $warehouse = warehouse::all();
        return view('masters.warehouse',compact('warehouse'));
    }
    // public function index(Request $request)
    // {   
    //     $perPage = 10;
    //     $warehouse = Warehouse::paginate($perPage);
        
    //     // Calculate total pages
    //     $totalPages = ceil($warehouse->total() / $perPage);

    //     $currentPage = $request->get('page', 1);

    //     return view('masters.warehouse', compact('warehouse', 'currentPage', 'totalPages'));
    // }
    public function store(Request $request)
    {
        $lastWarehouse = Warehouse::orderBy('_id', 'desc')->first();

        $lastCode = ($lastWarehouse) ? $lastWarehouse->warehouse_code : 'A0';

        preg_match('/(\d+)$/', $lastCode, $matches);
        $nextNumber = intval($matches[0]) + 1;

        $newWarehouseCode = 'A' . $nextNumber;
        warehouse::create([
            'warehouse_name' => $request->input('newWarehouse'),
            'warehouse_code' => $newWarehouseCode,
        ]);
    
        return redirect()->back()->with('success', 'Warehouse created successfully!');
    }
    public function update(Request $request)
    {
        $warehouseId = $request->input('editWarehouse');
        $newName = $request->input('newWarehouse');

        $warehouse = Warehouse::find($warehouseId);

        if (!$warehouse) {
            return redirect()->back()->with('error', 'Warehouse not found.');
        }
        $warehouse->warehouse_name = $newName;

        $warehouse->save();

        return redirect()->back()->with('success', 'Warehouse updated successfully.');
    }
    public function delete($id)
    {
        try {
            $warehouse = Warehouse::findOrFail($id);

            $warehouse->delete();

            return redirect()->back()->with('success', 'Warehouse updated successfully.');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete warehouse'], 500);
        }
    }
}
