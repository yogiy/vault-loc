<?php
$feedback = $this->Front_model->getDataDesc('brief_feedback', 'brief_module_id', $brief_id,'brief_feedback_id');
$rework = $this->Front_model->getDataDesc('brief_rework', 'brief_module_id', $brief_id,'brief_rework_id');
$mou = $this->Front_model->getDataDesc('brief_mou', 'brief_module_id', $brief_id,'brief_mou_id');

if(!empty($ideations)){
    echo form_open_multipart(base_url().'projectDevelopmentUpdate/'.$brief_id.'/'.$ideations[0]['project_development_id'],array('method'=>'post', 'name'=>'add_briefModule','id'=>'add_briefModule','class'=>'','autocomplete'=>'off'));
}else{
    echo form_open_multipart(base_url().'projectDevelopmentStore/'.$brief_id,array('method'=>'post', 'name'=>'add_briefModule','id'=>'add_briefModule','class'=>'','autocomplete'=>'off'));
}

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

if(empty($ideations[0]['follow_up_date']))
    $date2 =date('Y-m-d');
else if(!empty($ideations[0]['follow_up_date']) && $ideations[0]['follow_up_date'] == '0000-00-00')
    $date2 =date('Y-m-d');
else if(!empty($ideations[0]['follow_up_date']) && date($ideations[0]['follow_up_date']) >= date('Y-m-d'))
    $date2 =date('Y-m-d');
else if(!empty($ideations[0]['follow_up_date']) && date($ideations[0]['follow_up_date']) <= date('Y-m-d'))
    $date2 =date('Y-m-d',strtotime($ideations[0]['follow_up_date']));
else
    $date2 =date('Y-m-d',strtotime($ideations[0]['follow_up_date']));

if(empty($rework[0]['follow_up_date']))
    $date3 =date('Y-m-d');
else if(!empty($rework[0]['follow_up_date']) && $rework[0]['follow_up_date'] == '0000-00-00')
    $date3 =date('Y-m-d');
else if(!empty($rework[0]['follow_up_date']) && date($rework[0]['follow_up_date']) >= date('Y-m-d'))
    $date3 =date('Y-m-d');
else if(!empty($rework[0]['follow_up_date']) && date($rework[0]['follow_up_date']) <= date('Y-m-d'))
    $date3 =date('Y-m-d',strtotime($rework[0]['follow_up_date']));
else
    $date3 =date('Y-m-d',strtotime($rework[0]['follow_up_date']));

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
                <h5 class="inner-page-title">PDID: <?php echo $brief_id; ?><br/><small>Initiated Date:<?php echo date('d-m-Y',strtotime($briefs[0]['created_at']))?></small></h5>
            </div>
        </div>
        <label>CSR C.O.D.E</label>
        <div class="row">

            <?php /*---Ideation Stage----*/?>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Concept</label>
                    <textarea class="form-control" placeholder="Strategy basis philosophy and objective" name="concept" id="concept" rows="3"><?php if(!empty($ideations[0])) echo $ideations[0]['concept']?></textarea>
                </div>
                <div class="form-group">
                    <label>Outline</label>
                    <textarea class="form-control" placeholder="Vision & Mission of an organization." name="outline" id="outline" rows="3"><?php if(!empty($ideations[0]['outline'])) echo $ideations[0]['outline']?></textarea>
                </div>
                <div class="form-group">
                    <label>Direction</label>
                    <textarea class="form-control" placeholder="Throught stakeholders need and assessment & expectation." name="direction" id="direction" rows="3"><?php if(!empty($ideations[0]['direction'])) echo $ideations[0]['direction']?></textarea>
                </div>
                <div class="form-group">
                    <label>Establish</label>
                    <textarea class="form-control" placeholder="Holistic approach to design strong program" id="establish" name="establish" rows="3"><?php if(!empty($ideations[0]['establish'])) echo $ideations[0]['establish']?></textarea>
                </div>
                <div class="row">
                    <a href="<?php echo base_url();?>needAssessment/<?php echo $brief_id;?>" class="btn btn-warning btn-sm" style="margin-left: 10px; border-radius: 0px">Need Assessment</a>
                </div>
                <!--                <div class="form-group">-->
                <!--                    <button class="btn btn-warning" onclick="window.location.href='#'">Location Analysis</button>-->
                <!--                </div>-->
            </div>
            <?php /*---Ideation Stage----*/?>
            <div class="col-sm-9">
                <div class="row min-h">
                    <div class="col-sm-1">
                        <?php if((!empty($ideations)) && $ideations[0]['b_status'] =='Completed') { ?>
                            <div class="circle"></div>
                        <?php }else{?>
                            <div class="grey-circle"></div>
                        <?php }?>
                    </div>
                    <div class="col-sm-11">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Ideation Stage</label>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="upload-btn-wrapper">
                                            <button class="btn">Choose file</button>
                                            <input  class="col-sm-12 file1" type="file" name="ideation_stage" value="<?php if(!empty($ideations[0]['ideation_stage'] )) echo $ideations[0]['ideation_stage']?>" id="ideation_stage"  />
                                            <span  class="col-sm-12 fileTextNm1" id="ideation_stage_name" style="font-size: 12px;margin-bottom: 10px;padding-left: 0px;"><?php if(!empty($ideations[0]['ideation_stage'] )) echo $ideations[0]['ideation_stage']?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Set Follow up date</label>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="date" min="<?php echo $date2; ?>" name="follow_up_date" id="follow_up_date" value="<?php if(!empty($ideations[0]['follow_up_date'])) echo date($ideations[0]['follow_up_date'])?>" class="form-control" placeholder="yyyy/mm/dd"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <div class="chiller_cb">
                                    <input id="mail_send" type="checkbox" name="mail_send" value="1" <?php if(!empty($ideations[0]['mail_send']) && $ideations[0]['mail_send']==1) echo "Checked"?>/>
                                    <label for="mail_send">Client</label>
                                    <span></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div>
                                    <input type="text" name="client_name" value="<?php if(!empty($ideations) && !empty($ideations[0]['mail_id'])){ echo ($ideations[0]['mail_id']); } else{  echo $client[0]['email']; } ?>" class="form-control" placeholder="Client/Representative">
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <label>Status</label>
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control"  name="status">
                                    <option value="">Please Select</option>
                                    <option <?php if(!empty($ideations[0]) && $ideations[0]['b_status'] =='Pending') echo "selected"?>>Pending </option>
                                    <option <?php if(!empty($ideations[0]) && $ideations[0]['b_status'] =='WIP') echo "selected"?>>WIP</option>
                                    <option <?php if(!empty($ideations[0]) && $ideations[0]['b_status'] =='Completed') echo "selected"?>>Completed</option>
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <?php if(empty($ideations)) { ?>
                                    <a class="btn btn-gray btn-sm" style="opacity: 0.5;pointer-events: none;" href="#" download>Download</a>
                                <?php }else if((!empty($ideations[0]['ideation_stage'])) && $ideations[0]['b_status'] =='Completed') { ?>
                                    <a class="btn btn-green btn-sm" href="<?php echo base_url()?>uploads/projectDevelopment/<?php echo $ideations[0]['ideation_stage'] ?>" download>Download</a>
                                <?php }else if((empty($ideations[0]['ideation_stage']))) { ?>
                                    <a class="btn btn-gray btn-sm" style="opacity: 0.5;pointer-events: none;" href="#" download>Download</a>
                                <?php } else{ ?>
                                    <a class="btn btn-green btn-sm" href="<?php echo base_url()?>uploads/projectDevelopment/<?php echo $ideations[0]['ideation_stage'] ?>" download>Download</a>
                                <?php  }?>


                            </div>
                        </div>
                    </div>
                </div>

                <?php /*---Feedback----*/?>
                <div class="row min-h">
                    <div class="col-sm-1">
                        <?php if(empty($ideations)){
                            echo' <div class="grey-circle"></div>';
                        } else if(!empty($ideations) && $ideations[0]['b_status'] == 'Completed' && empty($feedback)) {
                            echo' <div class="grey-circle"></div>';
                        } else if(!empty($ideations) && $ideations[0]['b_status'] == 'Completed' && !empty($feedback) && $feedback[0]['b_status'] == 'Completed'){
                            echo' <div class="circle"></div>';
                        }else if(!empty($ideations) && $ideations[0]['b_status'] == 'Completed' && !empty($feedback) && $feedback[0]['b_status'] != 'Completed'){
                            echo' <div class="grey-circle"></div>';
                        }else{
                            echo' <div class="grey-circle"></div>';
                        }?>
                    </div>
                    <div class="col-sm-11"
                        <?php if(empty($ideations)){
                            echo'style="opacity: 0.5;pointer-events: none;"';
                        } else if(!empty($ideations) && $ideations[0]['b_status'] == 'Completed' && empty($feedback)) {
                            echo'';
                        } else if(!empty($ideations) && $ideations[0]['b_status'] == 'Completed' && !empty($feedback) && $feedback[0]['b_status'] == 'Completed'){
                            echo'';
                               }else if(!empty($ideations) && $ideations[0]['b_status'] == 'Completed' && !empty($feedback) && $feedback[0]['b_status'] != 'Completed'){
                            echo'';
                        }else{
                            echo'style="opacity: 0.5;pointer-events: none;"';
                        }?>>
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Feedback</label>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#suggested">
                                    Open Feedback
                                </button>
                            </div>
                            <div class="col-sm-1 col-sm-offset-2">
                                <label>&nbsp;</label>
                                <label>Status</label>
                            </div>
                            <div class="col-sm-3">
                                <label>&nbsp;</label>
                                <select class="form-control" name="feedback_b_status">
                                    <option value="">Please Select</option>
                                    <option <?php if(!empty($feedback[0]) && $feedback[0]['b_status'] =='Pending') echo "selected"?>>Pending </option>
                                    <option <?php if(!empty($feedback[0]) && $feedback[0]['b_status'] =='WIP') echo "selected"?>>WIP</option>
									<option <?php if(!empty($feedback[0]) && $feedback[0]['b_status'] =='Completed') echo "selected"?>>Completed</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <?php /*---Rework----*/?>
                <div class="row min-h">
                    <div class="col-sm-1">
                        <?php if(empty($ideations)){
                            echo' <div class="grey-circle"></div>';
                        } else if((!empty($ideations)) && $ideations[0]['b_status'] =='Completed' && !empty($feedback) && $feedback[0]['b_status'] !='Completed'){
                            echo' <div class="grey-circle"></div>';
                        }else if((!empty($ideations)) && $ideations[0]['b_status'] =='Completed' && !empty($feedback) && $feedback[0]['b_status'] =='Completed' && empty($rework)){
                            echo' <div class="grey-circle"></div>';
                        }
                        else if((!empty($ideations)) && $ideations[0]['b_status'] =='Completed' && !empty($feedback) && $feedback[0]['b_status'] =='Completed' && !empty($rework) && $rework[0]['b_status'] !='Completed'){
                            echo' <div class="grey-circle"></div>';
                        } else if((!empty($ideations)) && $ideations[0]['b_status'] =='Completed' && !empty($feedback) && $feedback[0]['b_status'] =='Completed' && !empty($rework) && $rework[0]['b_status'] =='Completed'){
                            echo' <div class="circle"></div>';
                        }else{
                            echo' <div class="grey-circle"></div>';
                        }?>
                    </div>
                    <div class="col-sm-11"
                        <?php if(empty($ideations)){
                            echo'style="opacity: 0.5;pointer-events: none;"';
                        } else if((!empty($ideations)) && $ideations[0]['b_status'] =='Completed' && !empty($feedback) && $feedback[0]['b_status'] !='Completed'){
                            echo'style="opacity: 0.5;pointer-events: none;"';
                        }else if((!empty($ideations)) && $ideations[0]['b_status'] =='Completed' && !empty($feedback) && $feedback[0]['b_status'] =='Completed' && empty($rework)){
                            echo'';
                        }
                        else if((!empty($ideations)) && $ideations[0]['b_status'] =='Completed' && !empty($feedback) && $feedback[0]['b_status'] =='Completed' && !empty($rework) && $rework[0]['b_status'] !='Completed'){
                            echo'';
                        } else if((!empty($ideations)) && $ideations[0]['b_status'] =='Completed' && !empty($feedback) && $feedback[0]['b_status'] =='Completed' && !empty($rework) && $rework[0]['b_status'] =='Completed'){
                            echo'';
                        }else{
                            echo'style="opacity: 0.5;pointer-events: none;"';
                        }?>
                        >
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Rework</label>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="upload-btn-wrapper">
                                            <button class="btn">Choose file</button>
                                            <input  type="file"  class="col-sm-12 file2" name="rework_excel" id="rework_excel" />
                                        </div>
                                        <span  class="col-sm-12 fileTextNm2" id="rework_excel" style="font-size: 12px;margin-bottom: 10px;padding-left: 0px;"><?php if(!empty($rework) && !empty($rework[0]['rework'])){ echo ($rework[0]['rework']);}?></span>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Set Follow up date</label>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="date" min="<?php echo $date3; ?>" class="form-control" name="rework_follow_up_date" id="rework_follow_up_date" value="<?php if(!empty($rework) && !empty($rework[0]['follow_up_date'])){ echo date($rework[0]['follow_up_date']);}?>"  placeholder="yyyy/mm/dd"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <div class="chiller_cb">
                                    <input id="Checkbox2" type="checkbox" name="rework_mail_send" <?php if(!empty($rework) && !empty($rework[0]['mail_send']) && $rework[0]['mail_send'] =='1'){ echo 'checked';}?>" />
                                    <label for="Checkbox2">client</label>
                                    <span></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="rework_client_name" value="<?php if(!empty($rework) && !empty($rework[0]['mail_id'])){ echo ($rework[0]['mail_id']);} else{  echo $client[0]['email']; } ?>" class="form-control" placeholder="Client/Representative">
                            </div>
                            <div class="col-sm-1">
                                <label>Status</label>
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control"  name="rework_b_status">
                                    <option value="">Please Select</option>
                                    <option <?php if(!empty($rework) && !empty($rework[0]['b_status'])  && $rework[0]['b_status'] =='Pending '){  echo 'selected';}?>>Pending </option>
                                    <option <?php if(!empty($rework) && !empty($rework[0]['b_status'])  && $rework[0]['b_status'] =='WIP'){ echo 'selected';}?>>WIP</option>
                                    <option <?php if(!empty($rework[0]['b_status'] ) && $rework[0]['b_status'] =='Completed'){ echo 'selected';}?>>Completed</option>
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <?php if(empty($ideations)){
                                    echo'<a class="btn btn-gray btn-sm" style="opacity: 0.5;pointer-events: none;" href="#" download>Download</a>';
                                }else if((!empty($ideations)) && $ideations[0]['b_status'] =='Completed' && !empty($feedback) && $feedback[0]['b_status'] !='Completed'){
                                    echo'<a class="btn btn-gray btn-sm" style="opacity: 0.5;pointer-events: none;" href="#" download>Download</a>';
                                }else if((!empty($ideations)) && $ideations[0]['b_status'] =='Completed' && !empty($feedback) && $feedback[0]['b_status'] =='Completed' && empty($rework)){
                                    echo'<a class="btn btn-gray btn-sm"  href="#" download>Download</a>';
                                }
                                else if((!empty($ideations)) && $ideations[0]['b_status'] =='Completed' && !empty($feedback) && $feedback[0]['b_status'] =='Completed' && !empty($rework) && !empty($rework[0]['rework']) && $rework[0]['b_status'] !='Completed'){ ?>
                                    <a class="btn btn-green btn-sm" href="<?php echo base_url()?>uploads/briefRework/<?php echo $rework[0]['rework'] ?>" download>Download</a>
                                <?php }
                                else if((!empty($ideations)) && $ideations[0]['b_status'] =='Completed' && !empty($feedback) && $feedback[0]['b_status'] =='Completed' && !empty($rework) && !empty($rework[0]['rework']) && $rework[0]['b_status'] =='Completed'){
                                  ?>  <a class="btn btn-green btn-sm" href="<?php echo base_url()?>uploads/briefRework/<?php echo $rework[0]['rework'] ?>" download>Download</a>
                               <?php }else if((!empty($ideations)) && $ideations[0]['b_status'] =='Completed' && !empty($feedback) && $feedback[0]['b_status'] =='Completed'){?>
                                    <a class="btn btn-green btn-sm" href="<?php echo base_url()?>uploads/briefRework/<?php echo $rework[0]['rework'] ?>" download>Download</a>

                                <?php }else{
                                    echo'<a class="btn btn-gray btn-sm" style="opacity: 0.5;pointer-events: none;" href="#" download>Download</a>';
                                }?>

                            </div>
                        </div>
                    </div>
                </div>
                <?php /*---Mou----*/?>
                <div class="row min-h">
                    <div class="col-sm-1">
                        <?php if(empty($ideations)){
                            echo' <div class="grey-circle"></div>';
                        } else if((!empty($ideations)) && $ideations[0]['b_status'] =='Completed' && !empty($feedback) && $feedback[0]['b_status'] !='Completed'){
                            echo' <div class="grey-circle"></div>';
                        }else if((!empty($ideations)) && $ideations[0]['b_status'] =='Completed' && !empty($feedback) && $feedback[0]['b_status'] =='Completed' && empty($rework)){
                            echo' <div class="grey-circle"></div>';
                        }
                        else if((!empty($ideations)) && $ideations[0]['b_status'] =='Completed' && !empty($feedback) && $feedback[0]['b_status'] =='Completed' && !empty($rework) && $rework[0]['b_status'] !='Completed'){
                            echo' <div class="grey-circle"></div>';
                        }else if((!empty($ideations)) && $ideations[0]['b_status'] =='Completed' && !empty($feedback) && $feedback[0]['b_status'] =='Completed' && !empty($rework) && $rework[0]['b_status'] =='Completed' && empty($mou)){
                            echo' <div class="grey-circle"></div>';
                        } else if((!empty($ideations)) && $ideations[0]['b_status'] =='Completed' && !empty($feedback) && $feedback[0]['b_status'] =='Completed' && !empty($rework) && $rework[0]['b_status'] =='Completed' && !empty($mou) && $mou[0]['b_status'] =='Completed'){
                            echo' <div class="circle"></div>';
                        }else{
                            echo' <div class="grey-circle"></div>';
                        }?>
                    </div>
                    <div class="col-sm-11"
                        <?php if(empty($ideations)){
                            echo'style="opacity: 0.5;pointer-events: none;"';
                        }else if((!empty($ideations)) && $ideations[0]['b_status'] =='Completed' && !empty($feedback) && $feedback[0]['b_status'] !='Completed'){
                            echo'style="opacity: 0.5;pointer-events: none;"';
                        }else if((!empty($ideations)) && $ideations[0]['b_status'] =='Completed' && !empty($feedback) && $feedback[0]['b_status'] =='Completed' && empty($rework)){
                            echo'style="opacity: 0.5;pointer-events: none;"';
                        }
                        else if((!empty($ideations)) && $ideations[0]['b_status'] =='Completed' && !empty($feedback) && $feedback[0]['b_status'] =='Completed' && !empty($rework) && $rework[0]['b_status'] !='Completed'){
                            echo'style="opacity: 0.5;pointer-events: none;"';
                        }
                        else if((!empty($ideations)) && $ideations[0]['b_status'] =='Completed' && !empty($feedback) && $feedback[0]['b_status'] =='Completed' && !empty($rework) && $rework[0]['b_status'] =='Completed'){
                            echo'';
                        }else{
                            echo'style="opacity: 0.5;pointer-events: none;"';
                        }?>>
                        <div class="row">
                            <div class="col-sm-7">
                                <label>MOU</label>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label>Date of Receipt</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="date" min="<?php echo $date1; ?>" value="<?php if(!empty($mou) && !empty($mou[0]['receipt_date'])){ echo date($mou[0]['receipt_date']);}?>"  name="receipt_date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <label>&nbsp;</label>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>Status</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="form-control"  name="mou_b_status">
                                            <option value="">Please Select</option>
                                            <option value="Pending" <?php if(!empty($mou) && !empty($mou[0]['b_status'])  && $mou[0]['b_status'] =='Pending'){  echo 'selected';}?>>On Hold </option>
                                            <option value="WIP" <?php if(!empty($mou) && !empty($mou[0]['b_status'])  && $mou[0]['b_status'] =='WIP'){ echo 'selected';}?>>Did Not Win</option>
                                            <option value="Completed" <?php if(!empty($mou[0]['b_status'] ) && $mou[0]['b_status'] =='Completed'){ echo 'selected';}?>>Win</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="upload-btn-wrapper">
                                    <button class="btn">Choose file</button>
                                    <input type="file" class="file3" name="mou_excel" id="mou_excel" />
                                    <span  class="col-sm-12 fileTextNm3" id="rework_excel" style="font-size: 12px;margin-bottom: 10px;padding-left: 0px;"><?php if(!empty($mou) && !empty($mou[0]['mou'])){ echo $mou[0]['mou'];}?> </span>

                                </div>
                            </div>
                            <div class="col-sm-1">
                                <label>Budget</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="number" value="<?php if(!empty($mou) && !empty($mou[0]['budget'])){ echo $mou[0]['budget'];}?>" min="0" class="form-control" name="mou_budget" id="mou_budget" />
                            </div>
                            <div class="col-sm-2">
                                <?php if(!empty($mou) && !empty($mou[0]['mou'])){ ?>
                                    <a class="btn btn-green btn-sm" href="<?php echo base_url()?>uploads/briefMou/<?php echo $mou[0]['mou'] ?>" download>Download</a>
                                <?php } else{
                                    echo'<a class="btn btn-gray btn-sm" style="opacity: 0.5;pointer-events: none;" href="#" download>Download</a>';
                                }?>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">

                            <a href="<?php echo base_url()?>project-development" class="btn btn-dark-gray btn-sm pull-right" style="margin-left: 10px; border-radius: 0px">Back</a>
                            <button class="btn btn-warning btn-sm pull-right">Save & Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo form_close();?>

<!--  Feedback Modal -->
<div class="modal fade " id="suggested" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content gray-modal">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel"></h4>

                <div class="row">
                    <?php  echo form_open_multipart(base_url().'projectDevelopmentFeedback/'.$brief_id,array('method'=>'post', 'name'=>'add_briefModule','id'=>'add_briefModule','class'=>'','autocomplete'=>'off'));?>
                    <div class="col-sm-6 col-sm-offset-3 div-show">
                        <label class="text-center d-block mt-30">Add Feedback</label>
                        <div class="form-group">
                            <textarea class="form-control" rows="4" name="feedback"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-green pull-right" type="submit">Submit</button>
                        </div>

                    </div>
                    <div class="col-sm-6 col-sm-offset-3 div-hide" style="display:none">
                        <div class="form-group">

                        </div>
                        <label class="d-block mt-30"> <a class="btn btn-warning" id="add-new">Add New</a></label>
                        <label class="d-block mt-30 text-center ">Feedback</label>
                        <div class="form-group">
                            <div class="feedback-hide" style="
                              padding: 6px 12px;
                                background-color: #fff;
                                    background-image: none;
    border: 1px solid #ccc;
    min-height: 120px;
    border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;"></div>
                        </div>


                    </div>
                    <?php echo form_close();?>
                </div>
                <div class="row custom-table">
                    <div class="col-sm-12">
                        <div class="scroll-table">
                            <table class="table table-responsive table-bordered mb-20 table-top-orange">
                                <tr>
                                    <td>Feedback</td>
                                    <td>Submitted on</td>
                                    <td>State</td>
                                    <td>Zone</td>
                                    <td>Brand</td>
                                    <td>Status</td>
                                </tr>
                                <?php foreach ($feedbacks as $feedback) {?>
                                    <tr>
                                        <td><a class="link" href="#" data-rel="<?php echo $feedback['feedback']?>"><?php echo word_limiter($feedback['feedback'],3)?></a></td>
                                        <td><?php echo date('d-m-Y',strtotime($feedback['submited_on']))?></td>
                                        <td><?php if(!empty($state[0]['title'])) echo $state[0]['title'];else echo 'N/A';?></td>
                                        <td><?php if(!empty($zone[0]['title'])) echo $zone[0]['title'];else echo 'N/A';?></td>
                                        <td><?php if(!empty($brands[0]['title']))  echo $brands[0]['title'];else echo 'N/A';?></td>
                                        <td><?php echo $feedback['b_status']?></td>
                                    </tr>
                                <?php }?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".link").click(function(e) {
        e.preventDefault();
        var feedback = $(this).data('rel');
        $(".feedback-hide").html(feedback);
        $(".div-hide").show();
        $(".div-show").hide();
    });
    $(".close").click(function(e) {
        e.preventDefault();
        $(".feedback-hide").html();
        $(".div-show").show();
        $(".div-hide").hide();
    });
    $("#add-new").click(function(e) {
        e.preventDefault();
        $(".feedback-hide").html();
        $(".div-show").show();
        $(".div-hide").hide();
    });

</script>


