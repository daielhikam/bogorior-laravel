<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    /**
     * Get all articles (for API)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
    {
        try {
            $limit = $request->input('limit', 10);
            $category = $request->input('category');
            $search = $request->input('search');

            $query = Artikel::where('status_artikel', 'publish')
                ->where('tanggal_publish', '<=', now());

            if ($category) {
                $query->where('kategori', $category);
            }

            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('judul_artikel', 'like', "%{$search}%")
                      ->orWhere('konten', 'like', "%{$search}%")
                      ->orWhere('excerpt', 'like', "%{$search}%");
                });
            }

            $articles = $query->orderBy('tanggal_publish', 'desc')
                ->paginate($limit);

            return response()->json([
                'success' => true,
                'data' => $articles->items(),
                'total' => $articles->total(),
                'current_page' => $articles->currentPage(),
                'last_page' => $articles->lastPage(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve articles: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get featured articles (for API)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFeatured(Request $request)
    {
        try {
            $limit = $request->input('limit', 3);

            $articles = Artikel::where('status_artikel', 'publish')
                ->where('featured', true)
                ->orderBy('tanggal_publish', 'desc')
                ->limit($limit)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $articles,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve featured articles: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get popular articles (for API)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPopular(Request $request)
    {
        try {
            $limit = $request->input('limit', 5);

            $articles = Artikel::where('status_artikel', 'publish')
                ->orderBy('views', 'desc')
                ->limit($limit)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $articles,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve popular articles: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get article by ID (for API)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getById(Request $request)
    {
        try {
            $id = $request->input('id');

            if (!$id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Article ID is required',
                ], 400);
            }

            $article = Artikel::where('status_artikel', 'publish')
                ->find($id);

            if (!$article) {
                return response()->json([
                    'success' => false,
                    'message' => 'Article not found',
                ], 404);
            }

            // Increment view count
            $article->increment('views');

            return response()->json([
                'success' => true,
                'data' => $article,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve article: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get article by slug (for API)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBySlug(Request $request)
    {
        try {
            $slug = $request->input('slug');

            if (!$slug) {
                return response()->json([
                    'success' => false,
                    'message' => 'Article slug is required',
                ], 400);
            }

            $article = Artikel::where('slug', $slug)
                ->where('status_artikel', 'publish')
                ->first();

            if (!$article) {
                return response()->json([
                    'success' => false,
                    'message' => 'Article not found',
                ], 404);
            }

            // Increment view count
            $article->increment('views');

            return response()->json([
                'success' => true,
                'data' => $article,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve article: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get related articles (for API)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRelated(Request $request)
    {
        try {
            $id = $request->input('id');
            $limit = $request->input('limit', 3);

            if (!$id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Article ID is required',
                ], 400);
            }

            $article = Artikel::find($id);

            if (!$article) {
                return response()->json([
                    'success' => false,
                    'message' => 'Article not found',
                ], 404);
            }

            $relatedArticles = Artikel::where('status_artikel', 'publish')
                ->where('id_artikel', '!=', $id)
                ->where('kategori', $article->kategori)
                ->orderBy('tanggal_publish', 'desc')
                ->limit($limit)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $relatedArticles,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve related articles: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get previous article (for API)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPrev(Request $request)
    {
        try {
            $id = $request->input('id');

            if (!$id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Article ID is required',
                ], 400);
            }

            $currentArticle = Artikel::find($id);

            if (!$currentArticle) {
                return response()->json([
                    'success' => false,
                    'message' => 'Article not found',
                ], 404);
            }

            $prevArticle = Artikel::where('status_artikel', 'publish')
                ->where('tanggal_publish', '<', $currentArticle->tanggal_publish)
                ->orderBy('tanggal_publish', 'desc')
                ->first();

            return response()->json([
                'success' => true,
                'data' => $prevArticle,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve previous article: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get next article (for API)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNext(Request $request)
    {
        try {
            $id = $request->input('id');

            if (!$id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Article ID is required',
                ], 400);
            }

            $currentArticle = Artikel::find($id);

            if (!$currentArticle) {
                return response()->json([
                    'success' => false,
                    'message' => 'Article not found',
                ], 404);
            }

            $nextArticle = Artikel::where('status_artikel', 'publish')
                ->where('tanggal_publish', '>', $currentArticle->tanggal_publish)
                ->orderBy('tanggal_publish', 'asc')
                ->first();

            return response()->json([
                'success' => true,
                'data' => $nextArticle,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve next article: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get article categories (for API)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategories()
    {
        try {
            $categories = Artikel::where('status_artikel', 'publish')
                ->select('kategori')
                ->selectRaw('COUNT(*) as total')
                ->groupBy('kategori')
                ->get();

            $labels = [
                'tips_panduan' => 'Tips & Panduan',
                'desain_inspirasi' => 'Desain & Inspirasi',
                'perawatan_maintenance' => 'Perawatan & Maintenance',
                'material_finishing' => 'Material & Finishing',
                'tren_terbaru' => 'Tren Terbaru',
                'case_study' => 'Case Study',
            ];

            $formattedCategories = $categories->map(function($item) use ($labels) {
                return [
                    'value' => $item->kategori,
                    'label' => $labels[$item->kategori] ?? ucfirst(str_replace('_', ' ', $item->kategori)),
                    'total' => $item->total,
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $formattedCategories,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve categories: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get article tags (for API)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTags()
    {
        try {
            $articles = Artikel::where('status_artikel', 'publish')
                ->whereNotNull('tags')
                ->get();

            $allTags = [];
            foreach ($articles as $article) {
                $tags = explode(',', $article->tags);
                foreach ($tags as $tag) {
                    $tag = trim($tag);
                    if (!empty($tag)) {
                        if (!isset($allTags[$tag])) {
                            $allTags[$tag] = 0;
                        }
                        $allTags[$tag]++;
                    }
                }
            }

            arsort($allTags);

            $formattedTags = [];
            foreach ($allTags as $tag => $count) {
                $formattedTags[] = [
                    'value' => $tag,
                    'label' => ucfirst($tag),
                    'total' => $count,
                ];
            }

            return response()->json([
                'success' => true,
                'data' => array_slice($formattedTags, 0, 20),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve tags: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get articles by category (for API)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByCategory(Request $request)
    {
        try {
            $category = $request->input('category');
            $limit = $request->input('limit', 10);

            if (!$category) {
                return response()->json([
                    'success' => false,
                    'message' => 'Category is required',
                ], 400);
            }

            $articles = Artikel::where('status_artikel', 'publish')
                ->where('kategori', $category)
                ->orderBy('tanggal_publish', 'desc')
                ->paginate($limit);

            return response()->json([
                'success' => true,
                'data' => $articles->items(),
                'total' => $articles->total(),
                'current_page' => $articles->currentPage(),
                'last_page' => $articles->lastPage(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve articles: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get articles by tag (for API)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByTag(Request $request)
    {
        try {
            $tag = $request->input('tag');
            $limit = $request->input('limit', 10);

            if (!$tag) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tag is required',
                ], 400);
            }

            $articles = Artikel::where('status_artikel', 'publish')
                ->where('tags', 'like', "%{$tag}%")
                ->orderBy('tanggal_publish', 'desc')
                ->paginate($limit);

            return response()->json([
                'success' => true,
                'data' => $articles->items(),
                'total' => $articles->total(),
                'current_page' => $articles->currentPage(),
                'last_page' => $articles->lastPage(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve articles: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Search articles (for API)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        try {
            $query = $request->input('q');
            $limit = $request->input('limit', 10);

            if (!$query) {
                return response()->json([
                    'success' => false,
                    'message' => 'Search query is required',
                ], 400);
            }

            $articles = Artikel::where('status_artikel', 'publish')
                ->where(function($q) use ($query) {
                    $q->where('judul_artikel', 'like', "%{$query}%")
                      ->orWhere('konten', 'like', "%{$query}%")
                      ->orWhere('excerpt', 'like', "%{$query}%")
                      ->orWhere('tags', 'like', "%{$query}%");
                })
                ->orderBy('tanggal_publish', 'desc')
                ->paginate($limit);

            return response()->json([
                'success' => true,
                'data' => $articles->items(),
                'total' => $articles->total(),
                'current_page' => $articles->currentPage(),
                'last_page' => $articles->lastPage(),
                'query' => $query,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to search articles: ' . $e->getMessage(),
            ], 500);
        }
    }
}