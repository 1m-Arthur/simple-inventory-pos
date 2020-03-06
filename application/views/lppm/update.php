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
                            <li class="active">Ubah</li>
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
                        <strong>Ubah Data Permintaan</strong>
                    </div>
                    <div class="card-body">
                        <div class="card-body card-block">
                            <?php if (!empty($this->session->tempdata('msgntf'))) { ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Warning!</strong> <?php echo $this->session->tempdata('msgntf'); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php
                        } ?>
                            <?php if (!empty($this->session->tempdata('msgout'))) { ?>
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    <strong> <?php echo $this->session->tempdata('msgout'); ?> </strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php
                        } ?>
                            <?php echo form_open('lppm/actionUpdate/' . $lppm['pekerjaan_id']) ?>
                            <div class="form-group">
                                <label for="nf-username" class=" form-control-label">Bahan</label>
                                <select name="bahan" id="select" class="form-control" required>
                                    <?php foreach ($bahan as $bahans) { ?>
                                        <option value=" <?php echo $bahans['bahan_id'] ?>" <?php if ($bahans['bahan_id'] == $lppm['bahan_id']) echo "selected"; ?>><?php echo $bahans['nama_bahan'] ?></option>
                                    <?php
                                } ?>
                                </select>
                                <?php echo form_error('bahan', '<span class="help-block text-danger">', '</span>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="nf-password" class=" form-control-label">Quantity</label>
                                <input type="number" id="nf-password" name="qty" placeholder="Enter Quantity.." class="form-control" required value="<?php echo $lppm['qty'] ?>">
                                <?php echo form_error('qty', '<span class="help-block text-danger">', '</span>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="nf-first-name" class=" form-control-label">Satuan</label>
                                <select name="satuan" id="select" class="form-control" required>
                                    <?php foreach ($satuan as $satuans) { ?>
                                        <option value=" <?php echo $satuans['satuan_id'] ?>" <?php if ($satuans['satuan_id'] == $lppm['satuan_id']) echo "selected"; ?>><?php echo $satuans['nama_satuan'] ?></option>
                                    <?php
                                } ?>
                                </select>
                                <?php echo form_error('satuan', '<span class="help-block text-danger">', '</span>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="nf-password" class=" form-control-label">Tanggal Pembuatan</label>
                                <!-- <div class="input-group date" id="datepicker2" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" id="datepicker2" data-toggle="datetimepicker" data-target="#datepicker2" name="created_date" required />
                                    <div class="input-group-append" data-target="#datepicker2" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div> -->
                                <div class="input-group date" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input datetimepicker-input1 created" id="datetimepicker5" data-toggle="datetimepicker" data-target="#datetimepicker5" name="created_date" placeholder="<?php echo date('d-m-Y H:i', strtotime($lppm['created_date'])) ?>" />
                                    <?php echo form_error('created_date', '<span class="help-block text-danger">', '</span>'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nf-password" class=" form-control-label">Tanggal Diperlukan</label>
                                <div class="input-group date" id="datepicker" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input date2" id="datepicker" data-toggle="datetimepicker" data-target="#datepicker" name="tgl_diperlukan" placeholder="<?php echo date('d-m-Y', strtotime($lppm['tgl_diperlukan'])) ?>" />
                                    <div class="input-group-append" data-target="#datepicker" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
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
        $('#datepicker').datetimepicker({
            format: 'DD-MM-YYYY'
        });
        $('#datetimepicker5').datetimepicker({
            format: 'DD-MM-YYYY HH:mm'
        });
        $('.datetimepicker-input1').mask('00-00-0000 00:00');
        $('.date2').mask('00-00-0000');
    });
</script>