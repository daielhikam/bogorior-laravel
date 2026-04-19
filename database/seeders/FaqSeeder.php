<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        
        $faqs = [
            ['pertanyaan' => 'Apa saja layanan yang ditawarkan oleh Bogorior KitchenSet?', 'jawaban' => 'Kami menawarkan berbagai layanan kitchen set mulai dari Kitchen Set Custom, Kitchen Set Premium, Renovasi Dapur, hingga Interior Design.', 'kategori' => 'layanan', 'urutan' => 1],
            ['pertanyaan' => 'Apakah bisa konsultasi desain sebelum memesan?', 'jawaban' => 'Ya, kami menyediakan konsultasi desain GRATIS. Anda bisa berkonsultasi langsung dengan tim desainer kami.', 'kategori' => 'layanan', 'urutan' => 2],
            ['pertanyaan' => 'Bagaimana sistem pembayarannya?', 'jawaban' => 'Kami menyediakan beberapa opsi pembayaran: transfer bank, cicilan 0% hingga 36 bulan, dan pembayaran bertahap sesuai progress pengerjaan.', 'kategori' => 'pembayaran', 'urutan' => 1],
            ['pertanyaan' => 'Berapa lama garansi untuk kitchen set?', 'jawaban' => 'Kami memberikan garansi 5 tahun untuk semua produk kitchen set.', 'kategori' => 'garansi', 'urutan' => 1],
            ['pertanyaan' => 'Berapa lama proses pembuatan dan pemasangan kitchen set?', 'jawaban' => 'Proses pembuatan kitchen set biasanya memakan waktu 3-4 minggu tergantung kompleksitas desain.', 'kategori' => 'pemasangan', 'urutan' => 1],
            ['pertanyaan' => 'Material apa yang digunakan untuk kitchen set?', 'jawaban' => 'Kami menggunakan material berkualitas tinggi seperti multipleks MR grade, MDF waterproof, HPL import, dan hardware dari merk ternama.', 'kategori' => 'material', 'urutan' => 1],
            ['pertanyaan' => 'Apakah melayani area luar kota?', 'jawaban' => 'Ya, kami melayani seluruh wilayah Jabodetabek dan sekitarnya.', 'kategori' => 'umum', 'urutan' => 1],
        ];

        foreach ($faqs as $faq) {
            DB::table('faq')->insert([
                'pertanyaan' => $faq['pertanyaan'],
                'jawaban' => $faq['jawaban'],
                'kategori' => $faq['kategori'],
                'urutan' => $faq['urutan'],
                'aktif' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->command->info('✅ FAQs seeded: ' . count($faqs) . ' FAQs');
    }
}