<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Carbon\Carbon;
use App\Models\Balita;
use App\Models\DataPengukuran;
use App\Models\HasilScreening;
use App\Models\DataAntropometri;
use App\Helpers\PerhitunganZscore;
use App\Helpers\PerhitunganUmur;

class DataPengukuranImport implements ToCollection, WithStartRow, WithValidation
{
    protected $posyandu_id;
    protected $tanggal_pengukuran;
    protected $errors = [];
    protected $zscoreHelper;
    protected $filterBulan;
    protected $filterTahun;


    public function __construct()
    {
        // Ambil id_posyandu dari user yang login
        $this->posyandu_id = Auth::user()->id_posyandu;
        $this->tanggal_pengukuran = Carbon::now()->format('Y-m-d');
        $this->zscoreHelper = new PerhitunganZscore();
    }

    public function setPosyanduId($posyandu_id)
    {
        $this->posyandu_id = $posyandu_id;
        return $this;
    }

    public function setTanggalPengukuran($tanggal)
    {
        $this->tanggal_pengukuran = Carbon::parse($tanggal)->format('Y-m-d');
        return $this;
    }

    public function setFilterBulanTahun($bulan, $tahun)
    {
        $this->filterBulan = $bulan;
        $this->filterTahun = $tahun;
        return $this;
    }

    // Mulai membaca dari baris ke-5
    public function startRow(): int
    {
        return 5;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $rowIndex => $row) {
            $rowNumber = $rowIndex + $this->startRow();

            if (empty($row[1])) continue;

            $nama_balita = $row[1];

            // Cari balita berdasarkan nama dan posyandu
            $balita = Balita::where('nama_balita', $nama_balita)
                ->where('id_posyandu', $this->posyandu_id)
                ->first();

            if (!$balita) {
                $this->errors[] = "Baris $rowNumber: Balita dengan nama '$nama_balita' tidak ditemukan.";
                continue;
            }

            // Ambil data input dari Excel
            $tinggi = !empty($row[3]) ? floatval($row[3]) : null;
            $berat = !empty($row[4]) ? floatval($row[4]) : null;
            $asi_ekslusif = isset($row[5]) ? intval($row[5]) : null;
            $mpasi = isset($row[6]) ? intval($row[6]) : null;

            // Validasi nilai boolean (0 atau 1)
            if (!is_null($asi_ekslusif) && !in_array($asi_ekslusif, [0, 1])) {
                $this->errors[] = "Baris $rowNumber: Nilai ASI Ekslusif harus 0 atau 1.";
                $asi_ekslusif = null;
            }

            if (!is_null($mpasi) && !in_array($mpasi, [0, 1])) {
                $this->errors[] = "Baris $rowNumber: Nilai MPASI harus 0 atau 1.";
                $mpasi = null;
            }

            $tanggal_lahir = $balita->tanggal_lahir;
            $bulan = $this->filterBulan ?? Carbon::now()->month;
            $tahun = $this->filterTahun ?? Carbon::now()->year;
            $usia_bulan = PerhitunganUmur::hitungUmurBulanPenuh($tanggal_lahir, $bulan, $tahun);


            try {
                $pengukuran = DataPengukuran::where('id_balita', $balita->id)
                    ->whereMonth('tanggal_pengukuran', Carbon::parse($this->tanggal_pengukuran)->month)
                    ->whereYear('tanggal_pengukuran', Carbon::parse($this->tanggal_pengukuran)->year)
                    ->first();


                // Simpan data pengukuran baru
                $pengukuran = DataPengukuran::create([
                    'id_balita' => $balita->id,
                    'tanggal_pengukuran' => $this->tanggal_pengukuran,
                    'usia_bulan' => $usia_bulan,
                    'tinggi_badan' => $tinggi,
                    'berat_badan' => $berat,
                    'asi_ekslusif' => $asi_ekslusif,
                    'mpasi' => $mpasi,
                    'status_verifikasi' => 'to review',
                    'catatan' => null, 
                ]);

                // Hitung dan simpan Z-Score serta hasil screening jika data tinggi dan berat valid
                if (!is_null($tinggi) && !is_null($berat) && $tinggi > 0 && $berat > 0) {
                    $z_score_bb_u = $this->zscoreHelper->calculateZScoreBBU($berat, $usia_bulan, $balita->jenis_kelamin);
                    $z_score_tb_u = $this->zscoreHelper->calculateZScoreTBU($tinggi, $usia_bulan, $balita->jenis_kelamin);
                    $z_score_bb_tb = $this->zscoreHelper->calculateZScoreBBTB($berat, $tinggi, $balita->jenis_kelamin);

                    $dataAntropometri = new DataAntropometri([
                        'data_pengukuran_id' => $pengukuran->id,
                        'z_score_bb_u' => $z_score_bb_u,
                        'z_score_tb_u' => $z_score_tb_u,
                        'z_score_bb_tb' => $z_score_bb_tb,
                    ]);
                    $dataAntropometri->save();

                    // Hitung status dan presentase risiko stunting
                    $status_bb_u = $this->zscoreHelper->getStatusBBU($z_score_bb_u) ?? '-';
                    $status_tb_u = $this->zscoreHelper->getStatusTBU($z_score_tb_u) ?? '-';
                    $status_bb_tb = $this->zscoreHelper->getStatusBBTB($z_score_bb_tb) ?? '-';
                    $status_stunting = $this->zscoreHelper->getStatusStunting($z_score_tb_u) ?? '-';
                    $presentase_resiko = $this->zscoreHelper->calculateRiskPercentage($z_score_tb_u) ?? 0;

                    $hasilScreening = new HasilScreening([
                        'data_antropometri_id' => $dataAntropometri->id,
                        'status_bb_u' => $status_bb_u,
                        'status_tb_u' => $status_tb_u,
                        'status_bb_tb' => $status_bb_tb,
                        'status_stunting' => $status_stunting,
                        'presentase_resiko_stunting' => $presentase_resiko,
                    ]);
                    $hasilScreening->save();
                }
            } catch (\Exception $e) {
                $this->errors[] = "Baris $rowNumber: Error saat menyimpan data - " . $e->getMessage();
            }
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function rules(): array
    {
        return [
            '3' => 'nullable|numeric|min:0', // tinggi badan
            '4' => 'nullable|numeric|min:0', // berat badan
            '5' => 'nullable|in:0,1',        // asi ekslusif
            '6' => 'nullable|in:0,1',        // mpasi
        ];
    }

    public function customValidationMessages()
    {
        return [
            '3.numeric' => 'Tinggi badan harus berupa angka.',
            '3.min' => 'Tinggi badan tidak boleh negatif.',
            '4.numeric' => 'Berat badan harus berupa angka.',
            '4.min' => 'Berat badan tidak boleh negatif.',
            '5.in' => 'ASI Ekslusif harus bernilai 0 atau 1.',
            '6.in' => 'MPASI harus bernilai 0 atau 1.',
        ];
    }
}
