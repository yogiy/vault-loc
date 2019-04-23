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
					<!-- <h4><a href="#"><img src="<?/*php echo base_url(); */?>assets/loc/img/user-icon.svg" class="user-icon"/> Anna Hazarey</a></h4> -->
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
							<div class="col-xs-8 text-box">Beneficiary<br/>Module</div>
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
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-6">
						<h4 class="bmheading subheading">Beneficiary<br>Module</h4>
							<div class="panel-orange" id="accordion">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Create New</a>
										</h4>
									</div>
									<div id="collapseOne" class="panel-collapse collapse">
										<div class="panel-body">
											<div class="col-sm-4">
												<a href="#" class="orangebtn uppercase" id="overallSnapshotDataBtn" >Overall Snapshot Data</a>
											</div>
											<div class="col-sm-4">
												<a href="#" class="orangebtn uppercase" id="beneficiaryDataBtn">Beneficiary Data</a>
											</div>
											<div class="col-sm-4">
												<a href="#" class="orangebtn uppercase" id="mapDataBtn">Upload Map Data</a>
											</div>

											<input id="beneficiary_attachment_file_input" type="file" name="xls_files" accept=".xlsx, .xls, .csv" style="display: none;" />
										<!-- Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.  -->
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Overall Snapshots</a>
										</h4>
									</div>
									<div id="collapseTwo" class="panel-collapse collapse in">
										<div class="panel-body">
											<ul class="snapshots list-common">
												<li><img src="<?php echo base_url(); ?>assets/loc/img/totaltraining.png"><span>Total Training: <?=$overall_snapshot['training']?></span></li>
												<li><img src="<?php echo base_url(); ?>assets/loc/img/totalvillages.png"><span>Total Villages: <?=$overall_snapshot['villages']?></span></li>
												<li><img src="<?php echo base_url(); ?>assets/loc/img/totalimpact.png"><span>Total Impact: <?=$overall_snapshot['impact']?></span></li>
												<li><img src="<?php echo base_url(); ?>assets/loc/img/totaltarget.png"><span>Total Target: <?=$overall_snapshot['target']?></span></li>
												<li><img src="<?php echo base_url(); ?>assets/loc/img/completion.png"><span>Completion: <?=$overall_snapshot['completion']?>%</span></li>
											</ul>
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Beneficiary Database</a>
										</h4>
									</div>
									<div id="collapseThree" class="panel-collapse collapse in">
										<div class="panel-body">
											<div class="row">
												<div class="col-sm-12">
													<input type="text" id="beneficiary_table_search" class="inputborder block" name="search" placeholder="Search">
												</div>
											</div>
											<div class="table-scroll">
												<table class="table bluebordertable table-responsive table-bordered">
													<thead>
														<tr>
															<th>Village Name</th>
															<th>Beneficiary Name</th>
															<th>Phone No</th>
															<th>Education Details</th>
															<th>Training</th>
														</tr>
													</thead>
													<tbody id="beneficiary_table_result">
													<?php foreach ($beneficiary_db as $key => $value) {?>
														<tr>
															<td><?=$value->village_name?></td>
															<td><?=$value->beneficiary_name?></td>
															<td class="tphoneicon"><?=$value->phone_no?></td>
															<td><?=$value->education_details?></td>
															<?php if ($value->training) {?>
																<td class="peargreen"></td>
															<?php } else {?>
																<td class="lightorange"></td>
															<?php }?>
														</tr>
														<?php }?>

													</tbody>
												</table>
											</div> <!-- table overflow -->
											<div class="row">
												<div class="col-sm-4">
													<div class="traincon"><span class="peargreen"></span> Training conducted</div>
												</div>
												<div class="col-sm-4">
													<div class="traincon"><span class="lightorange"></span> Training to be conducted</div>
												</div>
												<div class="col-sm-4">
													<a href="#" id="nextSetRecords" class="orangebtn uppercase">More</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div> <!-- panel-orange end -->
						</div>
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
										<select class="form-control" id="benefit_cities_dropdown">
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
									<select class="form-control" id="benefit_level_dropdown">
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
                                        <br />
                                        <a href="<?php echo base_url();?>project-assessment/<?php echo $brief_id;?>" class="btn btn-warning btn-sm pull-right" style="margin-left: 10px; border-radius: 0px">Back</a>

										<!-- <img src="<?php echo base_url(); ?>assets/loc/img/bmodmap.jpg" class="img-responsive"> -->
									</div>
								</div>
							</div>
						</div> <!-- col-sm-12 col-md-7 end -->
					</div> <!-- row end -->
				</div>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/loc/js/bootstrap.min.js"></script>
	
	<!--<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.5.0/dist/chartjs-plugin-datalabels.min.js"></script>	-->
	<script type="text/javascript">
</script>
<script type="text/javascript">

	// $('#thematic_area_drop').on('change', function(event){
	// 	// this is the dropdown change for thematic area
	// 	event.preventDefault();
	// 	selected = $(this).val();
	// 	if(selected == "none"){
	// 		option = $('<option />').attr('value', 'none').text('select');
	// 		$('#thematic_sub_theme_drop').html(option);
	// 	}else{
	// 		$.ajax({
	// 		url: '<?php echo site_url("front/BeneficiaryModule/getSubDataList"); ?>',
	// 		method: "POST",
	// 		data: {inObj: selected},
	// 		success: function(response){
	// 			$('#thematic_sub_theme_drop').html(response);
	// 			}
	// 		});
	// 	}
	// });

	// $('#thematic_area_drop').trigger('change');

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
	// 		url: '<?php echo site_url("front/BeneficiaryModule/getMicroDataList"); ?>',
	// 		method: "POST",
	// 		data: {inObj: selected},
	// 		success: function(response){
	// 			$('#thematic_micro_theme_drop').html(response);
	// 		}

	// 	});
	// 	}
	// });


// $('#thematic_micro_theme_drop').on('change', function(event){
// 	// This is the dropdown for district
// 	event.preventDefault();
// 	selected = $(this).val();
// 	console.log('Micro Theme Selected: '+selected);

// });

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

$('#benefit_cities_dropdown').on('change', function(event){
	// this is the dropdown for state
	event.preventDefault();
	selected = $(this).val();
	if(selected == 'none'){
		location.reload();
	}
	selectedCity = $('#benefit_cities_dropdown option:selected').html();
	// console.log('City Selected: '+selected);
	
	$.ajax({
	url: '<?php echo site_url("front/BeneficiaryModule/getCityData"); ?>',
	method: "POST",
	data: {inObj: selected},
	success: function(response){
			removeCompanyMarkers();
			$('#benefit_level_dropdown').val("none");

			result = JSON.parse(response);
			centeres =   { lat: +result['latitude'], lng: +result['longitude'] };
			plotCityShapeOnMap(selectedCity, centeres);

		}
	});

});


function removeCompanyMarkers(){
	for (var i = 0; i < markers.length; i++) {
          markers[i].setMap(null);
  }
	markers = [];
}

$('#benefit_level_dropdown').on('change', function(event){
	// This is the dropdown for district
	event.preventDefault();
	selected_level = $(this).val();
	level_name = $('#benefit_level_dropdown option:selected').html();
	selected_city = $('#benefit_cities_dropdown').val();
	
	if(selected_city == "none"){
		alert("Please select city first");
		$("#benefit_level_dropdown").val("none");
	}else{
		if(selected_level == "none"){
			removeCompanyMarkers();
		}else{
			city_name = $('#benefit_cities_dropdown option:selected').html();
			console.log("Get level :"+selected_level+" for city: "+city_name)
			$.ajax({
				url: '<?php echo site_url("front/BeneficiaryModule/getLevelMapData"); ?>',
				method: "POST",
				data: {city: city_name, level: selected_level},
				success: function(response){
					console.log('getLevelMapData');
					res = JSON.parse(response);

					removeCompanyMarkers();
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

//SEARCH BOX
$('#beneficiary_table_search').on('input', function(event){
	event.preventDefault();
	selected = $(this).val();
	// if(selected.length > 3){
		$.ajax({
			url: '<?php echo site_url("front/BeneficiaryModule/getSearchResult"); ?>',
			method: "POST",
			data: {q: selected},
			success: function(response){
				$('#beneficiary_table_result').html(response);
			}
		});
	// }
});
var uploadType = null;
$('#overallSnapshotDataBtn').on('click', function(event){
	event.preventDefault();
	// alert('overall');
	uploadType = "overall";
	$('#beneficiary_attachment_file_input').trigger('click');
});
$('#beneficiaryDataBtn').on('click', function(event){
	event.preventDefault();
	// alert('bene');
	uploadType = "bene";
	$('#beneficiary_attachment_file_input').trigger('click');
});
$('#mapDataBtn').on('click', function(event){
	event.preventDefault();
	// alert('map');
	uploadType = "map";
	$('#beneficiary_attachment_file_input').trigger('click');
});
$("#beneficiary_attachment_file_input").on("change paste keyup", function (event) {
    event.preventDefault();

	var formData = new FormData();
	formData.append("pdid", <?php echo $brief_id; ?>);
	formData.append("cityID",  $('#benefit_cities_dropdown').val());
	formData.append("levelID", $('#benefit_level_dropdown').val());
	formData.append("type", uploadType);
	formData.append("files", $(this).get(0).files[0]);

	$.ajax({
		url: "<?php echo site_url("front/BeneficiaryModule/uploadBenefitSheets"); ?>",
		method: "POST",
		data: formData,
		contentType: false,
		cache: false,
		processData: false,
		beforeSend:function(){
			console.log("Preparing to upload....");
			// p = $('<p />').html("Preparing to upload....");
			// $('#monitoring_report_img_preview').html(p);
		},
		success: function(data){
			response = JSON.parse(data);
			console.log(response);
			if(response.status){
				location.reload();
			}else{
				console.log(location.msg);
			}
			// $('#monitoring_report_img_preview').html(data);
			// $('#monitoring_report_attachment-file-input').val('');
		}
	});
});

var benefitOffset = 0;
$('#nextSetRecords').on('click', function(event){
	event.preventDefault();
	benefitOffset++;
	pdid = <?php echo $brief_id; ?>;
	cityID = $('#benefit_cities_dropdown').val(); 
	levelID = $('#benefit_level_dropdown').val();
	$.ajax({
			url: '<?php echo site_url("front/BeneficiaryModule/getNextSetResult"); ?>',
			method: "POST",
			data: {q: benefitOffset, pdid: pdid, cityID:cityID, levelID:levelID },
			success: function(response){
				$('#beneficiary_table_result').html(response);
			}
		});

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
	// centerMarker = new google.maps.Marker({
	// 	position: centeres,
	// 	map: map,
	// 	icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'
	// });
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
		// 	url: '<?php echo site_url("front/BeneficiaryModule/getShapesFromDB"); ?>',
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