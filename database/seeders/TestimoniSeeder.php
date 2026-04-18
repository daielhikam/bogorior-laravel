<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimoniSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        $now = now();
        
        $testimonials = [
            [
                'id_project' => 1,
                'nama_client' => 'Budi Santoso',
                'foto_client' => null,
                'url_video' => null,
                'video_platform' => null,
                'video_id' => null,
                'video_thumbnail' => null,
                'rating' => 5,
                'testimoni' => 'Sangat puas dengan hasil kitchen set dari Bogorior. Desain sesuai keinginan, pengerjaan cepat, dan tim profesional. Dapur saya sekarang jadi lebih cantik dan fungsional. Terima kasih Bogorior!',
                'jenis_project' => 'Kitchen Set Custom',
                'lokasi' => 'Bogor',
                'status_testimoni' => 'approved',
                'tipe_testimoni' => 'teks',
                'featured' => 1,
                'tanggal_testimoni' => $now->copy()->subDays(30),
                'created_at' => $now->copy()->subDays(30),
                'updated_at' => $now->copy()->subDays(30),
            ],
            [
                'id_project' => 2,
                'nama_client' => 'Sari Dewi',
                'foto_client' => null,
                'url_video' => null,
                'video_platform' => null,
                'video_id' => null,
                'video_thumbnail' => null,
                'rating' => 5,
                'testimoni' => 'Dapur saya sekarang terlihat mewah dan modern berkat Bogorior. Tim desainer sangat membantu mewujudkan impian saya. Proses renovasi juga cepat dan rapi. Highly recommended!',
                'jenis_project' => 'Renovasi Dapur',
                'lokasi' => 'Jakarta',
                'status_testimoni' => 'approved',
                'tipe_testimoni' => 'teks',
                'featured' => 1,
                'tanggal_testimoni' => $now->copy()->subDays(10),
                'created_at' => $now->copy()->subDays(10),
                'updated_at' => $now->copy()->subDays(10),
            ],
            [
                'id_project' => 3,
                'nama_client' => 'Rudi Hartono',
                'foto_client' => null,
                'url_video' => null,
                'video_platform' => null,
                'video_id' => null,
                'video_thumbnail' => null,
                'rating' => 5,
                'testimoni' => 'Material premium, finishing sempurna, pelayanan sangat baik. Bogorior benar-benar profesional. Dapur impian saya akhirnya terwujud. Terima kasih tim Bogorior!',
                'jenis_project' => 'Kitchen Set Premium',
                'lokasi' => 'Depok',
                'status_testimoni' => 'approved',
                'tipe_testimoni' => 'teks',
                'featured' => 1,
                'tanggal_testimoni' => $now->copy()->subDays(50),
                'created_at' => $now->copy()->subDays(50),
                'updated_at' => $now->copy()->subDays(50),
            ],
        ];

        foreach ($testimonials as $testimonial) {
            DB::table('testimoni')->insert($testimonial);
        }

        $this->command->info('✅ Testimonials seeded: ' . count($testimonials) . ' testimonials');
    }
}