<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\InvoiceMain;
use App\Models\InvoiceSub;
use App\Models\product;
use App\Models\product_category;
use App\Models\OrderMain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BillController extends Controller
{
    public function index(Request $request)
    {
        $product = product::all();
        $category = product_category::all();
        $orders = OrderMain::all();

        $query = $request->get('query');
        $products = collect();

        if ($query) {
            $products = Product::where('product_name', 'LIKE', "%{$query}%")->get(['_id', 'product_name', 'photo']);
        }   

        $selectedProductId = $request->get('selected_product_id');
        $selectedProductName = $request->get('selected_product_name');
        
        return view('Transactions.invoice', compact( 'product', 'category', 'products', 'selectedProductId', 'selectedProductName', 'orders'));
    }
    public function getOrderDetails($orderNo)
    {
        $orderDetails = DB::table('order_sub')
            ->where('order_sub.order_no', $orderNo)
            ->join('order_main', 'order_sub.order_no', '=', 'order_main.order_no')
            ->join('product', 'order_sub.product_code', '=', 'product.product_code')
            // ->leftJoin('grnp_sub', 'order_sub.product_code', '=', 'grnp_sub.product_code')
            ->select(
                'order_main.customer_id',
                'product.hsn_code',
                'product.product_name',
                'product.selling_rate',
                'product.cgst',
                'product.igst',
                'order_sub.quantity'
                // DB::raw('IF(grnp_sub.batch_code IS NOT NULL, grnp_sub.batch_code, NULL) as batch_code')
            )
            ->get();

        return response()->json($orderDetails);
    }
    public function store(Request $request)
    {
        $formattedDate = \Carbon\Carbon::createFromFormat('d/M/Y', $request->input('current_date'))->format('Y-m-d');
        DB::transaction(function () use ($request, &$invoiceMain, $formattedDate) {
            Log::info($request->all());
           
            $invoiceMain = InvoiceMain::create([
                'invoice_no' => $request->input('bill_no'),
                'cgst' => $request->input('cgstAmountInput'),
                'igst' => $request->input('igstAmountInput'),
                'round_off_val'=> $request->input('totalAmount'),
                'taxable_value' => $request->input('totalAmount_one'),
                'bill_date' => $formattedDate,
                // 'less_amt' => $request-> 
                // round off
                'amount' => $request->input('totalAmount'),
                'paid_amt' => $request->input('paidAmount'),
                'bal_amt' => $request->input('remainingBalance'),
                // due_amt
                // 'type_filed'
                'customer_id' => $request->input('customer_id_display'),
                // user
                // warehouse
                // customer type
                // add other main fields here if needed
            ]);
            $products = json_decode($request->products, true);
            
            foreach ($products as $product) {
                
                if (empty($product['product_code']) && !empty($product['product_name'])) {
                    $productData = Product::where('product_name', $product['product_name'])->first();
                    if ($productData) {
                        $product['product_code'] = $productData->product_code;
                    } else {
                        Log::error("Product not found: " . $product['product_name']);
                        continue; 
                    }
                }
                
                InvoiceSub::create([
                    'invoice_no' => $invoiceMain->invoice_no, 
                    'product_code' => $product['product_code'],
                    'cgst' => $product['cgst'],
                    'igst' => $product['igst'],
                    'rate' => $product['selling_rate'],
                    // 'quantity' => $product['quantity'],
                    // 'free' => $product['free'],
                    // tax
                    'amount' => $product['total_item_amount']                    
                ]);
            }
        });
        
        return redirect()->route('invoice.print', ['invoice_no' => $invoiceMain->invoice_no])
        ->with('openPrintWindow', true);
    }
    public function printInvoice($invoice_no)
    {   
        
        $company = DB::table('company_profile')->orderBy('_id', 'desc')->first();        
        $invoice = InvoiceMain::with('customer')->where('invoice_no', $invoice_no)->first();
        $invoiceItems = InvoiceSub::with('product')->where('invoice_no', $invoice_no)->get();

        return view('print.bill', compact('invoice', 'invoiceItems', 'company',));
    }
    public function searchInvoiceCustomer(Request $request)
    {
        $query = $request->query('query');
        $invoices = InvoiceMain::join('customer', 'invoice_main.customer_id', '=', 'customer.customer_id')
                ->where('invoice_main.customer_id', 'LIKE', "%{$query}%")
                ->orWhere('customer.customer_name', 'LIKE', "%{$query}%")
                ->orWhere('customer.mobile', 'LIKE', "%{$query}%")
                ->select('invoice_main.customer_id', 'customer.customer_name', 'customer.mobile', 'invoice_main.invoice_no')
                ->get();

        return response()->json($invoices);
    }
}
