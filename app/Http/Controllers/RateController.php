<?php

namespace App\Http\Controllers;

use App\Models\grnp_sub;
use App\Models\product;
use App\Models\product_category;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function index(Request $request)
    {  
        $categories = product_category::all();
        $product = Product::all();
        return view('transactions.rate_fix', compact('categories', 'product'));
    }
    public function getProductsByCategory(Request $request) 
    {
        $categoryId = $request->input('category_code');
        $query = $request->input('query');
        
        $products = product::where('category_code', $categoryId)
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
    public function getProduct($id)
    {
        $product = Product::where('product_code', $id)->first();

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json([
            'productName' => $product->product_name,
            'umo' => $product->unit_of_msrment,
            'hsn' => $product->hsn_code,
            're_or' =>$product->reorder_level,
            'selling_rate' =>$product->selling_rate,
            'cgst' => $product->cgst,
            'sgst' => $product->sgst,
            'igst' => $product->igst,
            'reorder_level' => $product->reorder_level,
        ]);
    }
    public function showGrnpSubData($productId)
    {
        $grnpSub = grnp_sub::where('product_code', $productId)->first();

        if ($grnpSub) {
            return response()->json([
                'batch_no' => $grnpSub->batch_code,
                'qty' => $grnpSub->quantity,
                'purchase_rate' => $grnpSub->purchase_rate,
                'reorder_level' => $grnpSub->reorder_level,
            ]);
        } else {
            return response()->json(['error' => 'No GRNP data found for this product'], 404);
        }
    }
    public function update(Request $request)
    {
        
        grnp_sub::where('product_code', $request->product_id)->update([
            'selling_rate' => $request->selling_rate,
            'cgst' => $request->cgst,
            'sgst' => $request->sgst,
            'igst' => $request->igst,
            'reorder_level' => $request->re_or,
        ]);

        Product::where('product_code', $request->product_id)->update([
            'selling_rate' => $request->selling_rate,
            'cgst' => $request->cgst,
            'sgst' => $request->sgst,
            'igst' => $request->igst,
            'reorder_level' => $request->re_or,
        ]);

        return redirect()->back()->with('success', 'Rates updated successfully!');
    }
}
