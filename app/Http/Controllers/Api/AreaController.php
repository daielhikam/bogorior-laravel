<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AreaLayanan;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Get all service areas
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
    {
        try {
            $limit = $request->input('limit', 100);
            $jenis = $request->input('jenis');
            $aktif = $request->input('aktif', 1);

            $query = AreaLayanan::query();

            if ($aktif !== null && $aktif !== 'all') {
                $query->where('aktif', (bool) $aktif);
            }

            if ($jenis) {
                $query->where('jenis_area', $jenis);
            }

            $query->orderBy('urutan', 'asc')
                ->orderBy('nama_area', 'asc');

            if ($limit && $limit > 0) {
                $query->limit($limit);
            }

            $areas = $query->get();

            $formattedAreas = $areas->map(function ($area) {
                return $this->formatArea($area);
            });

            // Get jenis options with counts
            $jenisOptions = AreaLayanan::where('aktif', true)
                ->select('jenis_area')
                ->selectRaw('COUNT(*) as total')
                ->groupBy('jenis_area')
                ->get()
                ->map(function ($item) {
                    $labels = [
                        'kota' => 'Kota',
                        'kabupaten' => 'Kabupaten',
                        'sekitar' => 'Sekitar',
                        'luar_kota' => 'Luar Kota',
                    ];
                    return [
                        'value' => $item->jenis_area,
                        'label' => $labels[$item->jenis_area] ?? ucfirst($item->jenis_area),
                        'total' => $item->total,
                    ];
                });

            return $this->success([
                'areas' => $formattedAreas,
                'jenis_options' => $jenisOptions,
                'total' => $areas->count(),
            ], 'Service areas retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve service areas: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get area by ID
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getById(Request $request)
    {
        try {
            $id = $request->input('id');

            if (!$id) {
                return $this->error('Area ID is required', 400);
            }

            $area = AreaLayanan::find($id);

            if (!$area) {
                return $this->notFound('Service area not found');
            }

            return $this->success($this->formatArea($area), 'Service area retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve service area: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get areas by jenis
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByJenis(Request $request)
    {
        try {
            $jenis = $request->input('jenis');

            if (!$jenis) {
                return $this->error('Jenis area is required', 400);
            }

            $validJeniss = ['kota', 'kabupaten', 'sekitar', 'luar_kota'];
            if (!in_array($jenis, $validJeniss)) {
                return $this->error('Invalid jenis area', 400);
            }

            $areas = AreaLayanan::where('aktif', true)
                ->where('jenis_area', $jenis)
                ->orderBy('urutan', 'asc')
                ->orderBy('nama_area', 'asc')
                ->get();

            $formattedAreas = $areas->map(function ($area) {
                return $this->formatArea($area);
            });

            return $this->success($formattedAreas, "Service areas for jenis {$jenis} retrieved successfully");
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve service areas: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Format area data
     * 
     * @param AreaLayanan $area
     * @return array
     */
    private function formatArea($area)
    {
        $jenisLabels = [
            'kota' => 'Kota',
            'kabupaten' => 'Kabupaten',
            'sekitar' => 'Sekitar',
            'luar_kota' => 'Luar Kota',
        ];

        // Parse daftar_lokasi as array
        $daftarLokasi = [];
        if ($area->daftar_lokasi) {
            $daftarLokasi = explode(',', $area->daftar_lokasi);
            $daftarLokasi = array_map('trim', $daftarLokasi);
        }

        return [
            'id_area' => $area->id_area,
            'nama_area' => $area->nama_area,
            'jenis_area' => $area->jenis_area,
            'jenis_area_label' => $jenisLabels[$area->jenis_area] ?? ucfirst($area->jenis_area),
            'daftar_lokasi' => $daftarLokasi,
            'deskripsi' => $area->deskripsi,
            'urutan' => $area->urutan,
            'aktif' => (bool) $area->aktif,
            'created_at' => $area->created_at ? $area->created_at->toISOString() : null,
        ];
    }
}