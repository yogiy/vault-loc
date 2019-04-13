<?php
	$userId = $this->session->userdata('front_user_id');
	$userDet = $this->Front_model->getData('users', 'user_id', $userId);
	$roleDet = $this->Front_model->getData('roles', 'role_id', $userDet[0]['role_id']);
	$permissions = explode(',', $roleDet[0]['permission_id']);
	$this->session->set_userdata(array('permissions'=> $permissions));
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
	<meta name="HandheldFriendly" content="true">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>Vault</title>
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/front/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/front/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/front/css/style.css"/>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/front/css/custom.css"/>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<style>
	#map_canvas{
		height: 400px;  /* The height is 400 pixels */
    	width: 100%;  /* The width is the width of the web page */
	}
	canvas{
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
	</style>
</head>

<body class="menu-list">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3 col-sm-offset-9">
				<div class="user-label pull-right">
					<h4>
						<a href="#"><img src="<?php echo base_url();?>assets/front/images/user-icon.svg" class="user-icon"/><?php echo ucwords($userDet[0]['fname'].' '.$userDet[0]['lname']);?></a>  <span class="saperator">|</span> 
						<a href="<?php echo base_url();?>logout">Logout</a>
						<small>(<?php echo $roleDet[0]['title'];?>)</small>
					</h4>
					
				</div>
			</div>
		</div>
	<div class="row">