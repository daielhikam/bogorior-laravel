<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaketLayanan;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**
     * Get all service packages
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
    {
        try {
            $limit = $request->input('limit', 100);
            $aktif = $request->input('aktif', 1);
            $jenis = $request->input('jenis');

            $query = PaketLayanan::query();

            if ($aktif !== null && $aktif !== 'all') {
                $query->where('aktif', (bool) $aktif);
            }

            if ($jenis) {
                $query->where('jenis_layanan', $jenis);
            }

            $query->orderBy('urutan', 'asc')
                ->orderBy('popular', 'desc')
                ->orderBy('created_at', 'desc');

            if ($limit && $limit > 0) {
                $query->limit($limit);
            }

            $pakets = $query->get();

            $formattedPakets = $pakets->map(function ($paket) {
                return $this->formatPaket($paket);
            });

            return $this->success($formattedPakets, 'Service packages retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve service packages: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get package by ID
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getById(Request $request)
    {
        try {
            $id = $request->input('id');

            if (!$id) {
                return $this->error('Package ID is required', 400);
            }

            $paket = PaketLayanan::find($id);

            if (!$paket) {
                return $this->notFound('Service package not found');
            }

            return $this->success($this->formatPaket($paket, true), 'Service package retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve service package: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get package by slug
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBySlug(Request $request)
    {
        try {
            $slug = $request->input('slug');

            if (!$slug) {
                return $this->error('Package slug is required', 400);
            }

            $paket = PaketLayanan::where('slug_paket', $slug)->first();

            if (!$paket) {
                return $this->notFound('Service package not found');
            }

            return $this->success($this->formatPaket($paket, true), 'Service package retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve service package: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get popular packages
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPopular(Request $request)
    {
        try {
            $limit = $request->input('limit', 4);

            $pakets = PaketLayanan::where('aktif', true)
                ->where('popular', true)
                ->orderBy('urutan', 'asc')
                ->limit($limit)
                ->get();

            $formattedPakets = $pakets->map(function ($paket) {
                return $this->formatPaket($paket);
            });

            return $this->success($formattedPakets, 'Popular packages retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve popular packages: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get packages by jenis layanan
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByJenis(Request $request)
    {
        try {
            $jenis = $request->input('jenis');
            $limit = $request->input('limit', 10);

            if (!$jenis) {
                return $this->error('Jenis layanan is required', 400);
            }

            $validJeniss = ['custom', 'premium', 'renovasi', 'interior'];
            if (!in_array($jenis, $validJeniss)) {
                return $this->error('Invalid jenis layanan', 400);
            }

            $pakets = PaketLayanan::where('aktif', true)
                ->where('jenis_layanan', $jenis)
                ->orderBy('urutan', 'asc')
                ->limit($limit)
                ->get();

            $formattedPakets = $pakets->map(function ($paket) {
                return $this->formatPaket($paket);
            });

            return $this->success($formattedPakets, "Packages for {$jenis} retrieved successfully");
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve packages: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Format package data
     * 
     * @param PaketLayanan $paket
     * @param bool $detailed
     * @return array
     */
    private function formatPaket($paket, $detailed = false)
    {
        $data = [
            'id_paket' => $paket->id_paket,
            'nama_paket' => $paket->nama_paket,
            'slug_paket' => $paket->slug_paket,
            'jenis_layanan' => $paket->jenis_layanan,
            'jenis_layanan_label' => $paket->jenis_layanan_label,
            'harga_mulai' => $paket->harga_mulai,
            'harga_mulai_formatted' => $paket->harga_mulai_formatted,
            'deskripsi_singkat' => $paket->deskripsi_singkat,
            'icon' => $paket->icon,
            'image_url' => $paket->image_url,
            'popular' => (bool) $paket->popular,
            'popular_badge' => $paket->popular_badge,
            'aktif' => (bool) $paket->aktif,
            'urutan' => $paket->urutan,
            'created_at' => $paket->created_at ? $paket->created_at->toISOString() : null,
        ];

        if ($detailed) {
            $data['deskripsi_lengkap'] = $paket->deskripsi_lengkap;
            
            // Parse fitur as array if it's JSON
            if ($paket->fitur) {
                $data['fitur'] = json_decode($paket->fitur, true) ?? explode("\n", $paket->fitur);
            } else {
                $data['fitur'] = [];
            }
            
            // Parse spesifikasi as array if it's JSON
            if ($paket->spesifikasi) {
                $data['spesifikasi'] = json_decode($paket->spesifikasi, true) ?? explode("\n", $paket->spesifikasi);
            } else {
                $data['spesifikasi'] = [];
            }
        }

        return $data;
    }
}