@extends('layouts.app')

@section('title', $categoryLabel . ' - Artikel Bogorior KitchenSet')
@section('description', 'Kumpulan artikel tentang ' . $categoryLabel . ' dari Bogorior KitchenSet.')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-green-600 to-green-700 text-white py-12">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-2">Kategori: {{ $categoryLabel }}</h1>
        <p class="text-lg opacity-90">Kumpulan artikel seputar {{ $categoryLabel }}</p>
    </div>
</section>

<!-- Articles Grid -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                @if($articles->count() > 0)
                    @foreach($articles as $article)
                    <article class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition mb-6">
                        <div class="md:flex">
                            @if($article->gambar_utama)
                            <div class="md:w-2/5">
                                <img src="{{ $article->image_url }}" alt="{{ $article->judul_artikel }}" 
                                     class="w-full h-48 md:h-full object-cover"
                                     onerror="this.src='https://placehold.co/600x400/e5e7eb/6b7280?text=No+Image'">
                            </div>
                            @endif
                            <div class="p-6 {{ $article->gambar_utama ? 'md:w-3/5' : 'w-full' }}">
                                <div class="flex items-center gap-3 mb-3">
                                    <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">{{ $article->kategori_label }}</span>
                                    <span class="text-gray-400 text-sm">{{ $article->formatted_date }}</span>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800 mb-2 hover:text-green-600 transition">
                                    <a href="{{ route('blog.show', $article->slug) }}">{{ $article->judul_artikel }}</a>
                                </h2>
                                <p class="text-gray-600 mb-4 line-clamp-2">{{ $article->excerpt }}</p>
                                <a href="{{ route('blog.show', $article->slug) }}" class="text-green-600 hover:text-green-700 font-medium">
                                    Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                    
                    <div class="mt-8">
                        {{ $articles->appends(request()->query())->links() }}
                    </div>
                @else
                <div class="text-center py-12 bg-white rounded-xl">
                    <i class="fas fa-folder-open text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Artikel</h3>
                    <p class="text-gray-500">Belum ada artikel dalam kategori ini.</p>
                    <a href="{{ route('blog.index') }}" class="inline-block mt-4 text-green-600 hover:text-green-700">← Kembali ke Blog</a>
                </div>
                @endif
            </div>
            
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                @include('blog.partials.sidebar', compact('categories', 'popularArticles'))
            </div>
        </div>
    </div>
</section>
@endsection