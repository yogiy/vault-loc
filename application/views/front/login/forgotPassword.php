<!doctype html>
<html>
<head>
    <meta charset="utf-8">
	<meta name="HandheldFriendly" content="true">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/front/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/front/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/front/css/style.css"/>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/front/css/custom.css"/>
    <title>Vault</title>
</head>
<body class="login-screen">
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
			<?php echo form_open_multipart(base_url().'loginUp',array('method'=>'post', 'name'=>'login','id'=>'login','class'=>'form-horizontal form-groups-bordered','autocomplete'=>'off'));?>
			<div class="login">
				<div class="login-logo">				
					<img src="<?php echo base_url();?>assets/front/images/indeed-logo.png" class="logo-indeed img-responsive"/>
					<img src="<?php echo base_url();?>assets/front/images/vault-logo.png" class="logo-vault img-responsive"/>
				</div>
				<?php echo $this->session->flashdata('msg');?>
				<div class="login-form">
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1"><img src="<?php echo base_url();?>assets/front/images/user.png"/></span>
					  <input type="text" class="form-control" name="username" placeholder="User ID" aria-describedby="basic-addon1">
					</div>
					<div class="form-group row">
						<div class="col-xs-4">
							<button type="submit" class="btn btn-warning">Send</button>
						</div>
						<div class="col-xs-4">
							<a href="<?php echo base_url();?>agency/login"><span class="btn btn-link">Agency Login</span></a>
						</div>
						<div class="col-xs-4">
							<a href="<?php echo base_url();?>client/login"><span class="btn btn-link">Client Login</span></a>
						</div>
					</div>
				</div>
			</div>
			<?php echo form_close();?>
		</div>
		<div class="col-md-9 col-sm-6 col-xs-12">
			
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/front/js/bootstrap.min.js"></script>
</body>
</html>