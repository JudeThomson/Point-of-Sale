<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = Customer::all();
        return view('masters.customer', compact('customer'));
    }
    public function addindex()
    {   
        return view('masters.add.customer_add');
    }
    public function store(Request $request)
    {            
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'mobile' => 'required|digits:10', 
        ], [
            'customer_name.required' => 'The Customer Name field is required.',
            'customer_name.string' => 'The Customer Name must be a string.',
            'customer_name.max' => 'The Customer Name may not be greater than 255 characters.',
            'mobile.required' => 'The Mobile Number field is required.',
            'mobile.digits' => 'The Mobile Number must be a 10-digit number.',
        ]);
        Customer::create([
            'customer_id' => $request->input('customer_id'),
            'customer_name' => $request->input('customer_name'),
            'mobile' => $request->input('mobile'),
            'address1' => $request->input('address1'),
            'address2' => $request->input('address2'),
            'address3' => $request->input('address3'),
            'email' => $request->input('email'),
            'remark' => $request->input('remark')
            
        ]);
        return redirect()->back()->with('success', 'Staff profile saved successfully!');
    }
    public function editindex($id)
    {
        $customer = Customer::find($id);

        return view('masters.edit.customer_edit', compact('customer'));
    }
    public function edit(Request $request, $id)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'mobile' => 'required|digits:10', 
        ], [
            'customer_name.required' => 'The Customer Name field is required.',
            'customer_name.string' => 'The Customer Name must be a string.',
            'customer_name.max' => 'The Customer Name may not be greater than 255 characters.',
            'mobile.required' => 'The Mobile Number field is required.',
            'mobile.digits' => 'The Mobile Number must be a 10-digit number.',
        ]);
        Customer::where('_id', $id)->update([
            'customer_id' => $request->input('customer_id'),
            'customer_name' => $request->input('customer_name'),
            'mobile' => $request->input('mobile'),
            'address1' => $request->input('address1'),
            'address2' => $request->input('address2'),
            'address3' => $request->input('address3'),
            'email' => $request->input('email'),
            'remark' => $request->input('remark'),
        ]);
        return redirect()->route('customer.index')->with('success', 'customer updated successfully');
    }
    public function delete($id)
    {
        try {
            $customer = Customer::findOrFail($id);

            $customer->delete();

            return redirect()->back()->with('success', 'Customer updated successfully.');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete customer'], 500);
        }
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        $customers = Customer::where('customer_id', 'LIKE', "%$query%")
            ->orWhere('customer_name', 'LIKE', "%$query%")
            ->orWhere('mobile', 'LIKE', "%$query%")
            ->get();

        return response()->json($customers);
    }
}
