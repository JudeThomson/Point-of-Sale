<?php

namespace App\Http\Controllers;

use App\Models\grnp_main;
use App\Models\purchase_main;
use App\Models\product;
use App\Models\warehouse;
use App\Models\grnp_sub;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GRNPController extends Controller
{
    public function index(Request $request)
    {  
        
        $purchase = purchase_main::all();
        $warehouses = warehouse::all();
        $grnp = grnp_sub::all();
        $products = collect(); 
        $po_no = $request->input('po_no', ''); 
        $product_code = $request->input('product_code'); // Get product code from request
        $product = null;
        
        if ($product_code) {
            $product = Product::where('product_code', $product_code)->first(); // Fetch product based on product code
        }
        return view('transactions.grnp', compact('purchase', 'warehouses', 'products', 'grnp', 'po_no', 'product'));
    }
    public function showProducts(Request $request)
    {   
        
        $warehouses = warehouse::all();
        $grnp = grnp_sub::all();
        $po_no = $request->input('po_no');

        $vendor = DB::table('purchase_main')
            ->join('vendor', 'purchase_main.vendor_code', '=', 'vendor._id') 
            ->select('vendor.vendor_code', 'vendor.vendor_name')
            ->where('purchase_main.po_no', $po_no)
            ->first();

        $products = DB::table('purchase_sub')
            ->join('product', 'purchase_sub.product_code', '=', 'product.product_code')
            ->where('purchase_sub.po_no', $po_no)
            ->select('product.photo', 'product.product_name', 'purchase_sub.quantity', 'product.unit_of_msrment', 'purchase_sub.product_code')
            ->get();
            foreach ($products as $product) {
                $grnpData = DB::table('grnp_sub')
                    ->where('product_code', $product->product_code)
                    ->first();
        
                if ($grnpData) {
                    $product->batch_code = $grnpData->batch_code;
                    $product->purchase_rate = $grnpData->purchase_rate;
                    $product->mfg_date = $grnpData->mfg_date;
                    $product->expiry_date = $grnpData->expiry_date;
                } else {
                    $product->batch_code = '';
                    $product->purchase_rate = '';
                    $product->mfg_date = '';
                    $product->expiry_date = '';
                }
            }
        $purchase = purchase_main::with('vendor')->get();

        return view('transactions.grnp', compact('products', 'purchase', 'warehouses', 'vendor', 'grnp', 'po_no'));
    }
    public function store(Request $request)
    {

        $product = DB::table('purchase_sub')
            ->where('product_code', $request['product_code'])
            ->first();

            if ($product) {
                $grnp = new grnp_sub();
                $grnp->grnp_no = $request['grnp_no'];
                $grnp->product_code = $request['product_code']; 
                $grnp->quantity = $request['quantity'] ?? $product->quantity;
                $grnp->purchase_rate = $request['purchase_rate'] ?? $product->purchase_rate;
                $grnp->batch_code = $request['batch_code'];
                $grnp->mfg_date = $request['mfg_date'];
                $grnp->expiry_date = $request['expiry_date'];
                
                $grnp->save();
        
                return response()->json(['message' => 'Product details saved successfully!']);
            }
        
        return response()->json(['message' => 'Product not found for the specified po_no and product_code.'], 404);
    }
    public function store_main(Request $request)
    {
        $date = Carbon::createFromFormat('d/M/Y', $request->input('current_date'))->format('Y-m-d');

        $grnpMain = grnp_main::create([
            'date_field' => $date,
            'grnp_no' => $request->input('grnp_no'),
            'po_no' => $request->input('po_no'),
            'warehouse_code' => $request->input('warehouse_code'),
            'vendor_code' => $request->input('vendor_code'),
            'dn_order_no' => $request->input('dn_order_no'),
            'tot_amt' => $request->input('grnp_total'),
            'amount' => $request->input('amount'),
            'advance' => $request->input('advance'),
            'paid_amt' => $request->input('paid_amount'),
            'type_field' => $request->input('type_field'),
            'status' => $request->input('status'),
            'transport_mode' => $request->input('transport_mode'),
            // 'dn_order_date' => $request->input('dn_order_date'), // If applicable
        ]);

        return redirect()->back()->with('success', 'GRNP created successfully!');    
    }
}