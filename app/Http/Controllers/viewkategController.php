<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Kontak;
use Stichoza\GoogleTranslate\GoogleTranslate;

class viewkategController extends Controller
{
    public function translate($text, $locale)
    {
        // Gunakan package Google Translate dari Stichoza
        $translator = new GoogleTranslate();
        $translator->setSource(); // Auto-detect source language
        $translator->setTarget($locale); // Set target locale

        // Lakukan terjemahan
        return $translator->translate($text);
    }

    public function index(Request $request)
    {
        $currentYear = Carbon::now()->year;
        $query = Produk::with('kategoris');
        $kontaks = Kontak::all();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhereHas('kategoris', function ($q) use ($search) {
                      $q->where('nama_kategori', 'like', "%{$search}%");
                  });
        }

        // Ambil locale dari session
        $locale = session('locale', 'id'); // Default locale ke 'id'

        $kategoris = Kategori::with('produks')->get();
    foreach ($kategoris as $kat) {
        $kat->nama_kategori_translated = $locale !== 'id'
            ? $this->translate($kat->nama_kategori, $locale)
            : $kat->nama_kategori;
    }
        $produks = $query->get();



        foreach ($produks as $produk) {
            // Translate hanya jika locale bukan 'id' (Indonesia)
            if ($locale !== 'id') {
                $produk->nama_translated = $this->translate($produk->nama, $locale);
                $produk->deskripsi_translated = $this->translate($produk->deskripsi, $locale);

                // Pastikan relasi ke kategori ada sebelum melakukan translasi
                if ($produk->kategoris) {
                    $produk->kategori_translated = $this->translate($produk->kategoris->nama_kategori, $locale);
                } else {
                    $produk->kategori_translated = null; // Atur ke null jika kategori tidak ditemukan
                }
            }
        }

        return view('kategori.index', compact('produks', 'locale', 'kategoris', 'currentYear', 'kontaks'));
    }

    public function showByCategory($id)
{
    $currentYear = Carbon::now()->year;
    $kontaks = Kontak::all();

    // Ambil kategori beserta produk yang terkait
    $kategori = Kategori::with('produks')->findOrFail($id);

    // Ambil locale dari session
    $locale = session('locale', 'id'); // Default locale ke 'id'

    // Terjemahkan nama kategori hanya jika locale bukan 'id' (Indonesia)
    if ($locale !== 'id') {
        $kategori->nama_kategori_translated = $this->translate($kategori->nama_kategori, $locale);
    } else {
        $kategori->nama_kategori_translated = $kategori->nama_kategori; // Jika locale adalah 'id'
    }


    // Terjemahkan setiap produk dalam kategori
    foreach ($kategori->produks as $produk) {
        if ($locale !== 'id') {
            $produk->nama_translated = $this->translate($produk->nama, $locale);
            $produk->deskripsi_translated = $this->translate($produk->deskripsi, $locale);
            $produk->kategori_translated = $this->translate($kategori->nama_kategori, $locale);
        } else {
            // Jika locale adalah 'id', gunakan nama asli
            $produk->nama_translated = $produk->nama;
            $produk->deskripsi_translated = $produk->deskripsi;
            $produk->kategori_translated = $kategori->nama_kategori;
        }
    }

    // Mengambil semua kategori jika diperlukan
    $kategoris = Kategori::with('produks')->get();
    foreach ($kategoris as $kat) {
        $kat->nama_kategori_translated = $locale !== 'id'
            ? $this->translate($kat->nama_kategori, $locale)
            : $kat->nama_kategori;
    }
    $activeCategoryId = $id;

    return view('kategori.show', compact('kategori', 'locale', 'kategoris', 'currentYear', 'activeCategoryId', 'kontaks'));
}


}
