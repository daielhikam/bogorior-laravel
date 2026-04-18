<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        $now = now();
        
        // Super Admin
        DB::table('admin_users')->updateOrInsert(
            ['username' => 'superadmin'],
            [
                'username' => 'superadmin',
                'password' => Hash::make('password123'),
                'nama_lengkap' => 'Super Administrator',
                'email' => 'super@admin.com',
                'role' => 'super_admin',
                'foto_profil' => null,
                'whatsapp' => '628123456789',
                'alamat' => 'Bogor, Indonesia',
                'bio' => 'Super Administrator of Bogorior KitchenSet',
                'last_login' => $now,
                'last_ip' => '127.0.0.1',
                'aktif' => 1,
                'approval_status' => 'approved',
                'registration_key' => 'BOGORIOR-SUPER-001',
                'reset_token' => null,
                'reset_token_expires' => null,
                'registered_at' => $now,
                'registered_by' => null,
                'approved_by' => null,
                'approved_at' => null,
                'rejection_reason' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        // Admin User
        DB::table('admin_users')->updateOrInsert(
            ['username' => 'admin'],
            [
                'username' => 'admin',
                'password' => Hash::make('password123'),
                'nama_lengkap' => 'Admin Bogorior',
                'email' => 'admin@bogorior.com',
                'role' => 'admin',
                'foto_profil' => null,
                'whatsapp' => '628977288600',
                'alamat' => 'Bogor, Indonesia',
                'bio' => 'Administrator of Bogorior KitchenSet',
                'last_login' => null,
                'last_ip' => null,
                'aktif' => 1,
                'approval_status' => 'approved',
                'registration_key' => 'BOGORIOR-ADMIN-001',
                'reset_token' => null,
                'reset_token_expires' => null,
                'registered_at' => $now,
                'registered_by' => 1,
                'approved_by' => 1,
                'approved_at' => $now,
                'rejection_reason' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        // Desainer User
        DB::table('admin_users')->updateOrInsert(
            ['username' => 'desainer'],
            [
                'username' => 'desainer',
                'password' => Hash::make('password123'),
                'nama_lengkap' => 'Tim Desainer',
                'email' => 'desainer@bogorior.com',
                'role' => 'desainer',
                'foto_profil' => null,
                'whatsapp' => '628977288601',
                'alamat' => 'Bogor, Indonesia',
                'bio' => 'Desainer Interior Bogorior KitchenSet',
                'last_login' => null,
                'last_ip' => null,
                'aktif' => 1,
                'approval_status' => 'approved',
                'registration_key' => 'BOGORIOR-DESAINER-001',
                'reset_token' => null,
                'reset_token_expires' => null,
                'registered_at' => $now,
                'registered_by' => 1,
                'approved_by' => 1,
                'approved_at' => $now,
                'rejection_reason' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        // Marketing User
        DB::table('admin_users')->updateOrInsert(
            ['username' => 'marketing'],
            [
                'username' => 'marketing',
                'password' => Hash::make('password123'),
                'nama_lengkap' => 'Tim Marketing',
                'email' => 'marketing@bogorior.com',
                'role' => 'marketing',
                'foto_profil' => null,
                'whatsapp' => '628977288602',
                'alamat' => 'Bogor, Indonesia',
                'bio' => 'Marketing Team Bogorior KitchenSet',
                'last_login' => null,
                'last_ip' => null,
                'aktif' => 1,
                'approval_status' => 'approved',
                'registration_key' => 'BOGORIOR-MARKETING-001',
                'reset_token' => null,
                'reset_token_expires' => null,
                'registered_at' => $now,
                'registered_by' => 1,
                'approved_by' => 1,
                'approved_at' => $now,
                'rejection_reason' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        // CS User
        DB::table('admin_users')->updateOrInsert(
            ['username' => 'customer_service'],
            [
                'username' => 'customer_service',
                'password' => Hash::make('password123'),
                'nama_lengkap' => 'Customer Service',
                'email' => 'cs@bogorior.com',
                'role' => 'cs',
                'foto_profil' => null,
                'whatsapp' => '628977288603',
                'alamat' => 'Bogor, Indonesia',
                'bio' => 'Customer Service Bogorior KitchenSet',
                'last_login' => null,
                'last_ip' => null,
                'aktif' => 1,
                'approval_status' => 'approved',
                'registration_key' => 'BOGORIOR-CS-001',
                'reset_token' => null,
                'reset_token_expires' => null,
                'registered_at' => $now,
                'registered_by' => 1,
                'approved_by' => 1,
                'approved_at' => $now,
                'rejection_reason' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        // Pending Admin (for testing approval system)
        DB::table('admin_users')->updateOrInsert(
            ['username' => 'pending_user'],
            [
                'username' => 'pending_user',
                'password' => Hash::make('password123'),
                'nama_lengkap' => 'Pending User',
                'email' => 'pending@bogorior.com',
                'role' => 'admin',
                'foto_profil' => null,
                'whatsapp' => '6281234567890',
                'alamat' => null,
                'bio' => null,
                'last_login' => null,
                'last_ip' => null,
                'aktif' => 1,
                'approval_status' => 'pending',
                'registration_key' => 'BOGORIOR-PENDING-001',
                'reset_token' => null,
                'reset_token_expires' => null,
                'registered_at' => $now,
                'registered_by' => null,
                'approved_by' => null,
                'approved_at' => null,
                'rejection_reason' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        $this->command->info('✅ Admin users seeded: superadmin, admin, desainer, marketing, cs, pending_user');
    }
}