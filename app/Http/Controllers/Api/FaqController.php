<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Get all FAQs
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
    {
        try {
            $limit = $request->input('limit', 100);
            $kategori = $request->input('kategori');
            $aktif = $request->input('aktif', 1);

            $query = Faq::query();

            if ($aktif !== null && $aktif !== 'all') {
                $query->where('aktif', (bool) $aktif);
            }

            if ($kategori) {
                $query->where('kategori', $kategori);
            }

            $query->orderBy('urutan', 'asc')
                ->orderBy('created_at', 'asc');

            if ($limit && $limit > 0) {
                $query->limit($limit);
            }

            $faqs = $query->get();

            $formattedFaqs = $faqs->map(function ($faq) {
                return $this->formatFaq($faq);
            });

            // Get kategori options with counts
            $kategoriOptions = Faq::where('aktif', true)
                ->select('kategori')
                ->selectRaw('COUNT(*) as total')
                ->groupBy('kategori')
                ->get()
                ->map(function ($item) {
                    $labels = [
                        'layanan' => 'Layanan',
                        'pembayaran' => 'Pembayaran',
                        'garansi' => 'Garansi',
                        'pemasangan' => 'Pemasangan',
                        'material' => 'Material',
                        'umum' => 'Umum',
                    ];
                    return [
                        'value' => $item->kategori,
                        'label' => $labels[$item->kategori] ?? ucfirst($item->kategori),
                        'total' => $item->total,
                    ];
                });

            return $this->success([
                'faqs' => $formattedFaqs,
                'kategori_options' => $kategoriOptions,
                'total' => $faqs->count(),
            ], 'FAQs retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve FAQs: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get FAQ by ID
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getById(Request $request)
    {
        try {
            $id = $request->input('id');

            if (!$id) {
                return $this->error('FAQ ID is required', 400);
            }

            $faq = Faq::find($id);

            if (!$faq) {
                return $this->notFound('FAQ not found');
            }

            return $this->success($this->formatFaq($faq), 'FAQ retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve FAQ: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get FAQs by kategori
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByKategori(Request $request)
    {
        try {
            $kategori = $request->input('kategori');

            if (!$kategori) {
                return $this->error('Kategori is required', 400);
            }

            $validKategoris = ['layanan', 'pembayaran', 'garansi', 'pemasangan', 'material', 'umum'];
            if (!in_array($kategori, $validKategoris)) {
                return $this->error('Invalid kategori', 400);
            }

            $faqs = Faq::where('aktif', true)
                ->where('kategori', $kategori)
                ->orderBy('urutan', 'asc')
                ->get();

            $formattedFaqs = $faqs->map(function ($faq) {
                return $this->formatFaq($faq);
            });

            return $this->success($formattedFaqs, "FAQs for kategori {$kategori} retrieved successfully");
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve FAQs: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Format FAQ data
     * 
     * @param Faq $faq
     * @return array
     */
    private function formatFaq($faq)
    {
        $kategoriLabels = [
            'layanan' => 'Layanan',
            'pembayaran' => 'Pembayaran',
            'garansi' => 'Garansi',
            'pemasangan' => 'Pemasangan',
            'material' => 'Material',
            'umum' => 'Umum',
        ];

        return [
            'id_faq' => $faq->id_faq,
            'pertanyaan' => $faq->pertanyaan,
            'jawaban' => $faq->jawaban,
            'kategori' => $faq->kategori,
            'kategori_label' => $kategoriLabels[$faq->kategori] ?? ucfirst($faq->kategori),
            'urutan' => $faq->urutan,
            'aktif' => (bool) $faq->aktif,
            'created_at' => $faq->created_at ? $faq->created_at->toISOString() : null,
        ];
    }
}