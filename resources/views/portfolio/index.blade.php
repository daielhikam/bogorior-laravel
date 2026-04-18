@extends('layouts.app')

@section('title', 'Portfolio Kitchen Set - Bogorior KitchenSet')
@section('description', 'Lihat berbagai hasil karya kitchen set terbaik dari Bogorior KitchenSet. Inspirasi desain dapur impian Anda.')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-green-600 to-green-700 text-white py-16">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Portfolio Kami</h1>
            <p class="text-lg max-w-2xl mx-auto opacity-90">Lihat berbagai hasil karya kitchen set terbaik yang telah kami kerjakan untuk klien setia kami</p>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="py-8 bg-white border-b">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row justify-between items-center gap-4">
            <!-- Filter Buttons -->
            <div class="flex flex-wrap gap-2 justify-center">
                <div class="relative">
                    <select id="jenisFilter" class="appearance-none bg-gray-100 border border-gray-200 rounded-lg px-4 py-2 pr-10 text-gray-700 focus:outline-none focus:border-green-500 cursor-pointer">
                        @foreach($jenisOptions as $option)
                        <option value="{{ $option['value'] }}" {{ ($jenis ?? 'all') == $option['value'] ? 'selected' : '' }}>
                            {{ $option['label'] }} ({{ $option['count'] }})
                        </option>
                        @endforeach
                    </select>
                    <i class="fas fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                </div>
                
                <div class="relative">
                    <select id="kategoriFilter" class="appearance-none bg-gray-100 border border-gray-200 rounded-lg px-4 py-2 pr-10 text-gray-700 focus:outline-none focus:border-green-500 cursor-pointer">
                        @foreach($kategoriOptions as $option)
                        <option value="{{ $option['value'] }}" {{ ($kategori ?? 'all') == $option['value'] ? 'selected' : '' }}>
                            {{ $option['label'] }} ({{ $option['count'] }})
                        </option>
                        @endforeach
                    </select>
                    <i class="fas fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                </div>
                
                <button id="resetFilter" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg transition">
                    <i class="fas fa-undo-alt mr-1"></i> Reset
                </button>
            </div>
            
            <!-- Search Box -->
            <div class="relative w-full lg:w-64">
                <input type="text" id="searchInput" placeholder="Cari project..." value="{{ $search ?? '' }}" class="w-full bg-gray-100 border border-gray-200 rounded-lg px-4 py-2 pl-10 focus:outline-none focus:border-green-500">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <button id="clearSearch" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 hidden">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Grid -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        @if($projects->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($projects as $project)
            <div class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">
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
                            <i class="fas fa-ruler-combined"></i>
                            <span>{{ $project->luas_area }} m²</span>
                        </div>
                        <a href="{{ route('portfolio.detail', $project->id_project) }}" 
                           class="inline-block mt-3 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                            Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                        </a>
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
        
        <!-- Pagination -->
        <div class="mt-8">
            {{ $projects->appends(request()->query())->links() }}
        </div>
        @else
        <div class="text-center py-16">
            <i class="fas fa-images text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Portfolio</h3>
            <p class="text-gray-500">Belum ada project portfolio yang tersedia saat ini.</p>
        </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-green-600 to-green-700 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Ingin Punya Kitchen Set Seperti Ini?</h2>
        <p class="text-lg mb-8 max-w-2xl mx-auto opacity-90">Konsultasikan kebutuhan Anda dengan tim desainer profesional kami secara gratis</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="https://wa.me/628977288600" class="bg-white text-green-600 hover:bg-gray-100 font-semibold px-8 py-3 rounded-full transition flex items-center justify-center gap-2 shadow-lg" target="_blank">
                <i class="fab fa-whatsapp"></i> Konsultasi Gratis
            </a>
            <a href="{{ route('contact') }}" class="bg-green-800 hover:bg-green-900 text-white font-semibold px-8 py-3 rounded-full transition flex items-center justify-center gap-2">
                <i class="fas fa-envelope"></i> Hubungi Kami
            </a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const jenisFilter = document.getElementById('jenisFilter');
    const kategoriFilter = document.getElementById('kategoriFilter');
    const resetFilter = document.getElementById('resetFilter');
    const searchInput = document.getElementById('searchInput');
    const clearSearch = document.getElementById('clearSearch');
    
    // Function to update URL and reload
    function updateFilters() {
        const params = new URLSearchParams();
        const jenis = jenisFilter.value;
        const kategori = kategoriFilter.value;
        const search = searchInput.value.trim();
        
        if (jenis && jenis !== 'all') params.set('jenis', jenis);
        if (kategori && kategori !== 'all') params.set('kategori', kategori);
        if (search) params.set('search', search);
        
        window.location.href = window.location.pathname + '?' + params.toString();
    }
    
    // Event listeners
    if (jenisFilter) jenisFilter.addEventListener('change', updateFilters);
    if (kategoriFilter) kategoriFilter.addEventListener('change', updateFilters);
    
    if (resetFilter) {
        resetFilter.addEventListener('click', function() {
            window.location.href = window.location.pathname;
        });
    }
    
    if (searchInput) {
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            if (searchTimeout) clearTimeout(searchTimeout);
            if (this.value.length > 0) {
                clearSearch.classList.remove('hidden');
            } else {
                clearSearch.classList.add('hidden');
            }
            searchTimeout = setTimeout(updateFilters, 500);
        });
    }
    
    if (clearSearch) {
        clearSearch.addEventListener('click', function() {
            searchInput.value = '';
            clearSearch.classList.add('hidden');
            updateFilters();
        });
    }
});
</script>
@endpush@extends('layouts.app')

@section('title', 'Portfolio Kitchen Set - Bogorior KitchenSet')
@section('description', 'Lihat berbagai hasil karya kitchen set terbaik dari Bogorior KitchenSet. Inspirasi desain dapur impian Anda.')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-green-600 to-green-700 text-white py-16">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Portfolio Kami</h1>
            <p class="text-lg max-w-2xl mx-auto opacity-90">Lihat berbagai hasil karya kitchen set terbaik yang telah kami kerjakan untuk klien setia kami</p>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="py-8 bg-white border-b">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row justify-between items-center gap-4">
            <!-- Filter Buttons -->
            <div class="flex flex-wrap gap-2 justify-center">
                <div class="relative">
                    <select id="jenisFilter" class="appearance-none bg-gray-100 border border-gray-200 rounded-lg px-4 py-2 pr-10 text-gray-700 focus:outline-none focus:border-green-500 cursor-pointer">
                        @foreach($jenisOptions as $option)
                        <option value="{{ $option['value'] }}" {{ ($jenis ?? 'all') == $option['value'] ? 'selected' : '' }}>
                            {{ $option['label'] }} ({{ $option['count'] }})
                        </option>
                        @endforeach
                    </select>
                    <i class="fas fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                </div>
                
                <div class="relative">
                    <select id="kategoriFilter" class="appearance-none bg-gray-100 border border-gray-200 rounded-lg px-4 py-2 pr-10 text-gray-700 focus:outline-none focus:border-green-500 cursor-pointer">
                        @foreach($kategoriOptions as $option)
                        <option value="{{ $option['value'] }}" {{ ($kategori ?? 'all') == $option['value'] ? 'selected' : '' }}>
                            {{ $option['label'] }} ({{ $option['count'] }})
                        </option>
                        @endforeach
                    </select>
                    <i class="fas fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                </div>
                
                <button id="resetFilter" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg transition">
                    <i class="fas fa-undo-alt mr-1"></i> Reset
                </button>
            </div>
            
            <!-- Search Box -->
            <div class="relative w-full lg:w-64">
                <input type="text" id="searchInput" placeholder="Cari project..." value="{{ $search ?? '' }}" class="w-full bg-gray-100 border border-gray-200 rounded-lg px-4 py-2 pl-10 focus:outline-none focus:border-green-500">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <button id="clearSearch" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 hidden">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Grid -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        @if($projects->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($projects as $project)
            <div class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">
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
                            <i class="fas fa-ruler-combined"></i>
                            <span>{{ $project->luas_area }} m²</span>
                        </div>
                        <a href="{{ route('portfolio.detail', $project->id_project) }}" 
                           class="inline-block mt-3 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                            Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                        </a>
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
        
        <!-- Pagination -->
        <div class="mt-8">
            {{ $projects->appends(request()->query())->links() }}
        </div>
        @else
        <div class="text-center py-16">
            <i class="fas fa-images text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Portfolio</h3>
            <p class="text-gray-500">Belum ada project portfolio yang tersedia saat ini.</p>
        </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-green-600 to-green-700 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Ingin Punya Kitchen Set Seperti Ini?</h2>
        <p class="text-lg mb-8 max-w-2xl mx-auto opacity-90">Konsultasikan kebutuhan Anda dengan tim desainer profesional kami secara gratis</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="https://wa.me/628977288600" class="bg-white text-green-600 hover:bg-gray-100 font-semibold px-8 py-3 rounded-full transition flex items-center justify-center gap-2 shadow-lg" target="_blank">
                <i class="fab fa-whatsapp"></i> Konsultasi Gratis
            </a>
            <a href="{{ route('contact') }}" class="bg-green-800 hover:bg-green-900 text-white font-semibold px-8 py-3 rounded-full transition flex items-center justify-center gap-2">
                <i class="fas fa-envelope"></i> Hubungi Kami
            </a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const jenisFilter = document.getElementById('jenisFilter');
    const kategoriFilter = document.getElementById('kategoriFilter');
    const resetFilter = document.getElementById('resetFilter');
    const searchInput = document.getElementById('searchInput');
    const clearSearch = document.getElementById('clearSearch');
    
    // Function to update URL and reload
    function updateFilters() {
        const params = new URLSearchParams();
        const jenis = jenisFilter.value;
        const kategori = kategoriFilter.value;
        const search = searchInput.value.trim();
        
        if (jenis && jenis !== 'all') params.set('jenis', jenis);
        if (kategori && kategori !== 'all') params.set('kategori', kategori);
        if (search) params.set('search', search);
        
        window.location.href = window.location.pathname + '?' + params.toString();
    }
    
    // Event listeners
    if (jenisFilter) jenisFilter.addEventListener('change', updateFilters);
    if (kategoriFilter) kategoriFilter.addEventListener('change', updateFilters);
    
    if (resetFilter) {
        resetFilter.addEventListener('click', function() {
            window.location.href = window.location.pathname;
        });
    }
    
    if (searchInput) {
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            if (searchTimeout) clearTimeout(searchTimeout);
            if (this.value.length > 0) {
                clearSearch.classList.remove('hidden');
            } else {
                clearSearch.classList.add('hidden');
            }
            searchTimeout = setTimeout(updateFilters, 500);
        });
    }
    
    if (clearSearch) {
        clearSearch.addEventListener('click', function() {
            searchInput.value = '';
            clearSearch.classList.add('hidden');
            updateFilters();
        });
    }
});
</script>
@endpush