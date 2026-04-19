<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtikelSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        
        $articles = [
            [
                'judul_artikel' => '7 Tips Memilih Kitchen Set yang Tepat untuk Rumah Anda',
                'slug' => '7-tips-memilih-kitchen-set-tepat',
                'konten' => '<p>Memilih kitchen set yang tepat sangat penting untuk kenyamanan memasak. Berikut 7 tips yang bisa Anda pertimbangkan...</p>',
                'kategori' => 'tips_panduan',
                'status_artikel' => 'publish',
                'featured' => 1,
                'tanggal_publish' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($articles as $article) {
            DB::table('artikel')->insert($article);
        }

        $this->command->info('✅ Articles seeded: ' . count($articles) . ' articles');
    }
}