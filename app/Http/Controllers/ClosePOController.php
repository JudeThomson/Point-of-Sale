<?php

namespace App\Http\Controllers;

use App\Models\purchase_main;
use App\Models\purchase_sub;
use Illuminate\Http\Request;

class ClosePOController extends Controller
{
    public function showClosePOPage()
    {
        $purchaseOrders = purchase_main::where('status', Null )->get();

        return view('Transactions.close_po', compact('purchaseOrders'));
    }
    public function closePurchaseOrder(Request $request)
    {
        $po_no = $request->input('po_no'); 

        purchase_main::where('po_no', $po_no)->update(['status' => 2]);
        purchase_sub::where('po_no', $po_no)->update(['status' => 2]);

        return view('Transactions.close_po', compact('purchaseOrders'));
    }
}
