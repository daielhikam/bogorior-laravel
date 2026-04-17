<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Get all public settings
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        try {
            $settings = Setting::all()->pluck('nilai', 'kunci')->toArray();
            
            // Format settings with defaults
            $formatted = [
                // General Settings
                'nama_perusahaan' => $settings['nama_perusahaan'] ?? 'Bogorior KitchenSet',
                'telepon' => $settings['telepon'] ?? '628977288600',
                'whatsapp' => $settings['whatsapp'] ?? '628977288600',
                'email' => $settings['email'] ?? 'info@bogorior.com',
                'alamat' => $settings['alamat'] ?? 'Bogor, Indonesia',
                
                // Service Settings
                'garansi' => $settings['garansi'] ?? '5 Tahun',
                'proses_pengerjaan' => $settings['proses_pengerjaan'] ?? '3-4',
                'free_survey' => $settings['free_survey'] ?? '1',
                'cicilan_bulan' => $settings['cicilan_bulan'] ?? '36',
                
                // Hero Section
                'hero_headline' => $settings['hero_headline'] ?? 'Transformasi Total <span class="highlight">Dapur Anda</span><br>Dalam 3-4 Minggu Saja',
                'hero_subtitle' => $settings['hero_subtitle'] ?? null,
                
                // CTA Section
                'cta_title' => $settings['cta_title'] ?? 'Ready to Transform Your Kitchen?',
                'cta_description' => $settings['cta_description'] ?? 'Konsultasi gratis dengan desainer kami dan dapatkan estimasi biaya tanpa komitmen',
                
                // Services Section
                'services_title' => $settings['services_title'] ?? 'Layanan Unggulan Kami',
                'services_subtitle' => $settings['services_subtitle'] ?? 'Solusi lengkap untuk segala kebutuhan kitchen set Anda',
                
                // SEO Settings
                'meta_title' => $settings['meta_title'] ?? 'Bogorior KitchenSet - Kitchen Set Premium untuk Hunian Impian Anda',
                'meta_description' => $settings['meta_description'] ?? '500+ kitchen set telah terwujud dengan kualitas terbaik. Garansi 5 tahun, cicilan 0% 36x, free konsultasi desain.',
                'meta_keywords' => $settings['meta_keywords'] ?? 'kitchen set, kitchen set bogor, kitchen set jakarta, kitchen set premium, renovasi dapur, desain interior dapur',
                
                // Social Media
                'instagram' => $settings['instagram'] ?? 'https://instagram.com/bogorior',
                'facebook' => $settings['facebook'] ?? 'https://facebook.com/bogorior',
                'tiktok' => $settings['tiktok'] ?? 'https://tiktok.com/@bogorior',
                'youtube' => $settings['youtube'] ?? 'https://youtube.com/@bogorior',
                
                // Logo & Favicon
                'logo_url' => $settings['logo'] ? asset('uploads/logo/' . $settings['logo']) : null,
                'favicon_url' => $settings['favicon'] ? asset('uploads/logo/' . $settings['favicon']) : null,
            ];

            return $this->success($formatted, 'Settings retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve settings: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get setting by key
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByKey(Request $request)
    {
        try {
            $key = $request->input('key');

            if (!$key) {
                return $this->error('Setting key is required', 400);
            }

            $setting = Setting::where('kunci', $key)->first();

            if (!$setting) {
                return $this->notFound("Setting with key '{$key}' not found");
            }

            return $this->success([
                'kunci' => $setting->kunci,
                'nilai' => $setting->nilai,
                'tipe' => $setting->tipe,
                'label' => $setting->label,
            ], 'Setting retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve setting: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get settings by kategori
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByKategori(Request $request)
    {
        try {
            $kategori = $request->input('kategori');

            if (!$kategori) {
                return $this->error('Kategori is required', 400);
            }

            $settings = Setting::where('kategori', $kategori)->get();

            $formatted = $settings->map(function ($setting) {
                return [
                    'kunci' => $setting->kunci,
                    'nilai' => $setting->nilai,
                    'tipe' => $setting->tipe,
                    'label' => $setting->label,
                ];
            });

            return $this->success($formatted, "Settings for kategori '{$kategori}' retrieved successfully");
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve settings: ' . $e->getMessage(), 500);
        }
    }
}