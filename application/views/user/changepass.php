<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>User Control</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">User</a></li>
                            <li class="active">Change Password</li>
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
                        <strong>Change Password</strong>
                    </div>
                    <div class="card-body">

                        <?php echo form_open('user/changepass_Self'); ?>
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
                            <div class="form-group"><label for="nf-password" class=" form-control-label">Password</label><input type="password" id="nf-password" name="pass" placeholder="Enter Password.." class="form-control" required><?php echo form_error('pass', '<span class="help-block text-danger">', '</span>'); ?></div>
                            <div class="form-group"><label for="nf-password-confirm" class=" form-control-label">Konfirmasi Password</label><input type="password" id="nf-password-confirm" name="pass_confirm" placeholder="Enter Password Confirmation.." class="form-control" required><?php echo form_error('pass_confirm', '<span class="help-block text-danger">', '</span>'); ?></div>
                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> Reset</button>
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