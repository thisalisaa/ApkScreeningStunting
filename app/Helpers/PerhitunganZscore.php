<?php

namespace App\Helpers;

use App\Models\StandarBeratBadan;
use App\Models\StandarTinggiBadan;
use App\Models\StandarBbTb;


class PerhitunganZscore
{
    // Hitung Z-Score BB/U
    public function calculateZScoreBBU($berat, $usia_bulan, $jenis_kelamin)
    {
        $standar = StandarBeratBadan::where('usia', $usia_bulan)
            ->where('jenis_kelamin', $jenis_kelamin)
            ->first();

        if (!$standar) return null;

        $median = $standar->median;
        $sdNeg = $standar->SD1neg;
        $sdPos = $standar->SD1;

        if ($berat < $median) {
            // Jika berat badan kurang dari median
            $zScore = ($berat - $median) / ($median - $sdNeg);
        } else {
            // Jika berat badan lebih dari median
            $zScore = ($berat - $median) / ($sdPos - $median);
        }

        return $zScore;
    }

    // Hitung Z-Score TB/U
    public function calculateZScoreTBU($tinggi, $usia_bulan, $jenis_kelamin)
    {
        $standar = StandarTinggiBadan::where('usia', $usia_bulan)
            ->where('jenis_kelamin', $jenis_kelamin)
            ->first();

        if (!$standar) return null;

        $median = $standar->median;
        $sdNeg = $standar->SD1neg;
        $sdPos = $standar->SD1;

        if ($tinggi < $median) {
            // Jika tinggi badan kurang dari median
            $zScore = ($tinggi - $median) / ($median - $sdNeg);
        } else {
            // Jika tinggi badan lebih dari median
            $zScore = ($tinggi - $median) / ($sdPos - $median);
        }

        return $zScore;
    }

    // Estimasi Z-score BB/TB (dari BMI)
    public function calculateZScoreBBTB($berat, $tinggi, $jenis_kelamin)
    {
        $standar = StandarBbTb::where('panjang_badan', $tinggi)
            ->where('jenis_kelamin', $jenis_kelamin)
            ->first();

        if (!$standar) return null;

        $median = $standar->median;
        $sdNeg = $standar->SD1neg;
        $sdPos = $standar->SD1;

        if ($berat < $median) {
            $zScore = ($berat - $median) / ($median - $sdNeg);
        } else {
            $zScore = ($berat - $median) / ($sdPos - $median);
        }

        return $zScore;
    }


    public function getStatusBBU($zScore)
    {
        if (is_null($zScore)) return null;

        if ($zScore < -3) {
            return 'sangat kurang';
        } elseif ($zScore >= -3 && $zScore < -2) {
            return 'kurang';
        } elseif ($zScore >= -2 && $zScore <= 1) {
            return 'normal';
        } else {
            return 'berat lebih';
        }
    }


    public function getStatusTBU($zScore)
    {
        if (is_null($zScore)) return null;

        if ($zScore < -3) {
            return 'sangat pendek';
        } elseif ($zScore >= -3 && $zScore < -2) {
            return 'pendek';
        } elseif ($zScore >= -2 && $zScore <= 3) {
            return 'normal';
        } else {
            return 'tinggi';
        }
    }

    public function getStatusBBTB($zScore)
    {
        if (is_null($zScore)) return null;

        if ($zScore < -3) {
            return 'gizi buruk';
        } elseif ($zScore >= -3 && $zScore < -2) {
            return 'gizi kurang';
        } elseif ($zScore >= -2 && $zScore <= 1) {
            return 'gizi baik';
        } elseif ($zScore > 1 && $zScore <= 2) {
            return 'berisiko gizi lebih';
        } elseif ($zScore > 2 && $zScore <= 3) {
            return 'gizi lebih';
        } else {
            return 'obesitas';
        }
    }


    public function getStatusStunting($zScoreTBU)
    {
        if (is_null($zScoreTBU)) return null;

        if ($zScoreTBU < -2) {
            return 'stunting';
        } elseif ($zScoreTBU >= -2 && $zScoreTBU < -1) {
            return 'beresiko';
        } else {
            return 'normal';
        }
    }

    public function calculateRiskPercentage($zScoreTBU)
    {
        if (is_null($zScoreTBU)) return null;

        if ($zScoreTBU < -3) {
            return 90;
        } elseif ($zScoreTBU >= -3 && $zScoreTBU < -2) {
            return 60;
        } elseif ($zScoreTBU >= -2 && $zScoreTBU < -1) {
            return 30;
        } else {
            return 10;
        }
    }
}
