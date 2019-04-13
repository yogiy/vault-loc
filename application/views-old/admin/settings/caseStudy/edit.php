<?php 
	$themes = $this->Crud_model->getData2Asc('thematic_areas', 'parent', 'status', $data['thematic_area_id'], 'Active', 'title');
?>
<section class="content">
	<div class="container-fluid">

		<div class="block-header">
			<div class="row clearfix">
				<div class="col-sm-6">
					<h2>Update Case Study</h2>
				</div>
				<div class="col-sm-6">
					<div style="text-align:right">
						<a href="<?php echo base_url();?>admin/settings/caseStudies/display" class="btn bg-orange">Back</a>
					</div>
				</div>
			</div>
		</div>
        <ol class="breadcrumb bc-3">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="entypo-home"></i>Home</a></li>
            <li><a href="<?php echo base_url();?>admin/settings">Admin Settings</a></li>
			<li><a href="<?php echo base_url();?>admin/settings/caseStudies/display">Case Study</a></li>
            <li class="active"><strong>Update Case Study</strong></li>
        </ol>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
                    <?php echo $this->session->flashdata('msg');?>
					<div class="body">
						<?php echo form_open_multipart(base_url().'admin/settings/caseStudy/update',array('method'=>'post', 'name'=>'edit_caseStudy','id'=>'edit_caseStudy','class'=>'form-horizontal form-groups-bordered','autocomplete'=>'off'));?>
						
						<input type="hidden" name="id" value="<?php echo $id;?>">
						<input type="hidden" name="filename" value="<?php echo $data['images'];;?>">
						
                        <div class="panel panel-default" data-collapsed="0">

                            <div class="panel-heading">
                                <div class="panel-title"></div>
                            </div>
                            <div class="panel-body">
                                <div class="form-section ">
									<div class="row">
										<div class="col-sm-4">
											<div class="row">
												
												<div class="col-sm-12">
													<div class="form-group">
														<label>Title</label>
														<input type="" name="title" class="form-control" value="<?php echo $data['title'];?>" placeholder="Title">
													</div>
												</div>
											</div>
											
											<div class="row">
												<div class="col-sm-12">
													<div class="form-group">
														<label>Thematic Area</label>
														<select name="thematic_area_id" id="thematicArea" class="form-control">
															<option value="">-Select-</option>
															<?php foreach($thematicAreas as $ta){ ?>
															<option value="<?php echo $ta['thematic_area_id'];?>" <?php if($ta['thematic_area_id']==$data['thematic_area_id']){ echo "selected=selected";}?>><?php echo $ta['title'];?></option>
															<?php }?>
														</select>
													</div>
												</div>
											</div>
											
											<div class="row">
												<div class="col-sm-12">
													<div class="form-group">										
														<label>Sub Theme</label>
														<select name="theme_id" id="theme" class="form-control">
															<option value="">-Select-</option>
															
															<?php foreach($themes as $th){ ?>
															<option value="<?php echo $th['thematic_area_id'];?>" <?php if($th['thematic_area_id']==$data['theme_id']){ echo "selected=selected";}?>><?php echo $th['title'];?></option>
															<?php }?>
															
														</select>
													</div>
												</div>
											</div>
											
											<?php 
												if($data['type']=='Image')
												{
													$active1 = "display:block;";$checked1 = "checked=checked"; $disabled1="";
												} else {
													$active1 = "display:none;";$checked1 = ""; $disabled1="disabled";
												}
												
												if($data['type']=='Video')
												{
													$active2 = "display:block;";$checked2 = "checked=checked"; $disabled2="";$url=$data['images'];
												} else {
													$active2 = "display:none;";$checked2 = ""; $disabled2="disabled";$url="";
												}
												
												if($data['type']=='Presentation')
												{
													$active3 = "display:block;";$checked3 = "checked=checked"; $disabled3="";
												} else {
													$active3 = "display:none;";$checked3 = ""; $disabled3="disabled";
												}
											?>
											
											<div class="row">
												<div class="col-sm-12">
													<div class="form-group radio-box">										
														<span><input type="radio" name="type" id="img" value="Image" <?php echo $checked1;?>>Image Album</span>
														<span><input type="radio" name="type" id="vdo" value="Video" <?php echo $checked2;?>>Video</span>
														<span><input type="radio" name="type" id="prst" value="Presentation" <?php echo $checked3;?>>Presentation</span>
													</div>
												</div>
											</div>
											
											<div class="row">
												<div class="col-sm-12">
													<div class="form-group">										
														<div class="upload-btn-wrapper" id="imgChse" style="<?php echo $active1;?>">
														  <button class="btn">Choose file</button>
														  <input type="file" name="images" onchange="readURL(this);" id="img111" <?php echo $disabled1;?> />
														</div>
														
														<div class="upload-btn-wrapper" id="vdoChse" style="<?php echo $active2;?>">
														 <input type="text" name="utube" class="form-control" id="vid111" <?php echo $disabled2;?> value="<?php echo $url;?>" placeholder="uTube URL">
														</div>
														
														<div class="upload-btn-wrapper" id="prstChse" style="<?php echo $active3;?>">
														  <button class="btn">Choose file</button>
														  <input type="file" name="presentation" id="present111" <?php echo $disabled3;?> />
														</div>
													</div>
												</div>
											</div>
											
										</div>	
										<div class="col-sm-6 col-sm-offset-2">
											
											<?php if($data['type']=='Image'){ $show = "src='".base_url()."uploads/caseStudy/images/".$data['images']."'";}?>
											<div class="preview-box" id="img11Show" style="<?php echo $active1;?>"><img <?php echo @$show;?> id="imgPop"></div>
											
											<div class="preview-box" id="vdo11Show" style="background:#FFF url('<?php echo base_url();?>assets/admin/images/youtube.png') no-repeat;background-position: 50%; <?php echo $active2;?>"></div>
											
											<div class="preview-box" id="prst11Show" style="background:#FFF url('<?php echo base_url();?>assets/admin/images/powerpoint.png') no-repeat;background-position: 50%; <?php echo $active3;?>"></div>
											
											<div class="form-group mt-30">
												<label>Extra Notes</label>
												<textarea class="form-control" name="description" rows="3"><?php echo $data['description'];?></textarea>
											</div>
										</div>						
									</div>
									
								</div>

								<div class="row">
									<div class="col-sm-12">
										<div class="button-demo">
											<input type="submit" id="submit_form" class="btn btn-blue btn-md waves-effect" value="Save">
											<a href="<?php echo base_url();?>admin/settings/caseStudies/display" class="btn btn-md bg-orange waves-effect">Cancel</a>
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

<style>
	.form-section{padding: 15px 15px;}
	.form-section .upload-btn-wrapper, .modal .upload-btn-wrapper {position: relative;overflow: hidden;display: inline-block;}
	.form-section .upload-btn-wrapper input[type=file], .modal .upload-btn-wrapper input[type=file] {font-size:100px; position:absolute; left:0; top:0; opacity:0;}
	.form-section textarea{border:1px solid #EFEFEF;}

	.preview-box{display:table;border: 1px solid #ebebeb;height:200px;width: 100%;text-align: center;}
	.preview-box h1{ display:table-cell; vertical-align:middle; color:#949599; font-weight: bold;}
	.mt-30{margin-top:30px;}
	.radio-box span{margin-right:10px;}
	input[type="radio"], input[type="checkbox"]{ margin-right: 5px; vertical-align: sub;}
	.preview-box img{max-height:200px;}
	.form-section .upload-btn-wrapper, .modal .upload-btn-wrapper { display: block;}
</style>

<script>

$(document).ready(function () {
	$("#img").click(function(){
	  $('#vdoChse').hide();
	  $('#prstChse').hide();
	  $('#vdo11Show').hide();
	  $('#prst11Show').hide();
	  
	  $( "#img111" ).prop( "disabled", false );
	  $( "#vid111" ).prop( "disabled", true );
	  $( "#present111" ).prop( "disabled", true );
	  
	  $('#imgChse').show();
	  $('#img11Show').show();
	});

	$("#vdo").click(function(){
	  $('#imgChse').hide();
	  $('#prstChse').hide();
	  $('#img11Show').hide();
	  $('#prst11Show').hide();
	  
	  $( "#img111" ).prop( "disabled", true );
	  $( "#vid111" ).prop( "disabled", false );
	  $( "#present111" ).prop( "disabled", true );
	  
	  $('#vdoChse').show();
	  $('#vdo11Show').show();
	});

	$("#prst").click(function(){
	  $('#imgChse').hide();
	  $('#vdoChse').hide();
	  $('#img11Show').hide();
	  $('#vdo11Show').hide();
	  
	  $( "#img111" ).prop( "disabled", true );
	  $( "#vid111" ).prop( "disabled", true );
	  $( "#present111" ).prop( "disabled", false );
	  
	  $('#prstChse').show();
	  $('#prst11Show').show();
	});
});
</script>

<script>
    $(document).ready(function () {
        $("#thematicArea").change(function(){
            var thematicArea = $("#thematicArea").val();
			
            //For product values
            $.ajax({
				url: "<?php echo base_url();?>admin/ajax/showTheme",
				data:{thematicArea:thematicArea},
				method:'post',
				success: function(result){
					$("#theme").html(result);
				}
			});
        });
    });
</script>

<script>
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#imgPop')
					.attr('src', e.target.result)
					//.width(150)
					.height(200);
			};

			reader.readAsDataURL(input.files[0]);
		}
	}
</script>