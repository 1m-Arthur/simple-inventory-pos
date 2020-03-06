<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login - PT Jaya Celcon Prima</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets'); ?>/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets'); ?>/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets'); ?>/css/login-util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets'); ?>/css/login-main.css">
    <!--===============================================================================================-->
</head>
<style>
    .bground{
         background-image: url("images/Bata-ringan.png");
    }
    .wrap-login100{
        padding: 1em;
    }
</style>
<body>

    <div class="limiter">
        <div class="container-login100 bground">
            <div class="wrap-login100 p-t-50 p-b-90">
                <form class="login100-form validate-form flex-sb flex-w" method="POST" action="<?php echo base_url('user'); ?>/login">
                    <img src="<?php echo base_url('images/Logo-PT.png');?>" class="img-fluid" alt="Logo PT">
                    <span class="login100-form-title p-b-51">
                        Login
                    </span>
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

                    <div class="wrap-input100 validate-input m-b-16" data-validate="Username is required">
                        <input class="input100" type="text" name="username" placeholder="Username">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-16" data-validate="Password is required">
                        <input class="input100" type="password" name="pass" placeholder="Password">
                        <span class="focus-input100"></span>
                    </div>
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                    <div class="container-login100-form-btn m-t-17">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!--===============================================================================================-->
    <script src="<?php echo base_url() ?>vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?php echo base_url() ?>vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?php echo base_url() ?>vendor/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url() ?>vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?php echo base_url('assets/') ?>js/login-main.js"></script>

</body>

</html> 