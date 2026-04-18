<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriberSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        $now = now();
        
        $subscribers = [
            [
                'email' => 'pelanggan1@email.com',
                'nama' => 'Budi Santoso',
                'status' => 'aktif',
                'tanggal_subscribe' => $now->copy()->subDays(30),
                'terakhir_kirim' => $now->copy()->subDays(5),
                'token_unsubscribe' => md5('pelanggan1@email.com' . time()),
                'created_at' => $now->copy()->subDays(30),
            ],
            [
                'email' => 'pelanggan2@email.com',
                'nama' => 'Sari Dewi',
                'status' => 'aktif',
                'tanggal_subscribe' => $now->copy()->subDays(25),
                'terakhir_kirim' => $now->copy()->subDays(10),
                'token_unsubscribe' => md5('pelanggan2@email.com' . time()),
                'created_at' => $now->copy()->subDays(25),
            ],
            [
                'email' => 'pelanggan3@email.com',
                'nama' => 'Rudi Hartono',
                'status' => 'unsubscribe',
                'tanggal_subscribe' => $now->copy()->subDays(60),
                'terakhir_kirim' => $now->copy()->subDays(30),
                'token_unsubscribe' => md5('pelanggan3@email.com' . time()),
                'created_at' => $now->copy()->subDays(60),
            ],
            [
                'email' => 'pelanggan4@email.com',
                'nama' => 'Diana Putri',
                'status' => 'aktif',
                'tanggal_subscribe' => $now->copy()->subDays(15),
                'terakhir_kirim' => $now->copy()->subDays(3),
                'token_unsubscribe' => md5('pelanggan4@email.com' . time()),
                'created_at' => $now->copy()->subDays(15),
            ],
        ];

        foreach ($subscribers as $subscriber) {
            DB::table('subscriber')->insert($subscriber);
        }

        $this->command->info('✅ Subscribers seeded: ' . count($subscribers) . ' subscribers');
    }
}