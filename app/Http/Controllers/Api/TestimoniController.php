<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    /**
     * Get all testimonials
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
    {
        try {
            $limit = $request->input('limit', 100);
            $tipe = $request->input('tipe'); // 'teks', 'video', or null for all
            $status = $request->input('status', 'approved');

            $query = Testimoni::where('status_testimoni', $status);

            if ($tipe) {
                $query->where('tipe_testimoni', $tipe);
            }

            $query->orderBy('featured', 'desc')
                ->orderBy('created_at', 'desc');

            if ($limit && $limit > 0) {
                $query->limit($limit);
            }

            $testimonials = $query->get();

            $formattedTestimonials = $testimonials->map(function ($testimoni) {
                return $this->formatTestimonial($testimoni);
            });

            // Calculate statistics
            $stats = [
                'total' => Testimoni::where('status_testimoni', 'approved')->count(),
                'total_teks' => Testimoni::where('status_testimoni', 'approved')->where('tipe_testimoni', 'teks')->count(),
                'total_video' => Testimoni::where('status_testimoni', 'approved')->where('tipe_testimoni', 'video')->count(),
                'average_rating' => round(Testimoni::where('status_testimoni', 'approved')->avg('rating') ?? 0, 1),
            ];

            return $this->success([
                'testimonials' => $formattedTestimonials,
                'stats' => $stats,
            ], 'Testimonials retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve testimonials: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get featured testimonials
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFeatured(Request $request)
    {
        try {
            $limit = $request->input('limit', 6);

            $testimonials = Testimoni::where('status_testimoni', 'approved')
                ->where('featured', true)
                ->orderBy('created_at', 'desc')
                ->limit($limit)
                ->get();

            $formattedTestimonials = $testimonials->map(function ($testimoni) {
                return $this->formatTestimonial($testimoni);
            });

            return $this->success($formattedTestimonials, 'Featured testimonials retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve featured testimonials: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get testimonial by ID
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getById(Request $request)
    {
        try {
            $id = $request->input('id');

            if (!$id) {
                return $this->error('Testimonial ID is required', 400);
            }

            $testimoni = Testimoni::find($id);

            if (!$testimoni) {
                return $this->notFound('Testimonial not found');
            }

            return $this->success($this->formatTestimonial($testimoni), 'Testimonial retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve testimonial: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get testimonials by rating
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByRating(Request $request)
    {
        try {
            $rating = $request->input('rating', 5);
            $limit = $request->input('limit', 10);

            if ($rating < 1 || $rating > 5) {
                return $this->error('Rating must be between 1 and 5', 400);
            }

            $testimonials = Testimoni::where('status_testimoni', 'approved')
                ->where('rating', $rating)
                ->orderBy('created_at', 'desc')
                ->limit($limit)
                ->get();

            $formattedTestimonials = $testimonials->map(function ($testimoni) {
                return $this->formatTestimonial($testimoni);
            });

            return $this->success($formattedTestimonials, "Testimonials with rating {$rating} retrieved successfully");
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve testimonials: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Format testimonial data
     * 
     * @param Testimoni $testimoni
     * @return array
     */
    private function formatTestimonial($testimoni)
    {
        $data = [
            'id_testimoni' => $testimoni->id_testimoni,
            'nama_client' => $testimoni->nama_client,
            'avatar_url' => $testimoni->avatar_url,
            'rating' => $testimoni->rating,
            'rating_stars' => $testimoni->rating_stars,
            'testimoni' => $testimoni->testimoni,
            'jenis_project' => $testimoni->jenis_project,
            'lokasi' => $testimoni->lokasi,
            'tipe_testimoni' => $testimoni->tipe_testimoni,
            'tipe_badge' => $testimoni->tipe_badge,
            'featured' => (bool) $testimoni->featured,
            'tanggal_testimoni' => $testimoni->tanggal_testimoni ? $testimoni->tanggal_testimoni->toISOString() : null,
            'created_at' => $testimoni->created_at ? $testimoni->created_at->toISOString() : null,
        ];

        // Add video data if testimoni is video type
        if ($testimoni->tipe_testimoni === 'video') {
            $data['video'] = [
                'url' => $testimoni->url_video,
                'platform' => $testimoni->video_platform,
                'video_id' => $testimoni->video_id,
                'thumbnail_url' => $testimoni->video_thumbnail_url,
            ];
        }

        // Add project relation if exists
        if ($testimoni->project) {
            $data['project'] = [
                'id_project' => $testimoni->project->id_project,
                'nama_project' => $testimoni->project->nama_project,
                'kode_project' => $testimoni->project->kode_project,
            ];
        }

        return $data;
    }
}