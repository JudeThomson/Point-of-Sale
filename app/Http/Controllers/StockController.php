<?php

namespace App\Http\Controllers;

use App\Models\StockTransMain;
use App\Models\StockTransSub;
use App\Models\product_category;
use App\Models\product;
use App\Models\warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StockController extends Controller
{
    public function index(Request $request)
    {   
        $product = product::all();
        $category = product_category::all();
        $query = $request->get('query');
        $products = collect();

        if ($query) {
            $products = Product::where('product_name', 'LIKE', "%{$query}%")->get(['_id', 'product_name', 'photo']);
        }   

        // Handle selected product
        $selectedProductId = $request->get('selected_product_id');
        $selectedProductName = $request->get('selected_product_name');

        return view('Transactions.stock',compact( 'product', 'category', 'products', 'selectedProductId', 'selectedProductName'));
    }
    public function getWarehouses() {
        return warehouse::all(); 
    }
    public function store(Request $request)
    {
        try {
            $formattedDate = \Carbon\Carbon::createFromFormat('d/M/Y', $request->input('current_date'))->format('Y-m-d');
    
            DB::beginTransaction();
            Log::info($request->all());
    
            $stockMain = new StockTransMain();
            $stockMain->trans_no = $request->input('transfer_no');
            $stockMain->trans_date = $formattedDate;
            $stockMain->from_ware = $request->input('from_warehouse');
            $stockMain->to_ware = $request->input('to_warehouse');
            $stockMain->save();
    
            $products = json_decode($request->input('products'), true);
    
            if (is_array($products)) {
                foreach ($products as $product) {
                    Log::info('Product entry:', $product);
    
                    // Verify that product_code exists and quantity is numeric
                    if (isset($product['product_code']) && isset($product['quantity']) && is_numeric($product['quantity'])) {
                        $stockSub = new StockTransSub();
                        $stockSub->trans_no = $stockMain->trans_no;
                        $stockSub->product_code = $product['product_code'];
                        $stockSub->quantity = $product['quantity'];
                        $stockSub->save();
                    } else {
                        Log::error('Invalid product entry - either product_code is missing or quantity is not numeric.', $product);
                    }
                }
            } else {
                Log::error('Products JSON is not valid or empty.');
            }
    
            DB::commit();
            return redirect()->route('stock.print', ['trans_no' => $stockMain->trans_no])
            ->with('openPrintWindow', true);               

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving stock transfer: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to save stock transfer.');
        }
    }
    public function printInvoice($trans_no)
    {   
        
        $company = DB::table('company_profile')->orderBy('_id', 'desc')->first();    
            
        $Stock = StockTransMain::where('trans_no', $trans_no)->first();
        $stockdetails = StockTransSub::with('product')->where('trans_no', $trans_no)->get();

        return view('print.stock', compact('Stock', 'stockdetails', 'company',));
    }

}
