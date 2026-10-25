<div class="row">

    <?php $this->view('messages') ?>

    <div class="col-lg-6">

        <div class="card shadow mb-4">

            <div class="card-header py-3">

                <h6 class="m-0 font-weight-bold"><?= $title; ?></h6>

            </div>

            <?php echo form_open_multipart('') ?>

            <div class="card-body">

                <input type="hidden" name="id_odp" id="id_odp" class="form-control" autocapitalize="off" value="<?= $odp['id_odp'] ?>">

                <div class="form-group">

                    <label for="">Kode ODC</label>

                    <select name="code_odc" class="form-control select2" style="width: 100%;" required>

                        <?php if ($odp['code_odc'] != 0) { ?>

                            <?php $dataodc = $this->db->get_where('m_odc', ['id_odc' => $odp['code_odc']])->row_array(); ?>

                            <option value="<?= $odp['code_odc'] ?>"><?= $dataodc['code_odc'] ?> </option>

                            <?php foreach ($odc as $data) { ?>

                                <option value="<?= $data->id_odc ?>"><?= $data->code_odc ?></option>

                            <?php } ?>

                        <?php } ?>

                        <?php if ($odp['code_odc'] == 0) { ?>

                            <option value="">-Pilih-</option>

                            <?php foreach ($odc as $data) { ?>

                                <option value="<?= $data->id_odc ?>"><?= $data->code_odc ?></option>

                            <?php } ?>

                        <?php } ?>

                    </select>

                </div>

                <div class="form-group">

                    <label for="name">Kode ODP</label>

                    <input type="text" name="code_odp" id="code_odp" class="form-control" autocapitalize="off" value="<?= $odp['code_odp'] ?>">

                    <?= form_error('code_odp', '<small class="text-danger pl-3 ">', '</small>') ?>

                </div>



                <div class="form-group">

                    <label for="">Wilayah odp</label>

                    <select name="coverage_odp" class="form-control select2" style="width: 100%;" required>

                        <?php if ($odp['coverage_odp'] != '') { ?>

                            <?php $datacoverage = $this->db->get_where('coverage', ['coverage_id' => $odp['coverage_odp']])->row_array(); ?>

                            <option value="<?= $odp['coverage_odp'] ?>"><?= $datacoverage['code_area'] ?> - <?= $datacoverage['c_name'] ?></option>

                        <?php } ?>

                        <option value="">-Pilih-</option>

                        <?php foreach ($coverage as $data) { ?>

                            <option value="<?= $data->coverage_id ?>"><?= $data->code_area ?> - <?= $data->c_name ?></option>

                        <?php } ?>

                    </select>

                </div>

                <div class="form-group">

                    <label for="">Nomor Port ODC</label>

                    <input type="number" class="form-control" name="no_port_odc" autocomplete="off" value="<?= $odp['no_port_odc'] ?>">

                </div>

                <div class="form-group">

                    <label for="">Warna Tube FO</label>

                    <input type="text" class="form-control" name="color_tube_fo" autocomplete="off" value="<?= $odp['color_tube_fo'] ?>">

                </div>

                <div class="form-group">

                    <label for="">Nomor Tiang</label>

                    <input type="text" class="form-control" name="no_pole" value="<?= $odp['no_pole'] ?>" autocomplete="off">

                </div>

                <div class="form-group">

                    <label for="">Jumlah Port</label>

                    <input type="number" class="form-control" name="total_port" value="<?= $odp['total_port'] ?>" autocomplete="off">

                </div>

                <div class="form-group">

                    <label for="picture">Document</label>

                    <input type="file" class="form-control" id="picture" name="picture" autocomplete="off">

                </div>

                <div class="form-group">

                    <label for="remark">Keterangan</label>

                    <input type="text" name="remark" id="remark" class="form-control" autocapitalize="off" autocomplete="off" value="<?= $odp['remark'] ?>">

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

        <div class="card shadow mb-4 mt-3">

            <div class="card-header py-3">

                <h6 class="m-0 font-weight-bold">Daftar Pelanggan yang terpasang</h6>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered" width="100%" cellspacing="0">

                        <thead>

                            <tr style="text-align: center">

                                <th style="text-align: center; width:20px">No Port</th>

                                <th>Nama Pelanggan</th>

                                <th>Status</th>

                                <th>Aksi</th>

                            </tr>

                        </thead>



                        <tbody>

                            <?php $portactive = $this->odp_m->getportactive($odp['id_odp'])->result(); ?>



                            <?php

                            for ($x = 1; $x <= $odp['total_port'];) { ?>

                                <tr>

                                    <?php $customer = $this->db->get_where('customer', ['no_port_odp' => $x, 'id_odp' => $odp['id_odp']])->row_array() ?>

                                    <td style="text-align: center"><?= $x++ ?></td>

                                    <?php if ($customer['c_status'] == 'Free' or $customer['c_status'] == 'Aktif' or $customer['c_status'] == 'Alfamidi' or $customer['c_status'] == 'KSO-JWI') { ?>

                                        <td><?= $customer['name']; ?> - <?= $customer['no_services']; ?></td>

                                        <td><?= $customer['c_status']; ?> </td>

                                        <td style="text-align: center">

                                            <?php if ($customer['name'] != null) { ?>

                                                <a href="#" data-toggle="modal" id="editport" data-id="<?= $customer['customer_id']; ?>" data-port_odp="<?= $customer['no_port_odp']; ?>" data-name="<?= $customer['name']; ?>" data-target="#edit" title="Edit"><i class="fa fa-edit" style="font-size:25px"></i></a>

                                            <?php } ?>

                                        </td>

                                    <?php } else {

                                        echo '<td></td>';

                                        echo '<td></td>';

                                        echo '<td></td>';
                                    } ?>

                                </tr>

                            <?php } ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <div class="card shadow mb-4 mt-3">

            <div class="card-header py-3">

                <h6 class="m-0 font-weight-bold">Daftar Pelanggan ODP <?= $odp['code_odp']; ?></h6>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered" width="100%" cellspacing="0">

                        <thead>

                            <tr style="text-align: center">

                                <th style="text-align: center; width:20px">No</th>

                                <th>Nama Pelanggan</th>

                                <th>Status</th>

                                <th>Port</th>

                                <th>Aksi</th>

                            </tr>

                        </thead>



                        <tbody>

                            <?php $customerall = $this->odp_m->getallcustomer($odp['id_odp'])->result(); ?>

                            <?php

                            $x = 1;

                            foreach ($customerall as $data) { ?>

                                <tr>

                                    <td style="text-align: center"><?= $x++ ?></td>

                                    <td><?= $data->name; ?> - <?= $data->no_services; ?></td>

                                    <td style="text-align: center;"><?= $data->c_status; ?></td>

                                    <td style="text-align: center;"><?= $data->no_port_odp; ?></td>

                                    <td>

                                        <a href="#" data-toggle="modal" id="editport" data-id="<?= $data->customer_id; ?>" data-port_odp="<?= $data->no_port_odp; ?>" data-name="<?= $data->name; ?>" data-target="#edit" title="Edit"><i class="fa fa-edit" style="font-size:25px"></i></a>

                                    </td>

                                </tr>

                            <?php } ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Modal Edit -->

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Edit Port ODP Pelanggan</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <form action="<?= site_url('odp/updateportcustomer') ?>" method="POST">

                    <input type="hidden" id="id" name="id">

                    <!-- <input type="text" id="idodp" name="id_odp"> -->

                    <div class="form-group">

                        <label for="name">Nama Pelanggan</label>

                        <input type="text" id="name" name="name" readonly autocomplete="off" class="form-control" required>

                    </div>

                    <div class="form-group">

                        <label for="name">No Port ODP</label>

                        <input type="number" id="port_odp" name="port_odp" autocomplete="off" class="form-control" required>

                    </div>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>

                <button type="submit" class="btn btn-primary">Simpan</button>

            </div>

            </form>

        </div>

    </div>

</div>

<script>
    $(function() {

        //Initialize Select2 Elements

        $('.select2').select2()

    });

    $(document).on('click', '#editport', function() {



        $('#id').val($(this).data('id'))

        $('#name').val($(this).data('name'))

        $('#port_odp').val($(this).data('port_odp'))





    })
</script>




<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->