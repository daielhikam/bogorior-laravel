<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialProjectSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        
        $materials = [
            ['id_project' => 1, 'nama_material' => 'Multipleks MR Grade 18mm', 'jenis_material' => 'kabinet', 'jumlah' => 10, 'satuan' => 'lembar'],
            ['id_project' => 1, 'nama_material' => 'HPL Premium', 'jenis_material' => 'finishing', 'jumlah' => 12, 'satuan' => 'lembar'],
            ['id_project' => 2, 'nama_material' => 'Multipleks MR Grade 18mm', 'jenis_material' => 'kabinet', 'jumlah' => 15, 'satuan' => 'lembar'],
            ['id_project' => 3, 'nama_material' => 'MDF Waterproof Import', 'jenis_material' => 'kabinet', 'jumlah' => 12, 'satuan' => 'lembar'],
            ['id_project' => 3, 'nama_material' => 'High Gloss Acrylic', 'jenis_material' => 'finishing', 'jumlah' => 14, 'satuan' => 'lembar'],
        ];

        foreach ($materials as $material) {
            DB::table('material_project')->insert([
                'id_project' => $material['id_project'],
                'nama_material' => $material['nama_material'],
                'jenis_material' => $material['jenis_material'],
                'jumlah' => $material['jumlah'],
                'satuan' => $material['satuan'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->command->info('✅ Project materials seeded: ' . count($materials) . ' materials');
    }
}