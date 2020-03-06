<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-6">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Bon Permintaan Bahan</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Permintaan Bahan</a></li>
                            <li class="active">List</li>
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
                        <strong class="card-title">Daftar Permintaan Bahan</strong>
                        <a href="<?php echo base_url('receiptbill/add') ?>" class="btn btn-info m-l-10 m-b-10 float-right"><i class="fa fa-plus"></i> | Tambah Bon Permintaan</a>
                    </div>
                    <div class="card-body">
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
                        <!-- searchbox -->
                        <form action="" method="get">
                            <div class="row form-group"">
                                <!-- <form action=" #" method="get"> -->
                                <div class="col-lg-3"></div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="lppmno" name="lppm_no" placeholder="Enter LPPM.." />
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="pono" name="po_no" placeholder="Enter PO.." />
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="pono" name="nama_bahan" placeholder="Enter Material.." />
                                    </div>
                                </div>
                                <div class="col-lg-1" style="padding-top:4.5px;">
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
                                </div>
                                <div class="col-lg-2"></div>
                                <!-- </form> -->
                            </div>
                        </form>
                        <!-- table cont -->
                        <div class="table-stats order-table ov-h">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>No. Bon Permintaan</th>
                                        <th>Tanggal</th>
                                        <th>Nama Pelaksana</th>
                                        <th>Nama Penerima</th>
                                        <th>Keterangan</th>
                                        <th class="text-left">Lihat</th>
                                        <th class="text-left">Edit</th>
                                        <th class="text-left">Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $no = 1;
                                    foreach ($rbill as $rbills) { ?>
                                        <!-- drop modal -->
                                        <div class="modal fade" id="dropModal<?php echo $rbills['kode_bon_permintaan'] ?>" tabindex="-1" role="dialog" aria-labelledby="dropModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h5 class="modal-title" id="dropModalLabel">Hapus Data</h5>

                                                    </div>
                                                    <div class="modal-body">
                                                        <p>
                                                            Apakah anda yakin ingin melakukan ini?
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <?php echo form_open('receiptbill/Drop/' . $rbills['kode_bon_permintaan']) ?>
                                                        <form action="<?php echo base_url('receiptbill/Drop/' . $rbills['kode_bon_permintaan']) ?>" method="post">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">Confirm</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /end of modal -->

                                        <tr>
                                            <td class="serial"><?php echo $no ?></td>
                                            <td> <span class="name"><?php echo $rbills['kode_bon_permintaan'] ?></span> </td>
                                            <td><span class="name"><?php echo ($rbills['created_date'] == null) ? "-" : date("d/M/y", strtotime($rbills['created_date'])); ?></span></td>
                                            <td> <span class="name"><?php echo $rbills['first_name'] . ' ' . $rbills['last_name'] ?></span> </td>
                                            <td><span class="name"><?php echo $rbills['nama_penerima'] ?></span></td>
                                            <td><span class="name"><?php echo (strlen($rbills['keterangan']) > 10) ? substr($rbills['keterangan'], 0, 10) : $rbills['keterangan']; ?></span></td>
                                            <td class="text-left">
                                                <a href="<?php echo base_url('receiptbill/lookat/' . $rbills['kode_bon_permintaan']) ?>" class="btn btn-primary m-l-10 m-b-10"><i class="fa fa-eye"></i></a>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url('receiptbill/Update/' . $rbills['kode_bon_permintaan']) ?>" class="btn btn-warning m-l-10 m-b-10"><i class="fa fa-edit"></i></a>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger m-l-10 m-b-10" data-toggle="modal" data-target="#dropModal<?php echo $rbills['kode_bon_permintaan'] ?>"><i class="fa fa-trash-o"></i></button>
                                            </td>

                                        </tr>
                                        <?php $no++;
                                    } ?>

                                </tbody>
                            </table>
                        </div> <!-- /.table-stats -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#bootstrap-data-table-export').DataTable();
    });
</script>