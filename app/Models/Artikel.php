<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// Hapus atau komentari baris ini
// use Illuminate\Database\Eloquent\SoftDeletes;

class Artikel extends Model
{
    // Hapus atau komentari baris ini
    // use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'artikel';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_artikel';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The data type of the primary key.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'created_at';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'updated_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'judul_artikel',
        'slug',
        'konten',
        'excerpt',
        'gambar_utama',
        'kategori',
        'tags',
        'penulis',
        'status_artikel',
        'featured',
        'tanggal_publish',
        'views',
        'meta_title',
        'meta_description',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'featured' => 'boolean',
            'views' => 'integer',
            'tanggal_publish' => 'date',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Get the kategori label.
     */
    public function getKategoriLabelAttribute(): string
    {
        $labels = [
            'tips_panduan' => 'Tips & Panduan',
            'desain_inspirasi' => 'Desain & Inspirasi',
            'perawatan_maintenance' => 'Perawatan & Maintenance',
            'material_finishing' => 'Material & Finishing',
            'tren_terbaru' => 'Tren Terbaru',
            'case_study' => 'Case Study',
        ];
        
        return $labels[$this->kategori] ?? ucfirst(str_replace('_', ' ', $this->kategori));
    }

    /**
     * Get the status label.
     */
    public function getStatusLabelAttribute(): string
    {
        $labels = [
            'draft' => '<span class="badge badge-secondary">Draft</span>',
            'publish' => '<span class="badge badge-success">Published</span>',
            'featured' => '<span class="badge badge-primary">Featured</span>',
            'arsip' => '<span class="badge badge-warning">Archived</span>',
        ];
        
        return $labels[$this->status_artikel] ?? '<span class="badge badge-secondary">' . $this->status_artikel . '</span>';
    }

    /**
     * Get the featured badge.
     */
    public function getFeaturedBadgeAttribute(): string
    {
        if ($this->featured) {
            return '<span class="badge badge-danger"><i class="fas fa-star"></i> Featured</span>';
        }
        return '';
    }

    /**
     * Get the formatted date.
     */
    public function getFormattedDateAttribute(): string
    {
        if (!$this->tanggal_publish) {
            return '-';
        }
        return $this->tanggal_publish->format('d M Y');
    }

    /**
     * Get the formatted date with day.
     */
    public function getFullDateAttribute(): string
    {
        if (!$this->tanggal_publish) {
            return '-';
        }
        return $this->tanggal_publish->format('l, d F Y');
    }

    /**
     * Get the image URL.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->gambar_utama && $this->gambar_utama !== '0' && $this->gambar_utama !== 'null') {
            if (filter_var($this->gambar_utama, FILTER_VALIDATE_URL)) {
                return $this->gambar_utama;
            }
            return asset('uploads/artikel/' . $this->gambar_utama);
        }
        
        return asset('assets/images/placeholder-article.jpg');
    }

    /**
     * Get tags as array.
     */
    public function getTagsArrayAttribute(): array
    {
        if (!$this->tags) {
            return [];
        }
        
        $tags = explode(',', $this->tags);
        return array_map('trim', $tags);
    }

    /**
     * Get excerpt (short description).
     */
    public function getExcerptAttribute($value): string
    {
        if ($value) {
            return $value;
        }
        
        // Generate excerpt from content
        $content = strip_tags($this->konten);
        if (strlen($content) > 160) {
            return substr($content, 0, 160) . '...';
        }
        return $content;
    }

    /**
     * Get reading time in minutes.
     */
    public function getReadingTimeAttribute(): int
    {
        $wordCount = str_word_count(strip_tags($this->konten));
        return max(1, ceil($wordCount / 200));
    }

    /**
 * Get kategori label for sidebar (with count display)
 */
public function getKategoriForSidebarAttribute(): array
{
    $labels = [
        'tips_panduan' => 'Tips & Panduan',
        'desain_inspirasi' => 'Desain & Inspirasi',
        'perawatan_maintenance' => 'Perawatan & Maintenance',
        'material_finishing' => 'Material & Finishing',
        'tren_terbaru' => 'Tren Terbaru',
        'case_study' => 'Case Study',
    ];
    
    return [
        'value' => $this->kategori,
        'label' => $labels[$this->kategori] ?? ucfirst(str_replace('_', ' ', $this->kategori)),
        'count' => $this->total ?? 0,
    ];
}

    /**
     * Increment view count.
     */
    public function incrementViews(): void
    {
        $this->increment('views');
    }

    /**
     * Scope a query to only include published articles.
     */
    public function scopePublished($query)
    {
        return $query->where('status_artikel', 'publish')
            ->where('tanggal_publish', '<=', now());
    }

    /**
     * Scope a query to only include featured articles.
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Scope a query to only include articles by category.
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('kategori', $category);
    }

    /**
     * Scope a query to order by latest.
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('tanggal_publish', 'desc');
    }

    /**
     * Scope a query to order by most viewed.
     */
    public function scopeMostViewed($query)
    {
        return $query->orderBy('views', 'desc');
    }

    /**
     * Scope a query to search articles.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('judul_artikel', 'like', "%{$search}%")
                ->orWhere('konten', 'like', "%{$search}%")
                ->orWhere('excerpt', 'like', "%{$search}%")
                ->orWhere('tags', 'like', "%{$search}%");
        });
    }
}