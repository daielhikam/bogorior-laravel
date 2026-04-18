<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'team';

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_team';

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
        'nama_lengkap',
        'posisi',
        'foto',
        'bio',
        'pengalaman',
        'keahlian',
        'email',
        'no_whatsapp',
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
     * Get the photo URL.
     */
    public function getFotoUrlAttribute(): string
    {
        if ($this->foto && $this->foto !== '0' && $this->foto !== 'null') {
            if (filter_var($this->foto, FILTER_VALIDATE_URL)) {
                return $this->foto;
            }
            return asset('uploads/team/' . $this->foto);
        }
        
        $name = urlencode($this->nama_lengkap);
        return "https://ui-avatars.com/api/?name={$name}&background=059669&color=fff&size=200&bold=true";
    }

    /**
     * Get keahlian as array.
     */
    public function getKeahlianArrayAttribute(): array
    {
        if (!$this->keahlian) {
            return [];
        }
        
        $skills = explode("\n", $this->keahlian);
        return array_map('trim', array_filter($skills));
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
     * Scope a query to only include active team members.
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
}