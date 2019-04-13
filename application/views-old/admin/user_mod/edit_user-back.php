<?php $role = $this->session->userdata('role');?>
<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<div class="row clearfix">
				<div class="col-sm-6">
					<h2>Update User </b>[<?php echo $data['email'];?>]</h2>
				</div>
				<div class="col-sm-6">
					<div style="text-align:right">
						<a href="<?php echo base_url();?>users/display" class="btn btn-default">Back</a>
					</div>
				</div>
			</div>
		</div>
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
                    <?php echo $this->session->flashdata('msg');?>
					<div class="body">
						<?php echo form_open_multipart(base_url().'users/update_user',array('name'=>'add_user','id'=>'add_user','autocomplete'=>'off'));?>
							<input type="hidden" name="images" value="<?php echo $data['img1'];?>">
							<input type="hidden" name="id"  value="<?php echo $data['id'];?>">
							<div class="box-body">
							  <div class="row">
								<div class="col-sm-4">
								  <div class="form-group">
									<label>First name <span class="mendatory">*</span></label>
									<input class="form-line form-control" type="text" name="fname" value="<?php echo $data['fname'];?>">
								  </div>
								</div>

								<div class="col-sm-4">
								  <div class="form-group">
									<label>Last name </label>
									<input class="form-line form-control" type="text" name="lname" value="<?php echo $data['lname'];?>">
								  </div>
								</div>		

								<div class="col-sm-4">
								  <div class="form-group">
									<label>Profile Photo </label>
									<input class="form-line form-control" type="file" name="images">
								  </div>
								  <?php if(!empty($data['img1'])){?>
									<img src="<?php echo base_url();?>uploads/profile/<?php echo $data['img1'];?>" style="width:100px;height:auto;">
								  <?php }?>
								</div>		
								        
							  </div> <!-- row end -->
								
							  <div class="row">
								<div class="col-sm-12">
								  <div class="form-group">
									  <input type="submit" name="submit" value="Save" class="btn btn-blue btn-flat">
									  <a href="<?php echo base_url();?>users/display"><button type="button" class="btn btn-warning btn-flat">Cancel</button></a>
								  </div>
								</div>
							  </div>
							</div>
						<?php echo form_close();?>
					</div> <!-- body end -->
				</div> <!-- card end -->
			</div> <!-- col end -->
		</div> <!-- row end -->
	</div> <!-- container-fluid end -->
</section>