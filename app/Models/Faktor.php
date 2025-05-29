<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DataHimpunanFuzzy;


class Faktor extends Model
{
    use HasFactory;

    protected $fillable = ['kode_faktor', 'nama_faktor'];

    protected $casts = [
        'range_usia' => 'array',
    ];

    public function himpunanFuzzy()
    {
        return $this->hasMany(DataHimpunanFuzzy::class, 'id_faktor');
    }
}
