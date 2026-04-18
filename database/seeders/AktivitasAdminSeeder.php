<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AktivitasAdminSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        $now = now();
        
        $activities = [
            [
                'id_admin' => 1,
                'nama_admin' => 'Super Administrator',
                'role_admin' => 'super_admin',
                'tipe_aktivitas' => 'login',
                'modul' => 'auth',
                'deskripsi' => 'Admin Super Administrator berhasil login ke sistem.',
                'data_sebelum' => null,
                'data_sesudah' => null,
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 (Seeder)',
                'created_at' => $now->copy()->subDays(30),
            ],
            [
                'id_admin' => 1,
                'nama_admin' => 'Super Administrator',
                'role_admin' => 'super_admin',
                'tipe_aktivitas' => 'create',
                'modul' => 'admin_users',
                'deskripsi' => 'Menambahkan admin user baru: admin',
                'data_sebelum' => null,
                'data_sesudah' => json_encode(['username' => 'admin', 'role' => 'admin']),
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 (Seeder)',
                'created_at' => $now->copy()->subDays(25),
            ],
            [
                'id_admin' => 1,
                'nama_admin' => 'Super Administrator',
                'role_admin' => 'super_admin',
                'tipe_aktivitas' => 'create',
                'modul' => 'artikel',
                'deskripsi' => 'Menambahkan artikel baru: 7 Tips Memilih Kitchen Set yang Tepat untuk Rumah Anda',
                'data_sebelum' => null,
                'data_sesudah' => json_encode(['judul' => '7 Tips Memilih Kitchen Set']),
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 (Seeder)',
                'created_at' => $now->copy()->subDays(20),
            ],
            [
                'id_admin' => 2,
                'nama_admin' => 'Admin Bogorior',
                'role_admin' => 'admin',
                'tipe_aktivitas' => 'update',
                'modul' => 'project',
                'deskripsi' => 'Mengupdate status project KS2024-0001 menjadi selesai',
                'data_sebelum' => json_encode(['status' => 'produksi']),
                'data_sesudah' => json_encode(['status' => 'selesai']),
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 (Seeder)',
                'created_at' => $now->copy()->subDays(15),
            ],
            [
                'id_admin' => 3,
                'nama_admin' => 'Tim Desainer',
                'role_admin' => 'desainer',
                'tipe_aktivitas' => 'create',
                'modul' => 'project',
                'deskripsi' => 'Menambahkan desain baru untuk project KS2024-0004',
                'data_sebelum' => null,
                'data_sesudah' => json_encode(['desain' => 'Minimalist']),
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 (Seeder)',
                'created_at' => $now->copy()->subDays(10),
            ],
        ];

        foreach ($activities as $activity) {
            DB::table('aktivitas_admin')->insert($activity);
        }

        $this->command->info('✅ Admin activities seeded: ' . count($activities) . ' activities');
    }
}