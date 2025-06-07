<?php

namespace App\Http\Controllers;

use App\Models\Petty;
use App\Models\Petty_Entry;
use App\Models\Petty_Sub;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PettyEntryController extends Controller
{
    public function index()
    {   
        $petty = Petty::all();
        $petty_entry = Petty_Entry::all();
        return view('Transactions.petty_entry', compact('petty', 'petty_entry'));
    }   
    public function store(Request $request)
    {
        // // Validate the request
        // $request->validate([
        //     'petty_account_code' => 'required|string',
        //     'current_date' => 'required|date',
        //     'category' => 'required|string',
        //     'category_type' => 'required|string',
        //     'amount' => 'required|numeric',
        //     'remarks' => 'required|string'
        // ]);

        // Format the date
        $formattedDate = Carbon::createFromFormat('d/M/Y', $request->input('current_date'))->format('Y-m-d');
        // Get the petty_account_code from petty_main table based on petty_account_name
        $pettyAccountName = $request->input('category_type');
        $pettyAccount = Petty::where('petty_account_name', $pettyAccountName)->first();

        if (!$pettyAccount) {
            return redirect()->back()->withErrors(['category_type' => 'The petty account name does not exist in the petty_main table.']);
        }

        $pettyAccountCode = $pettyAccount->petty_account_code;

        // Create a new PettyEntry
        $pettyEntry = Petty_Entry::updateOrCreate(
            ['petty_code' => $request->input('petty_code')],
            ['current_balance' => 0, 'user_id' => auth()->id(), 'transaction_date' => $formattedDate]
        );

        // Create a new PettySub
        $pettySub = new Petty_Sub();
        $pettySub->petty_code = $pettyEntry->petty_code;
        $pettySub->petty_account_code = $pettyAccountCode;
        $pettySub->amount = $request->input('amount');
        $pettySub->remark = $request->input('remarks');
        $pettySub->transaction_date = $formattedDate;
        $pettySub->save();

        return redirect()->back()->with('success', 'Petty entry saved successfully!');
    }
}
