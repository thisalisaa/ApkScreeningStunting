<?php

namespace App\Http\Controllers\PetugasPuskesmas;

use Carbon\Carbon;
use App\Models\Posyandu;
use Illuminate\Http\Request;
use App\Models\DataPengukuran;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LaporanPengukuranController extends Controller
{
    public function index(Request $request)
    {
        $id_puskesmas = Auth::user()->id_puskesmas;

        // Ambil input filter bulan & tahun, default ke bulan & tahun sekarang
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));
        $search = $request->input('search');
        $perPage = $request->input('per_page', 5);

        // Buat rentang tanggal untuk filter pengukuran
        $startDate = Carbon::create($tahun, $bulan, 1)->startOfDay();
        $endDate = Carbon::create($tahun, $bulan, 1)->endOfMonth()->endOfDay();

        // Query Posyandu dengan filter pencarian
        $query = Posyandu::with(['desa', 'balita'])
            ->withCount('balita')
            ->where('id_puskesmas', $id_puskesmas);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_posyandu', 'like', "%{$search}%")
                    ->orWhereHas('desa', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $query->orderBy('nama_posyandu', 'asc');

        // Ambil Posyandu dengan pagination
        $posyandus = $query->paginate($perPage)->appends($request->query());

        // Untuk setiap posyandu, ambil pengukuran terakhir di bulan & tahun yang difilter
        foreach ($posyandus as $posyandu) {
            $status = $posyandu->pengukurans()
                ->whereBetween('tanggal_pengukuran', [$startDate, $endDate])
                ->orderByDesc('tanggal_pengukuran')
                ->first();
            $posyandu->latest_status = $status;
        }

        return view('pages.PetugasPuskesmas.LaporanPengukuran.index', compact('posyandus', 'bulan', 'tahun', 'search', 'perPage'));
    }


    public function show(Request $request)
    {
        $id_puskesmas = Auth::user()->id_puskesmas;
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));


        $posyanduIds = Posyandu::where('id_puskesmas', $id_puskesmas)->pluck('id');

        $dataPengukuran = DataPengukuran::with(['balita', 'balita.posyandu'])
            ->whereHas('balita', function ($query) use ($posyanduIds) {
                $query->whereIn('id_posyandu', $posyanduIds);
            })
            ->when($bulan, function ($query) use ($bulan) {
                $query->whereMonth('tanggal_pengukuran', $bulan);
            })
            ->when($tahun, function ($query) use ($tahun) {
                $query->whereYear('tanggal_pengukuran', $tahun);
            })
            ->orderBy('tanggal_pengukuran', 'desc')
            ->paginate(10);

        return view('pages.PetugasPuskesmas.LaporanPengukuran.show', compact('dataPengukuran', 'bulan', 'tahun'));
    }



    public function detail($id)
    {
        $pengukuran = DataPengukuran::with(['balita', 'balita.posyandu'])->findOrFail($id);
        return view('pages.PetugasPuskesmas.LaporanPengukuran.detail', compact('pengukuran'));
    }

    public function verifikasi(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'catatan' => 'array',
            'action' => 'required|in:verifikasi,rejected',
        ]);

        foreach ($request->ids as $id) {
            $data = DataPengukuran::find($id);
            if ($data) {
                $data->status_verifikasi = $request->action == 'verifikasi' ? 'verified' : 'rejected';
                $data->catatan = $request->catatan[$id] ?? null;
                $data->verified_by = auth()->id();
                $data->verified_at = now();
                $data->save();
            }
        }

        return redirect()->back()->with('success', 'Data pengukuran berhasil diverifikasi.');
    }
}
