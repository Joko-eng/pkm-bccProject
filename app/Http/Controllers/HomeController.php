<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use App\Models\Artikel;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Visitor;
use App\Models\Kontak;
use App\Models\Kerjasama;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate; // Import GoogleTranslate

class HomeController extends Controller
{
    /**
     * Menghitung jumlah pengunjung.
     */

     public function show1(string $id)
{
    $kategori = Kategori::all();
    $currentYear = Carbon::now()->year;
    $artikel = Artikel::findOrFail($id);
    $kontaks = Kontak::all();

    // Get the current locale
    $locale = session('locale', 'id'); // Default locale

    // Translate article content only if the locale is not Indonesian
    if ($locale !== 'id') {
        $artikel->judul_translated = $this->translate($artikel->judul, $locale);
        $artikel->konten_translated = $this->translate($artikel->konten, $locale);
        // Jika Anda ingin menerjemahkan kategori, tambahkan logika ini
        // $artikel->kategori_translated = $this->translate($artikel->kategori->nama_kategori, $locale);
    }

    return view('detailArtikel', compact('currentYear', 'kategori', 'locale', 'artikel', 'kontaks'));
}


    public function indexArtikel()
    {
        $currentYear = Carbon::now()->year;
        $produks = Produk::with('kategoris')->get();
        $artikels = Artikel::all();
        $kontaks = Kontak::all();
        $locale = session('locale', 'id');

        // Translate only if the locale is not Indonesian
    if ($locale !== 'id') {
        foreach ($artikels as $artikel) {
            $artikel->judul_translated = $this->translate($artikel->judul, $locale);
            $artikel->konten_translated = $this->translate($artikel->konten, $locale);
        }
    }
        return view('Artikel', compact('produks', 'locale', 'artikels', 'currentYear', 'kontaks'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $today = Carbon::today()->toDateString();

    $visitor = Visitor::all();
    $totalVisitCount = Visitor::where('date', $today)->sum('visit_count');
    $total = Visitor::count();
    $kerjasamas = Kerjasama::all();

    $kategori = Kategori::all(); // Jika Anda perlu mengirim kategori ke view

    $kontaks = Kontak::all();
    $whatsapp = Kontak::where('nama_aplikasi', 'like', '%whats%')->first();
    $currentYear = Carbon::now()->year;

    // Retrieve produk and artikel data
    $produks = Produk::with('kategoris')->get();
    $artikels = Artikel::all();

    // Get the current locale
    $locale = session('locale', 'id'); // Default locale

    // Translate only if the locale is not Indonesian
    if ($locale !== 'id') {
        foreach ($produks as $produk) {
            $produk->nama_translated = $this->translate($produk->nama, $locale);
            $produk->deskripsi_translated = $this->translate($produk->deskripsi, $locale);
            $produk->kategori_translated = $this->translate($produk->kategoris->nama_kategori, $locale);
        }

        foreach ($artikels as $artikel) {
            $artikel->judul_translated = $this->translate($artikel->judul, $locale);
            // $artikel->konten_translated = $this->translate($artikel->konten, $locale);
        }
    }

    // Pass the visitor count, produk, artikel, and other data to the view
    return view('beranda', compact('totalVisitCount', 'kerjasamas', 'locale', 'whatsapp', 'total', 'produks', 'artikels', 'kontaks', 'currentYear', 'kategori'));
}




    /**
     * Fungsi translate menggunakan Google Translate API
     */
    public function translate($text, $locale)
    {
        // Gunakan package Google Translate dari Stichoza
        $translator = new GoogleTranslate(); // Membuat instance dari GoogleTranslate
        $translator->setSource(); // Auto-detect source language
        $translator->setTarget($locale); // Set target locale

        // Lakukan terjemahan
        return $translator->translate($text);
    }

    /**
     * Tampilkan detail produk berdasarkan id.
     */
    public function show(Produk $produk, $encryptedId)
{
    try {
        $id = Crypt::decryptString($encryptedId);
    } catch (DecryptException $e) {
        abort(404, 'Invalid encrypted ID');
    }


    $currentYear = Carbon::now()->year;
    $kontaks = Kontak::all();
    $produk = Produk::findOrFail($id);
    $kategori = Kategori::all(); // Mengambil semua kategori, jika diperlukan

    // Mendapatkan locale saat ini
    $locale = session('locale', 'id'); // Default locale ke 'id'

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

    return view('detailProduk', compact('produk', 'kontaks', 'currentYear', 'kategori'));
}


    /**
     * Fungsi lain seperti create, store, edit, update, dan destroy
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
