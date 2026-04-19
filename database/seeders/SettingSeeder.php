<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        
        $settings = [
            ['kategori' => 'general', 'kunci' => 'nama_perusahaan', 'nilai' => 'Bogorior KitchenSet', 'tipe' => 'text', 'label' => 'Nama Perusahaan', 'urutan' => 1],
            ['kategori' => 'general', 'kunci' => 'telepon', 'nilai' => '628977288600', 'tipe' => 'tel', 'label' => 'Nomor Telepon', 'urutan' => 2],
            ['kategori' => 'general', 'kunci' => 'whatsapp', 'nilai' => '628977288600', 'tipe' => 'tel', 'label' => 'Nomor WhatsApp', 'urutan' => 3],
            ['kategori' => 'general', 'kunci' => 'email', 'nilai' => 'info@bogorior.com', 'tipe' => 'email', 'label' => 'Email', 'urutan' => 4],
            ['kategori' => 'general', 'kunci' => 'alamat', 'nilai' => 'Bogor, Indonesia', 'tipe' => 'text', 'label' => 'Alamat', 'urutan' => 5],
            ['kategori' => 'service', 'kunci' => 'garansi', 'nilai' => '5 Tahun', 'tipe' => 'text', 'label' => 'Garansi', 'urutan' => 1],
            ['kategori' => 'service', 'kunci' => 'proses_pengerjaan', 'nilai' => '3-4', 'tipe' => 'text', 'label' => 'Proses Pengerjaan', 'urutan' => 2],
            ['kategori' => 'service', 'kunci' => 'free_survey', 'nilai' => '1', 'tipe' => 'boolean', 'label' => 'Free Survey', 'urutan' => 3],
            ['kategori' => 'service', 'kunci' => 'cicilan_bulan', 'nilai' => '36', 'tipe' => 'number', 'label' => 'Cicilan Bulan', 'urutan' => 4],
            ['kategori' => 'hero', 'kunci' => 'hero_headline', 'nilai' => 'Transformasi Total <span class="text-green-400">Dapur Anda</span><br>Dalam 3-4 Minggu Saja', 'tipe' => 'text', 'label' => 'Hero Headline', 'urutan' => 1],
            ['kategori' => 'cta', 'kunci' => 'cta_title', 'nilai' => 'Ready to Transform Your Kitchen?', 'tipe' => 'text', 'label' => 'CTA Title', 'urutan' => 1],
            ['kategori' => 'cta', 'kunci' => 'cta_description', 'nilai' => 'Konsultasi gratis dengan desainer kami dan dapatkan estimasi biaya tanpa komitmen', 'tipe' => 'textarea', 'label' => 'CTA Description', 'urutan' => 2],
            ['kategori' => 'services', 'kunci' => 'services_title', 'nilai' => 'Layanan Unggulan Kami', 'tipe' => 'text', 'label' => 'Services Title', 'urutan' => 1],
            ['kategori' => 'services', 'kunci' => 'services_subtitle', 'nilai' => 'Solusi lengkap untuk segala kebutuhan kitchen set Anda', 'tipe' => 'text', 'label' => 'Services Subtitle', 'urutan' => 2],
            ['kategori' => 'seo', 'kunci' => 'meta_title', 'nilai' => 'Bogorior KitchenSet - Kitchen Set Premium untuk Hunian Impian Anda', 'tipe' => 'text', 'label' => 'Meta Title', 'urutan' => 1],
            ['kategori' => 'seo', 'kunci' => 'meta_description', 'nilai' => '500+ kitchen set telah terwujud dengan kualitas terbaik. Garansi 5 tahun, cicilan 0% 36x, free konsultasi desain.', 'tipe' => 'textarea', 'label' => 'Meta Description', 'urutan' => 2],
            ['kategori' => 'seo', 'kunci' => 'meta_keywords', 'nilai' => 'kitchen set, kitchen set bogor, kitchen set jakarta, kitchen set premium, renovasi dapur, desain interior dapur', 'tipe' => 'text', 'label' => 'Meta Keywords', 'urutan' => 3],
            ['kategori' => 'social', 'kunci' => 'instagram', 'nilai' => 'https://instagram.com/bogorior', 'tipe' => 'url', 'label' => 'Instagram', 'urutan' => 1],
            ['kategori' => 'social', 'kunci' => 'facebook', 'nilai' => 'https://facebook.com/bogorior', 'tipe' => 'url', 'label' => 'Facebook', 'urutan' => 2],
            ['kategori' => 'social', 'kunci' => 'tiktok', 'nilai' => 'https://tiktok.com/@bogorior', 'tipe' => 'url', 'label' => 'TikTok', 'urutan' => 3],
            ['kategori' => 'social', 'kunci' => 'youtube', 'nilai' => 'https://youtube.com/@bogorior', 'tipe' => 'url', 'label' => 'YouTube', 'urutan' => 4],
            ['kategori' => 'logo', 'kunci' => 'logo', 'nilai' => '', 'tipe' => 'text', 'label' => 'Logo', 'urutan' => 1],
            ['kategori' => 'logo', 'kunci' => 'favicon', 'nilai' => '', 'tipe' => 'text', 'label' => 'Favicon', 'urutan' => 2],
        ];

        foreach ($settings as $setting) {
            DB::table('pengaturan_situs')->updateOrInsert(
                ['kunci' => $setting['kunci']],
                [
                    'kategori' => $setting['kategori'],
                    'kunci' => $setting['kunci'],
                    'nilai' => $setting['nilai'],
                    'tipe' => $setting['tipe'],
                    'label' => $setting['label'],
                    'urutan' => $setting['urutan'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        $this->command->info('✅ Settings seeded: ' . count($settings) . ' settings');
    }
}