<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HalamanSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        $now = now();
        
        $pages = [
            [
                'judul_halaman' => 'Tentang Kami',
                'slug_halaman' => 'tentang-kami',
                'konten' => '<div class="about-content">
<h2>Bogorior KitchenSet</h2>
<p>Bogorior KitchenSet adalah spesialis kitchen set di Bogor dengan pengalaman lebih dari 10 tahun. Kami telah membantu lebih dari 500+ klien mewujudkan dapur impian mereka.</p>
<h3>Visi Kami</h3>
<p>Menjadi penyedia kitchen set terdepan di Indonesia yang menggabungkan kualitas premium, desain inovatif, dan layanan terbaik.</p>
<h3>Misi Kami</h3>
<ul>
<li>Memberikan solusi kitchen set berkualitas tinggi dengan harga terjangkau</li>
<li>Menghadirkan desain yang sesuai dengan kebutuhan dan gaya hidup pelanggan</li>
<li>Memberikan layanan purna jual yang responsif dan memuaskan</li>
<li>Terus berinovasi dalam material dan teknologi pengerjaan</li>
</ul>
<h3>Mengapa Memilih Kami?</h3>
<ul>
<li>Garansi 5 tahun untuk semua produk</li>
<li>Tim desainer profesional dan berpengalaman</li>
<li>Material berkualitas premium</li>
<li>Proses pengerjaan cepat 3-4 minggu</li>
<li>Free survey dan konsultasi desain</li>
<li>Cicilan 0% hingga 36 bulan</li>
</ul>
</div>',
                'jenis_halaman' => 'tentang',
                'meta_title' => 'Tentang Bogorior KitchenSet - Profil Perusahaan',
                'meta_description' => 'Bogorior KitchenSet adalah spesialis kitchen set di Bogor dengan pengalaman lebih dari 10 tahun. Telah melayani 500+ klien dengan kualitas terbaik.',
                'status_halaman' => 'publish',
                'urutan' => 1,
            ],
            [
                'judul_halaman' => 'Kontak Kami',
                'slug_halaman' => 'kontak-kami',
                'konten' => '<div class="contact-content">
<h2>Hubungi Kami</h2>
<p>Tim kami siap membantu Anda mewujudkan dapur impian. Jangan ragu untuk menghubungi kami melalui form kontak atau informasi berikut:</p>
<div class="contact-info">
<div class="info-item">
<i class="fas fa-map-marker-alt"></i>
<div>
<h4>Alamat</h4>
<p>Bogor, Indonesia</p>
</div>
</div>
<div class="info-item">
<i class="fas fa-phone"></i>
<div>
<h4>Telepon</h4>
<p>+62 897 7288 600</p>
</div>
</div>
<div class="info-item">
<i class="fab fa-whatsapp"></i>
<div>
<h4>WhatsApp</h4>
<p>+62 897 7288 600</p>
</div>
</div>
<div class="info-item">
<i class="fas fa-envelope"></i>
<div>
<h4>Email</h4>
<p>info@bogorior.com</p>
</div>
</div>
</div>
<div class="business-hours">
<h4>Jam Operasional</h4>
<p>Senin - Sabtu: 09:00 - 17:00 WIB</p>
<p>Minggu: Tutup</p>
</div>
</div>',
                'jenis_halaman' => 'kontak',
                'meta_title' => 'Kontak Bogorior KitchenSet - Hubungi Kami',
                'meta_description' => 'Hubungi tim Bogorior KitchenSet untuk konsultasi gratis tentang kitchen set impian Anda. Tersedia layanan via WhatsApp, telepon, atau email.',
                'status_halaman' => 'publish',
                'urutan' => 2,
            ],
            [
                'judul_halaman' => 'Syarat & Ketentuan',
                'slug_halaman' => 'syarat-ketentuan',
                'konten' => '<div class="terms-content">
<h2>Syarat & Ketentuan</h2>
<p>Terakhir diperbarui: ' . date('d F Y') . '</p>
<h3>1. Pemesanan</h3>
<p>Pemesanan dianggap sah setelah client melakukan pembayaran DP minimal 50% dari total nilai proyek dan kedua belah pihak menandatangani kontrak kerja sama.</p>
<h3>2. Pembayaran</h3>
<p>Pembayaran dapat dilakukan melalui transfer bank ke rekening resmi Bogorior KitchenSet. Jadwal pembayaran akan diatur dalam kontrak.</p>
<h3>3. Garansi</h3>
<p>Garansi 5 tahun berlaku untuk kerusakan material dan pengerjaan. Garansi tidak berlaku untuk kerusakan akibat kesalahan penggunaan atau bencana alam.</p>
<h3>4. Revisi Desain</h3>
<p>Client berhak melakukan maksimal 3 kali revisi desain tanpa biaya tambahan. Revisi selanjutnya akan dikenakan biaya sesuai kesepakatan.</p>
<h3>5. Waktu Pengerjaan</h3>
<p>Waktu pengerjaan 3-4 minggu terhitung sejak desain disetujui dan DP diterima. Keterlambatan akibat force majeure tidak dapat dikenakan sanksi.</p>
</div>',
                'jenis_halaman' => 'syarat_ketentuan',
                'meta_title' => 'Syarat & Ketentuan Bogorior KitchenSet',
                'meta_description' => 'Baca syarat dan ketentuan layanan Bogorior KitchenSet sebelum melakukan pemesanan kitchen set.',
                'status_halaman' => 'publish',
                'urutan' => 3,
            ],
            [
                'judul_halaman' => 'Kebijakan Privasi',
                'slug_halaman' => 'kebijakan-privasi',
                'konten' => '<div class="privacy-content">
<h2>Kebijakan Privasi</h2>
<p>Terakhir diperbarui: ' . date('d F Y') . '</p>
<p>Bogorior KitchenSet menghormati privasi Anda. Kebijakan privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi pribadi Anda.</p>
<h3>Informasi yang Kami Kumpulkan</h3>
<p>Kami mengumpulkan informasi yang Anda berikan secara sukarela saat mengisi formulir konsultasi, kontak, atau berlangganan newsletter, seperti nama, email, nomor telepon, dan alamat.</p>
<h3>Penggunaan Informasi</h3>
<p>Informasi yang kami kumpulkan digunakan untuk: memproses konsultasi, mengirimkan informasi promo, meningkatkan layanan kami, dan komunikasi terkait proyek.</p>
<h3>Perlindungan Data</h3>
<p>Kami menggunakan langkah-langkah keamanan yang tepat untuk melindungi informasi pribadi Anda dari akses tidak sah.</p>
<h3>Pembagian Informasi</h3>
<p>Kami tidak akan menjual, memperdagangkan, atau mentransfer informasi pribadi Anda kepada pihak ketiga tanpa persetujuan Anda, kecuali diwajibkan oleh hukum.</p>
</div>',
                'jenis_halaman' => 'kebijakan_privasi',
                'meta_title' => 'Kebijakan Privasi Bogorior KitchenSet',
                'meta_description' => 'Baca kebijakan privasi Bogorior KitchenSet tentang bagaimana kami mengelola dan melindungi data pribadi Anda.',
                'status_halaman' => 'publish',
                'urutan' => 4,
            ],
        ];

        foreach ($pages as $page) {
            DB::table('halaman')->updateOrInsert(
                ['slug_halaman' => $page['slug_halaman']],
                [
                    'judul_halaman' => $page['judul_halaman'],
                    'slug_halaman' => $page['slug_halaman'],
                    'konten' => $page['konten'],
                    'jenis_halaman' => $page['jenis_halaman'],
                    'meta_title' => $page['meta_title'],
                    'meta_description' => $page['meta_description'],
                    'status_halaman' => $page['status_halaman'],
                    'urutan' => $page['urutan'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        $this->command->info('✅ Static pages seeded: ' . count($pages) . ' pages');
    }
}