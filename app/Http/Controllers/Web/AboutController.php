<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Project;
use App\Models\Testimoni;
use App\Models\Setting;
use App\Models\AreaLayanan;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display about page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get settings
        $settings = Setting::all()->pluck('nilai', 'kunci')->toArray();
        
        // Get team members
        $teamMembers = Team::where('aktif', true)
            ->orderBy('urutan', 'asc')
            ->get();
        
        // Get statistics
        $totalProjects = Project::count();
        $completedProjects = Project::where('status_project', 'selesai')->count();
        
        // Calculate satisfaction rate
        $avgRating = Project::whereNotNull('rating_project')->avg('rating_project');
        $satisfactionRate = $avgRating ? round(($avgRating / 5) * 100) : 98;
        
        // Experience years (assuming founded in 2016)
        $foundedYear = 2016;
        $experienceYears = date('Y') - $foundedYear;
        
        // Get featured testimonials
        $testimonials = Testimoni::where('status_testimoni', 'approved')
            ->where('featured', true)
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();
        
        // Get service areas
        $serviceAreas = AreaLayanan::where('aktif', true)
            ->orderBy('urutan', 'asc')
            ->get();
        
        $stats = [
            'total_projects' => $totalProjects,
            'completed_projects' => $completedProjects,
            'satisfaction_rate' => $satisfactionRate,
            'experience_years' => $experienceYears,
        ];
        
        // Company values
        $companyValues = [
            [
                'icon' => 'fas fa-medal',
                'title' => 'Kualitas Terbaik',
                'description' => 'Kami hanya menggunakan material premium dengan standar kualitas tertinggi untuk setiap project.',
            ],
            [
                'icon' => 'fas fa-handshake',
                'title' => 'Pelayanan Profesional',
                'description' => 'Tim kami berkomitmen memberikan pelayanan terbaik dari konsultasi hingga after sales.',
            ],
            [
                'icon' => 'fas fa-lightbulb',
                'title' => 'Desain Inovatif',
                'description' => 'Desainer profesional kami selalu mengikuti tren terbaru untuk menciptakan desain yang fresh.',
            ],
            [
                'icon' => 'fas fa-clock',
                'title' => 'Tepat Waktu',
                'description' => 'Kami menghargai waktu Anda dengan menyelesaikan project sesuai jadwal yang disepakati.',
            ],
            [
                'icon' => 'fas fa-shield-alt',
                'title' => 'Garansi 5 Tahun',
                'description' => 'Kami memberikan garansi 5 tahun untuk setiap produk kitchen set yang kami kerjakan.',
            ],
            [
                'icon' => 'fas fa-smile',
                'title' => 'Kepuasan Terjamin',
                'description' => 'Kepuasan client adalah prioritas utama kami, terbukti dari banyaknya testimoni positif.',
            ],
        ];
        
        return view('about.index', compact(
            'teamMembers', 
            'testimonials', 
            'stats', 
            'serviceAreas',
            'companyValues',
            'settings'
        ));
    }
}