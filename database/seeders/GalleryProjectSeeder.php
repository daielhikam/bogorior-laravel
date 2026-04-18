<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GalleryProjectSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        $now = now();
        
        $galleries = [
            // Project 1 - Kitchen Set Modern Minimalist
            [
                'id_project' => 1,
                'jenis_foto' => 'sesudah',
                'nama_file' => 'project1_after1.jpg',
                'url_foto' => 'uploads/projects/project1_after1.jpg',
                'deskripsi_foto' => 'Tampilan depan kitchen set',
                'thumbnail' => 1,
                'urutan' => 1,
                'created_at' => $now,
            ],
            [
                'id_project' => 1,
                'jenis_foto' => 'sesudah',
                'nama_file' => 'project1_after2.jpg',
                'url_foto' => 'uploads/projects/project1_after2.jpg',
                'deskripsi_foto' => 'Detail kabinet dan hardware',
                'thumbnail' => 0,
                'urutan' => 2,
                'created_at' => $now,
            ],
            [
                'id_project' => 1,
                'jenis_foto' => 'sebelum',
                'nama_file' => 'project1_before1.jpg',
                'url_foto' => 'uploads/projects/project1_before1.jpg',
                'deskripsi_foto' => 'Kondisi dapur sebelum renovasi',
                'thumbnail' => 0,
                'urutan' => 3,
                'created_at' => $now,
            ],
            
            // Project 2 - Renovasi Dapur Jakarta
            [
                'id_project' => 2,
                'jenis_foto' => 'sesudah',
                'nama_file' => 'project2_after1.jpg',
                'url_foto' => 'uploads/projects/project2_after1.jpg',
                'deskripsi_foto' => 'Dapur setelah renovasi',
                'thumbnail' => 1,
                'urutan' => 1,
                'created_at' => $now,
            ],
            [
                'id_project' => 2,
                'jenis_foto' => 'sesudah',
                'nama_file' => 'project2_after2.jpg',
                'url_foto' => 'uploads/projects/project2_after2.jpg',
                'deskripsi_foto' => 'Sudut lain dapur',
                'thumbnail' => 0,
                'urutan' => 2,
                'created_at' => $now,
            ],
            [
                'id_project' => 2,
                'jenis_foto' => 'proses',
                'nama_file' => 'project2_process1.jpg',
                'url_foto' => 'uploads/projects/project2_process1.jpg',
                'deskripsi_foto' => 'Proses pemasangan kitchen set',
                'thumbnail' => 0,
                'urutan' => 3,
                'created_at' => $now,
            ],
            
            // Project 3 - Kitchen Set Premium
            [
                'id_project' => 3,
                'jenis_foto' => 'sesudah',
                'nama_file' => 'project3_after1.jpg',
                'url_foto' => 'uploads/projects/project3_after1.jpg',
                'deskripsi_foto' => 'Kitchen set premium tampak depan',
                'thumbnail' => 1,
                'urutan' => 1,
                'created_at' => $now,
            ],
            [
                'id_project' => 3,
                'jenis_foto' => 'detail',
                'nama_file' => 'project3_detail1.jpg',
                'url_foto' => 'uploads/projects/project3_detail1.jpg',
                'deskripsi_foto' => 'Detail finishing high gloss',
                'thumbnail' => 0,
                'urutan' => 2,
                'created_at' => $now,
            ],
            [
                'id_project' => 3,
                'jenis_foto' => 'detail',
                'nama_file' => 'project3_detail2.jpg',
                'url_foto' => 'uploads/projects/project3_detail2.jpg',
                'deskripsi_foto' => 'Hardware Blum soft close',
                'thumbnail' => 0,
                'urutan' => 3,
                'created_at' => $now,
            ],
        ];

        foreach ($galleries as $gallery) {
            DB::table('gallery_project')->insert($gallery);
        }

        $this->command->info('✅ Project galleries seeded: ' . count($galleries) . ' galleries');
    }
}