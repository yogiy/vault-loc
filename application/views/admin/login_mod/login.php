<!DOCTYPE html>
<html lang="en">
<head>
    <title>Vault | Login</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Vault Admin Panel" />
    <meta name="author" content=""/>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/font-icons/entypo/css/entypo.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/neon-forms.css">
    <script src="<?php echo base_url();?>assets/admin/js/jquery-1.11.3.min.js"></script>
    <!--[if lt IE 9]>
    <script src="<?php echo base_url();?>assets/admin/js/ie8-responsive-file-warning.js"></script>
    <![endif]-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="page-body login-page login-form-fall">
<div class="login-container">
    <div class="login-header login-caret">
        <div class="login-content">
            <a href="<?php echo base_url();?>" class="logo">
                <img src="<?php echo base_url();?>assets/admin/images/logo.png" width="180" alt="" />
            </a>
            <p class="description">Dear user, log in to access the vault application!</p>
        </div>
    </div>
    <div class="login-form">
        <div class="login-content">
            <?php echo form_open(base_url().'admin/admin/login_up',array('class'=>'login-form css','name'=>'login','id'=>'login'));?>
            <div class="msg">Sign in to start your session</div>
            <?php echo $this->session->flashdata('msg');?>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="entypo-user"></i>
                    </div>
                    <input type="text" class="form-control" required name="email" id="email" placeholder="Email Id" autocomplete="off"  />
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="entypo-key"></i>
                    </div>
                    <input type="password" class="form-control" required name="pass" id="password" placeholder="Password" autocomplete="off" />
                </div>
            </div>
            <div class="form-group">
                <div class="btn-group  text-center btn btn-primary btn-block btn-login ">
                    <input type="submit" name="submit" onclick="chk()" id="submitbutton" value="Login In" class="login-class"> <i class="entypo-login"></i>
                </div>
            </div>
            <?php echo form_close();?>
            <?php /*<div class="text-right">
                <a href="<?php echo base_url();?>forgot/password">Forgot Password?</a>
            </div>*/ ?>
        </div>
    </div>
</div>
<script src="<?php echo base_url();?>assets/admin/js/bootstrap.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/neon-login.js"></script>
</body>
</html>
