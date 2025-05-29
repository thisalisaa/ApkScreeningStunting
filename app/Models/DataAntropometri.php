<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataAntropometri extends Model
{
    protected $fillable = [
        'data_pengukuran_id',
        'z_score_bb_u',
        'z_score_tb_u',
        'z_score_bb_tb',
    ];

    public function datapengukuran()
    {
        return $this->belongsTo(DataPengukuran::class, 'data_pengukuran_id');
    }

    public function hasilScreening()
    {
        return $this->hasOne(HasilScreening::class, 'data_antropometri_id');
    }
}
