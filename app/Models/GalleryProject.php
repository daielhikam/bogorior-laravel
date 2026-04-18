<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GalleryProject extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gallery_project';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_gallery';

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
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_project',
        'jenis_foto',
        'nama_file',
        'url_foto',
        'deskripsi_foto',
        'thumbnail',
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
            'thumbnail' => 'boolean',
            'urutan' => 'integer',
            'created_at' => 'datetime',
        ];
    }

    /**
     * Get the jenis foto label.
     */
    public function getJenisFotoLabelAttribute(): string
    {
        $labels = [
            'sebelum' => '<span class="badge badge-warning">Sebelum</span>',
            'proses' => '<span class="badge badge-info">Proses</span>',
            'sesudah' => '<span class="badge badge-success">Sesudah</span>',
            'detail' => '<span class="badge badge-primary">Detail</span>',
            'desain' => '<span class="badge badge-secondary">Desain 3D</span>',
            'material' => '<span class="badge badge-dark">Material</span>',
        ];
        
        return $labels[$this->jenis_foto] ?? '<span class="badge badge-secondary">' . $this->jenis_foto . '</span>';
    }

    /**
     * Get the full URL of the image.
     */
    public function getImageUrlAttribute(): string
    {
        if (filter_var($this->url_foto, FILTER_VALIDATE_URL)) {
            return $this->url_foto;
        }
        return asset($this->url_foto);
    }

    /**
     * Get the project that owns the gallery.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'id_project');
    }

    /**
     * Scope a query to only include thumbnail images.
     */
    public function scopeThumbnail($query)
    {
        return $query->where('thumbnail', 1);
    }

    /**
     * Scope a query ordered by urutan.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc')->orderBy('id_gallery', 'asc');
    }
}