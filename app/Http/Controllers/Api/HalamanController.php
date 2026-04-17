<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Halaman;
use Illuminate\Http\Request;

class HalamanController extends Controller
{
    /**
     * Get all pages
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
    {
        try {
            $limit = $request->input('limit', 100);
            $jenis = $request->input('jenis');
            $status = $request->input('status', 'publish');

            $query = Halaman::where('status_halaman', $status);

            if ($jenis) {
                $query->where('jenis_halaman', $jenis);
            }

            $query->orderBy('urutan', 'asc')
                ->orderBy('created_at', 'asc');

            if ($limit && $limit > 0) {
                $query->limit($limit);
            }

            $pages = $query->get();

            $formattedPages = $pages->map(function ($page) {
                return $this->formatPage($page);
            });

            return $this->success($formattedPages, 'Pages retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve pages: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get page by ID
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getById(Request $request)
    {
        try {
            $id = $request->input('id');

            if (!$id) {
                return $this->error('Page ID is required', 400);
            }

            $page = Halaman::find($id);

            if (!$page) {
                return $this->notFound('Page not found');
            }

            return $this->success($this->formatPage($page, true), 'Page retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve page: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get page by slug
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBySlug(Request $request)
    {
        try {
            $slug = $request->input('slug');

            if (!$slug) {
                return $this->error('Page slug is required', 400);
            }

            $page = Halaman::where('slug_halaman', $slug)
                ->where('status_halaman', 'publish')
                ->first();

            if (!$page) {
                return $this->notFound('Page not found');
            }

            return $this->success($this->formatPage($page, true), 'Page retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve page: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get page by jenis
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByJenis(Request $request)
    {
        try {
            $jenis = $request->input('jenis');

            if (!$jenis) {
                return $this->error('Jenis halaman is required', 400);
            }

            $validJeniss = ['tentang', 'kontak', 'syarat_ketentuan', 'kebijakan_privasi', 'faq', 'lainnya'];
            if (!in_array($jenis, $validJeniss)) {
                return $this->error('Invalid jenis halaman', 400);
            }

            $page = Halaman::where('jenis_halaman', $jenis)
                ->where('status_halaman', 'publish')
                ->first();

            if (!$page) {
                return $this->notFound("Page with jenis '{$jenis}' not found");
            }

            return $this->success($this->formatPage($page, true), "Page '{$jenis}' retrieved successfully");
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve page: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Format page data
     * 
     * @param Halaman $page
     * @param bool $detailed
     * @return array
     */
    private function formatPage($page, $detailed = false)
    {
        $jenisLabels = [
            'tentang' => 'Tentang Kami',
            'kontak' => 'Kontak Kami',
            'syarat_ketentuan' => 'Syarat & Ketentuan',
            'kebijakan_privasi' => 'Kebijakan Privasi',
            'faq' => 'FAQ',
            'lainnya' => 'Lainnya',
        ];

        $data = [
            'id_halaman' => $page->id_halaman,
            'judul_halaman' => $page->judul_halaman,
            'slug_halaman' => $page->slug_halaman,
            'jenis_halaman' => $page->jenis_halaman,
            'jenis_halaman_label' => $jenisLabels[$page->jenis_halaman] ?? ucfirst($page->jenis_halaman),
            'meta_title' => $page->meta_title,
            'meta_description' => $page->meta_description,
            'urutan' => $page->urutan,
            'status_halaman' => $page->status_halaman,
            'created_at' => $page->created_at ? $page->created_at->toISOString() : null,
            'updated_at' => $page->updated_at ? $page->updated_at->toISOString() : null,
        ];

        if ($detailed) {
            $data['konten'] = $page->konten;
        }

        return $data;
    }
}