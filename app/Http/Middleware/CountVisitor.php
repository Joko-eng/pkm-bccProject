<?php

namespace App\Http\Middleware;

use Closure;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitor;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
class CountVisitor
{
    public function handle($request, Closure $next)
    {
        $today = Carbon::today()->toDateString();
        $ipAddress = Request::ip();  // Ambil IP address pengunjung
        $userAgent = $request->header('User-Agent');  // Ambil User-Agent pengunjung (browser)

        // Cek apakah pengunjung dengan kombinasi IP dan User-Agent sudah tercatat hari ini
        $visitor = Visitor::where('date', $today)
                          ->where('ip_address', $ipAddress)
                          ->where('user_agent', $userAgent)
                          ->first();

        if (!$visitor) {
            // Jika belum ada, buat catatan baru
            Visitor::create([
                'date' => $today,
                'visit_count' => 1,
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
            ]);
        }
        $totalVisitCount = Visitor::where('date', $today)->sum('visit_count');

        // Simpan total kunjungan ke dalam session
        session(['totalVisitCount' => $totalVisitCount]);

        return $next($request);
    }
}
