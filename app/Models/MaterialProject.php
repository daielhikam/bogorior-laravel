<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaterialProject extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'material_project';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_material';

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
        'id_project',
        'nama_material',
        'jenis_material',
        'spesifikasi',
        'merk',
        'jumlah',
        'satuan',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'jumlah' => 'integer',
            'created_at' => 'datetime',
        ];
    }

    /**
     * Get the jenis material label.
     */
    public function getJenisMaterialLabelAttribute(): string
    {
        $labels = [
            'kabinet' => '<span class="badge badge-primary">Kabinet</span>',
            'countertop' => '<span class="badge badge-info">Countertop</span>',
            'hardware' => '<span class="badge badge-warning">Hardware</span>',
            'finishing' => '<span class="badge badge-success">Finishing</span>',
            'aksesoris' => '<span class="badge badge-secondary">Aksesoris</span>',
        ];
        
        return $labels[$this->jenis_material] ?? '<span class="badge badge-secondary">' . $this->jenis_material . '</span>';
    }

    /**
     * Get the project that owns the material.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'id_project');
    }

    /**
     * Scope a query to only include materials by jenis.
     */
    public function scopeJenisMaterial($query, $jenis)
    {
        return $query->where('jenis_material', $jenis);
    }
}