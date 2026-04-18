<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApprovalLogSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        $now = now();
        
        $logs = [
            [
                'id_admin' => 2,
                'action' => 'register',
                'status_from' => 'pending',
                'status_to' => 'active',
                'reason' => 'User approved by super admin',
                'performed_by' => 1,
                'created_at' => $now->copy()->subDays(25),
                'updated_at' => $now->copy()->subDays(25),
            ],
            [
                'id_admin' => 3,
                'action' => 'register',
                'status_from' => 'pending',
                'status_to' => 'active',
                'reason' => 'New desainer approved',
                'performed_by' => 1,
                'created_at' => $now->copy()->subDays(20),
                'updated_at' => $now->copy()->subDays(20),
            ],
            [
                'id_admin' => 4,
                'action' => 'register',
                'status_from' => 'pending',
                'status_to' => 'active',
                'reason' => 'Marketing team approved',
                'performed_by' => 1,
                'created_at' => $now->copy()->subDays(18),
                'updated_at' => $now->copy()->subDays(18),
            ],
            [
                'id_admin' => 5,
                'action' => 'register',
                'status_from' => 'pending',
                'status_to' => 'active',
                'reason' => 'Customer service approved',
                'performed_by' => 1,
                'created_at' => $now->copy()->subDays(15),
                'updated_at' => $now->copy()->subDays(15),
            ],
            [
                'id_admin' => 6,
                'action' => 'register',
                'status_from' => 'pending',
                'status_to' => 'pending',
                'reason' => 'New registration pending approval',
                'performed_by' => 6,
                'created_at' => $now->copy()->subDays(10),
                'updated_at' => $now->copy()->subDays(10),
            ],
        ];

        foreach ($logs as $log) {
            DB::table('approval_logs')->insert($log);
        }

        $this->command->info('✅ Approval logs seeded: ' . count($logs) . ' logs');
    }
}