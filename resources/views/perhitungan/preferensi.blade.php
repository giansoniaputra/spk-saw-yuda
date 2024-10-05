<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3>Tabel Preferensi</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table-preferensi" class="table table-bordered table-hover dtr-inline" style="overflow:scroll ">
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
                            @foreach ($alternatifs as $alternatif)
                            <tr>
                                <td>A{{ $alternatif->kode }}</td>
                                <td>{{ $alternatif->alternatif }}</td>
                                @php
                                $sum = [];
                                @endphp
                                @foreach($kriterias as $kriteria)
                                @php
                                $bobots = DB::table('perhitungans')
                                ->where('kriteria_uuid', $kriteria->uuid)
                                ->where('alternatif_uuid', $alternatif->uuid)
                                ->get();
                                $perhitungan = getBobotNormalisasi($kriteria->uuid, $kriteria->atribut);
                                @endphp
                                @foreach($bobots as $bobot)
                                <td class="text-center">
                                    @if ($kriteria->atribut == "BENEFIT")
                                    <p class="p-bobot">{{ ($bobot->bobot / $perhitungan->bobot) * ($kriteria->bobot/100) }}</p>
                                    @php
                                    $sum[] = ($bobot->bobot / $perhitungan->bobot) * ($kriteria->bobot/100);
                                    @endphp
                                    @else
                                    <p class="p-bobot">{{ ($perhitungan->bobot / $bobot->bobot) * ($kriteria->bobot/100) }}</p>
                                    @php
                                    $sum[] = ($perhitungan->bobot / $bobot->bobot) * ($kriteria->bobot/100);
                                    @endphp
                                    @endif
                                </td>
                                @endforeach
                                @endforeach
                                @php
                                inserRanking($alternatif->alternatif, array_sum($sum))
                                @endphp
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
</div>
