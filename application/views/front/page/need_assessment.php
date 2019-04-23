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
							<div class="col-xs-8 text-box">Need<br/>Assessment</div>
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
				<h4 class="subheading">Need Assessment</h4>

					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="row" style="margin-bottom:5px">
								<div class="col-xs-3 col-sm-3 col-md-4">
									<label>Thematic Area</label>
								</div>
								<div class="col-xs-9 col-sm-4 col-md-7">
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
							</div>
							<div class="row" style="margin-bottom:5px">
								<div class="col-xs-3 col-sm-3 col-md-4">
									<label>Sub-Theme</label>
								</div>
								<div class="col-xs-9 col-sm-4 col-md-7">
									<select class="form-control" id="thematic_sub_theme_drop" disabled>
										<option value="none">Select</option>
										<?php foreach($sub_thematic_areas as $theme) { ?>
											<option value="<?php echo $theme['id'];?>" <?php if($theme['id'] == $pdid_data['sub_theme_id']){ echo "selected=selected";}?>><?php echo $theme['name'];?> </option>
										<?php }?>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-3 col-sm-3 col-md-4">
									<label>Micro Theme</label>
								</div>
								<div class="col-xs-9 col-sm-4 col-md-7">
									<select class="form-control" id="thematic_micro_theme_drop" disabled>
										<option value="none">Select</option>
										<?php foreach($micro_thematic_areas as $theme) { ?>
											<option value="<?php echo $theme['id'];?>" <?php if($theme['id'] == $pdid_data['micro_theme_id']){ echo "selected=selected";}?>><?php echo $theme['name'];?> </option>
										<?php }?>
									</select>
								</div>
							</div>
							<br>
							<h4 class="subheading">Key Performance Area</h4>
							<canvas id="keyperformance" width="400" height="230"></canvas>
							<h5 id="chart_name" style="width: 80%;text-align: center;"></h5>
							<br>
							<h4 align="center">% DISTRIBUTION</h4>
							<div class="perdistribution">
								<div class="row">
									<div class="col-xs-6">
										<canvas id="assdistribution" width="340" height="210"></canvas>
									</div>
									<div class="col-xs-6">
										<canvas id="assdistributionsmall" class="tmgn" width="340" height="180"></canvas>
									</div>
								</div>
							</div>
							<ul class="list-common perdistributionlist">
								<input style="background:red;color:white;" id="explainPIE" type="submit" value="Explain"/>
								<!-- <li><span>&nbsp;</span> Government Hospitals</li>
								<li><span>&nbsp;</span> Private Hospitals</li>
								<li><span>&nbsp;</span> Neo-Natal Care</li>
								<li><span>&nbsp;</span> IVF Hospitals</li>
								<li><span>&nbsp;</span> Specialist Pediatric</li>
								<li><span>&nbsp;</span> Unknown</li> -->
							</ul>
							<br>
							<h4 class="subheading">Parameter Performance</h4>
							<p align="right"><small class="color-o"><i>Parameter count : <span id="perform_count"> 0</span></i></small></p>
							<canvas id="parameterperformancechart" width="400" height="280"></canvas>
							<!-- <ul class="list-common pp3col">
								<li><p class="chartsym"><span class="bg-green">&nbsp;</span> Above National Average</p></li>
								<li><p class="chartsym"><span class="bg-orange">&nbsp;</span> Improvement Areas</p></li>
								<li><p class="chartsym"><span class="bg-red">&nbsp;</span> Concern Areas</p></li>
							</ul> -->
						</div>
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-2">
									<label>City</label>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-4">
									<select class="form-control" id="need_citys_dropdown">
									<option value="none">Select</option>
									<?php foreach ($cities as $key => $value) {?>
											<option value="<?php echo $value['market_id'] ?>" ><?php echo $value['title'] ?></option>
											<!-- <option>Tamil Nadu</option> -->
											<!-- <option>UP</option> -->
										<?php }?>
									</select>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-2">
									<label>Level</label>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-4">
									<select class="form-control" id="need_level_dropdown">
									<option value="none">Select</option>
                                    <?php
                                        foreach ($levels as $key => $value) { ?>
                                                <option value="<?php echo $value['id'] ?>" ><?php echo $value['param_name'] ?></option>
									<?php }?>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="sexratio">
										<table>
											<tr>
												<td>
													<table>
														<tr>
															<td style="width:40%" class="bg-red" id="sex_ratio" >Sex Ratio: <?php echo  round($city_meta_data['sexratio'], 2); ?></td>
															<td style="width:60%" class="bg-creamyellow" id="overall_literacy" >Overall Literacy: <?php echo  round($city_meta_data['p_lit_t'], 2); ?></td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td>
													<table>
														<tr>
															<td style="width:60%" class="bg-green" id="male_literacy" >Male Literacy: <?php echo  round($city_meta_data['p_lit_m'],2); ?></td>
															<td style="width:40%" class="bg-creamyellow" id="female_literacy" >Female Literacy: <?php echo  round($city_meta_data['p_lit_f'],2); ?></td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</div>
								</div> <!-- col-sm-7 end -->
							</div>
							<br>
							<div class="form-group markets">
								<ul class="list-common pp3col">
									<li><p class="chartsym"><span class="bg-green">&nbsp;</span> Above National Average</p></li>
									<li><p class="chartsym"><span class="bg-orange">&nbsp;</span> Improvement Areas</p></li>
									<li><p class="chartsym"><span class="bg-red">&nbsp;</span> Concern Areas</p></li>
								</ul>
								<div class="row">
									<div class="col-sm-12">
                                        <div id="map_canvas" ></div>
                                        <br />
                                        <a href="<?php echo base_url();?>project-development/<?php echo $brief_id;?>" class="btn btn-warning btn-sm pull-right" style="margin-left: 10px; border-radius: 0px">Back</a>
                                        
										<!-- <img src="<?php /* echo base_url(); */?>assets/loc/img/mapass.jpg" class="img-responsive"> -->
									</div>
								</div>
							</div>
						</div> <!-- col-sm-12 col-md-7 end -->
					</div> <!-- row end -->
				</div>
			</div>
		</div>
	</div>

	<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="reservation_detail_model" class="modal fade" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- <button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button> -->
                            <h4 class="modal-title"><center>% DISTRIBUTION</center></h4>
                        </div>
                        <div class="modal-body" id="reservation_detail_model_body">
                            <!--reservation_list_view goes here-->
														<div class="perdistribution">
															<div class="row">
																<div class="col-xs-6">
																	<canvas id="assdistribution_popup" width="340" height="210"></canvas>
																</div>
																<div class="col-xs-6">
																	<canvas id="assdistributionsmall_popup" class="tmgn" width="340" height="180"></canvas>
																</div>
															</div>
														</div>

                        </div>
                        <!-- <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-info" type="button">Close</button>
                        </div> -->
                    </div>
                </div>
            </div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/loc/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
	<!--<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.5.0/dist/chartjs-plugin-datalabels.min.js"></script>	-->
	<script>
        // Global Options CHARTS:
        Chart.defaults.global.defaultFontColor = 'black';
        Chart.defaults.global.defaultFontSize = 12;
				var pie_colorL = [];
				var pie_colorR = [];
				var pie_Labels_left = ["Government Hospitals", "Private Hospitals", "Neo-Natal Care", "Unknown"];
				var pie_Data_left = [];
				var rightData = 0.0;
				var pie_Labels_right = ["IVF Hospitals", "Specialist Pediatric"];
				var pie_Data_right = [];

				var dynamicColors = function() {
					return 'rgb('
												+ Math.round(Math.random() *255) + ','
												+ Math.round(Math.random() *255) + ','
												+ Math.round(Math.random() *255) + ')';
         };
				 
        // Percent Distribution charts
			var options = {
			title: {
					  display: false,
					  text: '% Distribution',
					  position: 'top'
				  },
			rotation: 25/180 * Math.PI, 		// Notice the rotation from the documentation.
			legend: {
				display: false
			},
		};
		var options_popup = {
			title: {
					  display: false,
					  text: '% Distribution',
					  position: 'top'
				  },
			rotation: 25/180 * Math.PI, 		// Notice the rotation from the documentation.
			legend: {
				display: true,
				position:'bottom'
			},
		};

        // LEFT
		var canvas_left_percent = document.getElementById("assdistribution").getContext('2d');
		var canvas_left_percent_popup = document.getElementById("assdistribution_popup").getContext('2d');
		var data_left = {
				labels: ["Government Hospitals", "Private Hospitals", "Neo-Natal Care", "Unknown"],
			  datasets: [
				{
					fill: false,
					backgroundColor: ['#4472C4','#ED7D31','#A5A5A5','#9DC3E6'],
					data: [40, 20, 20, 20 ],
					borderColor:	['#fff', '#fff', '#fff', '#fff'],
					borderWidth: [2,2,2,2]
				}
			]
		};

		// Chart declaration:
		var percent_distribution_left_PIE_chart = new Chart(canvas_left_percent, {
			type: 'pie',
			data: data_left,
			options: options
		});

        // RIGHT CHART
		var canvas_right_percent = document.getElementById("assdistributionsmall").getContext('2d');
		var canvas_right_percent_popup = document.getElementById("assdistributionsmall_popup").getContext('2d');
		var data_right = {
			labels: ["IVF Hospitals", "Specialist Pediatric"],
			  datasets: [
				{
					fill: true,
					backgroundColor: ['#FCBE00','#8497B0'],
					data: [65, 35],
					borderColor: ['#fff', '#fff'],
					borderWidth: [2,2]
				}
			]
		};

		// Chart declaration:
		var percent_distribution_right_PIE_chart = new Chart(canvas_right_percent, {
			type: 'pie',
			data: data_right,
			options: options
        });
        // RIGHT SECTION FOR PIE CHART ENDS HERE

var ctx = document.getElementById("keyperformance").getContext('2d');
var key_performance_area_pie_chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["FY 2015-16", "FY 2016-17","FY 2017-18(P)","FY 2018-19(P)" ],
        datasets: [{
            label: 'Total Hospitals',
            data: [3125, 4204, 5656, 1021],
            backgroundColor: [
                'rgba(82, 82, 82)',
                'rgba(82, 82, 82)',
                'rgba(57, 189, 201)'
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
				ticks: {
					fontSize: 8
				}
				// ,				scaleLabel: {
				// 	display: true,
				// 	fontSize: 14,
				// 	labelString: 'Total Hospitals'
				// }
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
});
</script>
<script type="text/javascript">
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
			display: false
		},
		title: {
			display: false,
			text: ''
		},
		scales: {
			yAxes: [{
			  scaleLabel: {
				display: false,
				labelString: ""
			  },
			  gridLines: {
					display: true ,
					color: "#fff"
				}
			}],
			xAxes: [{
			  scaleLabel: {
				display: false,
				labelString: ""
			  },
			  gridLines: {
					display: true ,
					color: "#fff"
				}
			}]
		}
    }
});




	$('#thematic_area_drop').on('change', function(event){
		// this is the dropdown change for thematic area
		event.preventDefault();
		selected = $(this).val();
		if(selected == "none"){
			// option = $('<option />').attr('value', 'none').text('Select');
			// $('#thematic_sub_theme_drop').html(option);
		}else{
			$.ajax({
			url: '<?php echo site_url("front/NeedAssessment/getSubDataList"); ?>',
			method: "POST",
			data: {inObj: selected},
			success: function(response){
					result = JSON.parse(response);
					keyareas = JSON.parse(result.key_areas)[0];
					distribution = JSON.parse(result.distribution);
					console.log(distribution);
					// $('#thematic_sub_theme_drop').html(result.sub_theme);
					// $('#thematic_sub_theme_drop').trigger('change');
					// KEY AREA PERFORMANCE
					key_performance_area_pie_chart.data.datasets[0].data = [keyareas['fy_2015-16'], keyareas['fy_2016-17'],keyareas['fy_2017-18'],keyareas['fy_2018-19']];
					$('#chart_name').text(keyareas['parameters']);
					key_performance_area_pie_chart.update();
					
					// PERCENTAGE DISTRIBUTION
					pie_Labels_left = [];
					pie_Labels_right = [];
					pie_colorR = [];
					pie_colorL = [];
					pie_Data_right = [];
					pie_Data_left = [];
					rightData = 0.0;
					var midSize = parseInt(distribution.length/2);
					$.each(distribution, function (i, item) {
						if(i<midSize){
							pie_Labels_right.push(item.data_key);
							pie_Data_right.push(item.data_value);
							rightData = new Number(rightData) + new Number(item.data_value);
							pie_colorR.push(dynamicColors());
						}else{
							pie_Labels_left.push(item.data_key);
							pie_Data_left.push(item.data_value);
							pie_colorL.push(dynamicColors());
						}
					});
					console.log("Right Section: "+pie_colorR);

					pie_Labels_left.push("Right Section");
					pie_Data_left.push(rightData);
					plotBubbleChart();
					reloadPieCharts(percent_distribution_left_PIE_chart, percent_distribution_right_PIE_chart);
				}
			});
		}
	});

	function plotBubbleChart(){
		$.ajax({
				url: '<?php echo site_url("front/NeedAssessment/getPerformanceData"); ?>',
				method: "POST",
				data: { inObj: $('#thematic_area_drop').val(), district: null },
				success: function(performances){
					console.log("performances");
					data_per = JSON.parse(performances);
					$('#perform_count').html(data_per.length);
					console.log(data_per);
					keys = [];
					for(var k in data_per[0]){
						if(k != 'thematic_area_id' && k != 'param_name' && k != 'id' ){
							keys.push(k);
						}
					}
					console.log(keys); 
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
					console.log(newDataSet);
					bubbleChart.data.datasets = newDataSet;
					bubbleChart.update();

				}
			});

	}

	$('#thematic_area_drop').trigger('change');

	// $('#thematic_sub_theme_drop').on('change', function(event){

	// 	// this is the dropdown change for sub theme thematic area
	// 	event.preventDefault();
	// 	selected = $(this).val();
	// 	if(selected == "none"){
	// 		option = $('<option />').attr('value', 'none').text('Select');
	// 		$('#thematic_micro_theme_drop').html(option);
	// 	}else{
	// 		console.log(selected);
	// 		$.ajax({
	// 		url: '<?php echo site_url("front/NeedAssessment/getMicroDataList"); ?>',
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

// 	key_performance_area_pie_chart.data.datasets[0].data = [1235, 2456, 4545];
// 	key_performance_area_pie_chart.data.datasets[0].labels = 'Total';


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

$('#need_citys_dropdown').on('change', function(event){
	// this is the dropdown for state
	event.preventDefault();
	selected = $(this).val();
	if(selected == 'none'){
		location.reload();
	}
	selectedCity = $('#need_citys_dropdown option:selected').html();
	// console.log('City Selected: '+selected);
	$.ajax({
	url: '<?php echo site_url("front/NeedAssessment/getCityMetaData"); ?>',
	method: "POST",
	data: {inObj: selected},
	success: function(response){
		result = JSON.parse(response);
		$('#sex_ratio').text('Sex Ratio: '+parseFloat(result.sexratio).toFixed(2));
		$('#overall_literacy').text('Overall Literacy: '+parseFloat(result.p_lit_t).toFixed(2));
		$('#male_literacy').text('Male Literacy: '+parseFloat(result.p_lit_m).toFixed(2));
		$('#female_literacy').text('Female Literacy: '+parseFloat(result.p_lit_f).toFixed(2));
	}
	});


	$.ajax({
	url: '<?php echo site_url("front/NeedAssessment/getCityData"); ?>',
	method: "POST",
	data: {inObj: selected},
	success: function(response){
			removeCompanyMarkers();
			$('#need_level_dropdown').val("none");
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

$('#need_level_dropdown').on('change', function(event){
	// This is the dropdown for district
	event.preventDefault();
	selected_level = $(this).val();
	level_name = $('#need_level_dropdown option:selected').html();
	selected_city = $('#need_citys_dropdown').val();
	if(selected_city == "none"){
		alert("Please select city first");
		$("#need_level_dropdown").val("none");
	}else{
		if(selected_level == "none"){
			removeCompanyMarkers();
		}else{
			city_name = $('#need_citys_dropdown option:selected').html();
			console.log("Get level :"+selected_level+" for city: "+city_name)
			$.ajax({
				url: '<?php echo site_url("front/NeedAssessment/getLevelMapData"); ?>',
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

/// TODO:::
    // $('#sex_ratio').text('Sex Ratio: 923');
    // $('#overall_literacy').text('Overall Literacy: 94.68');
    // $('#male_literacy').text('Male Literacy: 96.05');
    // $('#female_literacy').text('Female Literacy: 93.20');

var percent_distribution_left_PIE_chart_popup = new Chart(canvas_left_percent_popup, {
			type: 'pie',
			data: data_left,
			options: options_popup
	});
	var percent_distribution_right_PIE_chart_popup = new Chart(canvas_right_percent_popup, {
			type: 'pie',
			data: data_right,
			options: options_popup
  });

$('#explainPIE').on('click', function(event){
	reloadPieCharts(percent_distribution_left_PIE_chart_popup, percent_distribution_right_PIE_chart_popup);

	$('#reservation_detail_model').modal('show');
});
//
function reloadPieCharts(leftPie, rightPie){
	leftPie.data.labels = pie_Labels_left;
	leftPie.data.datasets[0].data = pie_Data_left;
	leftPie.data.datasets[0].backgroundColor = pie_colorL;
	leftPie.update();

	rightPie.data.labels = pie_Labels_right;
	rightPie.data.datasets[0].data = pie_Data_right;
	rightPie.data.datasets[0].backgroundColor = pie_colorR;
	rightPie.update();
} // this load pie charts with latest data

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
	//   centerMarker = new google.maps.Marker({
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
		// 	url: '<?php echo site_url("front/NeedAssessment/getShapesFromDB"); ?>',
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