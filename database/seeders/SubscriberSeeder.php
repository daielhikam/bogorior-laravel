<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriberSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        
        $subscribers = [
            ['email' => 'pelanggan1@email.com', 'nama' => 'Budi Santoso', 'status' => 'aktif'],
            ['email' => 'pelanggan2@email.com', 'nama' => 'Sari Dewi', 'status' => 'aktif'],
        ];

        foreach ($subscribers as $subscriber) {
            DB::table('subscriber')->insert([
                'email' => $subscriber['email'],
                'nama' => $subscriber['nama'],
                'status' => $subscriber['status'],
                'tanggal_subscribe' => $now,
                'token_unsubscribe' => md5($subscriber['email'] . time()),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->command->info('✅ Subscribers seeded: ' . count($subscribers) . ' subscribers');
    }
}