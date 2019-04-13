<!DOCTYPE html>
<html lang="en">
<head>
    <title>Finance | Forgot Password</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Finance Admin Panel" />
    <meta name="author" content=""/>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/font-icons/entypo/css/entypo.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/neon-forms.css">
    <script src="<?php echo base_url();?>assets/admin/js/jquery-1.11.3.min.js"></script>
    <!--[if lt IE 9]><script src="<?php echo base_url();?>assets/admin/js/ie8-responsive-file-warning.js"></script><![endif]-->
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
                <img src="<?php echo base_url();?>assets/admin/images/logo.png" width="315" alt="" />
            </a>
            <p class="description">Enter your email, and we will send the reset link.</p>
        </div>
    </div>
    <div class="login-form">
        <div class="login-content">
            <?php echo form_open(base_url().'forgot_password_up',array('class'=>'login-form css','name'=>'login','id'=>'login'));?>
            <?php echo $this->session->flashdata('msg');?>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="entypo-user"></i>
                    </div>
                    <input type="text" required class="form-control" name="email" id="email" placeholder="Email Id"  autocomplete="off" autofocus>
                </div>
            </div>
            <div class="form-group">
                <div class="btn-group  text-center btn btn-primary btn-block btn-login ">
                    <input type="submit" name="submit" onclick="chk()" id="submitbutton" value="Forgot Password" class="login-class"> <i class="entypo-right-open-mini"></i>
                </div>
            </div>
            <?php echo form_close();?>
            <div class="login-bottom-links">
                <a href="<?php echo base_url();?>" class="link">
                    <i class="entypo-lock"></i>
                    Return to Login Page</a>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url();?>assets/admin/js/bootstrap.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/neon-login.js"></script>
</body>
</html>