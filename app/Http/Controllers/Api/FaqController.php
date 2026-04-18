<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Get all FAQs
     */
    public function getAll(Request $request)
    {
        try {
            $limit = $request->input('limit', 100);
            $aktif = $request->input('aktif', 1);

            $query = Faq::query();

            if ($aktif !== null && $aktif !== 'all') {
                $query->where('aktif', (bool) $aktif);
            }

            $query->orderBy('urutan', 'asc')
                ->orderBy('created_at', 'asc');

            if ($limit && $limit > 0) {
                $query->limit($limit);
            }

            $faqs = $query->get();

            return response()->json([
                'success' => true,
                'data' => $faqs
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve FAQs: ' . $e->getMessage()
            ], 500);
        }
    }
}