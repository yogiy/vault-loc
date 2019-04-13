<?php 
	$permissions = $this->session->userdata('permissions');
	$page = $this->uri->segment(1);
?>

<div class="col-lg-3 col-md-2 col-sm-3 col-xs-6">
	<ul class="menu-list">
		<li class="row <?php if($page == 'csr-overview') {echo "active";}?>">
			<a href="<?php echo base_url();?>csr-overview">
				<div class="col-sm-3 col-xs-4 icon-box">
					<img src="<?php echo base_url();?>assets/front/images/archives.png" class="img-responsive"/>
				</div>
				<div class="col-xs-8 text-box">CSR<br/>Overview</div>
			</a>
		</li>
		<li class="row <?php if($page == 'thematic-overview') {echo "active";}?>">
			<a href="<?php echo base_url();?>thematic-overview">
				<div class="col-sm-3 col-xs-4 icon-box">
					<img src="<?php echo base_url();?>assets/front/images/archives.png" class="img-responsive"/>
				</div>
				<div class="col-xs-8 text-box">Thematic<br/>Overview</div>
			</a>
		</li>
		<?php if(in_array(1,$permissions)){ ?>
		<li class="row <?php if($page == 'brief-module') {echo "active";}?>">
			<a href="<?php echo base_url();?>brief-module">
				<div class="col-sm-3 col-xs-4 icon-box">
					<img src="<?php echo base_url();?>assets/front/images/brief.png" class="img-responsive"/>
				</div>
				<div class="col-xs-8 text-box">Brief<br/>Module</div>
			</a>
		</li>
		<?php } if(in_array(2,$permissions)){ ?>
		<li class="row <?php if($page == 'planning-module') {echo "active";}?>">
			<a href="<?php echo base_url();?>planning-module">
				<div class="col-sm-3 col-xs-4 icon-box">
					<img src="<?php echo base_url();?>assets/front/images/planning.png" class="img-responsive"/>
				</div>
				<div class="col-xs-8 text-box">Planning<br/>Module</div>
			</a>
		</li>
		<?php } if(in_array(3,$permissions)){ ?>
		<li class="row <?php if($page == 'project-development') {echo "active";}?>">
			<a href="<?php echo base_url();?>project-development">
				<div class="col-sm-3 col-xs-4 icon-box">
					<img src="<?php echo base_url();?>assets/front/images/program.png" class="img-responsive"/>
				</div>
				<div class="col-xs-8 text-box">Project<br/>Development</div>
			</a>
		</li>
		<?php } if(in_array(5,$permissions)){ ?>
		<li class="row <?php if($page == 'archives') {echo "active";}?>">
			<a href="<?php echo base_url();?>archives">
				<div class="col-sm-3 col-xs-4 icon-box">
					<img src="<?php echo base_url();?>assets/front/images/archives.png" class="img-responsive"/>
				</div>
				<div class="col-xs-8 text-box">Archives</div>
			</a>
		</li>
		<?php } if(in_array(8,$permissions)){ ?>
		<li class="row <?php if($page == 'partner-identification') {echo "active";}?>">
			<a href="<?php echo base_url();?>partner-identification">
				<div class="col-sm-3 col-xs-4 icon-box">
					<img src="<?php echo base_url();?>assets/front/images/partner.png" class="img-responsive"/>
				</div>
				<div class="col-xs-9 text-box">Partner<br/>Indentification</div>
			</a>
		</li>
		<?php } if(in_array(6,$permissions)){ ?>
		<li class="row <?php if($page == 'project-management') {echo "active";}?>">
			<a href="<?php echo base_url();?>project-management">
				<div class="col-sm-3 col-xs-4 icon-box">
					<img src="<?php echo base_url();?>assets/front/images/project.png" class="img-responsive"/>
				</div>
				<div class="col-xs-9 text-box">Project<br/>Management</div>
			</a>
		</li>
		<?php } if(in_array(7,$permissions)){ ?>
		<li class="row <?php if($page == 'project-assessment') {echo "active";}?>">
			<a href="<?php echo base_url();?>project-assessment">
				<div class="col-sm-3 col-xs-4 icon-box">
					<img src="<?php echo base_url();?>assets/front/images/project-assement.png" class="img-responsive"/>
				</div>
				<div class="col-xs-9 text-box">Project<br/>Assessment</div>
			</a>
		</li>
		
		<?php } if(in_array(13,$permissions)){ ?>
		<li class="row <?php if($page == 'report-archive') {echo "active";}?>">
			<a href="<?php echo base_url();?>report-archive">
				<div class="col-sm-3 col-xs-4 icon-box">
					<img src="<?php echo base_url();?>assets/front/images/archives.png" class="img-responsive"/>
				</div>
				<div class="col-xs-9 text-box">Report<br/>Archives</div>
			</a>
		</li>
		<?php }?>
		
	</ul>
</div>