<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desain extends Model
{
    use HasFactory;

    protected $table = 'desains';
    protected $primaryKey = 'desain_id';
    protected $fillable = ['kategori_id', 'judul', 'deskripsi', 'harga', 'gambar', 'slug'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }
}