<?php $states = $this->Crud_model->getDataAsc('states', 'status', 'Active', 'title');?>
<section class="content">
	<div class="container-fluid">

		<div class="block-header">
			<div class="row">
				<div class="col-sm-6">
					<h2>Add NGO</h2>
				</div>
				<div class="col-sm-6">
					<div style="text-align:right">
						<a href="<?php echo base_url();?>admin/settings/ngo/display" class="btn bg-orange">Back</a>
					</div>
				</div>
			</div>
		</div>
        <ol class="breadcrumb bc-3">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="entypo-home"></i>Home</a></li>
            <li><a href="<?php echo base_url();?>admin/settings">Admin Settings</a></li>
            <li class="active"><strong>Add NGO</strong></li>
        </ol>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
                    <?php echo $this->session->flashdata('msg');?>
					<div class="body">
						<?php echo form_open_multipart(base_url().'admin/settings/ngo/insert',array('method'=>'post', 'name'=>'add_ngo','id'=>'add_ngo','class'=>'form-horizontal form-groups-bordered','autocomplete'=>'off'));?>
                        <div class="panel panel-default" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title"></div>
                            </div>
                            <div class="panel-body">
                                <div class="bgcolor-1"><!-- bgcolor-1 -->
									<div class="row">
										<div class="col-sm-3">
											<div class="form-group">
												<label class="col-md-12">Sectors Working In</label>
												<div class="form-line col-md-12">
													<select name="sector_id[]" class="form-control select2" multiple>
														<?php foreach($sectors as $sector){?>
														<option value="<?php echo $sector['sector_id'];?>"><?php echo $sector['title'];?></option>
														<?php }?>
													</select>
												</div>
											</div>
										</div>
										
										<div class="col-sm-3">
											<div class="form-group">
												<label class="col-md-12">Title</label>
												<div class="form-line col-md-12">
													<input type="text" name="title" class="form-control" placeholder="Title">
												</div>
											</div>
										</div>
										
										<div class="col-sm-3">
											<div class="form-group">
												<label class="col-md-12">Type of NGO</label>
												<div class="form-line col-md-12">
													<select name="ngo_type" class="form-control">
														<option value="">-Select-</option>
														<option value="Society">Society</option>
														<option value="Trust">Trust</option>
														<option value="Any Other">Any Other</option>
													</select>
												</div>
											</div>
										</div>
										
										<div class="col-sm-3">
											<div class="form-group">
												<label class="col-md-12">Unique Id of VO/NGO</label>
												<div class="form-line col-md-12">
													<input type="text" name="unique_id" class="form-control" placeholder="Unique Id of VO/NGO">
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-sm-3">
											<div class="form-group">
												<label class="col-md-12">Registration No</label>
												<div class="form-line col-md-12">
													<input type="text" name="registeration_no" class="form-control" placeholder="Registration No">
												</div>
											</div>
										</div>
										
										<div class="col-sm-3">
											<div class="form-group">
												<label class="col-md-12">Date of Establishment/Registration</label>
												<div class="form-line col-md-12">
													<input type="date" name="registeration_date" class="form-control" placeholder="Date of Establishment/Registration">
												</div>
											</div>
										</div>
										
										<div class="col-sm-3">
											<div class="form-group">
												<label class="col-md-12">License Renewal</label>
												<div class="form-line col-md-12">
													<select name="licence_renew" class="form-control">
														<option value="">-Select-</option>
														<option value="Yes">Yes</option>
														<option value="No">No</option>
													</select>
												</div>
											</div>
										</div>
										
										<div class="col-sm-3">
											<div class="form-group">
												<label class="col-md-12">Ranking from Website</label>
												<div class="form-line col-md-12">
													<input type="text" name="ranking_f_website" class="form-control" placeholder="Ranking from Website">
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-sm-3">
											<div class="form-group">
												<label class="col-md-12">Annual Turnover</label>
												<div class="form-line col-md-12">
													<input type="text" name="annual_turnover" class="form-control" placeholder="Annual Turnover">
												</div>
											</div>
										</div>
										
										<div class="col-sm-3">
											<div class="form-group">
												<label class="col-md-12">USP</label>
												<div class="form-line col-md-12">
													<input type="text" name="usp" class="form-control" placeholder="USP">
												</div>
											</div>
										</div>
										
										<div class="col-sm-3">
											<div class="form-group">
												<label class="col-md-12">Registration Certificate</label>
												<div class="form-line col-md-12">
													<input type="text" name="registeration_certificate" class="form-control" placeholder="Registration Certificate">
												</div>
											</div>
										</div>
										
										<div class="col-sm-3">
											<div class="form-group">
												<label class="col-md-12">Number of years of exp.</label>
												<div class="form-line col-md-12">
													<input type="text" name="experience" class="form-control" placeholder="Number of years of exp.">
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-sm-3">
											<div class="form-group">
												<label class="col-md-12">Audit</label>
												<div class="form-line col-md-12">
													<select name="audit" class="form-control">
														<option value="">-Select-</option>
														<option value="Yes">Yes</option>
														<option value="No">No</option>
													</select>
												</div>
											</div>
										</div>
										
										<div class="col-sm-3">
											<div class="form-group">
												<label class="col-md-12">Brands</label>
												<div class="form-line col-md-12">
													<select name="brand[]" class="form-control select2" multiple>
														<?php foreach($brands as $brand){ ?>
														<option value="<?php echo $brand['brand_id'];?>"><?php echo $brand['title'];?></option>
														<?php }?>
													</select>
												</div>
											</div>
										</div>
										
										<div class="col-sm-3">
											<div class="form-group">
												<label class="col-md-12">Trustees</label>
												<div class="form-line col-md-12">
													<input type="text" name="trustee" class="form-control" placeholder="Trustees">
												</div>
											</div>
										</div>
										
										<div class="col-sm-3">
											<div class="form-group">
												<label class="col-md-12">Ranking Of NGO</label>
												<div class="form-line col-md-12">
													<input type="text" name="ngo_ranking" class="form-control" placeholder="Ranking Of NGO">
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-md-12">Address</label>
												<div class="form-line col-md-12">
													<input type="text" name="address" class="form-control" placeholder="Address">
												</div>
											</div>
										</div>
										
										<div class="col-sm-3">
											<div class="form-group">
												<label class="col-md-12">State</label>
												<div class="form-line col-md-12">
													<select name="state" id="state" class="form-control">
														<option value="">-Select-</option>
														<?php foreach($states as $state){ ?>
														<option value="<?php echo $state['state_id'];?>"><?php echo $state['title'];?></option>
														<?php }?>
													</select>
												</div>
											</div>
										</div>
										
										<div class="col-sm-3">
											<div class="form-group">
												<label class="col-md-12">City</label>
												<div class="form-line col-md-12">
													<select name="city" id="city" class="form-control">
														<option value="">-Select-</option>
													</select>
												</div>
											</div>
										</div>
										
									</div>
									
									<div class="row">
										<div class="col-sm-3">
											<div class="form-group">
												<label class="col-md-12">Contact Person</label>
												<div class="form-line col-md-12">
													<input type="text" name="contact_person" class="form-control" placeholder="Contact Person">
												</div>
											</div>
										</div>
										
										<div class="col-sm-3">
											<div class="form-group">
												<label class="col-md-12">Mobile</label>
												<div class="form-line col-md-12">
													<input type="text" name="mobile" class="form-control" placeholder="Mobile">
												</div>
											</div>
										</div>
										
										<div class="col-sm-3">
											<div class="form-group">
												<label class="col-md-12">Telephone</label>
												<div class="form-line col-md-12">
													<input type="text" name="phone" class="form-control" placeholder="Telephone">
												</div>
											</div>
										</div>
										
										<div class="col-sm-3">
											<div class="form-group">
												<label class="col-md-12">E-mail</label>
												<div class="form-line col-md-12">
													<input type="text" name="email" class="form-control" placeholder="E-mail">
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-sm-3">
											<div class="form-group">
												<label class="col-md-12">Operational Area-States</label>
												<div class="form-line col-md-12">
													<input type="text" name="operational_area_state" class="form-control" placeholder="Operational Area-States">
												</div>
											</div>
										</div>
										
										<div class="col-sm-3">
											<div class="form-group">
												<label class="col-md-12">Operational Area-City/District</label>
												<div class="form-line col-md-12">
													<input type="text" name="operational_area_city" class="form-control" placeholder="Operational Area-City/District">
												</div>
											</div>
										</div>
										
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-md-12">Major Activities/Achievements</label>
												<div class="form-line col-md-12">
													<textarea name="activity" class="form-control" rows="5" placeholder="Major Activities/Achievements"></textarea>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-12">
											<div class="button-demo">
												<input type="submit" id="submit_form" class="btn btn-blue btn-md waves-effect" value="Save">
												<a href="<?php echo base_url();?>admin/settings/ngo/display" class="btn btn-md bg-orange waves-effect">Cancel</a>
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
			url: "<?php echo base_url();?>admin/ajax/showCity",	
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