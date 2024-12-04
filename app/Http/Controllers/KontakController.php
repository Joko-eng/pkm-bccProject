<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KontakController extends Controller
{
    public function index()
    {
        $kontaks = Kontak::all();

        return view('welcome', compact('kontaks')); // Pastikan ini ada
    }


public function index2()
{
    // $contact = Kontak::;
    $kontaks = Kontak::paginate(5);
    return view('kontak.index', compact('kontaks'));
}


    public function create()
    {
        return view('kontak.create');
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_aplikasi' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:11048',
            'tautan' => 'required|url|max:65535',
        ]);
        
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'kontak/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($file));
        }

        Kontak::create([
            'nama_aplikasi' => $request->nama_aplikasi,
            'gambar' => $path,
            'tautan' => $request->tautan, // Simpan tautan
        ]);

        return redirect()->route('kontak.index')->with('success', 'Data berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit data
    public function edit($id)
    {
        $kontak = Kontak::findOrFail($id);
        return view('kontak.edit', compact('kontak'));
    }


    // Memperbarui data yang ada
    public function update(Request $request, Kontak $kontak)
    {
        $request->validate([
            'nama_aplikasi' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tautan' => 'required|url', // Validasi tautan
        ]);

        if ($request->hasFile('gambar')) {
            if ($kontak->gambar && Storage::disk('public')->exists('kontak/' . $kontak->gambar)) {
                Storage::disk('public')->delete('kontak/' . $kontak->gambar);
            }

            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = Storage::disk('public')->putFileAs('kontak', $file, $filename);
        }

        $kontak->update([
            'nama_aplikasi' => $request->nama_aplikasi,
            'gambar' => $path,
            'tautan' => $request->tautan, // Simpan tautan
        ]);
        return redirect()->route('kontak.index')->with('success', 'Data berhasil diperbarui!');
    }

    // Menghapus data
    public function destroy(Kontak $kontak)
    {
        // Hapus gambar jika ada
        if ($kontak->gambar && file_exists(public_path('images/'.$kontak->gambar))) {
            unlink(public_path('images/'.$kontak->gambar));
        }

        $kontak->delete();

        return redirect()->route('kontak.index')->with('success', 'Data berhasil dihapus!');
    }

}
