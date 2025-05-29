<?php

namespace App\Models;

use App\Models\Balita;
use App\Models\DataAntropometri;
use App\Models\VerifikasiPengukuran;
use Illuminate\Database\Eloquent\Model;

class DataPengukuran extends Model
{
    protected $fillable = [
        'id_balita',
        'tanggal_pengukuran',
        'status_verifikasi',
        'verified_by',
        'verified_at',
        'catatan',
        'usia_bulan',
        'tinggi_badan',
        'berat_badan',
        'asi_ekslusif',
        'mpasi',
    ];

    public function balita()
    {
        return $this->belongsTo(Balita::class, 'id_balita');
    }

    public function dataAntropometri()
    {
        return $this->hasOne(DataAntropometri::class, 'data_pengukuran_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }




}
