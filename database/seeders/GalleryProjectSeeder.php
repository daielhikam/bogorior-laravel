<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GalleryProjectSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        
        $galleries = [
            ['id_project' => 1, 'jenis_foto' => 'sesudah', 'nama_file' => 'project1_after1.jpg', 'url_foto' => 'uploads/projects/project1_after1.jpg', 'thumbnail' => 1, 'urutan' => 1],
            ['id_project' => 2, 'jenis_foto' => 'sesudah', 'nama_file' => 'project2_after1.jpg', 'url_foto' => 'uploads/projects/project2_after1.jpg', 'thumbnail' => 1, 'urutan' => 1],
            ['id_project' => 3, 'jenis_foto' => 'sesudah', 'nama_file' => 'project3_after1.jpg', 'url_foto' => 'uploads/projects/project3_after1.jpg', 'thumbnail' => 1, 'urutan' => 1],
        ];

        foreach ($galleries as $gallery) {
            DB::table('gallery_project')->insert([
                'id_project' => $gallery['id_project'],
                'jenis_foto' => $gallery['jenis_foto'],
                'nama_file' => $gallery['nama_file'],
                'url_foto' => $gallery['url_foto'],
                'thumbnail' => $gallery['thumbnail'],
                'urutan' => $gallery['urutan'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->command->info('✅ Project galleries seeded: ' . count($galleries) . ' galleries');
    }
}