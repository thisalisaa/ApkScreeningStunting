<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;

class Puskesmas extends Model
{
    use HasFactory;

    protected $table = 'puskesmas';

    protected $fillable = ['nama_puskesmas', 'id_kecamatan', 'id_desa'];

    public function kecamatan()
    {
        return $this->belongsTo(District::class, 'id_kecamatan', 'id');
    }

    public function desa()
    {
        return $this->belongsTo(Village::class, 'id_desa', 'id');
    }
}
