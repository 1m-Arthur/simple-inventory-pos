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
                            <li class="active">Approve</li>
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
                        <strong>Approve Data Permintaan</strong>
                    </div>
                    <div class="card-body">
                        <?php echo form_open('lppm/actionApprove/' . $view['pekerjaan_id']) ?>
                        <form action="<?php echo base_url('lppm/actionApprove/' . $view['pekerjaan_id']) ?>" method="post">
                            <div class="card-body card-block">
                                <p>
                                    Apakah anda yakin akan mengeluarkan bahan ini?
                                </p>
                                <div class="form-group">
                                    <label for="nf-username" class=" form-control-label">Tanggal:</label>
                                    <input type="text" class="form-control datetimepicker-input created" id="datetimepicker5" data-toggle="datetimepicker" data-target=".created" name="created_date" required placeholder="Enter Tanggal Barang Keluar.." />
                                    <?php echo form_error('created_date', '<span class="help-block text-danger">', '</span>'); ?>
                                </div>
                                <a class="btn btn-secondary btn-sm" href="<?php echo base_url('lppm/'); ?>"> Cancel</a>
                                <button type="submit" class="btn btn-primary">Confirm</button>
                            </div>
                        </form>
                    </div>

                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.created').datetimepicker({
            format: 'DD-MM-YYYY HH:mm'
        });
    });
</script>