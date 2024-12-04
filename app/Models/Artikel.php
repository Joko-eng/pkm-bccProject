<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;
   

    protected $table = 'artikels';
    protected $primaryKey = "id";
    protected $fillable = [
        'judul',
        'konten',
        'tgl_published',
        'nama_published',
        'gambar'
    ];
}
