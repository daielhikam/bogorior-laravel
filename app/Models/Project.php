<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'project';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_project';

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
        'id_pelanggan',
        'id_konsultasi',
        'kode_project',
        'nama_project',
        'jenis_project',
        'kategori_desain',
        'luas_area',
        'lokasi_project',
        'alamat_lengkap',
        'budget_project',
        'biaya_actual',
        'durasi_pengerjaan',
        'deskripsi_project',
        'testimoni_client',
        'rating_project',
        'status_project',
        'tanggal_mulai',
        'tanggal_selesai',
        'tanggal_garansi',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'luas_area' => 'decimal:2',
            'budget_project' => 'decimal:2',
            'biaya_actual' => 'decimal:2',
            'rating_project' => 'integer',
            'tanggal_mulai' => 'date',
            'tanggal_selesai' => 'date',
            'tanggal_garansi' => 'date',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Get the jenis project label.
     */
    public function getJenisProjectLabelAttribute(): string
    {
        $labels = [
            'custom' => 'Kitchen Set Custom',
            'premium' => 'Kitchen Set Premium',
            'renovasi' => 'Renovasi Dapur',
            'interior' => 'Interior Design',
            'konsultasi_desain' => 'Konsultasi Desain',
        ];
        
        return $labels[$this->jenis_project] ?? ucfirst($this->jenis_project);
    }

    /**
     * Get the kategori desain label.
     */
    public function getKategoriDesainLabelAttribute(): string
    {
        $labels = [
            'minimalist' => 'Minimalis',
            'modern' => 'Modern',
            'classic' => 'Klasik',
            'luxury' => 'Mewah',
            'contemporary' => 'Kontemporer',
            'industrial' => 'Industrial',
        ];
        
        return $labels[$this->kategori_desain] ?? ucfirst($this->kategori_desain);
    }

    /**
     * Get the formatted budget.
     */
    public function getBudgetFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->budget_project, 0, ',', '.');
    }

    /**
     * Get the formatted actual cost.
     */
    public function getBiayaActualFormattedAttribute(): string
    {
        if ($this->biaya_actual === null) {
            return '-';
        }
        return 'Rp ' . number_format($this->biaya_actual, 0, ',', '.');
    }

    /**
     * Get the status badge.
     */
    public function getStatusBadgeAttribute(): string
    {
        $badges = [
            'desain' => '<span class="badge badge-info"><i class="fas fa-pencil-ruler"></i> Desain</span>',
            'approval_desain' => '<span class="badge badge-warning"><i class="fas fa-check-double"></i> Approval Desain</span>',
            'produksi' => '<span class="badge badge-primary"><i class="fas fa-industry"></i> Produksi</span>',
            'pemasangan' => '<span class="badge badge-primary"><i class="fas fa-tools"></i> Pemasangan</span>',
            'finishing' => '<span class="badge badge-primary"><i class="fas fa-spray-can"></i> Finishing</span>',
            'selesai' => '<span class="badge badge-success"><i class="fas fa-check-circle"></i> Selesai</span>',
            'garansi' => '<span class="badge badge-info"><i class="fas fa-shield-alt"></i> Garansi</span>',
        ];
        
        return $badges[$this->status_project] ?? '<span class="badge badge-secondary">' . $this->status_project . '</span>';
    }

    /**
     * Get the rating stars HTML.
     */
    public function getRatingStarsAttribute(): string
    {
        $stars = '';
        $fullStars = floor($this->rating_project ?? 0);
        $hasHalfStar = ($this->rating_project ?? 0) - $fullStars >= 0.5;

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
     * Get the main image URL for the project.
     */
    public function getMainImageUrlAttribute(): string
{
    $gallery = $this->galleries()
        ->where('thumbnail', 1)
        ->orWhere('jenis_foto', 'sesudah')
        ->first();
    
    if ($gallery && $gallery->url_foto) {
        // Cek apakah file benar-benar ada
        $path = public_path($gallery->url_foto);
        if (file_exists($path)) {
            return asset($gallery->url_foto);
        }
    }
    
    // Fallback ke placeholder
    return 'https://placehold.co/600x400/e5e7eb/6b7280?text=No+Image';
}

    /**
     * Get the customer that owns the project.
     */
    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    /**
     * Get the consultation associated with the project.
     */
    public function konsultasi(): BelongsTo
    {
        return $this->belongsTo(Konsultasi::class, 'id_konsultasi');
    }

    /**
     * Get the galleries for the project.
     */
    public function galleries(): HasMany
    {
        return $this->hasMany(GalleryProject::class, 'id_project');
    }

    /**
     * Get the materials for the project.
     */
    public function materials(): HasMany
    {
        return $this->hasMany(MaterialProject::class, 'id_project');
    }

    /**
     * Get the testimonials for the project.
     */
    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimoni::class, 'id_project');
    }

    /**
     * Scope a query to only include completed projects.
     */
    public function scopeSelesai($query)
    {
        return $query->where('status_project', 'selesai');
    }

    /**
     * Scope a query to only include projects by jenis.
     */
    public function scopeJenisProject($query, $jenis)
    {
        return $query->where('jenis_project', $jenis);
    }

    /**
     * Scope a query to only include projects by kategori desain.
     */
    public function scopeKategoriDesain($query, $kategori)
    {
        return $query->where('kategori_desain', $kategori);
    }
    
    /**
     * Scope a query to order by latest.
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}