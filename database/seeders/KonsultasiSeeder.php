<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KonsultasiSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        $now = now();
        
        $consultations = [
            [
                'id_pelanggan' => 1,
                'nama_konsultan' => 'Budi Santoso',
                'no_whatsapp' => '628123456789',
                'email' => 'budi@email.com',
                'jenis_layanan' => 'custom',
                'budget' => '20-35',
                'ukuran_dapur' => '3x4 meter',
                'alamat_lokasi' => 'Jl. Merdeka No. 1, Bogor',
                'pesan_kebutuhan' => 'Ingin kitchen set L-shaped dengan material kayu solid dan warna natural',
                'status_konsultasi' => 'selesai',
                'dihubungi' => 'ya',
                'jadwal_survey' => $now,
                'catatan_admin' => 'Survey sudah dilakukan, desain sedang dibuat',
                'tanggal_konsultasi' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_pelanggan' => 2,
                'nama_konsultan' => 'Sari Dewi',
                'no_whatsapp' => '628987654321',
                'email' => 'sari@email.com',
                'jenis_layanan' => 'premium',
                'budget' => '35-50',
                'ukuran_dapur' => '4x5 meter',
                'alamat_lokasi' => 'Jl. Sudirman No. 45, Jakarta',
                'pesan_kebutuhan' => 'Mau kitchen set modern dengan countertop granit dan pencahayaan LED',
                'status_konsultasi' => 'diproses',
                'dihubungi' => 'ya',
                'jadwal_survey' => null,
                'catatan_admin' => 'Menunggu jadwal survey dari client',
                'tanggal_konsultasi' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_pelanggan' => 3,
                'nama_konsultan' => 'Rudi Hartono',
                'no_whatsapp' => '628555666777',
                'email' => 'rudi@email.com',
                'jenis_layanan' => 'renovasi',
                'budget' => '10-20',
                'ukuran_dapur' => '2x3 meter',
                'alamat_lokasi' => 'Jl. Gatot Subroto No. 67, Depok',
                'pesan_kebutuhan' => 'Renovasi dapur, ganti kabinet dan countertop',
                'status_konsultasi' => 'selesai',
                'dihubungi' => 'ya',
                'jadwal_survey' => $now->copy()->subDays(10),
                'catatan_admin' => 'Project sudah selesai, client puas',
                'tanggal_konsultasi' => $now->copy()->subDays(30),
                'created_at' => $now->copy()->subDays(30),
                'updated_at' => $now->copy()->subDays(5),
            ],
            [
                'id_pelanggan' => 4,
                'nama_konsultan' => 'Diana Putri',
                'no_whatsapp' => '628777888999',
                'email' => 'diana@email.com',
                'jenis_layanan' => 'custom',
                'budget' => '20-35',
                'ukuran_dapur' => '3x3 meter',
                'alamat_lokasi' => 'Jl. Pajajaran No. 23, Bogor',
                'pesan_kebutuhan' => 'Desain kitchen set minimalis dengan warna putih',
                'status_konsultasi' => 'dijadwalkan',
                'dihubungi' => 'ya',
                'jadwal_survey' => $now->copy()->addDays(3),
                'catatan_admin' => 'Survey dijadwalkan hari Rabu',
                'tanggal_konsultasi' => $now->copy()->subDays(2),
                'created_at' => $now->copy()->subDays(2),
                'updated_at' => $now->copy()->subDays(1),
            ],
            [
                'id_pelanggan' => null,
                'nama_konsultan' => 'Hikam',
                'no_whatsapp' => '6283136359318',
                'email' => 'daielhikam@yahoo.com',
                'jenis_layanan' => 'premium',
                'budget' => '50+',
                'ukuran_dapur' => '5x6 meter',
                'alamat_lokasi' => 'Kp. Sudimampir, Cimanggis, Bogor',
                'pesan_kebutuhan' => 'Mau kitchen set premium dengan material import',
                'status_konsultasi' => 'baru',
                'dihubungi' => 'belum',
                'jadwal_survey' => null,
                'catatan_admin' => null,
                'tanggal_konsultasi' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($consultations as $consultation) {
            DB::table('konsultasi')->insert($consultation);
        }

        $this->command->info('✅ Consultations seeded: ' . count($consultations) . ' consultations');
    }
}