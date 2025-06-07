<?php

namespace App\Http\Controllers;

use App\Models\InvoiceMain;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function invoice()
    {
        $invoice = InvoiceMain::all();
        return view('Reports.invoice', compact('invoice'));
    }
    public function getInvoiceData()
    {
        $invoice = InvoiceMain::with('customer')->get();
        return response()->json($invoice);
    }
}
