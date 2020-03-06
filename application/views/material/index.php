<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Material</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li>Material</li>
                            <li class="active">Material list</li>
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
                        <strong class="card-title">Daftar Material</strong>
                        <button type="button" class="btn btn-info m-l-10 m-b-10 float-right" data-toggle="modal" data-target="#addModal">
                            <i class="fa fa-plus"></i> | Tambah Material
                        </button>
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
                        <!-- modal add -->
                        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h5 class="modal-title" id="addModalLabel">Form Tambah Material</h5>
                                    </div>
                                    <?php echo form_open('material/Add'); ?>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nf-username" class=" form-control-label">Nama Material</label>
                                            <input type="text" id="nf-username" name="nama_bahan" placeholder="Enter Material.." class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Confirm</button>
                                    </div>
                                    <!-- </form> -->
                                </div>
                            </div>
                        </div>

                        <!-- table cont -->
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>Material</th>
                                        <th class="text-left">Ubah</th>
                                        <th class="text-left">Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $no = 1;
                                    foreach ($material as $materials) { ?>
                                    <tr>
                                        <td class="serial"><?php echo $no ?></td>
                                        <td> <span class="name"><?php echo $materials['nama_bahan'] ?></span> </td>
                                        <td class="text-left">
                                            <a href="<?php echo base_url('material/updates/' . $materials['bahan_id']); ?>" class="btn btn-warning m-l-10 m-b-10"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td class="text-left">
                                            <a href="<?php echo base_url('material/Drop/' . $materials['bahan_id']); ?>" class="btn btn-danger m-l-10 m-b-10"><i class="fa fa-trash-o"></i></a>
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