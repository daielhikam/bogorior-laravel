@extends('layouts.app')

@section('title', $service->nama_paket . ' - Layanan Bogorior KitchenSet')
@section('description', $service->deskripsi_singkat ?? 'Layanan ' . $service->nama_paket . ' dari Bogorior KitchenSet')

@section('content')
<!-- Breadcrumb -->
<section class="bg-gray-100 py-4">
    <div class="container mx-auto px-4">
        <div class="flex items-center gap-2 text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-green-600 transition">Beranda</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('services.index') }}" class="hover:text-green-600 transition">Layanan</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-gray-900">{{ $service->nama_paket }}</span>
        </div>
    </div>
</section>

<!-- Service Header -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Left Column - Service Info -->
            <div>
                @if($service->popular)
                <span class="inline-flex items-center gap-1 bg-gradient-to-r from-red-500 to-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full mb-4">
                    <i class="fas fa-fire text-xs"></i> POPULER
                </span>
                @endif
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $service->nama_paket }}</h1>
                <div class="flex items-center gap-2 mb-4">
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">{{ $service->jenis_layanan_label }}</span>
                </div>
                <div class="text-3xl font-bold text-green-600 mb-4">{{ $service->harga_mulai_formatted }}</div>
                <p class="text-gray-600 leading-relaxed mb-6">{{ $service->deskripsi_lengkap ?? $service->deskripsi_singkat }}</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="https://wa.me/628977288600" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-full transition flex items-center justify-center gap-2" target="_blank">
                        <i class="fab fa-whatsapp"></i> Konsultasi Sekarang
                    </a>
                    <a href="{{ route('portfolio.index') }}" class="border-2 border-green-600 text-green-600 hover:bg-green-600 hover:text-white font-semibold px-6 py-3 rounded-full transition flex items-center justify-center gap-2">
                        <i class="fas fa-images"></i> Lihat Portfolio
                    </a>
                </div>
            </div>
            
            <!-- Right Column - Image -->
            <div class="bg-gradient-to-br from-green-50 to-gray-50 rounded-2xl p-8 text-center">
                <div class="w-32 h-32 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="{{ $service->icon }} text-5xl text-green-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Mengapa Memilih Paket Ini?</h3>
                <ul class="text-left space-y-2">
                    <li class="flex items-center gap-2 text-gray-600"><i class="fas fa-check-circle text-green-600"></i> Material berkualitas premium</li>
                    <li class="flex items-center gap-2 text-gray-600"><i class="fas fa-check-circle text-green-600"></i> Desain custom sesuai kebutuhan</li>
                    <li class="flex items-center gap-2 text-gray-600"><i class="fas fa-check-circle text-green-600"></i> Garansi 5 tahun</li>
                    <li class="flex items-center gap-2 text-gray-600"><i class="fas fa-check-circle text-green-600"></i> Free konsultasi desain</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Fitur dan Spesifikasi -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Fitur -->
            @if(count($fitur) > 0)
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-star text-2xl text-green-600"></i>
                    <h2 class="text-2xl font-bold text-gray-800">Fitur Unggulan</h2>
                </div>
                <ul class="space-y-3">
                    @foreach($fitur as $item)
                    <li class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-green-600 mt-1"></i>
                        <span class="text-gray-600">{{ $item }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <!-- Spesifikasi -->
            @if(count($spesifikasi) > 0)
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-clipboard-list text-2xl text-green-600"></i>
                    <h2 class="text-2xl font-bold text-gray-800">Spesifikasi</h2>
                </div>
                <ul class="space-y-3">
                    @foreach($spesifikasi as $item)
                    <li class="flex items-start gap-3">
                        <i class="fas fa-cube text-green-600 mt-1"></i>
                        <span class="text-gray-600">{{ $item }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- Related Projects -->
@if($relatedProjects->count() > 0)
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Portfolio Terkait</h2>
            <p class="text-gray-600">Lihat hasil karya kami untuk layanan {{ $service->nama_paket }}</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($relatedProjects as $project)
            <div class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition">
                <div class="relative overflow-hidden h-56">
                    <img src="{{ $project->main_image_url }}" 
                         alt="{{ $project->nama_project }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                         onerror="this.src='https://placehold.co/600x400/e5e7eb/6b7280?text=No+Image'">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-4 translate-y-full group-hover:translate-y-0 transition">
                        <a href="{{ route('portfolio.detail', $project->id_project) }}" class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium">
                            Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
                <div class="p-4">
                    <span class="text-green-600 text-sm">{{ $project->jenis_project_label }}</span>
                    <h3 class="font-semibold text-gray-800 mt-1">{{ $project->nama_project }}</h3>
                    <p class="text-gray-500 text-sm">{{ $project->lokasi_project }}</p>
                    <div class="mt-2 text-green-600 font-semibold">{{ $project->budget_formatted }}</div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('portfolio.index') }}" class="inline-flex items-center gap-2 text-green-600 hover:text-green-700 font-medium">
                Lihat Semua Portfolio <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
@endif

<!-- FAQ Section -->
@if($faqs->count() > 0)
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Pertanyaan Umum</h2>
            <p class="text-gray-600">Informasi yang sering ditanyakan seputar {{ $service->nama_paket }}</p>
        </div>
        <div class="max-w-3xl mx-auto space-y-4">
            @foreach($faqs as $faq)
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="faq-question flex justify-between items-center p-5 cursor-pointer hover:bg-gray-50 transition">
                    <h4 class="font-semibold text-gray-800">{{ $faq->pertanyaan }}</h4>
                    <i class="fas fa-chevron-down text-gray-400 transition-transform duration-300"></i>
                </div>
                <div class="faq-answer hidden px-5 pb-5 text-gray-600 border-t">
                    {{ $faq->jawaban }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Other Services -->
@if($otherServices->count() > 0)
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Layanan Lainnya</h2>
            <p class="text-gray-600">Kami juga menyediakan layanan lain untuk kebutuhan Anda</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($otherServices as $other)
            <div class="bg-gray-50 rounded-xl p-6 text-center hover:shadow-md transition">
                <i class="{{ $other->icon }} text-3xl text-green-600 mb-3"></i>
                <h3 class="font-semibold text-gray-800 mb-1">{{ $other->nama_paket }}</h3>
                <p class="text-gray-500 text-sm mb-3">{{ $other->deskripsi_singkat ?? 'Mulai dari ' . $other->harga_mulai_formatted }}</p>
                <a href="{{ route('services.detail', $other->slug_paket) }}" class="text-green-600 hover:text-green-700 text-sm font-medium">
                    Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-green-600 to-green-700 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Mulai Konsultasi Sekarang</h2>
        <p class="text-lg mb-8 max-w-2xl mx-auto opacity-90">Dapatkan konsultasi gratis dengan tim desainer profesional kami</p>
        <a href="https://wa.me/628977288600" class="inline-flex items-center gap-2 bg-white text-green-600 hover:bg-gray-100 font-semibold px-8 py-3 rounded-full transition shadow-lg" target="_blank">
            <i class="fab fa-whatsapp"></i> Hubungi Kami
        </a>
    </div>
</section>

<script>
// FAQ Accordion
document.querySelectorAll('.faq-question').forEach(question => {
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
</script>
@endsection