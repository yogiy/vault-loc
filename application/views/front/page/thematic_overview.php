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
		/* overflow: hidden; */
	}
	#info-box {
    background-color: white;
    border: 1px solid black;
    bottom: 30px;
    padding: 10px;
    position: absolute;
    display:none;
}
	#perform_count{
		font-weight: bold;
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
							<div class="col-xs-8 text-box">Thematic<br/>Overview</div>
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
				<h4 class="subheading">Thematic Overview</h4>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="row">
								<div class="col-xs-3 col-sm-3 col-md-4">
									<label>Thematic Area</label>
								</div>
								<div class="col-xs-9 col-sm-4 col-md-8">
									<select class="form-control" id="thematic_areas_drop">
										<option value="none" >Select</option>
										<?php /* $data_key = array_keys($thematic); */
foreach ($thematic as $key => $value) {?>
											<option value="<?php echo $value['id'] ?>" ><?php echo $value['name'] ?></option>
										<!-- <option>Women Empowerment</option> -->
										<?php }?>
									</select>
								</div>
							</div>
							<br>
							<h4 class="subheading" align="center">CSR Spends</h4>
							<ul class="list-common chartsymwrap">
								<li><p class="chartsym"><span class="bg-orange">&nbsp;</span> Actual</p></li>
								<li><p class="chartsym"><span class="bg-seablue">&nbsp;</span> Forecasted</p></li>
							</ul>
							<canvas id="csrspendschart" width="400" height="280"></canvas>
							<br>
							<h4 class="subheading">Parameter Performance</h4>
							<p align="right"><small class="color-o"><i>Parameter count : <span id="perform_count"> 0</span></i></small></p>
							<canvas id="parameterperformancechart" width="400" height="280"></canvas>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="row tcompanies">
								<div class="col-sm-12 col-md-12 col-lg-2">
								</div>
								<div class="col-xs-4 col-sm-3 col-md-4 col-lg-4">
									<img src="<?php echo base_url(); ?>assets/loc/img/company.jpg">
								</div>
								<div class="col-xs-8 col-sm-9 col-md-8 col-lg-4">
									<h4>Companies</h4>
									<h3 id="company_numbers" >0</h3>
								</div>
								<div class="col-sm-12 col-md-12 col-lg-2">
								</div>
							</div>
							<div class="row topstates">
								<div class="col-sm-12 col-md-12 col-lg-12">
									<h4>Top States</h4>
									<div class="topstatestable"></div>
								</div>
							</div>
							<div class="form-group markets">
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-2">
										<label>State</label>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-4">
										<select class="form-control" id="thematic_states_dropdown" disabled>
											<option value="none">Select</option>
											<?php foreach ($states as $key => $value) {?>
												<option value="<?php echo $value->state_id ?>" ><?php echo $value->title ?></option>
												<!-- <option>Tamil Nadu</option> -->
												<!-- <option>UP</option> -->
											<?php }?>
										</select>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-2">
										<label>District</label>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-4">
										<select class="form-control" id="thematic_district_dropdown" disabled>
											<option value="none">Select</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-2">
										<label>Year</label>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-4">
										<select class="form-control" id="thematic_fiscal_dropdown" disabled>
										<?php foreach ($years as $key => $value) {?>
												<option value="<?php echo $value['fy_year'] ?>" >FY <?php echo $value['fy_year'] ?></option>
											<?php }?>
										</select>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-2">
										<label>Client</label>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-4">
										<select class="form-control" id="thematic_company_dropdown" disabled>
											<option value="none">Select</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
												<div id="map_canvas" ></div>
												<div id="info-box" >Move mouse over region</div>
												<a href="<?php echo base_url();?>dashboard" class="btn btn-warning btn-sm pull-right" style="margin-left: 10px; border-radius: 0px">Back</a>
												
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<!-- load D3js -->
	<script src="//d3plus.org/js/d3.js"></script>
	<!-- load D3plus after D3js -->
	<script src="//d3plus.org/js/d3plus.js"></script>
	<!--<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.5.0/dist/chartjs-plugin-datalabels.min.js"></script>	-->
<script type="text/javascript">
		var thematic_top_state_data = [];
		var thematic_top_state_dataset = JSON.parse(<?= json_encode($top_states) ?>);
		$.each(thematic_top_state_dataset, function (i, item) {
			key = item.name;
			value = +item.value;
			thematic_top_state_data.push({"name":key, "value":value});
		});

	// instantiate d3plus
	// d3plus.textWrap()
  var visualization = d3plus.viz()
		.container(".topstatestable")  // container DIV to hold the visualization
    .data(thematic_top_state_data)  // data to use with the visualization
    .type("tree_map")   // visualization type
		.id("name")         // key for which our data is unique on
		.size("value")
		// .labels({"font": {"size": 8}})
		.resize(true)
		.labels({'align': 'center', 'valign': 'top'})
		.font({ "family": "Times", "size":"10px","resize":"false" } )     // sizing of blocks
		.draw();             // finally, draw the visualization!

	var bubbleChart = new Chart(document.getElementById("parameterperformancechart"), {
			type: 'bubble',
			data: {
				labels: "",
				datasets: [
					{ label: "a", backgroundColor: "#ffdd33", borderColor: "rgba(255,221,50,1)", data: [{x: 5,y: 48,r: 25}]     }, 
					{ label: ["b"],	backgroundColor: "rgba(60,186,159,0.2)", borderColor: "rgba(60,186,159,1)",data: [{x: 15, y: 25, r: 20}] }, 
					{ label: ["c"],	backgroundColor: "rgba(0,0,0,0.2)", borderColor: "#000", data: [{x: 65,y: 80,r: 35}] }, 
					{ label: ["d"], backgroundColor: "rgba(193,46,12,0.2)", borderColor: "rgba(193,46,12,1)", data: [{x: 45,y: 85,r: 30}] }
				]
			},
			options: {
				tooltips:{
					callbacks: {
            label: function(t, d) {
               return d.datasets[t.datasetIndex].label + 
                      ': ( Amount:' + t.yLabel + ')';
            }}
				},
				layout: {
					padding: {
						left: 10,
						right: 10,
						top: 20,
						bottom: 10
					}
				},
				legend: {
					display: false,
					position:'bottom',
					label: {
							fontSize: 4,
							padding: 2
					}
					
				},
				title: {
					display: false,
					text: ''
				},
				scales: {
					yAxes: [{
						ticks:{
							beginAtZero: true,
						},
						scaleLabel: {
							display: false,
							labelString: ""
						},
						gridLines: {
							display: true,
							color: "#fff"
						}
					}],
					xAxes: [{
						scaleLabel: {
							display: false,
							labelString: ""
						},
						gridLines: {
							display: true,
							color: "#fff"
						}
					}]
				}
			}
		});

function removeCompanyMarkers(){
	for (var i = 0; i < markers.length; i++) {
          markers[i].setMap(null);
  }
	markers = [];
}

	$("#thematic_company_dropdown").on('change', function(event){
		event.preventDefault();
		selected = $(this).val();
		if (selected == 'none') {
			removeCompanyMarkers();
			// console.log("RESET DATA");
		} else {
			thematicId = $('#thematic_areas_drop').val();
			stateId = $('#thematic_states_dropdown').val();
			fiscal = $('#thematic_fiscal_dropdown').val();
			districtId = $('#thematic_district_dropdown').val() == 'none' ? 0 : $('#thematic_district_dropdown').val();
			company_name = $('#thematic_company_dropdown option:selected').html();

			$.ajax({
				url: '<?php echo site_url("front/ThematicOverview/getMapDataForCompany"); ?>',
				method: "POST",
				data: { thematic: thematicId, state:stateId, fiscal_year: fiscal, district: districtId, company: company_name },
				success: function(resp){
			
			removeCompanyMarkers();
					
					// console.log(resp);
					locations = JSON.parse(resp);
					var infowindow = new google.maps.InfoWindow();

						for (var i = 0; i < locations.length; i++) {  
							var marker = new google.maps.Marker({
								position: new google.maps.LatLng(locations[i]['lat'], locations[i]['lng']),
								map: map
							});

							google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
								return function() {
									infowindow.setContent("Amount: "+locations[i]['amount']);
									infowindow.open(map, marker);
								}
							})(marker, i));
							markers.push(marker);							
						}

		////////////////////MARKERS ENDS
				}
			});
		}
	});

	$('#thematic_fiscal_dropdown').on('change', function (event){
		event.preventDefault();
		removeCompanyMarkers();
		thematicId = $('#thematic_areas_drop').val();
		stateId = $('#thematic_states_dropdown').val();
		fiscal = $('#thematic_fiscal_dropdown').val();

		$.ajax({
				url: '<?php echo site_url("front/ThematicOverview/getMapDataByFiscal"); ?>',
				method: "POST",
				data: { thematic: thematicId, state:stateId, fiscal_year: fiscal },
				success: function(resp){
					// console.log('Map data');
					// console.log(resp);
					dataOverview = JSON.parse(resp);
					
					var spendAmountsD = [];
					dataOverview.forEach(function(row){
						spendAmountsD.push(+row.AMOUNT);
					});
					maxValue = Math.max(...spendAmountsD);
					minValue = Math.min(...spendAmountsD );
					secondMid = (maxValue + minValue) / 2 ;
					firstMid =  (maxValue + secondMid) / 2 ;
					thirdMid =  (secondMid + minValue) / 2 ;
					ranges = [maxValue, firstMid, secondMid, thirdMid, minValue];	

					plotStateShapes(state_selected, null, dataOverview, ranges);

				}
			});
	});

	function getCompanyCount(selected){
		$.ajax({ url: '<?php echo site_url("front/ThematicOverview/getCompanyCount"); ?>',
				method: "POST",
				data: { inObj: selected },
				success: function(company_count){
					$('#company_numbers').text(company_count); 
				}
			});
	}

	function getTopStatesData(selected){
		$.ajax({ url: '<?php echo site_url("front/ThematicOverview/getTopStatesData"); ?>',
				method: "POST",
				data: { inObj: selected },
				success: function(top_states){
					thematic_top_state_data = [];
					$.each(JSON.parse(top_states), function (i, item) {
						key = item.name;
						value = +item.value;
						thematic_top_state_data.push({"name":key, "value":value});
					});
					visualization.data(thematic_top_state_data).draw();
					
				}
			});
	}

	function getCompanyListData(){
		thematicID = $('#thematic_areas_drop').val();
		stateID = ($('#thematic_states_dropdown').val() == 'none') ? null : $('#thematic_states_dropdown').val();
		districtID = ($('#thematic_district_dropdown').val() == 'none') ? null : $('#thematic_district_dropdown').val()

		$.ajax({ url: '<?php echo site_url("front/ThematicOverview/getCompanyList"); ?>',
				method: "POST",
				data: { thematic:thematicID,  state: stateID, district: districtID },
				success: function(res){
					companies = JSON.parse(res);
					// console.log(companies);
					// $('#company_numbers').text(companies.length); 
					companySelect = $("#thematic_company_dropdown");
					companySelect.empty(); 
					companySelect.append($("<option/>").attr("value", "none").text("Select"));
					$.each(companies, function(a, b) {
						companySelect.append($("<option/>").attr("value", b.id).text(b.company));
					});
				}
			});
	}

	function getMapData(selected){
		$.ajax({ url: '<?php echo site_url("front/ThematicOverview/getCSRMapData"); ?>',
				method: "POST",
				data: { inObj: selected, fiscal_year: $('#thematic_fiscal_dropdown').val() },
				success: function(resp){
					// // console.log('Map data');
					// // console.log(resp);
					map_chart_data = JSON.parse(resp);
					// drawRegionsMap();
					
					spendAmounts = [];
					map_chart_data.forEach(function(row){
						spendAmounts.push(+row.amount_spend);
					});
					maxValue = Math.max(...spendAmounts);
					minValue = Math.min(...spendAmounts );
					secondMid = (maxValue + minValue) / 2 ;
					firstMid =  (maxValue + secondMid) / 2 ;
					thirdMid =  (secondMid + minValue) / 2 ;
					// // console.log(maxValue +" : "+firstMid +" : "+secondMid +" : "+thirdMid +" : "+minValue);
					ranges = [maxValue, firstMid, secondMid, thirdMid, minValue]	
					showStateDataLayer(map_chart_data, ranges);
				}
			});
	}

	function getPerformanceData(selected){
		$.ajax({ url: '<?php echo site_url("front/ThematicOverview/getPerformanceData"); ?>',
				method: "POST",
				data: { inObj: selected, district: null },
				success: function(performances){
					// // console.log("performances");
					data_per = JSON.parse(performances);
					$('#perform_count').html(data_per.length);
					// // console.log(data_per);
					keys = [];
					for(var k in data_per[0]){
						if(k != 'thematic_area_id' && k != 'param_name' && k != 'id' ){
							keys.push(k);
						}
					}
					// console.log(keys); 
					newDataSet = [];
					$.each(data_per, function (i, item) {
						sub_data_set = [];
						$.each(keys, function (i_sub, sub_item) {
						sub_d = {
							x: i_sub,
							y:+item[sub_item],
							r: (+item[sub_item])%10
							}
							sub_data_set.push(sub_d);
						});
						
						d = {
							label: item.param_name,
							backgroundColor: dynamicColors(),
							data: sub_data_set
						};
						newDataSet.push(d);
					});
					// console.log(newDataSet);
					bubbleChart.data.datasets = newDataSet;
					bubbleChart.update();

				}
			});

	}

	function getCSRExpenditureData(selected){
		$.ajax({ url: '<?php echo site_url("front/ThematicOverview/getCSRExpenditureData"); ?>',
				method: "POST",
				data: { inObj: selected },
				success: function (response) {
					charts_csr_labels = [];
					charts_csr_data = [];
					result = JSON.parse(response);
					// // console.log(result);
					var datas = "thematic_area_spend_" + selected;
					// // console.log("DATAS: " + datas);
					$.each(result, function (i, item) {
						charts_csr_labels.push(item.fy_year);
						charts_csr_data.push(item[datas]);
					});
					// createSpendCharts(charts_csr_labels, charts_csr_data);
					csr_spend_chart.data.datasets[0].data = charts_csr_data;
					csr_spend_chart.data.datasets[0].labels = charts_csr_labels;
					csr_spend_chart.update();
				}

			});
	}

	$('#thematic_areas_drop').on('change', function (event) {
		event.preventDefault();
		removeCompanyMarkers();
		selected = $(this).val();
		if (selected == 'none') {
			location.reload();
			// console.log("RESET DATA");
		} else {
			getTopStatesData(selected);
			getMapData(selected);
			getPerformanceData(selected);
			getCSRExpenditureData(selected);
			getCompanyCount(selected);
			$('#thematic_states_dropdown').prop('disabled', false);
			
		}

	});


// TOTAL CSR EXPENDITURE CHARTS DATA
	var charts_csr_labels = [];
	var charts_csr_data = [];//[0, 0, 265.2, 305.66,346.12, 386.58];
	var csr_chart_dataObj = <?=json_encode($years)?>;
	$.each(csr_chart_dataObj, function (i, item) {
		charts_csr_labels.push(item.fy_year);
	});
	var ctx = document.getElementById("csrspendschart").getContext('2d');
	var csr_spend_chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: charts_csr_labels,
        datasets: [{
            label: 'ddd',
            data: charts_csr_data,
            backgroundColor: [
                'rgba(245, 146, 44)',
                'rgba(245, 146, 44)',
                'rgba(245, 146, 44)',
                'rgba(57, 189, 201)',
                'rgba(57, 189, 201)',
                'rgba(57, 189, 201)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 0
        }]
    },
    options: {
		layout: {
            padding: {
                left: 0,
                right: 10,
                top: 10,
                bottom: 0
            }
        },
		
        scales: {
			xAxes: [{
				barPercentage: 0.4,
				gridLines: {
					display: false ,
					color: "#E1E1E1"
				},
				scaleLabel: {
					display: true,
					labelString: 'Financial Years'
				}
			}],
            yAxes: [{
				gridLines: {
					display: false ,
					color: "transparent"
				},
                ticks: {
                    beginAtZero:true
                }
            }]
        },
		
		legend: {
			display: false
		},
		
		tooltips: {
		  "enabled": false
		},
		
		"hover": {
		  "animationDuration": 0
		},
		
		"animation": {
			"duration": 800,
			"onComplete": function() {
				var chartInstance = this.chart,
				  ctx = chartInstance.ctx;

				ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
				ctx.textAlign = 'center';
				ctx.textBaseline = 'bottom';

				this.data.datasets.forEach(function(dataset, i) {
				  var meta = chartInstance.controller.getDatasetMeta(i);
				  meta.data.forEach(function(bar, index) {
					var data = dataset.data[index];
					ctx.fillText(data, bar._model.x, bar._model.y - 5);
				  });
				});
			}
		}
    }
}); // csr chart ends here

function plotStateShapes(state_selected, latlng, districtsData, range){

	dataStatesLayer.setMap(null);
	if(dataDistrictsLayer !== null && dataDistrictsLayer !== undefined ){
		dataDistrictsLayer.setMap(null);
		dataDistrictsLayer = null;
	}

	dataDistrictsLayer = new google.maps.Data();
	
	dataDistrictsLayer.loadGeoJson(
		"<?php echo base_url();?>assets/front/mapgeojson/"+state_selected+".geojson", 
		{ idPropertyName: 'DISTRICT' }, function (feature)
		{
			feature.forEach(function(item){
				dataDistrictsLayer.getFeatureById(item.getProperty('DISTRICT')).setProperty('amount_spend', 0);
			})
			districtsData.forEach(function(row){
				if(dataDistrictsLayer.getFeatureById(row.DISTRICT) != undefined){
					var numa = +row.AMOUNT;
					dataDistrictsLayer.getFeatureById(row.DISTRICT).setProperty('amount_spend', numa.toFixed(2));
				}
			});
		}
	);

	dataDistrictsLayer.setStyle(function(feature) {
						var colorD = '';
							amount = feature.getProperty('amount_spend');
							if( amount > range[1] ){
								colorD = 'green';
							}else if(amount <= range[1] && amount > range[2]){
								colorD = 'blue';
							}else if(amount <= range[2] && amount > range[3]){
								colorD = 'orange';
							}else if(amount < range[3] ){
								colorD = 'red';
							}
							// var color = state_name == state_selected ? 'red' : 'blue';
							return {
								fillColor: colorD,
								strokeWeight: 1
							};
					});
		

	// map.data.setStyle({visible: true});
	dataDistrictsLayer.addListener('mouseover', function(event) {
		dataDistrictsLayer.revertStyle();
		dataDistrictsLayer.overrideStyle(event.feature, {fillColor: 'yellow' });
		document.getElementById('info-box').textContent = event.feature.getProperty('DISTRICT')+" : "+event.feature.getProperty('amount_spend');
	});

	dataDistrictsLayer.addListener('mouseout', function(event) {
		dataDistrictsLayer.revertStyle();
		document.getElementById('info-box').textContent = 'Move mouse over region';
	});

	dataDistrictsLayer.setMap(map);
	if(latlng != null){
		centeres = { lat: +latlng.lat, lng: +latlng.lng};
		map.setCenter(centeres);
		map.panTo(centeres);
	}
	map.setZoom(6);
}

	$('#thematic_states_dropdown').on('change', function (event) {
		// this is the dropdown for state
		event.preventDefault();
		removeCompanyMarkers();
		selected = $(this).val();
		thematicId = $('#thematic_areas_drop').val();
		state_selected = $('#thematic_states_dropdown option:selected').html();
		// // console.log('State Selected: ' + selected);
		if (selected == "none") {
			option = $('<option />').attr('value', 'none').text('select');
			$('#thematic_district_dropdown').html(option);
			$('#thematic_district_dropdown').prop('disabled', true);
			$('#thematic_fiscal_dropdown').prop('disabled', true);
			$('#thematic_company_dropdown').prop('disabled', true);
			getMapData($('#thematic_areas_drop').val());
		} else {
			getCompanyListData();
			$.ajax({
				url: '<?php echo site_url("front/ThematicOverview/getDistrictList"); ?>',
				method: "POST",
				data: { state: selected, thematic: thematicId, fiscal: $('#thematic_fiscal_dropdown').val() },
				success: function (response) {
					res = JSON.parse(response);
					$('#thematic_district_dropdown').html(res.district_list);

					// console.log(res.overview);
					dataOverview = res.overview;
					
					var spendAmountsD = [];
					dataOverview.forEach(function(row){
						spendAmountsD.push(+row.AMOUNT);
					});
					maxValue = Math.max(...spendAmountsD);
					minValue = Math.min(...spendAmountsD );
					secondMid = (maxValue + minValue) / 2 ;
					firstMid =  (maxValue + secondMid) / 2 ;
					thirdMid =  (secondMid + minValue) / 2 ;
					ranges = [maxValue, firstMid, secondMid, thirdMid, minValue];	

					plotStateShapes(state_selected, res.latlng, dataOverview, ranges);
					
				}
			});
			
			$('#thematic_district_dropdown').prop('disabled', false);
			$('#thematic_fiscal_dropdown').prop('disabled', false);
			$('#thematic_company_dropdown').prop('disabled', false);
		}
	});

var firstTime = 0;

	function highlightDistrict(district){
		firstTime++;
		// console.log("Districts: "+district);
		// dataDistrictsLayer.setMap(null);
		// dataDistrictsLayer = null;
		
		dataDistrictsLayer.revertStyle();
		dataDistrictsLayer.setStyle(function(feature){
			if(feature.getProperty('DISTRICT') == district){
				return {fillColor: 'yellow'};
			}	else{
				dataDistrictsLayer.remove(feature);
			}

		});
		map.setZoom(8);
		if(firstTime != 1){
			$('#thematic_states_dropdown').trigger('change');
			firstTime = 0;
		}
	} 

	$('#thematic_district_dropdown').on('change', function (event) {
		// This is the dropdown for district
		event.preventDefault();
		removeCompanyMarkers();
		district = $('#thematic_district_dropdown option:selected').html();
		selected = $(this).val();
		getCompanyListData();
		if(selected == 'none'){
			$('#thematic_states_dropdown').trigger('change');
		}else{
			highlightDistrict(district);
		}
		
	});

	var dynamicColors = function() {
					return 'rgb('
												+ Math.round(Math.random() *255) + ','
												+ Math.round(Math.random() *255) + ','
												+ Math.round(Math.random() *255) + ')';
         };

</script>
<script type="text/javascript">
		var map = null;
		var map_chart_data = null;
		var markers = [];
		var centeres =   { lat: 21.9937, lng: 78.9629};
		var options = { zoom: 4, disableDefaultUI: true, center: centeres};

function initMap() {
  // The map, centered at india
  map = new google.maps.Map(document.getElementById('map_canvas'), options);

}
var dataStatesLayer;
var dataDistrictsLayer;


function showStateDataLayer(inMapData, range){
	// // console.log(inMapData);
	if(dataDistrictsLayer !== undefined){
		dataDistrictsLayer.setMap(null);
		dataDistrictsLayer = null;
	}
	if(dataStatesLayer !== undefined){
		dataStatesLayer.setMap(null);
		dataStatesLayer = null;
	}
	$("#info-box").show();
	dataStatesLayer = new google.maps.Data();  
	dataStatesLayer.loadGeoJson(
		"<?php echo base_url();?>assets/front/mapgeojson/india_states.geojson", 
		{ idPropertyName: 'NAME_1' }, function (feature)
		{
			inMapData.forEach(function(row){
				// // console.log(row.state_name);
				// // console.log(dataStatesLayer.getFeatureById(row.state_name));
				if(dataStatesLayer.getFeatureById(row.state_name) != undefined){
					var numa = +row.amount_spend;
					dataStatesLayer.getFeatureById(row.state_name).setProperty('amount_spend', numa.toFixed(2));
				}
			});
		});

		dataStatesLayer.setStyle(function(feature) {
						// state_selected = $('#thematic_states_dropdown option:selected').html();
						var color = '';
							amount = feature.getProperty('amount_spend');
							if( amount > range[1] ){
								color = 'green';
							}else if(amount <= range[1] && amount > range[2]){
								color = 'blue';
							}else if(amount <= range[2] && amount > range[3]){
								color = 'orange';
							}else if(amount < range[3] ){
								color = 'red';
							}
							// var color = state_name == state_selected ? 'red' : 'blue';
							return {
								fillColor: color,
								strokeWeight: 1
							};
					});
		
	dataStatesLayer.addListener('mouseover', function(event) {
		dataStatesLayer.revertStyle();
		dataStatesLayer.overrideStyle(event.feature, {fillColor: 'yellow' });
		document.getElementById('info-box').textContent = event.feature.getProperty('NAME_1')+" : "+event.feature.getProperty('amount_spend');
	});

	dataStatesLayer.addListener('mouseout', function(event) {
		dataStatesLayer.revertStyle();
		document.getElementById('info-box').textContent = 'Move mouse over region';
	});
	dataStatesLayer.setMap(map);
	
	centeres =   { lat: 21.9937, lng: 78.9629};
	map.setCenter(centeres);
	map.setZoom(4);
	map.panTo(centeres);

}

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?=$apiKey;?>&callback=initMap" async defer></script>
	
</body>
</html>