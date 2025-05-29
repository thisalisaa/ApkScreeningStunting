<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StandarTinggiBadan extends Model
{
    protected $fillable = [
        'jenis_kelamin',
        'usia',
        'L',
        'median',
        'S',
        'SD',
        'SD3neg',
        'SD2neg',
        'SD1neg',
        'SD0',
        'SD1',
        'SD2',
        'SD3',
    ];
}
