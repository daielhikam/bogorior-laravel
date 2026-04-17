<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MigrateDataFromOldDatabase extends Seeder
{
    public function run()
    {
        // Konfigurasi koneksi ke database lama
        $oldDB = DB::connection('mysql_old');
        
        // Migrate artikel
        $articles = $oldDB->table('artikel')->get();
        foreach ($articles as $article) {
            DB::table('artikel')->insert([
                'id_artikel' => $article->id_artikel,
                'judul_artikel' => $article->judul_artikel,
                'slug' => $article->slug,
                'konten' => $article->konten,
                'excerpt' => $article->excerpt,
                'gambar_utama' => $article->gambar_utama,
                'kategori' => $article->kategori,
                'tags' => $article->tags,
                'penulis' => $article->penulis,
                'status_artikel' => $article->status_artikel,
                'featured' => $article->featured,
                'tanggal_publish' => $article->tanggal_publish,
                'views' => $article->views,
                'created_at' => $article->created_at,
                'updated_at' => $article->updated_at,
            ]);
        }
        
        $this->command->info('Data migrated successfully!');
    }
}