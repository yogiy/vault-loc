<section class="content">
	<div class="container-fluid">

		<div class="block-header">
			<div class="row clearfix">
				<div class="col-sm-6">
					<h2>Project</h2>
				</div>
				<div class="col-sm-6">
					<div style="text-align:right">
						<a href="<?php echo base_url();?>settings/projects/display" class="btn bg-orange">Back</a>
					</div>
				</div>
			</div>
		</div>
        <ol class="breadcrumb bc-3">
            <li>
                <a href="<?php echo base_url();?>dashboard"><i class="entypo-home"></i>Home</a>
            </li>
            <li>
                <a href="<?php echo base_url();?>settings">settings</a>
            </li>
            <li class="active">
                <strong>Project</strong>
            </li>
        </ol>
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
                    <?php echo $this->session->flashdata('msg');?>
					<div class="body">
						<?php echo form_open_multipart(base_url().'settings/project/insert',array('method'=>'post', 'name'=>'add_project','id'=>'add_project','class'=>'form-horizontal form-groups-bordered','autocomplete'=>'off'));?>
                        <div class="panel panel-default" data-collapsed="0">

                            <div class="panel-heading">
                                <div class="panel-title">
                                    Add Project
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="bgcolor-1"><!-- bgcolor-1 -->
									<div class="row">
										<div class="col-sm-3">
											<div class="form-group">
												<label for="total" class="col-md-12">Title</label>
												<div class="form-line col-md-12">
													<input type="text" name="title" class="form-control" placeholder="Title">
												</div>
											</div>
										</div>
										
										<div class="col-sm-3">
											<div class="form-group">
												<label for="total" class="col-md-12">Panel Brand</label>
												<div class="form-line col-md-12">
													<input type="text" name="panel_brand" class="form-control" placeholder="Panel Brand">
												</div>
											</div>
										</div>
										
										<div class="col-sm-3">
											<div class="form-group">
												<label for="total" class="col-md-12">Panel Size</label>
												<div class="form-line col-md-12">
													<input type="text" name="panel_size" class="form-control" placeholder="Panel Size">
												</div>
											</div>
										</div>
										
										<div class="col-sm-3">
											<div class="form-group">
												<label for="total" class="col-md-12">Panel Number</label>
												<div class="form-line col-md-12">
													<input type="text" name="panel_number" class="form-control" placeholder="Panel Number">
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-sm-3">
											<div class="form-group">
												<label for="total" class="col-md-12">Inverter Brand</label>
												<div class="form-line col-md-12">
													<input type="text" name="inverter_brand" class="form-control" placeholder="Inverter Brand">
												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label for="total" class="col-md-12">Inverter Number</label>
												<div class="form-line col-md-12">
													<input type="text" name="inverter_number" class="form-control" placeholder="Inverter Number">
												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label for="total" class="col-md-12">Inverter Size</label>
												<div class="form-line col-md-12">
													<input type="text" name="inverter_size" class="form-control" placeholder="Inverter Size">
												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label for="total" class="col-md-12">Spoc Name</label>
												<div class="form-line col-md-12">
													<input type="text" name="spoc_name" class="form-control" placeholder="Spoc Name">
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-sm-3">
											<div class="form-group">
												<label for="total" class="col-md-12">Spoc Contact</label>
												<div class="form-line col-md-12">
													<input type="text" name="spoc_contact" class="form-control" placeholder="Spoc Contact">
												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label for="total" class="col-md-12">Start Project Date</label>
												<div class="form-line col-md-12">
													<input type="text" name="start_date" class="form-control" placeholder="Start Project Date">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label for="total" class="col-md-12">Address</label>
												<div class="form-line col-md-12">
													<input type="text" name="address" class="form-control" placeholder="Address">
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-sm-3">
											<div class="form-group">
												<label for="total" class="col-md-12">Country</label>
												<div class="form-line col-md-12">
													<select name="country" class="form-control">
														<option value="">-Country-</option>
														<?php foreach($countries as $country) { ?>
														<option value="<?php echo $country['location_id'];?>"><?php echo $country['title'];?></option>
														<?php }?>
													</select>
												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label for="total" class="col-md-12">State</label>
												<div class="form-line col-md-12">
													<select name="state" class="form-control">
														<option value="">-State-</option>
													</select>
												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label for="total" class="col-md-12">City</label>
												<div class="form-line col-md-12">
													<select name="city" class="form-control">
														<option value="">-City-</option>
													</select>
												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label for="total" class="col-md-12">Pincode</label>
												<div class="form-line col-md-12">
													<input type="text" name="pincode" class="form-control" placeholder="Pincode">
												</div>
											</div>
										</div>
									</div>	
								</div>	

								<div class="row clearfix">
									<div class="col-sm-12">
										<div class="button-demo">
											<input type="submit" id="submit_form" class="btn btn-blue btn-md waves-effect" value="Save">
											<a href="<?php echo base_url();?>settings/projects/display" class="btn btn-md bg-orange waves-effect">Cancel</a>
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