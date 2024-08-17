@extends('layouts.main')
@section('container')
<div class="row mb-2">
    <div class="col-sm-12">
        <button class="btn btn-primary" id="btn-add-data">Tambah Alternatif</button>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card text-start">
            <div class="card-body">
                <!-- Table Start -->
                <div class="data-table-responsive-wrapper">
                    <table id="table-alternatif" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <thead>
                            <tr>
                                <th class="text-muted text-small text-uppercase">Kode</th>
                                <th class="text-muted text-small text-uppercase">Alternatif</th>
                                <th class="text-muted text-small text-uppercase text-center">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Content End -->
</div>
@include('alternatif.modal-alternatif')
@endsection
@section('js_after')
<script src="/ex-script/alternatif.js"></script>
@endsection
