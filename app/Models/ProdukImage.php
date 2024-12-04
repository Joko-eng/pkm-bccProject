<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukImage extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'path'];

    public function produk ()
    {
        return $this->belongsTo(Produk::class);
    }
}
