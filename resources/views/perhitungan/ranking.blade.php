<div class="row mb-2">
    <div class="col">
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3>Table Ranking</h3>
            </div>
            <div class="card-body">
                <table id="table-kriteria" class="table table-bordered table-hover dataTable dtr-inline">
                    <thead>
                        <tr>
                            <th>Ranking</th>
                            <th>Nama</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rankings as $ranking)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $ranking->nama }}</td>
                            <td>{{ $ranking->nilai }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a href="/ranking" target="_blank" class="btn btn-primary">Cetak Hasil</a>
            </div>
        </div>
    </div>
</div>
