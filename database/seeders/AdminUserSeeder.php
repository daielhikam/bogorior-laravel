<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        
        $users = [
            [
                'username' => 'superadmin',
                'password' => Hash::make('password123'),
                'nama_lengkap' => 'Super Administrator',
                'email' => 'super@admin.com',
                'role' => 'super_admin',
                'aktif' => 1,
                'approval_status' => 'approved',
                'registration_key' => 'BOGORIOR-SUPER-001',
                'registered_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'username' => 'admin',
                'password' => Hash::make('password123'),
                'nama_lengkap' => 'Admin Bogorior',
                'email' => 'admin@bogorior.com',
                'role' => 'admin',
                'aktif' => 1,
                'approval_status' => 'approved',
                'registration_key' => 'BOGORIOR-ADMIN-001',
                'registered_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'username' => 'desainer',
                'password' => Hash::make('password123'),
                'nama_lengkap' => 'Tim Desainer',
                'email' => 'desainer@bogorior.com',
                'role' => 'desainer',
                'aktif' => 1,
                'approval_status' => 'approved',
                'registration_key' => 'BOGORIOR-DESAINER-001',
                'registered_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'username' => 'marketing',
                'password' => Hash::make('password123'),
                'nama_lengkap' => 'Tim Marketing',
                'email' => 'marketing@bogorior.com',
                'role' => 'marketing',
                'aktif' => 1,
                'approval_status' => 'approved',
                'registration_key' => 'BOGORIOR-MARKETING-001',
                'registered_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'username' => 'customer_service',
                'password' => Hash::make('password123'),
                'nama_lengkap' => 'Customer Service',
                'email' => 'cs@bogorior.com',
                'role' => 'cs',
                'aktif' => 1,
                'approval_status' => 'approved',
                'registration_key' => 'BOGORIOR-CS-001',
                'registered_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($users as $user) {
            DB::table('admin_users')->updateOrInsert(
                ['username' => $user['username']],
                $user
            );
        }

        $this->command->info('✅ Admin users seeded: ' . count($users) . ' users');
    }
}