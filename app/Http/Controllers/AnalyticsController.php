<?php

namespace App\Http\Controllers;

use App\Models\ProductionBatch;
use App\Models\QualityControlRecord;
use App\Models\MaintenanceRecord;
use App\Models\SanitationRecord;
use App\Models\ResearchAndDevelopmentProject;
use App\Models\SupplyChainLogistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    /**
     * Display the main analytics dashboard.
     */
    public function index()
    {
        $data = [
            'productionStats' => $this->getProductionStats(),
            'qualityStats' => $this->getQualityStats(),
            'maintenanceStats' => $this->getMaintenanceStats(),
            'supplyChainStats' => $this->getSupplyChainStats(),
            'rdStats' => $this->getResearchDevelopmentStats(),
            'recentActivity' => $this->getRecentActivity(),
            'monthlyTrends' => $this->getMonthlyTrends(),
        ];

        return view('analytics.dashboard', compact('data'));
    }

    /**
     * Generate custom reports.
     */
    public function reports(Request $request)
    {
        $reportType = $request->get('type', 'production');
        $dateRange = $request->get('date_range', '30');

        $data = $this->generateReport($reportType, $dateRange);

        return view('analytics.reports', compact('data', 'reportType', 'dateRange'));
    }

    /**
     * Export report data.
     */
    public function export(Request $request)
    {
        $reportType = $request->get('type', 'production');
        $format = $request->get('format', 'pdf');
        $dateRange = $request->get('date_range', '30');

        $data = $this->generateReport($reportType, $dateRange);

        if ($format === 'excel') {
            return $this->exportToExcel($data, $reportType);
        }

        return $this->exportToPdf($data, $reportType);
    }

    /**
     * Get production statistics.
     */
    private function getProductionStats()
    {
        $totalBatches = ProductionBatch::count();
        $completedBatches = ProductionBatch::where('status', 'completed')->count();
        $inProgressBatches = ProductionBatch::where('status', 'in_progress')->count();
        $averageYield = ProductionBatch::where('status', 'completed')->avg('actual_yield') ?? 0;

        $monthlyProduction = ProductionBatch::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return [
            'total_batches' => $totalBatches,
            'completed_batches' => $completedBatches,
            'in_progress_batches' => $inProgressBatches,
            'completion_rate' => $totalBatches > 0 ? round(($completedBatches / $totalBatches) * 100, 2) : 0,
            'average_yield' => round($averageYield, 2),
            'monthly_trend' => $monthlyProduction,
        ];
    }

    /**
     * Get quality control statistics.
     */
    private function getQualityStats()
    {
        $totalInspections = QualityControlRecord::count();
        $passedInspections = QualityControlRecord::where('result', 'passed')->count();
        $failedInspections = QualityControlRecord::where('result', 'failed')->count();
        $passRate = $totalInspections > 0 ? round(($passedInspections / $totalInspections) * 100, 2) : 0;

        $monthlyQuality = QualityControlRecord::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as total, SUM(CASE WHEN result = "passed" THEN 1 ELSE 0 END) as passed')
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return [
            'total_inspections' => $totalInspections,
            'passed_inspections' => $passedInspections,
            'failed_inspections' => $failedInspections,
            'pass_rate' => $passRate,
            'monthly_trend' => $monthlyQuality,
        ];
    }

    /**
     * Get maintenance statistics.
     */
    private function getMaintenanceStats()
    {
        $totalMaintenance = MaintenanceRecord::count();
        $scheduledMaintenance = MaintenanceRecord::where('type', 'scheduled')->count();
        $emergencyMaintenance = MaintenanceRecord::where('type', 'emergency')->count();
        $completedMaintenance = MaintenanceRecord::where('status', 'completed')->count();

        $monthlyMaintenance = MaintenanceRecord::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return [
            'total_maintenance' => $totalMaintenance,
            'scheduled_maintenance' => $scheduledMaintenance,
            'emergency_maintenance' => $emergencyMaintenance,
            'completed_maintenance' => $completedMaintenance,
            'completion_rate' => $totalMaintenance > 0 ? round(($completedMaintenance / $totalMaintenance) * 100, 2) : 0,
            'monthly_trend' => $monthlyMaintenance,
        ];
    }

    /**
     * Get supply chain statistics.
     */
    private function getSupplyChainStats()
    {
        $totalItems = SupplyChainLogistic::count();
        $receivedItems = SupplyChainLogistic::where('status', 'received')->count();
        $inTransitItems = SupplyChainLogistic::where('status', 'in_transit')->count();
        $approvedItems = SupplyChainLogistic::where('status', 'approved')->count();

        $monthlySupply = SupplyChainLogistic::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return [
            'total_items' => $totalItems,
            'received_items' => $receivedItems,
            'in_transit_items' => $inTransitItems,
            'approved_items' => $approvedItems,
            'monthly_trend' => $monthlySupply,
        ];
    }

    /**
     * Get research and development statistics.
     */
    private function getResearchDevelopmentStats()
    {
        $totalProjects = ResearchAndDevelopmentProject::count();
        $completedProjects = ResearchAndDevelopmentProject::where('status', 'completed')->count();
        $inProgressProjects = ResearchAndDevelopmentProject::where('status', 'in_progress')->count();
        $planningProjects = ResearchAndDevelopmentProject::where('status', 'planning')->count();

        $monthlyRD = ResearchAndDevelopmentProject::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return [
            'total_projects' => $totalProjects,
            'completed_projects' => $completedProjects,
            'in_progress_projects' => $inProgressProjects,
            'planning_projects' => $planningProjects,
            'completion_rate' => $totalProjects > 0 ? round(($completedProjects / $totalProjects) * 100, 2) : 0,
            'monthly_trend' => $monthlyRD,
        ];
    }

    /**
     * Get recent activity across all modules.
     */
    private function getRecentActivity()
    {
        $activities = collect();

        // Recent production batches
        $productionBatches = ProductionBatch::with('operator')->latest()->take(5)->get();
        foreach ($productionBatches as $batch) {
            $activities->push([
                'type' => 'production',
                'title' => "Production Batch: {$batch->batch_number}",
                'description' => "Status: {$batch->status}",
                'date' => $batch->created_at,
                'operator' => $batch->operator->name ?? 'Unknown',
            ]);
        }

        // Recent quality inspections
        $qualityRecords = QualityControlRecord::with('inspector')->latest()->take(5)->get();
        foreach ($qualityRecords as $record) {
            $activities->push([
                'type' => 'quality',
                'title' => "Quality Inspection: {$record->inspection_type}",
                'description' => "Result: {$record->result}",
                'date' => $record->created_at,
                'inspector' => $record->inspector->name ?? 'Unknown',
            ]);
        }

        // Recent maintenance records
        $maintenanceRecords = MaintenanceRecord::with('technician')->latest()->take(5)->get();
        foreach ($maintenanceRecords as $record) {
            $activities->push([
                'type' => 'maintenance',
                'title' => "Maintenance: {$record->equipment_name}",
                'description' => "Type: {$record->type}, Status: {$record->status}",
                'date' => $record->created_at,
                'technician' => $record->technician->name ?? 'Unknown',
            ]);
        }

        return $activities->sortByDesc('date')->take(10);
    }

    /**
     * Get monthly trends for all modules.
     */
    private function getMonthlyTrends()
    {
        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $months->push(Carbon::now()->subMonths($i)->format('Y-m'));
        }

        $trends = [
            'production' => ProductionBatch::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
                ->whereIn(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'), $months)
                ->groupBy('month')
                ->pluck('count', 'month')
                ->toArray(),
            'quality' => QualityControlRecord::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
                ->whereIn(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'), $months)
                ->groupBy('month')
                ->pluck('count', 'month')
                ->toArray(),
            'maintenance' => MaintenanceRecord::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
                ->whereIn(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'), $months)
                ->groupBy('month')
                ->pluck('count', 'month')
                ->toArray(),
        ];

        return $trends;
    }

    /**
     * Generate custom reports.
     */
    private function generateReport($type, $dateRange)
    {
        $startDate = Carbon::now()->subDays($dateRange);

        switch ($type) {
            case 'production':
                return ProductionBatch::where('created_at', '>=', $startDate)
                    ->with('operator')
                    ->orderBy('created_at', 'desc')
                    ->get();
            case 'quality':
                return QualityControlRecord::where('created_at', '>=', $startDate)
                    ->with('inspector')
                    ->orderBy('created_at', 'desc')
                    ->get();
            case 'maintenance':
                return MaintenanceRecord::where('created_at', '>=', $startDate)
                    ->with('technician')
                    ->orderBy('created_at', 'desc')
                    ->get();
            case 'supply_chain':
                return SupplyChainLogistic::where('created_at', '>=', $startDate)
                    ->orderBy('created_at', 'desc')
                    ->get();
            default:
                return collect();
        }
    }

    /**
     * Export to Excel (placeholder).
     */
    private function exportToExcel($data, $type)
    {
        // Implementation for Excel export
        return response()->json(['message' => 'Excel export not implemented yet']);
    }

    /**
     * Export to PDF (placeholder).
     */
    private function exportToPdf($data, $type)
    {
        // Implementation for PDF export
        return response()->json(['message' => 'PDF export not implemented yet']);
    }
}
