<?php $states = $this->Crud_model->getDataAsc('states', 'status', 'Active', 'title');?>
<section class="content">
	<div class="container-fluid">

		<div class="block-header">
			<div class="row">
				<div class="col-sm-6">
					<h2>Add Market</h2>
				</div>
				<div class="col-sm-6">
					<div style="text-align:right">
						<a href="<?php echo base_url();?>admin/settings/markets/display" class="btn bg-orange">Back</a>
					</div>
				</div>
			</div>
		</div>
        <ol class="breadcrumb bc-3">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="entypo-home"></i>Home</a></li>
            <li><a href="<?php echo base_url();?>admin/settings">Admin Settings</a></li>
            <li class="active"><strong>Add Market</strong></li>
        </ol>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
                    <?php echo $this->session->flashdata('msg');?>
					<div class="body">
						<?php echo form_open_multipart(base_url().'admin/settings/market/insert',array('method'=>'post', 'name'=>'add_tier_town','id'=>'add_tier_town','class'=>'form-horizontal form-groups-bordered','autocomplete'=>'off'));?>
                        <div class="panel panel-default" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title"></div>
                            </div>
                            <div class="panel-body">
                                <div class="bgcolor-1"><!-- bgcolor-1 -->
									
									<div class="row">
										<div class="col-sm-4">
											<div class="form-group">
												<label class="col-md-12">Title</label>
												<div class="form-line col-md-12">
													<input type="text" name="title" class="form-control" placeholder="Title">
												</div>
											</div>
										</div>
										
										<div class="col-sm-4">
											<div class="form-group">
												<label class="col-md-12">Zone</label>
												<div class="form-line col-md-12">
                                                    <select name="zone" id="zone" class="form-control">
                                                        <option value="">-Select-</option>
                                                        <?php foreach($zones as $zone){ ?>
                                                            <option value="<?php echo $zone['zone_id'];?>"><?php echo $zone['title'];?></option>
                                                        <?php }?>
                                                    </select>
													<input type="text" name="zone" class="form-control" placeholder="Zone">
												</div>
											</div>
										</div>
										
										<div class="col-sm-4">
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
									</div>
									<div class="row">
										<div class="col-sm-4">
											<div class="form-group">
												<label class="col-md-12">Tier Town</label>
												<div class="form-line col-md-12">
													<select name="tier_town" class="form-control">
														<option value="">-Select-</option>
														<?php foreach($tier_town as $tt){ ?>
														<option value="<?php echo $tt['tier_town_id'];?>"><?php echo $tt['title'];?></option>
														<?php }?>
													</select>
												</div>
											</div>
										</div>
										
										<div class="col-sm-4">
											<div class="form-group">
												<label class="col-md-12">Longitude</label>
												<div class="form-line col-md-12">
													<input type="text" name="longitude" class="form-control" placeholder="Longitude">
												</div>
											</div>
										</div>
										
										<div class="col-sm-4">
											<div class="form-group">
												<label class="col-md-12">Latitude</label>
												<div class="form-line col-md-12">
													<input type="text" name="latitude" class="form-control" placeholder="Latitude">
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-12">
											<div class="button-demo">
												<input type="submit" id="submit_form" class="btn btn-blue btn-md waves-effect" value="Save">
												<a href="<?php echo base_url();?>admin/settings/markets/display" class="btn btn-md bg-orange waves-effect">Cancel</a>
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