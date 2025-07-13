<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductionBatch;
use App\Models\QualityControlRecord;
use App\Models\MaintenanceRecord;
use App\Models\SanitationRecord;
use App\Models\ResearchAndDevelopmentProject;
use App\Models\SupplyChainLogistic;
use App\Models\User;
use Carbon\Carbon;

class AnalyticsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create users
        $operator = User::firstOrCreate(
            ['email' => 'operator@foodprocessing.com'],
            [
                'name' => 'John Operator',
                'password' => bcrypt('password123'),
            ]
        );

        $inspector = User::firstOrCreate(
            ['email' => 'inspector@foodprocessing.com'],
            [
                'name' => 'Sarah Inspector',
                'password' => bcrypt('password123'),
            ]
        );

        $technician = User::firstOrCreate(
            ['email' => 'technician@foodprocessing.com'],
            [
                'name' => 'Mike Technician',
                'password' => bcrypt('password123'),
            ]
        );

        $researcher = User::firstOrCreate(
            ['email' => 'researcher@foodprocessing.com'],
            [
                'name' => 'Dr. Lisa Researcher',
                'password' => bcrypt('password123'),
            ]
        );

        // Create sample production batches
        $products = ['Organic Bread', 'Whole Grain Pasta', 'Gluten-Free Cookies', 'Artisan Sourdough', 'Multigrain Cereal'];
        $statuses = ['completed', 'in_progress', 'planned'];

        for ($i = 1; $i <= 20; $i++) {
            ProductionBatch::create([
                'batch_number' => 'BATCH-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'product_name' => $products[array_rand($products)],
                'production_date' => Carbon::now()->subDays(rand(1, 30)),
                'quantity' => rand(100, 1000),
                'status' => $statuses[array_rand($statuses)],
                'operator_id' => $operator->id,
            ]);
        }

        // Create sample quality control records
        $inspectionTypes = ['Visual Inspection', 'Chemical Analysis', 'Microbiological Test', 'Physical Properties', 'Taste Test'];
        $results = ['passed', 'failed'];

        for ($i = 1; $i <= 25; $i++) {
            QualityControlRecord::create([
                'batch_id' => rand(1, 20),
                'inspection_date' => Carbon::now()->subDays(rand(1, 30)),
                'inspector_id' => $inspector->id,
                'result' => $results[array_rand($results)],
                'notes' => 'Sample quality control record for analytics testing.',
            ]);
        }

        // Create sample maintenance records
        $equipment = ['Mixer A', 'Oven B', 'Conveyor C', 'Packaging Machine D', 'Cooling System E'];
        $maintenanceStatuses = ['completed', 'in_progress', 'scheduled'];

        for ($i = 1; $i <= 15; $i++) {
            MaintenanceRecord::create([
                'equipment_name' => $equipment[array_rand($equipment)],
                'maintenance_date' => Carbon::now()->subDays(rand(1, 30)),
                'performed_by' => $technician->id,
                'description' => 'Sample maintenance record for analytics testing.',
                'status' => $maintenanceStatuses[array_rand($maintenanceStatuses)],
            ]);
        }

        // Create sample sanitation records
        $areas = ['Production Floor', 'Packaging Area', 'Storage Room', 'Loading Dock', 'Office Area'];
        $sanitationStatuses = ['completed', 'in_progress', 'scheduled'];

        for ($i = 1; $i <= 12; $i++) {
            SanitationRecord::create([
                'area' => $areas[array_rand($areas)],
                'sanitation_date' => Carbon::now()->subDays(rand(1, 30)),
                'performed_by' => $operator->id,
                'notes' => 'Sample sanitation record for analytics testing.',
                'status' => $sanitationStatuses[array_rand($sanitationStatuses)],
            ]);
        }

        // Create sample R&D projects
        $projectNames = ['New Gluten-Free Formula', 'Organic Ingredient Research', 'Packaging Innovation', 'Process Optimization', 'Flavor Enhancement'];
        $rdStatuses = ['planning', 'in_progress', 'testing', 'completed'];

        for ($i = 1; $i <= 8; $i++) {
            ResearchAndDevelopmentProject::create([
                'project_name' => $projectNames[array_rand($projectNames)],
                'start_date' => Carbon::now()->subDays(rand(10, 60)),
                'end_date' => Carbon::now()->addDays(rand(10, 90)),
                'lead_researcher_id' => $researcher->id,
                'status' => $rdStatuses[array_rand($rdStatuses)],
                'description' => 'Sample R&D project for analytics testing.',
            ]);
        }

        // Create sample supply chain items
        $items = ['Organic Flour', 'Natural Yeast', 'Premium Salt', 'Fresh Herbs', 'Quality Oils'];
        $suppliers = ['Organic Farms Inc.', 'Premium Ingredients Co.', 'Natural Supplies Ltd.', 'Quality Foods Corp.', 'Fresh Ingredients LLC'];
        $supplyStatuses = ['ordered', 'in_transit', 'received', 'inspected', 'approved'];

        for ($i = 1; $i <= 18; $i++) {
            SupplyChainLogistic::create([
                'item_name' => $items[array_rand($items)],
                'quantity' => rand(50, 500),
                'supplier' => $suppliers[array_rand($suppliers)],
                'received_date' => Carbon::now()->subDays(rand(1, 30)),
                'status' => $supplyStatuses[array_rand($supplyStatuses)],
                'notes' => 'Sample supply chain item for analytics testing.',
            ]);
        }

        $this->command->info('Analytics sample data created successfully!');
    }
}
