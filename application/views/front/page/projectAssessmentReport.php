<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<?php
$baseline_study1 =  $this->Front_model->projectAssessmentComplitionData('brief_baseline_study',$brief_id,'Pending');
$baseline_study2 =  $this->Front_model->projectAssessmentComplitionData('brief_baseline_study',$brief_id,'WIP');
$baseline_study3 =  $this->Front_model->projectAssessmentComplitionData('brief_baseline_study',$brief_id,'Completed');

$need_assessment1 =  $this->Front_model->projectAssessmentComplitionData('brief_need_assessment',$brief_id,'Pending');
$need_assessment2 =  $this->Front_model->projectAssessmentComplitionData('brief_need_assessment',$brief_id,'WIP');
$need_assessment3 =  $this->Front_model->projectAssessmentComplitionData('brief_need_assessment',$brief_id,'Completed');

$brief_monitoring1 =  $this->Front_model->projectAssessmentPreparationData('brief_monitoring',$brief_id,'Pending');
$brief_monitoring2 =  $this->Front_model->projectAssessmentPreparationData('brief_monitoring',$brief_id,'WIP');
$brief_monitoring3 =  $this->Front_model->projectAssessmentPreparationData('brief_monitoring',$brief_id,'Completed');

$brief_monitoring11 =  $this->Front_model->projectAssessmentInterimData('brief_monitoring',$brief_id,'Pending');
$brief_monitoring22 =  $this->Front_model->projectAssessmentInterimData('brief_monitoring',$brief_id,'WIP');
$brief_monitoring33 =  $this->Front_model->projectAssessmentInterimData('brief_monitoring',$brief_id,'Completed');

$brief_monitoring13 =  $this->Front_model->projectAssessmentFinalData('brief_monitoring',$brief_id,'Pending');
$brief_monitoring23 =  $this->Front_model->projectAssessmentFinalData('brief_monitoring',$brief_id,'WIP');
$brief_monitoring34 =  $this->Front_model->projectAssessmentFinalData('brief_monitoring',$brief_id,'Completed');

$brief_reportingTotal =  $this->Front_model->getDataC('brief_reporting','brief_module_id',$brief_id);
$brief_reporting1 =  $this->Front_model->projectAssessmentPreparationData('brief_reporting',$brief_id,'Pending');
$brief_reporting2 =  $this->Front_model->projectAssessmentPreparationData('brief_reporting',$brief_id,'WIP');
$brief_reporting3 =  $this->Front_model->projectAssessmentPreparationData('brief_reporting',$brief_id,'Completed');

$brief_reporting11 =  $this->Front_model->projectAssessmentInterimData('brief_reporting',$brief_id,'Pending');
$brief_reporting22 =  $this->Front_model->projectAssessmentInterimData('brief_reporting',$brief_id,'WIP');
$brief_reporting33 =  $this->Front_model->projectAssessmentInterimData('brief_reporting',$brief_id,'Completed');

$brief_reporting13 =  $this->Front_model->projectAssessmentFinalData('brief_reporting',$brief_id,'Pending');
$brief_reporting23 =  $this->Front_model->projectAssessmentFinalData('brief_reporting',$brief_id,'WIP');
$brief_reporting34 =  $this->Front_model->projectAssessmentFinalData('brief_reporting',$brief_id,'Completed');

$totalPending = count($baseline_study1)+count($need_assessment1)+count($brief_monitoring1)+
    count($brief_monitoring11)+count($brief_monitoring13)+count($brief_reporting1)+count($brief_reporting11)+count($brief_reporting13);
$totalWIP = count($baseline_study2)+count($need_assessment2)+count($brief_monitoring2)+
    count($brief_monitoring22)+count($brief_monitoring23)+count($brief_reporting2)+count($brief_reporting22)+count($brief_reporting23);
$totalCompleted = count($baseline_study3)+count($need_assessment3)+count($brief_monitoring3)+count($brief_monitoring33)+count($brief_monitoring34)
    +count($brief_reporting3)+count($brief_reporting33)+count($brief_reporting34);
$total = $totalPending+$totalWIP+$totalCompleted;
if($total){
    $pendingPerstage = ($totalPending/$total)*100;
    $WipPerstage = ($totalWIP/$total)*100;
    $CompletedPerstage = ($totalCompleted/$total)*100;
}else{
    $pendingPerstage = 0;
    $WipPerstage = 0;
    $CompletedPerstage = 0;
}

?>
<div class="col-md-9 col-sm-6 col-xs-12">
    <div class="form-section ">
        <div class="row">
            <div class="col-sm-12">
                <?php echo $this->session->flashdata('msg');?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h5 class="inner-page-title" style="color: #fd9325;">PDID: <?php echo $brief_id; ?><br/>
                    <small>Initiated Date: <?php echo date('d-m-Y',strtotime($briefs[0]['created_at']))?></small></h5>
            </div>
        </div>
        <div class="row custom-table">
            <div class="col-sm-12">
                <div class="scroll-table">
                    <table class="table table-responsive table-bordered text-center assessment-table">
                        <tr>
                            <td rowspan="2">Programs</td>
                            <td rowspan="2">Activity</td>
                            <?php
                             echo' <td colspan="12" class="text-center custom-year">'. date('Y').'</td>';
                               ?>
                        </tr>
                        <tr>
                            <td>Jan</td>
                            <td>Feb</td>
                            <td>Mar</td>
                            <td>Apr</td>
                            <td>May</td>
                            <td>Jun</td>
                            <td>Jul</td>
                            <td>Aug</td>
                            <td>Sep</td>
                            <td>Oct</td>
                            <td>Nov</td>
                            <td>Dec</td>

                        </tr>
                      <?php
                      if(count($project_assessment)>0){
                      foreach($project_assessment as $assessment) {?>
                        <tr>
                            <td><?php echo $assessment['programs'];?></td>
                            <td><?php echo $assessment['activity'];?></td>
                            <td><?php echo $assessment['jan'];?></td>
                            <td><?php echo $assessment['feb'];?></td>
                            <td><?php echo $assessment['mar'];?></td>
                            <td><?php echo $assessment['apr'];?></td>
                            <td><?php echo $assessment['may'];?></td>
                            <td><?php echo $assessment['jun'];?></td>
                            <td><?php echo $assessment['jul'];?></td>
                            <td><?php echo $assessment['aug'];?></td>
                            <td><?php echo $assessment['sep'];?></td>
                            <td><?php echo $assessment['oct'];?></td>
                            <td><?php echo $assessment['nov'];?></td>
                            <td><?php echo $assessment['decem'];?></td>

                        </tr>
                        <?php } }else{
                          echo'<td colspan="14">No record found</td>';
                      }?>

                    </table>
                </div>
            </div>
        </div>
        <div class="row mt-20 chartbar">
            <div class="col-sm-5">
                <div class="row">
                    <div class="col-sm-6">
                        <canvas id="canvas" height="180" width="180"></canvas>
                        <div class="circle-content">
                            <span class="title">Total Project<br/> Completion</span>
                            <ul>
                                <li>
                                    <div class="circle-orange"></div><span> Completed</span>
                                </li>
                                <li>
                                    <div class="circle-green"></div><span> Pending</span>
                                </li>
                                <li>
                                    <div class="circle-yellow"></div><span> WIP</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <canvas id="canvas1" height="180" width="180"></canvas>
                        <div class="circle-content">
                            <span class="title">Funds<br/> Utilization</span>
                            <ul>
                                <li>
                                    <div class="circle-orange"></div><span> Funds Utilized</span>
                                </li>
                                <li>
                                    <div class="circle-green"></div><span> Funds Pending</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-5">
                <div id="chartContainer" style="height: 370px;margin: 0px auto;"></div>
                <script>
                    window.onload = function () {
                        var options = {
                            width:340,
                            animationEnabled: true,
                            theme: "light2",
                            legend: {
                                cursor: "pointer",
                                itemclick: toogleDataSeries
                            },
                            axisX:{
                                interval: 1,
                                intervalType: "month",
                            },
                            axisY:{
                                tickLength: 1,
                                tickColor: "white" ,
                                tickThickness: 0,
                                gridThickness: 0,
                                gridColor: "white"
                            },
                            toolTip: {
                                shared: true
                            },
                            data: [{
                                type: "line",
                                color: "#f5922b",
                                name: "Actual Impact",
                                dataPoints: [
                                    <?php foreach($benificary_impact as $key => $item){?>
                                    { x: <?php echo $key;?>, y: <?php echo $item['actual_impact'];?> },
                                    <?php }?>
                                ]
                            }, {
                                type: "line",
                                color: "#1fa1ae",
                                name: "Projected Impact",
                                dataPoints: [
                                    <?php foreach($benificary_impact as $key => $item){?>
                                    { x: <?php echo $key;?>, y: <?php echo $item['projected_impact'];?> },
                                    <?php }?>
                                ]
                            }]
                        };
                        $("#chartContainer").CanvasJSChart(options);
                        function toogleDataSeries(e) {
                            if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                                e.dataSeries.visible = false;
                            } else {
                                e.dataSeries.visible = true;
                            }
                            e.chart.render();
                        }

                    }
                </script>

            </div>
            <div class="col-sm-2 circle-box center-block text-center">
                <label>Time-line<br/>Adherence</label>
                <ul>
                    <li>

                        <div class="green-circle"><?php echo round($CompletedPerstage);?>%</div>
                        <small>Completed</small>
                    </li>
                    <li>
                        <div class="yallow-circle"><?php echo round($WipPerstage);?>%</div>
                        <small>Remaining</small>
                    </li>
                    <li>
                        <div class="red-circle"><?php echo round($pendingPerstage);?>%</div>
                        <small>Overdue</small>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <a href="<?php echo base_url();?>beneficiary/<?php echo $brief_id;?>" class="btn btn-warning btn-sm" style="margin-left: 10px; border-radius: 0px">Beneficiary Module</a>
            <a href="<?php echo base_url();?>monitoring/<?php echo $brief_id;?>" class="btn btn-warning btn-sm" style="margin-left: 10px; border-radius: 0px">Monitoring Module</a>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.1.3/circle-progress.min.js"></script>
<script>
    $(document).ready(function () {
        var pieData = [

            {
                value: <?php echo round($CompletedPerstage);?>,
                color:"#f5922b"
            },
            {
                value: <?php echo round($pendingPerstage);?>,
                color:"#1fa1ae"
            },
            {
                value : <?php echo round($WipPerstage);?>,
                color :"#fef200"

            }
        ];
        var myPie = new Chart(document.getElementById("canvas").getContext("2d")).Doughnut(pieData,{percentageInnerCutout : 80});

        var pieData = [
            {
                value: 10,
                color:"#f5922b"
            },
            {
                value : 100-35,
                color : "#84d4da"
            }
        ];
        var myPie = new Chart(document.getElementById("canvas1").getContext("2d")).Doughnut(pieData,{percentageInnerCutout : 80});
    });
</script>
<script src="<?php echo base_url();?>assets/front/js/chart.js"></script>

<script>
    var progressBarOptions = {
        startAngle: -1.55,
        size: 150,
        value: <?php echo round($CompletedPerstage);?>,
        fill: {
            color: "#f5922b"
        }
    };
    var progressBarOptions2 = {
        startAngle: -5.55,
        size: 330,
        value: <?php echo round($pendingPerstage);?>,
        fill: {
            color: "#fef200"
        }
    };
    var progressBarOptions3 = {
        startAngle: -1.55,
        size: 150,
        value: <?php echo round($WipPerstage);?>,
        fill: {
            color: "#1fa1ae"
        }
    };

    $(".circle-bar")
        .circleProgress(progressBarOptions,progressBarOptions2,progressBarOptions3)
        .on("circle-animation-progress", function(event, progress, stepValue) {
            $(this)
                .find("strong")
                .text(String(stepValue.toFixed(2)).substr(1));
        });

    $("#circle-b").circleProgress({
        value: 0.59,
        fill: {
            color: "#f5922b"
        }
    });
</script>