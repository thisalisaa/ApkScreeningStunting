<?php

namespace App\Models;

use App\Models\Balita;
use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    protected $fillable = [
        'nama_ayah',
        'nama_ibu',
        'no_telepon',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'pendidikan_ayah',
        'pendidikan_ibu',
        'tinggi_badan_ayah',
        'tinggi_badan_ibu',
        'pendapatan_keluarga'
        
    ];

    public function balita()
{
    return $this->hasMany(Balita::class, 'id_orang_tua');
}

}
