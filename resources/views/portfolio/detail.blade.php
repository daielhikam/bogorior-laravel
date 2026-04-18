@extends('layouts.app')

@section('title', $project->nama_project . ' - Portfolio Bogorior KitchenSet')
@section('description', $project->deskripsi_project ?? 'Lihat detail project kitchen set ' . $project->nama_project . ' di ' . $project->lokasi_project)

@section('content')
<!-- Breadcrumb -->
<section class="bg-gray-100 py-4">
    <div class="container mx-auto px-4">
        <div class="flex items-center gap-2 text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-green-600 transition">Beranda</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('portfolio.index') }}" class="hover:text-green-600 transition">Portfolio</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-gray-900">{{ $project->nama_project }}</span>
        </div>
    </div>
</section>

<!-- Project Header -->
<section class="py-8 bg-white">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">{{ $project->nama_project }}</h1>
                <div class="flex flex-wrap gap-2">
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">{{ $project->jenis_project_label }}</span>
                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">{{ $project->kategori_desain_label }}</span>
                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                        <i class="fas fa-map-marker-alt mr-1"></i> {{ $project->lokasi_project }}
                    </span>
                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                        <i class="fas fa-ruler-combined mr-1"></i> {{ $project->luas_area }} m²
                    </span>
                </div>
            </div>
            <div class="text-right">
                <div class="text-2xl font-bold text-green-600">{{ $project->budget_formatted }}</div>
                <div class="text-sm text-gray-500">Estimasi Budget</div>
            </div>
        </div>
    </div>
</section>

<!-- Main Image -->
<section class="py-4 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="rounded-xl overflow-hidden shadow-lg">
            <img src="{{ $mainImage }}" 
                 alt="{{ $project->nama_project }}" 
                 class="w-full h-[400px] md:h-[500px] object-cover"
                 onerror="this.src='https://placehold.co/1200x500/e5e7eb/6b7280?text=No+Image'">
        </div>
    </div>
</section>

<!-- Project Info & Gallery -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Project Details -->
            <div class="lg:col-span-2">
                <!-- Description -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Deskripsi Project</h2>
                    <div class="prose max-w-none text-gray-600 leading-relaxed">
                        {!! nl2br(e($project->deskripsi_project ?? 'Belum ada deskripsi untuk project ini.')) !!}
                    </div>
                </div>
                
                <!-- Gallery Sections -->
                @if($galleries['sesudah']->count() > 0)
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Hasil Jadi (After)</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($galleries['sesudah'] as $gallery)
                        <div class="relative group cursor-pointer overflow-hidden rounded-lg" onclick="openImageModal('{{ $gallery->image_url }}')">
                            <img src="{{ $gallery->image_url }}" 
                                 alt="{{ $gallery->deskripsi_foto ?? 'Hasil jadi' }}" 
                                 class="w-full h-48 object-cover group-hover:scale-105 transition duration-300"
                                 onerror="this.src='https://placehold.co/400x300/e5e7eb/6b7280?text=No+Image'">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                <i class="fas fa-search-plus text-white text-2xl"></i>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                @if($galleries['sebelum']->count() > 0)
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Kondisi Sebelum (Before)</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($galleries['sebelum'] as $gallery)
                        <div class="relative group cursor-pointer overflow-hidden rounded-lg" onclick="openImageModal('{{ $gallery->image_url }}')">
                            <img src="{{ $gallery->image_url }}" 
                                 alt="{{ $gallery->deskripsi_foto ?? 'Kondisi sebelum' }}" 
                                 class="w-full h-48 object-cover group-hover:scale-105 transition duration-300"
                                 onerror="this.src='https://placehold.co/400x300/e5e7eb/6b7280?text=No+Image'">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                <i class="fas fa-search-plus text-white text-2xl"></i>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                @if($galleries['proses']->count() > 0)
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Proses Pengerjaan</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($galleries['proses'] as $gallery)
                        <div class="relative group cursor-pointer overflow-hidden rounded-lg" onclick="openImageModal('{{ $gallery->image_url }}')">
                            <img src="{{ $gallery->image_url }}" 
                                 alt="{{ $gallery->deskripsi_foto ?? 'Proses pengerjaan' }}" 
                                 class="w-full h-48 object-cover group-hover:scale-105 transition duration-300"
                                 onerror="this.src='https://placehold.co/400x300/e5e7eb/6b7280?text=No+Image'">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                <i class="fas fa-search-plus text-white text-2xl"></i>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                @if($galleries['detail']->count() > 0)
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Detail & Material</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($galleries['detail'] as $gallery)
                        <div class="relative group cursor-pointer overflow-hidden rounded-lg" onclick="openImageModal('{{ $gallery->image_url }}')">
                            <img src="{{ $gallery->image_url }}" 
                                 alt="{{ $gallery->deskripsi_foto ?? 'Detail' }}" 
                                 class="w-full h-48 object-cover group-hover:scale-105 transition duration-300"
                                 onerror="this.src='https://placehold.co/400x300/e5e7eb/6b7280?text=No+Image'">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                <i class="fas fa-search-plus text-white text-2xl"></i>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- Testimonial -->
                @if($project->testimoni_client)
                <div class="mb-8 bg-gray-50 p-6 rounded-xl">
                    <div class="flex items-start gap-4">
                        <i class="fas fa-quote-left text-3xl text-green-600"></i>
                        <div>
                            <p class="text-gray-600 italic mb-3">"{{ $project->testimoni_client }}"</p>
                            <div class="flex items-center gap-2">
                                <div class="text-yellow-400">
                                    {!! $project->rating_stars !!}
                                </div>
                                <span class="text-gray-500 text-sm">- Client</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Right Column - Sidebar -->
            <div class="lg:col-span-1">
                <!-- Project Info Card -->
                <div class="bg-gray-50 rounded-xl p-6 mb-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Informasi Project</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Kode Project</span>
                            <span class="font-medium">{{ $project->kode_project }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Jenis Project</span>
                            <span class="font-medium">{{ $project->jenis_project_label }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Gaya Desain</span>
                            <span class="font-medium">{{ $project->kategori_desain_label }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Luas Area</span>
                            <span class="font-medium">{{ $project->luas_area }} m²</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Lokasi</span>
                            <span class="font-medium">{{ $project->lokasi_project }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Estimasi Budget</span>
                            <span class="font-bold text-green-600">{{ $project->budget_formatted }}</span>
                        </div>
                        @if($project->durasi_pengerjaan)
                        <div class="flex justify-between">
                            <span class="text-gray-500">Durasi Pengerjaan</span>
                            <span class="font-medium">{{ $project->durasi_pengerjaan }}</span>
                        </div>
                        @endif
                        @if($project->tanggal_selesai)
                        <div class="flex justify-between">
                            <span class="text-gray-500">Tanggal Selesai</span>
                            <span class="font-medium">{{ \Carbon\Carbon::parse($project->tanggal_selesai)->format('d M Y') }}</span>
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- Status Card -->
                <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-xl p-6 mb-6 text-white text-center">
                    <i class="fas fa-check-circle text-4xl mb-3"></i>
                    <h3 class="text-xl font-bold mb-2">Project Selesai</h3>
                    <p class="opacity-90 mb-4">Project ini telah selesai dikerjakan dengan hasil memuaskan</p>
                    <div class="text-sm opacity-75">Garansi {{ $project->tanggal_garansi ? \Carbon\Carbon::parse($project->tanggal_garansi)->format('d M Y') : '5 Tahun' }}</div>
                </div>
                
                <!-- CTA Card -->
                <div class="bg-gray-50 rounded-xl p-6 text-center">
                    <i class="fas fa-calendar-alt text-3xl text-green-600 mb-3"></i>
                    <h3 class="text-lg font-bold mb-2">Tertarik dengan Project Ini?</h3>
                    <p class="text-gray-500 text-sm mb-4">Konsultasikan kebutuhan kitchen set Anda dengan tim kami</p>
                    <a href="https://wa.me/628977288600" class="block bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg transition" target="_blank">
                        <i class="fab fa-whatsapp mr-2"></i> Konsultasi Gratis
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Projects -->
@if($relatedProjects->count() > 0)
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Project Terkait</h2>
            <p class="text-gray-600">Lihat juga project menarik lainnya</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($relatedProjects as $related)
            <div class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition">
                <div class="relative overflow-hidden h-48">
                    <img src="{{ $related->main_image_url }}" 
                         alt="{{ $related->nama_project }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                         onerror="this.src='https://placehold.co/600x400/e5e7eb/6b7280?text=No+Image'">
                </div>
                <div class="p-4">
                    <span class="text-green-600 text-sm">{{ $related->jenis_project_label }}</span>
                    <h3 class="font-semibold text-gray-800 mt-1">{{ $related->nama_project }}</h3>
                    <p class="text-gray-500 text-sm">{{ $related->lokasi_project }}</p>
                    <a href="{{ route('portfolio.detail', $related->id_project) }}" class="inline-block mt-3 text-green-600 hover:text-green-700 text-sm font-medium">
                        Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/90">
    <div class="relative max-w-4xl w-full mx-4">
        <button id="closeImageModal" class="absolute -top-12 right-0 text-white text-2xl hover:text-gray-300 transition">
            <i class="fas fa-times"></i>
        </button>
        <img id="modalImage" src="" alt="Full size image" class="w-full rounded-lg">
    </div>
</div>

@endsection

@push('scripts')
<script>
// Image Modal
const imageModal = document.getElementById('imageModal');
const modalImage = document.getElementById('modalImage');
const closeImageModal = document.getElementById('closeImageModal');

window.openImageModal = (src) => {
    if (imageModal && modalImage) {
        modalImage.src = src;
        imageModal.classList.remove('hidden');
        imageModal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
};

function closeModal() {
    if (imageModal) {
        imageModal.classList.add('hidden');
        imageModal.classList.remove('flex');
        document.body.style.overflow = '';
    }
}

if (closeImageModal) closeImageModal.addEventListener('click', closeModal);
if (imageModal) imageModal.addEventListener('click', (e) => { if (e.target === imageModal) closeModal(); });
document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeModal(); });
</script>
@endpush