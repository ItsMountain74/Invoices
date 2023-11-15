<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Models\Product;
use App\Models\section;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth()->user()->id == 1) {
            $invoices = invoice::all();
        } else {
            $invoices = Invoice::where('user', Auth()->user()->name)->get();
        }
        $sections = section::all();
        return view('invoices.index', compact('invoices', 'sections'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'invoice_number' => 'required',
            'invoice_date' => 'required',
            'due_date' => 'required',
            'section_name' => 'required',
            'product' => 'required',
            'bill_amount' => 'required',
            'commission' => 'required',
            'Discount' => 'required',
            'Rate_VAT' => 'required',
            'Value_VAT' => 'required',
            'Total' => 'required',
            'note' => 'nullable',
            'user' => 'required'
        ]);

        invoice::create([
            'invoice_number' => $validator['invoice_number'],
            'invoices_date' => $validator['invoice_date'],
            'due_time' => $validator['due_date'],
            'product' => $validator['product'],
            'bill_amount' => $validator['bill_amount'],
            'commission' => $validator['commission'],
            'section' => $validator['section_name'],
            'discount' => $validator['Discount'],
            'tax_percent' => $validator['Rate_VAT'],
            'tax_value' => $validator['Value_VAT'],
            'total' => $validator['Total'],
            'restToPay' => $validator['Total'],
            'note' => $validator['note'],
            'user' => $validator['user'],
        ]);
        return redirect('invoices');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $section = section::find($request->section_id);
        $products = product::where('section_id', $request->section_id)->get();
        return view('invoices.create', compact('section', 'products'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $invoice = Invoice::findOrFail($request->id);
        $products = product::where('section_name', $invoice->section)->get();
        return view('invoices.edit', compact('invoice', 'products'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $invoice = Invoice::findOrFail($request->id);
        $invoice->delete();
        return redirect('invoices');
    }

    public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("product_name", "id");
        return json_encode($products);
    }

    public function pay_now($id)
    {
        $invoice = Invoice::find($id);
        return view('invoices.pay', compact('invoice'));
    }

    public function pay(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        if ($request['pay'] > $invoice['restToPay']) {
            return redirect('invoices')->with('msg', 'Max amount to pay is ' . $invoice['restToPay']);
        } else {
            $rest = ($invoice['restToPay'] - $request['pay']);
            $invoice->update([
                'restToPay' => $rest,
            ]);
            if ($rest == 0) {
                $invoice->update([
                    'status' => 'Paid',
                    'value_status' => 2,
                ]);
            } elseif ($invoice['restToPay'] > 0) {
                $invoice->update([
                    'status' => 'Partial Paid',
                    'value_status' => 1,
                ]);
            }
            return redirect('invoices')->with('msg', 'Paid successfully');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $invoice = Invoice::findOrFail($request->id);
        $validator = $request->validate([
            'invoice_number' => 'required',
            'due_date' => 'required',
            'product' => 'required',
            'bill_amount' => 'required',
            'Amount_Commission' => 'required',
            'Discount' => 'required',
            'Rate_VAT' => 'required',
            'Value_VAT' => 'required',
            'Total' => 'required',
            'note' => 'nullable',
            'user' => 'required'
        ]);
        $invoice->update([
            'invoice_number' => $validator['invoice_number'],
            'due_time' => $validator['due_date'],
            'product' => $validator['product'],
            'bill_amount' => $validator['bill_amount'],
            'commission' => $validator['Amount_Commission'],
            'discount' => $validator['Discount'],
            'tax_percent' => $validator['Rate_VAT'],
            'tax_value' => $validator['Value_VAT'],
            'total' => $validator['Total'],
            'note' => $validator['note'],
            'user' => $validator['user'],
        ]);
        $invoice->save();
        return redirect('invoices');
    }

    public function paid()
    {
        if (Auth()->user()->id == 1) {
            $invoices = Invoice::where('value_status', 2)->get();
            return view('invoices.details', compact('invoices'));
        }
        $invoices = Invoice::where('user', Auth()->user()->name)->where('value_status', 2)->get();
        return view('invoices.details', compact('invoices'));
    }

    public function nonPaid()
    {
        if (Auth()->user()->id == 1) {
            $invoices = Invoice::where('value_status', 0)->get();
            return view('invoices.details', compact('invoices'));
        }
        $invoices = Invoice::where('user', Auth()->user()->name)->where('value_status', 0)->get();
        return view('invoices.details', compact('invoices'));

    }

    public function partialPaid()
    {
        if (Auth()->user()->id == 1) {
            $invoices = Invoice::where('value_status', 1)->get();
            return view('invoices.details', compact('invoices'));
        }
        $invoices = Invoice::where('user', Auth()->user()->name)->where('value_status', 1)->get();
        return view('invoices.details', compact('invoices'));
    }
}
