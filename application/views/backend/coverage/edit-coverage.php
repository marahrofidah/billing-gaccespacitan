<div class="row">

    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold"><?= $title; ?></h6>
            </div>
            <?php echo form_open_multipart('') ?>
            <div class="card-body">
                <input type="hidden" name="coverage_id" id="coverage_id" class="form-control" autocapitalize="off" value="<?= $coverage['coverage_id'] ?>">
                <div class="form-group">
                    <label for="name">Kode Area</label>
                    <input type="number" name="code_area" id="code_area" class="form-control" autocapitalize="off" value="<?= $coverage['code_area'] ?>">
                </div>
                <?= form_error('code_area', '<small class="text-danger pl-3 ">', '</small>') ?>
                <div class="form-group">
                    <label for="name">Nama Area</label>
                    <input type="text" name="name" id="name" class="form-control" autocapitalize="off" value="<?= $coverage['c_name'] ?>">
                </div>
                <div class="form-group">
                    <label for="public">Tampilkan di halaman Register</label>
                    <select name="public" class="form-control" id="public" required>
                        <option value="<?= $coverage['public']; ?>"><?= $coverage['public'] == 1 ? 'Yes' : 'No'; ?></option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <input type="text" name="address" id="address" class="form-control" autocapitalize="off" value="<?= $coverage['address'] ?>">
                </div>

                <div class="form-group">
                    <label for="comment">Keterangan</label>
                    <input type="text" name="comment" id="comment" class="form-control" autocapitalize="off" autocomplete="off" value="<?= $coverage['comment'] ?>">
                </div>


                <div class="form-group">

                    <label for="radius">Radius</label>

                    <div class="input-group mb-3">
                        <input type="number" id="radius" name="radius" class="form-control" value="<?= $coverage['radius'] ?>" onchange="NoServices()">
                        <div class="input-group-append">
                            <span class="input-group-text">Meter</span>
                        </div>
                    </div>


                </div>


                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Reset</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="row">

            <div class="col-lg-12">
                <div id="mapid"></div>
            </div>

        </div>
    </div>
</div>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
    });
    var ajaxku = buatajax();

    function ajaxkota(id) {
        var url = "<?= base_url('') ?>coverage/getKab/" + id + "/" + Math.random();
        ajaxku.onreadystatechange = stateChanged;
        ajaxku.open("GET", url, true);
        ajaxku.send(null);
    }

    function ajaxkec(id) {
        var url = "<?= base_url('') ?>coverage/getKec/" + id + "/" + Math.random();
        ajaxku.onreadystatechange = stateChangedKec;
        ajaxku.open("GET", url, true);
        ajaxku.send(null);
    }

    function ajaxkel(id) {
        var url = "<?= base_url('') ?>coverage/getKel/" + id + "/" + Math.random();
        ajaxku.onreadystatechange = stateChangedKel;
        ajaxku.open("GET", url, true);
        ajaxku.send(null);
    }

    function buatajax() {
        if (window.XMLHttpRequest) {
            return new XMLHttpRequest();
        }
        if (window.ActiveXObject) {
            return new ActiveXObject("Microsoft.XMLHTTP");
        }
        return null;
    }

    function stateChanged() {
        var data;
        if (ajaxku.readyState == 4) {
            data = ajaxku.responseText;
            if (data.length >= 0) {
                document.getElementById("kota").innerHTML = data
            } else {
                document.getElementById("kota").value = "<option selected>Pilih Kota/Kab</option>";
            }
            document.getElementById("kab_box").style.display = 'table-row';
            document.getElementById("kec_box").style.display = 'none';
            document.getElementById("kel_box").style.display = 'none';
        }
    }

    function stateChangedKec() {
        var data;
        if (ajaxku.readyState == 4) {
            data = ajaxku.responseText;
            if (data.length >= 0) {
                document.getElementById("kec").innerHTML = data
            } else {
                document.getElementById("kec").value = "<option selected>Pilih Kecamatan</option>";
            }
            document.getElementById("kec_box").style.display = 'table-row';
            document.getElementById("kel_box").style.display = 'none';
        }
    }

    function stateChangedKel() {
        var data;
        if (ajaxku.readyState == 4) {
            data = ajaxku.responseText;
            if (data.length >= 0) {
                document.getElementById("kel").innerHTML = data
            } else {
                document.getElementById("kel").value = "<option selected>Pilih Kelurahan/Desa</option>";
            }
            document.getElementById("kel_box").style.display = 'table-row';

        }
    }
</script>



<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->