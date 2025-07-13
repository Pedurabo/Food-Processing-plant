<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductionBatch;
use App\Models\QualityControlRecord;
use App\Models\MaintenanceRecord;
use App\Models\SanitationRecord;
use App\Models\ResearchAndDevelopmentProject;
use App\Models\SupplyChainLogistic;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'production_batches' => ProductionBatch::count(),
            'quality_control_records' => QualityControlRecord::count(),
            'maintenance_records' => MaintenanceRecord::count(),
            'sanitation_records' => SanitationRecord::count(),
            'research_projects' => ResearchAndDevelopmentProject::count(),
            'supply_chain_items' => SupplyChainLogistic::count(),
        ];

        return view('dashboard', compact('stats'));
    }
}
