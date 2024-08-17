<div class="modal fade" id="modal-kriteria" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-alternatifLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="btn-close" id="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> <!-- end modal header -->
            <div class="modal-body">
                <form action="javascript:;" id="form-kriteria">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">C</span>
                        </div>
                        <input type="number" id="kode" name="kode" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="kriteria">Kriteria</label>
                        <input type="text" id="kriteria" name="kriteria" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="atribut">Atribut</label>
                        <select name="atribut" id="atribut" class="form-select">
                            <option value="" disabled selected>Pilih Atribut</option>
                            <option value="COST">COST</option>
                            <option value="BENEFIT">BENEFIT</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="bobot">Bobot</label>
                        <input type="text" id="bobot" name="bobot" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer" id="btn-action">
            </div>
        </div>
    </div>
</div>
