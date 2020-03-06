<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-6">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>
                            Penerimaan Barang
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Penerimaan</a></li>
                            <li class="active">Update</li>
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
                            <?php echo form_open('receiptbill/actionUpdate/' . $rbill['kode_bon_permintaan']); ?>
                            <div class="form-group">
                                <label for="nf-username" class=" form-control-label">Nama Pelaksana:</label>
                                <select name="pelaksana" id="select" class="form-control" required>
                                    <option value="">Pilih Pelaksana</option>
                                    <?php foreach ($user as $users) { ?>
                                        <option value="<?php echo $users['user_id'] ?>" <?php if ($users['user_id'] == $rbill['user_id']) echo "selected"; ?>><?php echo $users['first_name'] . ' ' . $users['last_name'] ?></option>
                                    <?php
                                } ?>
                                </select>
                                <?php echo form_error('pelaksana', '<span class="help-block text-danger">', '</span>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="nf-username" class=" form-control-label">Nama Penerima</label>
                                <input type="text" id="nf-username" name="nama_penerima" placeholder="Enter Penerima.." class="form-control" required value="<?php echo $rbill['nama_penerima'] ?>">
                                <?php echo form_error('nama_penerima', '<span class="help-block text-danger">', '</span>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="nf-username" class=" form-control-label">Nomor PO</label>
                                <select name="po" id="select" class="form-control" required>
                                    <option value="">Pilih Nomor</option>
                                    <?php foreach ($purchase as $purchases) { ?>
                                        <option value="<?php echo $purchases['purchase_id'] ?>" <?php if ($purchases['purchase_id'] == $rbill['purchase_id']) echo "selected"; ?>><?php echo $purchases['po_no'] ?></option>
                                    <?php
                                } ?>
                                </select>
                                <?php echo form_error('po', '<span class="help-block text-danger">', '</span>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="nf-username" class=" form-control-label">Quantity</label>
                                <input type="number" id="nf-username" name="qty_permintaan" placeholder="Enter Quantity.." class="form-control" required value="<?php echo $rbill['qty_permintaan'] ?>">
                                <?php echo form_error('qty_permintaan', '<span class="help-block text-danger">', '</span>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="nf-username" class=" form-control-label">Keterangan</label>
                                <textarea name="keterangan" id="" cols="30" rows="5" class="form-control" required><?php echo $rbill['keterangan'] ?></textarea>
                                <?php echo form_error('keterangan', '<span class="help-block text-danger">', '</span>'); ?>
                            </div>
                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                <a class="btn btn-secondary btn-sm" href="<?php echo base_url('receiptbill/'); ?>"> Cancel</a>
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