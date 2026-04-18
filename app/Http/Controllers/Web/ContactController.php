<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PesanKontak;
use App\Models\Setting;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display contact page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get contact settings
        $settings = Setting::all()->pluck('nilai', 'kunci')->toArray();
        
        $contactInfo = [
            'whatsapp' => $settings['whatsapp'] ?? '628977288600',
            'phone' => $settings['telepon'] ?? '628977288600',
            'email' => $settings['email'] ?? 'info@bogorior.com',
            'address' => $settings['alamat'] ?? 'Bogor, Indonesia',
            'instagram' => $settings['instagram'] ?? 'https://instagram.com/bogorior',
            'facebook' => $settings['facebook'] ?? 'https://facebook.com/bogorior',
            'tiktok' => $settings['tiktok'] ?? 'https://tiktok.com/@bogorior',
            'youtube' => $settings['youtube'] ?? 'https://youtube.com/@bogorior',
        ];
        
        // Get team members for contact section
        $teamMembers = Team::where('aktif', true)
            ->orderBy('urutan', 'asc')
            ->limit(3)
            ->get();
        
        // Get statistics
        $totalProjects = \App\Models\Project::count();
        $happyClients = \App\Models\Project::where('status_project', 'selesai')->count();
        
        return view('contact.index', compact('contactInfo', 'teamMembers', 'totalProjects', 'happyClients'));
    }
    
    /**
     * Handle contact form submission.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'no_whatsapp' => 'nullable|string|max:20',
            'subjek' => 'required|string|max:200',
            'pesan' => 'required|string|min:10',
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'subjek.required' => 'Subjek pesan wajib diisi.',
            'pesan.required' => 'Pesan wajib diisi.',
            'pesan.min' => 'Pesan minimal 10 karakter.',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        try {
            // Save message
            PesanKontak::create([
                'nama_pengirim' => $request->nama,
                'email_pengirim' => $request->email,
                'no_whatsapp' => $request->no_whatsapp,
                'subjek' => $request->subjek,
                'pesan' => $request->pesan,
                'status_pesan' => 'baru',
            ]);
            
            return redirect()->back()
                ->with('success', 'Pesan berhasil dikirim! Tim kami akan segera menghubungi Anda.');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengirim pesan. Silakan coba lagi.');
        }
    }
}