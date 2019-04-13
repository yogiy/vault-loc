<?php $prtIdnSess = $this->session->userdata('prtIdnSess');?>
<div class="col-md-9 col-sm-6 col-xs-12">
	<div class="form-section ">
		<div class="row">
			<div class="col-sm-12">
				<?php echo $this->session->flashdata('msg');?>
			</div>
			
			<?php echo form_open_multipart(base_url().'searchPartnerIdentification',array('method'=>'post', 'name'=>'searchPartnerIdentification','id'=>'searchPartnerIdentification','class'=>'','autocomplete'=>'off'));?>
			<div class="col-sm-4">
				<div class="row">
					<div class="col-sm-5">
						<label>Thematic Area</label>
					</div>
					<div class="col-sm-7">
						<div class="form-group">
							<select name="theme_id" id="theme_id" class="form-control">
								<option value="">-Select-</option>
								<?php 
									foreach($themes as $theme) 
									{
										$thematicArea = $this->Front_model->getData('thematic_areas', 'thematic_area_id',  $theme['parent']);
								?>
									<option value="<?php echo $theme['thematic_area_id'];?>" <?php if($this->session->userdata('theme_id')==$theme['thematic_area_id']){ echo "selected=selected";}?>><?php echo $theme['title'];?> - [<?php echo $thematicArea[0]['title'];?>]</option>
								<?php }?>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-5">
						<label>State</label>
					</div>
					<div class="col-sm-7">
						<div class="form-group">
							<select name="state" id="state" class="form-control">
								<option value="">-Select-</option>
								<?php foreach($states as $state){ ?>
								<option value="<?php echo $state['state_id'];?>" <?php if($this->session->userdata('state_id')==$state['state_id']){ echo "selected=selected";}?>><?php echo $state['title'];?></option>
								<?php }?>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-5">
						<label>City</label>
					</div>
					<div class="col-sm-7">
						<div class="form-group">
							<select name="city" id="city" class="form-control">
								<option value="">-Select-</option>
								<?php 
									if(!empty($this->session->userdata('state_id')))
									{
										$cities = $this->Front_model->getData('cities', 'state_id', $this->session->userdata('state_id'));
										foreach($cities as $city)
										{
											
								?>
								<option value="<?php echo $city['city_id'];?>" <?php if($this->session->userdata('city_id') == $city['city_id']){ echo "selected=selected";}?>><?php echo $city['title'];?></option>
								<?php }}?>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group pull-right">									
							<button type="submit" class="btn btn-warning btn-sm">Search</button>
							<?php if(!empty($prtIdnSess)){ ?><button type="button" class="btn btn-dark-gray btn-sm" onclick="window.location='<?php echo base_url();?>unsetPartnerIdentification'">Reset</button><?php }?>
						</div>
					</div>
				</div>
			</div>
			<?php echo form_close();?>
			
			<?php echo form_open_multipart(base_url().'savePartnerIdentification',array('method'=>'post', 'name'=>'savePartnerIdentification','id'=>'savePartnerIdentification','class'=>'','autocomplete'=>'off'));?>
			<div class="col-sm-6 parameters  col-sm-offset-2">
				<label>Selection Parameters</label>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<div class="chiller_cb">
								<input id="Checkbox1" name="legal_compliance" type="checkbox" value="1" class="parameter"/>
								<label for="Checkbox1">Legal Compliance</label>
								<span></span>
							</div>
							<div class="chiller_cb">
								<input id="Checkbox2" name="sustainability_index" type="checkbox" value="1" class="parameter"/>
								<label for="Checkbox2">Sustainability Index</label>
								<span></span>
							</div>
							<div class="chiller_cb">
								<input id="Checkbox3" name="measurable_results" type="checkbox" value="1" class="parameter"/>
								<label for="Checkbox3">Measurable Results</label>
								<span></span>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<div class="chiller_cb">
								<input id="Checkbox4" name="long_impact" type="checkbox" value="1" class="parameter"/>
									<label for="Checkbox4">Long Term Impact</label>
									<span></span>
							 </div>
							 <div class="chiller_cb">
								<input id="Checkbox5" name="scalability" type="checkbox" value="1" class="parameter"/>
									<label for="Checkbox5">Scalability</label>
									<span></span>
							 </div>
							 <div class="chiller_cb">
								<input id="Checkbox6" name="government_ngo" type="checkbox" value="1" class="parameter"/>
									<label for="Checkbox6">Government of NGO</label>
									<span></span>
							 </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php if(!empty($prtIdnSess)){ ?>
		<button class="btn btn-warning pull-right btn-sm">Save</button>
		<div class="row custom-table">
			<div class="col-sm-12">
				<div class="scroll-table">
					<table class="table table-responsive table-bordered valign-top">
						<tr>
							<td>&nbsp;</td>
							<td style="width:200px;" class="tdcustomwidth">Sectors Working</td>
							<td>Type of NGO</td>
							<td>State</td>
							<td>City</td>
							<td style="width:150px;" class="tdcustomwidth">NGO Name</td>
							<td>Unique ID of VO/NGO</td>
							<td>Reg. No.</td>
							<td style="width:70px;" class="tdcustomwidth">DOE</td>
							<td>Liencse Renewal</td>
							<td style="width:200px;" class="tdcustomwidth">Address</td>
							<td>Contact Person</td>
							<td>Mob. No.</td>
							<td>Tele. No.</td>
							<td>E-mail</td>
							<td>Operational</td>
							<td>Area/ State</td>
							<td style="width:400px;" class="tdcustomwidth">Major Achievement</td>
							<td>Ranking form web</td>
							<td>Annual Turnover</td>
							<td>USP</td>
							<td>Reg. on Certificate</td>
							<td>No. of years of experience</td>
							<td>Audit</td>
							<td>Brands</td>
							<td>Trustee</td>
							<td>Ranking of NGO</td>
						</tr>
						<?php 
							foreach($ngos as $ngo)
							{ 
								$sectors = explode(',', $ngo['sector_id']);
								$stateNm = $this->Front_model->getData('states', 'state_id', $ngo['state']);
								$cityNm = $this->Front_model->getData('cities', 'city_id', $ngo['city']);
						?>
						<tr>
							<td>
								<div class="chiller_cb">
									<input id="<?php echo $ngo['ngo_id'];?>" name="ngo_id[]" value="<?php echo $ngo['ngo_id'];?>" type="checkbox"/>
									<label for="<?php echo $ngo['ngo_id'];?>">a</label>
									<span></span>
								</div>
							</td>
							<td>
								<?php 
									foreach($sectors as $sector)
									{
										$sectorNm = $this->Front_model->getData('m_sectors', 'sector_id', $sector);
								?>
								<span class="padd_sect"><?php echo $sectorNm[0]['title'];?></span>
								<?php }?>
							</td>
							<td><?php echo $ngo['ngo_type'];?></td>
							<td><?php echo $stateNm[0]['title'];?></td>
							<td><?php echo  $cityNm[0]['title'];?></td>
							<td><?php echo $ngo['title'];?></td>
							<td><?php echo $ngo['unique_id'];?></td>
							<td><?php echo $ngo['registeration_no'];?></td>
							<td><?php echo date('d-m-Y', strtotime($ngo['registeration_date']));?></td>
							<td><?php echo $ngo['licence_renew'];?></td>
							<td><?php echo $ngo['address'];?></td>
							<td><?php echo $ngo['contact_person'];?></td>
							<td><?php echo $ngo['mobile'];?></td>
							<td><?php echo $ngo['phone'];?></td>
							<td><?php echo $ngo['email'];?></td>
							<td><?php echo $ngo['operational_area_city'];?></td>
							<td><?php echo $ngo['operational_area_state'];?></td>
							<td><?php echo $ngo['activity'];?></td>
							<td><?php echo $ngo['ranking_f_website'];?></td>
							<td><?php echo $ngo['annual_turnover'];?></td>
							<td><?php echo $ngo['usp'];?></td>
							<td><?php echo $ngo['registeration_certificate'];?></td>
							<td><?php echo $ngo['experience'];?></td>
							<td><?php echo $ngo['audit'];?></td>
							<td><?php echo $ngo['brand'];?></td>
							<td><?php echo $ngo['trustee'];?></td>
							<td><?php echo $ngo['ngo_ranking'];?></td>
						</tr>
						<?php }?>
					</table>
				</div>
			</div>
		</div>
		<?php }?>
		<?php echo form_close();?>
		
	</div>
</div>
<script>
$(document).ready(function(){
	$('#state').change(function () {
		var state = $('#state').val();
		//alert(state);
		$.ajax({
			url: "<?php echo base_url();?>front/ajax/showCity",	
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