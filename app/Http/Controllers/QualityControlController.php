<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QualityControlRecord;
use App\Models\ProductionBatch;
use App\Models\User;

class QualityControlController extends Controller
{
    public function index()
    {
        $qualityControlRecords = QualityControlRecord::with(['batch', 'inspector'])->latest()->paginate(10);
        return view('quality-control.index', compact('qualityControlRecords'));
    }

    public function create()
    {
        $productionBatches = ProductionBatch::all();
        $users = User::all();
        return view('quality-control.create', compact('productionBatches', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|exists:production_batches,id',
            'inspection_date' => 'required|date',
            'inspector_id' => 'required|exists:users,id',
            'result' => 'required|in:passed,failed,pending',
            'notes' => 'nullable|string',
        ]);

        QualityControlRecord::create($request->all());

        return redirect()->route('quality-control.index')->with('success', 'Quality control record created successfully.');
    }

    public function show(QualityControlRecord $qualityControl)
    {
        return view('quality-control.show', compact('qualityControl'));
    }

    public function edit(QualityControlRecord $qualityControl)
    {
        $productionBatches = ProductionBatch::all();
        $users = User::all();
        return view('quality-control.edit', compact('qualityControl', 'productionBatches', 'users'));
    }

    public function update(Request $request, QualityControlRecord $qualityControl)
    {
        $request->validate([
            'batch_id' => 'required|exists:production_batches,id',
            'inspection_date' => 'required|date',
            'inspector_id' => 'required|exists:users,id',
            'result' => 'required|in:passed,failed,pending',
            'notes' => 'nullable|string',
        ]);

        $qualityControl->update($request->all());

        return redirect()->route('quality-control.index')->with('success', 'Quality control record updated successfully.');
    }

    public function destroy(QualityControlRecord $qualityControl)
    {
        $qualityControl->delete();

        return redirect()->route('quality-control.index')->with('success', 'Quality control record deleted successfully.');
    }
}
