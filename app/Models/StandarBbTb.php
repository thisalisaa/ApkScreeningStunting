<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StandarBbTb extends Model
{
    protected $fillable = [
        'jenis_kelamin',
        'panjang_badan',
        'L',
        'median',
        'S',
        'SD3neg',
        'SD2neg',
        'SD1neg',
        'SD0',
        'SD1',
        'SD2',
        'SD3',
    ];
}
