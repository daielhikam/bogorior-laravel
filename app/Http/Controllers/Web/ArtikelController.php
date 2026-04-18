<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    /**
     * Display blog listing page.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $category = $request->input('category');
        $search = $request->input('search');
        
        $query = Artikel::where('status_artikel', 'publish')
            ->where('tanggal_publish', '<=', now());
        
        if ($category && $category !== 'all') {
            $query->where('kategori', $category);
        }
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('judul_artikel', 'like', "%{$search}%")
                  ->orWhere('konten', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('tags', 'like', "%{$search}%");
            });
        }
        
        $articles = $query->orderBy('tanggal_publish', 'desc')
            ->paginate(9);
        
        // Get featured articles (for sidebar)
        $featuredArticles = Artikel::where('status_artikel', 'publish')
            ->where('featured', true)
            ->orderBy('tanggal_publish', 'desc')
            ->limit(3)
            ->get();
        
        // Get categories with counts
        $categories = Artikel::where('status_artikel', 'publish')
            ->select('kategori')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('kategori')
            ->orderBy('total', 'desc')
            ->get();
        
        // Get popular articles (most viewed)
        $popularArticles = Artikel::where('status_artikel', 'publish')
            ->orderBy('views', 'desc')
            ->limit(5)
            ->get();
        
        // Get recent articles
        $recentArticles = Artikel::where('status_artikel', 'publish')
            ->orderBy('tanggal_publish', 'desc')
            ->limit(5)
            ->get();
        
        // Get all unique tags
        $allArticles = Artikel::where('status_artikel', 'publish')
            ->whereNotNull('tags')
            ->get();
        
        $tags = [];
        foreach ($allArticles as $article) {
            $articleTags = explode(',', $article->tags);
            foreach ($articleTags as $tag) {
                $tag = trim($tag);
                if (!empty($tag)) {
                    if (!isset($tags[$tag])) {
                        $tags[$tag] = 0;
                    }
                    $tags[$tag]++;
                }
            }
        }
        arsort($tags);
        $tags = array_slice($tags, 0, 10);
        
        return view('blog.index', compact(
            'articles', 
            'featuredArticles', 
            'categories', 
            'popularArticles', 
            'recentArticles',
            'tags',
            'category',
            'search'
        ));
    }
    
    /**
     * Display article detail page.
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $article = Artikel::where('slug', $slug)
            ->where('status_artikel', 'publish')
            ->firstOrFail();
        
        // Increment view count
        $article->increment('views');
        
        // Get related articles (same category)
        $relatedArticles = Artikel::where('status_artikel', 'publish')
            ->where('id_artikel', '!=', $article->id_artikel)
            ->where('kategori', $article->kategori)
            ->orderBy('tanggal_publish', 'desc')
            ->limit(3)
            ->get();
        
        // Get previous article
        $prevArticle = Artikel::where('status_artikel', 'publish')
            ->where('tanggal_publish', '<', $article->tanggal_publish)
            ->orderBy('tanggal_publish', 'desc')
            ->first();
        
        // Get next article
        $nextArticle = Artikel::where('status_artikel', 'publish')
            ->where('tanggal_publish', '>', $article->tanggal_publish)
            ->orderBy('tanggal_publish', 'asc')
            ->first();
        
        // Get popular articles for sidebar
        $popularArticles = Artikel::where('status_artikel', 'publish')
            ->where('id_artikel', '!=', $article->id_artikel)
            ->orderBy('views', 'desc')
            ->limit(5)
            ->get();
        
        // Get categories with counts
        $categories = Artikel::where('status_artikel', 'publish')
            ->select('kategori')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('kategori')
            ->orderBy('total', 'desc')
            ->get();
        
        return view('blog.show', compact(
            'article', 
            'relatedArticles', 
            'prevArticle', 
            'nextArticle',
            'popularArticles',
            'categories'
        ));
    }
    
    /**
     * Display articles by category.
     *
     * @param string $category
     * @return \Illuminate\View\View
     */
    public function byCategory($category)
    {
        $articles = Artikel::where('status_artikel', 'publish')
            ->where('kategori', $category)
            ->orderBy('tanggal_publish', 'desc')
            ->paginate(9);
        
        $categoryLabel = $this->getCategoryLabel($category);
        
        // Get categories for sidebar
        $categories = Artikel::where('status_artikel', 'publish')
            ->select('kategori')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('kategori')
            ->orderBy('total', 'desc')
            ->get();
        
        $popularArticles = Artikel::where('status_artikel', 'publish')
            ->orderBy('views', 'desc')
            ->limit(5)
            ->get();
        
        return view('blog.category', compact('articles', 'categoryLabel', 'category', 'categories', 'popularArticles'));
    }
    
    /**
     * Display articles by tag.
     *
     * @param string $tag
     * @return \Illuminate\View\View
     */
    public function byTag($tag)
    {
        $articles = Artikel::where('status_artikel', 'publish')
            ->where('tags', 'like', "%{$tag}%")
            ->orderBy('tanggal_publish', 'desc')
            ->paginate(9);
        
        // Get categories for sidebar
        $categories = Artikel::where('status_artikel', 'publish')
            ->select('kategori')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('kategori')
            ->orderBy('total', 'desc')
            ->get();
        
        $popularArticles = Artikel::where('status_artikel', 'publish')
            ->orderBy('views', 'desc')
            ->limit(5)
            ->get();
        
        return view('blog.tag', compact('articles', 'tag', 'categories', 'popularArticles'));
    }
    
    /**
     * Get category label.
     *
     * @param string $category
     * @return string
     */
    private function getCategoryLabel($category)
    {
        $labels = [
            'tips_panduan' => 'Tips & Panduan',
            'desain_inspirasi' => 'Desain & Inspirasi',
            'perawatan_maintenance' => 'Perawatan & Maintenance',
            'material_finishing' => 'Material & Finishing',
            'tren_terbaru' => 'Tren Terbaru',
            'case_study' => 'Case Study',
        ];
        
        return $labels[$category] ?? ucfirst(str_replace('_', ' ', $category));
    }
}