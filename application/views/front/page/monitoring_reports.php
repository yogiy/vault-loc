<?php
	$userId = $this->session->userdata('front_user_id');
	$userDet = $this->Front_model->getData('users', 'user_id', $userId);
	$roleDet = $this->Front_model->getData('roles', 'role_id', $userDet[0]['role_id']);
	$permissions = explode(',', $roleDet[0]['permission_id']);
	$this->session->set_userdata(array('permissions'=> $permissions));
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
	<meta name="HandheldFriendly" content="true">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/loc/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/loc/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/loc/css/style.css"/>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/front/css/custom.css"/>

    <title>Vault</title>
	<style>
	#map_canvas{
		height: 400px;  /* The height is 400 pixels */
    	width: 100%;  /* The width is the width of the web page */
	}
	canvas{
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
	</style>
</head>
<body class="menu-list">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3 col-sm-offset-9">
				<div class="user-label pull-right">
					<!-- <h4><a href="#"><img src="<?php echo base_url(); ?>assets/loc/img/user-icon.svg" class="user-icon"/> Anna Hazarey</a></h4> -->
                    <h4>
						<a href="#"><img src="<?php echo base_url();?>assets/front/images/user-icon.svg" class="user-icon"/>
						<?php echo ucwords($userDet[0]['fname'].' '.$userDet[0]['lname']);?></a>  <span class="saperator">|</span> 
						<a href="<?php echo base_url();?>logout">Logout</a>
						<small>(<?php echo $roleDet[0]['title'];?>)</small>
					</h4>
                </div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-sm-12">
				<ul class="menu-list one">
					<li class="row">
						<a href="#">
							<div class="col-sm-3 col-xs-4 icon-box">
								<img src="<?php echo base_url(); ?>assets/loc/img/brief.png" class="img-responsive"/>
							</div>
							<div class="col-xs-8 text-box">Monitoring<br/>Report</div>
						</a>
					</li>
					<li class="row">
						<a href="#">
							<div class="col-sm-3 col-xs-4 icon-box">
								<img src="<?php echo base_url(); ?>assets/loc/img/planning.png" class="img-responsive"/>
							</div>
							<div class="col-xs-8 text-box">Planning<br/>Module</div>
						</a>
					</li>
					<li class="row">
						<a href="#">
							<div class="col-sm-3 col-xs-4 icon-box">
								<img src="<?php echo base_url(); ?>assets/loc/img/program.png" class="img-responsive"/>
							</div>
							<div class="col-xs-8 text-box">Program<br/>Development</div>
						</a>
					</li>
					<li class="row">
						<a href="#">
							<div class="col-sm-3 col-xs-4 icon-box">
								<img src="<?php echo base_url(); ?>assets/loc/img/archives.png" class="img-responsive"/>
							</div>
							<div class="col-xs-8 text-box">Archives</div>
						</a>
					</li>
					<li class="row">
						<a href="#">
							<div class="col-sm-3 col-xs-4 icon-box">
								<img src="<?php echo base_url(); ?>assets/loc/img/partner.png" class="img-responsive"/>
							</div>
							<div class="col-xs-9 text-box">Partner<br/>Indentification</div>
						</a>
					</li>
					<li class="row">
						<a href="#">
							<div class="col-sm-3 col-xs-4 icon-box">
								<img src="<?php echo base_url(); ?>assets/loc/img/project.png" class="img-responsive"/>
							</div>
							<div class="col-xs-9 text-box">Project<br/>Managment</div>
						</a>
					</li>
					<li class="row">
						<a href="#">
							<div class="col-sm-3 col-xs-4 icon-box">
								<img src="<?php echo base_url(); ?>assets/loc/img/project-assement.png" class="img-responsive"/>
							</div>
							<div class="col-xs-9 text-box">Project<br/>Assessment</div>
						</a>
					</li>
				</ul>
			</div>
			<div class="col-md-9 col-sm-12">
				<div class="form-section">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5 class="inner-page-title">PDID: <?php echo $brief_id; ?></h5>
                        </div>
                    </div>
				<h4 class="subheading">Monitoring Reports</h4>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="row">
								<div class="col-xs-3 col-sm-3 col-md-5">
									<label>Reporting Schedule</label>
								</div>
								<div class="col-xs-9 col-sm-4 col-md-5">
									<select class="form-control" id="monitoring_reporting_schedule">
										<option value="">Please Select</option>
										<option <?php if(!empty($mou[0]['fund_disbursement']) && $mou[0]['fund_disbursement']== 'Monthly') echo 'selected';?>>Monthly </option>
										<option <?php if(!empty($mou[0]['fund_disbursement']) && $mou[0]['fund_disbursement']== 'Bi-monthly') echo 'selected';?>>Bi-monthly</option>
										<option <?php if(!empty($mou[0]['fund_disbursement']) && $mou[0]['fund_disbursement']== 'Quarterly') echo 'selected';?>>Quarterly</option>
										<option <?php if(!empty($mou[0]['fund_disbursement']) && $mou[0]['fund_disbursement']== 'Bi-Annually') echo 'selected';?>>Bi-Annually</option>
										<option <?php if(!empty($mou[0]['fund_disbursement']) && $mou[0]['fund_disbursement']== 'Annually') echo 'selected';?>>Annually</option>
										<option <?php if(!empty($mou[0]['fund_disbursement']) && $mou[0]['fund_disbursement']== 'Custom') echo 'selected';?>>Custom</option>
									</select>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-xs-3 col-sm-3 col-md-5">
									<label>NGO</label>
								</div>
								<div class="col-xs-9 col-sm-4 col-md-5">
									<select class="form-control" id="reporting_schedule_ngolist">
									<option value="none">Select</option>
                                            <?php
                                            foreach ($ngolist as $key => $value) { ?>
											<option value="<?php echo $value['ngo_id'] ?>" ><?php echo $value['title'] ?></option>
											<!-- <option>Tamil Nadu</option> -->
											<!-- <option>UP</option> -->
										    <?php }?>
									</select>
								</div>
							</div>
							<div id="monitoring_report_images_section">
							<a href="#" id="add_reporting_images" class="orangebtn uppercase">Add Images</a> &nbsp;
								<input id="monitoring_report_attachment-file-input" multiple type="file" name="image_files" accept="image/*" style="display: none;" />
								<ul class="monitorimg list-common" id="monitoring_report_img_preview">
									<li><img src="<?php echo base_url(); ?>assets/loc/img/noimg.jpg"></li>
									<li><img src="<?php echo base_url(); ?>assets/loc/img/noimg.jpg"></li>
									<li><img src="<?php echo base_url(); ?>assets/loc/img/noimg.jpg"></li>
									<li><img src="<?php echo base_url(); ?>assets/loc/img/noimg.jpg"></li>
									<li><img src="<?php echo base_url(); ?>assets/loc/img/noimg.jpg"></li>
									<li><img src="<?php echo base_url(); ?>assets/loc/img/noimg.jpg"></li>
									<li><img src="<?php echo base_url(); ?>assets/loc/img/noimg.jpg"></li>
									<li><img src="<?php echo base_url(); ?>assets/loc/img/noimg.jpg"></li>
									<li><img src="<?php echo base_url(); ?>assets/loc/img/noimg.jpg"></li>
								</ul>
							</div>
						</div> <!-- col-lg-6 end -->
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="form-group markets">
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-2">
										<label>Thematic Area</label>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-4">
									<select class="form-control" id="thematic_area_drop" disabled>
											<option value="none">Select</option>
                                            <?php
                                            foreach ($thematic_areas as $key => $value) {
                                            if($value['id'] == $pdid_data['thematic_area_id']) {?>
											    <option selected="selected" value="<?php echo $value['id'] ?>" ><?php echo $value['name'] ?></option>
                                            <?php } else{ ?>
                                                <option value="<?php echo $value['id'] ?>" ><?php echo $value['name'] ?></option>
										    <?php }}?>
										</select>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-2">
										<label>City</label>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-4">
										<select class="form-control" id="monitoring_cities_dropdown">
											<option value="none">Select</option>
											<?php foreach ($cities as $key => $value) {?>
											<option value="<?php echo $value['market_id'] ?>" ><?php echo $value['title'] ?></option>
											<!-- <option>Tamil Nadu</option> -->
											<!-- <option>UP</option> -->
										    <?php }?>
										</select>
									</div>
								</div>	
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-2">
										<label>Sub-Theme</label>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-4">
										<select class="form-control" id="thematic_sub_theme_drop" disabled>
											<option value="none">Select</option>
											<?php foreach($sub_thematic_areas as $theme) { ?>
												<option value="<?php echo $theme['id'];?>" <?php if($theme['id'] == $pdid_data['sub_theme_id']){ echo "selected=selected";}?>><?php echo $theme['name'];?> </option>
											<?php }?>
										</select>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-2">
										<label>Level</label>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-4">
										<select class="form-control" id="monitoring_level_dropdown">
                                            <option value="none">Select</option>
                                            <?php
                                                foreach ($levels as $key => $value) { ?>
                                                    <option value="<?php echo $value['id'] ?>" ><?php echo $value['param_name'] ?></option>
                                            <?php }?>
										</select>
									</div>
								</div>	
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-2">
										<label>Micro Theme</label>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-4">
										<select class="form-control" id="thematic_micro_theme_drop" disabled>
											<option value="none">Select</option>
											<?php foreach($micro_thematic_areas as $theme) { ?>
												<option value="<?php echo $theme['id'];?>" <?php if($theme['id'] == $pdid_data['micro_theme_id']){ echo "selected=selected";}?>><?php echo $theme['name'];?> </option>
											<?php }?>
										</select>
									</div>
								</div>	
								<div class="row">
									<div class="col-sm-12">
										<div id="map_canvas" ></div>
										<div id="img-out"></div>
										<!-- <img src="<?php /* echo base_url(); */?>assets/loc/img/bmodmap.jpg" class="img-responsive"> -->
									</div>
								</div>									
							</div>
						</div> <!-- col-sm-12 col-md-7 end -->
					</div> <!-- row end -->
					
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">
							<p align="right"><a href="<?php echo base_url();?>project-assessment/<?php echo $brief_id;?>" class="orangebtn uppercase" style="margin-right:10px;">Back</a><a href="#" id="pdf_make" class="orangebtn uppercase">PDF</a> &nbsp; <a href="#" id="ppt_make" class="orangebtn uppercase">PPT</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/loc/js/bootstrap.min.js"></script>    
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
	<script src="https://superal.github.io/canvas2image/canvas2image.js"></script>	
	<script src="<?php echo base_url(); ?>assets/loc/js/html2canvas.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/gitbrent/pptxgenjs@2.5.0/libs/jszip.min.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/gitbrent/pptxgenjs@2.5.0/dist/pptxgen.min.js"></script>


<script type="text/javascript">
/*
	GENERATE PPT FROM HTML USING THIS JS PACKAGE
	https://www.npmjs.com/package/pptxgenjs
*/

 
$('#ppt_make').on('click', function(event){
	event.preventDefault();
	ngoID = $('#reporting_schedule_ngolist').val();
	if(ngoID == 'none'){
		alert('Please select NGO first...');
	}else{
		html2canvas($("#map_canvas"), {
            useCORS: true,
            onrendered: function(canvas) {            
				preparePPTdata(canvas.toDataURL('image/png'));
            }
		});
	}
});

function makePPT(reportingImgs, mapImage){
	logoImg = "<?php echo base_url(); ?>assets/front/images/indeed-logo.png";
	reportingName = $('#monitoring_reporting_schedule option:selected').text();
	ngoName = 		$('#reporting_schedule_ngolist option:selected').text();
	thematicName = 	$('#thematic_area_drop option:selected').text();
	subThemeName = 	$('#thematic_sub_theme_drop option:selected').text();
	microThemeName= $('#thematic_micro_theme_drop option:selected').text();
	cityName = 		$('#monitoring_cities_dropdown option:selected').text();
	levelName = 	$('#monitoring_level_dropdown option:selected').text();

	var pptx = new PptxGenJS();
	var slideIntro = pptx.addNewSlide();
	slideIntro.addImage({ path:logoImg, x:8, y:0.5, w:1.3 });//.addImage({ path:'img2.jpg', x:5, y:3 });
	slideIntro.addText('MONITORING REPORTS', { x:0, y:2, fontSize:32, w:'100%',align:'right',fontFace:'Franklin', charSpacing:0, color:'fd9325', bold:true });
	slideIntro.addText('DENTSU AEGIS NETWORK', { x:0, y:2.3, fontSize:20, w:'100%',align:'right', color:'363636', bold:true });
	
	var slide1 = pptx.addNewSlide();
	rows1 = [
		{text:'Monitoring Reports'}, 
		{text:'PDID: '+<?php echo $brief_id; ?>, options: {align:'right'}}];
	slide1.addTable( rows1, { x:0.5, y:0.1, w:9.0, border:{pt:0}, fontSize:20, color:'fd9325' } );
	var rows2 = [
		['Reporting Schedule: '+reportingName, 'Thematic Area: '+thematicName, 'City:'+cityName],
		['NGO: '+ngoName, 'Sub Theme: '+subThemeName, 'Level:'+levelName],
		['', 'Micro Theme: '+microThemeName, '']
	];
	var tabOpts = { x:0.5, y:1, w:9.0, fill:'F7F7F7',border:{pt:0}, fontSize:12, color:'fd9325' };
	slide1.addTable( rows2, tabOpts );
	slide1.addImage({ data:mapImage, x:3, y:2, w: 4, h:3.5 });
	slide1.addImage({ path:logoImg, x:8.2, y:4.5, w:1, h:0.7 });

	for (x in reportingImgs) {
		var slide2 = pptx.addNewSlide();
		count = (+x+1);
		slide2.addText('Reporting Image '+(count), { x:0, y:0.5, fontSize:18, w:'100%',align:'center', color:'fd9325', bold:true });
		slide2.addImage({ path:"<?php echo base_url(); ?>"+reportingImgs[x], x:3, y:1, w: 4.5, h:4.2 });
	} 

	var slideLast = pptx.addNewSlide();
	slideLast.addImage({ path:logoImg, x:8, y:0.5, w:1.3 });
	slideLast.addText('Thank you', {x:0.5, y:2, w:'20%', fontSize:24});
	slideLast.addText('DENTSU AEGIS NETWORK INDIA', {x:0, y:5, w:'100%', align:'left',fontSize:18, bold:true});
	slideLast.addText('Poonam Chambers, B Wing, 6th Floor, Dr. Annie Besant Road Mumbai 400018, Maharashtra, India', {x:0, y:5.2, w:'100%', align:'left',fontSize:12, bold:true});

	pptx.save(ngoName+' Report');

}

function preparePPTdata(inImg){
	
	ngoID = $('#reporting_schedule_ngolist').val();
	console.log("ngoID: "+ngoID);
	pdid = <?php echo $brief_id; ?>;
	$.ajax({
		url: '<?php echo site_url("front/MonitoringReport/getImageListForNGOByPdid"); ?>',
		method: "POST",
		data: {ngoID: ngoID, pdid:pdid},
		success: function(response){
			reportingImgs = JSON.parse(response);
			// console.log(reportingImgs);
			makePPT(reportingImgs, inImg);
		}
	});
}

$('#pdf_make').on('click', function(event){
	event.preventDefault();
	if(ngoID == 'none'){
		alert('Please select NGO first...');
	}else{
		html2canvas($("#map_canvas"), {
            useCORS: true,
			//allowTaint:true,
            onrendered: function(canvas) {
                // theCanvas = canvas;
                // document.body.appendChild(canvas);

                // Convert and download as image 
                // Canvas2Image.saveAsPNG(canvas, "400", "400"); 
				dataURL = canvas.toDataURL('image/png');
				
                // $("#img-out").append(canvas);
                // Clean up 
				// document.body.removeChild(canvas);
				/////////////////
				ngoID = $('#reporting_schedule_ngolist').val();
				pdid = <?php echo $brief_id; ?>;

				reportingName = $('#monitoring_reporting_schedule option:selected').text();
				ngoName = 		$('#reporting_schedule_ngolist option:selected').text();
				thematicName = 	$('#thematic_area_drop option:selected').text();
				subThemeName = 	$('#thematic_sub_theme_drop option:selected').text();
				microThemeName= $('#thematic_micro_theme_drop option:selected').text();
				cityName = 		$('#monitoring_cities_dropdown option:selected').text();
				levelName = 	$('#monitoring_level_dropdown option:selected').text();
				
				var req = new XMLHttpRequest();
				req.open("POST", "<?php echo site_url("front/MonitoringReport/generatePDF"); ?>", true);

				req.responseType = "blob";
				req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				req.send("mapImg="+dataURL+"&ngoID="+ngoID+"&pdid="+pdid+"&reportingName="+reportingName+"&ngoName="+ngoName+"&thematicName="+thematicName+"&subThemeName="+subThemeName+"&microThemeName="+microThemeName+"&cityName="+cityName+"&levelName="+levelName);

				req.onreadystatechange = function() {//Call a function when the state changes.
					if(req.readyState == 4 && req.status == 200) {
					}
				}

				req.onload = function (event) {
					var blob = req.response;
					// console.log(blob.size);
					var link=document.createElement('a');
					link.href=window.URL.createObjectURL(blob);
					link.download = ngoName + " Report.pdf";
					link.click();
				};
				return;
				/////////////////

            }
		});
	}
});


//////UPLOAD IMAGES/////////////////////////////////////

$('#add_reporting_images').on('click',  function (event) {
    event.preventDefault();
	ngoID = $('#reporting_schedule_ngolist').val();
	if(ngoID != 'none'){
    	$('#monitoring_report_attachment-file-input').trigger('click');
	}else{
		alert('Please select NGO First');
	}
});

$('#reporting_schedule_ngolist').on('change', function(event){
    event.preventDefault();
	ngoID = $('#reporting_schedule_ngolist').val();
	pdid = <?php echo $brief_id; ?>;
	$.ajax({
		url: '<?php echo site_url("front/MonitoringReport/getImageDataByNgo"); ?>',
		method: "POST",
		data: {ngoID: ngoID, pdid:pdid},
		success: function(response){
				$('#monitoring_report_img_preview').html(response);
		}
	});
});

$("#monitoring_report_attachment-file-input").on("change paste keyup", function (event) {
    event.preventDefault();
	console.log('file is uploaded');
	ngoID = $('#reporting_schedule_ngolist').val();
	report_schedule = $('#monitoring_reporting_schedule option:selected').text();
	pdid = <?php echo $brief_id; ?>;
	// $(this).get(0)
	var image_files = $(this).get(0).files;
	// var image_files = $('#image_files')[0].files;
	var formData = new FormData();
	for(count=0; count<image_files.length; count++){
		formData.append("files[]", image_files[count]);
	}
	formData.append("ngoID", ngoID);
	formData.append("report_schedule", report_schedule);
	formData.append("pdid", pdid);
	$.ajax({
		url: "<?php echo site_url("front/MonitoringReport/uploadMonitoringImgs"); ?>",
		method: "POST",
		data: formData,
		contentType: false,
		cache: false,
		processData: false,
		beforeSend:function(){
			console.log("Preparing to upload....");
			p = $('<p />').html("Preparing to upload....");
			$('#monitoring_report_img_preview').html(p);
		},
		success: function(data){
			// console.log(data);
			$('#monitoring_report_img_preview').html(data);
			$('#monitoring_report_attachment-file-input').val('');
		} 
	});

});
//////////////////UPLOAD IMAGES SECTION ENDDS HERE////////////////////////////////////////////

// $('#thematic_area_drop').on('change', function(event){
// 		// this is the dropdown change for thematic area
// 		event.preventDefault();
// 		selected = $(this).val();
// 		if(selected == "none"){
// 			option = $('<option />').attr('value', 'none').text('select');
// 			$('#thematic_sub_theme_drop').html(option);
// 		}else{
// 			$.ajax({
// 			url: '<?php echo site_url("front/MonitoringReport/getSubDataList"); ?>',
// 			method: "POST",
// 			data: {inObj: selected},
// 			success: function(response){
// 				$('#thematic_sub_theme_drop').html(response);
// 				}
// 			});
// 		}
// 	});


	// $('#thematic_sub_theme_drop').on('change', function(event){
	// 	// this is the dropdown change for sub theme thematic area
	// 	event.preventDefault();
	// 	selected = $(this).val();
	// 	if(selected == "none"){
	// 		option = $('<option />').attr('value', 'none').text('select');
	// 		$('#thematic_micro_theme_drop').html(option);
	// 	}else{
	// 		console.log(selected);
	// 		$.ajax({
	// 		url: '<?php echo site_url("front/MonitoringReport/getMicroDataList"); ?>',
	// 		method: "POST",
	// 		data: {inObj: selected},
	// 		success: function(response){
	// 			$('#thematic_micro_theme_drop').html(response);
	// 		}

	// 	});
	// 	}
	// });

	// $('#thematic_area_drop').trigger('change');

$('#thematic_micro_theme_drop').on('change', function(event){
	// This is the dropdown for district
	event.preventDefault();
	selected = $(this).val();
	console.log('Micro Theme Selected: '+selected);

});


var dataCityLayer;
function plotCityShapeOnMap(cityName, centre){
	if(dataCityLayer !== null && dataCityLayer !== undefined ){
		dataCityLayer.setMap(null);
		dataCityLayer = null;
	}
	dataCityLayer = new google.maps.Data();

	dataCityLayer.loadGeoJson(
		"<?php echo base_url();?>assets/front/mapgeojson/city/"+cityName+".geojson"		
	);
	dataCityLayer.addListener('mouseover', function(event) {
		dataCityLayer.revertStyle();
		dataCityLayer.overrideStyle(event.feature, {fillColor: 'yellow' });
	});

	dataCityLayer.addListener('mouseout', function(event) {
		dataCityLayer.revertStyle();
	});

	dataCityLayer.setMap(map);
	map.setCenter(centre);
	map.setZoom(8);
	map.panTo(centre);

}

$('#monitoring_cities_dropdown').on('change', function(event){
	// this is the dropdown for state
	event.preventDefault();
	selected = $(this).val();
	if(selected == 'none'){
		location.reload();
	}
	selectedCity = $('#monitoring_cities_dropdown option:selected').html();
	// console.log('City Selected: '+selected);
	
	$.ajax({
	url: '<?php echo site_url("front/MonitoringReport/getCityData"); ?>',
	method: "POST",
	data: {inObj: selected},
	success: function(response){
			getMapDBData();
			$('#monitoring_level_dropdown').val("none");

			result = JSON.parse(response);
			centeres =   { lat: +result['latitude'], lng: +result['longitude'] };
			plotCityShapeOnMap(selectedCity, centeres);

			
		}
	});
	
});

function getMapDBData(){
	pdid = <?php echo $brief_id; ?>;
	cityID = $('#monitoring_cities_dropdown').val(); 
	levelID = $('#monitoring_level_dropdown').val();
	$.ajax({
			url: '<?php echo site_url("front/MonitoringReport/getMapDBData"); ?>',
			method: "POST",
			data: {pdid: pdid, cityID:cityID, levelID:levelID },
			success: function(response){
				removeCompanyMarkers();
				res = JSON.parse(response);
				console.log(res);
				for (var i = 0; i < res.length; i++) {  
					var infowindow = new google.maps.InfoWindow();

					var marker = new google.maps.Marker({
						position: new google.maps.LatLng(res[i].latitude, res[i].longitude),
						map: map
					});

					google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
						return function() {
							infowindow.setContent(res[i].city+" : "+res[i].count);
							infowindow.open(map, marker);
						}
					})(marker, i));
					markers.push(marker);							
				}
			}
		});
}


function removeCompanyMarkers(){
	for (var i = 0; i < markers.length; i++) {
          markers[i].setMap(null);
  }
	markers = [];
}

$('#monitoring_level_dropdown').on('change', function(event){
	// This is the dropdown for level
	event.preventDefault();
	selected_level = $(this).val();
	level_name = $('#monitoring_level_dropdown option:selected').html();
	selected_city = $('#monitoring_cities_dropdown').val();
	if(selected_city == "none"){
		alert("Please select city first");
		$("#monitoring_level_dropdown").val("none");
	}else{
		if(selected_level == "none"){
			removeCompanyMarkers();
		}else{
			getMapDBData();
			city_name = $('#monitoring_cities_dropdown option:selected').html();
			console.log("Get level :"+selected_level+" for city: "+city_name)
			$.ajax({
				url: '<?php echo site_url("front/MonitoringReport/getLevelMapData"); ?>',
				method: "POST",
				data: {city: city_name, level: selected_level},
				success: function(response){
					console.log('getLevelMapData');
					res = JSON.parse(response);

					// for (var i = 0; i < locations.length; i++) {  
					var infowindow = new google.maps.InfoWindow();

								var marker = new google.maps.Marker({
									position: new google.maps.LatLng(centeres.lat, centeres.lng),
									map: map
								});

								google.maps.event.addListener(marker, 'mouseover', (function(marker) {
									return function() {
										infowindow.setContent(level_name+" : "+res.amount);
										infowindow.open(map, marker);
									}
								})(marker));
								markers.push(marker);							
							// }
				}
			});
		}
	}

});

</script>
<script>
	var map = null;
	var markers = [];
	var centeres =   { lat: 21.9937, lng: 78.9629};
	var options = { zoom: 4, disableDefaultUI: true, center: centeres};
	var centerMarker = null;

function initMap() {
  // The map, centered at india
  	map = new google.maps.Map(document.getElementById('map_canvas'), options);
	  getMapDBData();
}

    </script>

	<script src="https://maps.googleapis.com/maps/api/js?key=<?=$apiKey;?>&callback=initMap" async defer></script>

<script>

function polygonCenter(polys) {
		var cord = '';
        var lowx,
        highx,
        lowy,
        highy,
        lats = [],
        lngs = [],
        vertices = polys.getPath();

    for(var i=0; i<vertices.length; i++) {
      lngs.push(vertices.getAt(i).lng());
      lats.push(vertices.getAt(i).lat());
    }

    lats.sort();
    lngs.sort();
    lowx = lats[0];
    highx = lats[vertices.length - 1];
    lowy = lngs[0];
    highy = lngs[vertices.length - 1];
    center_x = lowx + ((highx-lowx) / 2);
    center_y = lowy + ((highy - lowy) / 2);
	//console.log(center_x, center_y);
	 cord = center_x+"-"+center_y;
    return cord;
  }

function parsePolyStrings(ps) {
    var i, j, lat, lng, tmp, tmpArr,
        arr = [],
        //match '(' and ')' plus contents between them which contain anything other than '(' or ')'
        m = ps.match(/\([^\(\)]+\)/g);
    if (m !== null) {
        for (i = 0; i < m.length; i++) {
            //match all numeric strings
            tmp = m[i].match(/-?\d+\.?\d*/g);
            if (tmp !== null) {
                //convert all the coordinate sets in tmp from strings to Numbers and convert to LatLng objects
                for (j = 0, tmpArr = []; j < tmp.length; j+=2) {
                    // lat = Number(tmp[j]);
                    // lng = Number(tmp[j + 1]);
					lng = Number(tmp[j]);
					lat = Number(tmp[j + 1]);
                    tmpArr.push(new google.maps.LatLng(lat, lng));
                }
                arr.push(tmpArr);
            }
        }
    }
    //array of arrays of LatLng objects, or empty array
    return arr;
}
	// this is to get the shapes from the database
		// $.ajax({
		// 	url: '<?php echo site_url("front/MonitoringReport/getShapesFromDB"); ?>',
		// 	method: "GET",
		// 	success: function(response){


		// 		var polys = [response];
        //         console.log(polys);
		// 		var polygonCente = new Array();
		// 		var count = new Array();
		// 		var dat = new Array();    //console.log(jQuery.parseJSON(polys));
		// 		var bounds = new google.maps.LatLngBounds();
		// 		for (i = 0; i <polys.length ; i++) {
		// 				tmp = parsePolyStrings(polys[i]);
		// 				console.log(tmp);
		// 				if (tmp.length) {

		// 					polys[i] = new google.maps.Polygon({
		// 						paths : tmp,
		// 						strokeColor : '#696969',
		// 						strokeOpacity : 0.8,
		// 						strokeWeight : 1.5,
		// 						fillColor : '#fff', //'#FF0000',
		// 						// fillColor : fillcolor, //'#FF0000',
		// 						fillOpacity : 0.4,

		// 					});
		// 					fillcolor='';
		// 					 polygonCente[i] = polygonCenter(polys[i]);
		// 					// dat[i] = i+"-"+pincode[i]+'-'+polygonCente[i];
		// 					//console.log("set to map: "+map);
		// 					polys[i].setMap(map);
		// 					// google.maps.event.addListener(polys[i], 'click', attachInfoWindow(polys[i], i,polygonCente[i]));
		// 				}
		// 			}
				
		// 		//*/
		// 	}// ajax call to get shapes
		// });

</script>
</body>
</html>