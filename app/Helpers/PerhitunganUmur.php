<?php

namespace App\Helpers;

use Carbon\Carbon;

class PerhitunganUmur
{
    public static function hitungUmurBulanPenuh($tanggalLahir, $filterBulan, $filterTahun)
    {
        $tglLahir = Carbon::parse($tanggalLahir);
        $akhirBulanFilter = Carbon::create($filterTahun, $filterBulan, 1)->endOfMonth();

        if ($tglLahir->gt($akhirBulanFilter)) {
            return '-';
        }

        $selisihBulan = ($akhirBulanFilter->year - $tglLahir->year) * 12 + ($akhirBulanFilter->month - $tglLahir->month);

        if ($akhirBulanFilter->day < $tglLahir->day) {
            $selisihBulan--;
        }

        return $selisihBulan;

    }
}
