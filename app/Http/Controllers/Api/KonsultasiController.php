<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Konsultasi;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KonsultasiController extends Controller
{
    /**
     * Submit consultation form
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function submit(Request $request)
    {
        try {
            // Validation rules
            $validator = Validator::make($request->all(), [
                'nama' => 'required|string|max:100',
                'no_whatsapp' => 'required|string|max:20',
                'email' => 'nullable|email|max:100',
                'jenis_layanan' => 'required|in:custom,premium,renovasi,interior,konsultasi_desain',
                'budget' => 'required|in:5-10,10-20,20-35,35-50,50+',
                'ukuran_dapur' => 'nullable|string|max:50',
                'alamat' => 'nullable|string',
                'pesan' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return $this->validationError($validator->errors(), 'Validation failed');
            }

            $validated = $validator->validated();

            // Check if customer exists by WhatsApp
            $pelanggan = Pelanggan::where('no_whatsapp', $validated['no_whatsapp'])->first();

            if (!$pelanggan) {
                // Create new customer
                $pelanggan = Pelanggan::create([
                    'nama_lengkap' => $validated['nama'],
                    'no_whatsapp' => $validated['no_whatsapp'],
                    'email' => $validated['email'] ?? null,
                    'alamat' => $validated['alamat'] ?? null,
                    'status_pelanggan' => 'prospek',
                    'sumber' => 'website',
                    'tanggal_daftar' => now(),
                ]);
            } else {
                // Update customer info if needed
                if ($pelanggan->nama_lengkap !== $validated['nama']) {
                    $pelanggan->nama_lengkap = $validated['nama'];
                }
                if ($validated['email'] && $pelanggan->email !== $validated['email']) {
                    $pelanggan->email = $validated['email'];
                }
                if ($validated['alamat'] && $pelanggan->alamat !== $validated['alamat']) {
                    $pelanggan->alamat = $validated['alamat'];
                }
                $pelanggan->save();
            }

            // Create consultation
            $konsultasi = Konsultasi::create([
                'id_pelanggan' => $pelanggan->id_pelanggan,
                'nama_konsultan' => $validated['nama'],
                'no_whatsapp' => $validated['no_whatsapp'],
                'email' => $validated['email'] ?? null,
                'jenis_layanan' => $validated['jenis_layanan'],
                'budget' => $validated['budget'],
                'ukuran_dapur' => $validated['ukuran_dapur'] ?? null,
                'alamat_lokasi' => $validated['alamat'] ?? null,
                'pesan_kebutuhan' => $validated['pesan'] ?? null,
                'status_konsultasi' => 'baru',
                'dihubungi' => 'belum',
                'tanggal_konsultasi' => now(),
            ]);

            // TODO: Send notification to admin (email, WhatsApp, etc.)
            // TODO: Send auto-reply to customer

            return $this->success([
                'id_konsultasi' => $konsultasi->id_konsultasi,
                'status' => 'success',
                'message' => 'Konsultasi berhasil dikirim. Tim kami akan segera menghubungi Anda.',
            ], 'Consultation submitted successfully', 201);
        } catch (\Exception $e) {
            return $this->error('Failed to submit consultation: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get consultation status
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStatus(Request $request)
    {
        try {
            $id = $request->input('id');
            $noWhatsapp = $request->input('no_whatsapp');

            if (!$id && !$noWhatsapp) {
                return $this->error('Either consultation ID or WhatsApp number is required', 400);
            }

            $query = Konsultasi::with('pelanggan');

            if ($id) {
                $query->where('id_konsultasi', $id);
            } elseif ($noWhatsapp) {
                $query->where('no_whatsapp', $noWhatsapp);
            }

            $konsultasi = $query->first();

            if (!$konsultasi) {
                return $this->notFound('Consultation not found');
            }

            return $this->success([
                'id_konsultasi' => $konsultasi->id_konsultasi,
                'nama' => $konsultasi->nama_konsultan,
                'no_whatsapp' => $konsultasi->no_whatsapp,
                'jenis_layanan' => $konsultasi->jenis_layanan,
                'jenis_layanan_label' => $konsultasi->jenis_layanan_label,
                'status' => $konsultasi->status_konsultasi,
                'status_badge' => $konsultasi->status_badge,
                'dihubungi' => $konsultasi->dihubungi,
                'dihubungi_badge' => $konsultasi->dihubungi_badge,
                'jadwal_survey' => $konsultasi->jadwal_survey ? $konsultasi->jadwal_survey->toISOString() : null,
                'created_at' => $konsultasi->created_at ? $konsultasi->created_at->toISOString() : null,
            ], 'Consultation status retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve consultation status: ' . $e->getMessage(), 500);
        }
    }
}