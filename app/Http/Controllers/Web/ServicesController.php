<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PaketLayanan;
use App\Models\Project;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display services listing page.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $jenis = $request->input('jenis');
        
        $query = PaketLayanan::where('aktif', true);
        
        if ($jenis && $jenis !== 'all') {
            $query->where('jenis_layanan', $jenis);
        }
        
        $services = $query->orderBy('urutan', 'asc')
            ->orderBy('popular', 'desc')
            ->get();
        
        // Get counts for each jenis
        $jenisOptions = [
            ['value' => 'all', 'label' => 'Semua Layanan', 'count' => PaketLayanan::where('aktif', true)->count()],
            ['value' => 'custom', 'label' => 'Kitchen Set Custom', 'count' => PaketLayanan::where('aktif', true)->where('jenis_layanan', 'custom')->count()],
            ['value' => 'premium', 'label' => 'Kitchen Set Premium', 'count' => PaketLayanan::where('aktif', true)->where('jenis_layanan', 'premium')->count()],
            ['value' => 'renovasi', 'label' => 'Renovasi Dapur', 'count' => PaketLayanan::where('aktif', true)->where('jenis_layanan', 'renovasi')->count()],
            ['value' => 'interior', 'label' => 'Interior Design', 'count' => PaketLayanan::where('aktif', true)->where('jenis_layanan', 'interior')->count()],
        ];
        
        // Get statistics
        $totalProjects = Project::where('status_project', 'selesai')->count();
        $totalClients = Project::distinct('id_pelanggan')->count('id_pelanggan');
        $avgRating = Project::whereNotNull('rating_project')->avg('rating_project');
        $satisfactionRate = $avgRating ? round(($avgRating / 5) * 100) : 98;
        
        // Get featured testimonials
        $testimonials = Testimoni::where('status_testimoni', 'approved')
            ->where('featured', true)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
        
        return view('services.index', compact('services', 'jenisOptions', 'jenis', 'totalProjects', 'totalClients', 'satisfactionRate', 'testimonials'));
    }
    
    /**
     * Display service detail page.
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function detail($slug)
    {
        $service = PaketLayanan::where('slug_paket', $slug)
            ->where('aktif', true)
            ->firstOrFail();
        
        // Get other services for sidebar
        $otherServices = PaketLayanan::where('aktif', true)
            ->where('id_paket', '!=', $service->id_paket)
            ->orderBy('urutan', 'asc')
            ->limit(3)
            ->get();
        
        // Get related projects for this service type
        $relatedProjects = Project::with(['galleries' => function($q) {
                $q->where('thumbnail', 1);
            }])
            ->where('jenis_project', $service->jenis_layanan)
            ->where('status_project', 'selesai')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
        
        // Get FAQ related to this service
        $faqs = \App\Models\Faq::where('aktif', true)
            ->where('kategori', 'layanan')
            ->orderBy('urutan', 'asc')
            ->limit(4)
            ->get();
        
        // Parse fitur and spesifikasi
        $fitur = [];
        if ($service->fitur) {
            $fitur = json_decode($service->fitur, true);
            if (!$fitur && is_string($service->fitur)) {
                $fitur = explode("\n", $service->fitur);
                $fitur = array_map('trim', array_filter($fitur));
            }
        }
        
        $spesifikasi = [];
        if ($service->spesifikasi) {
            $spesifikasi = json_decode($service->spesifikasi, true);
            if (!$spesifikasi && is_string($service->spesifikasi)) {
                $spesifikasi = explode("\n", $service->spesifikasi);
                $spesifikasi = array_map('trim', array_filter($spesifikasi));
            }
        }
        
        return view('services.detail', compact('service', 'otherServices', 'relatedProjects', 'faqs', 'fitur', 'spesifikasi'));
    }
}