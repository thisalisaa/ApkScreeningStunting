<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Faktor;


class DataHimpunanFuzzy extends Model
{
    protected $fillable = [
        'id_faktor',
        'nama_himpunan',
        'satuan',
        'batas_bawah',
        'batas_tengah1',
        'batas_tengah2',
        'batas_atas',
        'tipe_fungsi',
        'tipe_input',

    ];

    public function faktor()
    {
        return $this->belongsTo(Faktor::class, 'id_faktor');
    }
}
