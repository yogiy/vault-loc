<?php $states = $this->Crud_model->getDataAsc('states', 'status', 'Active', 'title');?>
<section class="content">
	<div class="container-fluid">

		<div class="block-header">
			<div class="row">
				<div class="col-sm-6">
					<h2>Update CSR Projects Count</h2>
				</div>
				<div class="col-sm-6">
					<div style="text-align:right">
						<a href="<?php echo base_url();?>admin/settings/csroverview/display" class="btn bg-orange">Back</a>
					</div>
				</div>
			</div>
		</div>
        <ol class="breadcrumb bc-3">
			<li><a href="<?php echo base_url();?>admin/dashboard"><i class="entypo-home"></i>Home</a></li>
            <li><a href="<?php echo base_url();?>admin/settings">Location Settings</a></li>
            <li class="active"><strong>Update Project Count</strong></li>
        </ol>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
                    <?php echo $this->session->flashdata('msg');?>
					<div class="body">
                        <div class="panel panel-default" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title"></div>
                            </div>
                            <div class="panel-body">
                                <div class="bgcolor-1"><!-- bgcolor-1 -->
									
									<div class="row">
										<div class="col-sm-4">
											<div class="form-group">
												<label class="col-md-12">Total CSR Projects</label>
												<div class="form-line col-md-12">
													<input type="text" id="total_csr_project_count" name="project_count" class="form-control" value="<?php echo $project_count;?>" placeholder="project count">
												</div>
											</div>
										</div>
									</div>
									<br/>
									<div class="row" style="padding:20px;">
										<div class="col-sm-12">
											<div class="button-demo">
												<input type="submit" id="submit_project_count" class="btn btn-blue btn-md waves-effect" value="Update">
												<a id="backBtnId" href="<?php echo base_url();?>admin/settings/csroverview/display" class="btn btn-md bg-orange waves-effect">Cancel</a>
											</div>
										</div>
									</div>
								</div>
							</div>
					</div> <!-- body end -->
				</div> <!-- card end -->
			</div> <!-- col end -->
		</div> <!-- row end -->
	</div> <!-- container-fluid end -->
</section>

<script>
$(document).ready(function(){
	//'admin/settings/csroverview/update
	$('#submit_project_count').on('click', function(event){
	event.preventDefault();
    var counts = $('#total_csr_project_count').val();
	$.ajax({
		url: '<?php echo site_url("admin/settings/csroverview/update"); ?>',
		method: "POST",
		data: {inObj: counts},
		success: function(response){
			console.log(response);
			alert('Update Successful..');
			location.reload();
			// $('#backBtnId').trigger('click');
		}
	});
    
});
});
</script>