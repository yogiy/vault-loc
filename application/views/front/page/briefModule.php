	<?php echo form_open_multipart(base_url().'briefModuleUp',array('method'=>'post', 'name'=>'add_briefModule','id'=>'add_briefModule','class'=>'','autocomplete'=>'off'));?>
		<div class="col-md-9 col-sm-9 col-xs-12">
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
									<option value="<?php echo $client['user_id'];?>"><?php echo ucwords($client['fname'].' '.$client['lname']);?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<label>Brand Name</label>
							<select name="brand_id" class="form-control">
								<option value="">-Select-</option>
								<?php foreach($brands as $brand) {?>
									<option value="<?php echo $brand['brand_id'];?>"><?php echo $brand['title'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<label>Category</label>
							<select name="category_id" class="form-control">
								<option value="">-Select-</option>
								<?php foreach($categories as $category) {?>
									<option value="<?php echo $category['category_id'];?>"><?php echo $category['title'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<label>Project Name</label>
							<input type="text" name="project_name" class="form-control"/>
						</div>
						<!-- THEMATIC AREAS -->
						<div class="form-group">
							<label>Thematic Area</label>
							<select name="theme_id" id="theme_id" class="form-control">
								<option value="none">-Select-</option>
								<?php 
									foreach($thematic_areas as $theme) 
									{
										// $thematicArea = $this->Front_model->getData('thematic_areas', 'thematic_area_id',  $theme['parent']);
								?>
									<option value="<?php echo $theme['id'];?>"><?php echo $theme['name'];?> </option>
								<?php }?>
							</select>
						</div>
						<!-- SUBTHEMATICS -->
						<div class="form-group">
							<label>Sub-Theme</label>
							<select name="sub_theme_id" id="sub_theme_id" class="form-control">
								<option value="none">-Select-</option>
							</select>
						</div>
						<!-- MICRO THEMATICS -->
						<div class="form-group">
							<label>Micro-Theme</label>
							<select name="micro_theme_id" id="micro_theme_id" class="form-control">
								<option value="none">-Select-</option>
							</select>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label>Project Duration</label>
							<div class="row date">
								<div class="col-sm-6">
									<label>From</label>
									<input type="date" name="project_duration_from" min="<?php echo date('Y-m-d');?>" class="form-control" placeholder="yyyy/mm/dd"/>
								</div>
								<div class="col-sm-6">
									<label>To</label>
									<input type="date" name="project_duration_to" min="<?php echo date('Y-m-d');?>" class="form-control" placeholder="yyyy/mm/dd"/>
								</div>
							</div>								
						</div>

						<div class="form-group">
							<label>Team Assigned</label>
							<select name="team_id[]" id="team_id" class="form-control" multiple style="height:70px;">
								<?php foreach($roles as $role) {?>
									<option value="<?php echo $role['role_id'];?>"><?php echo $role['title'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<label>Assisted By</label>
							<select name="assisted_by_id[]" id="assisted_by_id" class="form-control" multiple style="height:70px;">
								<option value="">-Select-</option>
							</select>
						</div>
						<div class="form-group">
							<label>Budget</label>
							<input name="budget" type="text" class="form-control"/>
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
											<?php foreach($metros as $metro) {?>
												<option value="<?php echo $metro['market_id'];?>"><?php echo $metro['title'];?></option>
											<?php }?>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3">
									<label>Tier&nbsp;1</label>
								</div>
								<div class="col-sm-9">
									<div class="form-group">
										<select name="tier1_id[]" multiple id="tier1_id" class="form-control market">
											<?php foreach($tier1 as $t1) {?>
												<option value="<?php echo $t1['market_id'];?>"><?php echo $t1['title'];?></option>
											<?php }?>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3">
									<label>Tier&nbsp;2</label>
								</div>
								<div class="col-sm-9">
									<div class="form-group">
										<select name="tier2_id[]" multiple id="tier2_id" class="form-control market">
											<?php foreach($tier2 as $t2) {?>
												<option value="<?php echo $t2['market_id'];?>"><?php echo $t2['title'];?></option>
											<?php }?>
										</select>
									</div>
								</div>
							</div>								
							<div class="row">
								<div class="col-sm-3">
									<label>Tier&nbsp;3</label>
								</div>
								<div class="col-sm-9">
									<div class="form-group">
										<select name="tier3_id[]" multiple id="tier3_id" class="form-control market">
											<?php foreach($tier3 as $t3) {?>
												<option value="<?php echo $t3['market_id'];?>"><?php echo $t3['title'];?></option>
											<?php }?>
										</select>
									</div>
								</div>
							</div>								
							<div class="row">
								<div class="col-sm-3">
									<label>Tier&nbsp;4</label>
								</div>
								<div class="col-sm-9">
									<div class="form-group">
										<select name="tier4_id[]" multiple id="tier4_id" class="form-control market">
											<?php foreach($tier4 as $t4) {?>
												<option value="<?php echo $t4['market_id'];?>"><?php echo $t4['title'];?></option>
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
							<input type="date" name="operational_deadline" class="form-control" min="<?php echo date('Y-m-d');?>" placeholder="yyyy/mm/dd"/>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label>Client Submission Deadline</label>
							<input type="date" name="client_submission_deadline" min="<?php echo date('Y-m-d');?>" class="form-control" placeholder="yyyy/mm/dd"/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class=" col-sm-8">
						<div class="form-group">
							<label>Extra Notes</label>
							<textarea name="notes" class="form-control" rows="3" cols="5"></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<button type="submit" class="btn btn-warning pull-right">Create PDID</button>
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

<?php 
	if(!empty($this->session->userdata('popUpShow')))
	{
		$briefId 		= $this->session->userdata('briefId');
		/*$theme_id 	= $this->session->userdata('theme_id');
		$themeDet 		= $this->Front_model->getData('thematic_areas', 'thematic_area_id', $theme_id);
        $caseStudies 	= $this->Front_model->getData('m_archieves', 'thematic_area_id', $themeDet[0]['parent']);*/
?>

<div class="modal" id="popUp2" style="background-color: rgba(0, 0, 0, 0.8); display: block;">
	<div id="ajaxPopUp">
	<script>
		$(document).ready(function(){
			$(".close").click(function () { $("#popUp2").hide(); });	
		});
	</script>
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<?php /*<h4 class="modal-title text-center" id="myModalLabel"><label>Suggested Case Study</label></h4>
					<div class="row">
						<?php
							$i=0;
							foreach($caseStudies as $caseStudy)
							{ 
								++$i;
								if($caseStudy['type']=='Image')
								{  $imgType ='<img src="'.base_url().'uploads/caseStudy/images/'.$caseStudy['images'].'" class="img-responsive">';}

								if($caseStudy['type']=='Video')
								{  $imgType ='<img src="'.base_url().'assets/front/images/youtube.png" class="img-responsive">';}

								if($caseStudy['type']=='Presentation')
								{  $imgType ='<img src="'.base_url().'assets/front/images/powerpoint.png" class="img-responsive">';}
						?>
							<div class="col-xs-6">
								<div class="img-box">
									<a href="#"><?php echo $imgType;?><div class="img-content"><p>Healthcare</p></div></a>
								</div>
							</div>
					<?php if($i%4==0){break;} } ?>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning btn-sm">more</button>
				</div>*/?>
				<div class="modelcontent">
					<div class="modelsuccessicon"><i class="fa fa-check"></i></div>
					<h3>Success</h3>
					<p> <span class="pdid">PDID: <?php echo $briefId;?></span> has been created successfully.</p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php }?>

<?php 
	$this->session->unset_userdata('popUpShow');
	$this->session->unset_userdata('theme_id');
	$this->session->unset_userdata('briefId');
?>