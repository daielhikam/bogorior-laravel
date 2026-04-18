@extends('layouts.app')

@section('title', 'Kontak Kami - Bogorior KitchenSet')
@section('description', 'Hubungi tim Bogorior KitchenSet untuk konsultasi gratis tentang kitchen set impian Anda. Tersedia layanan via WhatsApp, telepon, email, atau formulir kontak.')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-green-600 to-green-700 text-white py-16">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Hubungi Kami</h1>
            <p class="text-lg max-w-2xl mx-auto opacity-90">Siap membantu mewujudkan dapur impian Anda. Tim kami akan merespon dalam waktu 1x24 jam</p>
        </div>
    </div>
</section>

<!-- Contact Info Cards -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- WhatsApp Card -->
            <div class="bg-gray-50 rounded-xl p-6 text-center hover:shadow-lg transition group">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-green-600 transition">
                    <i class="fab fa-whatsapp text-2xl text-green-600 group-hover:text-white transition"></i>
                </div>
                <h3 class="text-lg font-semibold mb-2">WhatsApp</h3>
                <p class="text-gray-500 text-sm mb-3">Chat cepat via WhatsApp</p>
                <a href="https://wa.me/{{ $contactInfo['whatsapp'] }}" target="_blank" class="text-green-600 font-medium hover:text-green-700">
                    +62 {{ substr($contactInfo['whatsapp'], 2) }} <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            
            <!-- Phone Card -->
            <div class="bg-gray-50 rounded-xl p-6 text-center hover:shadow-lg transition group">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-600 transition">
                    <i class="fas fa-phone text-2xl text-blue-600 group-hover:text-white transition"></i>
                </div>
                <h3 class="text-lg font-semibold mb-2">Telepon</h3>
                <p class="text-gray-500 text-sm mb-3">Senin - Sabtu, 09:00 - 17:00</p>
                <a href="tel:{{ $contactInfo['phone'] }}" class="text-blue-600 font-medium hover:text-blue-700">
                    {{ $contactInfo['phone'] }} <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            
            <!-- Email Card -->
            <div class="bg-gray-50 rounded-xl p-6 text-center hover:shadow-lg transition group">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-red-600 transition">
                    <i class="fas fa-envelope text-2xl text-red-600 group-hover:text-white transition"></i>
                </div>
                <h3 class="text-lg font-semibold mb-2">Email</h3>
                <p class="text-gray-500 text-sm mb-3">Balasan dalam 1x24 jam</p>
                <a href="mailto:{{ $contactInfo['email'] }}" class="text-red-600 font-medium hover:text-red-700">
                    {{ $contactInfo['email'] }} <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            
            <!-- Address Card -->
            <div class="bg-gray-50 rounded-xl p-6 text-center hover:shadow-lg transition group">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-purple-600 transition">
                    <i class="fas fa-map-marker-alt text-2xl text-purple-600 group-hover:text-white transition"></i>
                </div>
                <h3 class="text-lg font-semibold mb-2">Alamat</h3>
                <p class="text-gray-500 text-sm mb-3">{{ $contactInfo['address'] }}</p>
                <a href="https://maps.google.com/?q={{ urlencode($contactInfo['address']) }}" target="_blank" class="text-purple-600 font-medium hover:text-purple-700">
                    Lihat Peta <i class="fas fa-external-link-alt ml-1"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form & Map Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Contact Form -->
            <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
                <div class="text-center mb-6">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Kirim Pesan</h2>
                    <p class="text-gray-500">Isi formulir di bawah ini untuk menghubungi kami</p>
                </div>
                
                @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700 flex items-start gap-3">
                    <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
                    <div>
                        <strong>Berhasil!</strong>
                        <p class="text-sm mt-1">{{ session('success') }}</p>
                    </div>
                </div>
                @endif
                
                @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg text-red-700 flex items-start gap-3">
                    <i class="fas fa-exclamation-circle text-red-500 mt-0.5"></i>
                    <div>
                        <strong>Gagal!</strong>
                        <p class="text-sm mt-1">{{ session('error') }}</p>
                    </div>
                </div>
                @endif
                
                <form action="{{ route('contact.submit') }}" method="POST" id="contactForm">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" value="{{ old('nama') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500 @error('nama') border-red-500 @enderror"
                                   placeholder="Masukkan nama Anda">
                            @error('nama')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500 @error('email') border-red-500 @enderror"
                                   placeholder="email@example.com">
                            @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">WhatsApp</label>
                            <input type="tel" name="no_whatsapp" value="{{ old('no_whatsapp') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500"
                                   placeholder="6281234567890">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Subjek <span class="text-red-500">*</span></label>
                            <input type="text" name="subjek" value="{{ old('subjek') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500 @error('subjek') border-red-500 @enderror"
                                   placeholder="Subjek pesan">
                            @error('subjek')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Pesan <span class="text-red-500">*</span></label>
                        <textarea name="pesan" rows="5" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500 @error('pesan') border-red-500 @enderror"
                                  placeholder="Tulis pesan Anda di sini...">{{ old('pesan') }}</textarea>
                        @error('pesan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <div class="g-recaptcha" data-sitekey="your-site-key"></div>
                    </div>
                    
                    <button type="submit" id="submitBtn" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition flex items-center justify-center gap-2">
                        <i class="fas fa-paper-plane"></i> Kirim Pesan
                    </button>
                    
                    <p class="text-center text-gray-400 text-xs mt-4">
                        <i class="fas fa-lock mr-1"></i> Data Anda aman dan tidak akan dibagikan ke pihak ketiga.
                    </p>
                </form>
            </div>
            
            <!-- Map & Info -->
            <div>
                <!-- Map -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
                    <div class="h-64 md:h-80 bg-gray-200 relative">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253814.0745918128!2d106.68949964529422!3d-6.635940810715851!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c8d07b5e4a6f%3A0x31f5b6f2d8d9a2f1!2sBogor%2C%20Kota%20Bogor%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
                
                <!-- Business Hours -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <div class="flex items-center gap-3 mb-4">
                        <i class="fas fa-clock text-2xl text-green-600"></i>
                        <h3 class="text-xl font-bold text-gray-800">Jam Operasional</h3>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600">Senin - Jumat</span>
                            <span class="font-medium">09:00 - 17:00 WIB</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600">Sabtu</span>
                            <span class="font-medium">09:00 - 15:00 WIB</span>
                        </div>
                        <div class="flex justify-between py-2">
                            <span class="text-gray-600">Minggu</span>
                            <span class="font-medium text-gray-400">Tutup</span>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <i class="fas fa-share-alt text-2xl text-green-600"></i>
                        <h3 class="text-xl font-bold text-gray-800">Ikuti Kami</h3>
                    </div>
                    <div class="flex gap-4">
                        <a href="{{ $contactInfo['instagram'] }}" target="_blank" class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white hover:scale-110 transition">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="{{ $contactInfo['facebook'] }}" target="_blank" class="w-12 h-12 bg-blue-700 rounded-full flex items-center justify-center text-white hover:scale-110 transition">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="{{ $contactInfo['tiktok'] }}" target="_blank" class="w-12 h-12 bg-black rounded-full flex items-center justify-center text-white hover:scale-110 transition">
                            <i class="fab fa-tiktok text-xl"></i>
                        </a>
                        <a href="{{ $contactInfo['youtube'] }}" target="_blank" class="w-12 h-12 bg-red-700 rounded-full flex items-center justify-center text-white hover:scale-110 transition">
                            <i class="fab fa-youtube text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="p-4">
                <div class="text-3xl font-bold text-green-600">{{ $totalProjects ?? 0 }}+</div>
                <div class="text-gray-500">Project Selesai</div>
            </div>
            <div class="p-4">
                <div class="text-3xl font-bold text-green-600">{{ $happyClients ?? 0 }}+</div>
                <div class="text-gray-500">Klien Puas</div>
            </div>
            <div class="p-4">
                <div class="text-3xl font-bold text-green-600">10+</div>
                <div class="text-gray-500">Tahun Pengalaman</div>
            </div>
            <div class="p-4">
                <div class="text-3xl font-bold text-green-600">24/7</div>
                <div class="text-gray-500">Layanan Konsultasi</div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
@if($teamMembers->count() > 0)
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Tim Kami Siap Membantu</h2>
            <p class="text-gray-500">Hubungi tim profesional kami untuk konsultasi</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($teamMembers as $team)
            <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition text-center p-6">
                <div class="w-24 h-24 rounded-full mx-auto mb-4 overflow-hidden bg-gray-200">
                    <img src="{{ $team->foto_url }}" alt="{{ $team->nama_lengkap }}" class="w-full h-full object-cover" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($team->nama_lengkap) }}&background=059669&color=fff'">
                </div>
                <h3 class="text-lg font-semibold">{{ $team->nama_lengkap }}</h3>
                <p class="text-green-600 text-sm mb-2">{{ $team->posisi }}</p>
                <p class="text-gray-500 text-sm mb-3">{{ $team->pengalaman ?? 'Pengalaman 5+ tahun' }}</p>
                @if($team->no_whatsapp)
                <a href="https://wa.me/{{ $team->no_whatsapp }}" class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm transition" target="_blank">
                    <i class="fab fa-whatsapp mr-1"></i> Chat
                </a>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- FAQ Section -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Pertanyaan Umum</h2>
            <p class="text-gray-500">Informasi yang sering ditanyakan sebelum menghubungi kami</p>
        </div>
        <div class="max-w-3xl mx-auto space-y-4">
            <div class="bg-gray-50 rounded-xl overflow-hidden">
                <div class="faq-question flex justify-between items-center p-4 cursor-pointer hover:bg-gray-100 transition">
                    <h4 class="font-semibold">Apakah konsultasi desain gratis?</h4>
                    <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                </div>
                <div class="faq-answer hidden p-4 pt-0 text-gray-600">
                    Ya, kami menyediakan konsultasi desain GRATIS untuk semua calon klien. Anda bisa berkonsultasi via WhatsApp, telepon, atau datang langsung ke showroom kami.
                </div>
            </div>
            <div class="bg-gray-50 rounded-xl overflow-hidden">
                <div class="faq-question flex justify-between items-center p-4 cursor-pointer hover:bg-gray-100 transition">
                    <h4 class="font-semibold">Berapa lama proses pembuatan kitchen set?</h4>
                    <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                </div>
                <div class="faq-answer hidden p-4 pt-0 text-gray-600">
                    Proses pembuatan kitchen set biasanya memakan waktu 3-4 minggu tergantung kompleksitas desain dan material yang dipilih.
                </div>
            </div>
            <div class="bg-gray-50 rounded-xl overflow-hidden">
                <div class="faq-question flex justify-between items-center p-4 cursor-pointer hover:bg-gray-100 transition">
                    <h4 class="font-semibold">Apakah melayani area luar kota?</h4>
                    <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                </div>
                <div class="faq-answer hidden p-4 pt-0 text-gray-600">
                    Ya, kami melayani seluruh wilayah Jabodetabek dan sekitarnya. Untuk wilayah luar kota, akan dikenakan biaya tambahan untuk transportasi tim.
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // FAQ Accordion
    const faqQuestions = document.querySelectorAll('.faq-question');
    faqQuestions.forEach(question => {
        question.addEventListener('click', () => {
            const answer = question.nextElementSibling;
            const icon = question.querySelector('i');
            const isOpen = answer.classList.contains('block');
            
            // Close all others
            document.querySelectorAll('.faq-answer').forEach(a => {
                a.classList.remove('block');
                a.classList.add('hidden');
            });
            document.querySelectorAll('.faq-question i').forEach(i => {
                i.classList.remove('fa-chevron-up');
                i.classList.add('fa-chevron-down');
            });
            
            if (!isOpen) {
                answer.classList.remove('hidden');
                answer.classList.add('block');
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            }
        });
    });
    
    // Form submission loading state
    const form = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    
    if (form && submitBtn) {
        form.addEventListener('submit', function() {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
        });
    }
});
</script>
@endpush