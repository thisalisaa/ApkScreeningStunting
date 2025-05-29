<?php

namespace App\Http\Controllers\PetugasPosyandu;

use App\Models\HasilScreening;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HasilScreeningController extends Controller
{
    public function index(Request $request)
{
    $bulan = $request->input('bulan', date('m'));
    $tahun = $request->input('tahun', date('Y'));
    $search = $request->input('search');
    $perPage = $request->input('per_page', 5);
    $tanggalFilter = Carbon::create($tahun, $bulan)->endOfMonth();

    $user = Auth::user();

    $query = HasilScreening::with('dataAntropometri.dataPengukuran.balita')
        ->whereHas('dataAntropometri.dataPengukuran.balita', function ($q) use ($user, $tanggalFilter) {
            $q->where('id_posyandu', $user->id_posyandu)
            ->whereDate('tanggal_lahir', '<=', $tanggalFilter);
        });

    if ($search) {
        $query->whereHas('dataAntropometri.dataPengukuran.balita', function ($q) use ($search) {
            $q->where('nama_balita', 'like', '%' . $search . '%');
        });
    }

    // Filter berdasarkan bulan dan tahun dari tanggal_pengukuran
    $query->whereHas('dataAntropometri.dataPengukuran', function ($q) use ($bulan, $tahun) {
        $q->whereMonth('tanggal_pengukuran', $bulan)
        ->whereYear('tanggal_pengukuran', $tahun);
    });

    $hasilScreenings = $query->orderBy('created_at', 'desc')
        ->paginate($perPage)
        ->appends($request->query());

    return view('pages.PetugasPosyandu.HasilScreening.index', [
        'hasilScreenings' => $hasilScreenings,
        'bulan' => $bulan,
        'tahun' => $tahun,
        'search' => $search,
        'perPage' => $perPage,
    ]);
}

}
