<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pengaturan_situs';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_pengaturan';

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
        'kategori',
        'kunci',
        'nilai',
        'tipe',
        'label',
        'placeholder',
        'opsi',
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
            'urutan' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Get the typed value.
     */
    public function getTypedValueAttribute()
    {
        switch ($this->tipe) {
            case 'number':
                return (float) $this->nilai;
            case 'boolean':
                return (bool) $this->nilai;
            case 'json':
                return json_decode($this->nilai, true);
            default:
                return $this->nilai;
        }
    }

    /**
     * Scope a query by kategori.
     */
    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    /**
     * Scope a query ordered by urutan.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc')->orderBy('kunci', 'asc');
    }

    /**
     * Get all settings as key-value array.
     */
    public static function getAllAsArray(): array
    {
        return self::all()->pluck('nilai', 'kunci')->toArray();
    }

    /**
     * Get setting value by key with default.
     */
    public static function getValue(string $key, $default = null)
    {
        $setting = self::where('kunci', $key)->first();
        if (!$setting) {
            return $default;
        }
        return $setting->typed_value;
    }
}