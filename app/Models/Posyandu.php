<?php

namespace App\Models;

use App\Models\Balita;
use App\Models\Puskesmas;
use App\Models\DataPengukuran;
use Laravolt\Indonesia\Models\Village;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\District;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Posyandu extends Model
{
    use HasFactory;

    protected $table = 'posyandus';

    protected $fillable = [
        'nama_posyandu',
        'id_puskesmas',
        'id_kecamatan',
        'id_desa',
        'alamat',
    ];

    public function puskesmas()
    {
        return $this->belongsTo(Puskesmas::class, 'id_puskesmas');
    }

    public function kecamatan()
    {
        return $this->belongsTo(District::class, 'id_kecamatan', 'id');
    }

    public function desa()
    {
        return $this->belongsTo(Village::class, 'id_desa', 'id');
    }

    public function balita()
    {
        return $this->hasMany(Balita::class, 'id_posyandu');
    }

    public function pengukurans()
    {
        return $this->hasManyThrough(
            DataPengukuran::class,
            Balita::class,
            'id_posyandu',
            'id_balita',
            'id',
            'id'
        );
    }
}
