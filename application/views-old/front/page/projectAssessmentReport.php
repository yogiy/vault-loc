<?php
$baseline_studyTotal =  $this->Front_model->getDataC('brief_baseline_study','brief_module_id',$brief_id);
$baseline_study1 =  $this->Front_model->projectAssessmentComplitionData('brief_baseline_study',$brief_id,'Pending');
$baseline_study2 =  $this->Front_model->projectAssessmentComplitionData('brief_baseline_study',$brief_id,'WIP');
$baseline_study3 =  $this->Front_model->projectAssessmentComplitionData('brief_baseline_study',$brief_id,'Completed');

$need_assessmentTotal =  $this->Front_model->getDataC('brief_need_assessment','brief_module_id',$brief_id);
$need_assessment1 =  $this->Front_model->projectAssessmentComplitionData('brief_need_assessment',$brief_id,'Pending');
$need_assessment2 =  $this->Front_model->projectAssessmentComplitionData('brief_need_assessment',$brief_id,'WIP');
$need_assessment3 =  $this->Front_model->projectAssessmentComplitionData('brief_need_assessment',$brief_id,'Completed');

$brief_monitoringTotal =  $this->Front_model->getDataC('brief_monitoring','brief_module_id',$brief_id);
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

$totalRecords = count($baseline_studyTotal)+count($need_assessmentTotal)+count($brief_monitoringTotal)+count($brief_reportingTotal);

$totalPending = count($baseline_study1)+count($need_assessment1)+count($brief_monitoring1)+count($brief_monitoring11)+count($brief_monitoring13)+count($brief_reporting1)+count($brief_reporting11)+count($brief_reporting13);
$totalWIP = count($baseline_study2)+count($need_assessment2)+count($brief_monitoring2)+count($brief_monitoring22)+count($brief_monitoring23)+count($brief_reporting2)+count($brief_reporting22)+count($brief_reporting23);
$totalCompleted = count($baseline_study3)+count($need_assessment3)+count($brief_monitoring3)+count($brief_monitoring33)+count($brief_monitoring34)+count($brief_reporting3)+count($brief_reporting33)+count($brief_reporting34);

$total = $totalPending+$totalWIP+$totalCompleted;

$pendingPerstage = ($totalPending/$total)*100;
$WipPerstage = ($totalWIP/$total)*100;
$CompletedPerstage = ($totalCompleted/$total)*100;

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
                            $x=0;
                            for ($i = date('Y',strtotime($briefs[0]['project_duration_from'])); $i <= date('Y',strtotime($briefs[0]['project_duration_to'])); $i++){
                                echo' <td colspan="12" class="text-center custom-year">'. date('Y', strtotime($briefs[0]['project_duration_from'].'+'.$x.' years')).'</td>';
                                ++$x;
                            }
                            ?>
                        </tr>
                        <tr>
                            <?php
                            for ($i = date('Y',strtotime($briefs[0]['project_duration_from'])); $i <= date('Y',strtotime($briefs[0]['project_duration_to'])); $i++){
                                for ($k = 1; $k <= 12; $k++)
                                {
                                    $year =date('Y');
                                    $month_name = date('M', mktime(0, 0, 0, $k, 1, $year));
                                    $month_no =array($k=>$month_name);
                                    echo '<td>'.$month_name.'</td>';
                                }
                            }
                            ?>

                        </tr>
                        <tr>
                            <td>New Assessment<br/>and program Design</td>
                            <td width="180">Data Collection, Analysis and<br/>designing need<br/>based interventions</td>
                            <?php
                            for ($i = date('Y',strtotime($briefs[0]['project_duration_from'])); $i <= date('Y',strtotime($briefs[0]['project_duration_to'])); $i++){
                                for ($k = 1; $k <= 12; $k++) {
                                    $year =date('Y');
                                    $month_name = date('M', mktime(0, 0, 0, $k, 1, $year));
                                    $month_no = date('m', mktime(0, 0, 0, $k, 1, $year));
                                    $daterange = $i.'-'.$month_no;


                                    $baseline =  $this->Front_model->projectAssessmentData('brief_baseline_study',$brief_id, $daterange);
                                    if(count($baseline) >0){
                                        if(!empty($baseline[0]['baseline_study']))
                                            echo '<td><a href="'.base_url().'uploads/briefBaselineStudy/'.$baseline[0]['baseline_study'].'" download>Download</a></td>';
                                        else
                                            echo '<td>No File uploaded</td>';

                                    }
                                     else
                                        echo '<td>-</td>';

                                }
                            } ?>
                        </tr>
                        <tr>
                            <td>Mobilizing the<br/>target Audience</td>
                            <td>Awareness drives</td>
                            <?php
                            for ($i = date('Y',strtotime($briefs[0]['project_duration_from'])); $i <= date('Y',strtotime($briefs[0]['project_duration_to'])); $i++){  for ($k = 1; $k <= 12; $k++) {
                                $year =date('Y');
                                $month_name = date('M', mktime(0, 0, 0, $k, 1, $year));
                                $month_no = date('m', mktime(0, 0, 0, $k, 1, $year));
                                $daterange = $i.'-'.$month_no;


                                $assessment =  $this->Front_model->projectAssessmentData('brief_need_assessment',$brief_id, $daterange);
                                if(count($assessment) >0){
                                    if(!empty($assessment[0]['need_assessment']))
                                        echo '<td><a href="'.base_url().'uploads/briefNeedAssessment/'.$assessment[0]['need_assessment'].'" download>Download</a></td>';
                                    else
                                        echo '<td>No File uploaded</td>';

                                }
                                else
                                    echo '<td>-</td>';

                            }
                            } ?>
                        </tr>
                        <tr>
                            <td>Building<br/>Infrastructure for<br/>programs</td>
                            <td>Any construction intervention</td>
                            <?php
                            for ($i = date('Y',strtotime($briefs[0]['project_duration_from'])); $i <= date('Y',strtotime($briefs[0]['project_duration_to'])); $i++){
                                for ($k = 1; $k <= 12; $k++) {
                                    $year =date('Y');
                                    $month_name = date('M', mktime(0, 0, 0, $k, 1, $year));
                                    $month_no = date('m', mktime(0, 0, 0, $k, 1, $year));
                                    $daterange = $i.'-'.$month_no;

                                    $monitoring =  $this->Front_model->projectAssessmentData('brief_monitoring',$brief_id, $daterange);
                                    if(count($monitoring) >0)
                                        echo '<td><a href="#" data-toggle="modal" data-target="#report-download'.$k.'">Download</a></td>';
                                    else
                                        echo '<td>-</td>'; ?>


                                    <!--  Excel  Modal -->
                                    <div class="modal fade " id="report-download<?php echo $k; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content gray-modal">
                                                <div class="modal-body">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title text-center" id="myModalLabel"></h4>

                                                    <div class="row" style="padding: 50px 0;">
                                                        <div class="col-md-12">
                                                            <label class="text-right d-block mt-30 col-sm-6">Pre-Preparation Excel</label>
                                                            <div class="text-center d-block mt-30 col-sm-6">

                                                                <?php
                                                                if(count($monitoring) >0){
                                                                    if(!empty($monitoring[0]['pre_preparation_excel']))
                                                                        echo'<a class="" href="'.base_url().'uploads/briefMonitoring/'.$monitoring[0]['pre_preparation_excel'].'" download>Download</a>';
                                                                    else
                                                                        echo '<a>No File uploaded</a>';


                                                                }
                                                                else
                                                                    echo '<a>-</a>';
                                                                ?>

                                                                    </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <label class="text-right d-block mt-30 col-sm-6">Interim Reports</label>
                                                            <div class="text-center d-block mt-30 col-sm-6">
                                                                <?php
                                                                if(count($monitoring) >0){
                                                                    if(!empty($monitoring[0]['iInterim_excel']))
                                                                        echo'<a class="" href="'.base_url().'uploads/briefMonitoring/'.$monitoring[0]['iInterim_excel'].'" download>Download</a>';
                                                                    else
                                                                        echo '<a>No File uploaded</a>';


                                                                }
                                                                else
                                                                    echo '<a>-</a>';
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <label class="text-right d-block mt-30 col-sm-6">Final Reports</label>
                                                            <div class="text-center d-block mt-30 col-sm-6">
                                                                <?php
                                                                if(count($monitoring) >0){
                                                                    if(!empty($monitoring[0]['final_excel']))
                                                                        echo'<a class="" href="'.base_url().'uploads/briefMonitoring/'.$monitoring[0]['final_excel'].'" download>Download</a>';
                                                                    else
                                                                        echo '<a>No File uploaded</a>';
                                                                }
                                                                else
                                                                    echo '<a>-</a>';
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php    }
                            } ?>
                        </tr>
                        <tr>
                            <td>Implementation<br/>of Programs</td>
                            <td>Included training of the<br/>stakeholders and implementation<br/>of all the activities</td>
                            <?php
                            for ($i = date('Y',strtotime($briefs[0]['project_duration_from'])); $i <= date('Y',strtotime($briefs[0]['project_duration_to'])); $i++){  for ($k = 1; $k <= 12; $k++) {
                                $year =date('Y');
                                $month_name = date('M', mktime(0, 0, 0, $k, 1, $year));
                                $month_no = date('m', mktime(0, 0, 0, $k, 1, $year));
                                $daterange = $i.'-'.$month_no;


                                $brief_reporting =  $this->Front_model->projectAssessmentData('brief_reporting',$brief_id, $daterange);
                                if(count($brief_reporting) >0)
                                    echo '<td><a href="#" data-toggle="modal" data-target="#report-download2'.$k.'">Download</a></td>';
                                else
                                    echo '<td>-</td>';?>
                                <!--  Excel  Modal -->
                                <div class="modal fade " id="report-download2<?php echo $k; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content gray-modal">
                                            <div class="modal-body">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title text-center" id="myModalLabel"></h4>

                                                <div class="row" style="padding: 50px 0;">
                                                    <div class="col-md-12">
                                                        <label class="text-right d-block mt-30 col-sm-6">Pre-Preparation Excel</label>
                                                        <div class="text-center d-block mt-30 col-sm-6">
                                                            <?php
                                                            if(count($brief_reporting) >0){
                                                                if(!empty($brief_reporting[0]['pre_preparation_excel']))
                                                                    echo'<a class="" href="'.base_url().'uploads/briefReporting/'.$brief_reporting[0]['pre_preparation_excel'].'" download>Download</a>';
                                                                else
                                                                    echo '<a>No File uploaded</a>';


                                                            }
                                                            else
                                                                echo '<a>-</a>';
                                                                ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <label class="text-right d-block mt-30 col-sm-6">Interim Reports</label>
                                                        <div class="text-center d-block mt-30 col-sm-6">
                                                            <?php
                                                            if(count($brief_reporting) >0){
                                                                if(!empty($brief_reporting[0]['iInterim_excel']))
                                                                    echo'<a class="" href="'.base_url().'uploads/briefReporting/'.$brief_reporting[0]['iInterim_excel'].'" download>Download</a>';
                                                                else
                                                                    echo '<a>No File uploaded</a>';


                                                            }
                                                            else
                                                                echo '<a>-</a>';
                                                            ?>
                                                          </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <label class="text-right d-block mt-30 col-sm-6">Final Reports</label>
                                                        <div class="text-center d-block mt-30 col-sm-6">
                                                            <?php
                                                            if(count($brief_reporting) >0){
                                                                if(!empty($brief_reporting[0]['final_excel']))
                                                                    echo'<a class="" href="'.base_url().'uploads/briefReporting/'.$brief_reporting[0]['final_excel'].'" download>Download</a>';
                                                                else
                                                                    echo '<a>No File uploaded</a>';


                                                            }
                                                            else
                                                                echo '<a>-</a>';?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            <?php }
                            } ?>
                        </tr>
                        <tr>
                            <td>Monitoring and<br/>Reporting</td>
                            <td>Quarterly reporting</td>
                            <?php
                            for ($i = date('Y',strtotime($briefs[0]['project_duration_from'])); $i <= date('Y',strtotime($briefs[0]['project_duration_to'])); $i++){ ?>
                                <td></td>
                                <td></td>
                                <td>Q1<br/>Report</td>
                                <td></td>
                                <td></td>
                                <td>Q2<br/>Report</td>
                                <td></td>
                                <td></td>
                                <td>Q3<br/>Report</td>
                                <td></td>
                                <td></td>
                                <td>Q4<br/>Report</td>
                            <?php   } ?>


                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row mt-20 chartbar">
            <div class="col-sm-5">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="circle-bar" id="circle-a">
                            <div class="circle-content">
                                <span class="title">Total Project<br/> Completion</span>
                                <ul>
                                    <li>
                                        <div class="circle-orange"></div><span> Completed</span>
                                    </li>
                                    <li>
                                        <div class="circle-green"></div><span> Pending</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="circle-bar" id="circle-b">
                            <div class="circle-content">
                                <span class="title">Funds<br/> Utilization</span>
                                <ul>
                                    <li>
                                        <div class="circle-orange"></div><span> Funds Utilized</span>
                                    </li>
                                    <li>
                                        <div class="circle-green"></div><span> Funds Panding</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class='chart'>
                    <svg viewbox='0 0 560 260'>
                        <defs>
                            <filter id='dropshadow'>
                                <feGaussianBlur in='SourceAlpha' stdDeviation='3'></feGaussianBlur>
                                <feOffset dx='0' dy='0' result='offsetblur'></feOffset>
                                <feComponentTransfer>
                                    <feFuncA slope='0.2' type='linear'></feFuncA>
                                </feComponentTransfer>
                                <feMerge>
                                    <feMergeNode></feMergeNode>
                                    <feMergeNode in='SourceGraphic'></feMergeNode>
                                </feMerge>
                            </filter>
                        </defs>
                        <g class='datasets'>
                            <path class='dataset' d='M0,260 C35,254 63,124 88,124 C114,124 148,163 219,163 C290,163 315,100 359,100 C402,100 520,244 560,259 C560,259 0,259 0,260 Z' id='dataset-2'></path>
                            <path class='dataset' d='M0,260 C0,260 22,199 64,199 C105,199 112,144 154,144 C195,144 194,126 216,126 C237,126 263,184 314,184 C365,183 386,128 434,129 C483,130 511,240 560,260 L0,260 Z' id='dataset-1'></path>
                        </g>
                    </svg>
                </div>
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
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.1.3/circle-progress.min.js"></script>
<script>
    var progressBarOptions = {
        startAngle: -1.55,
        size: 150,
        value: 0.60,
        fill: {
            color: "#f5922b"
        }
    };
    var progressBarOptions2 = {
        startAngle: -2.55,
        size: 150,
        value: 0.20,
        fill: {
            color: "#fef200"
        }
    };
    var progressBarOptions3 = {
        startAngle: -1.55,
        size: 150,
        value: 0.10,
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
<script>
    (function() {
        var load_chart;
        load_chart = function() {
            $("body").removeClass("loaded");
            return setTimeout(function() {
                return $("body").addClass("loaded");
            }, 500);
        };

        $(".js-do-it-again").on("click", function() {
            return load_chart();
        });
        load_chart();

    }).call(this);
</script>