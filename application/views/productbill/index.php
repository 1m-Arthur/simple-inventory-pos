<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-6">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Bon Pengeluaran Bahan</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Pengeluaran Bahan</a></li>
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
                        <strong class="card-title">Daftar Pengeluaran Bahan</strong>
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
                                        <th class="text-left">Approve</th>
                                        <th class="text-left">Lihat</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $no = 1;
                                    foreach ($pbill as $pbills) { ?>
                                        <!-- approve modal -->
                                        <div class="modal fade" id="approveModal<?php echo $pbills['kode_bon_permintaan'] ?>" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="approveModalLabel">Approve Data</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <?php echo form_open('productbill/Approve/' . $pbills['kode_bon_permintaan']) ?>
                                                    <form action="<?php echo base_url('productbill/Approve/' . $pbills['kode_bon_permintaan']) ?>" method="post">
                                                        <div class="modal-body">
                                                            <p>
                                                                Apakah anda yakin akan mengeluarkan bahan ini?
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">Confirm</button>

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /end of modal -->

                                        <tr>
                                            <td class="serial"><?php echo $no ?></td>
                                            <td> <span class="name"><?php echo $pbills['kode_bon_permintaan'] ?></span> </td>
                                            <td><span class="name"><?php echo ($pbills['created_date'] == null) ? "-" : date("d/M/y", strtotime($pbills['created_date'])); ?></span></td>
                                            <td> <span class="name"><?php echo $pbills['first_name'] . ' ' . $pbills['last_name'] ?></span> </td>
                                            <td><span class="name"><?php echo $pbills['nama_penerima'] ?></span></td>
                                            <td><span class="name"><?php echo (strlen($pbills['keterangan']) > 10) ? substr($pbills['keterangan'], 0, 10) : $pbills['keterangan']; ?></span></td>
                                            <td class="text-left">
                                                <?php if ($pbills['approve'] == '1') { ?>
                                                    <button class="btn btn-success m-l-10 m-b-10" data-toggle="modal" data-target="#rejectModal<?php echo $pbills['kode_bon_permintaan'] ?>"> <i class="fa fa-check"></i></button>
                                                <?php
                                            } elseif ($pbills['approve'] == '0') { ?>
                                                    <a class="btn btn-danger m-l-10 m-b-10" href="<?php echo base_url('productbill/approve/' . $pbills['kode_bon_permintaan']) ?>"> <i class="fa fa-times"></i></a>
                                                <?php
                                            } else { ?>
                                                    <a class="btn btn-warning m-l-10 m-b-10" href="<?php echo base_url('productbill/approve/' . $pbills['kode_bon_permintaan']) ?>"> <i class="fa fa-minus-square"></i></a>
                                                <?php
                                            } ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url('productbill/lookat/' . $pbills['kode_bon_permintaan']) ?>" class="btn btn-primary m-l-10 m-b-10"><i class="fa fa-eye"></i></a>
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