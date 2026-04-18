<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        $now = now();
        
        $projects = [
            [
                'id_pelanggan' => 1,
                'id_konsultasi' => 1,
                'kode_project' => 'KS2024-0001',
                'nama_project' => 'Kitchen Set Modern Minimalist Bogor',
                'jenis_project' => 'custom',
                'kategori_desain' => 'minimalist',
                'luas_area' => 12.00,
                'lokasi_project' => 'Bogor',
                'alamat_lengkap' => 'Jl. Merdeka No. 1, Bogor',
                'budget_project' => 25000000,
                'biaya_actual' => 23500000,
                'durasi_pengerjaan' => '25 hari',
                'deskripsi_project' => 'Kitchen set modern minimalist dengan konsep L-shaped. Menggunakan material multipleks MR grade dengan finishing HPL warna putih dan woodgrain.',
                'testimoni_client' => 'Sangat puas dengan hasil kitchen set dari Bogorior. Desain sesuai keinginan, pengerjaan cepat, dan tim profesional. Recommended!',
                'rating_project' => 5,
                'status_project' => 'selesai',
                'tanggal_mulai' => $now->copy()->subDays(60),
                'tanggal_selesai' => $now->copy()->subDays(35),
                'tanggal_garansi' => $now->copy()->addYears(5)->subDays(35),
                'created_at' => $now->copy()->subDays(90),
                'updated_at' => $now->copy()->subDays(35),
            ],
            [
                'id_pelanggan' => 2,
                'id_konsultasi' => 2,
                'kode_project' => 'KS2024-0002',
                'nama_project' => 'Renovasi Dapur Jakarta Selatan',
                'jenis_project' => 'renovasi',
                'kategori_desain' => 'modern',
                'luas_area' => 20.00,
                'lokasi_project' => 'Jakarta Selatan',
                'alamat_lengkap' => 'Jl. Sudirman No. 45, Jakarta Selatan',
                'budget_project' => 45000000,
                'biaya_actual' => 42500000,
                'durasi_pengerjaan' => '30 hari',
                'deskripsi_project' => 'Renovasi total dapur termasuk pembongkaran lama, pemasangan kitchen set baru dengan konsep modern, dan instalasi listrik.',
                'testimoni_client' => 'Terima kasih Bogorior, dapur saya jadi lebih cantik dan fungsional. Tim sangat profesional dan tepat waktu.',
                'rating_project' => 5,
                'status_project' => 'selesai',
                'tanggal_mulai' => $now->copy()->subDays(45),
                'tanggal_selesai' => $now->copy()->subDays(15),
                'tanggal_garansi' => $now->copy()->addYears(5)->subDays(15),
                'created_at' => $now->copy()->subDays(75),
                'updated_at' => $now->copy()->subDays(15),
            ],
            [
                'id_pelanggan' => 3,
                'id_konsultasi' => 3,
                'kode_project' => 'KS2024-0003',
                'nama_project' => 'Kitchen Set Premium Depok',
                'jenis_project' => 'premium',
                'kategori_desain' => 'luxury',
                'luas_area' => 15.00,
                'lokasi_project' => 'Depok',
                'alamat_lengkap' => 'Jl. Gatot Subroto No. 67, Depok',
                'budget_project' => 75000000,
                'biaya_actual' => 78000000,
                'durasi_pengerjaan' => '35 hari',
                'deskripsi_project' => 'Kitchen set premium dengan material import. Finishing high gloss acrylic, countertop quartz stone, dan hardware Blum Austria.',
                'testimoni_client' => 'Dapur impian saya akhirnya terwujud! Material premium, finishing sempurna, dan pelayanan sangat baik.',
                'rating_project' => 5,
                'status_project' => 'selesai',
                'tanggal_mulai' => $now->copy()->subDays(90),
                'tanggal_selesai' => $now->copy()->subDays(55),
                'tanggal_garansi' => $now->copy()->addYears(5)->subDays(55),
                'created_at' => $now->copy()->subDays(120),
                'updated_at' => $now->copy()->subDays(55),
            ],
            [
                'id_pelanggan' => 4,
                'id_konsultasi' => 4,
                'kode_project' => 'KS2024-0004',
                'nama_project' => 'Kitchen Set Minimalis Bogor',
                'jenis_project' => 'custom',
                'kategori_desain' => 'minimalist',
                'luas_area' => 9.00,
                'lokasi_project' => 'Bogor',
                'alamat_lengkap' => 'Jl. Pajajaran No. 23, Bogor',
                'budget_project' => 18500000,
                'biaya_actual' => 18000000,
                'durasi_pengerjaan' => '20 hari',
                'deskripsi_project' => 'Kitchen set minimalis untuk dapur kecil dengan konsep straight line. Efisien dan fungsional.',
                'testimoni_client' => 'Dapur mungil saya jadi terlihat luas dan rapi. Terima kasih Bogorior!',
                'rating_project' => 5,
                'status_project' => 'produksi',
                'tanggal_mulai' => $now->copy()->subDays(10),
                'tanggal_selesai' => null,
                'tanggal_garansi' => null,
                'created_at' => $now->copy()->subDays(20),
                'updated_at' => $now->copy()->subDays(10),
            ],
            [
                'id_pelanggan' => 1,
                'id_konsultasi' => null,
                'kode_project' => 'KS2024-0005',
                'nama_project' => 'Interior Design Rumah Bogor',
                'jenis_project' => 'interior',
                'kategori_desain' => 'contemporary',
                'luas_area' => 50.00,
                'lokasi_project' => 'Bogor',
                'alamat_lengkap' => 'Jl. Merdeka No. 1, Bogor',
                'budget_project' => 150000000,
                'biaya_actual' => null,
                'durasi_pengerjaan' => null,
                'deskripsi_project' => 'Desain interior untuk seluruh rumah termasuk ruang tamu, ruang keluarga, kamar tidur, dan dapur.',
                'testimoni_client' => null,
                'rating_project' => null,
                'status_project' => 'desain',
                'tanggal_mulai' => null,
                'tanggal_selesai' => null,
                'tanggal_garansi' => null,
                'created_at' => $now->copy()->subDays(5),
                'updated_at' => $now->copy()->subDays(5),
            ],
        ];

        foreach ($projects as $project) {
            DB::table('project')->insert($project);
        }

        $this->command->info('✅ Projects seeded: ' . count($projects) . ' projects');
    }
}