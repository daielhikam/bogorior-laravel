<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketLayanan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'paket_layanan';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_paket';

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
        'nama_paket',
        'slug_paket',
        'jenis_layanan',
        'harga_mulai',
        'deskripsi_singkat',
        'deskripsi_lengkap',
        'fitur',
        'spesifikasi',
        'gambar_paket',
        'popular',
        'urutan',
        'aktif',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'harga_mulai' => 'decimal:2',
            'popular' => 'boolean',
            'urutan' => 'integer',
            'aktif' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Get the jenis layanan label.
     */
    public function getJenisLayananLabelAttribute(): string
    {
        $labels = [
            'custom' => 'Kitchen Set Custom',
            'premium' => 'Kitchen Set Premium',
            'renovasi' => 'Renovasi Dapur',
            'interior' => 'Interior Design',
        ];
        
        return $labels[$this->jenis_layanan] ?? ucfirst($this->jenis_layanan);
    }

    /**
     * Get the formatted harga mulai.
     */
    public function getHargaMulaiFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->harga_mulai, 0, ',', '.');
    }

    /**
     * Get the icon for the service type.
     */
    public function getIconAttribute(): string
    {
        $icons = [
            'custom' => 'fas fa-ruler-combined',
            'premium' => 'fas fa-crown',
            'renovasi' => 'fas fa-home',
            'interior' => 'fas fa-paint-roller',
        ];
        
        return $icons[$this->jenis_layanan] ?? 'fas fa-star';
    }

    /**
     * Get the image URL.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->gambar_paket && $this->gambar_paket !== '0' && $this->gambar_paket !== 'null') {
            if (filter_var($this->gambar_paket, FILTER_VALIDATE_URL)) {
                return $this->gambar_paket;
            }
            return asset('uploads/paket/' . $this->gambar_paket);
        }
        
        return asset('assets/images/placeholder-service.jpg');
    }

    /**
     * Get the popular badge.
     */
    public function getPopularBadgeAttribute(): string
    {
        if ($this->popular) {
            return '<span class="badge badge-danger"><i class="fas fa-fire"></i> POPULER</span>';
        }
        return '';
    }

    /**
     * Get the status badge.
     */
    public function getStatusBadgeAttribute(): string
    {
        if ($this->aktif) {
            return '<span class="badge badge-success">Aktif</span>';
        }
        return '<span class="badge badge-danger">Tidak Aktif</span>';
    }

    /**
     * Scope a query to only include active packages.
     */
    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    /**
     * Scope a query to only include popular packages.
     */
    public function scopePopular($query)
    {
        return $query->where('popular', true);
    }

    /**
     * Scope a query to order by urutan and then popular.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc')->orderBy('popular', 'desc');
    }

    /**
     * Scope a query by jenis layanan.
     */
    public function scopeJenisLayanan($query, $jenis)
    {
        return $query->where('jenis_layanan', $jenis);
    }
}