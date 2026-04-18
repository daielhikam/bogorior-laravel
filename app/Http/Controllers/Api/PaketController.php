<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaketLayanan;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**
     * Get all service packages
     */
    public function getAll(Request $request)
    {
        try {
            $limit = $request->input('limit', 100);
            $aktif = $request->input('aktif', 1);

            $query = PaketLayanan::query();

            if ($aktif !== null && $aktif !== 'all') {
                $query->where('aktif', (bool) $aktif);
            }

            $query->orderBy('urutan', 'asc')
                ->orderBy('popular', 'desc')
                ->orderBy('created_at', 'desc');

            if ($limit && $limit > 0) {
                $query->limit($limit);
            }

            $pakets = $query->get();

            return response()->json([
                'success' => true,
                'data' => $pakets
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve packages: ' . $e->getMessage()
            ], 500);
        }
    }
}