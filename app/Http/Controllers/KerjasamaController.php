<?php

namespace App\Http\Controllers;

use App\Models\Kerjasama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KerjasamaController extends Controller
{
    public function index()
    {
        $kerjasamas = Kerjasama::all();

        return view('welcome', compact('kerjasamas')); // Pastikan ini ada
    }


public function index2()
{
    // $contact = Kerjasama::;
    $kerjasamas = Kerjasama::paginate(5);
    return view('kerjasama.index', compact('kerjasamas'));
}


    public function create()
    {
        return view('kerjasama.create');
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:11048',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'kerjasama/' . $filename;

            Storage::disk('public')->put($path, file_get_contents($file));
        }

        Kerjasama::create([
            'nama_instansi' => $request->nama_instansi,
            'gambar' => $path,
        ]);

        return redirect()->route('kerjasama.index')->with('success', 'Data berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit data
    public function edit($id)
    {
        $kerjasama = Kerjasama::findOrFail($id);
        return view('kerjasama.edit', compact('kerjasama'));
    }


    // Memperbarui data yang ada
    public function update(Request $request, Kerjasama $kerjasama)
    {
        $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($kerjasama->gambar && Storage::disk('public')->exists('kerjasama/' . $kerjasama->gambar)) {
                Storage::disk('public')->delete('kerjasama/' . $kerjasama->gambar);
            }

            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = Storage::disk('public')->putFileAs('artikel', $file, $filename);
        }

        $kerjasama->update([
            'nama_instansi' => $request->nama_instansi,
            'gambar' => $path,
        ]);

        return redirect()->route('kerjasama.index')->with('success', 'Data berhasil diperbarui!');
    }

    // Menghapus data
    public function destroy(Kerjasama $kerjasama)
    {
        // Hapus gambar jika ada
        if ($kerjasama->gambar && file_exists(public_path('images/'.$kerjasama->gambar))) {
            unlink(public_path('images/'.$kerjasama->gambar));
        }

        $kerjasama->delete();

        return redirect()->route('kerjasama.index')->with('success', 'Data berhasil dihapus!');
    }

}
