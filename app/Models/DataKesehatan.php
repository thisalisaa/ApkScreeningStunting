<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataKesehatan extends Model
{
    protected $fillable = [
        'id_balita',
        'riwayat_penyakit',
        'keterangan_riwayat_penyakit',
        'alergi',
        'keterangan_alergi',
        'bebas_asap_rokok',
        'sumber_air_bersih',
    ];

    // Relasi ke model Balita
    public function balita()
    {
        return $this->belongsTo(Balita::class, 'id_balita');
    }
}
