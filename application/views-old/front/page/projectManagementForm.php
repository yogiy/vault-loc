<?php
$baseline_study = $this->Front_model->getDataDesc('brief_baseline_study', 'brief_module_id', $brief_id,'brief_baseline_study_id');
$monitoring = $this->Front_model->getDataDesc('brief_monitoring', 'brief_module_id', $brief_id,'brief_monitoring_id');
$reporting = $this->Front_model->getDataDesc('brief_reporting', 'brief_module_id', $brief_id,'brief_reporting_id');
$need_assessment = $this->Front_model->getDataDesc('brief_need_assessment', 'brief_module_id', $brief_id,'brief_need_assessment_id');
$management = $this->Front_model->getDataDesc('project_management', 'brief_module_id', $brief_id,'project_management_id');
/* -----------------------------------------Mou date-----------------------------------------*/
if(empty($mou[0]['receipt_date']))
    $date1 =date('Y-m-d');
else if(!empty($mou[0]['receipt_date']) && $mou[0]['receipt_date'] == '0000-00-00')
    $date1 =date('Y-m-d');
else if(!empty($mou[0]['receipt_date']) && date($mou[0]['receipt_date']) >= date('Y-m-d'))
    $date1 =date('Y-m-d');
else if(!empty($mou[0]['receipt_date']) && date($mou[0]['receipt_date']) <= date('Y-m-d'))
    $date1 =date('Y-m-d',strtotime($mou[0]['receipt_date']));
else
    $date1 =date('Y-m-d',strtotime($mou[0]['receipt_date']));

if(empty($mou[0]['fund_start_date']))
    $date2 =date('Y-m-d');
else if(!empty($mou[0]['fund_start_date']) && $mou[0]['fund_start_date']== '0000-00-00')
    $date2 =date('Y-m-d');
else if(!empty($mou[0]['fund_start_date']) && date($mou[0]['fund_start_date']) >= date('Y-m-d'))
    $date2 =date('Y-m-d');
else if(!empty($mou[0]['fund_start_date']) && date($mou[0]['fund_start_date']) <= date('Y-m-d'))
    $date2 =date('Y-m-d',strtotime($mou[0]['fund_start_date']));
else
    $date2 =date('Y-m-d',strtotime($mou[0]['fund_start_date']));

if(empty($mou[0]['fund_end_date']))
    $date3 =date('Y-m-d');
else if(!empty($mou[0]['fund_end_date']) && $mou[0]['fund_end_date']== '0000-00-00')
    $date3 =date('Y-m-d');
else if(!empty($mou[0]['fund_end_date']) && date($mou[0]['fund_end_date']) >= date('Y-m-d'))
    $date3 =date('Y-m-d');
else if(!empty($mou[0]['fund_end_date']) && date($mou[0]['fund_end_date']) <= date('Y-m-d'))
    $date3 =date('Y-m-d',strtotime($mou[0]['fund_end_date']));
else
    $date3 =date('Y-m-d',strtotime($mou[0]['fund_end_date']));

if(empty($mou[0]['report_start_date']))
    $date4 =date('Y-m-d');
else if(!empty($mou[0]['report_start_date']) && $mou[0]['report_start_date']== '0000-00-00')
    $date4 =date('Y-m-d');
else if(!empty($mou[0]['report_start_date']) && date($mou[0]['report_start_date']) >= date('Y-m-d'))
    $date4 =date('Y-m-d');
else if(!empty($mou[0]['report_start_date']) && date($mou[0]['report_start_date']) <= date('Y-m-d'))
    $date4 =date('Y-m-d',strtotime($mou[0]['report_start_date']));
else
    $date4 =date('Y-m-d',strtotime($mou[0]['report_start_date']));

if(empty($mou[0]['report_end_date']))
    $date5 =date('Y-m-d');
else if(!empty($mou[0]['report_end_date']) && $mou[0]['report_end_date']== '0000-00-00')
    $date5 =date('Y-m-d');
else if(!empty($mou[0]['report_end_date']) && date($mou[0]['report_end_date']) >= date('Y-m-d'))
    $date5 =date('Y-m-d');
else if(!empty($mou[0]['report_end_date']) && date($mou[0]['report_end_date']) <= date('Y-m-d'))
    $date5 =date('Y-m-d',strtotime($mou[0]['report_end_date']));
else
    $date5 =date('Y-m-d',strtotime($mou[0]['report_end_date']));
/* -----------------------------------------Mou date end-----------------------------------------*/

/* -----------------------------------------Monitoring date-----------------------------------------*/
if(empty($monitoring[0]['pre_preparation_follow_up_date']))
    $date11 =date('Y-m-d');
else if(!empty($monitoring[0]['pre_preparation_follow_up_date']) && $monitoring[0]['pre_preparation_follow_up_date']== '0000-00-00')
    $date11 =date('Y-m-d');
else if(!empty($monitoring[0]['pre_preparation_follow_up_date']) && date($monitoring[0]['pre_preparation_follow_up_date']) >= date('Y-m-d'))
    $date11 =date('Y-m-d');
else if(!empty($monitoring[0]['pre_preparation_follow_up_date']) && date($monitoring[0]['pre_preparation_follow_up_date']) <= date('Y-m-d'))
    $date11 =date('Y-m-d',strtotime($monitoring[0]['pre_preparation_follow_up_date']));
else
    $date11 =date('Y-m-d',strtotime($monitoring[0]['pre_preparation_follow_up_date']));

if(empty($monitoring[0]['iInterim_follow_up_date']))
    $date22 =date('Y-m-d');
else if(!empty($monitoring[0]['iInterim_follow_up_date']) && $monitoring[0]['iInterim_follow_up_date']== '0000-00-00')
    $date22 =date('Y-m-d');
else if(!empty($monitoring[0]['iInterim_follow_up_date']) && date($monitoring[0]['iInterim_follow_up_date']) >= date('Y-m-d'))
    $date22 =date('Y-m-d');
else if(!empty($monitoring[0]['iInterim_follow_up_date']) && date($monitoring[0]['iInterim_follow_up_date']) <= date('Y-m-d'))
    $date22 =date('Y-m-d',strtotime($monitoring[0]['iInterim_follow_up_date']));
else
    $date22 =date('Y-m-d',strtotime($monitoring[0]['iInterim_follow_up_date']));

if(empty($monitoring[0]['final_follow_up_date']))
    $date33 =date('Y-m-d');
else if(!empty($monitoring[0]['final_follow_up_date']) && $monitoring[0]['final_follow_up_date']== '0000-00-00')
    $date33 =date('Y-m-d');
else if(!empty($monitoring[0]['final_follow_up_date']) && date($monitoring[0]['final_follow_up_date']) >= date('Y-m-d'))
    $date33 =date('Y-m-d');
else if(!empty($monitoring[0]['final_follow_up_date']) && date($monitoring[0]['final_follow_up_date']) <= date('Y-m-d'))
    $date33 =date('Y-m-d',strtotime($monitoring[0]['final_follow_up_date']));
else
    $date33 =date('Y-m-d',strtotime($monitoring[0]['final_follow_up_date']));

/* -----------------------------------------Monitoring date end-----------------------------------------*/

/* -----------------------------------------Reporting date-----------------------------------------*/
if(empty($reporting[0]['pre_preparation_follow_up_date']))
    $date21 =date('Y-m-d');
else if(!empty($reporting[0]['pre_preparation_follow_up_date']) && $reporting[0]['pre_preparation_follow_up_date']== '0000-00-00')
    $date21 =date('Y-m-d');
else if(!empty($reporting[0]['pre_preparation_follow_up_date']) && date($reporting[0]['pre_preparation_follow_up_date']) >= date('Y-m-d'))
    $date21 =date('Y-m-d');
else if(!empty($reporting[0]['pre_preparation_follow_up_date']) && date($reporting[0]['pre_preparation_follow_up_date']) <= date('Y-m-d'))
    $date21 =date('Y-m-d',strtotime($reporting[0]['pre_preparation_follow_up_date']));
else
    $date21 =date('Y-m-d',strtotime($reporting[0]['pre_preparation_follow_up_date']));

if(empty($reporting[0]['iInterim_follow_up_date']))
    $date32 =date('Y-m-d');
else if(!empty($reporting[0]['iInterim_follow_up_date']) && $reporting[0]['iInterim_follow_up_date']== '0000-00-00')
    $date32 =date('Y-m-d');
else if(!empty($reporting[0]['iInterim_follow_up_date']) && date($reporting[0]['iInterim_follow_up_date']) >= date('Y-m-d'))
    $date32 =date('Y-m-d');
else if(!empty($reporting[0]['iInterim_follow_up_date']) && date($reporting[0]['iInterim_follow_up_date']) <= date('Y-m-d'))
    $date32 =date('Y-m-d',strtotime($reporting[0]['iInterim_follow_up_date']));
else
    $date32 =date('Y-m-d',strtotime($reporting[0]['iInterim_follow_up_date']));

if(empty($reporting[0]['final_follow_up_date']))
    $date23 =date('Y-m-d');
else if(!empty($reporting[0]['final_follow_up_date']) && $reporting[0]['final_follow_up_date']== '0000-00-00')
    $date23 =date('Y-m-d');
else if(!empty($reporting[0]['final_follow_up_date']) && date($reporting[0]['final_follow_up_date']) >= date('Y-m-d'))
    $date23 =date('Y-m-d');
else if(!empty($reporting[0]['final_follow_up_date']) && date($reporting[0]['final_follow_up_date']) <= date('Y-m-d'))
    $date23 =date('Y-m-d',strtotime($reporting[0]['final_follow_up_date']));
else
    $date23 =date('Y-m-d',strtotime($reporting[0]['final_follow_up_date']));

/* -----------------------------------------Reporting date end-----------------------------------------*/

/* -----------------------------------------Set Reminder date-----------------------------------------*/
if(empty($management[0]['set_reminder']))
    $date31 =date('Y-m-d');
else if(!empty($management[0]['set_reminder']) && $management[0]['set_reminder'] == '0000-00-00')
    $date31 =date('Y-m-d');
else if(!empty($management[0]['set_reminder']) && date($management[0]['set_reminder']) >= date('Y-m-d'))
    $date31 =date('Y-m-d');
else if(!empty($management[0]['set_reminder']) && date($management[0]['set_reminder']) <= date('Y-m-d'))
    $date31 =date('Y-m-d',strtotime($management[0]['set_reminder']));
else
    $date31 =date('Y-m-d',strtotime($management[0]['set_reminder']));
/* -----------------------------------------Set Reminder date end-----------------------------------------*/



echo form_open_multipart(base_url().'projectManagementStore/'.$brief_id,array('method'=>'post', 'name'=>'project-management','id'=>'project-management','class'=>'','autocomplete'=>'off'));
?>

<div class="col-md-9 col-sm-6 col-xs-12">
    <div class="form-section">
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
        <div class="row">
            <div class="col-sm-2">
                <div class="form-group">
                    <label>MOU Signed Date</label>
                    <input type="date" min="<?php echo $date1;?>" class="form-control" name="receipt_date" value="<?php if(!empty($mou[0]['receipt_date'])) echo date($mou[0]['receipt_date'])?>"  placeholder="yyyy/mm/dd"/>
                </div>
                <div class="form-group">
                    <label>Budget Allocated</label>
                    <input type="number" min="0" name="budget" value="<?php if(!empty($mou[0]['budget'])) echo date($mou[0]['budget'])?>" class="form-control"/>
                </div>
                <div class="form-group">
                    <label>NGO Partners</label>
                    <a class="btn btn-warning btn-sm" href="<?php echo base_url();?>ngoExcelExport/<?php echo $brief_id;?>">Download Excel</a>
                </div>
                <div class="form-group">
                    <label>Funds Disbursement</label>
                    <select class="form-control" id="fund_disbursement" name="fund_disbursement">
                        <option value="">Please Select</option>
                        <option <?php if(!empty($mou[0]['fund_disbursement']) && $mou[0]['fund_disbursement']== 'Monthly') echo 'selected';?>>Monthly </option>
                        <option <?php if(!empty($mou[0]['fund_disbursement']) && $mou[0]['fund_disbursement']== 'Bi-monthly') echo 'selected';?>>Bi-monthly</option>
                        <option <?php if(!empty($mou[0]['fund_disbursement']) && $mou[0]['fund_disbursement']== 'Quarterly') echo 'selected';?>>Quarterly</option>
                        <option <?php if(!empty($mou[0]['fund_disbursement']) && $mou[0]['fund_disbursement']== 'Bi-Annually') echo 'selected';?>>Bi-Annually</option>
                        <option <?php if(!empty($mou[0]['fund_disbursement']) && $mou[0]['fund_disbursement']== 'Annually') echo 'selected';?>>Annually</option>
                        <option <?php if(!empty($mou[0]['fund_disbursement']) && $mou[0]['fund_disbursement']== 'Custom') echo 'selected';?>>Custom</option>
                    </select>
                </div>
                <div class="form-group custom-div" <?php if(!empty($mou[0]['fund_disbursement']) && $mou[0]['fund_disbursement']== 'Custom') echo '';else echo 'style="display: none"';?>>
                    <input type="date" class="form-control" value="<?php if(!empty($mou[0]['fund_start_date'])) echo date($mou[0]['fund_start_date'])?>" name="fund_start_date" min="<?php echo $date2;?>"  placeholder="yyyy/mm/dd"/>
                </div>
                <div class="form-group custom-div" <?php if(!empty($mou[0]['fund_disbursement']) && $mou[0]['fund_disbursement']== 'Custom') echo '';else echo 'style="display: none"';?>>
                    <input type="date" class="form-control" value="<?php if(!empty($mou[0]['fund_end_date'])) echo date($mou[0]['fund_end_date'])?>" name="fund_end_date" min="<?php echo $date3;?>"  placeholder="yyyy/mm/dd"/>
                </div>
                <div class="form-group">
                    <label>Reporting Schedule</label>
                    <select class="form-control" id="reporting_schedule" name="reporting_schedule">
                        <option value="">Please Select</option>
                        <option <?php if(!empty($mou[0]['reporting_schedule']) && $mou[0]['reporting_schedule']== 'Monthly') echo 'selected';?>>Monthly </option>
                        <option <?php if(!empty($mou[0]['reporting_schedule']) && $mou[0]['reporting_schedule']== 'Bi-monthly') echo 'selected';?>>Bi-monthly</option>
                        <option <?php if(!empty($mou[0]['reporting_schedule']) && $mou[0]['reporting_schedule']== 'Quarterly') echo 'selected';?>>Quarterly</option>
                        <option <?php if(!empty($mou[0]['reporting_schedule']) && $mou[0]['reporting_schedule']== 'Bi-Annually') echo 'selected';?>>Bi-Annually</option>
                        <option <?php if(!empty($mou[0]['reporting_schedule']) && $mou[0]['reporting_schedule']== 'Annually') echo 'selected';?>>Annually</option>
                        <option <?php if(!empty($mou[0]['reporting_schedule']) && $mou[0]['reporting_schedule']== 'Custom') echo 'selected';?>>Custom</option>
                    </select>
                </div>
                <div class="form-group custom-div2" <?php if(!empty($mou[0]['reporting_schedule']) && $mou[0]['reporting_schedule']== 'Custom') echo '';else echo 'style="display: none"';?>>
                    <input type="date" class="form-control" value="<?php if(!empty($mou[0]['report_start_date'])) echo date($mou[0]['report_start_date'])?>" name="report_start_date"  min="<?php echo $date4;?>" placeholder="yyyy/mm/dd"/>
                </div>
                <div class="form-group custom-div2" <?php if(!empty($mou[0]['reporting_schedule']) && $mou[0]['reporting_schedule']== 'Custom') echo '';else echo 'style="display: none"';?>>
                    <input type="date" class="form-control" value="<?php if(!empty($mou[0]['report_end_date'])) echo date($mou[0]['report_end_date'])?>" name="report_end_date" min="<?php echo $date5;?>"  placeholder="yyyy/mm/dd"/>
                </div>
            </div>
            <div class="col-sm-10">
                <div class="row min-h">
                    <div class="col-sm-1">
                        <div class="circle"></div>
                    </div>
                    <div class="col-sm-11">
                        <label>Baseline Study</label>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="upload-btn-wrapper">
                                            <button class="btn">Choose file</button>
                                            <input  class="col-sm-12 file1"  type="file" name="baseline_study" id="baseline_study"  />
                                            <span  class="col-sm-12 fileTextNm1" id="baseline_study_name" style="font-size: 12px;margin-bottom: 10px;padding-left: 0px;"><?php if(!empty($baseline_study[0]['baseline_study'])){  echo $baseline_study[0]['baseline_study'];}?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="chiller_cb">
                                            <input id="Checkbox1" name="base_mail_send" <?php if(!empty($baseline_study)  && $baseline_study[0]['mail_send'] == 1){  echo 'checked';}?>  type="checkbox"/>
                                            <label for="Checkbox1">client</label>
                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-10 row">
                                        <div class="input-group">
                                            <input type="text" name="base_mail_id" value="<?php if(!empty($baseline_study[0]['mail_id'])){  echo $baseline_study[0]['mail_id'];} else{ echo $client[0]['email']; }?>" class="form-control" placeholder="Send to client Email ID">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control"  name="base_b_status">
                                    <option value="">Please Select</option>
                                    <option <?php if(!empty($baseline_study[0]['b_status'])  && $baseline_study[0]['b_status'] =='Pending'){  echo 'selected';}?>>Pending</option>
                                    <option <?php if(!empty($baseline_study[0]['b_status'])  && $baseline_study[0]['b_status'] =='WIP'){ echo 'selected';}?>>WIP</option>
                                    <option <?php if(!empty($baseline_study[0]['b_status'] ) && $baseline_study[0]['b_status'] =='Completed'){ echo 'selected';}?>>Completed</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <?php if(empty($baseline_study[0]['baseline_study'])){
                                    echo'<a class="btn btn-gray btn-sm" style="opacity: 0.5;pointer-events: none;" href="#" download>Download</a>';
                                } else { ?>
                                    <a class="btn btn-green btn-sm" href="<?php echo base_url()?>uploads/briefBaselineStudy/<?php echo $baseline_study[0]['baseline_study'] ?>" download>Download</a>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row min-h">
                    <div class="col-sm-1">
                        <div class="circle"></div>
                    </div>
                    <div class="col-sm-11">
                        <label>Need Assessment</label>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="upload-btn-wrapper">
                                            <button class="btn">Choose file</button>
                                            <input  class="col-sm-12 file2" type="file" name="need_assessment"  id="need_assessment"  />
                                            <span  class="col-sm-12 fileTextNm2" id="need_assessment_name" style="font-size: 12px;margin-bottom: 10px;padding-left: 0px;"><?php if(!empty($need_assessment[0]['need_assessment'])){  echo $need_assessment[0]['need_assessment'];}?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="chiller_cb">
                                            <input id="Checkbox2" name="need_mail_send" <?php if(!empty($need_assessment)  && $need_assessment[0]['mail_send'] == 1){  echo 'checked';}?> type="checkbox"/>
                                            <label for="Checkbox2">client</label>
                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-10 row">
                                        <div class="input-group">
                                            <input type="text" class="form-control"  value="<?php if(!empty($need_assessment[0]['mail_id'])){  echo $need_assessment[0]['mail_id'];} else{ echo $client[0]['email']; }?>" name="need_mail_id" placeholder="Send to client Email ID">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control"  name="need_b_status">
                                    <option value="">Please Select</option>
                                    <option <?php if(!empty($need_assessment[0]['b_status'])  && $need_assessment[0]['b_status'] =='Pending'){  echo 'selected';}?>>Pending</option>
                                    <option <?php if(!empty($need_assessment[0]['b_status'])  && $need_assessment[0]['b_status'] =='WIP'){ echo 'selected';}?>>WIP</option>
                                    <option <?php if(!empty($need_assessment[0]['b_status'] ) && $need_assessment[0]['b_status'] =='Completed'){ echo 'selected';}?>>Completed</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <?php if(empty($need_assessment[0]['need_assessment'])){
                                    echo'<a class="btn btn-gray btn-sm" style="opacity: 0.5;pointer-events: none;" href="#" download>Download</a>';
                                } else { ?>
                                    <a class="btn btn-green btn-sm" href="<?php echo base_url()?>uploads/briefNeedAssessment/<?php echo $need_assessment[0]['need_assessment'] ?>" download>Download</a>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row min-h">
                    <div class="col-sm-1">
                        <div class="circle"></div>
                    </div>
                    <div class="col-sm-11">
                        <label>Monitoring</label>
                        <div class="row">
                            <div class="col-sm-2">
                                <label class="nowrap text-center">Pre-Preparation</label>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="date" name="pre_preparation_follow_up_date" value="<?php if(!empty($monitoring[0]['pre_preparation_follow_up_date'])){  echo date($monitoring[0]['pre_preparation_follow_up_date']);}?>" class="form-control"    min="<?php echo $date11;?>"   placeholder="yyyy/mm/dd"/>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="upload-btn-wrapper">
                                            <button class="btn">Choose file</button>
                                            <input  class="col-sm-12 file3" type="file" name="pre_preparation_excel" id="pre_preparation_excel"  />
                                            <span  class="col-sm-12 fileTextNm3" id="pre_preparation_excel_name" style="font-size: 12px;margin-bottom: 10px;padding-left: 0px;"><?php if(!empty($monitoring[0]['pre_preparation_excel'])){  echo ($monitoring[0]['pre_preparation_excel']);}?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control"  name="pre_preparation_b_status">
                                    <option value="">Please Select</option>
                                    <option <?php if(!empty($monitoring[0]['pre_preparation_b_status'])  && $monitoring[0]['pre_preparation_b_status'] == 'Pending'){  echo 'selected';}?>>Pending</option>
                                    <option <?php if(!empty($monitoring[0]['pre_preparation_b_status'])  && $monitoring[0]['pre_preparation_b_status'] =='WIP'){ echo 'selected';}?>>WIP</option>
                                    <option <?php if(!empty($monitoring[0]['pre_preparation_b_status'] ) && $monitoring[0]['pre_preparation_b_status'] =='Completed'){ echo 'selected';}?>>Completed</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <?php if(empty($monitoring[0]['pre_preparation_excel'])){
                                    echo'<a class="btn btn-gray btn-sm" style="opacity: 0.5;pointer-events: none;" href="#" download>Download</a>';
                                } else { ?>
                                    <a class="btn btn-green btn-sm" href="<?php echo base_url()?>uploads/briefMonitoring/<?php echo $monitoring[0]['pre_preparation_excel'] ?>" download>Download</a>
                                <?php }?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <label class="nowrap text-center">Interim Reports</label>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="date" value="<?php if(!empty($monitoring[0]['iInterim_follow_up_date'])){  echo date($monitoring[0]['iInterim_follow_up_date']);}?>" name="iInterim_follow_up_date" class="form-control"  min="<?php echo $date22;?>" placeholder="yyyy/mm/dd"/>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="upload-btn-wrapper">
                                            <button class="btn">Choose file</button>
                                            <input  class="col-sm-12 file4" type="file" accept="doc,pdf,rtf,docx" name="iInterim_excel" id="iInterim_excel"  />
                                            <span  class="col-sm-12 fileTextNm4" id="ideation_stage_name" style="font-size: 12px;margin-bottom: 10px;padding-left: 0px;"><?php if(!empty($monitoring[0]['iInterim_excel'])){  echo ($monitoring[0]['iInterim_excel']);}?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control"  name="iInterim_b_status">
                                    <option value="">Please Select</option>
                                    <option <?php if(!empty($monitoring[0]['iInterim_b_status'])  && $monitoring[0]['iInterim_b_status'] =='Pending'){  echo 'selected';}?>>Pending</option>
                                    <option <?php if(!empty($monitoring[0]['iInterim_b_status'])  && $monitoring[0]['iInterim_b_status'] =='WIP'){ echo 'selected';}?>>WIP</option>
                                    <option <?php if(!empty($monitoring[0]['iInterim_b_status'] ) && $monitoring[0]['iInterim_b_status'] =='Completed'){ echo 'selected';}?>>Completed</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <?php if(empty($monitoring[0]['iInterim_excel'])){
                                    echo'<a class="btn btn-gray btn-sm" style="opacity: 0.5;pointer-events: none;" href="#" download>Download</a>';
                                } else { ?>
                                    <a class="btn btn-green btn-sm" href="<?php echo base_url()?>uploads/briefMonitoring/<?php echo $monitoring[0]['iInterim_excel'] ?>" download>Download</a>
                                <?php }?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <label class="nowrap text-center">Final Reports</label>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="date" value="<?php if(!empty($monitoring[0]['final_follow_up_date'])){  echo date($monitoring[0]['final_follow_up_date']);}?>" name="final_follow_up_date" class="form-control"  min="<?php echo $date33;?>" placeholder="yyyy/mm/dd"/>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="upload-btn-wrapper">
                                            <button class="btn">Choose file</button>
                                            <input  class="col-sm-12 file-doc3" type="file" accept="doc,pdf,rtf,docx" name="final_excel" id="final_excel"  />
                                            <span  class="col-sm-12 filedocNm3" id="final_excel_name" style="font-size: 12px;margin-bottom: 10px;padding-left: 0px;"><?php if(!empty($monitoring[0]['final_excel'])){  echo ($monitoring[0]['final_excel']);}?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control"  name="final_b_status">
                                    <option value="">Please Select</option>
                                    <option <?php if(!empty($monitoring[0]['final_b_status'])  && $monitoring[0]['final_b_status'] =='Pending'){  echo 'selected';}?>>Pending</option>
                                    <option <?php if(!empty($monitoring[0]['final_b_status'])  && $monitoring[0]['final_b_status'] =='WIP'){ echo 'selected';}?>>WIP</option>
                                    <option <?php if(!empty($monitoring[0]['final_b_status'] ) && $monitoring[0]['final_b_status'] =='Completed'){ echo 'selected';}?>>Completed</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <?php if(empty($monitoring[0]['final_excel'])){
                                    echo'<a class="btn btn-gray btn-sm" style="opacity: 0.5;pointer-events: none;" href="#" download>Download</a>';
                                } else { ?>
                                    <a class="btn btn-green btn-sm" href="<?php echo base_url()?>uploads/briefMonitoring/<?php echo $monitoring[0]['final_excel'] ?>" download>Download</a>
                                <?php }?>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row min-h">
                    <div class="col-sm-1">
                        <div class="circle"></div>
                    </div>
                    <div class="col-sm-11">
                        <label>Reporting</label>
                        <div class="row">
                            <div class="col-sm-2">
                                <label class="nowrap text-center">Pre-Preparation</label>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="date" name="report_pre_preparation_follow_up_date" value="<?php if(!empty($reporting[0]['pre_preparation_follow_up_date'])){  echo date($reporting[0]['pre_preparation_follow_up_date']);}?>" class="form-control"  min="<?php echo $date21 ;?>"  placeholder="yyyy/mm/dd"/>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="upload-btn-wrapper">
                                            <button class="btn">Choose file</button>
                                            <input  class="col-sm-12 file-doc4" type="file" name="report_pre_preparation_excel" id="report_pre_preparation_excel"  />
                                            <span  class="col-sm-12 filedocNm4" id="report_pre_preparation_excel_name" style="font-size: 12px;margin-bottom: 10px;padding-left: 0px;"><?php if(!empty($reporting[0]['pre_preparation_excel'])){  echo ($reporting[0]['pre_preparation_excel']);}?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control"  name="report_pre_preparation_b_status">
                                    <option value="">Please Select</option>
                                    <option <?php if(!empty($reporting[0]['pre_preparation_b_status'])  && $reporting[0]['pre_preparation_b_status'] =='Pending'){  echo 'selected';}?>>Pending</option>
                                    <option <?php if(!empty($reporting[0]['pre_preparation_b_status'])  && $reporting[0]['pre_preparation_b_status'] =='WIP'){ echo 'selected';}?>>WIP</option>
                                    <option <?php if(!empty($reporting[0]['pre_preparation_b_status'] ) && $reporting[0]['pre_preparation_b_status'] =='Completed'){ echo 'selected';}?>>Completed</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <?php if(empty($reporting[0]['pre_preparation_excel'])){
                                    echo'<a class="btn btn-gray btn-sm" style="opacity: 0.5;pointer-events: none;" href="#" download>Download</a>';
                                } else { ?>
                                    <a class="btn btn-green btn-sm" href="<?php echo base_url()?>uploads/briefReporting/<?php echo $reporting[0]['pre_preparation_excel'] ?>" download>Download</a>
                                <?php }?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <label class="nowrap text-center">Interim Reports</label>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="date" name="report_iInterim_follow_up_date"  value="<?php if(!empty($reporting[0]['iInterim_follow_up_date'])){  echo date($reporting[0]['iInterim_follow_up_date']);}?>" class="form-control" min="<?php echo $date32 ;?>"  placeholder="yyyy/mm/dd"/>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="upload-btn-wrapper">
                                            <button class="btn">Choose file</button>
                                            <input  class="col-sm-12 file-doc5" type="file" accept="doc,pdf,rtf,docx" name="report_iInterim_excel" id="report_iInterim_excel"  />
                                            <span  class="col-sm-12 filedocNm5" id="report_name" style="font-size: 12px;margin-bottom: 10px;padding-left: 0px;"><?php if(!empty($reporting[0]['iInterim_excel'])){  echo ($reporting[0]['iInterim_excel']);}?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control"  name="report_iInterim_b_status">
                                    <option value="">Please Select</option>
                                    <option <?php if(!empty($reporting[0]['iInterim_b_status'])  && $reporting[0]['iInterim_b_status'] =='Pending'){  echo 'selected';}?>>Pending</option>
                                    <option <?php if(!empty($reporting[0]['iInterim_b_status'])  && $reporting[0]['iInterim_b_status'] =='WIP'){ echo 'selected';}?>>WIP</option>
                                    <option <?php if(!empty($reporting[0]['iInterim_b_status'] ) && $reporting[0]['iInterim_b_status'] =='Completed'){ echo 'selected';}?>>Completed</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <?php if(empty($reporting[0]['iInterim_excel'])){
                                    echo'<a class="btn btn-gray btn-sm" style="opacity: 0.5;pointer-events: none;" href="#" download>Download</a>';
                                } else { ?>
                                    <a class="btn btn-green btn-sm" href="<?php echo base_url()?>uploads/briefReporting/<?php echo $reporting[0]['iInterim_excel'] ?>" download>Download</a>
                                <?php }?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <label class="nowrap text-center">Final Reports</label>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="date" name="report_final_follow_up_date" value="<?php if(!empty($reporting[0]['final_follow_up_date'])){  echo date($reporting[0]['final_follow_up_date']);}?>" class="form-control" min="<?php echo $date23;?>" placeholder="yyyy/mm/dd"/>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="upload-btn-wrapper">
                                            <button class="btn">Choose file</button>
                                            <input  class="col-sm-12 file-doc6" type="file" accept="doc,pdf,rtf,docx" name="report_final_excel" id="report_final_excel"  />
                                            <span  class="col-sm-12 filedocNm6" id="final_excel_name" style="font-size: 12px;margin-bottom: 10px;padding-left: 0px;"><?php if(!empty($reporting[0]['final_excel'])){  echo date($reporting[0]['final_excel']);}?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control"  name="report_final_b_status">
                                    <option value="">Please Select</option>
                                    <option <?php if(!empty($reporting[0]['final_b_status'])  && $reporting[0]['final_b_status'] =='Pending'){  echo 'selected';}?>>Pending</option>
                                    <option <?php if(!empty($reporting[0]['final_b_status'])  && $reporting[0]['final_b_status'] =='WIP'){ echo 'selected';}?>>WIP</option>
                                    <option <?php if(!empty($reporting[0]['final_b_status'] ) && $reporting[0]['final_b_status'] =='Completed'){ echo 'selected';}?>>Completed</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <?php if(empty($reporting[0]['final_excel'])){
                                    echo'<a class="btn btn-gray btn-sm" style="opacity: 0.5;pointer-events: none;" href="#" download>Download</a>';
                                } else { ?>
                                    <a class="btn btn-green btn-sm" href="<?php echo base_url()?>uploads/briefReporting/<?php echo $reporting[0]['final_excel'] ?>" download>Download</a>
                                <?php }?>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-offset-1 col-sm-11">
                        <div class="row">
                            <div class="col-sm-2">
                                <label class="nowrap text-center">Set Reminder</label>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="date" name="set_reminder"  value="<?php if(!empty($management[0]['set_reminder'])){  echo date($management[0]['set_reminder']);}?>" min="<?php echo $date31;?>" class="form-control text-box-orange" placeholder="yyyy/mm/dd"/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label>Beneficiary Impact</label>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="upload-btn-wrapper">
                                            <button class="btn">Choose file</button>
                                            <input  class="col-sm-12 file-doc1" type="file" name="beneficiary_import" id="beneficiary_import"  />
                                            <span  class="col-sm-12 filedocNm1" id="beneficiary_import_name" style="font-size: 12px;margin-bottom: 10px;padding-left: 0px;"><?php if(!empty($management[0]['beneficiary_import'])){  echo ($management[0]['beneficiary_import']);}?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label>Project Assessment</label>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="upload-btn-wrapper">
                                            <button class="btn">Choose file</button>
                                            <input  class="col-sm-12 file-doc2" type="file" name="project_assessment" id="project_assessment"  />
                                            <span  class="col-sm-12 filedocNm2" id="project_assessment_name" style="font-size: 12px;margin-bottom: 10px;padding-left: 0px;"><?php if(!empty($management[0]['project_assessment'])){  echo ($management[0]['project_assessment']);}?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <a href="<?php echo base_url()?>project-management" class="btn btn-dark-gray btn-sm pull-right" style="margin-left: 10px; border-radius: 0px">Back</a>
                        <button class="btn btn-warning btn-sm pull-right" type="submit">Save & Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo form_close();?>
<script>
    $("#fund_disbursement").click(function(e) {
        e.preventDefault();
        var fund_disbursement = $("#fund_disbursement").val();
        if(fund_disbursement == 'Custom'){
            $(".custom-div").show();
        }else{
            $(".custom-div").hide();
        }
    });

    $("#reporting_schedule").click(function(e) {
        e.preventDefault();
        var reporting_schedule = $("#reporting_schedule").val();
        if(reporting_schedule == 'Custom'){
            $(".custom-div2").show();
        }else{
            $(".custom-div2").hide();
        }
    });
</script>


