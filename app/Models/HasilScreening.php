<?php

namespace App\Models;

use App\Models\DataAntropometri;
use Illuminate\Database\Eloquent\Model;

class HasilScreening extends Model
{
    protected $fillable = [
        'data_antropometri_id',
        'status_bb_u',
        'status_tb_u',
        'status_bb_tb',
        'status_stunting',
        'presentase_resiko_stunting',
    ];

    public function dataAntropometri()
    {
        return $this->belongsTo(DataAntropometri::class, 'data_antropometri_id');
    }
}
