<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::paginate(5);
        return view('Artikel.index', compact('artikels'));
    }

    public function create()
    {
        $currentDate = Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY');
        $namaPublished = Auth::user()->name;

        return view('Artikel.create', [
            'currentDate' => $currentDate,
            'namaPublished' => $namaPublished
        ]);
    }

    public function store(Request $request)
    {
        Log::info('Request data:', $request->all());

        $request->validate([
            'judul' => 'required|string',
            'konten' => 'required|string|max:4294967295',
            'tgl_published' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:11048',
        ]);

        $namaPublished = Auth::user()->name; // Ambil nama user yang login
        Log::info('User published:', ['name' => $namaPublished]);

        $daysInIndonesian = [
            'Senin' => 'Monday',
            'Selasa' => 'Tuesday',
            'Rabu' => 'Wednesday',
            'Kamis' => 'Thursday',
            'Jumat' => 'Friday',
            'Sabtu' => 'Saturday',
            'Minggu' => 'Sunday'
        ];

        $monthsInIndonesian = [
            'Januari' => 'January',
            'Februari' => 'February',
            'Maret' => 'March',
            'April' => 'April',
            'Mei' => 'May',
            'Juni' => 'June',
            'Juli' => 'July',
            'Agustus' => 'August',
            'September' => 'September',
            'Oktober' => 'October',
            'November' => 'November',
            'Desember' => 'December',
        ];

        $tgl_published = $request->tgl_published;

        foreach ($daysInIndonesian as $indonesian => $english) {
            if (strpos($tgl_published, $indonesian) !== false) {
                $tgl_published = str_replace($indonesian, $english, $tgl_published);
                break;
            }
        }

        foreach ($monthsInIndonesian as $indonesian => $english) {
            if (strpos($tgl_published, $indonesian) !== false) {
                $tgl_published = str_replace($indonesian, $english, $tgl_published);
                break;
            }
        }

        Log::info('Converted date:', ['original' => $request->tgl_published, 'converted' => $tgl_published]);

        try {
            $tgl_published = Carbon::createFromFormat('l, d F Y', $tgl_published)->format('Y-m-d');
        } catch (\Exception $e) {
            Log::error('Date format error:', ['message' => $e->getMessage()]);
            return back()->withErrors(['tgl_published' => 'Format tanggal tidak valid'])->withInput();
        }

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'artikel/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($file));

            Log::info('Image uploaded:', ['path' => $path, 'filename' => $filename]);
        } else {
            Log::warning('No image uploaded');
            return back()->withErrors(['gambar' => 'Gambar harus diunggah'])->withInput();
        }


        $artikel = new Artikel;
        $artikel->judul = $request->input('judul');
        $artikel->konten = $request->input('konten');
        $artikel->tgl_published = $tgl_published;
        $artikel->nama_published = $namaPublished;
        $artikel->gambar = $path;

        $artikel->save();
        Log::info('Artikel saved:', ['judul' => $artikel->judul, 'id' => $artikel->id]);

        return redirect()->route('Artikel.index')->with('success', 'Artikel berhasil ditambahkan');
    }

    public function edit(Artikel $artikel)
    {
        return view('Artikel.edit', compact('artikel'));
    }

    public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
            'judul' => 'required|string',
            'konten' => 'required|string|max:4294967295',
            'tgl_published' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:11048',
        ]);

        $tgl_published = $request->input('tgl_published');

        try {
            $tgl_published = Carbon::createFromFormat('Y-m-d', $tgl_published)->format('Y-m-d');
        } catch (\Exception $e) {
            return back()->withErrors(['tgl_published' => 'Format tanggal tidak valid'])->withInput();
        }

        if ($request->hasFile('gambar')) {

            $request->validate([
                'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);


            if ($artikel->gambar && Storage::disk('public')->exists('artikel/' . $artikel->gambar)) {
                Storage::disk('public')->delete('artikel/' . $artikel->gambar);
            }

            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = Storage::disk('public')->putFileAs('artikel', $file, $filename);


            Log::info('Image uploaded:', ['filename' => $filename]);
        } else {
            $filename = $artikel->gambar;
        }

        $artikel->update([
            'judul' => $request->input('judul'),
            'konten' => $request->input('konten'),
            'tgl_published' => $tgl_published,
            'nama_published' => Auth::user()->name,
            'gambar' => $path,
        ]);

        return redirect()->route('Artikel.index')->with('success', 'Artikel berhasil diperbarui');
    }

    public function destroy(Artikel $artikel)
    {
        $filePath = public_path('upload/artikel/' . $artikel->gambar);

        if (file_exists($filePath) && !is_dir($filePath)) {
            unlink($filePath);
        } else {
            // dd('File does not exist or is a directory: ' . $filePath);
        }

        $artikel->delete();

        return redirect()->route('Artikel.index')->with('success', 'Artikel berhasil dihapus');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $artikels = Artikel::where('judul', 'like', "%$query%")
            ->paginate(10);

        return view('Artikel.index', compact('artikels', 'query'));
    }

    public function uploadImageSummernote(Request $request, $type)
    {
        $post = $request->all();
        $post['type'] = 'summernote';

        // Validasi ukuran file (maksimum 5MB)
        $size = $request->file->getSize();
        if ($size > 10000000) {
            return ['status' => false, 'messages' => ['Image Size Exceeded 10MB']];
        }

        // Tentukan ekstensi dan nama file
        $ext = $request->file->getClientOriginalExtension();
        $filename = 'summernote_image_' . time() . '.' . $ext;
        $path = 'upload/' . $filename;

        // Pindahkan file ke direktori public/upload
        $request->file->move(public_path('upload'), $filename);

        // Cek apakah file berhasil disimpan
        if (file_exists(public_path($path))) {
            return [
                "status" => "success",
                "path" => $path,
                "image" => $filename,
                "image_url" => url($path)
            ];
        } else {
            return [
                "status" => "fail"
            ];
        }
    }

    public function deleteImageSummernote(Request $request, $type)
    {
        // Pastikan 'target' ada di request
        if (!$request->has('target')) {
            return response()->json(['status' => false, 'message' => 'Target tidak ditemukan'], 400);
        }

        // Memisahkan URL dan mengambil nama file dari 'target'
        $arrayUrl = array_filter(explode('/', $request->target));
        $fileName = end($arrayUrl);
        $path = public_path('upload/' . $fileName);

        // Cek apakah file ada dan hapus
        if (file_exists($path)) {
            unlink($path); // Menghapus file

            return response()->json(['status' => true, 'message' => 'Gambar berhasil dihapus']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gambar tidak ditemukan'], 404);
        }
    }
}