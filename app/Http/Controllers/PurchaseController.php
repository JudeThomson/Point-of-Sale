<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\purchase_sub;
use App\Models\vendor;
use App\Models\product;
use App\Models\product_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $vendor = Vendor::all();
        $product = Product::all();
        $category = product_category::all();
        $purchase = purchase_sub::all();

        $query = $request->get('query');
        $products = collect();

        if ($query) {
            $products = Product::where('product_name', 'LIKE', "%{$query}%")->get(['_id', 'product_name', 'photo']);
        }   

        // Handle selected product
        $selectedProductId = $request->get('selected_product_id');
        $selectedProductName = $request->get('selected_product_name');
        
        return view('Transactions.purchase', compact('vendor', 'product', 'category', 'products', 'selectedProductId', 'selectedProductName', 'purchase'));
    }
    public function getProductsByCategory(Request $request) 
    {
        $categoryId = $request->input('category_code');
        $query = $request->input('query');
        
        $products = Product::where('category_code', $categoryId)
                           ->where('product_name', 'LIKE', "%$query%")
                           ->get();
    
        $output = '';
    
        if ($products->isEmpty()) {
            $output .= '<p>No products found</p>';
        } else {
            foreach ($products as $product) {
                $output .= '<a href="#" class="list-group-item list-group-item-action product-item" data-category="'.$product->category_code.'" onclick="selectProduct(\''.$product->product_code.'\', \''.$product->product_name.'\')">
                                <img src="'.$product->photo.'" class="product-image" alt="'.$product->product_name.'">
                                <span>'.$product->product_name.'</span>
                            </a>';
            }
        }
        return response()->json($output);
    }
    
    public function save(Request $request)
    {
        
        $formattedDate = \Carbon\Carbon::createFromFormat('d/M/Y', $request->input('current_date'))->format('Y-m-d');
        $po_no = $request->input('po_no');
        $vendor_code = $request->input('vendor_id');
        $products = json_decode($request->input('products'), true);
    
        if (!is_array($products)) {
            return; // Simply return if the products data is invalid
        }
    
        $existingPurchase = purchase_sub::where('po_no', $po_no)->exists();
    
        if ($existingPurchase) {
            foreach ($products as $product) {
                if (!isset($product['product_code'])) {
                    return;
                }
    
                purchase_sub::updateOrCreate(
                    ['po_no' => $po_no, 'product_code' => $product['product_code']],
                    [
                        'vendor_code' => $vendor_code,
                        'quantity' => $product['quantity']
                    ]
                );
            }
        } else {
            foreach ($products as $product) {
                if (!isset($product['product_code'])) {
                    return;
                }
    
                purchase_sub::create([
                    'po_no' => $po_no,
                    'vendor_code' => $vendor_code,
                    'product_code' => $product['product_code'],
                    'quantity' => $product['quantity'],
                    'date_field' => $formattedDate,
                ]);
            }
        }
        return redirect('/purchase');
    }
            
    public function getDetails($po_no)
    {
        $purchases = purchase_sub::with(['product', 'vendor'])->where('po_no', $po_no)->get();

        $products = $purchases->map(function($purchase) {
            return [
                'vendor' => $purchase->vendor->vendor_name,
                'image' => $purchase->product->photo,
                'name' => $purchase->product->product_name,
                'quantity' => $purchase->quantity,
                'uom' => $purchase->unit_of_msrment,
            ];
        });

        return response()->json(['products' => $products]);
    }
    public function insertPurchaseMain(Request $request)
    {
        $po_no = $request->input('po_no');
        $vendor_code = $request->input('vendor_code');

        DB::table('purchase_main')->insert([
            'po_no' => $po_no,
            'vendor_code' => $vendor_code,
        ]);

        return response()->json(['success' => true, 'po_no' => $po_no]);
    }
    public function printPurchase($po_no)
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
    function cancelPOindex(Request $request)
    {
        $purchase = purchase_sub::all();
       
        return view('Transactions.cancel_po', compact('purchase'));
    }
}
