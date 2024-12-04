<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';
    protected $primaryKey = "id";
    protected $fillable = [
        'nama',
        'deskripsi',
        'bahan',
        'ukuran',
        'image1',
        'image2',
        'image3',
        'image4',
        'kategori_id'
    ];

    public function kategoris()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

}

