<?php

namespace App\Http\Controllers;

use App\Models\OrderMain;
use App\Models\OrderSub;
use App\Models\product;
use App\Models\product_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
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

        $selectedProductId = $request->get('selected_product_id');
        $selectedProductName = $request->get('selected_product_name');
        
        return view('Transactions.order', compact( 'product', 'category', 'products', 'selectedProductId', 'selectedProductName'));
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            Log::info($request->all());
            $formattedDate = \Carbon\Carbon::createFromFormat('d/M/Y', $request->input('current_date'))->format('Y-m-d');

            $orderMain = OrderMain::create([
                'order_no' => $request->input('order_no'),
                'customer_id' => $request->input('customer_id'),
                'advance' => $request->input('advance'),
                'date_field' => $formattedDate,
                
            ]);
            $products = json_decode($request->products, true);

            if (!empty($products)) {
                foreach ($products as $product) {
                    // Check if required product data is present
                    if (!isset($product['product_code'], $product['name'])) {
                        Log::error('Product data incomplete', $product);
                        continue;
                    }

                    OrderSub::create([
                        'order_no' => $orderMain->order_no,
                        'product_code' => $product['product_code'],
                        'quantity' => $product['name'],
                    ]);
                }
            }

            DB::commit();

            return redirect()->back()->with('success', 'Order created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order creation failed', ['error' => $e->getMessage()]);

            return response()->json(['error' => 'Order creation failed'], 500);
        }
    }
    public function printOrder($po_no)
    {
        $purchase = DB::table('purchase_main')
            ->where('purchase_main.po_no', $po_no)
            ->join('vendor', 'purchase_main.vendor_code', '=', 'vendor.vendor_code')
            ->select('purchase_main.*', 'vendor.vendor_name', 'vendor.mobile')
            ->first();        

        $company = DB::table('company_profile')->orderBy('_id', 'desc')->first();
        $purchaseItems = DB::table('purchase_sub')
            ->join('product', 'purchase_sub.product_code', '=', 'product.product_code')
            ->join('product_category', 'product.category_code', '=', 'product_category.category_code')
            ->where('purchase_sub.po_no', $po_no)
            ->select('purchase_sub.quantity', 'purchase_sub.unit_of_msrment', 'product.product_name', 'product_category.category')
            ->get();
        

        return view('print.purchase_order', compact('purchase','company','purchaseItems'));
    }    
}
