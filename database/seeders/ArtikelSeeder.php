<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtikelSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        $now = now();
        
        $articles = [
            [
                'judul_artikel' => '7 Tips Memilih Kitchen Set yang Tepat untuk Rumah Anda',
                'slug' => '7-tips-memilih-kitchen-set-tepat',
                'konten' => '<p>Memilih kitchen set yang tepat sangat penting untuk kenyamanan memasak. Berikut 7 tips yang bisa Anda pertimbangkan:</p>
<h2>1. Sesuaikan dengan Luas Dapur</h2>
<p>Ukuran dapur menentukan jenis kitchen set yang cocok. Untuk dapur kecil, pilih konsep straight line atau L-shape. Untuk dapur luas, Anda bisa memilih U-shape atau island.</p>
<h2>2. Pilih Material Berkualitas</h2>
<p>Material kabinet seperti multipleks MR grade atau MDF waterproof lebih tahan lama dan tair rayap. Untuk countertop, solid surface atau granit lebih mudah dibersihkan.</p>
<h2>3. Perhatikan Finishing</h2>
<p>Finishing HPL atau PVC lebih tahan gores dan air dibanding cat biasa. Pilih finishing yang sesuai dengan gaya rumah Anda.</p>
<h2>4. Gunakan Hardware Berkualitas</h2>
<p>Hardware seperti engsel dan rel laci sangat menentukan keawetan kitchen set. Pilih merk ternama seperti Blum, Hettich, atau Titus.</p>
<h2>5. Desain yang Ergonomis</h2>
<p>Pastikan kitchen set dirancang dengan prinsip ergonomis sehingga nyaman digunakan. Tinggi meja, posisi kompor, dan wastafel harus sesuai dengan postur tubuh.</p>
<h2>6. Perhatikan Pencahayaan</h2>
<p>Tambahkan pencahayaan di area kerja seperti di bawah kabinet atas. Ini akan memudahkan Anda saat memasak.</p>
<h2>7. Konsultasikan dengan Profesional</h2>
<p>Jangan ragu untuk berkonsultasi dengan desainer interior profesional. Mereka akan membantu mewujudkan dapur impian Anda.</p>
<p>Dengan mengikuti tips di atas, Anda akan mendapatkan kitchen set yang tidak hanya cantik tetapi juga fungsional dan tahan lama.</p>',
                'excerpt' => 'Memilih kitchen set yang tepat sangat penting untuk kenyamanan memasak. Berikut 7 tips yang bisa Anda pertimbangkan sebelum membeli kitchen set.',
                'gambar_utama' => null,
                'kategori' => 'tips_panduan',
                'tags' => 'kitchen set, tips, panduan, memilih kitchen set',
                'penulis' => 'Tim Bogorior',
                'status_artikel' => 'publish',
                'featured' => 1,
                'tanggal_publish' => $now->copy()->subDays(10),
                'views' => 1250,
                'meta_title' => '7 Tips Memilih Kitchen Set yang Tepat untuk Rumah Anda',
                'meta_description' => 'Panduan lengkap memilih kitchen set yang sesuai dengan kebutuhan dan budget Anda. Simak tips dari ahli desain interior.',
                'created_at' => $now->copy()->subDays(10),
                'updated_at' => $now->copy()->subDays(10),
            ],
            [
                'judul_artikel' => '5 Tren Desain Dapur Terbaru Tahun 2024',
                'slug' => '5-tren-desain-dapur-terbaru-2024',
                'konten' => '<p>Tahun 2024 membawa banyak tren menarik dalam desain dapur. Berikut 5 tren yang bisa Anda aplikasikan:</p>
<h2>1. Warna Earth Tone</h2>
<p>Warna-warna alami seperti hijau sage, coklat tanah, dan krem menjadi favorit. Warna ini menciptakan suasana hangat dan nyaman di dapur.</p>
<h2>2. Smart Kitchen</h2>
<p>Integrasi teknologi semakin marak. Kulkas pintar, keran sensor, dan sistem pencahayaan otomatis menjadi primadona.</p>
<h2>3. Sustainable Material</h2>
<p>Material ramah lingkungan seperti bambu, kayu daur ulang, dan cat rendah VOC semakin populer.</p>
<h2>4. Open Shelving</h2>
<p>Rak terbuka menggantikan kabinet tertutup untuk menampilkan peralatan dapur yang estetik.</p>
<h2>5. Two-Tone Kitchen</h2>
<p>Kombinasi dua warna pada kabinet atas dan bawah menciptakan dimensi visual yang menarik.</p>
<p>Tertarik mengaplikasikan tren ini? Konsultasikan dengan desainer kami untuk hasil terbaik!</p>',
                'excerpt' => 'Tahun 2024 membawa banyak tren menarik dalam desain dapur. Simak 5 tren terbaru yang bisa Anda aplikasikan di rumah.',
                'gambar_utama' => null,
                'kategori' => 'desain_inspirasi',
                'tags' => 'desain dapur, tren 2024, inspirasi desain',
                'penulis' => 'Tim Desainer Bogorior',
                'status_artikel' => 'publish',
                'featured' => 1,
                'tanggal_publish' => $now->copy()->subDays(5),
                'views' => 890,
                'meta_title' => '5 Tren Desain Dapur Terbaru Tahun 2024 - Bogorior',
                'meta_description' => 'Update tren desain dapur terbaru tahun 2024. Dari warna earth tone hingga smart kitchen, temukan inspirasi untuk dapur impian Anda.',
                'created_at' => $now->copy()->subDays(5),
                'updated_at' => $now->copy()->subDays(5),
            ],
            [
                'judul_artikel' => 'Cara Merawat Kitchen Set Agar Awet dan Tahan Lama',
                'slug' => 'cara-merawat-kitchen-set-awet',
                'konten' => '<p>Kitchen set adalah investasi jangka panjang. Berikut cara merawatnya agar tetap awet:</p>
<h2>1. Bersihkan Secara Rutin</h2>
<p>Lap kabinet dan countertop setiap hari dengan kain lembut dan cairan pembersih khusus. Hindari bahan kimia keras.</p>
<h2>2. Hindari Air Berlebih</h2>
<p>Meskipun material kitchen set tahan air, hindari genangan air yang terlalu lama karena dapat merusak finishing.</p>
<h2>3. Periksa Hardware Secara Berkala</h2>
<p>Kencangkan engsel dan rel laci jika mulai longgar. Oleskan pelumas khusus jika diperlukan.</p>
<h2>4. Gunakan Alas Panas</h2>
<p>Jangan letakkan panci atau wajan panas langsung di atas countertop. Gunakan alas panas untuk mencegah kerusakan.</p>
<h2>5. Hindari Beban Berlebih</h2>
<p>Jangan menumpuk barang terlalu berat di dalam kabinet atau laci. Ini dapat merusak hardware dan struktur kabinet.</p>
<p>Dengan perawatan yang tepat, kitchen set Anda akan tetap cantik dan fungsional selama bertahun-tahun.</p>',
                'excerpt' => 'Kitchen set adalah investasi jangka panjang. Pelajari cara merawatnya agar tetap awet dan tahan lama dengan tips sederhana ini.',
                'gambar_utama' => null,
                'kategori' => 'perawatan_maintenance',
                'tags' => 'perawatan, maintenance, kitchen set awet',
                'penulis' => 'Tim Teknis Bogorior',
                'status_artikel' => 'publish',
                'featured' => 0,
                'tanggal_publish' => $now->copy()->subDays(15),
                'views' => 620,
                'meta_title' => 'Cara Merawat Kitchen Set Agar Awet dan Tahan Lama',
                'meta_description' => 'Panduan lengkap merawat kitchen set agar tetap awet dan tahan lama. Tips dari teknisi profesional Bogorior.',
                'created_at' => $now->copy()->subDays(15),
                'updated_at' => $now->copy()->subDays(15),
            ],
            [
                'judul_artikel' => 'Perbandingan Material Countertop: Granit vs Quartz vs Solid Surface',
                'slug' => 'perbandingan-material-countertop',
                'konten' => '<p>Memilih material countertop yang tepat sangat penting. Berikut perbandingan tiga material populer:</p>
<h2>Granit</h2>
<p><strong>Kelebihan:</strong> Alami, tahan panas, tahan gores, nilai estetika tinggi.<br>
<strong>Kekurangan:</strong> Berat, perlu perawatan seal rutin, harga variatif.<br>
<strong>Harga:</strong> Rp 1.000.000 - Rp 3.000.000 per meter</p>
<h2>Quartz Stone</h2>
<p><strong>Kelebihan:</strong> Tidak berpori, anti noda, tidak perlu seal, warna konsisten.<br>
<strong>Kekurangan:</strong> Kurang tahan panas ekstrem, harga lebih mahal.<br>
<strong>Harga:</strong> Rp 1.500.000 - Rp 4.000.000 per meter</p>
<h2>Solid Surface</h2>
<p><strong>Kelebihan:</strong> Bisa dibentuk seamless, mudah diperbaiki, anti bakteri.<br>
<strong>Kekurangan:</strong> Kurang tahan panas dan gores.<br>
<strong>Harga:</strong> Rp 800.000 - Rp 2.000.000 per meter</p>
<p>Kesimpulan: Pilih sesuai budget dan kebutuhan. Quartz terbaik untuk performa, granit untuk tampilan alami, solid surface untuk budget terbatas.</p>',
                'excerpt' => 'Membandingkan tiga material countertop populer: Granit, Quartz, dan Solid Surface. Mana yang terbaik untuk dapur Anda?',
                'gambar_utama' => null,
                'kategori' => 'material_finishing',
                'tags' => 'countertop, granit, quartz, solid surface, material',
                'penulis' => 'Tim Bogorior',
                'status_artikel' => 'publish',
                'featured' => 0,
                'tanggal_publish' => $now->copy()->subDays(20),
                'views' => 450,
                'meta_title' => 'Perbandingan Material Countertop: Granit vs Quartz vs Solid Surface',
                'meta_description' => 'Bandingkan kelebihan dan kekurangan granit, quartz, dan solid surface untuk countertop dapur Anda. Panduan lengkap memilih material.',
                'created_at' => $now->copy()->subDays(20),
                'updated_at' => $now->copy()->subDays(20),
            ],
            [
                'judul_artikel' => 'Inspirasi Desain Dapur Minimalis untuk Rumah Tipe 36',
                'slug' => 'inspirasi-desain-dapur-minimalis-rumah-tipe-36',
                'konten' => '<p>Rumah tipe 36 biasanya memiliki dapur yang terbatas. Berikut inspirasi desain yang bisa Anda terapkan:</p>
<h2>1. Konsep Straight Line</h2>
<p>Letakkan semua peralatan dan kabinet dalam satu garis lurus. Ini menghemat ruang dan tetap fungsional.</p>
<h2>2. Manfaatkan Dinding</h2>
<p>Pasang rak gantung atau kabinet atas untuk menyimpan peralatan. Gunakan magnetic strip untuk pisau dan spatula.</p>
<h2>3. Pilih Warna Terang</h2>
<p>Warna putih, krem, atau pastel membuat dapur terasa lebih luas dan terang.</p>
<h2>4. Gunakan Perabot Multifungsi</h2>
<p>Pilih meja makan yang bisa dilipat atau troli tambahan yang bisa dipindahkan.</p>
<h2>5. Optimalkan Pencahayaan</h2>
<p>Pasang lampu LED di bawah kabinet untuk menerangi area kerja tanpa memakan ruang.</p>
<p>Dengan desain yang tepat, dapur minimalis Anda bisa tetap fungsional dan estetis.</p>',
                'excerpt' => 'Inspirasi desain dapur minimalis untuk rumah tipe 36. Tips mengoptimalkan ruang terbatas agar tetap fungsional dan estetis.',
                'gambar_utama' => null,
                'kategori' => 'desain_inspirasi',
                'tags' => 'dapur minimalis, rumah tipe 36, desain dapur kecil',
                'penulis' => 'Tim Desainer Bogorior',
                'status_artikel' => 'publish',
                'featured' => 0,
                'tanggal_publish' => $now->copy()->subDays(25),
                'views' => 780,
                'meta_title' => 'Inspirasi Desain Dapur Minimalis untuk Rumah Tipe 36',
                'meta_description' => 'Dapatkan inspirasi desain dapur minimalis untuk rumah tipe 36. Tips dari desainer profesional untuk memaksimalkan ruang terbatas.',
                'created_at' => $now->copy()->subDays(25),
                'updated_at' => $now->copy()->subDays(25),
            ],
        ];

        foreach ($articles as $article) {
            DB::table('artikel')->insert($article);
        }

        $this->command->info('✅ Articles seeded: ' . count($articles) . ' articles');
    }
}