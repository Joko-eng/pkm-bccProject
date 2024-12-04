<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;

    // Menentukan tabel yang digunakan oleh model ini
    protected $table = 'kontak';

    // Menentukan kolom yang dapat diisi
    protected $fillable = ['nama_aplikasi', 'gambar', 'tautan'];
}
