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
					<h3 class="login-h3">Client Login</h3>
				</div>
				
				<input type="hidden" name="ref" value="<?php echo base_url();?>client/login">
				<input type="hidden" name="role" value="<?php echo $role;?>">
				<div class="login-form">
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1"><img src="<?php echo base_url();?>assets/front/images/user.png"/></span>
					  <input type="text" class="form-control" name="username" placeholder="User ID" aria-describedby="basic-addon1">
					</div>
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1"><img src="<?php echo base_url();?>assets/front/images/password.png"/></span>
					  <input type="password" name="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1">
					</div>
					<div class="form-group row">
						<div class="col-xs-6">
							<button type="submit" class="btn btn-warning">Log in</button>
						</div>
						<div class="col-xs-6">
							<span class="btn btn-link f-password" onclick="return clkpopUp();">Forgot Password</span>
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
<div class="modal" id="popUp" style="display:none;background-color: rgba(0, 0, 0, 0.8);">
	<?php echo '
		<script>
			$(document).ready(function(){
				$(".close").click(function () { $("#popUp").hide(); });	
			});
		</script>';

        echo '
			<div class="modal-dialog forget-password" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title text-center" id="myModalLabel"><label>Forgot Password</label></h4>
						<div class="row">
							<div class="col-xs-12">
								<p>Please contact admin to reset your password.</p>
							</div>
						</div>
					</div>
				</div>
			</div>';?>
</div>
<script>
	function clkpopUp() {
		$('#popUp').show();
	}
</script>

</body>
</html>