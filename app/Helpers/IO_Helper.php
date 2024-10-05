<?php

use App\Models\Ranking;
use App\Models\Perhitungan;
use App\Models\SubKriteria;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

function getSub($kriteria)
{
    $query = SubKriteria::where("kriteria_uuid", $kriteria)->get();
    return $query;
}

function getPerhitungan($alternatif, $kriteria)
{
    $query = Perhitungan::where("kriteria_uuid", $kriteria)->where("alternatif_uuid", $alternatif)->first();
    return $query;
}

function getBobotNormalisasi($kriteria, $atribut)
{
    if ($atribut == 'COST') {
        $perhitungan = DB::table('perhitungans as a')
            ->join('alternatifs as b', 'a.alternatif_uuid', '=', 'b.uuid')
            ->select('a.*', 'b.alternatif', 'b.kode')
            ->where('a.kriteria_uuid', $kriteria)
            ->orderBy('a.bobot', 'asc')->first();
    } else {
        $perhitungan = DB::table('perhitungans as a')
            ->join('alternatifs as b', 'a.alternatif_uuid', '=', 'b.uuid')
            ->select('a.*', 'b.alternatif', 'b.kode')
            ->where('a.kriteria_uuid', $kriteria)
            ->orderBy('a.bobot', 'desc')->first();
    }
    return $perhitungan;
}

function inserRanking($nama, $nilai)
{
    Ranking::create([
        'uuid' => Str::orderedUuid(),
        'nama' => $nama,
        'nilai' => $nilai,
    ]);
}
