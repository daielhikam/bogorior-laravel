<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Testimoni;
use App\Models\PaketLayanan;
use App\Models\Faq;
use App\Models\AreaLayanan;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get settings
        $settings = Setting::all()->pluck('nilai', 'kunci')->toArray();
        
        // Get featured projects
        $featuredProjects = Project::with(['galleries' => function($q) {
                $q->where('thumbnail', 1)->orWhere('jenis_foto', 'sesudah');
            }])
            ->where('status_project', 'selesai')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
        
        // Get service packages
        $services = PaketLayanan::where('aktif', true)
            ->orderBy('urutan', 'asc')
            ->orderBy('popular', 'desc')
            ->limit(4)
            ->get();
        
        // Get testimonials
        $testimonials = Testimoni::where('status_testimoni', 'approved')
            ->orderBy('featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();
        
        // Get FAQs
        $faqs = Faq::where('aktif', true)
            ->orderBy('urutan', 'asc')
            ->limit(6)
            ->get();
        
        // Get service areas
        $serviceAreas = AreaLayanan::where('aktif', true)
            ->orderBy('urutan', 'asc')
            ->limit(6)
            ->get();
        
        // Get statistics
        $totalProjects = Project::count();
        $avgRating = Project::whereNotNull('rating_project')->avg('rating_project');
        $satisfactionRate = $avgRating ? round(($avgRating / 5) * 100) : 98;
        $foundedYear = 2016;
        $experienceYears = date('Y') - $foundedYear;
        $warrantyYears = (int) filter_var($settings['garansi'] ?? '5', FILTER_SANITIZE_NUMBER_INT);
        
        $stats = [
            'total_projects' => $totalProjects,
            'satisfaction_rate' => $satisfactionRate,
            'experience_years' => $experienceYears,
            'warranty_years' => $warrantyYears,
        ];
        
        $viewSettings = [
            'garansi' => $settings['garansi'] ?? '5 Tahun',
            'proses_pengerjaan' => $settings['proses_pengerjaan'] ?? '3-4',
            'free_survey' => ($settings['free_survey'] ?? '1') == '1',
            'cicilan_bulan' => $settings['cicilan_bulan'] ?? '36',
            'whatsapp_number' => $settings['whatsapp'] ?? '628977288600',
            'hero_headline' => $settings['hero_headline'] ?? 'Transformasi Total <span class="highlight">Dapur Anda</span><br>Dalam 3-4 Minggu Saja',
            'cta_title' => $settings['cta_title'] ?? 'Ready to Transform Your Kitchen?',
            'cta_description' => $settings['cta_description'] ?? 'Konsultasi gratis dengan desainer kami dan dapatkan estimasi biaya tanpa komitmen',
            'services_title' => $settings['services_title'] ?? 'Layanan Unggulan Kami',
            'services_subtitle' => $settings['services_subtitle'] ?? 'Solusi lengkap untuk segala kebutuhan kitchen set Anda',
        ];
        
        return view('home', compact(
            'featuredProjects',
            'services',
            'testimonials',
            'faqs',
            'serviceAreas',
            'stats',
            'viewSettings'
        ));
    }
}