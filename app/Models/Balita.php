<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\OrangTua;
use App\Models\Posyandu;
use App\Models\DataKesehatan;
use App\Models\DataPengukuran;


class Balita extends Model
{
    protected $fillable = [
        'id_orang_tua',
        'id_posyandu',
        'nama_balita',
        'nik_balita',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'berat_badan_lahir',
        'panjang_badan_lahir',
    ];

    // Relasi dengan model OrangTua (satu balita memiliki satu orang tua)
    public function orangTua()
    {
        return $this->belongsTo(OrangTua::class, 'id_orang_tua');
    }

    // Relasi dengan model Posyandu (satu balita memiliki satu posyandu)
    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'id_posyandu');
    }

    // Relasi ke model Data Kesehatan (One to One)
    public function dataKesehatan()
    {
        return $this->hasOne(DataKesehatan::class, 'id_balita');
    }

    public function datapengukuran()
    {
        return $this->hasMany(DataPengukuran::class, 'id_balita');
    }

    


}





