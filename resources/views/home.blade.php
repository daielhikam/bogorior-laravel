@extends('layouts.app')

@section('title', 'Bogorior KitchenSet - Kitchen Set Premium untuk Hunian Impian Anda')
@section('description', '500+ kitchen set telah terwujud dengan kualitas terbaik. Garansi 5 tahun, cicilan 0% 36x, free konsultasi desain.')

@section('content')
<!-- Hero Section with Slider -->
<section class="relative min-h-screen pt-20 overflow-hidden" id="cinematicHero">
    <div class="absolute top-0 left-0 w-full h-1 bg-gray-200 z-20">
        <div id="progressBarTop" class="h-full bg-green-600 w-0 transition-all duration-300"></div>
    </div>
    
    <div class="relative" id="sliderContainer">
        <!-- Slide 1 -->
        <div class="slide block" data-slide="1">
            <div class="relative flex">
                <div class="slide-before w-1/2 relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=1200" alt="Sebelum" class="w-full h-[600px] object-cover">
                    <div class="absolute inset-0 bg-black/20"></div>
                    <div class="absolute bottom-6 left-6 bg-black/70 text-white px-4 py-2 rounded-full text-sm font-medium">👈 SEBELUM</div>
                </div>
                <div class="slide-after w-1/2 relative overflow-hidden" style="left: 50%;">
                    <img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=1200" alt="Sesudah" class="w-full h-[600px] object-cover">
                    <div class="absolute inset-0 bg-black/20"></div>
                    <div class="absolute bottom-6 right-6 bg-black/70 text-white px-4 py-2 rounded-full text-sm font-medium">SETELAH 👉</div>
                </div>
            </div>
        </div>
        
        <!-- Slide 2 -->
        <div class="slide hidden" data-slide="2">
            <div class="relative flex">
                <div class="slide-before w-1/2 relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=1200" alt="Sebelum" class="w-full h-[600px] object-cover">
                    <div class="absolute inset-0 bg-black/20"></div>
                    <div class="absolute bottom-6 left-6 bg-black/70 text-white px-4 py-2 rounded-full text-sm font-medium">👈 SEBELUM</div>
                </div>
                <div class="slide-after w-1/2 relative overflow-hidden" style="left: 50%;">
                    <img src="https://images.unsplash.com/photo-1600585154340-963ed7476d06?w=1200" alt="Sesudah" class="w-full h-[600px] object-cover">
                    <div class="absolute inset-0 bg-black/20"></div>
                    <div class="absolute bottom-6 right-6 bg-black/70 text-white px-4 py-2 rounded-full text-sm font-medium">SETELAH 👉</div>
                </div>
            </div>
        </div>
        
        <!-- Slide 3 -->
        <div class="slide hidden" data-slide="3">
            <div class="relative flex">
                <div class="slide-before w-1/2 relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1584132967334-10e028bd69f7?w=1200" alt="Sebelum" class="w-full h-[600px] object-cover">
                    <div class="absolute inset-0 bg-black/20"></div>
                    <div class="absolute bottom-6 left-6 bg-black/70 text-white px-4 py-2 rounded-full text-sm font-medium">👈 SEBELUM</div>
                </div>
                <div class="slide-after w-1/2 relative overflow-hidden" style="left: 50%;">
                    <img src="https://images.unsplash.com/photo-1565538810643-b5bdb714032a?w=1200" alt="Sesudah" class="w-full h-[600px] object-cover">
                    <div class="absolute inset-0 bg-black/20"></div>
                    <div class="absolute bottom-6 right-6 bg-black/70 text-white px-4 py-2 rounded-full text-sm font-medium">SETELAH 👉</div>
                </div>
            </div>
        </div>
        
        <!-- Divider Handle -->
        <div id="dividerHandle" class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-12 h-12 bg-white rounded-full shadow-lg cursor-grab flex items-center justify-center z-30 hover:scale-110 transition">
            <i class="fas fa-arrows-left-right text-gray-600"></i>
        </div>
        
        <!-- Hero Content Overlay -->
        <div class="absolute inset-0 flex items-center justify-center z-20">
            <div class="text-center text-white px-4">
                <h1 class="text-4xl md:text-6xl font-bold mb-4 drop-shadow-lg" id="heroHeadline">
                    Transformasi Total <span class="text-green-400">Dapur Anda</span><br>Dalam 3-4 Minggu Saja
                </h1>
                <p class="text-lg md:text-xl mb-8 drop-shadow-lg max-w-2xl mx-auto">
                    Dari <strong id="totalProjectsHero">{{ number_format($stats['total_projects']) }}</strong> project yang telah kami selesaikan, lihat bagaimana kami mengubah dapur biasa menjadi ruangan favorit keluarga.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="https://wa.me/{{ $viewSettings['whatsapp_number'] }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-8 py-3 rounded-full transition flex items-center justify-center gap-2 shadow-lg" target="_blank">
                        <i class="fab fa-whatsapp"></i> Konsultasi Gratis
                    </a>
                    <a href="{{ route('portfolio.index') }}" class="bg-white/20 backdrop-blur hover:bg-white/30 text-white font-semibold px-8 py-3 rounded-full transition flex items-center justify-center gap-2 border border-white">
                        <i class="fas fa-images"></i> Lihat Portfolio
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Navigation Dots -->
        <div class="absolute bottom-6 left-0 right-0 flex justify-center gap-3 z-20">
            <button class="nav-dot w-3 h-3 rounded-full bg-white transition-all" data-slide="1"></button>
            <button class="nav-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all" data-slide="2"></button>
            <button class="nav-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all" data-slide="3"></button>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-12 bg-white shadow-sm">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="stat-card">
                <i class="fas fa-tools text-3xl text-green-600 mb-2"></i>
                <div class="text-3xl font-bold text-gray-800">{{ number_format($stats['total_projects']) }}</div>
                <div class="text-gray-500">Project Selesai</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-smile text-3xl text-green-600 mb-2"></i>
                <div class="text-3xl font-bold text-gray-800">{{ $stats['satisfaction_rate'] }}%</div>
                <div class="text-gray-500">Kepuasan Client</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-clock text-3xl text-green-600 mb-2"></i>
                <div class="text-3xl font-bold text-gray-800">{{ $stats['experience_years'] }}+</div>
                <div class="text-gray-500">Tahun Pengalaman</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-shield-alt text-3xl text-green-600 mb-2"></i>
                <div class="text-3xl font-bold text-gray-800">{{ $stats['warranty_years'] }}</div>
                <div class="text-gray-500">Tahun Garansi</div>
            </div>
        </div>
    </div>
</section>

<!-- Trust Badges -->
<section class="py-8 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap justify-center gap-8">
            <div class="flex items-center gap-2 text-gray-600"><i class="fas fa-shield-alt text-green-600"></i> <span>{{ $viewSettings['garansi'] }}</span></div>
            <div class="flex items-center gap-2 text-gray-600"><i class="fas fa-medal text-green-600"></i> <span>Material Premium</span></div>
            <div class="flex items-center gap-2 text-gray-600"><i class="fas fa-clock text-green-600"></i> <span>Proses {{ $viewSettings['proses_pengerjaan'] }} Minggu</span></div>
            <div class="flex items-center gap-2 text-gray-600"><i class="fas fa-tools text-green-600"></i> <span>{{ $viewSettings['free_survey'] ? 'Free Survey' : 'Survey Berbayar' }}</span></div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $viewSettings['services_title'] }}</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">{{ $viewSettings['services_subtitle'] }}</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($services as $service)
            <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 text-center p-6 relative {{ $service->popular ? 'border-2 border-green-500' : '' }}">
                @if($service->popular)
                <span class="absolute -top-3 right-4 bg-green-600 text-white text-xs px-3 py-1 rounded-full">POPULER</span>
                @endif
                <i class="{{ $service->icon }} text-4xl text-green-600 mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">{{ $service->nama_paket }}</h3>
                <p class="text-gray-500 text-sm mb-4">{{ $service->deskripsi_singkat ?? 'Deskripsi layanan akan segera hadir' }}</p>
                <div class="text-2xl font-bold text-green-600 mb-4">{{ $service->harga_mulai_formatted }}</div>
                <a href="{{ route('services.detail', $service->slug_paket) }}" class="text-green-600 hover:text-green-700 font-medium inline-flex items-center gap-1">Selengkapnya <i class="fas fa-arrow-right text-sm"></i></a>
            </div>
            @empty
            <div class="col-span-full text-center py-12 text-gray-500">Belum ada layanan tersedia</div>
            @endforelse
        </div>
    </div>
</section>

<!-- Why Us Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Mengapa Memilih Bogorior?</h2>
            <p class="text-gray-600">Keunggulan yang membuat kami berbeda dari yang lain</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 p-6">
                <i class="fas fa-trophy text-3xl text-green-600 mb-4"></i>
                <h4 class="text-xl font-semibold mb-2">Garansi {{ $viewSettings['garansi'] }}</h4>
                <p class="text-gray-600">Perlindungan garansi panjang untuk kepastian Anda</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 p-6">
                <i class="fas fa-credit-card text-3xl text-green-600 mb-4"></i>
                <h4 class="text-xl font-semibold mb-2">Cicilan 0% {{ $viewSettings['cicilan_bulan'] }}x</h4>
                <p class="text-gray-600">Kemudahan pembayaran hingga {{ $viewSettings['cicilan_bulan'] }} bulan</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 p-6">
                <i class="fas fa-bolt text-3xl text-green-600 mb-4"></i>
                <h4 class="text-xl font-semibold mb-2">Proses Cepat {{ $viewSettings['proses_pengerjaan'] }} Minggu</h4>
                <p class="text-gray-600">Pengerjaan efisien tanpa mengorbankan kualitas</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 p-6">
                <i class="fas fa-palette text-3xl text-green-600 mb-4"></i>
                <h4 class="text-xl font-semibold mb-2">Desain Custom by Expert</h4>
                <p class="text-gray-600">Tim desainer profesional siap mewujudkan impian Anda</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 p-6">
                <i class="fas fa-ruler text-3xl text-green-600 mb-4"></i>
                <h4 class="text-xl font-semibold mb-2">{{ $viewSettings['free_survey'] ? 'Free Survey' : 'Survey Berbayar' }}</h4>
                <p class="text-gray-600">{{ $viewSettings['free_survey'] ? 'Survey gratis ke lokasi untuk pengukuran' : 'Konsultasi dengan biaya terjangkau' }}</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 p-6">
                <i class="fas fa-headset text-3xl text-green-600 mb-4"></i>
                <h4 class="text-xl font-semibold mb-2">After Sales Service</h4>
                <p class="text-gray-600">Layanan purna jual responsif untuk maintenance</p>
            </div>
        </div>
    </div>
</section>

<!-- Process Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Proses Pengerjaan</h2>
            <p class="text-gray-600">6 langkah mudah mewujudkan kitchen set impian Anda</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="flex gap-4 items-start">
                <div class="w-10 h-10 bg-green-600 text-white rounded-full flex items-center justify-center font-bold shrink-0">1</div>
                <div><h4 class="font-semibold">KONSULTASI</h4><p class="text-gray-500 text-sm">Free survey ke lokasi atau meeting online</p></div>
            </div>
            <div class="flex gap-4 items-start">
                <div class="w-10 h-10 bg-green-600 text-white rounded-full flex items-center justify-center font-bold shrink-0">2</div>
                <div><h4 class="font-semibold">DESAIN</h4><p class="text-gray-500 text-sm">Pembuatan 3D design preview</p></div>
            </div>
            <div class="flex gap-4 items-start">
                <div class="w-10 h-10 bg-green-600 text-white rounded-full flex items-center justify-center font-bold shrink-0">3</div>
                <div><h4 class="font-semibold">APPROVAL</h4><p class="text-gray-500 text-sm">Revisi desain hingga Anda puas</p></div>
            </div>
            <div class="flex gap-4 items-start">
                <div class="w-10 h-10 bg-green-600 text-white rounded-full flex items-center justify-center font-bold shrink-0">4</div>
                <div><h4 class="font-semibold">PRODUKSI</h4><p class="text-gray-500 text-sm">Pengerjaan di workshop dengan QC ketat</p></div>
            </div>
            <div class="flex gap-4 items-start">
                <div class="w-10 h-10 bg-green-600 text-white rounded-full flex items-center justify-center font-bold shrink-0">5</div>
                <div><h4 class="font-semibold">PEMASANGAN</h4><p class="text-gray-500 text-sm">Instalasi oleh tim profesional</p></div>
            </div>
            <div class="flex gap-4 items-start">
                <div class="w-10 h-10 bg-green-600 text-white rounded-full flex items-center justify-center font-bold shrink-0">6</div>
                <div><h4 class="font-semibold">GARANSI</h4><p class="text-gray-500 text-sm">Service maintenance dan garansi {{ $viewSettings['garansi'] }}</p></div>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Preview -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Portfolio Kami</h2>
            <p class="text-gray-600">Lihat hasil karya kitchen set yang telah kami kerjakan</p>
        </div>
        
        @if($featuredProjects->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featuredProjects as $project)
            <div class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer" 
                 onclick="window.location.href='{{ route('portfolio.detail', $project->id_project) }}'">
                <div class="relative overflow-hidden h-64">
                    <img src="{{ $project->main_image_url }}" 
                         alt="{{ $project->nama_project }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                         onerror="this.src='https://placehold.co/600x400/e5e7eb/6b7280?text=No+Image'">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-4 translate-y-full group-hover:translate-y-0 transition duration-300">
                        <span class="text-green-400 text-sm font-medium">{{ $project->jenis_project_label }}</span>
                        <h3 class="text-white font-bold text-lg">{{ $project->nama_project }}</h3>
                        <div class="flex items-center gap-2 text-gray-300 text-sm mt-1">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $project->lokasi_project }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-gray-300 text-sm">
                            <i class="fas fa-money-bill-wave"></i>
                            <span>{{ $project->budget_formatted }}</span>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">{{ $project->jenis_project_label }}</span>
                        <span class="text-gray-500 text-sm">{{ $project->kategori_desain_label }}</span>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-1">{{ $project->nama_project }}</h3>
                    <p class="text-gray-500 text-sm mb-2">{{ $project->lokasi_project }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-green-600 font-bold">{{ $project->budget_formatted }}</span>
                        <a href="{{ route('portfolio.detail', $project->id_project) }}" class="text-green-600 hover:text-green-700 text-sm font-medium">
                            Detail <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-8">
            <a href="{{ route('portfolio.index') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-8 py-3 rounded-full transition shadow-md hover:shadow-lg">
                Lihat Semua Portfolio <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
        @else
        <div class="text-center py-12 bg-white rounded-xl">
            <i class="fas fa-images text-5xl text-gray-300 mb-3"></i>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Portfolio</h3>
            <p class="text-gray-500">Portfolio akan segera ditambahkan.</p>
        </div>
        @endif
    </div>
</section>

<!-- Testimonials -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Apa Kata Client Kami</h2>
            <p class="text-gray-600">Testimoni dari pelanggan yang sudah mempercayakan kitchen set mereka</p>
        </div>
        
        @if($testimonials->count() > 0)
        <div class="flex justify-center gap-4 mb-8">
            <button class="filter-btn px-5 py-2 rounded-full bg-green-600 text-white font-medium transition-all" data-filter="all">Semua</button>
            <button class="filter-btn px-5 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 font-medium transition-all" data-filter="teks">Testimoni Teks</button>
            <button class="filter-btn px-5 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 font-medium transition-all" data-filter="video">Testimoni Video</button>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="testimonialsGrid">
            @foreach($testimonials as $testimoni)
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-6 {{ $testimoni->tipe_testimoni === 'video' ? 'video-card' : '' }}"
                 @if($testimoni->tipe_testimoni === 'video')
                 data-video-url="{{ $testimoni->url_video }}"
                 data-video-platform="{{ $testimoni->video_platform }}"
                 data-video-id="{{ $testimoni->video_id }}"
                 @endif>
                
                @if($testimoni->tipe_testimoni === 'video' && $testimoni->video_thumbnail_url)
                <div class="video-thumbnail relative mb-4 rounded-lg overflow-hidden cursor-pointer">
                    <img src="{{ $testimoni->video_thumbnail_url }}" class="w-full h-48 object-cover" onerror="this.src='https://placehold.co/600x400/e5e7eb/6b7280?text=Video'">
                    <div class="play-button absolute inset-0 flex items-center justify-center bg-black/40 hover:bg-black/50 transition">
                        <i class="fas fa-play text-white text-3xl"></i>
                    </div>
                </div>
                @endif
                
                <div class="flex items-center gap-1 text-yellow-400 mb-3">
                    {!! $testimoni->rating_stars !!}
                </div>
                <p class="text-gray-600 mb-4 line-clamp-3">"{{ Str::limit($testimoni->testimoni, 120) }}"</p>
                <div class="flex items-center gap-3">
                    <img src="{{ $testimoni->avatar_url }}" 
                         alt="{{ $testimoni->nama_client }}" 
                         class="w-10 h-10 rounded-full object-cover"
                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($testimoni->nama_client) }}&background=059669&color=fff'">
                    <div>
                        <h5 class="font-semibold text-gray-800">{{ $testimoni->nama_client }}</h5>
                        <p class="text-gray-400 text-sm"><i class="fas fa-map-marker-alt mr-1"></i> {{ $testimoni->lokasi ?? 'Indonesia' }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12 bg-gray-50 rounded-xl">
            <i class="fas fa-comments text-5xl text-gray-300 mb-3"></i>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Testimoni</h3>
            <p class="text-gray-500">Testimoni akan segera ditambahkan.</p>
        </div>
        @endif
    </div>
</section>

<!-- FAQ Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Pertanyaan Umum</h2>
            <p class="text-gray-600">Informasi yang sering ditanyakan seputar kitchen set</p>
        </div>
        
        @if($faqs->count() > 0)
        <div class="max-w-3xl mx-auto space-y-4">
            @foreach($faqs as $index => $faq)
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="faq-question flex justify-between items-center p-5 cursor-pointer hover:bg-gray-50 transition" data-index="{{ $index }}">
                    <h4 class="font-semibold text-gray-800">{{ $faq->pertanyaan }}</h4>
                    <i class="fas fa-chevron-down text-gray-400 transition-transform duration-300"></i>
                </div>
                <div class="faq-answer hidden px-5 pb-5 text-gray-600 border-t">
                    {{ $faq->jawaban }}
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12 bg-white rounded-xl max-w-3xl mx-auto">
            <i class="fas fa-question-circle text-5xl text-gray-300 mb-3"></i>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada FAQ</h3>
            <p class="text-gray-500">FAQ akan segera ditambahkan.</p>
        </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-green-600 to-green-700 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ $viewSettings['cta_title'] }}</h2>
        <p class="text-lg mb-8 max-w-2xl mx-auto opacity-90">{{ $viewSettings['cta_description'] }}</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <button id="btnHitungEstimasi" class="bg-white text-green-600 hover:bg-gray-100 font-semibold px-8 py-3 rounded-full transition flex items-center justify-center gap-2 shadow-lg">
                <i class="fas fa-calculator"></i> Hitung Estimasi
            </button>
            <a href="https://wa.me/{{ $viewSettings['whatsapp_number'] }}" class="bg-green-800 hover:bg-green-900 text-white font-semibold px-8 py-3 rounded-full transition flex items-center justify-center gap-2" target="_blank">
                <i class="fab fa-whatsapp"></i> Chat WhatsApp
            </a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ============================================================
    // CINEMATIC SLIDER
    // ============================================================
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.nav-dot');
    const progressBar = document.getElementById('progressBarTop');
    const dividerHandle = document.getElementById('dividerHandle');
    let currentSlide = 0;
    let autoInterval;
    
    const showSlide = (index) => {
        slides.forEach((slide, i) => {
            slide.classList.toggle('hidden', i !== index);
            slide.classList.toggle('block', i === index);
        });
        dots.forEach((dot, i) => {
            dot.classList.toggle('bg-white', i === index);
            dot.classList.toggle('bg-white/50', i !== index);
        });
        currentSlide = index;
        if (progressBar) {
            progressBar.style.width = `${((index + 1) / slides.length) * 100}%`;
        }
    };
    
    const nextSlide = () => showSlide((currentSlide + 1) % slides.length);
    
    dots.forEach((dot, index) => dot.addEventListener('click', () => showSlide(index)));
    
    const startAutoSlide = () => {
        if (autoInterval) clearInterval(autoInterval);
        autoInterval = setInterval(nextSlide, 5000);
    };
    
    startAutoSlide();
    
    const sliderContainer = document.getElementById('sliderContainer');
    if (sliderContainer) {
        sliderContainer.addEventListener('mouseenter', () => clearInterval(autoInterval));
        sliderContainer.addEventListener('mouseleave', startAutoSlide);
    }
    
    // ============================================================
    // DIVIDER DRAG
    // ============================================================
    if (dividerHandle) {
        let isDragging = false;
        
        dividerHandle.addEventListener('mousedown', (e) => {
            e.preventDefault();
            isDragging = true;
            dividerHandle.style.cursor = 'grabbing';
        });
        
        document.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            
            const container = sliderContainer;
            const rect = container.getBoundingClientRect();
            let x = e.clientX - rect.left;
            x = Math.max(0, Math.min(x, rect.width));
            const percent = (x / rect.width) * 100;
            
            const activeSlide = document.querySelector('.slide:not(.hidden)');
            if (activeSlide) {
                const before = activeSlide.querySelector('.slide-before');
                const after = activeSlide.querySelector('.slide-after');
                if (before) before.style.width = `${percent}%`;
                if (after) after.style.left = `${percent}%`;
            }
        });
        
        document.addEventListener('mouseup', () => {
            isDragging = false;
            dividerHandle.style.cursor = 'grab';
        });
    }
    
    // ============================================================
    // FAQ ACCORDION
    // ============================================================
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
                i.classList.remove('fa-chevron-up', 'rotate-180');
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
    
    // ============================================================
    // TESTIMONIAL FILTER
    // ============================================================
    const filterBtns = document.querySelectorAll('.filter-btn');
    const testimonialCards = document.querySelectorAll('.testimonial-card');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => {
                b.classList.remove('bg-green-600', 'text-white');
                b.classList.add('bg-gray-200', 'text-gray-700');
            });
            btn.classList.remove('bg-gray-200', 'text-gray-700');
            btn.classList.add('bg-green-600', 'text-white');
            
            const filter = btn.dataset.filter;
            testimonialCards.forEach(card => {
                if (filter === 'all') {
                    card.style.display = '';
                } else if (filter === 'teks' && !card.classList.contains('video-card')) {
                    card.style.display = '';
                } else if (filter === 'video' && card.classList.contains('video-card')) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
    
    // ============================================================
    // VIDEO MODAL
    // ============================================================
    const videoCards = document.querySelectorAll('.video-card .video-thumbnail, .video-card .play-button');
    videoCards.forEach(el => {
        el.addEventListener('click', (e) => {
            e.stopPropagation();
            const card = el.closest('.video-card');
            if (card && window.openVideoModal) {
                window.openVideoModal(
                    card.dataset.videoUrl,
                    card.dataset.videoPlatform,
                    card.dataset.videoId
                );
            }
        });
    });
});
</script>
@endpush