<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-6">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Purchase Order (PO)</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">PO</a></li>
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
                            <?php echo form_open('PO/actionAdd/'); ?>
                            <div class="form-group">
                                <label for="nf-username" class=" form-control-label">Nomor LPPM</label>
                                <select name="lppm" id="select" class="form-control" required>
                                    <option value="">Pilih Nomor</option>
                                    <?php foreach ($lppm as $lppms) { ?>
                                        <option value="<?php echo $lppms['pekerjaan_id'] ?>"><?php echo $lppms['lppm_no'] . " - " . $lppms['nama_bahan'] . "(" . $lppms['qty'] . " " . $lppms['nama_satuan'] . ")" ?></option>
                                    <?php
                                } ?>
                                </select>
                                <?php echo form_error('lppm', '<span class="help-block text-danger">', '</span>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="nf-username" class=" form-control-label">Harga Satuan</label>
                                <input type="number" id="nf-username" name="harga" placeholder="Enter Harga Satuan.." class="form-control" required>
                                <?php echo form_error('harga', '<span class="help-block text-danger">', '</span>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="nf-username" class=" form-control-label">Nama Supplier</label>
                                <input type="text" id="nf-username" name="supplier" placeholder="Enter Supplier.." class="form-control" required>
                                <?php echo form_error('supplier', '<span class="help-block text-danger">', '</span>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="nf-password" class=" form-control-label">Tanggal Pembuatan</label>

                                <div class="input-group date" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" id="datetimepicker5" data-toggle="datetimepicker" data-target="#datetimepicker5" name="created_date" required />
                                    <?php echo form_error('created_date', '<span class="help-block text-danger">', '</span>'); ?>
                                </div>
                            </div>
                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                <a class="btn btn-secondary btn-sm" href="<?php echo base_url('PO/'); ?>"> Cancel</a>
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