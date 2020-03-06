<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-6">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>
                            Penerimaan Bahan
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Penerimaan</a></li>
                            <li class="active">Add</li>
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
                        <strong>Tambah Data Permintaan</strong>
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
                            <?php echo form_open('receipt/actionConfirm/'); ?>
                            <div class="form-group">
                                <label for="nf-username" class=" form-control-label">Nama Material</label>
                                <select name="po" id="select" class="form-control" required>
                                    <option value="">Pilih Material</option>
                                    <?php foreach ($purchase as $purchases) { ?>
                                        <option value="<?php echo $purchases['pekerjaan_id'] ?>"><?php echo $purchases['nama_bahan'] . " (" . $purchases['qty'] . " " . $purchases['nama_satuan'] . ")" ?></option>
                                    <?php
                                } ?>
                                </select>
                                <?php echo form_error('purchase', '<span class="help-block text-danger">', '</span>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="nf-username" class=" form-control-label">Diterima Oleh:</label>
                                <select name="penerima" id="select" class="form-control" required>
                                    <option value="">Pilih Penerima</option>
                                    <?php foreach ($user as $users) { ?>
                                        <option value="<?php echo $users['user_id'] ?>"><?php echo $users['first_name'] . ' ' . $users['last_name'] ?></option>
                                    <?php
                                } ?>
                                </select>
                                <?php echo form_error('penerima', '<span class="help-block text-danger">', '</span>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="nf-password" class=" form-control-label">Waktu Penerimaan</label>

                                <div class="input-group date" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" id="datetimepicker5" data-toggle="datetimepicker" data-target="#datetimepicker5" name="created_date" required />
                                    <?php echo form_error('created_date', '<span class="help-block text-danger form-control">', '</span>'); ?>
                                </div>
                            </div>
                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                <a class="btn btn-secondary btn-sm" href="<?php echo base_url('receipt/'); ?>"> Cancel</a>
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
        $('.datetimepicker-input').mask('00-00-0000 00:00');
    });
</script>