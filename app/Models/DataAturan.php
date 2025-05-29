<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataAturan extends Model
{
    protected $fillable = [
        'kode_aturan',
        'range_usia',
        'nilai_faktor',  
        'keputusan',
    ];

    protected $casts = [
        'nilai_faktor' => 'array',
        'range_usia' => 'array',

    ];

}
