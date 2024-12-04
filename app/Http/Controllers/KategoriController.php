<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = Kategori::all();
        return view('kategori.create', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nama_kategori' => 'required',
        ]);
        $kategori = new Kategori();
        $kategori->nama_kategori = $validatedData['nama_kategori'];

        $kategori->save();
        return redirect()->route('kategori.store')->with('success', 'Kategori berhasil ditambahkan.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Hapus semua produk yang berhubungan dengan kategori ini
        // Asumsikan kolom 'kategori_id' adalah foreign key di tabel 'produk'
        Produk::where('kategori_id', $id)->delete();
        $kategori = Kategori::findOrFail($id);

        // Hapus kategori yang bersangkutan
        $kategori->delete();

        return redirect('/admin/kategori')->with('success', 'Kategori berhasil dihapus beserta produk terkait.');
    }
}
