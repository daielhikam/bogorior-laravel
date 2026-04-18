@extends('layouts.app')

@section('title', 'Blog & Artikel - Bogorior KitchenSet')
@section('description', 'Artikel dan tips seputar kitchen set, desain dapur, perawatan, dan inspirasi terbaru dari Bogorior KitchenSet.')

@section('content')
<div class="blog-page">
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <h1>Blog & Artikel</h1>
            <p>Tips, inspirasi, dan informasi terbaru seputar kitchen set dan desain dapur</p>
        </div>

        <div class="blog-layout">
            <!-- Main Content -->
            <div class="blog-main">
                @forelse($articles as $article)
                <article class="blog-card">
                    @if($article->gambar_utama)
                    <div class="blog-image">
                        <img src="{{ $article->image_url }}" alt="{{ $article->judul_artikel }}" loading="lazy">
                    </div>
                    @endif
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="category">{{ $article->kategori_label }}</span>
                            <span class="date"><i class="far fa-calendar-alt"></i> {{ $article->formatted_date }}</span>
                            <span class="read-time"><i class="far fa-clock"></i> {{ $article->reading_time }} menit baca</span>
                        </div>
                        <h2><a href="{{ route('blog.show', $article->slug) }}">{{ $article->judul_artikel }}</a></h2>
                        <p>{{ $article->excerpt }}</p>
                        <a href="{{ route('blog.show', $article->slug) }}" class="read-more">Baca Selengkapnya <i class="fas fa-arrow-right"></i></a>
                    </div>
                </article>
                @empty
                <div class="no-data">
                    <i class="fas fa-newspaper"></i>
                    <p>Belum ada artikel tersedia</p>
                </div>
                @endforelse

                <!-- Pagination -->
                <div class="pagination">
                    {{ $articles->links() }}
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="blog-sidebar">
                <!-- Search -->
                <div class="sidebar-widget">
                    <h3>Cari Artikel</h3>
                    <form action="{{ route('blog.index') }}" method="GET">
                        <div class="search-box">
                            <input type="text" name="search" placeholder="Cari artikel..." value="{{ request('search') }}">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>

                <!-- Categories -->
                <div class="sidebar-widget">
                    <h3>Kategori</h3>
                    <ul class="category-list">
                        <li><a href="{{ route('blog.index') }}">Semua <span>({{ $articles->total() ?? 0 }})</span></a></li>
                        @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('blog.index', ['category' => $cat->kategori]) }}">
                                {{ $cat->kategori_label }} <span>({{ $cat->total }})</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Popular Articles -->
                @if(isset($popularArticles) && $popularArticles->count() > 0)
                <div class="sidebar-widget">
                    <h3>Artikel Populer</h3>
                    <ul class="popular-list">
                        @foreach($popularArticles as $popular)
                        <li>
                            <a href="{{ route('blog.show', $popular->slug) }}">
                                <div class="popular-title">{{ $popular->judul_artikel }}</div>
                                <div class="popular-meta">{{ $popular->formatted_date }}</div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </aside>
        </div>
    </div>
</div>

<style>
.blog-page {
    padding: 120px 0 60px;
    background: #f9fafb;
    min-height: 100vh;
}
.page-header {
    text-align: center;
    margin-bottom: 50px;
}
.page-header h1 {
    font-size: 36px;
    color: #1f2937;
    margin-bottom: 16px;
}
.page-header p {
    font-size: 18px;
    color: #6b7280;
}
.blog-layout {
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 40px;
}
.blog-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    margin-bottom: 30px;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
    transition: transform 0.3s, box-shadow 0.3s;
}
.blog-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px -5px rgba(0,0,0,0.15);
}
.blog-image {
    height: 240px;
    overflow: hidden;
}
.blog-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s;
}
.blog-card:hover .blog-image img {
    transform: scale(1.05);
}
.blog-content {
    padding: 24px;
}
.blog-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    margin-bottom: 12px;
    font-size: 13px;
}
.blog-meta .category {
    background: #f0fdf4;
    color: #059669;
    padding: 4px 12px;
    border-radius: 20px;
}
.blog-meta .date,
.blog-meta .read-time {
    color: #9ca3af;
}
.blog-content h2 {
    font-size: 22px;
    margin-bottom: 12px;
}
.blog-content h2 a {
    color: #1f2937;
    text-decoration: none;
    transition: color 0.3s;
}
.blog-content h2 a:hover {
    color: #059669;
}
.blog-content p {
    color: #6b7280;
    line-height: 1.6;
    margin-bottom: 16px;
}
.read-more {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #059669;
    text-decoration: none;
    font-weight: 500;
    transition: gap 0.3s;
}
.read-more:hover {
    gap: 12px;
}
.sidebar-widget {
    background: white;
    border-radius: 16px;
    padding: 24px;
    margin-bottom: 30px;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
}
.sidebar-widget h3 {
    font-size: 18px;
    color: #1f2937;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 2px solid #059669;
}
.search-box {
    display: flex;
}
.search-box input {
    flex: 1;
    padding: 12px 16px;
    border: 1px solid #e5e7eb;
    border-radius: 8px 0 0 8px;
    font-size: 14px;
}
.search-box button {
    padding: 12px 16px;
    background: #059669;
    border: none;
    border-radius: 0 8px 8px 0;
    color: white;
    cursor: pointer;
    transition: background 0.3s;
}
.search-box button:hover {
    background: #047857;
}
.category-list,
.popular-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.category-list li,
.popular-list li {
    margin-bottom: 12px;
}
.category-list a,
.popular-list a {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #4b5563;
    text-decoration: none;
    transition: color 0.3s;
}
.category-list a:hover,
.popular-list a:hover {
    color: #059669;
}
.popular-title {
    font-weight: 500;
    margin-bottom: 4px;
}
.popular-meta {
    font-size: 12px;
    color: #9ca3af;
}
.pagination {
    display: flex;
    justify-content: center;
    margin-top: 30px;
}
.no-data {
    text-align: center;
    padding: 60px;
    color: #9ca3af;
}
.no-data i {
    font-size: 48px;
    margin-bottom: 16px;
}
@media (max-width: 768px) {
    .blog-page {
        padding: 100px 0 40px;
    }
    .blog-layout {
        grid-template-columns: 1fr;
    }
    .page-header h1 {
        font-size: 28px;
    }
    .blog-content h2 {
        font-size: 18px;
    }
}
</style>
@endsection