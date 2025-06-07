<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\product;
use App\Models\product_category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $product = product::with('category')->get();
        return view('masters.product', compact('product'));
    }
    public function addindex()
    {   
        $categories = product_category::all();
        return view('masters.add.product_add', ['categories' => $categories]);
    }
    public function store(Request $request)
    {
        $imagePath = null;
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('product_photos', 'public');
        }
    
        $lastProduct = Product::orderBy('_id', 'desc')->first();
        $lastProductCode = $lastProduct ? $lastProduct->product_code : 0;
        $nextProductCode = $lastProductCode + 1;
        $productCode = str_pad($nextProductCode, 10, '0', STR_PAD_LEFT);
    

        $product = Product::create([
            'product_code' => $productCode,
            'category_code' => $request->input('category_code'),
            'product_name' => $request->input('product_name'),
            'hsn_code' => $request->input('hsn_code'),
            'unit_of_msrment' => $request->input('unit_of_msrment'),
            'selling_rate' => $request->input('selling_rate'),
            'cgst' => $request->input('cgst'),
            'sgst' => $request->input('sgst'),
            'igst' => $request->input('igst'),
            'reorder_level' => $request->input('reorder_level'),
            'photo' => $imagePath,
        ]);
    
        Inventory::create([
            'product_code' => $product->product_code,
            'hsn_code' => $request->input('hsn_code'),
            'cgst' => $request->input('cgst'),
            'sgst' => $request->input('sgst'),
            'igst' => $request->input('igst'),
            'date_field' => now(),
            'opening_balance' => 0,
            'receipt' => 0,
            'issue' => 0,
            'closing_balance' => 0,
            'mfg_date' => $request->input('mfg_date'),
            'expiry_date' => $request->input('expiry_date'),
            // 'rate_status' => 'active',
            'selling_rate' => $request->input('selling_rate'),
            'tax' => $request->input('tax'),
            'batch_code' => $request->input('batch_code'),
            'reorder_level' => $request->input('reorder_level'),
            'warehouse_code' => 'A3', 
            'server_time' => now(),
            'update_date' => now(),
            // 'update_status' => 'active',
        ]);
    
        return redirect()->back()->with('success', 'Product and inventory saved successfully!');
    }
    public function editindex($id)
    {
        $product = product::find($id);
        $categories = product_category::all();
        $imagePath = $product->photo;

        return view('masters.edit.product_edit', compact('product', 'categories', 'imagePath'));
    }
    public function edit(Request $request, $id)
    {
        $imagePath = null;
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('product_photos', 'public');
        }
        product::where('_id', $id)->update([
            'category_code' => $request->input('category_code'),
            'product_name' => $request->input('product_name'),
            'hsn_code' => $request->input('hsn_code'),
            'unit_of_msrment' => $request->input('unit_of_msrment'),
            'selling_rate' => $request->input('selling_rate'),
            'cgst' => $request->input('cgst'),
            'sgst' => $request->input('sgst'),
            'igst' => $request->input('igst'),
            'reorder_level' => $request->input('reorder_level'),
            'photo' => $imagePath
        ]);
        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }
    public function delete($id)
    {
        try {
            $product = product::findOrFail($id);

            $product->delete();

            return redirect()->back()->with('success', 'product updated successfully.');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete product'], 500);
        }
    }
}
