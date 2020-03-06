<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-6">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Permintaan Pengadaan Material (PPM)</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">PPM</a></li>
                            <li class="active">Lihat</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="animated fadeIn">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Lihat Data Permintaan</strong>
                    </div>
                    <div class="card-body">
                        <div class="card-body card-block">

                            <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h5 class="modal-title" id="mediumModalLabel">Pengajuan Modal</h5>
                                        </div>
                                        <?php if ($view['disposisi_id'] == '1') {
                                            echo form_open('lppm/Ajukan/' . $view['pekerjaan_id']);
                                        } ?>
                                        <div class="modal-body">
                                            <strong>
                                                <p style="padding-bottom:15px;padding-top:35px;">
                                                    Apakah anda yakin ingin mengajukan?<br>
                                                </p>
                                                <p style="padding-bottom:35px;">
                                                    Jika benar, maka isi tanggal dibawah ini:
                                                </p>
                                            </strong>
                                            <div class="form-group">
                                                <label for="nf-password" class=" form-control-label">Tanggal Pengajuan</label>
                                                <div class="input-group date" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" id="datetimepicker5" data-toggle="datetimepicker" data-target="#datetimepicker5" name="created_date" required />
                                                    <?php echo form_error('created_date', '<span class="help-block text-danger">', '</span>'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Confirm</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nf-username" class=" form-control-label">Diinput oleh:</label>
                                <input type="text" id="nf-password" value="<?php echo $view['first_name'] . ' ' . $view['last_name'] ?>" name="bahan" placeholder="Enter Bahan.." class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nf-username" class=" form-control-label">Bahan</label>
                                <input type="text" id="nf-password" value="<?php echo $view['nama_bahan'] ?>" name="bahan" placeholder="Enter Bahan.." class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nf-password" class=" form-control-label">Quantity</label>
                                <div class="input-group">
                                    <input type="text" id="nf-password" value="<?php echo $view['qty'] ?>" name="qty" placeholder="Enter Quantity.." class="form-control" disabled>
                                    <div class="input-group-addon"><?php echo $view['nama_satuan'] ?></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nf-password" class=" form-control-label">Tanggal Diperlukan</label>
                                <input type="text" id="nf-password" value="<?php echo date('d-M-Y', strtotime($view['tgl_diperlukan'])) ?>" name="tgl_diperlukan" placeholder="Enter Tanggal Diperlukan.." class="form-control" disabled>
                            </div>
                            <label for="nf-password" class=" form-control-label">Status</label>
                            <div class="form-group">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td><?php echo $status[0]['nama_disposisi'] ?></td>
                                            <td><?php echo date('d/M/Y (H:i)', strtotime($view['created_date'])) ?></td>
                                        </tr>
                                        <?php if ($view['tgl_pengajuan'] !== null) { ?>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td><?php echo $status[1]['nama_disposisi'] ?></td>
                                                <td><?php echo date('d/M/Y (H:i)', strtotime($view['tgl_pengajuan'])) ?></td>
                                            </tr>
                                        <?php
                                    } ?>
                                        <!--  -->
                                        <?php if ($view['tgl_approve'] !== null) { ?>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td><?php echo $status[2]['nama_disposisi'] ?></td>
                                                <td><?php echo date('d/M/Y (H:i)', strtotime($view['tgl_approve'])) ?></td>
                                            </tr>
                                        <?php
                                    } ?>
                                        <?php if ($view['tgl_po'] !== null) { ?>
                                            <tr>
                                                <th scope="row">4</th>
                                                <td><?php echo $status[3]['nama_disposisi'] ?></td>
                                                <td><?php echo date('d/M/Y (H:i)', strtotime($view['tgl_po'])) ?></td>
                                            </tr>
                                        <?php
                                    } ?>

                                        <?php if ($view['tgl_reject'] !== null) { ?>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td><?php echo $status[6]['nama_disposisi'] ?></td>
                                                <td><?php echo date('d/M/Y (H:i)', strtotime($view['tgl_reject'])) ?></td>
                                            </tr>
                                        <?php
                                    } ?>

                                    </tbody>
                                </table>
                            </div>
                            <div class="form-actions form-group">
                                <?php if ($view['disposisi_id'] == '1') { ?>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mediumModal">
                                        Ajukan
                                    </button>
                                <?php
                            } ?>
                                <a class="btn btn-secondary btn-sm" href="<?php echo base_url('lppm/'); ?>"> Cancel</a>
                            </div>
                            <!-- </form> -->
                        </div>

                        <div class="card-footer">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#datetimepicker5').datetimepicker({
            format: 'DD-MM-YYYY HH:mm'
        });
    });
</script>