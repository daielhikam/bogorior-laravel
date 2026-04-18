<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\GalleryProject;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display portfolio listing page.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $jenis = $request->input('jenis');
        $kategori = $request->input('kategori');
        $search = $request->input('search');
        
        $query = Project::with(['galleries' => function($q) {
            $q->where('thumbnail', 1)->orWhere('jenis_foto', 'sesudah');
        }]);
        
        // Apply filters
        if ($jenis && $jenis !== 'all') {
            $query->where('jenis_project', $jenis);
        }
        
        if ($kategori && $kategori !== 'all') {
            $query->where('kategori_desain', $kategori);
        }
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_project', 'like', "%{$search}%")
                  ->orWhere('lokasi_project', 'like', "%{$search}%")
                  ->orWhere('kode_project', 'like', "%{$search}%")
                  ->orWhere('deskripsi_project', 'like', "%{$search}%");
            });
        }
        
        $projects = $query->where('status_project', 'selesai')
            ->orderBy('created_at', 'desc')
            ->paginate(9);
        
        // Get filter options with counts
        $jenisOptions = [
            ['value' => 'all', 'label' => 'Semua Jenis', 'count' => Project::where('status_project', 'selesai')->count()],
            ['value' => 'custom', 'label' => 'Kitchen Set Custom', 'count' => Project::where('status_project', 'selesai')->where('jenis_project', 'custom')->count()],
            ['value' => 'premium', 'label' => 'Kitchen Set Premium', 'count' => Project::where('status_project', 'selesai')->where('jenis_project', 'premium')->count()],
            ['value' => 'renovasi', 'label' => 'Renovasi Dapur', 'count' => Project::where('status_project', 'selesai')->where('jenis_project', 'renovasi')->count()],
            ['value' => 'interior', 'label' => 'Interior Design', 'count' => Project::where('status_project', 'selesai')->where('jenis_project', 'interior')->count()],
        ];
        
        $kategoriOptions = [
            ['value' => 'all', 'label' => 'Semua Gaya', 'count' => Project::where('status_project', 'selesai')->count()],
            ['value' => 'minimalist', 'label' => 'Minimalis', 'count' => Project::where('status_project', 'selesai')->where('kategori_desain', 'minimalist')->count()],
            ['value' => 'modern', 'label' => 'Modern', 'count' => Project::where('status_project', 'selesai')->where('kategori_desain', 'modern')->count()],
            ['value' => 'classic', 'label' => 'Klasik', 'count' => Project::where('status_project', 'selesai')->where('kategori_desain', 'classic')->count()],
            ['value' => 'luxury', 'label' => 'Mewah', 'count' => Project::where('status_project', 'selesai')->where('kategori_desain', 'luxury')->count()],
            ['value' => 'contemporary', 'label' => 'Kontemporer', 'count' => Project::where('status_project', 'selesai')->where('kategori_desain', 'contemporary')->count()],
            ['value' => 'industrial', 'label' => 'Industrial', 'count' => Project::where('status_project', 'selesai')->where('kategori_desain', 'industrial')->count()],
        ];
        
        return view('portfolio.index', compact('projects', 'jenisOptions', 'kategoriOptions', 'jenis', 'kategori', 'search'));
    }
    
    /**
     * Display portfolio detail page.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function detail($id)
    {
        $project = Project::with([
            'galleries' => function($q) {
                $q->orderBy('urutan', 'asc')->orderBy('id_gallery', 'asc');
            },
            'testimonials' => function($q) {
                $q->where('status_testimoni', 'approved');
            },
            'materials'
        ])->findOrFail($id);
        
        // Increment view count if you have views column
        // $project->increment('views');
        
        // Get related projects (same jenis or kategori)
        $relatedProjects = Project::with(['galleries' => function($q) {
                $q->where('thumbnail', 1);
            }])
            ->where('id_project', '!=', $id)
            ->where('status_project', 'selesai')
            ->where(function($q) use ($project) {
                $q->where('jenis_project', $project->jenis_project)
                  ->orWhere('kategori_desain', $project->kategori_desain);
            })
            ->limit(3)
            ->get();
        
        // Get all images grouped by jenis
        $galleries = [
            'sebelum' => $project->galleries->where('jenis_foto', 'sebelum'),
            'proses' => $project->galleries->where('jenis_foto', 'proses'),
            'sesudah' => $project->galleries->where('jenis_foto', 'sesudah'),
            'detail' => $project->galleries->where('jenis_foto', 'detail'),
            'desain' => $project->galleries->where('jenis_foto', 'desain'),
            'material' => $project->galleries->where('jenis_foto', 'material'),
        ];
        
        // Get main image
        $mainImage = $project->main_image_url;
        
        return view('portfolio.detail', compact('project', 'relatedProjects', 'galleries', 'mainImage'));
    }
    
    /**
     * Display portfolio by category.
     *
     * @param string $category
     * @return \Illuminate\View\View
     */
    public function byCategory($category)
    {
        $projects = Project::with(['galleries' => function($q) {
                $q->where('thumbnail', 1);
            }])
            ->where('kategori_desain', $category)
            ->where('status_project', 'selesai')
            ->orderBy('created_at', 'desc')
            ->paginate(9);
        
        $categoryLabel = $this->getCategoryLabel($category);
        
        return view('portfolio.category', compact('projects', 'categoryLabel', 'category'));
    }
    
    /**
     * Get category label.
     *
     * @param string $category
     * @return string
     */
    private function getCategoryLabel($category)
    {
        $labels = [
            'minimalist' => 'Minimalis',
            'modern' => 'Modern',
            'classic' => 'Klasik',
            'luxury' => 'Mewah',
            'contemporary' => 'Kontemporer',
            'industrial' => 'Industrial',
        ];
        
        return $labels[$category] ?? ucfirst($category);
    }
}