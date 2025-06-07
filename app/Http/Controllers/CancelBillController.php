<?php

namespace App\Http\Controllers;

use App\Models\InvoiceMain;
use App\Models\InvoiceSub;
use App\Models\CancelInvoiceMain;
use App\Models\CancelInvoiceSub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CancelBillController extends Controller
{
    public function index(Request $request)
    {
        return view('Transactions.cancel_bill');
    }
    public function cancelInvoice(Request $request)
    {
            Log::info($request->all());

        $invoice = InvoiceMain::where('invoice_no', $request->invoice_no)->first();

        if (!$invoice) {
            return redirect()->back()->with('error', 'Invoice not found.');
        }

        $cancelInvoiceMain = new CancelInvoiceMain();
        $cancelInvoiceMain->date_field = now();
        $cancelInvoiceMain->time_field = now()->format('H:i:s'); 
        $cancelInvoiceMain->invoice_no = $request->invoice_no;
        $cancelInvoiceMain->remark = $request->remarks; 
        $cancelInvoiceMain->amount = $invoice->amount; 
        // $cancelInvoiceMain->user_id = auth()->id(); 
        $cancelInvoiceMain->less_amt = $invoice->less_amt; 
        $cancelInvoiceMain->round_off = $invoice->round_off_val; 
        $cancelInvoiceMain->customer_id = $request->customer_id;
        // $cancelInvoiceMain->warehouse_code = $invoice->warehouse_code; 2
        $cancelInvoiceMain->save();

        $invoiceItems = InvoiceSub::where('invoice_no', $request->invoice_no)->get();

        foreach ($invoiceItems as $item) {
            $cancelInvoiceSub = new CancelInvoiceSub();
            $cancelInvoiceSub->invoice_no = $cancelInvoiceMain->invoice_no; 
            $cancelInvoiceSub->product_code = $item->product_code;
            $cancelInvoiceSub->batch_code = $item->batch_code;
            $cancelInvoiceSub->quantity = $item->quantity; 
            $cancelInvoiceSub->free = $item->free; 
            $cancelInvoiceSub->rate = $item->rate; 
            $cancelInvoiceSub->tax = $item->tax; 
            $cancelInvoiceSub->amount = $item->amount; 
            $cancelInvoiceSub->save();
        }

        return redirect()->back()->with('success', 'Invoice canceled successfully.');
    }
}
