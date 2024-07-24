<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $query = Sale::query();
        if ($request->has('search')) {
            $query->where('product_name', 'like', '%' . $request->search . '%');
        }
        $sales = $query->paginate(10);
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        return view('sales.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'sale_date' => 'required|date',
        ]);

        $validated['total'] = $validated['quantity'] * $validated['price'];
        Sale::create($validated);

        return redirect()->route('sales.index')->with('success', 'Sale created successfully.');
    }

    public function edit(Sale $sale)
    {
        return view('sales.edit', compact('sale'));
    }

    public function update(Request $request, Sale $sale)
    {
        $validated = $request->validate([
            'product_name' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'sale_date' => 'required|date',
        ]);

        $validated['total'] = $validated['quantity'] * $validated['price'];
        $sale->update($validated);

        return redirect()->route('sales.index')->with('success', 'Sale updated successfully.');
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully.');
    }

    public function report()
    {
        $sales = Sale::all();
        $pdf = PDF::loadView('sales.report', compact('sales'));
        return $pdf->download('sales_report.pdf');
    }
}
