<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
        $search = $request->input('search');
        // $produks = Produk::paginate(3);
        $produks = Produk::with('kategoris')
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhereHas('kategoris', function ($query) use ($search) {
                        $query->where('nama_kategori', 'like', "%{$search}%");
                    });
            })
            ->paginate(5);

        return view('produk.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('produk.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */



    public function store(Request $request)
    {
        // Log request data yang masuk
        Log::info('Data request diterima:', $request->all());

        // Validasi input
        try {
            $validatedData = $request->validate([
                'nama' => 'required',
                'bahan' => 'required',
                'ukuran' => 'required',
                'deskripsi' => 'required|min:5|',
                'kategori_id' => 'required|integer',
                'image1' => 'required|image|mimes:jpeg,png,jpg,gif|max:12048',
                'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            Log::info('Validasi berhasil:', $validatedData);
        } catch (\Exception $e) {
            Log::error('Validasi gagal:', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }

        // Proses penyimpanan produk
        $produk = new Produk();
        $produk->nama = strtoupper($validatedData['nama']);
        $produk->bahan = $validatedData['bahan'];
        $produk->ukuran = $validatedData['ukuran'];
        $produk->deskripsi = $validatedData['deskripsi'];
        $produk->kategori_id = $validatedData['kategori_id'];

        Log::info('Data produk yang akan disimpan:', $produk->toArray());

        
        $images = ['image1', 'image2', 'image3', 'image4'];
        foreach ($images as $image) {
            if ($request->hasFile($image)) {
                try {
                    $file = $request->file($image);
                    $filename = time() . '_' . $image . '.' . $file->getClientOriginalExtension();
                    $path = 'produk/' . $filename;
                    Storage::drive('public')->put($path, file_get_contents($file));
                    $produk->$image = $path;
                    Log::info('Image uploaded:', ['image' => $image, 'path' => $path, 'filename' => $filename]);
                } catch (\Exception $e) {
                    Log::error('Error uploading ' . $image . ':', ['error' => $e->getMessage()]);
                    return back()->withErrors([$image => 'Gagal mengunggah gambar ' . $image])->withInput();
                }
            } else {
                Log::info($image . ' not uploaded');
            }
        }

        // Simpan produk ke database
        try {
            if ($produk->save()) {
                Log::info('Produk berhasil disimpan:', $produk->toArray());
            } else {
                Log::error('Produk gagal disimpan');
            }
        } catch (\Exception $e) {
            Log::error('Error saving produk:', ['error' => $e->getMessage()]);
        }

        return redirect()->route('produk.index')->with('success', 'Produk ' . $validatedData['nama'] . ' telah ditambahkan');
    }



    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk, $id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::all(); // Jika Anda perlu mengirim kategori ke view
        return view('produk.edit', compact('produk', 'kategori'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk, $id)
    {

        //  dd($request->all());
        $validatedData = $request->validate([
            'nama' => 'required',
            'bahan' => 'required',
            'deskripsi' => 'required|min:5|',
            'kategori_id' => 'required|integer',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $produk = Produk::findOrFail($id);
        $produk->nama = $validatedData['nama'];
        $produk->bahan = $validatedData['bahan'];
        $produk->deskripsi = $validatedData['deskripsi'];
        $produk->kategori_id = $validatedData['kategori_id'];

          
        $images = ['image1', 'image2', 'image3', 'image4'];
        foreach ($images as $image) {
            if ($request->hasFile($image)) {
                try {
                    $file = $request->file($image);
                    $filename = time() . '_' . $image . '.' . $file->getClientOriginalExtension();
                    $path = 'produk/' . $filename;
                    Storage::drive('public')->put($path, file_get_contents($file));
                    $produk->$image = $path;
                    Log::info('Image uploaded:', ['image' => $image, 'path' => $path, 'filename' => $filename]);
                } catch (\Exception $e) {
                    Log::error('Error uploading ' . $image . ':', ['error' => $e->getMessage()]);
                    return back()->withErrors([$image => 'Gagal mengunggah gambar ' . $image])->withInput();
                }
            } else {
                Log::info($image . ' not uploaded');
            }
        }

        $produk->save();

        return redirect()->route('produk.index')->with('success', 'Produk ' . $validatedData['nama'] . ' Telah Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Produk::findOrFail($id);
        $product->delete();
        return redirect()->route('produk.index')->with(['success' => 'Produk Berhasil Dihapus']);
    }
}