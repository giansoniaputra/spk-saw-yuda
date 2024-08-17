<div class="modal fade" id="modal-sub-kriteria" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-alternatifLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-sub">Tambah Sub Kriteria untuk &nbsp;<span id="judul-kriteria"></span></h5>
                <button type="button" class="btn-close" id="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> <!-- end modal header -->
            <div class="modal-body">
                <div class="card">
                    <input type="hidden" id="kriteria_uuid">
                    <div class="card-header">
                        <form action="javascript:;" class="d-inline" id="form-sub-kriteria">
                            <input type="hidden" name="current_uuid" id="current_uuid_sub">
                            @csrf
                            <div class="row">
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="sub_kriteria" id="sub_kriteria" placeholder="Masukan Sub Kriteria">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="bobot" id="bobot-sub" placeholder="Masukan Bobot(%)">
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group mb-3">
                                        <select name="atribut" id="atribut" class="form-control">
                                            <option value="" selected disabled>Pilih Atribut</option>
                                            <option value="COST">COST</option>
                                            <option value="BENEFIT">BENEFIT</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3" id="btn-action-add-sub"></div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <table id="table-sub-kriteria" class="table table-bordered table-hover dataTable dtr-inline">
                            <thead>
                                <th>No</th>
                                <th>Sub Kriteria</th>
                                <th>Atribut</th>
                                <th>bobot</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="btn-action">
            </div>
        </div>
    </div>
</div>
