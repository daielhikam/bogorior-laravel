@extends('layouts.app')

@section('title', 'Tentang Kami - Bogorior KitchenSet')
@section('description', 'Bogorior KitchenSet adalah spesialis kitchen set di Bogor dengan pengalaman lebih dari 10 tahun. Telah melayani 500+ klien dengan kualitas terbaik.')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-green-600 to-green-700 text-white py-20">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Tentang Bogorior KitchenSet</h1>
            <p class="text-lg opacity-90">Spesialis kitchen set di Bogor dengan pengalaman lebih dari 10 tahun. Telah melayani 500+ klien dengan kualitas terbaik.</p>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 60" fill="#fff">
            <path d="M0,32L80,37.3C160,43,320,53,480,48C640,43,800,21,960,21.3C1120,21,1280,43,1360,53.3L1440,64L1440,60L1360,60C1280,60,1120,60,960,60C800,60,640,60,480,60C320,60,160,60,80,60L0,60Z"></path>
        </svg>
    </div>
</section>

<!-- Stats Section -->
<section class="py-12 bg-white shadow-sm -mt-8 relative z-10">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="text-center p-4">
                <i class="fas fa-tools text-3xl text-green-600 mb-2"></i>
                <div class="text-3xl font-bold text-gray-800">{{ number_format($stats['total_projects']) }}</div>
                <div class="text-gray-500">Project Selesai</div>
            </div>
            <div class="text-center p-4">
                <i class="fas fa-smile text-3xl text-green-600 mb-2"></i>
                <div class="text-3xl font-bold text-gray-800">{{ $stats['satisfaction_rate'] }}%</div>
                <div class="text-gray-500">Kepuasan Client</div>
            </div>
            <div class="text-center p-4">
                <i class="fas fa-clock text-3xl text-green-600 mb-2"></i>
                <div class="text-3xl font-bold text-gray-800">{{ $stats['experience_years'] }}+</div>
                <div class="text-gray-500">Tahun Pengalaman</div>
            </div>
            <div class="text-center p-4">
                <i class="fas fa-map-marker-alt text-3xl text-green-600 mb-2"></i>
                <div class="text-3xl font-bold text-gray-800">{{ number_format($serviceAreas->count()) }}</div>
                <div class="text-gray-500">Area Layanan</div>
            </div>
        </div>
    </div>
</section>

<!-- Our Story Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <span class="text-green-600 font-semibold text-sm uppercase tracking-wider">Our Story</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2 mb-4">Perjalanan Kami dalam Mewujudkan Dapur Impian</h2>
                <div class="space-y-4 text-gray-600 leading-relaxed">
                    <p>Bogorior KitchenSet didirikan pada tahun 2016 dengan visi untuk menjadi penyedia kitchen set terdepan di Indonesia yang menggabungkan kualitas premium, desain inovatif, dan layanan terbaik.</p>
                    <p>Berawal dari keprihatinan akan minimnya pilihan kitchen set berkualitas dengan harga terjangkau di wilayah Bogor dan sekitarnya, kami memulai perjalanan dengan tim kecil yang berdedikasi. Kini, setelah melayani lebih dari 500+ klien, kami terus berkembang dan berinovasi.</p>
                    <p>Setiap project yang kami kerjakan adalah hasil kolaborasi erat antara tim desainer profesional kami dengan klien, memastikan bahwa setiap detail sesuai dengan kebutuhan dan gaya hidup Anda.</p>
                </div>
                <div class="mt-6 flex gap-6">
                    <div>
                        <div class="text-2xl font-bold text-green-600">500+</div>
                        <div class="text-gray-500 text-sm">Project Selesai</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-green-600">10+</div>
                        <div class="text-gray-500 text-sm">Tim Profesional</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-green-600">8+</div>
                        <div class="text-gray-500 text-sm">Area Layanan</div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="rounded-2xl overflow-hidden shadow-xl">
                    <img src="https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?w=800" 
                         alt="Bogorior KitchenSet Team" 
                         class="w-full h-[400px] object-cover"
                         onerror="this.src='https://placehold.co/800x600/e5e7eb/6b7280?text=Bogorior+KitchenSet'">
                </div>
                <div class="absolute -bottom-6 -left-6 bg-green-600 text-white p-4 rounded-xl shadow-lg">
                    <i class="fas fa-quote-left text-3xl"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vision & Mission Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <span class="text-green-600 font-semibold text-sm uppercase tracking-wider">Visi & Misi</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2">Arah dan Tujuan Kami</h2>
            <p class="text-gray-600 max-w-2xl mx-auto mt-4">Komitmen kami dalam memberikan yang terbaik untuk setiap klien</p>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white rounded-xl p-8 shadow-sm hover:shadow-md transition">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-eye text-2xl text-green-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Visi Kami</h3>
                <p class="text-gray-600 leading-relaxed">Menjadi penyedia kitchen set terdepan di Indonesia yang menggabungkan kualitas premium, desain inovatif, dan layanan terbaik untuk menciptakan dapur impian setiap keluarga.</p>
            </div>
            <div class="bg-white rounded-xl p-8 shadow-sm hover:shadow-md transition">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-bullseye text-2xl text-green-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Misi Kami</h3>
                <ul class="space-y-2 text-gray-600">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check-circle text-green-600 mt-1"></i>
                        <span>Memberikan solusi kitchen set berkualitas tinggi dengan harga terjangkau</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check-circle text-green-600 mt-1"></i>
                        <span>Menghadirkan desain yang sesuai dengan kebutuhan dan gaya hidup pelanggan</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check-circle text-green-600 mt-1"></i>
                        <span>Memberikan layanan purna jual yang responsif dan memuaskan</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check-circle text-green-600 mt-1"></i>
                        <span>Terus berinovasi dalam material dan teknologi pengerjaan</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Company Values Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <span class="text-green-600 font-semibold text-sm uppercase tracking-wider">Nilai Perusahaan</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2">Nilai yang Kami Pegang Teguh</h2>
            <p class="text-gray-600 max-w-2xl mx-auto mt-4">Prinsip-prinsip yang menjadi fondasi dalam setiap langkah kami</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($companyValues as $value)
            <div class="bg-gray-50 rounded-xl p-6 text-center hover:shadow-md transition group">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-green-600 transition">
                    <i class="{{ $value['icon'] }} text-2xl text-green-600 group-hover:text-white transition"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $value['title'] }}</h3>
                <p class="text-gray-600 text-sm">{{ $value['description'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Team Section -->
@if($teamMembers->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <span class="text-green-600 font-semibold text-sm uppercase tracking-wider">Tim Kami</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2">Para Ahli di Balik Setiap Project</h2>
            <p class="text-gray-600 max-w-2xl mx-auto mt-4">Tim profesional yang berdedikasi untuk mewujudkan dapur impian Anda</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($teamMembers as $member)
            <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition group">
                <div class="relative overflow-hidden h-64">
                    <img src="{{ $member->foto_url }}" 
                         alt="{{ $member->nama_lengkap }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($member->nama_lengkap) }}&background=059669&color=fff&size=200'">
                </div>
                <div class="p-5 text-center">
                    <h3 class="text-lg font-bold text-gray-800">{{ $member->nama_lengkap }}</h3>
                    <p class="text-green-600 text-sm mb-3">{{ $member->posisi }}</p>
                    <p class="text-gray-500 text-sm">{{ $member->pengalaman }}</p>
                    @if($member->keahlian)
                    <div class="mt-3 flex flex-wrap gap-1 justify-center">
                        @foreach(explode("\n", $member->keahlian) as $skill)
                            @if(trim($skill))
                            <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full">{{ trim($skill) }}</span>
                            @endif
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Service Areas Section -->
@if($serviceAreas->count() > 0)
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <span class="text-green-600 font-semibold text-sm uppercase tracking-wider">Area Layanan</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2">Wilayah yang Kami Layani</h2>
            <p class="text-gray-600 max-w-2xl mx-auto mt-4">Kami melayani berbagai wilayah di Jabodetabek dan sekitarnya</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($serviceAreas as $area)
            <div class="bg-gray-50 rounded-lg p-4 text-center hover:shadow-md transition">
                <i class="{{ $area->jenis_area_icon }} text-2xl text-green-600 mb-2 block"></i>
                <h4 class="font-semibold text-gray-800">{{ $area->nama_area }}</h4>
                <p class="text-gray-500 text-xs mt-1">{{ $area->jenis_area_label }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Testimonials Section -->
@if($testimonials->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <span class="text-green-600 font-semibold text-sm uppercase tracking-wider">Testimoni</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2">Apa Kata Klien Kami</h2>
            <p class="text-gray-600 max-w-2xl mx-auto mt-4">Kepercayaan yang telah diberikan oleh klien-klien kami</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($testimonials as $testimoni)
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <div class="flex items-center gap-1 text-yellow-400 mb-3">
                    {!! $testimoni->rating_stars !!}
                </div>
                <p class="text-gray-600 mb-4 line-clamp-4">"{{ Str::limit($testimoni->testimoni, 120) }}"</p>
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
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-green-600 to-green-700 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Bergabunglah dengan 500+ Klien Puas Kami</h2>
        <p class="text-lg mb-8 max-w-2xl mx-auto opacity-90">Konsultasikan kebutuhan kitchen set Anda dengan tim desainer profesional kami secara gratis</p>
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