<?php

namespace App\Http\Controllers;

use App\Models\ResearchAndDevelopmentProject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResearchDevelopmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = ResearchAndDevelopmentProject::with('leadResearcher')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('research-development.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $researchers = User::all();
        $statusOptions = ResearchAndDevelopmentProject::getStatusOptions();

        return view('research-development.create', compact('researchers', 'statusOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'lead_researcher_id' => 'required|exists:users,id',
            'description' => 'required|string',
            'status' => ['required', Rule::in(array_keys(ResearchAndDevelopmentProject::getStatusOptions()))],
        ]);

        ResearchAndDevelopmentProject::create($validated);

        return redirect()->route('research-development.index')
            ->with('success', 'Research & Development project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = ResearchAndDevelopmentProject::with('leadResearcher')->findOrFail($id);

        return view('research-development.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = ResearchAndDevelopmentProject::findOrFail($id);
        $researchers = User::all();
        $statusOptions = ResearchAndDevelopmentProject::getStatusOptions();

        return view('research-development.edit', compact('project', 'researchers', 'statusOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = ResearchAndDevelopmentProject::findOrFail($id);

        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'lead_researcher_id' => 'required|exists:users,id',
            'description' => 'required|string',
            'status' => ['required', Rule::in(array_keys(ResearchAndDevelopmentProject::getStatusOptions()))],
        ]);

        $project->update($validated);

        return redirect()->route('research-development.index')
            ->with('success', 'Research & Development project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = ResearchAndDevelopmentProject::findOrFail($id);
        $project->delete();

        return redirect()->route('research-development.index')
            ->with('success', 'Research & Development project deleted successfully.');
    }
}
