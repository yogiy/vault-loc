<section class="content">
	<div class="container-fluid">

		<div class="block-header">
			<div class="row">
				<div class="col-sm-6">
					<h2>Add User</h2>
				</div>
				<div class="col-sm-6">
					<div style="text-align:right">
						<a href="<?php echo base_url();?>admin/settings/users/display" class="btn bg-orange">Back</a>
					</div>
				</div>
			</div>
		</div>
        <ol class="breadcrumb bc-3">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="entypo-home"></i>Home</a></li>
            <li><a href="<?php echo base_url();?>admin/settings">Admin Settings</a></li>
            <li class="active"><strong>Add User</strong></li>
        </ol>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
                    <?php echo $this->session->flashdata('msg');?>
					<div class="body">
						<?php echo form_open_multipart(base_url().'admin/settings/user/insert',array('method'=>'post', 'name'=>'add_user','id'=>'add_user','class'=>'form-horizontal form-groups-bordered','autocomplete'=>'off'));?>
                        <div class="panel panel-default" data-collapsed="0">

                            <div class="panel-heading">
                                <div class="panel-title"></div>
                            </div>
                            <div class="panel-body">
                                <div class="bgcolor-1"><!-- bgcolor-1 -->
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="total" class="col-md-12">First Name</label>
												<div class="form-line col-md-12">
													<input type="text" name="fname" class="form-control" placeholder="First Name">
												</div>
											</div>
										</div>
										
										<div class="col-sm-6">
											<div class="form-group">
												<label for="total" class="col-md-12">Last Name</label>
												<div class="form-line col-md-12">
													<input type="text" name="lname" class="form-control" placeholder="Last Name">
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="total" class="col-md-12">Username</label>
												<div class="form-line col-md-12">
													<input type="text" name="username" class="form-control" placeholder="Username">
												</div>
											</div>
										</div>
										
										<div class="col-sm-6">
											<div class="form-group">
												<label for="total" class="col-md-12">Email Id</label>
												<div class="form-line col-md-12">
													<input type="text" name="email" class="form-control" placeholder="Email Id">
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="total" class="col-md-12">Valid From</label>
												<div class="form-line col-md-12">
													<input type="date" name="valid_from" class="form-control" placeholder="Valid From">
												</div>
											</div>
										</div>
										
										<div class="col-sm-6">
											<div class="form-group">
												<label for="total" class="col-md-12">Valid To</label>
												<div class="form-line col-md-12">
													<input type="date" name="valid_to" class="form-control" placeholder="Valid To">
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="total" class="col-md-12">Password</label>
												<div class="form-line col-md-12">
													<input type="password" name="pass" id="pass" class="form-control" placeholder="Password">
												</div>
											</div>
										</div>
										
										<div class="col-sm-6">
											<div class="form-group">
												<label for="total" class="col-md-12">Confirm Password</label>
												<div class="form-line col-md-12">
													<input type="password" name="cpass" class="form-control" placeholder="Confirm Password">
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="total" class="col-md-12">Choose Group</label>
												<div class="form-line col-md-12">
													<select name="role_id" class="form-control">
														<option value="">-Select-</option>
														<?php foreach($groups as $group){ ?>
															<option value="<?php echo $group['role_id'];?>"><?php echo $group['title'];?></option>
														<?php }?>
													</select>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-12">
											<div class="button-demo">
												<input type="submit" id="submit_form" class="btn btn-blue btn-md waves-effect" value="Save">
												<a href="<?php echo base_url();?>admin/settings/users/display" class="btn btn-md bg-orange waves-effect">Cancel</a>
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


<script>
$(document).ready(function(){
	$('#state').change(function () {
		var state = $('#state').val();
		//alert(state);
		$.ajax({
			url: "<?php echo base_url();?>transaction/showCity",	
			data:{state:state},
			method:'post',               
			success: function(result){
				//alert(result);
				$("#city").html(result);
			}
		});
		
		
	});
	});
</script>