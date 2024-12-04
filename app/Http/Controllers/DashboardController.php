<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Model User jika digunakan
use App\Models\Produk; // Tambahkan ini
use App\Models\Visitor;
use App\Models\Kategori;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        $title = "Dashboard";

        // Misalnya Anda ingin mengambil data pengguna yang sedang login
        $user = Auth::user();
        $produkCount = Produk::count();
       // dd($produkCount);
        // Atau jika Anda ingin mengambil semua data pengguna
        // $users = User::all();
        $today = Carbon::today()->toDateString();

        $visitors = Visitor::all();
        $totalVisitCount = Visitor::where('date', $today)->sum('visit_count');
        $total = Visitor ::count();

        $categ = Kategori::pluck('nama_kategori')->toArray();
        $categories = Kategori::withCount('produks')->get();
        //dd($categories);

        // Pengunjung per bulan
        $monthlyVisitors = Visitor::selectRaw('MONTH(created_at) as month, SUM(visit_count) as total_visits')
            ->groupBy('month')
            ->get();

        // Mapping data pengunjung per bulan agar mudah digunakan di view
        $monthlyVisitors = Visitor::selectRaw('MONTH(created_at) as month, SUM(visit_count) as total_visits')
        ->groupBy('month')
        ->get();

    $visitorData = $monthlyVisitors->map(function ($item) {
        return [
            'month' => Carbon::create()->month($item->month)->format('F'),  // Nama bulan
            'total_visits' => $item->total_visits,  // Total pengunjung per bulan
        ];
    });

    return view('dashboard', compact('title', 'user', 'produkCount', 'totalVisitCount', 'total', 'categ', 'categories', 'visitorData'));
}

}
