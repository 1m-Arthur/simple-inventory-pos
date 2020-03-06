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
                        <strong>Change User Info</strong>
                    </div>
                    <div class="card-body">

                        <?php echo form_open('user/actionUpdate_Self/'); ?>
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
                                <label for="nf-username" class=" form-control-label">Username</label>
                                <input type="text" id="nf-username" name="username" placeholder="Enter Username.." class="form-control" value="<?php echo $user['username'] ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nf-password" class=" form-control-label">Password</label>
                                <input type="password" id="nf-password" name="pass" placeholder="Enter Password.." class="form-control">
                                <?php echo form_error('pass', '<span class="help-block text-danger">', '</span>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="nf-first-name" class=" form-control-label">Nama Depan</label>
                                <input type="text" id="nf-username" name="first_name" placeholder="Enter Firstname.." class="form-control" required value="<?php echo $user['first_name'] ?>">
                                <?php echo form_error('first_name', '<span class="help-block text-danger">', '</span>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="nf-last-name" class=" form-control-label">Nama Akhir</label>
                                <input type="text" id="nf-username" name="last_name" placeholder="Enter Lastname.." class="form-control" value="<?php echo $user['last_name'] ?>">
                                <?php echo form_error('last_name', '<span class="help-block text-danger">', '</span>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="nf-password" class=" form-control-label">Departemen</label>
                                <select name="departemen" id="select" class="form-control" value="<?php echo $user['departemen_id'] ?>">
                                    <?php foreach ($department as $departments) { ?>
                                    <option value=" <?php echo $departments['departemen_id'] ?>" <?php if ($departments['departemen_id'] == ($user['departemen_id'])) echo "selected"; ?>><?php echo $departments['nama_departemen'] ?></option>
                                    <?php 
                                } ?>
                                </select>
                                <?php echo form_error('departemen', '<span class="help-block text-danger">', '</span>'); ?>
                            </div>
                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                <a class="btn btn-secondary btn-sm" href="<?php echo base_url('user/userlist'); ?>"> Cancel</a>
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