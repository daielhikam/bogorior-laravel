<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'faq';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_faq';

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
        'pertanyaan',
        'jawaban',
        'kategori',
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
            'urutan' => 'integer',
            'aktif' => 'boolean',
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
            'layanan' => 'Layanan',
            'pembayaran' => 'Pembayaran',
            'garansi' => 'Garansi',
            'pemasangan' => 'Pemasangan',
            'material' => 'Material',
            'umum' => 'Umum',
        ];
        
        return $labels[$this->kategori] ?? ucfirst($this->kategori);
    }

    /**
     * Get the kategori icon.
     */
    public function getKategoriIconAttribute(): string
    {
        $icons = [
            'layanan' => 'fas fa-concierge-bell',
            'pembayaran' => 'fas fa-credit-card',
            'garansi' => 'fas fa-shield-alt',
            'pemasangan' => 'fas fa-tools',
            'material' => 'fas fa-cube',
            'umum' => 'fas fa-question-circle',
        ];
        
        return $icons[$this->kategori] ?? 'fas fa-question';
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
     * Scope a query to only include active FAQs.
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
        return $query->orderBy('urutan', 'asc')->orderBy('created_at', 'asc');
    }

    /**
     * Scope a query by kategori.
     */
    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }
}