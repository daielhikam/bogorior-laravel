<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotifikasiAdminSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        $now = now();
        
        $notifications = [
            [
                'id_admin' => 1,
                'tipe_notifikasi' => 'info',
                'judul' => 'Selamat Datang',
                'pesan' => 'Selamat datang di dashboard admin Bogorior KitchenSet.',
                'link' => null,
                'dibaca' => 1,
                'dibaca_pada' => $now->copy()->subDays(30),
                'created_at' => $now->copy()->subDays(30),
            ],
            [
                'id_admin' => 1,
                'tipe_notifikasi' => 'success',
                'judul' => 'Backup Berhasil',
                'pesan' => 'Backup database terakhir berhasil dilakukan pada ' . $now->format('d/m/Y H:i'),
                'link' => null,
                'dibaca' => 0,
                'dibaca_pada' => null,
                'created_at' => $now->copy()->subDays(1),
            ],
            [
                'id_admin' => 1,
                'tipe_notifikasi' => 'warning',
                'judul' => 'Konsultasi Baru',
                'pesan' => 'Ada konsultasi baru dari Hikam yang perlu ditindaklanjuti.',
                'link' => '/admin/konsultasi',
                'dibaca' => 0,
                'dibaca_pada' => null,
                'created_at' => $now->copy()->subHours(2),
            ],
            [
                'id_admin' => 2,
                'tipe_notifikasi' => 'info',
                'judul' => 'Pesan Kontak Baru',
                'pesan' => 'Ada pesan kontak baru dari Bambang Susilo.',
                'link' => '/admin/kontak',
                'dibaca' => 0,
                'dibaca_pada' => null,
                'created_at' => $now->copy()->subHours(5),
            ],
        ];

        foreach ($notifications as $notification) {
            DB::table('notifikasi_admin')->insert($notification);
        }

        $this->command->info('✅ Admin notifications seeded: ' . count($notifications) . ' notifications');
    }
}