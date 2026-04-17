<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Konsultasi;
use App\Models\Testimoni;
use App\Models\Subscriber;
use App\Models\Artikel;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    /**
     * Get frontend statistics
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStats()
    {
        try {
            // Project stats
            $totalProjects = Project::count();
            $completedProjects = Project::where('status_project', 'selesai')->count();
            
            // Calculate average rating
            $avgRating = Project::whereNotNull('rating_project')->avg('rating_project');
            $satisfactionRate = $avgRating ? round(($avgRating / 5) * 100) : 98;
            
            // Experience years (assuming founded in 2016)
            $foundedYear = 2016;
            $experienceYears = date('Y') - $foundedYear;
            
            // Warranty from settings (default 5)
            $warrantyYears = 5;
            
            // Consultation stats
            $totalConsultations = Konsultasi::count();
            $newConsultations = Konsultasi::where('status_konsultasi', 'baru')->count();
            
            // Testimonial stats
            $totalTestimonials = Testimoni::where('status_testimoni', 'approved')->count();
            $videoTestimonials = Testimoni::where('status_testimoni', 'approved')
                ->where('tipe_testimoni', 'video')
                ->count();
            
            // Subscriber stats
            $totalSubscribers = Subscriber::where('status', 'aktif')->count();
            
            // Article stats
            $totalArticles = Artikel::where('status_artikel', 'publish')->count();
            
            // Project by jenis
            $projectsByJenis = [
                'custom' => Project::where('jenis_project', 'custom')->count(),
                'premium' => Project::where('jenis_project', 'premium')->count(),
                'renovasi' => Project::where('jenis_project', 'renovasi')->count(),
                'interior' => Project::where('jenis_project', 'interior')->count(),
            ];
            
            // Monthly projects (last 12 months)
            $monthlyProjects = [];
            for ($i = 11; $i >= 0; $i--) {
                $date = now()->subMonths($i);
                $monthName = $date->format('M Y');
                $count = Project::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count();
                $monthlyProjects[] = [
                    'month' => $monthName,
                    'count' => $count,
                ];
            }

            return $this->success([
                'total_projects' => $totalProjects,
                'completed_projects' => $completedProjects,
                'satisfaction_rate' => $satisfactionRate,
                'experience_years' => $experienceYears,
                'warranty_years' => $warrantyYears,
                'total_consultations' => $totalConsultations,
                'new_consultations' => $newConsultations,
                'total_testimonials' => $totalTestimonials,
                'video_testimonials' => $videoTestimonials,
                'total_subscribers' => $totalSubscribers,
                'total_articles' => $totalArticles,
                'projects_by_jenis' => $projectsByJenis,
                'monthly_projects' => $monthlyProjects,
            ], 'Statistics retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve statistics: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get quick stats for homepage
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getQuickStats()
    {
        try {
            $totalProjects = Project::count();
            $avgRating = Project::whereNotNull('rating_project')->avg('rating_project');
            $satisfactionRate = $avgRating ? round(($avgRating / 5) * 100) : 98;
            $foundedYear = 2016;
            $experienceYears = date('Y') - $foundedYear;
            $warrantyYears = 5;

            return $this->success([
                'total_projects' => $totalProjects,
                'satisfaction_rate' => $satisfactionRate,
                'experience_years' => $experienceYears,
                'warranty_years' => $warrantyYears,
            ], 'Quick stats retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve quick stats: ' . $e->getMessage(), 500);
        }
    }
}