<?php
	$user = $this->Crud_model->getData('admins','admin_id',$this->session->userdata('admin_id'));
	$usrName = ucwords($user[0]['fname'].' '. $user[0]['lname']);
	$email = $user[0]['email'];
	$role = $user[0]['role_id'];

	$page = $this->uri->segment(1);
	$sub_page=$this->uri->segment(2);
	$user_id = $this->session->userdata('user_id');
	$cnt = $this->Crud_model->getData('admins', 'admin_id', $user_id);
?>
<div class="sidebar-menu">
	<div class="sidebar-menu-inner">
		<header class="logo-env">
			<div class="logo">
				<a href="<?php echo base_url();?>admin/dashboard">
					<img src="<?php echo base_url();?>assets/admin/images/logo.png" class="logo-class" alt="" />
				</a>
			</div>
			<div class="sidebar-collapse">
				<a href="#" class="sidebar-collapse-icon">
					<i class="entypo-menu"></i>
				</a>
			</div>
			<div class="sidebar-mobile-menu visible-xs">
				<a href="#" class="with-animation">
					<i class="entypo-menu"></i>
				</a>
			</div>
		</header>
		<ul id="main-menu" class="main-menu">
			<li class="opened <?php if($page=='dashboard'){ ?>  active <?php }?>">
				<a href="<?php echo base_url();?>admin/dashboard">
					<i class="entypo-gauge"></i>
					<span class="title">Dashboard</span>
				</a>
			</li>
			<li class="<?php if($page=='settings'){ ?>  active <?php }?> root-level">
				<a href="<?php echo base_url();?>admin/settings">
					<i class="fa fa-cogs" aria-hidden="true"></i>
					<span class="title">Admin Settings</span>
				</a>
			</li>
			
			<li <?php if($page=='password'){ ?> class="active" <?php }?>>
				<a href="<?php echo base_url();?>admin/password/change">
					<i class="entypo-key"></i>
					<span>Change Password</span>
				</a>
			</li>

			<li>
				<a href="<?php echo base_url();?>admin/logout">
					<i class="entypo-logout"></i>
					<span>Log Out</span>
				</a>
			</li>
		</ul>
	</div>
</div>
<div class="main-content">
	<div class="header">
		<div class="col-md-6 col-sm-8 clearfix"></div>
		<div class="col-md-6 col-sm-4 clearfix hidden-xs">
			<ul class="list-inline links-list pull-right">
				<li class="profile-info dropdown">
					<a href="<?php echo base_url();?>dashboard" class="dropdown-toggle" data-toggle="dropdown">
						<?php /*if(!empty($user[0]['img1'])){?>
							<img src="<?php echo base_url();?>uploads/profile/<?php echo $user[0]['img1'];?>" alt="User"class="img-circle" width="35" />
						<?php } else {?>
							<img src="<?php echo base_url();?>assets/admin/images/user.png" alt="User" class="img-circle" width="35" />
						<?php }*/?>
						Hi, <strong style="margin-left: 5px"><?php echo $usrName; ?></strong>
					</a>
				</li>
			</ul>

		</div>
	</div>
<hr />





