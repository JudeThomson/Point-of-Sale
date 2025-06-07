<?php

namespace App\Http\Controllers;

use App\Models\product_category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {   
        $category = product_category::all();
        return view('masters.product_category', compact('category'));
    }
    public function store(Request $request)
    {
        $lastcategory = product_category::orderBy('_id', 'desc')->first();

        $lastCode = ($lastcategory) ? $lastcategory->category_code : 'A0';

        preg_match('/(\d+)$/', $lastCode, $matches);
        $nextNumber = intval($matches[0]) + 1;

        $newcategorycode = 'RA' . $nextNumber;
        product_category::create([
            'category' => $request->input('newCategory'),
            'category_code' => $newcategorycode,
        ]);
    
        return redirect()->back()->with('success', 'caregory created successfully!');
    }
    public function update(Request $request)
    {
        $categoryID = $request->input('editcategory');
        $newName = $request->input('newCategory');

        $category = product_category::find($categoryID);

        if (!$category) {
            return redirect()->back()->with('error', 'category not found.');
        }
        $category->category = $newName;

        $category->save();

        return redirect()->back()->with('success', 'category updated successfully.');
    }
    public function delete($id)
    {

        $category = product_category::findOrFail($id);

        $category->delete();

        return redirect()->back()->with('success', 'category updated successfully.');

    }
}
