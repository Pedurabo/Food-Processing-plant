<?php

namespace App\Http\Controllers;

use App\Models\SupplyChainLogistic;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SupplyChainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = SupplyChainLogistic::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('supply-chain.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statusOptions = SupplyChainLogistic::getStatusOptions();

        return view('supply-chain.create', compact('statusOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'supplier' => 'required|string|max:255',
            'received_date' => 'required|date',
            'status' => ['required', Rule::in(array_keys(SupplyChainLogistic::getStatusOptions()))],
            'notes' => 'required|string',
        ]);

        SupplyChainLogistic::create($validated);

        return redirect()->route('supply-chain.index')
            ->with('success', 'Supply chain item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = SupplyChainLogistic::findOrFail($id);

        return view('supply-chain.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = SupplyChainLogistic::findOrFail($id);
        $statusOptions = SupplyChainLogistic::getStatusOptions();

        return view('supply-chain.edit', compact('item', 'statusOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = SupplyChainLogistic::findOrFail($id);

        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'supplier' => 'required|string|max:255',
            'received_date' => 'required|date',
            'status' => ['required', Rule::in(array_keys(SupplyChainLogistic::getStatusOptions()))],
            'notes' => 'required|string',
        ]);

        $item->update($validated);

        return redirect()->route('supply-chain.index')
            ->with('success', 'Supply chain item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = SupplyChainLogistic::findOrFail($id);
        $item->delete();

        return redirect()->route('supply-chain.index')
            ->with('success', 'Supply chain item deleted successfully.');
    }
}
