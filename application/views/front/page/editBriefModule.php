	<?php echo form_open_multipart(base_url().'briefModuleUpdate',array('method'=>'post', 'name'=>'edit_briefModule','id'=>'edit_briefModule','class'=>'','autocomplete'=>'off'));?>
		<input type="hidden" name="id" value="<?php echo $data['brief_module_id'];?>">
		<input type="hidden" name="filename" value="<?php echo $data['filename'];?>">
		<div class="col-md-9 col-sm-6 col-xs-12">
			<div class="form-section">
				
				<div class="row">
					<div class="col-sm-12">
						<?php echo $this->session->flashdata('msg');?>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label>Client Name</label>
							<select name="client_id" class="form-control">
								<option value="">-Select-</option>
								<?php foreach($clients as $client) {?>
									<option value="<?php echo $client['user_id'];?>" <?php if($client['user_id'] == $data['client_id']){ echo "selected=selected";}?>><?php echo ucwords($client['fname'].' '.$client['lname']);?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<label>Brand Name</label>
							<select name="brand_id" class="form-control">
								<option value="">-Select-</option>
								<?php foreach($brands as $brand) {?>
									<option value="<?php echo $brand['brand_id'];?>" <?php if($brand['brand_id'] == $data['brand_id']){ echo "selected=selected";}?>><?php echo $brand['title'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<label>Category</label>
							<select name="category_id" class="form-control">
								<option value="">-Select-</option>
								<?php foreach($categories as $category) {?>
									<option value="<?php echo $category['category_id'];?>" <?php if($category['category_id'] == $data['category_id']){ echo "selected=selected";}?>><?php echo $category['title'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<label>Project Name</label>
							<input type="text" name="project_name" value="<?php echo $data['title'];?>" class="form-control"/>
						</div>
						<div class="form-group">
							<label>Thematic Area</label>
							<select name="theme_id" id="theme_id" class="form-control">
								<option value="">-Select-</option>
								<?php 
									foreach($thematic_areas as $theme) 
									{
										// $thematicArea = $this->Front_model->getData('thematic_areas', 'thematic_area_id',  $theme['parent']);
								?>
									<option value="<?php echo $theme['id'];?>" <?php if($theme['id'] == $data['thematic_area_id']){ echo "selected=selected";}?>><?php echo $theme['name'];?> </option>
								<?php }?>
							</select>
						</div>
						<!-- SUBTHEMATICS -->
						<div class="form-group">
							<label>Sub-Theme</label>
							<select name="sub_theme_id" id="sub_theme_id" class="form-control">
								<option value="none">-Select-</option>
								<?php foreach($sub_thematic_areas as $theme) { ?>
									<option value="<?php echo $theme['id'];?>" <?php if($theme['id'] == $data['sub_theme_id']){ echo "selected=selected";}?>><?php echo $theme['name'];?> </option>
								<?php }?>
							</select>
						</div>
						<!-- MICRO THEMATICS -->
						<div class="form-group">
							<label>Micro-Theme</label>
							<select name="micro_theme_id" id="micro_theme_id" class="form-control">
								<option value="none">-Select-</option>
								<?php foreach($micro_thematic_areas as $theme) { ?>
									<option value="<?php echo $theme['id'];?>" <?php if($theme['id'] == $data['micro_theme_id']){ echo "selected=selected";}?>><?php echo $theme['name'];?> </option>
								<?php }?>
							</select>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label>Project Duration</label>
							<div class="row date">
								<div class="col-sm-6">
									<label>From</label>
									<input type="text" name="project_duration_from" min="<?php echo date('Y-m-d');?>" value="<?php echo date('d-m-Y', strtotime($data['project_duration_from']));?>" class="form-control"  />
								</div>
								<div class="col-sm-6">
									<label>To</label>
									<input type="text" name="project_duration_to" min="<?php echo date('Y-m-d');?>" value="<?php echo date('d-m-Y', strtotime($data['project_duration_to']));?>" class="form-control" />
								</div>
							</div>								
						</div>

						<div class="form-group">
							<label>Team Assigned</label>
							<select name="team_id[]" id="team_id" class="form-control" multiple style="height:70px;">
								<?php 
									foreach($roles as $role) 
									{
										$roleIds = explode(',', $data['team_assigned_id']);
								?>
									<option value="<?php echo $role['role_id'];?>" <?php if(in_array($role['role_id'], $roleIds)){ echo "selected=selected";}?>><?php echo $role['title'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<label>Assisted By</label>
							<select name="assisted_by_id[]" id="assisted_by_id" class="form-control" multiple style="height:70px;">
								<?php 
									$users = $this->Front_model->getData2In('users', 'status', 'Active', 'role_id', $data['team_assigned_id'], 'title');
									foreach($users as $user) 
									{
										$userIds = explode(',', $data['assisted_by_id']);
								?>
									<option value="<?php echo $user['user_id'];?>" <?php if(in_array($user['user_id'], $userIds)){ echo "selected=selected";}?>><?php echo ucwords($user['fname'].' '.$user['lname']);?></option>
								<?php }?>
							</select>
						</div>
						
						<div class="form-group">
							<label>Budget</label>
							<input name="budget" type="text" value="<?php echo $data['budget'];?>" class="form-control"/>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group markets">
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9">
									<label>Markets</label>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3">
									<label>Metros</label>
								</div>
								<div class="col-sm-9">
									<div class="form-group">
										<select name="metro_id[]" multiple id="metro_id" class="form-control market">
											<?php 
												foreach($metros as $metro) 
												{
													$metroArr = explode(',', $data['metro_id']);
											?>
												<option value="<?php echo $metro['market_id'];?>" <?php if(in_array($metro['market_id'], $metroArr)){ echo "selected=selected";}?>><?php echo $metro['title'];?></option>
											<?php }?>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3">
									<label>Tier 1</label>
								</div>
								<div class="col-sm-9">
									<div class="form-group">
										<select name="tier1_id[]" multiple id="tier1_id" class="form-control market">
											<?php 
												foreach($tier1 as $t1) 
												{
													$tier1Arr = explode(',', $data['tier1_id']);
											?>
												<option value="<?php echo $t1['market_id'];?>" <?php if(in_array($t1['market_id'], $tier1Arr)){ echo "selected=selected";}?>><?php echo $t1['title'];?></option>
											<?php }?>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3">
									<label>Tier 2</label>
								</div>
								<div class="col-sm-9">
									<div class="form-group">
										<select name="tier2_id[]" multiple id="tier2_id" class="form-control market">
											<?php 
												foreach($tier2 as $t2) 
												{
													$tier2Arr = explode(',', $data['tier2_id']);
											?>
												<option value="<?php echo $t2['market_id'];?>" <?php if(in_array($t2['market_id'], $tier2Arr)){ echo "selected=selected";}?>><?php echo $t2['title'];?></option>
											<?php }?>
										</select>
									</div>
								</div>
							</div>								
							<div class="row">
								<div class="col-sm-3">
									<label>Tier 3</label>
								</div>
								<div class="col-sm-9">
									<div class="form-group">
										<select name="tier3_id[]" multiple id="tier3_id" class="form-control market">
											<?php 
												foreach($tier3 as $t3) 
												{
													$tier3Arr = explode(',', $data['tier3_id']);
											?>
												<option value="<?php echo $t3['market_id'];?>" <?php if(in_array($t3['market_id'], $tier3Arr)){ echo "selected=selected";}?>><?php echo $t3['title'];?></option>
											<?php }?>
										</select>
									</div>
								</div>
							</div>								
							<div class="row">
								<div class="col-sm-3">
									<label>Tier 4</label>
								</div>
								<div class="col-sm-9">
									<div class="form-group">
										<select name="tier4_id[]" multiple id="tier4_id" class="form-control market">
											<?php 
												foreach($tier4 as $t4) 
												{
													$tier4Arr = explode(',', $data['tier4_id']);
											?>
												<option value="<?php echo $t4['market_id'];?>" <?php if(in_array($t4['market_id'], $tier4Arr)){ echo "selected=selected";}?>><?php echo $t4['title'];?></option>
											<?php }?>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-3"><label title="(Only xlsx or csv format.)">Upload File </label></div>
								<div class="col-xs-9">
									<div class="upload-btn-wrapper">
									  <button class="btn">Choose file</button>
									  <input type="file" name="filename" class="file1" />
									</div>
								</div>
								<div class="col-xs-12"><small><span class="col-sm-12" id="rework_excel" style="font-size: 12px;margin-bottom: 10px;padding-left: 0px;"></span></small></div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-3">
						<!-- Button trigger modal -->
						<div class="form-group">
							<button type="button" id="showArchieve" class="btn btn-primary btn-sm" style="background-color: rgb(182, 197, 208);display: inline-block;border: none; cursor:text;">Suggested case study</button>
							<button type="button" id="mainArchieve" class="btn btn-primary btn-sm" onclick="return abc()">Suggested case study</button>
						</div>
					</div>
					
					<div class="col-sm-3">
						<div class="form-group">
							<label>Operation Deadline</label>
							<input type="text" name="operational_deadline" class="form-control" min="<?php echo date('Y-m-d');?>" value="<?php echo date('d-m-Y', strtotime($data['operational_deadline']));?>" />
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label>Client Submission Deadline</label>
							<input type="text" name="client_submission_deadline" class="form-control" min="<?php echo date('Y-m-d');?>" value="<?php echo date('d-m-Y', strtotime($data['client_submission_deadline']));?>"/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class=" col-sm-8">
						<div class="form-group">
							<label>Extra Notes</label>
							<textarea name="notes" class="form-control" rows="3" cols="5"><?php echo $data['notes'];?></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<button type="submit" class="btn btn-warning pull-right">Update PDID</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php echo form_close();?>
	</div>
</div>

<script>
    $(document).ready(function () {
		$("#mainArchieve").hide();
        $("#theme_id").change(function(){
            var theme_id = $("#theme_id").val();
			
			if(theme_id != ""){
				$("#mainArchieve").show();
				$("#showArchieve").hide();
			} else {
				$("#mainArchieve").hide();
				$("#showArchieve").show();
			}

			if(theme_id == "none"){
				option = $('<option />').attr('value', 'none').text('select');
				$('#sub_theme_id').html(option);
			}else{
				$.ajax({
				url: '<?php echo site_url("front/BriefModule/getSubDataList"); ?>',
				method: "POST",
				data: {inObj: theme_id},
				success: function(response){
					$('#sub_theme_id').html(response);
					}
				});
			}

        });

		$('#sub_theme_id').change(function(event){
			// this is the dropdown change for sub theme thematic area
			event.preventDefault();
			subTheme_id = $(this).val();
			 
			if(subTheme_id == "none"){
				option = $('<option />').attr('value', 'none').text('select');
				$('#micro_theme_id').html(option);

			}else{
				// console.log(subTheme_id);
				$.ajax({
					url: '<?php echo site_url("front/BriefModule/getMicroDataList"); ?>',
					method: "POST",
					data: {inObj: subTheme_id},
					success: function(response){
						$('#micro_theme_id').html(response);
					}
				});
			}
		});



    });
	
	function abc() {
		var theme_id = $("#theme_id").val();
		//alert(theme_id);return false;
        $.ajax({
            url: "<?php echo base_url();?>front/ajax/viewBriefPopup",
            data:{val:theme_id},
            method:'post',
            success: function(result){
                //alert(result);return false;
                $("#ajaxPopUp").html(result);
                $('#popUp').show();
            }
        });
    }
	
	$(document).ready(function () {
		$("#team_id").change(function(){
            var team_id = $("#team_id").val();
			//alert(team_id);
			$.ajax({
				url: "<?php echo base_url();?>front/ajax/viewAssistedBy",
				data:{val:team_id},
				method:'post',
				success: function(result){
					//alert(result);return false;
					$('#assisted_by_id').html(result);
				}
			});			
        });
    });
</script>

<div class="modal" id="popUp" style="display:none;background-color: rgba(0, 0, 0, 0.8);">
    <div id="ajaxPopUp"></div>
</div>