<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimoni extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'testimoni';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_testimoni';

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
        'id_project',
        'nama_client',
        'foto_client',
        'url_video',
        'video_platform',
        'video_id',
        'video_thumbnail',
        'rating',
        'testimoni',
        'jenis_project',
        'lokasi',
        'status_testimoni',
        'tipe_testimoni',
        'featured',
        'tanggal_testimoni',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'featured' => 'boolean',
            'tanggal_testimoni' => 'date',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Get the avatar URL.
     */
    public function getAvatarUrlAttribute(): string
    {
        if ($this->foto_client && $this->foto_client !== '0' && $this->foto_client !== 'null') {
            if (filter_var($this->foto_client, FILTER_VALIDATE_URL)) {
                return $this->foto_client;
            }
            return asset('uploads/testimoni/' . $this->foto_client);
        }
        
        $name = urlencode($this->nama_client ?? 'Client');
        return "https://ui-avatars.com/api/?name={$name}&background=059669&color=fff&size=100&bold=true";
    }

    /**
     * Get the video thumbnail URL.
     */
    public function getVideoThumbnailUrlAttribute(): string
    {
        if ($this->video_thumbnail && $this->video_thumbnail !== '0' && $this->video_thumbnail !== 'null') {
            if (filter_var($this->video_thumbnail, FILTER_VALIDATE_URL)) {
                return $this->video_thumbnail;
            }
            return asset('uploads/testimoni/' . $this->video_thumbnail);
        }
        
        if ($this->video_platform === 'youtube' && $this->video_id) {
            return "https://img.youtube.com/vi/{$this->video_id}/maxresdefault.jpg";
        }
        
        if ($this->video_platform === 'vimeo' && $this->video_id) {
            return "https://vumbnail.com/{$this->video_id}.jpg";
        }
        
        return asset('assets/images/video-placeholder.jpg');
    }

    /**
     * Get the rating stars HTML.
     */
    public function getRatingStarsAttribute(): string
    {
        $stars = '';
        $fullStars = floor($this->rating ?? 0);
        $hasHalfStar = ($this->rating ?? 0) - $fullStars >= 0.5;

        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $fullStars) {
                $stars .= '<i class="fas fa-star"></i>';
            } elseif ($i === $fullStars + 1 && $hasHalfStar) {
                $stars .= '<i class="fas fa-star-half-alt"></i>';
            } else {
                $stars .= '<i class="far fa-star"></i>';
            }
        }
        return $stars;
    }

    /**
     * Get the status badge.
     */
    public function getStatusBadgeAttribute(): string
    {
        $badges = [
            'pending' => '<span class="badge badge-warning">Pending</span>',
            'approved' => '<span class="badge badge-success">Approved</span>',
            'featured' => '<span class="badge badge-primary">Featured</span>',
            'arsip' => '<span class="badge badge-secondary">Arsip</span>',
        ];
        
        return $badges[$this->status_testimoni] ?? '<span class="badge badge-secondary">' . $this->status_testimoni . '</span>';
    }

    /**
     * Get the tipe badge.
     */
    public function getTipeBadgeAttribute(): string
    {
        if ($this->tipe_testimoni === 'video') {
            $icons = [
                'youtube' => '<i class="fab fa-youtube"></i>',
                'instagram' => '<i class="fab fa-instagram"></i>',
                'tiktok' => '<i class="fab fa-tiktok"></i>',
                'facebook' => '<i class="fab fa-facebook"></i>',
                'vimeo' => '<i class="fab fa-vimeo"></i>',
                'local' => '<i class="fas fa-video"></i>',
            ];
            $icon = $icons[$this->video_platform] ?? '<i class="fas fa-video"></i>';
            return '<span class="badge badge-danger">' . $icon . ' Video</span>';
        }
        
        return '<span class="badge badge-info"><i class="fas fa-comment"></i> Teks</span>';
    }

    /**
     * Get the project that owns the testimonial.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'id_project');
    }

    /**
     * Scope a query to only include approved testimonials.
     */
    public function scopeApproved($query)
    {
        return $query->where('status_testimoni', 'approved');
    }

    /**
     * Scope a query to only include featured testimonials.
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Scope a query to only include text testimonials.
     */
    public function scopeTeks($query)
    {
        return $query->where('tipe_testimoni', 'teks');
    }

    /**
     * Scope a query to only include video testimonials.
     */
    public function scopeVideo($query)
    {
        return $query->where('tipe_testimoni', 'video');
    }

    /**
     * Scope a query to order by rating (highest first).
     */
    public function scopeHighestRated($query)
    {
        return $query->orderBy('rating', 'desc');
    }
}