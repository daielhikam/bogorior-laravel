<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pelanggan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pelanggan';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_pelanggan';

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
        'nama_lengkap',
        'no_whatsapp',
        'email',
        'alamat',
        'tanggal_daftar',
        'status_pelanggan',
        'sumber',
        'catatan',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tanggal_daftar' => 'datetime',
            'created_at' => 'datetime',
        ];
    }

    /**
     * Get the customer's status badge.
     */
    public function getStatusBadgeAttribute(): string
    {
        $badges = [
            'prospek' => '<span class="badge badge-info">Prospek</span>',
            'klien' => '<span class="badge badge-primary">Klien</span>',
            'selesai' => '<span class="badge badge-success">Selesai</span>',
        ];
        
        return $badges[$this->status_pelanggan] ?? '<span class="badge badge-secondary">' . $this->status_pelanggan . '</span>';
    }

    /**
     * Get the customer's source badge.
     */
    public function getSumberBadgeAttribute(): string
    {
        $badges = [
            'website' => '<span class="badge badge-info"><i class="fas fa-globe"></i> Website</span>',
            'instagram' => '<span class="badge badge-danger"><i class="fab fa-instagram"></i> Instagram</span>',
            'facebook' => '<span class="badge badge-primary"><i class="fab fa-facebook"></i> Facebook</span>',
            'tiktok' => '<span class="badge badge-dark"><i class="fab fa-tiktok"></i> TikTok</span>',
            'referensi' => '<span class="badge badge-success"><i class="fas fa-users"></i> Referensi</span>',
            'lainnya' => '<span class="badge badge-secondary">Lainnya</span>',
        ];
        
        return $badges[$this->sumber] ?? '<span class="badge badge-secondary">' . $this->sumber . '</span>';
    }

    /**
     * Get the consultations for the customer.
     */
    public function konsultasis(): HasMany
    {
        return $this->hasMany(Konsultasi::class, 'id_pelanggan');
    }

    /**
     * Get the projects for the customer.
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'id_pelanggan');
    }

    /**
     * Get the latest consultation.
     */
    public function latestKonsultasi(): HasOne
    {
        return $this->hasOne(Konsultasi::class, 'id_pelanggan')->latest('created_at');
    }

    /**
     * Get the latest project.
     */
    public function latestProject(): HasOne
    {
        return $this->hasOne(Project::class, 'id_pelanggan')->latest('created_at');
    }

    /**
     * Scope a query to only include active customers (prospek or klien).
     */
    public function scopeActive($query)
    {
        return $query->whereIn('status_pelanggan', ['prospek', 'klien']);
    }

    /**
     * Scope a query to only include customers from specific source.
     */
    public function scopeFromSource($query, $source)
    {
        return $query->where('sumber', $source);
    }
}