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
							<div class="col-xs-8 text-box">CSR<br/>Overview</div>
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
				<h4 class="subheading">CSR Overview</h4>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-4">
							<ul class="csroverview list-common">
								<li>
									<div class="dashboardbox bg-seablue">
										<div class="dashboardboxinner">
											<h5>States/UT Covered</h5>
											<h3><?=$states?></h3>
										</div>
									</div>
								</li>
								<li>
									<div class="dashboardbox bg-orange">
										<div class="dashboardboxinner">
											<h5>Total CSR Projects</h5>
											<h3><?=$projects?></h3>
										</div>
									</div>
								</li>
								<li>
									<div class="dashboardbox bg-seablue">
										<div class="dashboardboxinner">
											<h5>Total Companies</h5>
											<h3><?=$companies?></h3>
										</div>
									</div>
								</li>
								<li>
									<div class="dashboardbox bg-orange">
										<div class="dashboardboxinner">
											<h5>CSR Expenditure</h5>
											<h3 id="csrExpense"><?=$expanse?></h3>
										</div>
									</div>
								</li>
							</ul>
							<br>
							<h4 class="subheading" align="center">Total CSR Expenditure</h4>
							<ul class="list-common chartsymwrap">
								<li><p class="chartsym"><span class="bg-orange">&nbsp;</span> Actual</p></li>
								<li><p class="chartsym"><span class="bg-seablue">&nbsp;</span> Forecasted</p></li>
							</ul>

							<canvas id="myChart" width="400" height="400"></canvas>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-8">
							<div class="form-group markets">
								<div class="row">
									<div class="col-xs-2 col-sm-2 col-md-1">
										<label>Year</label>
									</div>
									<div class="col-xs-3 col-sm-3 col-md-3">
										<select class="form-control" id="yearly_drop">
										<?php
foreach ($years as $key => $value) {?>
											<option value="<?php echo $value['fy_year'] ?>" >FY <?php echo $value['fy_year'] ?></option>
										<?php }?>
										</select>
									</div>
								</div>
							</div>
							<div class="treewrap">
								<div class="innercirclewrap">
									 <div class="iconsandleaf" id="tech_incu">
										<img src="<?php echo base_url(); ?>assets/loc/img/csr-overview/phone.png">
										<p class="csrcomp">10%</p>
										<p class="csrexp">1 CR</p>
									</div>

									<div class="iconsandleaf" id="arm_war">
										<img src="<?php echo base_url(); ?>assets/loc/img/csr-overview/dustbin.png">
										<p class="csrcomp">10%</p>
										<p class="csrexp">2 CR</p>
									</div>

									<div class="iconsandleaf" id="spo_rur">
										<img src="<?php echo base_url(); ?>assets/loc/img/csr-overview/football.png">
										<p class="csrcomp">10%</p>
										<p class="csrexp">3 CR</p>
									</div>

									<div class="iconsandleaf" id="wom_emp">
										<img src="<?php echo base_url(); ?>assets/loc/img/csr-overview/hand.png">
										<p class="csrcomp">10%</p>
										<p class="csrexp">4 CR</p>
									</div>

									<div class="iconsandleaf" id="rur_dev">
										<img src="<?php echo base_url(); ?>assets/loc/img/csr-overview/tree.png">
										<p class="csrcomp">10%</p>
										<p class="csrexp">5 CR</p>
									</div>

									<div class="iconsandleaf" id="urb_slu">
										<img src="<?php echo base_url(); ?>assets/loc/img/csr-overview/girl.png">
										<p class="csrcomp">10%</p>
										<p class="csrexp">6 CR</p>
									</div>

									<div class="iconsandleaf" id="pmr_fun" >
										<img src="<?php echo base_url(); ?>assets/loc/img/csr-overview/tie.png">
										<p class="csrcomp">10%</p>
										<p class="csrexp">7 CR</p>
									</div>

									<div class="iconsandleaf" id="oth_ers">
										<img src="<?php echo base_url(); ?>assets/loc/img/csr-overview/laptop.png">
										<p class="csrcomp">10%</p>
										<p class="csrexp">8 CR</p>
									</div>

									<div class="iconsandleaf" id="nat_her">
										<img src="<?php echo base_url(); ?>assets/loc/img/csr-overview/bridge.png">
										<p class="csrcomp">10%</p>
										<p class="csrexp">9 CR</p>
									</div>

									<div class="iconsandleaf" id="pov_all">
										<img src="<?php echo base_url(); ?>assets/loc/img/csr-overview/firstaidbox.png">
										<p class="csrcomp">10%</p>
										<p class="csrexp">10 CR</p>
									</div>

									<div class="iconsandleaf" id="edu_ski">
										<img src="<?php echo base_url(); ?>assets/loc/img/csr-overview/cap.png">
										<p class="csrcomp">10%</p>
										<p class="csrexp">11 CR</p>
									</div>

									<div class="iconsandleaf" id="env_sus">
										<img src="<?php echo base_url(); ?>assets/loc/img/csr-overview/bulb.png">
										<p class="csrcomp">10%</p>
										<p class="csrexp">12 CR</p>
									</div>

								</div> <!-- innercirclewrap end -->

								<div class="outercirclewrap">

								</div> <!-- outercirclewrap -->

								<div class="treehand">
									<img src="<?php echo base_url(); ?>assets/loc/img/csr-overview/handlarge.png" alt="hand">
								</div>
							</div> <!-- treewrap end -->
							<ul class="list-common handinfo" align="center">
								<li><p class="chartsym"><span class="bg-orange">&nbsp;</span> CSR Expenditure</p> &nbsp; &nbsp; <p class="chartsym"><span class="bg-seablue">&nbsp;</span> % Composition</p></li>
							</ul>
						</div> <!-- col-sm-12 col-md-7 end -->
						<a href="<?php echo base_url();?>dashboard" class="btn btn-warning btn-sm pull-right" style="margin-left: 10px; border-radius: 0px">Back</a>

					</div> <!-- row end -->
				</div>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/loc/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
	<script type="text/javascript">

	// TOTAL CSR EXPENDITURE CHARTS DATA
 	var charts_csr_labels = [];
    var charts_csr_data = [];
	var csr_chart_dataObj = <?=json_encode($csr_chart_data)?>;
	$.each(csr_chart_dataObj,function(i,item) {
		charts_csr_labels.push(item.fy_year);
		charts_csr_data.push(item.total_spend);
	});


var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
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
		}
    }
});

$('#yearly_drop').on('change', function(event){
	event.preventDefault();
	selected = $(this).val();
	// console.log("Year: "+selected);
	$.ajax({
			url: '<?php echo site_url("front/CsrOverview/getThematicSpendData"); ?>',
			method: "POST",
			data: {inObj: selected},
			success: function(response){
				result = JSON.parse(response);
				// console.log(result);
				idss = ['edu_ski', 'pov_all', 'rur_dev', 'env_sus', 'nat_her', 'wom_emp', 'pmr_fun', 'arm_war', 'tech_incu', 'urb_slu', 'oth_ers', 'spo_rur'];
				$.each(idss,function(i,item) {
					// console.log(i +" : "+item);
					$('#'+item+' p.csrcomp').html(result['thematic_area_percent_'+(i+1)]+"%");
					$('#'+item+' p.csrexp').html(result['thematic_area_spend_'+(i+1)]+"CR");
				});

			}

		});
		$.ajax({
			url: '<?php echo site_url("front/CsrOverview/getCSRExdenditureByFiscalYear"); ?>',
			method: "POST",
			data: {inObj: selected},
			success: function(response){
				result = JSON.parse(response);
				$('#csrExpense').html(result);
			}

		});
});
$('#yearly_drop').trigger('change');

</script>
</body>
</html>