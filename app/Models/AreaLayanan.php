<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaLayanan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'area_layanan';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_area';

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
    const UPDATED_AT = null; // Table doesn't have updated_at

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_area',
        'jenis_area',
        'daftar_lokasi',
        'deskripsi',
        'aktif',
        'urutan',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'aktif' => 'boolean',
            'urutan' => 'integer',
            'created_at' => 'datetime',
        ];
    }

    /**
     * Get the jenis area label.
     */
    public function getJenisAreaLabelAttribute(): string
    {
        $labels = [
            'kota' => 'Kota',
            'kabupaten' => 'Kabupaten',
            'sekitar' => 'Sekitar',
            'luar_kota' => 'Luar Kota',
        ];
        
        return $labels[$this->jenis_area] ?? ucfirst($this->jenis_area);
    }

    /**
     * Get the jenis area icon.
     */
    public function getJenisAreaIconAttribute(): string
    {
        $icons = [
            'kota' => 'fas fa-city',
            'kabupaten' => 'fas fa-landmark',
            'sekitar' => 'fas fa-map-marker-alt',
            'luar_kota' => 'fas fa-plane',
        ];
        
        return $icons[$this->jenis_area] ?? 'fas fa-map-marker-alt';
    }

    /**
     * Get daftar lokasi as array.
     */
    public function getDaftarLokasiArrayAttribute(): array
    {
        if (!$this->daftar_lokasi) {
            return [];
        }
        
        $locations = explode(',', $this->daftar_lokasi);
        return array_map('trim', array_filter($locations));
    }

    /**
     * Get status badge.
     */
    public function getStatusBadgeAttribute(): string
    {
        if ($this->aktif) {
            return '<span class="badge badge-success">Aktif</span>';
        }
        return '<span class="badge badge-danger">Tidak Aktif</span>';
    }

    /**
     * Scope a query to only include active areas.
     */
    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    /**
     * Scope a query ordered by urutan.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc')->orderBy('nama_area', 'asc');
    }

    /**
     * Scope a query by jenis area.
     */
    public function scopeByJenis($query, $jenis)
    {
        return $query->where('jenis_area', $jenis);
    }
}