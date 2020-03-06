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
            <div class="col-md-12 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Daftar Permintaan Pengadaan Material</strong>
                        <a href="<?php echo base_url('lppm/Add') ?>" class="btn btn-info m-l-10 m-b-10 float-right"><i class="fa fa-plus"></i> | Tambah Data</a>
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
                                        <th>No. LPPM</th>
                                        <th>Tanggal</th>
                                        <th>Pemohon</th>
                                        <th>Material</th>
                                        <th class="text-left">Approve</th>
                                        <th class="text-left">Lihat</th>
                                        <th class="text-left">Edit</th>
                                        <th class="text-left">Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $no = 1;
                                    foreach ($lppm as $lppms) { ?>
                                    <!-- drop modal -->
                                    <div class="modal fade" id="dropModal<?php echo $lppms['pekerjaan_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="dropModalLabel" aria-hidden="true">
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
                                                    <?php echo form_open('lppm/Drop/' . $lppms['pekerjaan_id']) ?>
                                                    <form action="<?php echo base_url('lppm/Drop/' . $lppms['pekerjaan_id']) ?>" method="post">
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
                                        <td> <span class="name"><?php echo $lppms['lppm_no'] ?></span> </td>
                                        <td><span class="name"><?php echo date("d/M/y", strtotime($lppms['created_date'])) ?></span></td>
                                        <td> <span class="name"><?php echo $lppms['first_name'] ?></span> </td>
                                        <td><span class="name"><?php echo $lppms['nama_bahan'] ?></span></td>
                                        <td class="text-center">
                                            <span class="name">
                                                <?php if ($lppms['disposisi_id'] == '3') {
                                                    echo '<span class="badge badge-success"><i class="fa fa-thumbs-up"></i></span>';
                                                } elseif ($lppms['disposisi_id'] == '7') {
                                                    echo '<span class="badge badge-danger"><i class="fa fa-thumbs-down"></i></span>';
                                                } else {
                                                    echo '-';
                                                } ?>
                                            </span>
                                        </td>
                                        <td class="text-left">
                                            <a href="<?php echo base_url('lppm/lookat/' . $lppms['pekerjaan_id']) ?>" class="btn btn-primary m-l-10 m-b-10"><i class="fa fa-eye"></i></a>
                                        </td>
                                        <td class="text-left">
                                            <a href="<?php echo base_url('lppm/Updates/' . $lppms['pekerjaan_id']); ?>" class="btn btn-warning m-l-10 m-b-10"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td class="text-left">
                                            <?php if ($lppms['disposisi_id'] == '1') { ?>
                                            <button class="btn btn-danger m-l-10 m-b-10" data-toggle="modal" data-target="#dropModal<?php echo $lppms['pekerjaan_id'] ?>"><i class="fa fa-trash-o"></i></button>
                                            <?php 
                                        } else { ?>
                                            -
                                            <?php 
                                        } ?>
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
        $('#bootstrap-data-table-export').DataTable({
            responsive: true
        });
    });
</script> 