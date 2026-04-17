<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\GalleryProject;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Get all projects (for portfolio)
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
    {
        try {
            $limit = $request->input('limit', 10);
            $status = $request->input('status', 'selesai');
            $jenis = $request->input('jenis');
            $kategori = $request->input('kategori');
            $search = $request->input('search');

            $query = Project::with(['galleries' => function ($q) {
                $q->where('thumbnail', 1)
                    ->orWhere('jenis_foto', 'sesudah')
                    ->orderBy('urutan', 'asc')
                    ->orderBy('id_gallery', 'asc');
            }]);

            // Apply filters
            if ($status) {
                $query->where('status_project', $status);
            }

            if ($jenis) {
                $query->where('jenis_project', $jenis);
            }

            if ($kategori) {
                $query->where('kategori_desain', $kategori);
            }

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_project', 'like', "%{$search}%")
                        ->orWhere('kode_project', 'like', "%{$search}%")
                        ->orWhere('lokasi_project', 'like', "%{$search}%");
                });
            }

            // Order by latest
            $query->orderBy('created_at', 'desc');

            $projects = $query->paginate($limit);

            // Format data untuk frontend
            $formattedProjects = $projects->map(function ($project) {
                return $this->formatProjectForList($project);
            });

            return $this->success([
                'projects' => $formattedProjects,
                'total' => $projects->total(),
                'current_page' => $projects->currentPage(),
                'last_page' => $projects->lastPage(),
                'per_page' => $projects->perPage(),
            ], 'Projects retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve projects: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get single project by ID
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getById(Request $request)
    {
        try {
            $id = $request->input('id');

            if (!$id) {
                return $this->error('Project ID is required', 400);
            }

            $project = Project::with([
                'galleries' => function ($q) {
                    $q->orderBy('urutan', 'asc')
                        ->orderBy('id_gallery', 'asc');
                },
                'pelanggan',
                'testimonials' => function ($q) {
                    $q->where('status_testimoni', 'approved');
                },
                'materials'
            ])->find($id);

            if (!$project) {
                return $this->notFound('Project not found');
            }

            $formattedProject = $this->formatProjectForDetail($project);

            return $this->success($formattedProject, 'Project retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve project: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get project by code
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByCode(Request $request)
    {
        try {
            $kode = $request->input('kode');

            if (!$kode) {
                return $this->error('Project code is required', 400);
            }

            $project = Project::with([
                'galleries' => function ($q) {
                    $q->orderBy('urutan', 'asc');
                },
                'pelanggan',
                'testimonials'
            ])->where('kode_project', $kode)->first();

            if (!$project) {
                return $this->notFound('Project not found');
            }

            $formattedProject = $this->formatProjectForDetail($project);

            return $this->success($formattedProject, 'Project retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve project: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get project statistics
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStats()
    {
        try {
            $totalProjects = Project::count();
            $completedProjects = Project::where('status_project', 'selesai')->count();
            
            // Calculate average rating from projects with ratings
            $avgRating = Project::whereNotNull('rating_project')->avg('rating_project');
            $satisfactionRate = $avgRating ? round(($avgRating / 5) * 100) : 98;
            
            // Get experience years (assuming company founded in 2016)
            $foundedYear = 2016;
            $experienceYears = date('Y') - $foundedYear;
            
            // Get warranty from settings (will be overridden by settings controller)
            $warrantyYears = 5;

            // Get project by jenis
            $projectsByJenis = [
                'custom' => Project::where('jenis_project', 'custom')->count(),
                'premium' => Project::where('jenis_project', 'premium')->count(),
                'renovasi' => Project::where('jenis_project', 'renovasi')->count(),
                'interior' => Project::where('jenis_project', 'interior')->count(),
            ];

            // Get recent projects count (last 30 days)
            $recentProjects = Project::where('created_at', '>=', now()->subDays(30))->count();

            return $this->success([
                'total_projects' => $totalProjects,
                'completed_projects' => $completedProjects,
                'satisfaction_rate' => $satisfactionRate . '%',
                'experience_years' => $experienceYears . '+',
                'warranty_years' => $warrantyYears,
                'projects_by_jenis' => $projectsByJenis,
                'recent_projects' => $recentProjects,
            ], 'Statistics retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve statistics: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get featured projects (for homepage)
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFeatured(Request $request)
    {
        try {
            $limit = $request->input('limit', 6);

            $projects = Project::with(['galleries' => function ($q) {
                $q->where('thumbnail', 1)
                    ->orWhere('jenis_foto', 'sesudah')
                    ->orderBy('urutan', 'asc');
            }])
            ->where('status_project', 'selesai')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();

            $formattedProjects = $projects->map(function ($project) {
                return $this->formatProjectForList($project);
            });

            return $this->success($formattedProjects, 'Featured projects retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve featured projects: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get project filters (jenis and kategori options)
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFilters()
    {
        try {
            $jenisOptions = [
                ['value' => 'custom', 'label' => 'Kitchen Set Custom'],
                ['value' => 'premium', 'label' => 'Kitchen Set Premium'],
                ['value' => 'renovasi', 'label' => 'Renovasi Dapur'],
                ['value' => 'interior', 'label' => 'Interior Design'],
            ];

            $kategoriOptions = [
                ['value' => 'minimalist', 'label' => 'Minimalis'],
                ['value' => 'modern', 'label' => 'Modern'],
                ['value' => 'classic', 'label' => 'Klasik'],
                ['value' => 'luxury', 'label' => 'Mewah'],
                ['value' => 'contemporary', 'label' => 'Kontemporer'],
                ['value' => 'industrial', 'label' => 'Industrial'],
            ];

            $lokasiOptions = Project::select('lokasi_project')
                ->distinct()
                ->whereNotNull('lokasi_project')
                ->pluck('lokasi_project')
                ->toArray();

            return $this->success([
                'jenis' => $jenisOptions,
                'kategori_desain' => $kategoriOptions,
                'lokasi' => $lokasiOptions,
            ], 'Filters retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve filters: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Format project for list view
     * 
     * @param Project $project
     * @return array
     */
    private function formatProjectForList($project)
    {
        $mainImage = null;
        if ($project->galleries && $project->galleries->count() > 0) {
            $mainImage = $project->galleries->first()->image_url ?? null;
        }

        return [
            'id_project' => $project->id_project,
            'kode_project' => $project->kode_project,
            'nama_project' => $project->nama_project,
            'jenis_project' => $project->jenis_project,
            'jenis_project_label' => $project->jenis_project_label,
            'kategori_desain' => $project->kategori_desain,
            'kategori_desain_label' => $project->kategori_desain_label,
            'lokasi_project' => $project->lokasi_project,
            'luas_area' => $project->luas_area,
            'budget_project' => $project->budget_project,
            'budget_formatted' => $project->budget_formatted,
            'status_project' => $project->status_project,
            'status_badge' => $project->status_badge,
            'main_image' => $mainImage,
            'created_at' => $project->created_at ? $project->created_at->toISOString() : null,
        ];
    }

    /**
     * Format project for detail view
     * 
     * @param Project $project
     * @return array
     */
    private function formatProjectForDetail($project)
    {
        // Format galleries
        $galleries = [];
        if ($project->galleries) {
            $galleries = $project->galleries->map(function ($gallery) {
                return [
                    'id_gallery' => $gallery->id_gallery,
                    'jenis_foto' => $gallery->jenis_foto,
                    'jenis_foto_label' => $gallery->jenis_foto_label,
                    'url_foto' => $gallery->image_url,
                    'deskripsi_foto' => $gallery->deskripsi_foto,
                    'thumbnail' => (bool) $gallery->thumbnail,
                    'urutan' => $gallery->urutan,
                ];
            })->groupBy('jenis_foto')->toArray();
        }

        // Format materials
        $materials = [];
        if ($project->materials) {
            $materials = $project->materials->map(function ($material) {
                return [
                    'id_material' => $material->id_material,
                    'nama_material' => $material->nama_material,
                    'jenis_material' => $material->jenis_material,
                    'jenis_material_label' => $material->jenis_material_label,
                    'spesifikasi' => $material->spesifikasi,
                    'merk' => $material->merk,
                    'jumlah' => $material->jumlah,
                    'satuan' => $material->satuan,
                ];
            })->groupBy('jenis_material')->toArray();
        }

        // Format testimonials
        $testimonials = [];
        if ($project->testimonials) {
            $testimonials = $project->testimonials->map(function ($testimoni) {
                return [
                    'id_testimoni' => $testimoni->id_testimoni,
                    'nama_client' => $testimoni->nama_client,
                    'rating' => $testimoni->rating,
                    'rating_stars' => $testimoni->rating_stars,
                    'testimoni' => $testimoni->testimoni,
                    'lokasi' => $testimoni->lokasi,
                    'avatar_url' => $testimoni->avatar_url,
                ];
            })->toArray();
        }

        // Get main image (priority: thumbnail sesudah, then any sesudah, then thumbnail, then first gallery)
        $mainImage = null;
        if ($project->galleries) {
            $thumbnailSesudah = $project->galleries->where('thumbnail', 1)->where('jenis_foto', 'sesudah')->first();
            $sesudah = $project->galleries->where('jenis_foto', 'sesudah')->first();
            $thumbnail = $project->galleries->where('thumbnail', 1)->first();
            $first = $project->galleries->first();
            
            $selected = $thumbnailSesudah ?? $sesudah ?? $thumbnail ?? $first;
            if ($selected) {
                $mainImage = $selected->image_url;
            }
        }

        return [
            'id_project' => $project->id_project,
            'kode_project' => $project->kode_project,
            'nama_project' => $project->nama_project,
            'jenis_project' => $project->jenis_project,
            'jenis_project_label' => $project->jenis_project_label,
            'kategori_desain' => $project->kategori_desain,
            'kategori_desain_label' => $project->kategori_desain_label,
            'luas_area' => $project->luas_area,
            'lokasi_project' => $project->lokasi_project,
            'alamat_lengkap' => $project->alamat_lengkap,
            'budget_project' => $project->budget_project,
            'budget_formatted' => $project->budget_formatted,
            'biaya_actual' => $project->biaya_actual,
            'biaya_actual_formatted' => $project->biaya_actual_formatted,
            'durasi_pengerjaan' => $project->durasi_pengerjaan,
            'deskripsi_project' => $project->deskripsi_project,
            'testimoni_client' => $project->testimoni_client,
            'rating_project' => $project->rating_project,
            'rating_stars' => $project->rating_stars,
            'status_project' => $project->status_project,
            'status_badge' => $project->status_badge,
            'tanggal_mulai' => $project->tanggal_mulai ? $project->tanggal_mulai->toISOString() : null,
            'tanggal_selesai' => $project->tanggal_selesai ? $project->tanggal_selesai->toISOString() : null,
            'tanggal_garansi' => $project->tanggal_garansi ? $project->tanggal_garansi->toISOString() : null,
            'main_image' => $mainImage,
            'galleries' => $galleries,
            'materials' => $materials,
            'testimonials' => $testimonials,
            'created_at' => $project->created_at ? $project->created_at->toISOString() : null,
            'updated_at' => $project->updated_at ? $project->updated_at->toISOString() : null,
        ];
    }
}