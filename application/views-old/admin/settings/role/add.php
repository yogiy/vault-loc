<section class="content">
	<div class="container-fluid">

		<div class="block-header">
			<div class="row clearfix">
				<div class="col-sm-6">
					<h2>Add Role</h2>
				</div>
				<div class="col-sm-6">
					<div style="text-align:right">
						<a href="<?php echo base_url();?>admin/settings/thematicAreas/display" class="btn bg-orange">Back</a>
					</div>
				</div>
			</div>
		</div>
        <ol class="breadcrumb bc-3">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="entypo-home"></i>Home</a></li>
            <li><a href="<?php echo base_url();?>admin/settings">Admin Settings</a></li>
            <li class="active"><strong>Add Role</strong></li>
        </ol>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
                    <?php echo $this->session->flashdata('msg');?>
					<div class="body">
						<?php echo form_open_multipart(base_url().'admin/settings/thematicArea/insert',array('method'=>'post', 'name'=>'add_common','id'=>'add_common','class'=>'form-horizontal form-groups-bordered','autocomplete'=>'off'));?>
                        <div class="panel panel-default" data-collapsed="0">

                            <div class="panel-heading">
                                <div class="panel-title"></div>
                            </div>
                            <div class="panel-body">
                                <div class="bgcolor-1"><!-- bgcolor-1 -->
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<label for="total" class="col-md-12">Title</label>
												<div class="form-line col-md-12">
													<input type="text" name="title" class="form-control" placeholder="Title">
												</div>
											</div>
										</div>
									</div>
								</div>	

								<div class="row">
									<div class="col-sm-12">
										<div class="button-demo">
											<input type="submit" id="submit_form" class="btn btn-blue btn-md waves-effect" value="Save">
											<a href="<?php echo base_url();?>admin/settings/thematicAreas/display" class="btn btn-md bg-orange waves-effect">Cancel</a>
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