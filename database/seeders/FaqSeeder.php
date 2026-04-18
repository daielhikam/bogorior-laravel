<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        $now = now();
        
        $faqs = [
            // Layanan
            [
                'pertanyaan' => 'Apa saja layanan yang ditawarkan oleh Bogorior KitchenSet?',
                'jawaban' => 'Kami menawarkan berbagai layanan kitchen set mulai dari Kitchen Set Custom (desain sesuai keinginan), Kitchen Set Premium (material import kualitas terbaik), Renovasi Dapur, hingga Interior Design untuk seluruh ruangan.',
                'kategori' => 'layanan',
                'urutan' => 1,
                'aktif' => 1,
            ],
            [
                'pertanyaan' => 'Apakah bisa konsultasi desain sebelum memesan?',
                'jawaban' => 'Ya, kami menyediakan konsultasi desain GRATIS. Anda bisa berkonsultasi langsung dengan tim desainer kami baik secara online maupun survey langsung ke lokasi.',
                'kategori' => 'layanan',
                'urutan' => 2,
                'aktif' => 1,
            ],
            
            // Pembayaran
            [
                'pertanyaan' => 'Bagaimana sistem pembayarannya?',
                'jawaban' => 'Kami menyediakan beberapa opsi pembayaran: transfer bank (BCA, Mandiri, BRI, BNI), cicilan 0% hingga 36 bulan melalui kerjasama dengan bank mitra, dan pembayaran bertahap sesuai progress pengerjaan.',
                'kategori' => 'pembayaran',
                'urutan' => 1,
                'aktif' => 1,
            ],
            [
                'pertanyaan' => 'Apakah ada biaya tambahan selain harga yang ditawarkan?',
                'jawaban' => 'Harga yang kami tawarkan sudah termasuk material, jasa produksi, dan pemasangan. Biaya tambahan hanya akan muncul jika ada perubahan desain di luar kesepakatan awal atau penambahan fitur di luar paket.',
                'kategori' => 'pembayaran',
                'urutan' => 2,
                'aktif' => 1,
            ],
            
            // Garansi
            [
                'pertanyaan' => 'Berapa lama garansi untuk kitchen set?',
                'jawaban' => 'Kami memberikan garansi 5 tahun untuk semua produk kitchen set. Garansi mencakup kerusakan material dan pengerjaan. Untuk kerusakan akibat pemakaian normal, kami memberikan service gratis selama masa garansi.',
                'kategori' => 'garansi',
                'urutan' => 1,
                'aktif' => 1,
            ],
            [
                'pertanyaan' => 'Apa saja yang dicakup dalam garansi?',
                'jawaban' => 'Garansi mencakup: kerusakan pada kabinet (retak, patah), masalah pada engsel dan rel, kerusakan pada finishing (mengelupas), dan masalah pada instalasi. Garansi tidak mencakup kerusakan akibat bencana alam atau kesalahan penggunaan.',
                'kategori' => 'garansi',
                'urutan' => 2,
                'aktif' => 1,
            ],
            
            // Pemasangan
            [
                'pertanyaan' => 'Berapa lama proses pembuatan dan pemasangan kitchen set?',
                'jawaban' => 'Proses pembuatan kitchen set biasanya memakan waktu 3-4 minggu tergantung kompleksitas desain dan material yang dipilih. Prosesnya meliputi: konsultasi desain (1-3 hari), produksi (2-3 minggu), dan pemasangan (3-7 hari).',
                'kategori' => 'pemasangan',
                'urutan' => 1,
                'aktif' => 1,
            ],
            [
                'pertanyaan' => 'Apakah perlu merenovasi dapur terlebih dahulu?',
                'jawaban' => 'Tidak selalu. Tim kami akan melakukan survey terlebih dahulu untuk mengevaluasi kondisi dapur Anda. Jika diperlukan penyesuaian seperti perbaikan lantai, plafon, atau instalasi listrik, kami akan memberikan rekomendasi.',
                'kategori' => 'pemasangan',
                'urutan' => 2,
                'aktif' => 1,
            ],
            
            // Material
            [
                'pertanyaan' => 'Material apa yang digunakan untuk kitchen set?',
                'jawaban' => 'Kami menggunakan material berkualitas tinggi seperti multipleks MR grade, MDF waterproof, HPL import, finishing PVC woodgrain, countertop solid surface/granit/quartz, serta hardware dari merk ternama seperti Blum, Hettich, dan Titus.',
                'kategori' => 'material',
                'urutan' => 1,
                'aktif' => 1,
            ],
            [
                'pertanyaan' => 'Apakah material kitchen set tahan air dan rayap?',
                'jawaban' => 'Ya, kami menggunakan material yang telah di-treatment anti rayap dan tahan air. Untuk area yang terkena air langsung (seperti sekitar wastafel), kami memberikan lapisan waterproof tambahan.',
                'kategori' => 'material',
                'urutan' => 2,
                'aktif' => 1,
            ],
            
            // Umum
            [
                'pertanyaan' => 'Apakah melayani area luar kota?',
                'jawaban' => 'Ya, kami melayani seluruh wilayah Jabodetabek dan sekitarnya. Untuk wilayah luar kota, akan dikenakan biaya tambahan untuk transportasi dan akomodasi tim.',
                'kategori' => 'umum',
                'urutan' => 1,
                'aktif' => 1,
            ],
            [
                'pertanyaan' => 'Bagaimana cara memesan kitchen set?',
                'jawaban' => 'Anda dapat memesan melalui: (1) Mengisi form konsultasi di website, (2) WhatsApp ke nomor kami, (3) Telepon langsung, atau (4) Datang ke showroom kami. Tim kami akan segera merespon dan menjadwalkan survey.',
                'kategori' => 'umum',
                'urutan' => 2,
                'aktif' => 1,
            ],
        ];

        foreach ($faqs as $faq) {
            DB::table('faq')->insert([
                'pertanyaan' => $faq['pertanyaan'],
                'jawaban' => $faq['jawaban'],
                'kategori' => $faq['kategori'],
                'urutan' => $faq['urutan'],
                'aktif' => $faq['aktif'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->command->info('✅ FAQs seeded: ' . count($faqs) . ' FAQs');
    }
}