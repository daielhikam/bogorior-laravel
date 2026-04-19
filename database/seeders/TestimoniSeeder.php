<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimoniSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        
        $testimonials = [
            ['id_project' => 1, 'nama_client' => 'Budi Santoso', 'rating' => 5, 'testimoni' => 'Sangat puas dengan hasil kitchen set dari Bogorior. Desain sesuai keinginan, pengerjaan cepat.', 'jenis_project' => 'Kitchen Set Custom', 'lokasi' => 'Bogor', 'status_testimoni' => 'approved', 'featured' => 1],
            ['id_project' => 2, 'nama_client' => 'Sari Dewi', 'rating' => 5, 'testimoni' => 'Dapur saya sekarang terlihat mewah dan modern berkat Bogorior. Highly recommended!', 'jenis_project' => 'Renovasi Dapur', 'lokasi' => 'Jakarta', 'status_testimoni' => 'approved', 'featured' => 1],
            ['id_project' => 3, 'nama_client' => 'Rudi Hartono', 'rating' => 5, 'testimoni' => 'Material premium, finishing sempurna, pelayanan sangat baik. Dapur impian saya akhirnya terwujud.', 'jenis_project' => 'Kitchen Set Premium', 'lokasi' => 'Depok', 'status_testimoni' => 'approved', 'featured' => 1],
        ];

        foreach ($testimonials as $testimonial) {
            DB::table('testimoni')->insert([
                'id_project' => $testimonial['id_project'],
                'nama_client' => $testimonial['nama_client'],
                'rating' => $testimonial['rating'],
                'testimoni' => $testimonial['testimoni'],
                'jenis_project' => $testimonial['jenis_project'],
                'lokasi' => $testimonial['lokasi'],
                'status_testimoni' => $testimonial['status_testimoni'],
                'featured' => $testimonial['featured'],
                'tipe_testimoni' => 'teks',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->command->info('✅ Testimonials seeded: ' . count($testimonials) . ' testimonials');
    }
}