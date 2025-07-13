<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductionBatch;
use App\Models\User;

class ProductionController extends Controller
{
    public function index()
    {
        $productionBatches = ProductionBatch::with('operator')->latest()->paginate(10);
        return view('production.index', compact('productionBatches'));
    }

    public function create()
    {
        $users = User::all();
        return view('production.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'batch_number' => 'required|string|max:255|unique:production_batches',
            'product_name' => 'required|string|max:255',
            'production_date' => 'required|date',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:planned,in_progress,completed,cancelled',
            'operator_id' => 'required|exists:users,id',
        ]);

        ProductionBatch::create($request->all());

        return redirect()->route('production.index')->with('success', 'Production batch created successfully.');
    }

    public function show(ProductionBatch $production)
    {
        return view('production.show', compact('production'));
    }

    public function edit(ProductionBatch $production)
    {
        $users = User::all();
        return view('production.edit', compact('production', 'users'));
    }

    public function update(Request $request, ProductionBatch $production)
    {
        $request->validate([
            'batch_number' => 'required|string|max:255|unique:production_batches,batch_number,' . $production->id,
            'product_name' => 'required|string|max:255',
            'production_date' => 'required|date',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:planned,in_progress,completed,cancelled',
            'operator_id' => 'required|exists:users,id',
        ]);

        $production->update($request->all());

        return redirect()->route('production.index')->with('success', 'Production batch updated successfully.');
    }

    public function destroy(ProductionBatch $production)
    {
        $production->delete();

        return redirect()->route('production.index')->with('success', 'Production batch deleted successfully.');
    }
}
