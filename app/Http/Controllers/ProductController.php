<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\section;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = product::all();
        $sections = section::all();
        return view('products.index', compact('products', 'sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $section_name = section::where('id', $request->section_id)->first()->section_name;
            $validator = $request->validate([
                'product_name' => 'required|min:2',
                'section_id' => 'required',
                'product_description' => 'nullable',
            ]);
            product::create([
                'product_name' => $validator['product_name'],
                'product_description' => $validator['product_description'],
                'section_name' => $section_name,
                'section_id' => $validator['section_id'],
            ]);
            return redirect('products');
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
        try {
            $product = product::findOrFail($id);
            $section_name = section::where('id', $request->section_id)->first()->section_name;
            $validator = $request->validate([
                'product_name' => 'required|min:2',
                'section_id' => 'required',
                'product_description' => 'nullable',
            ]);
            $product->update([
                'product_name' => $validator['product_name'],
                'product_description' => $validator['product_description'],
                'section_name' => $section_name,
                'section_id' => $validator['section_id'],
            ]);
            $product->save();
            return redirect('products');
        } catch (Exception $e) {
            return $e;
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        product::find($id)->delete();
        return redirect('products');
    }
}
