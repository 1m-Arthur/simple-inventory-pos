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
                        <strong>Ubah Data</strong>
                    </div>
                    <div class="card-body">

                        <?php echo form_open('material/actionUpdate/' . $material['bahan_id']); ?>
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
                            <div class="form-group">
                                <label for="nf-password" class=" form-control-label">Nama Material</label>
                                <input type="text" id="nf-username" name="nama_bahan" placeholder="Enter Material.." class="form-control" required value="<?php echo $material['nama_bahan'] ?>">
                                <?php echo form_error('nama_bahan', '<span class="help-block text-danger">', '</span>'); ?>
                            </div>
                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                <a class="btn btn-secondary btn-sm" href="<?php echo base_url('material/'); ?>"> Cancel</a>
                            </div>

                        </div>

                        <div class="card-footer">

                        </div>
                        <!-- </form> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>