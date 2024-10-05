<?php

namespace App\Http\Controllers;

use App\Models\Ranking;
use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\Perhitungan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class PerhitunganController extends Controller
{
    public function index()
    {
        $cek = Perhitungan::first();
        if (!$cek) {
            $kriterias = Kriteria::orderBy('kode', 'asc')->get();
            $alternatifs = Alternatif::orderBy('alternatif', 'asc')->get();
            foreach ($alternatifs as $alternatif) {
                foreach ($kriterias as $kriteria) {
                    $data = [
                        'uuid' => Str::orderedUuid(),
                        'alternatif_uuid' => $alternatif->uuid,
                        'kriteria_uuid' => $kriteria->uuid,
                        'bobot' => 0,
                    ];
                    Perhitungan::create($data);
                }
            }
        } else {
            $kriterias = Kriteria::orderBy('kode', 'asc')->get();
            $alternatifs = Alternatif::orderBy('alternatif', 'asc')->get();
            foreach ($alternatifs as $alternatif) {
                $query = Perhitungan::where('alternatif_uuid', $alternatif->uuid)->first();
                if (!$query) {
                    foreach ($kriterias as $kriteria) {
                        $data = [
                            'uuid' => Str::orderedUuid(),
                            'alternatif_uuid' => $alternatif->uuid,
                            'kriteria_uuid' => $kriteria->uuid,
                            'bobot' => 0,
                        ];
                        Perhitungan::create($data);
                    }
                }
            }
            foreach ($kriterias as $kriteria) {
                $query = Perhitungan::where('kriteria_uuid', $kriteria->uuid)->first();
                if (!$query) {
                    foreach ($alternatifs as $alternatif) {
                        $data = [
                            'uuid' => Str::orderedUuid(),
                            'alternatif_uuid' => $alternatif->uuid,
                            'kriteria_uuid' => $kriteria->uuid,
                            'bobot' => 0,
                        ];
                        Perhitungan::create($data);
                    }
                }
            }
        }
        $data = [
            'title' => 'Pengambilan Keputusan',
            'perhitungan' => DB::table('perhitungans as a')
                ->join('alternatifs as b', 'a.alternatif_uuid', '=', 'b.uuid')
                ->select('a.*', 'b.alternatif', 'b.keterangan')
                ->orderBy('b.alternatif', 'asc'),
            'kriterias' => Kriteria::orderBy('kode', 'asc')->get(),
            'alternatifs' => Alternatif::orderBy('kode', 'asc')->get(),
            'sum_kriteria' => Kriteria::count('id'),
        ];
        return view('perhitungan.index', $data);
    }

    public function update(Request $request, Perhitungan $perhitungan)
    {
        $perhitungan->fill($request->all());
        $perhitungan->save();
        return response()->json(['success' => $request->bobot]);
    }

    public function cari_keputusan()
    {
        $data = [
            'title' => 'Table Normalisasi',
            'perhitungan' => DB::table('perhitungans as a')
                ->join('alternatifs as b', 'a.alternatif_uuid', '=', 'b.uuid')
                ->select('a.*', 'b.alternatif', 'b.keterangan')
                ->orderBy('b.alternatif', 'asc'),
            'kriterias' => Kriteria::orderBy('kode', 'asc')->get(),
            'alternatifs' => Alternatif::orderBy('kode', 'asc')->get(),
            'sum_kriteria' => Kriteria::count('id'),
        ];
        Ranking::truncate();
        $view_normalisasi = View::make("perhitungan.normalisasi", $data)->render();
        $view_preferensi = View::make("perhitungan.preferensi", $data)->render();
        $view_ranking = View::make("perhitungan.ranking", [
            'rankings' => Ranking::orderBy('nilai', 'desc')->get(),
        ])->render();

        return response()->json([
            'view_normalisasi' => $view_normalisasi,
            'view_preferensi' => $view_preferensi,
            'view_ranking' => $view_ranking,
        ]);
    }
}
