<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PesanKontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KontakController extends Controller
{
    /**
     * Submit contact form
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
                'email' => 'required|email|max:100',
                'no_whatsapp' => 'nullable|string|max:20',
                'subjek' => 'required|string|max:200',
                'pesan' => 'required|string',
            ]);

            if ($validator->fails()) {
                return $this->validationError($validator->errors(), 'Validation failed');
            }

            $validated = $validator->validated();

            // Create contact message
            $pesan = PesanKontak::create([
                'nama_pengirim' => $validated['nama'],
                'email_pengirim' => $validated['email'],
                'no_whatsapp' => $validated['no_whatsapp'] ?? null,
                'subjek' => $validated['subjek'],
                'pesan' => $validated['pesan'],
                'status_pesan' => 'baru',
            ]);

            // TODO: Send notification to admin (email, WhatsApp, etc.)
            // TODO: Send auto-reply to customer

            return $this->success([
                'id_pesan' => $pesan->id_pesan,
                'status' => 'success',
                'message' => 'Pesan berhasil dikirim. Tim kami akan segera merespon.',
            ], 'Contact message submitted successfully', 201);
        } catch (\Exception $e) {
            return $this->error('Failed to submit contact message: ' . $e->getMessage(), 500);
        }
    }
}