<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaintenanceRecord;
use App\Models\User;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenanceRecords = MaintenanceRecord::with('performedBy')->latest()->paginate(10);
        return view('maintenance.index', compact('maintenanceRecords'));
    }

    public function create()
    {
        $users = User::all();
        return view('maintenance.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'equipment_name' => 'required|string|max:255',
            'maintenance_date' => 'required|date',
            'performed_by' => 'required|exists:users,id',
            'description' => 'required|string',
            'status' => 'required|in:scheduled,in_progress,completed,cancelled',
        ]);

        MaintenanceRecord::create($request->all());

        return redirect()->route('maintenance.index')->with('success', 'Maintenance record created successfully.');
    }

    public function show(MaintenanceRecord $maintenance)
    {
        return view('maintenance.show', compact('maintenance'));
    }

    public function edit(MaintenanceRecord $maintenance)
    {
        $users = User::all();
        return view('maintenance.edit', compact('maintenance', 'users'));
    }

    public function update(Request $request, MaintenanceRecord $maintenance)
    {
        $request->validate([
            'equipment_name' => 'required|string|max:255',
            'maintenance_date' => 'required|date',
            'performed_by' => 'required|exists:users,id',
            'description' => 'required|string',
            'status' => 'required|in:scheduled,in_progress,completed,cancelled',
        ]);

        $maintenance->update($request->all());

        return redirect()->route('maintenance.index')->with('success', 'Maintenance record updated successfully.');
    }

    public function destroy(MaintenanceRecord $maintenance)
    {
        $maintenance->delete();

        return redirect()->route('maintenance.index')->with('success', 'Maintenance record deleted successfully.');
    }
}
