<?php 
	$abc = array_filter(explode('&', base64_decode($this->uri->segment(2))));
	//echo "<pre>";print_r($abc);echo "</pre>";
	$opened = explode('=', $abc[3]);
	$userId = explode('=', $abc[2]);
	$userDet = $this->Crud_model->get_general('admin', 'id', $userId[1]);
?>	
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
            <?php echo form_open_multipart(base_url().'reset_password_up',array('method'=>'post','name'=>'reset_password','id'=>'reset_password','autocomplete'=>'off','class'=>'form-signin'));?>
			<?php 
					if($opened[1]!=$userDet[0]['opened'])
					{
				?>
					<div class="outer" style="text-align:center;">
						<div class="login text-center">
							This link is already used.
						</div>
					</div>
				<?php } else { ?>
            <?php echo $this->session->flashdata('msg');?>
			<input type="hidden" name="id" value="<?php echo $this->uri->segment(2);?>">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="entypo-key"></i>
                    </div>
                    <input type="password" class="form-control" name="npass" id="inputEmail" placeholder="New Password">
                </div>
				<br>
				<div class="input-group">
                    <div class="input-group-addon">
                        <i class="entypo-key"></i>
                    </div>
                    <input type="password" class="form-control" name="cpass" id="inputPassword" placeholder="Confirm Password">
                </div>
            </div>
            <div class="form-group">
                <div class="btn-group  text-center btn btn-primary btn-block btn-login ">
                    <input type="submit" name="submit" onclick="chk()" id="submitbutton" value="Reset Password" class="login-class"> <i class="entypo-right-open-mini"></i>
                </div>
            </div>
            <?php echo form_close();?>
			<?php }?>
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