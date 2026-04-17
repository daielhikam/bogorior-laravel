<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artikel extends Model
{
    use SoftDeletes;
    
    protected $table = 'artikel';
    protected $primaryKey = 'id_artikel';
    
    protected $fillable = [
        'judul_artikel', 'slug', 'konten', 'excerpt', 'gambar_utama',
        'kategori', 'tags', 'penulis', 'status_artikel', 'featured',
        'tanggal_publish', 'views', 'meta_title', 'meta_description'
    ];
    
    protected $casts = [
        'featured' => 'boolean',
        'views' => 'integer',
        'tanggal_publish' => 'date'
    ];
    
    // Scope
    public function scopePublished($query)
    {
        return $query->where('status_artikel', 'publish');
    }
    
    public function scopeFeatured($query)
    {
        return $query->where('featured', true)->where('status_artikel', 'publish');
    }
    
    // Accessor
    public function getExcerptAttribute($value)
    {
        if ($value) return $value;
        return substr(strip_tags($this->konten), 0, 150) . '...';
    }
    
    // Methods
    public function incrementViews()
    {
        $this->increment('views');
    }
}