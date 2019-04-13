<?php $reprtArchSess = $this->session->userdata('reprtArchSess');?>
<div class="col-md-9 col-sm-6 col-xs-12">
	<div class="form-section ">
		<?php echo form_open_multipart(base_url().'searchReportArchives',array('method'=>'post', 'name'=>'searchReportArchives','id'=>'searchReportArchives','class'=>'','autocomplete'=>'off'));?>
		<div class="row">
			<div class="col-sm-4 col-sm-offset-2">
				<div class="row">
					<div class="col-sm-5">
						<label>Brand Name</label>
					</div>
					<div class="col-sm-7">
						<div class="form-group">
							<select name="brand_id" class="form-control search">
								<option value="">-Select-</option>
								<?php foreach($brands as $brand) {?>
									<option value="<?php echo $brand['brand_id'];?>" <?php if($this->session->userdata('brand_id')==$brand['brand_id']){ echo "selected=selected";}?>><?php echo $brand['title'];?></option>
								<?php }?>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-5">
						<label>Project Name</label>
					</div>
					<div class="col-sm-7">
						<div class="form-group">
							<input type="text" name="title" value="<?php echo $this->session->userdata('title');?>" class="form-control"/>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="row">
					<div class="col-sm-5">
						<label>Zone</label>
					</div>
					<div class="col-sm-7">
						<div class="form-group">
							<select name="zone_id" class="form-control search">
								<option value="">-Select-</option>
								<?php foreach($zones as $zone) {?>
									<option value="<?php echo $zone['zone_id'];?>" <?php if($this->session->userdata('zone_id')==$zone['zone_id']){ echo "selected=selected";}?>><?php echo $zone['title'];?></option>
								<?php }?>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-5">
						<label>City/State</label>
					</div>
					<div class="col-sm-7">
						<div class="form-group">
							<select name="state_id" class="form-control search">
								<option value="">-Select-</option>
								<?php foreach($states as $state) {?>
									<option value="<?php echo $state['state_id'];?>" <?php if($this->session->userdata('state_id')==$state['state_id']){ echo "selected=selected";}?>><?php echo $state['title'];?></option>
								<?php }?>
							</select>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-5">
						<label>Status</label>
					</div>
					<div class="col-sm-7">
						<div class="form-group">
							<select name="status" class="form-control search">
								<option value="">-Select-</option>
								<option value="Pending" <?php if($this->session->userdata('status')=='Pending'){ echo "selected=selected";}?>>Pending</option>
								<option value="WIP" <?php if($this->session->userdata('status')=='WIP'){ echo "selected=selected";}?>>WIP</option>
								<option value="Completed" <?php if($this->session->userdata('status')=='Completed'){ echo "selected=selected";}?>>Completed</option>
							</select>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-warning btn-sm pull-right">Search</button>
							<?php if(!empty($reprtArchSess)){ ?><button type="button" class="btn btn-danger btn-sm" onclick="window.location='<?php echo base_url();?>unsetReportArchives'">Reset</button><?php }?>
						</div>
					</div>
				</div>
			</div>						
		</div>
		<?php echo form_close();?>
		
		<?php if(!empty($reprtArchSess)){?>
		<div class="row custom-table">
			<div class="col-sm-8">
				<div class="scroll-table">
					<table class="table table-responsive table-bordered">
						<tr>
							<td></td>
							<td>PDID</td>
							<td>State</td>
							<td>Zone</td>
							<td>Brand</td>
							<td>Status</td>
						</tr>
						<?php 
							$i=0;
							foreach($archives as $archive)
							{
								++$i;
								$brandNm = $this->Front_model->getData('m_brands', 'brand_id', $archive['brand_id']);
								$clientNm = $this->Front_model->getData('users', 'user_id', $archive['client_id']);
								$marketNm = $this->Front_model->getData('m_market', 'market_id', $archive['metro_id']);
								if(!empty($marketNm[0]['state']))
								{
									$stateNm = $this->Front_model->getData('states', 'state_id', @$marketNm[0]['state']);
									$stateName = $stateNm[0]['title'];
									
									$zoneNm = $this->Front_model->getData('m_zones', 'zone_id', @$marketNm[0]['zone']);
									$zoneName = $zoneNm[0]['title'];
									
								} else { $stateName = 'N/A';}	
								$reworkDet = $this->Front_model->getDataLast1('brief_rework', 'brief_module_id', $archive['brief_module_id']);
								if(count($reworkDet)>0)
								{
									$download = base_url()."uploads/briefRework/".$reworkDet[0]['rework'];
								} else {
									$download = base_url()."uploads/briefModule/".$archive['filename'];
								}
						?>
						<tr>
							<td><input type="radio" name="show" onclick="return reportPlan(<?php echo $archive['brief_module_id'];?>);" value="<?php echo $archive['brief_module_id'];?>" ></td>
							<td><?php echo $archive['brief_module_id'];?></td>
							<td><?php echo $stateName;?></td>
							<td><?php echo $zoneName;?></td>
							<td><?php echo $brandNm[0]['title'];?></td>
							<td>
								<?php if(in_array(11,$permissions)){ ?>
									<?php if($archive['b_status']=='Completed'){ echo $archive['b_status'];} else {?>
									<select name="state_id" class="form-control" onchange="return statusChng(<?php echo $archive['brief_module_id'];?>, this.value);">
										<option value="Pending" <?php if($archive['b_status'] == 'Pending'){ echo "selected=selected";}?>>Pending</option>
										<option value="WIP" <?php if($archive['b_status'] == 'WIP'){ echo "selected=selected";}?>>WIP</option>
										<option value="Completed" <?php if($archive['b_status'] == 'Completed'){ echo "selected=selected";}?>>Completed</option>
									</select>
									<?php }?>
								<?php } else { echo $archive['b_status'];}?>	
							</td>
						</tr>
						<script>
							
						</script>
						<?php }?>							
					</table>
				</div>
			</div>
			<div id="showDwnld">
				<div class="col-sm-4">
					<fieldset disabled>
					<div class="row">
						<div class="col-sm-6">
							<label>Baseline Study</label>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<button class="btn btn-green btn-sm">Download</button>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<label>Need Assessment</label>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<button class="btn btn-green btn-sm">Download</button>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<label>Monitoring Report</label>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<button class="btn btn-green btn-sm">Download</button>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<label>Final Report</label>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<button class="btn btn-green btn-sm">Download</button>
							</div>
						</div>
					</div>
					</fieldset>
				</div>
			</div>
		</div>
		<?php }?>
		
<div class="modal" id="popUp" style="display:none;background-color: rgba(0, 0, 0, 0.8);">
    <div id="ajaxPopUp"></div>
</div>
		
<script>
	function reportPlan(brief_id) {
		//alert(brief_id);
		$.ajax({
            url: "<?php echo base_url();?>front/ajax/downloadArchiveReport",
            data:{val:brief_id},
            method:'post',
            success: function(result){
                //alert(result);return false;
                $("#showDwnld").html(result);
            }
        });
    }
	
	function reportMonitor(brief_id) {
		//alert(brief_id);
		$.ajax({
            url: "<?php echo base_url();?>front/ajax/downloadMonitorReport",
            data:{val:brief_id},
            method:'post',
            success: function(result){
                //alert(result);//return false;
                $("#ajaxPopUp").html(result);
				$("#popUp").show();
            }
        });
    }
	
	function reportFinal(brief_id) {
		//alert(brief_id);
		$.ajax({
            url: "<?php echo base_url();?>front/ajax/downloadFinalReport",
            data:{val:brief_id},
            method:'post',
            success: function(result){
               // alert(result);//return false;
				$("#ajaxPopUp").html(result);
                $("#popUp").show();
            }
        });
    }
</script>		