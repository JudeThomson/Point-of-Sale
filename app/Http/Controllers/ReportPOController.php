<?php

namespace App\Http\Controllers;

use App\Models\CancelInvoiceMain;
use App\Models\Customer;
use App\Models\grnp_main;
use App\Models\grnp_sub;
use App\Models\Inventory;
use App\Models\InvoiceMain;
use App\Models\OrderMain;
use App\Models\Petty_Entry;
use App\Models\product;
use App\Models\purchase_main;
use App\Models\StockTransMain;
use App\Models\VehicleMain;
use App\Models\warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportPOController extends Controller
{
    public function Purchase()
    {
        $purchase = purchase_main::all();
        return view('Reports.purchase', compact('purchase'));
    }
    public function getPurchaseData()
    {
        $purchases = purchase_main::with('vendor')->get();
        return response()->json($purchases);
    }
    public function Inventory()
    {
        $Inventory = Inventory::with('product')->get();
        $warehouses = warehouse::all();
        return view('Reports.product_proce', compact('Inventory', 'warehouses'));
    }
    public function getProductsByWarehouse(Request $request)
    {
        $warehouseId = $request->input('warehouse_code');

        $products = Inventory::with('product')->where('warehouse_code', $warehouseId)->get();

        return response()->json(['products' => $products]);
    }
   
    public function Expiry(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        if ($fromDate && $toDate) {
            $fromDate = Carbon::parse($fromDate)->startOfDay();
            $toDate = Carbon::parse($toDate)->endOfDay();

            $expiryData = grnp_sub::with('product')
                ->whereBetween('expiry_date', [$fromDate, $toDate])
                ->get(['product_code', 'batch_code', 'expiry_date', 'reorder_level']);
        } else {
            // Fetch all records if no date filters are applied
            $expiryData = grnp_sub::with('product')->get(['product_code', 'batch_code', 'expiry_date', 'reorder_level']);
        }

        return view('Reports.expiry', compact('expiryData'));
    }
    public function GRNPReport(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $vendorName = $request->input('vendor_name');
        $grnpNo = $request->input('grnp_no');

        if ($fromDate && $toDate) {
            $fromDate = Carbon::parse($fromDate)->startOfDay();
            $toDate = Carbon::parse($toDate)->endOfDay();

            $grnpData = grnp_main::query()
                ->when($vendorName, function ($query, $vendorName) {
                    $query->where('vendor_name', 'like', "%$vendorName%");
                })
                ->when($grnpNo, function ($query, $grnpNo) {
                    $query->where('grnp_no', $grnpNo);
                })
                ->whereBetween('created_at', [$fromDate, $toDate])
                ->get();
        } else {
            // Fetch all records if no filters are applied
            $grnpData = grnp_main::query()
                ->when($vendorName, function ($query, $vendorName) {
                    $query->where('vendor_name', 'like', "%$vendorName%");
                })
                ->when($grnpNo, function ($query, $grnpNo) {
                    $query->where('grnp_no', $grnpNo);
                })
                ->get();
        }

        return view('Reports.grnp_report', compact('grnpData'));
    }
    public function Reorder()
    {
        $Inventory = Inventory::with('product')->get();
        $warehouses = warehouse::all();
        return view('Reports.reorder', compact('Inventory', 'warehouses'));
    }
    public function Order()
    {
        $order = OrderMain::with('Customer')->get();
        return view('Reports.order_report', compact('order'));
    }
    public function getOrderData()
    {
        $orders = OrderMain::with('Customer')->get();
        return response()->json($orders);
    }
    public function CancelBill()
    {
        $cancelbills = CancelInvoiceMain::with('Customer')->get();
        return view('Reports.cancel_bill_report', compact('cancelbills'));
    }
    public function getBillData()
    {
        $cancelbills = CancelInvoiceMain::with('Customer')->get();
        return response()->json($cancelbills);
    }
    public function PettyCash()
    {
        $pettycash = Petty_Entry::all();
        return view('Reports.petty_cash', compact('pettycash'));
    }
    public function getPettyData()
    {
        $pettycash =  Petty_Entry::all();
        return response()->json($pettycash);
    }

    public function OutstandingCash()
    {
        $outstanding = InvoiceMain::with('Customer')->get();
        return view('Reports.outstanding_cash', compact('outstanding'));
    }
    public function getOutstandingData()
    {
        $outstanding =  InvoiceMain::with('Customer')->get();
        return response()->json($outstanding);
    }

    public function Collect(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required',
            'collected_amt' => 'required|min:0',
        ]);

        DB::table('outstanding')->insert([
            'customer_id' => $validated['customer_id'],
            'collected_amt' => $validated['collected_amt'],
            'collected_date' => now(),
        ]);

        return response()->json(['message' => 'Balance collected successfully'], 200);
    }
    public function CashSales()
    {
        $cash_sales = InvoiceMain::with('Customer')->get();
        return view('Reports.cash_sales', compact('cash_sales'));
    }
    public function getCashSalesData()
    {
        $cash_sales =  InvoiceMain::with('Customer')->get();
        return response()->json($cash_sales);
    }
    public function VehicleExpense()
    {
        $vehicle_report = VehicleMain::all();
        return view('Reports.vehicle_report', compact('vehicle_report'));
    }
    public function getCashVehicleExpenseData()
    {
        $vehicle_report =  VehicleMain::all();
        return response()->json($vehicle_report);
    }
    public function getVehicleSubDetails(Request $request)
    {
        $vehicleExpenseNo = $request->input('vehicle_expense_no');
        $details = DB::table('vehicle_sub')->where('vehicle_expense_no', $vehicleExpenseNo)->get();
        return response()->json($details);
        
    }
    public function StockTransfer()
    {
        $stock_transfer = StockTransMain::all();
        return view('Reports.stocktrans', compact('stock_transfer'));
    }
    public function getStockTransferData()
    {
        $stock_transfer =  StockTransMain::all();
        return response()->json($stock_transfer);
    }
    public function GST()
    {
        $cash_sales = InvoiceMain::with('Customer')->get();
        return view('Reports.gst_report', compact('cash_sales'));
    }
    public function getGSTData()
    {
        $cash_sales =  InvoiceMain::with('Customer')->get();
        return response()->json($cash_sales);
    }
}   
