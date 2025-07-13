<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanitationRecord;
use App\Models\User;

class SanitationController extends Controller
{
    public function index()
    {
        $sanitationRecords = SanitationRecord::with('performedBy')->latest()->paginate(10);
        return view('sanitation.index', compact('sanitationRecords'));
    }

    public function create()
    {
        $users = User::all();
        return view('sanitation.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'area' => 'required|string|max:255',
            'sanitation_date' => 'required|date',
            'performed_by' => 'required|exists:users,id',
            'notes' => 'nullable|string',
            'status' => 'required|in:scheduled,in_progress,completed,verified',
        ]);

        SanitationRecord::create($request->all());

        return redirect()->route('sanitation.index')->with('success', 'Sanitation record created successfully.');
    }

    public function show(SanitationRecord $sanitation)
    {
        return view('sanitation.show', compact('sanitation'));
    }

    public function edit(SanitationRecord $sanitation)
    {
        $users = User::all();
        return view('sanitation.edit', compact('sanitation', 'users'));
    }

    public function update(Request $request, SanitationRecord $sanitation)
    {
        $request->validate([
            'area' => 'required|string|max:255',
            'sanitation_date' => 'required|date',
            'performed_by' => 'required|exists:users,id',
            'notes' => 'nullable|string',
            'status' => 'required|in:scheduled,in_progress,completed,verified',
        ]);

        $sanitation->update($request->all());

        return redirect()->route('sanitation.index')->with('success', 'Sanitation record updated successfully.');
    }

    public function destroy(SanitationRecord $sanitation)
    {
        $sanitation->delete();

        return redirect()->route('sanitation.index')->with('success', 'Sanitation record deleted successfully.');
    }
}
