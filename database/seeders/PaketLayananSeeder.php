<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaketLayananSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        $now = now();
        
        $packages = [
            [
                'nama_paket' => 'Kitchen Set Custom',
                'slug_paket' => 'kitchen-set-custom',
                'jenis_layanan' => 'custom',
                'harga_mulai' => 8500000,
                'deskripsi_singkat' => 'Desain sesuai keinginan Anda dengan material pilihan berkualitas',
                'deskripsi_lengkap' => '<p>Layanan kitchen set custom dirancang untuk Anda yang menginginkan kebebasan dalam mendesain dapur impian. Tim desainer kami akan bekerja sama dengan Anda untuk menciptakan kitchen set yang sesuai dengan kebutuhan, gaya, dan budget.</p>
<h3>Keunggulan:</h3>
<ul>
<li>Desain 100% customizable sesuai keinginan</li>
<li>Free konsultasi desain 3D</li>
<li>Material pilihan berkualitas</li>
<li>Garansi 5 tahun</li>
</ul>',
                'fitur' => json_encode(['Desain Custom', 'Free Konsultasi', 'Material Premium', 'Garansi 5 Tahun']),
                'spesifikasi' => json_encode(['Kabinet: Multipleks MR Grade 18mm', 'Finishing: HPL/PVC', 'Countertop: Solid Surface/Granit', 'Hardware: Standard Indonesia/Hettich']),
                'gambar_paket' => null,
                'popular' => 1,
                'urutan' => 1,
                'aktif' => 1,
            ],
            [
                'nama_paket' => 'Kitchen Set Premium',
                'slug_paket' => 'kitchen-set-premium',
                'jenis_layanan' => 'premium',
                'harga_mulai' => 15000000,
                'deskripsi_singkat' => 'Material import kualitas terbaik dengan finishing mewah',
                'deskripsi_lengkap' => '<p>Kitchen set premium menggunakan material import terbaik dengan finishing mewah. Cocok untuk Anda yang menginginkan dapur dengan kesan elegan dan modern.</p>
<h3>Keunggulan:</h3>
<ul>
<li>Material import berkualitas tinggi</li>
<li>Finishing high gloss acrylic</li>
<li>Hardware Blum Austria</li>
<li>Countertop quartz/granit import</li>
<li>Garansi 5 tahun</li>
</ul>',
                'fitur' => json_encode(['Material Import', 'Hardware Blum', 'Finishing High Gloss', 'Countertop Premium', 'Garansi 5 Tahun']),
                'spesifikasi' => json_encode(['Kabinet: MDF Waterproof Import', 'Finishing: High Gloss Acrylic', 'Countertop: Quartz Stone/Granit Import', 'Hardware: Blum Austria']),
                'gambar_paket' => null,
                'popular' => 1,
                'urutan' => 2,
                'aktif' => 1,
            ],
            [
                'nama_paket' => 'Renovasi Dapur',
                'slug_paket' => 'renovasi-dapur',
                'jenis_layanan' => 'renovasi',
                'harga_mulai' => 5000000,
                'deskripsi_singkat' => 'Perbaharui tampilan dapur Anda dengan biaya terjangkau',
                'deskripsi_lengkap' => '<p>Layanan renovasi dapur untuk menyegarkan tampilan dapur Anda tanpa perlu membongkar seluruh struktur. Kami akan memberikan saran terbaik untuk memperbaharui dapur Anda dengan budget optimal.</p>
<h3>Keunggulan:</h3>
<ul>
<li>Biaya terjangkau</li>
<li>Pengerjaan cepat</li>
<li>Minimal renovasi struktur</li>
<li>Hasil maksimal</li>
</ul>',
                'fitur' => json_encode(['Ganti Kabinet', 'Ganti Countertop', 'Perbaikan Hardware', 'Finishing Ulang']),
                'spesifikasi' => json_encode(['Sesuai kebutuhan dan kondisi existing']),
                'gambar_paket' => null,
                'popular' => 0,
                'urutan' => 3,
                'aktif' => 1,
            ],
            [
                'nama_paket' => 'Interior Design',
                'slug_paket' => 'interior-design',
                'jenis_layanan' => 'interior',
                'harga_mulai' => 25000000,
                'deskripsi_singkat' => 'Desain interior lengkap untuk seluruh ruangan',
                'deskripsi_lengkap' => '<p>Layanan desain interior lengkap untuk seluruh ruangan di rumah Anda. Tim desainer profesional kami akan membantu menciptakan hunian yang nyaman, fungsional, dan estetis.</p>
<h3>Keunggulan:</h3>
<ul>
<li>Desain 3D lengkap</li>
<li>Konsultasi dengan desainer senior</li>
<li>Pemilihan material dan furniture</li>
<li>Supervisi pengerjaan</li>
</ul>',
                'fitur' => json_encode(['Desain 3D Lengkap', 'Konsultasi Senior Designer', 'Pemilihan Material', 'Supervisi Pengerjaan']),
                'spesifikasi' => json_encode(['Sesuai kebutuhan ruangan']),
                'gambar_paket' => null,
                'popular' => 0,
                'urutan' => 4,
                'aktif' => 1,
            ],
        ];

        foreach ($packages as $package) {
            DB::table('paket_layanan')->updateOrInsert(
                ['slug_paket' => $package['slug_paket']],
                [
                    'nama_paket' => $package['nama_paket'],
                    'slug_paket' => $package['slug_paket'],
                    'jenis_layanan' => $package['jenis_layanan'],
                    'harga_mulai' => $package['harga_mulai'],
                    'deskripsi_singkat' => $package['deskripsi_singkat'],
                    'deskripsi_lengkap' => $package['deskripsi_lengkap'],
                    'fitur' => $package['fitur'],
                    'spesifikasi' => $package['spesifikasi'],
                    'gambar_paket' => $package['gambar_paket'],
                    'popular' => $package['popular'],
                    'urutan' => $package['urutan'],
                    'aktif' => $package['aktif'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        $this->command->info('✅ Service packages seeded: ' . count($packages) . ' packages');
    }
}