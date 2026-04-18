@extends('layouts.app')

@section('title', 'Layanan Kitchen Set - Bogorior KitchenSet')
@section('description', 'Layanan kitchen set custom, premium, renovasi dapur, dan interior design. Konsultasi gratis dengan desainer profesional.')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-green-600 to-green-700 text-white py-20">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Layanan Kami</h1>
            <p class="text-lg opacity-90">Solusi lengkap untuk mewujudkan dapur impian Anda dengan kualitas terbaik dan harga terjangkau</p>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0">
        <svg class="w-full h-12 text-white" viewBox="0 0 1440 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 48L1440 48L1440 0C1440 0 1320 20 1080 20C840 20 720 0 480 0C240 0 120 20 0 20L0 48Z" fill="currentColor"/>
        </svg>
    </div>
</section>

<!-- Stats Section -->
<section class="py-12 bg-white -mt-6 relative z-10">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="text-center p-4">
                <i class="fas fa-tools text-3xl text-green-600 mb-2"></i>
                <div class="text-3xl font-bold text-gray-800">{{ $totalProjects }}+</div>
                <div class="text-gray-500">Project Selesai</div>
            </div>
            <div class="text-center p-4">
                <i class="fas fa-users text-3xl text-green-600 mb-2"></i>
                <div class="text-3xl font-bold text-gray-800">{{ $totalClients }}+</div>
                <div class="text-gray-500">Klien Puas</div>
            </div>
            <div class="text-center p-4">
                <i class="fas fa-smile text-3xl text-green-600 mb-2"></i>
                <div class="text-3xl font-bold text-gray-800">{{ $satisfactionRate }}%</div>
                <div class="text-gray-500">Kepuasan Klien</div>
            </div>
            <div class="text-center p-4">
                <i class="fas fa-shield-alt text-3xl text-green-600 mb-2"></i>
                <div class="text-3xl font-bold text-gray-800">5</div>
                <div class="text-gray-500">Tahun Garansi</div>
            </div>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="py-6 bg-gray-50 border-b">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap justify-center gap-3">
            @foreach($jenisOptions as $option)
            <a href="{{ route('services.index', ['jenis' => $option['value'] == 'all' ? null : $option['value']]) }}" 
               class="px-5 py-2 rounded-full transition {{ ($jenis ?? 'all') == $option['value'] ? 'bg-green-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                {{ $option['label'] }}
                <span class="text-sm {{ ($jenis ?? 'all') == $option['value'] ? 'text-green-200' : 'text-gray-400' }}">({{ $option['count'] }})</span>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Services Grid -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        @if($services->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($services as $service)
            <div class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 relative">
                @if($service->popular)
                <div class="absolute top-4 right-4 z-10">
                    <span class="bg-gradient-to-r from-red-500 to-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1">
                        <i class="fas fa-fire text-xs"></i> POPULER
                    </span>
                </div>
                @endif
                <div class="p-6 text-center">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-green-600 transition">
                        <i class="{{ $service->icon }} text-3xl text-green-600 group-hover:text-white transition"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $service->nama_paket }}</h3>
                    <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $service->deskripsi_singkat ?? 'Deskripsi layanan akan segera hadir' }}</p>
                    <div class="text-2xl font-bold text-green-600 mb-4">{{ $service->harga_mulai_formatted }}</div>
                    <div class="text-sm text-gray-400 mb-4">Mulai dari</div>
                    <a href="{{ route('services.detail', $service->slug_paket) }}" class="inline-flex items-center gap-2 text-green-600 hover:text-green-700 font-medium">
                        Selengkapnya <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16">
            <i class="fas fa-concierge-bell text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Layanan</h3>
            <p class="text-gray-500">Belum ada layanan yang tersedia saat ini.</p>
        </div>
        @endif
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Mengapa Memilih Layanan Kami?</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Kami berkomitmen memberikan layanan terbaik untuk setiap project</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user-tie text-2xl text-green-600"></i>
                </div>
                <h3 class="font-semibold text-gray-800 mb-2">Desainer Profesional</h3>
                <p class="text-gray-500 text-sm">Tim desainer berpengalaman siap membantu Anda</p>
            </div>
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clock text-2xl text-green-600"></i>
                </div>
                <h3 class="font-semibold text-gray-800 mb-2">Tepat Waktu</h3>
                <p class="text-gray-500 text-sm">Pengerjaan sesuai jadwal yang disepakati</p>
            </div>
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-hand-holding-usd text-2xl text-green-600"></i>
                </div>
                <h3 class="font-semibold text-gray-800 mb-2">Harga Transparan</h3>
                <p class="text-gray-500 text-sm">Tidak ada biaya tersembunyi</p>
            </div>
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-headset text-2xl text-green-600"></i>
                </div>
                <h3 class="font-semibold text-gray-800 mb-2">Layanan Purna Jual</h3>
                <p class="text-gray-500 text-sm">Support dan garansi 5 tahun</p>
            </div>
        </div>
    </div>
</section>

<!-- Process Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Proses Pengerjaan</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">6 langkah mudah mewujudkan kitchen set impian Anda</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="flex gap-4 items-start">
                <div class="w-10 h-10 bg-green-600 text-white rounded-full flex items-center justify-center font-bold shrink-0">1</div>
                <div>
                    <h4 class="font-semibold text-gray-800">KONSULTASI</h4>
                    <p class="text-gray-500 text-sm">Free survey ke lokasi atau meeting online</p>
                </div>
            </div>
            <div class="flex gap-4 items-start">
                <div class="w-10 h-10 bg-green-600 text-white rounded-full flex items-center justify-center font-bold shrink-0">2</div>
                <div>
                    <h4 class="font-semibold text-gray-800">DESAIN</h4>
                    <p class="text-gray-500 text-sm">Pembuatan 3D design preview</p>
                </div>
            </div>
            <div class="flex gap-4 items-start">
                <div class="w-10 h-10 bg-green-600 text-white rounded-full flex items-center justify-center font-bold shrink-0">3</div>
                <div>
                    <h4 class="font-semibold text-gray-800">APPROVAL</h4>
                    <p class="text-gray-500 text-sm">Revisi desain hingga Anda puas</p>
                </div>
            </div>
            <div class="flex gap-4 items-start">
                <div class="w-10 h-10 bg-green-600 text-white rounded-full flex items-center justify-center font-bold shrink-0">4</div>
                <div>
                    <h4 class="font-semibold text-gray-800">PRODUKSI</h4>
                    <p class="text-gray-500 text-sm">Pengerjaan di workshop dengan QC ketat</p>
                </div>
            </div>
            <div class="flex gap-4 items-start">
                <div class="w-10 h-10 bg-green-600 text-white rounded-full flex items-center justify-center font-bold shrink-0">5</div>
                <div>
                    <h4 class="font-semibold text-gray-800">PEMASANGAN</h4>
                    <p class="text-gray-500 text-sm">Instalasi oleh tim profesional</p>
                </div>
            </div>
            <div class="flex gap-4 items-start">
                <div class="w-10 h-10 bg-green-600 text-white rounded-full flex items-center justify-center font-bold shrink-0">6</div>
                <div>
                    <h4 class="font-semibold text-gray-800">GARANSI</h4>
                    <p class="text-gray-500 text-sm">Service maintenance dan garansi 5 tahun</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
@if($testimonials->count() > 0)
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Apa Kata Client Kami</h2>
            <p class="text-gray-600">Testimoni dari pelanggan yang sudah menggunakan layanan kami</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($testimonials as $testimoni)
            <div class="bg-gray-50 p-6 rounded-xl">
                <div class="flex items-center gap-1 text-yellow-400 mb-4">
                    {!! $testimoni->rating_stars !!}
                </div>
                <p class="text-gray-600 mb-4">"{{ Str::limit($testimoni->testimoni, 100) }}"</p>
                <div class="flex items-center gap-3">
                    <img src="{{ $testimoni->avatar_url }}" class="w-10 h-10 rounded-full object-cover">
                    <div>
                        <h5 class="font-semibold text-gray-800">{{ $testimoni->nama_client }}</h5>
                        <p class="text-gray-400 text-sm">{{ $testimoni->lokasi ?? 'Indonesia' }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-green-600 to-green-700 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Siap Mewujudkan Dapur Impian?</h2>
        <p class="text-lg mb-8 max-w-2xl mx-auto opacity-90">Konsultasikan kebutuhan Anda dengan tim desainer profesional kami secara gratis</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="https://wa.me/628977288600" class="bg-white text-green-600 hover:bg-gray-100 font-semibold px-8 py-3 rounded-full transition flex items-center justify-center gap-2 shadow-lg" target="_blank">
                <i class="fab fa-whatsapp"></i> Konsultasi Gratis
            </a>
            <a href="{{ route('portfolio.index') }}" class="bg-green-800 hover:bg-green-900 text-white font-semibold px-8 py-3 rounded-full transition flex items-center justify-center gap-2">
                <i class="fas fa-images"></i> Lihat Portfolio
            </a>
        </div>
    </div>
</section>
@endsection