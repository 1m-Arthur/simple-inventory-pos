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
                        <strong class="card-title">Daftar Purchase Order</strong>
                        <a href="<?php echo base_url('PO/Add') ?>" class="btn btn-info m-l-10 m-b-10 float-right"><i class="fa fa-plus"></i> | Tambah Data</a>
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

                        <!-- table cont -->
                        <div class="table-stats order-table ov-h">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>No. PO</th>
                                        <th>No. LPPM</th>
                                        <th>Tanggal Pemesanan</th>
                                        <th>Material</th>
                                        <th>Qty</th>
                                        <th class="text-left">Lihat</th>
                                        <!-- <th class="text-left">Edit</th> -->
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $no = 1;
                                    foreach ($po as $pos) { ?>
                                        <!-- drop modal -->
                                        <div class="modal fade" id="dropModal<?php echo $pos['pekerjaan_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="dropModalLabel" aria-hidden="true">
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
                                                        <?php echo form_open('lppm/Drop/' . $pos['pekerjaan_id']) ?>
                                                        <form action="<?php echo base_url('lppm/Drop/' . $pos['pekerjaan_id']) ?>" method="post">
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
                                            <td> <span class="name"><?php echo ($pos['po_no'] == null) ? "-" : $pos['po_no'] ?></span> </td>
                                            <td><span class="name"><?php echo $pos['lppm_no'] ?></span></td>
                                            <td> <span class="name"><?php echo ($pos['tgl_po'] == null) ? "-" : date("d/M/y", strtotime($pos['tgl_po'])); ?></span> </td>
                                            <td><span class="name"><?php echo $pos['nama_bahan'] ?></span></td>
                                            <td><span class="name"><?php echo $pos['qty'] ?></span></td>
                                            <td class="text-left">
                                                <a href="<?php echo base_url('PO/lookat/' . $pos['purchase_id']) ?>" class="btn btn-primary m-l-10 m-b-10"><i class="fa fa-eye"></i></a>
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
        $('#bootstr  ap-data-table-export').DataTable();
    });
</script>