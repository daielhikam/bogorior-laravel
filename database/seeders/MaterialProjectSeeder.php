<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialProjectSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        $now = now();
        
        $materials = [
            // Project 1 Materials
            [
                'id_project' => 1,
                'nama_material' => 'Multipleks MR Grade 18mm',
                'jenis_material' => 'kabinet',
                'spesifikasi' => 'Kayu lapis berkualitas tinggi, tahan lembab',
                'merk' => 'Meranti',
                'jumlah' => 10,
                'satuan' => 'lembar',
                'created_at' => $now,
            ],
            [
                'id_project' => 1,
                'nama_material' => 'HPL Premium',
                'jenis_material' => 'finishing',
                'spesifikasi' => 'Warna putih dan woodgrain',
                'merk' => 'Formica',
                'jumlah' => 12,
                'satuan' => 'lembar',
                'created_at' => $now,
            ],
            [
                'id_project' => 1,
                'nama_material' => 'Solid Surface',
                'jenis_material' => 'countertop',
                'spesifikasi' => 'Tebal 12mm, warna putih',
                'merk' => 'LG',
                'jumlah' => 4,
                'satuan' => 'meter',
                'created_at' => $now,
            ],
            [
                'id_project' => 1,
                'nama_material' => 'Soft Close Hinge',
                'jenis_material' => 'hardware',
                'spesifikasi' => 'Engsel soft close 3D adjustable',
                'merk' => 'Hettich',
                'jumlah' => 20,
                'satuan' => 'pcs',
                'created_at' => $now,
            ],
            
            // Project 2 Materials
            [
                'id_project' => 2,
                'nama_material' => 'Multipleks MR Grade 18mm',
                'jenis_material' => 'kabinet',
                'spesifikasi' => 'Kayu lapis berkualitas tinggi',
                'merk' => 'Meranti',
                'jumlah' => 15,
                'satuan' => 'lembar',
                'created_at' => $now,
            ],
            [
                'id_project' => 2,
                'nama_material' => 'Granit 2cm',
                'jenis_material' => 'countertop',
                'spesifikasi' => 'Granit alam warna hitam',
                'merk' => 'Garuda',
                'jumlah' => 6,
                'satuan' => 'meter',
                'created_at' => $now,
            ],
            
            // Project 3 Materials
            [
                'id_project' => 3,
                'nama_material' => 'MDF Waterproof Import',
                'jenis_material' => 'kabinet',
                'spesifikasi' => 'Material tahan air import',
                'merk' => 'Premium',
                'jumlah' => 12,
                'satuan' => 'lembar',
                'created_at' => $now,
            ],
            [
                'id_project' => 3,
                'nama_material' => 'High Gloss Acrylic',
                'jenis_material' => 'finishing',
                'spesifikasi' => 'Finishing mengkilap premium',
                'merk' => 'Akrilik',
                'jumlah' => 14,
                'satuan' => 'lembar',
                'created_at' => $now,
            ],
            [
                'id_project' => 3,
                'nama_material' => 'Quartz Stone',
                'jenis_material' => 'countertop',
                'spesifikasi' => 'Batu quartz import',
                'merk' => 'Caesarstone',
                'jumlah' => 5,
                'satuan' => 'meter',
                'created_at' => $now,
            ],
            [
                'id_project' => 3,
                'nama_material' => 'Blum Austria Hardware',
                'jenis_material' => 'hardware',
                'spesifikasi' => 'Full set hardware Blum',
                'merk' => 'Blum',
                'jumlah' => 1,
                'satuan' => 'set',
                'created_at' => $now,
            ],
        ];

        foreach ($materials as $material) {
            DB::table('material_project')->insert($material);
        }

        $this->command->info('✅ Project materials seeded: ' . count($materials) . ' materials');
    }
}