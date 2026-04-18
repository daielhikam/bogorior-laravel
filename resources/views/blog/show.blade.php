@extends('layouts.app')

@section('title', $article->meta_title ?? $article->judul_artikel . ' - Bogorior KitchenSet')
@section('description', $article->meta_description ?? $article->excerpt)

@section('content')
<!-- Breadcrumb -->
<section class="bg-gray-100 py-4">
    <div class="container mx-auto px-4">
        <div class="flex items-center gap-2 text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-green-600 transition">Beranda</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('blog.index') }}" class="hover:text-green-600 transition">Blog</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('blog.index', ['category' => $article->kategori]) }}" class="hover:text-green-600 transition">{{ $article->kategori_label }}</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-gray-900">{{ Str::limit($article->judul_artikel, 50) }}</span>
        </div>
    </div>
</section>

<!-- Article Header -->
<section class="py-8 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <div class="flex items-center justify-center gap-3 mb-4">
                <span class="bg-green-100 text-green-700 text-sm px-3 py-1 rounded-full">{{ $article->kategori_label }}</span>
                <span class="text-gray-400 text-sm"><i class="far fa-calendar-alt mr-1"></i> {{ $article->full_date }}</span>
                <span class="text-gray-400 text-sm"><i class="far fa-clock mr-1"></i> {{ $article->reading_time }} menit membaca</span>
                <span class="text-gray-400 text-sm"><i class="far fa-eye mr-1"></i> {{ number_format($article->views) }}x dibaca</span>
            </div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-800 mb-4">{{ $article->judul_artikel }}</h1>
            <div class="flex items-center justify-center gap-3 text-gray-500">
                <div class="flex items-center gap-2">
                    <i class="fas fa-user-circle text-xl"></i>
                    <span>{{ $article->penulis }}</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Image -->
@if($article->gambar_utama)
<section class="py-4 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <img src="{{ $article->image_url }}" 
                 alt="{{ $article->judul_artikel }}" 
                 class="w-full rounded-xl shadow-lg"
                 onerror="this.src='https://placehold.co/1200x600/e5e7eb/6b7280?text=No+Image'">
        </div>
    </div>
</section>
@endif

<!-- Article Content -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-3">
                <div class="prose prose-lg max-w-none prose-headings:text-gray-800 prose-p:text-gray-600 prose-a:text-green-600 prose-img:rounded-lg">
                    {!! $article->konten !!}
                </div>
                
                <!-- Tags -->
                @if(count($article->tags_array) > 0)
                <div class="mt-8 pt-6 border-t">
                    <div class="flex flex-wrap gap-2">
                        <span class="text-gray-600 font-medium mr-2"><i class="fas fa-tags"></i> Tags:</span>
                        @foreach($article->tags_array as $tag)
                        <a href="{{ route('blog.tag', $tag) }}" class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm hover:bg-green-600 hover:text-white transition">
                            {{ ucfirst($tag) }}
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- Share Buttons -->
                <div class="mt-8 pt-6 border-t">
                    <div class="flex items-center gap-4">
                        <span class="text-gray-600 font-medium">Bagikan:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" 
                           class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->judul_artikel) }}" target="_blank" 
                           class="w-10 h-10 bg-sky-500 text-white rounded-full flex items-center justify-center hover:bg-sky-600 transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($article->judul_artikel . ' - ' . url()->current()) }}" target="_blank" 
                           class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center hover:bg-green-600 transition">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($article->judul_artikel) }}" target="_blank" 
                           class="w-10 h-10 bg-blue-800 text-white rounded-full flex items-center justify-center hover:bg-blue-900 transition">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Navigation (Prev/Next) -->
                <div class="mt-8 pt-6 border-t flex justify-between gap-4">
                    @if($prevArticle)
                    <a href="{{ route('blog.show', $prevArticle->slug) }}" class="flex-1 text-left p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                        <span class="text-gray-400 text-sm"><i class="fas fa-arrow-left mr-1"></i> Artikel Sebelumnya</span>
                        <p class="font-medium text-gray-700 line-clamp-1">{{ $prevArticle->judul_artikel }}</p>
                    </a>
                    @else
                    <div class="flex-1"></div>
                    @endif
                    
                    @if($nextArticle)
                    <a href="{{ route('blog.show', $nextArticle->slug) }}" class="flex-1 text-right p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                        <span class="text-gray-400 text-sm">Artikel Selanjutnya <i class="fas fa-arrow-right ml-1"></i></span>
                        <p class="font-medium text-gray-700 line-clamp-1">{{ $nextArticle->judul_artikel }}</p>
                    </a>
                    @endif
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Popular Articles -->
                @if($popularArticles->count() > 0)
                <div class="bg-gray-50 rounded-xl p-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">
                        <i class="fas fa-fire text-orange-500 mr-2"></i> Paling Populer
                    </h3>
                    <div class="space-y-3">
                        @foreach($popularArticles as $popular)
                        <div>
                            <a href="{{ route('blog.show', $popular->slug) }}" class="text-gray-700 hover:text-green-600 transition font-medium line-clamp-2">
                                {{ $popular->judul_artikel }}
                            </a>
                            <p class="text-gray-400 text-xs mt-1">{{ $popular->formatted_date }} • {{ number_format($popular->views) }}x dibaca</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- Categories -->
                @if($categories->count() > 0)
                <div class="bg-gray-50 rounded-xl p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">
                        <i class="fas fa-folder mr-2"></i> Kategori
                    </h3>
                    <div class="space-y-2">
                        @foreach($categories as $cat)
                        <a href="{{ route('blog.index', ['category' => $cat->kategori]) }}" class="flex justify-between items-center py-2 hover:bg-white px-2 rounded-lg transition">
                            <span class="text-gray-600">{{ $cat->kategori_label ?? $cat->kategori }}</span>
                            <span class="text-gray-400 text-sm">{{ $cat->total }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Related Articles -->
@if($relatedArticles->count() > 0)
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Artikel Terkait</h2>
            <p class="text-gray-600">Baca juga artikel menarik lainnya</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($relatedArticles as $related)
            <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition">
                @if($related->gambar_utama)
                <img src="{{ $related->image_url }}" alt="{{ $related->judul_artikel }}" 
                     class="w-full h-48 object-cover"
                     onerror="this.src='https://placehold.co/600x400/e5e7eb/6b7280?text=No+Image'">
                @endif
                <div class="p-4">
                    <span class="text-green-600 text-sm">{{ $related->kategori_label }}</span>
                    <h3 class="font-bold text-gray-800 mt-1 line-clamp-2">{{ $related->judul_artikel }}</h3>
                    <p class="text-gray-500 text-sm mt-2 line-clamp-2">{{ $related->excerpt }}</p>
                    <a href="{{ route('blog.show', $related->slug) }}" class="inline-block mt-3 text-green-600 hover:text-green-700 text-sm font-medium">
                        Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                    </a>
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
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Butuh Konsultasi Kitchen Set?</h2>
        <p class="text-lg mb-8 max-w-2xl mx-auto opacity-90">Tim desainer profesional kami siap membantu mewujudkan dapur impian Anda</p>
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