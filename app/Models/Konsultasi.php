<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Konsultasi extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'konsultasi';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_konsultasi';

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
        'nama_konsultan',
        'no_whatsapp',
        'email',
        'jenis_layanan',
        'budget',
        'ukuran_dapur',
        'alamat_lokasi',
        'pesan_kebutuhan',
        'tanggal_konsultasi',
        'status_konsultasi',
        'dihubungi',
        'jadwal_survey',
        'catatan_admin',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tanggal_konsultasi' => 'datetime',
            'jadwal_survey' => 'datetime',
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
            'konsultasi_desain' => 'Konsultasi Desain',
        ];
        
        return $labels[$this->jenis_layanan] ?? ucfirst($this->jenis_layanan);
    }

    /**
     * Get the budget label.
     */
    public function getBudgetLabelAttribute(): string
    {
        $labels = [
            '5-10' => 'Rp 5 Juta - Rp 10 Juta',
            '10-20' => 'Rp 10 Juta - Rp 20 Juta',
            '20-35' => 'Rp 20 Juta - Rp 35 Juta',
            '35-50' => 'Rp 35 Juta - Rp 50 Juta',
            '50+' => 'Rp 50 Juta+',
        ];
        
        return $labels[$this->budget] ?? $this->budget;
    }

    /**
     * Get the status badge.
     */
    public function getStatusBadgeAttribute(): string
    {
        $badges = [
            'baru' => '<span class="badge badge-info">Baru</span>',
            'diproses' => '<span class="badge badge-warning">Diproses</span>',
            'dijadwalkan' => '<span class="badge badge-primary">Dijadwalkan</span>',
            'selesai' => '<span class="badge badge-success">Selesai</span>',
            'dibatalkan' => '<span class="badge badge-danger">Dibatalkan</span>',
        ];
        
        return $badges[$this->status_konsultasi] ?? '<span class="badge badge-secondary">' . $this->status_konsultasi . '</span>';
    }

    /**
     * Get the dihubungi badge.
     */
    public function getDihubungiBadgeAttribute(): string
    {
        if ($this->dihubungi === 'ya') {
            return '<span class="badge badge-success">Sudah Dihubungi</span>';
        }
        return '<span class="badge badge-warning">Belum Dihubungi</span>';
    }

    /**
     * Get the customer that owns the consultation.
     */
    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    /**
     * Get the project associated with the consultation.
     */
    public function project(): HasOne
    {
        return $this->hasOne(Project::class, 'id_konsultasi');
    }

    /**
     * Scope a query to only include new consultations.
     */
    public function scopeBaru($query)
    {
        return $query->where('status_konsultasi', 'baru');
    }

    /**
     * Scope a query to only include consultations that haven't been contacted.
     */
    public function scopeBelumDihubungi($query)
    {
        return $query->where('dihubungi', 'belum');
    }

    /**
     * Scope a query to only include consultations by jenis layanan.
     */
    public function scopeJenisLayanan($query, $jenis)
    {
        return $query->where('jenis_layanan', $jenis);
    }
}