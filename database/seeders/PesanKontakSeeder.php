<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PesanKontakSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        
        $messages = [
            ['nama_pengirim' => 'Andi Pratama', 'email_pengirim' => 'andi@email.com', 'subjek' => 'Konsultasi Kitchen Set', 'pesan' => 'Saya tertarik dengan kitchen set custom. Bisa konsultasi?', 'status_pesan' => 'baru'],
        ];

        foreach ($messages as $message) {
            DB::table('pesan_kontak')->insert([
                'nama_pengirim' => $message['nama_pengirim'],
                'email_pengirim' => $message['email_pengirim'],
                'subjek' => $message['subjek'],
                'pesan' => $message['pesan'],
                'status_pesan' => $message['status_pesan'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->command->info('✅ Contact messages seeded: ' . count($messages) . ' messages');
    }
}