<?php $role = $this->session->userdata('role');?>
<section class="content">
    <div class="container-fluid">

        <div class="block-header">
            <div class="row clearfix">
                <div class="col-sm-6"><h2>Users</h2></div>
                <div class="col-sm-6">
                    <div style="text-align:right">
                        <a href="<?php echo base_url();?>users/display" class="btn bg-orange">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <ol class="breadcrumb bc-3">
            <li><a href="<?php echo base_url();?>dashboard"><i class="entypo-home"></i>Home</a></li>
            <li><a href="<?php echo base_url();?>users">Users</a></li>
            <li class="active"><strong>Edit User</strong></li>
        </ol>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <?php echo $this->session->flashdata('msg');?>
                    <div class="body">
                        <?php echo form_open_multipart(base_url().'users/update_user',array('name'=>'add_user','id'=>'add_user','class'=>'form-horizontal form-groups-bordered','autocomplete'=>'off'));?>
							<input type="hidden" name="images" value="<?php echo $data['img1'];?>">
							<input type="hidden" name="id"  value="<?php echo $data['id'];?>">
							<div class="panel panel-default" data-collapsed="0">
								<div class="panel-heading">
									<div class="panel-title ">
										Edit User
									</div>
								</div>
								<div class="panel-body">
									<div class="row clearfix">
										<div class="col-sm-3">
											<div class="form-group">
												<label for="total" class="col-md-12">First name <span class="mendatory">*</span></label>
												<div class="form-line col-md-12">
													<input type="text"  class="form-control" name="fname" value="<?php echo $data['fname'];?>" placeholder="First name">
												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label for="total" class="col-md-12">Last name </label>
												<div class="form-line col-md-12">
													<input class="form-control" type="text" name="lname"  placeholder="Last name" value="<?php echo $data['lname'];?>">
												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label for="total" class="col-md-12">Email Id <span class="mendatory">*</span> </label>
												<div class="form-line col-md-12">
													<input class="form-control" type="text" name="email" placeholder="Email Id" disabled value="<?php echo $data['email'];?>">
												</div>
											</div>
										</div>
										
										<div class="col-sm-3">
											<div class="form-group">
												<label for="total" class="col-md-12">Role </label>
												<div class="form-line col-md-12">
													<select class="form-control" name="role">
														<option value="2" <?php if($data['role']==2){ echo "selected";}?>>Employee</option>
														<option value="1" <?php if($data['role']==1){ echo "selected";}?>>Admin</option>
													</select>
												</div>
											</div>
										</div>
										
										<div class="col-sm-12">
											<div class="form-group">
												<label for="total" class="col-md-12">Profile Photo </label>
												<div class="form-line col-md-12">
													<input type="file" name="images" id="docupload" class="form-control file2 inline btn btn-danger col-md-12"  data-label="<i class='glyphicon glyphicon-circle-arrow-up'></i> &nbsp;Browse Files" />
													
													<div class="clearfix"></div>
													<img src="<?php echo base_url();?>uploads/profile/<?php echo $data['img1'];?>" style="width:50px;height:auto; margin-top: 10px">
											   </div>
											</div>
										</div>
									</div>
										
									<div class="row">
										<div style="border-bottom:1px solid #ebebeb;margin:15px 0 15px 0;"></div>
										<div class="col-sm-12">
											<div class="button-demo">
												 <input type="submit" name="submit" value="Save" class="btn btn-blue btn-md waves-effect">
											<a href="<?php echo base_url();?>users/display"><button type="button" class="btn btn-md btn-white waves-effect">Cancel</button></a>
											</div>
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