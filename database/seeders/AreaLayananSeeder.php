<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaLayananSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        
        $areas = [
            ['nama_area' => 'Bogor', 'jenis_area' => 'kota', 'daftar_lokasi' => 'Bogor Tengah, Bogor Timur, Bogor Barat, Bogor Utara, Bogor Selatan', 'deskripsi' => 'Kami melayani seluruh wilayah kota Bogor', 'urutan' => 1],
            ['nama_area' => 'Jakarta', 'jenis_area' => 'kota', 'daftar_lokasi' => 'Jakarta Pusat, Jakarta Selatan, Jakarta Timur, Jakarta Barat, Jakarta Utara', 'deskripsi' => 'Area Jabodetabek, melayani seluruh wilayah Jakarta', 'urutan' => 2],
            ['nama_area' => 'Depok', 'jenis_area' => 'kota', 'daftar_lokasi' => 'Depok, Cimanggis, Sawangan, Beji, Limo, Cinere', 'deskripsi' => 'Kota Depok dan sekitarnya', 'urutan' => 3],
            ['nama_area' => 'Tangerang', 'jenis_area' => 'kota', 'daftar_lokasi' => 'Tangerang, Tangerang Selatan, BSD, Alam Sutera, Gading Serpong', 'deskripsi' => 'Wilayah Tangerang dan sekitarnya', 'urutan' => 4],
            ['nama_area' => 'Bekasi', 'jenis_area' => 'kota', 'daftar_lokasi' => 'Bekasi, Bekasi Timur, Bekasi Barat, Bekasi Utara, Bekasi Selatan', 'deskripsi' => 'Wilayah Bekasi dan sekitarnya', 'urutan' => 5],
            ['nama_area' => 'Sukabumi', 'jenis_area' => 'kabupaten', 'daftar_lokasi' => 'Sukabumi, Cisaat, Cibadak, Parungkuda', 'deskripsi' => 'Wilayah Sukabumi dan sekitarnya', 'urutan' => 6],
            ['nama_area' => 'Cianjur', 'jenis_area' => 'kabupaten', 'daftar_lokasi' => 'Cianjur, Ciranjang, Cugenang, Pacet', 'deskripsi' => 'Wilayah Cianjur dan sekitarnya', 'urutan' => 7],
            ['nama_area' => 'Bandung', 'jenis_area' => 'luar_kota', 'daftar_lokasi' => 'Bandung, Cimahi, Lembang, Soreang', 'deskripsi' => 'Wilayah Bandung dan sekitarnya (dengan biaya tambahan)', 'urutan' => 8],
        ];

        foreach ($areas as $area) {
            DB::table('area_layanan')->insert([
                'nama_area' => $area['nama_area'],
                'jenis_area' => $area['jenis_area'],
                'daftar_lokasi' => $area['daftar_lokasi'],
                'deskripsi' => $area['deskripsi'],
                'aktif' => 1,
                'urutan' => $area['urutan'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->command->info('✅ Service areas seeded: ' . count($areas) . ' areas');
    }
}