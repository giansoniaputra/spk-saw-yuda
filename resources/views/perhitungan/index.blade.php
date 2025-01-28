@extends('layouts.main')
@section('container')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table-perhitungan" class="table table-bordered table-hover dtr-inline" style="overflow:scroll ">
                        <thead>
                            <tr>
                                <th class="text-center" rowspan="2">Alternatif</th>
                                <th class="text-center" rowspan="2">Nama</th>
                                <th class="text-center" colspan="{{ $sum_kriteria }}">Kriteria</th>
                            </tr>
                            <tr>
                                @foreach ($kriterias as $row)
                                <th class="tetx-center">{{ $row->kriteria }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @if($perhitungan->count('a.id') == 0)
                            <tr>
                                <td class="text-center" colspan="{{ ($sum_kriteria < 1) ? 3 : 2 + $sum_kriteria }}">Belum Ada Perhitungan</td>
                            </tr>
                            @else
                            @foreach ($alternatifs as $alternatif)
                            <tr>
                                <td>A{{ $alternatif->kode }}</td>
                                <td>{{ $alternatif->alternatif }}</td>
                                @foreach($kriterias as $kriteria)
                                @php
                                $bobots = DB::table('perhitungans')
                                ->where('kriteria_uuid', $kriteria->uuid)
                                ->where('alternatif_uuid', $alternatif->uuid)
                                ->get();
                                @endphp
                                @foreach($bobots as $bobot)
                                <td class="text-center" id="nilai-bobot">
                                    {{-- <p class="p-bobot">{{ $bobot->bobot }}</p> --}}
                                    <form action="javascript:;" id="form-update-bobot">
                                        {{-- <input type="number" class="form-control input-bobot" data-uuid={{ $bobot->uuid }} value="{{ $bobot->bobot }}" style="width:10vh"> --}}
                                        <div class="mb-3">
                                            <select class="form-select form-select-lg input-bobot" data-uuid={{ $bobot->uuid }}>
                                                @php
                                                $getSubs = getSub($kriteria->uuid);
                                                @endphp
                                                @if($bobot->bobot == 0)
                                                <option value="{{ $bobot->bobot }}" selected disabled>Silahkan Pilih</option>
                                                @foreach ($getSubs as $getSub)
                                                <option value="{{ $getSub->bobot }}">{{ $getSub->sub_kriteria }} ({{ $getSub->bobot }})</option>
                                                @endforeach
                                                @else
                                                @foreach ($getSubs as $getSub)
                                                <option value="{{ $getSub->bobot }}" {{ ($getSub->bobot == $bobot->bobot) ? 'selected' : '' }}>{{ $getSub->sub_kriteria }} ({{ $getSub->bobot }})</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>

                                    </form>
                                </td>
                                @endforeach
                                @endforeach
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" class="text-center">Nilai Bobot</th>
                                @foreach ($kriterias as $kriteria)
                                <th>{{ $kriteria->bobot }}%</th>
                                @endforeach
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                @if($perhitungan->count('a.id') > 0)
                <button class="btn btn-primary float-right" id="cari-keputusan">Cari Keputusan</button>
                @endif
            </div>
        </div>
    </div>
</div>
<div id="normalisasi"></div>
<div id="preferensi"></div>
<div id="ranking"></div>
@endsection
@section('js_after')
<script src="/ex-script/perhitungan.js"></script>
@endsection
