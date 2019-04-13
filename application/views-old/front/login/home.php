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
    <title>Vault</title>
</head>
<body class="entry-screen-main">
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4">
			<div class="entry-screen">
				<div class="login-logo">				
					<img src="<?php echo base_url();?>assets/front/images/indeed-logo.png" class="logo-indeed img-responsive"/>
					<img src="<?php echo base_url();?>assets/front/images/vault-logo.png" class="logo-vault img-responsive"/>
				</div>				
				<div class="row">
					<div class="col-sm-6">
						<button class="btn btn-theme-orange pull-right" onclick="window.location.href='<?php echo base_url();?>agency/login'">Agency</button>
					</div>
					<div class="col-sm-6">
						<button class="btn btn-theme-green" onclick="window.location.href='<?php echo base_url();?>client/login'">Client</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>