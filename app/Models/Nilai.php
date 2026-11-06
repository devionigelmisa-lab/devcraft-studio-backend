<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- Pastikan namespace Illuminate ini yang dipakai
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilais';
    protected $primaryKey = 'nilai_id';

    protected $fillable = [
        'id_mhs',
        'matakuliahid',
        'semester',
        'nilai',
    ];
}