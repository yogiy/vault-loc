<?php
$permissions = $this->session->userdata('permissions');
$plnSess = $this->session->userdata('pAplnSess');
?>
<div class="col-md-9 col-sm-6 col-xs-12">
    <div class="form-section ">
        <?php echo form_open_multipart(base_url().'searchProjectAssessment',array('method'=>'post', 'name'=>'searchPlanning','id'=>'searchPlanning','class'=>'','autocomplete'=>'off'));?>
        <div class="row">
            <div class="col-sm-4 col-sm-offset-2">
                <div class="row">
                    <div class="col-sm-5">
                        <label>PDID</label>
                    </div>
                    <div class="col-sm-7">
                        <div class="form-group">
                            <input type="text" name="pdid" value="<?php echo $this->session->userdata('pApdid');?>" class="form-control search"/>
                        </div>
                    </div>
                </div>
                <?php  if($this->session->userdata('role') == '6'){?>
                <div class="row">
                    <div class="col-sm-5">
                        <label>Client Name</label>
                    </div>
                    <div class="col-sm-7">
                        <div class="form-group">
                            <select name="client_id" class="form-control search">
                                <option value="">-Select-</option>
                                <?php foreach($clients as $client) {?>
                                    <option value="<?php echo $client['user_id'];?>" <?php if($this->session->userdata('pAclient_id')==$client['user_id']){ echo "selected=selected";}?>><?php echo ucwords($client['fname'].' '.$client['lname']);?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="row">
                    <div class="col-sm-5">
                        <label>Brand Name</label>
                    </div>
                    <div class="col-sm-7">
                        <div class="form-group">
                            <select name="brand_id" class="form-control search">
                                <option value="">-Select-</option>
                                <?php foreach($brands as $brand) {?>
                                    <option value="<?php echo $brand['brand_id'];?>" <?php if($this->session->userdata('pAbrand_id')==$brand['brand_id']){ echo "selected=selected";}?>><?php echo $brand['title'];?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-sm-5">
                        <label>Zone</label>
                    </div>
                    <div class="col-sm-7">
                        <div class="form-group">
                            <select name="zone_id" class="form-control search">
                                <option value="">-Select-</option>
                                <?php foreach($zones as $zone) {?>
                                    <option value="<?php echo $zone['zone_id'];?>" <?php if($this->session->userdata('pAzone_id')==$zone['zone_id']){ echo "selected=selected";}?>><?php echo $zone['title'];?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <label>City/State</label>
                    </div>
                    <div class="col-sm-7">
                        <div class="form-group">
                            <select name="state_id" class="form-control search">
                                <option value="">-Select-</option>
                                <?php foreach($states as $state) {?>
                                    <option value="<?php echo $state['state_id'];?>" <?php if($this->session->userdata('pAstate_id')==$state['state_id']){ echo "selected=selected";}?>><?php echo $state['title'];?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <label>Status</label>
                    </div>
                    <div class="col-sm-7">
                        <div class="form-group">
                            <select name="status" class="form-control search">
                                <option value="">-Select-</option>
                                <option value="Pending" <?php if($this->session->userdata('pAstatus')=='Pending'){ echo "selected=selected";}?>>Pending </option>
                                <option value="WIP" <?php if($this->session->userdata('pAstatus')=='WIP'){ echo "selected=selected";}?>>Did Not Win</option>
                                <option value="Completed" <?php if($this->session->userdata('pAstatus')=='Completed'){ echo "selected=selected";}?>>Win</option>
                            </select>
                        </div>
                        <div class="form-group  pull-right">
                            <button type="submit" class="btn btn-warning btn-sm">Search</button>
                            <?php if(!empty($plnSess)){ ?><button type="button" class="btn btn-dark-gray btn-sm" onclick="window.location='<?php echo base_url();?>unsetProjectAssessment'">Reset</button><?php }?>

                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close();?>

            <?php if(!empty($plnSess)){ ?>
                <div class="row custom-table">
                    <div class="col-sm-12">
                        <div class="scroll-table">
                            <table class="table table-responsive table-bordered">
                                <tr>
                                    <td>Sr. no.</td>
                                    <td>PDID</td>
                                    <td>Brief Date</td>
                                    <td>Metro</td>
									<td>Tier 1</td>
									<td>Tier 2</td>
									<td>Tier 3</td>
									<td>Tier 4</td>
                                    <td>Servicing</td>
                                    <td>Brand</td>
                                    <td>Status</td>
									<td></td>
                                </tr>
                                <?php 
									$i=0;
									if(!empty($plannings)){
									foreach($plannings as $planning)
									{ 
										++$i;
										$brandNm = $this->Front_model->getData('m_brands', 'brand_id', $planning['brand_id']);
										$clientNm = $this->Front_model->getData('users', 'user_id', $planning['client_id']);
										
										/***********************************Metro******************************************/
										$metroIds = explode(',', $planning['metro_id']);
										unset($stateM1);
										foreach($metroIds as $metro_id)
										{
											$marketNm = $this->Front_model->getData('m_market', 'market_id', $metro_id);
											if(!empty($marketNm[0]['state']))
											{
												$stateNm = $this->Front_model->getData('states', 'state_id', @$marketNm[0]['state']);
												$stateM1[] = $stateNm[0]['title'];
											} else { $stateM1[] = '';}
										}
										$stateM = implode(', ', array_unique($stateM1));
										/***********************************End******************************************/
										/***********************************Tear 1******************************************/
										$t1Ids = explode(',', $planning['tier1_id']);
										unset($t1M1);
										foreach($t1Ids as $t1)
										{
											$marketNm = $this->Front_model->getData('m_market', 'market_id', $t1);
											if(!empty($marketNm[0]['state']))
											{
												$stateNm = $this->Front_model->getData('states', 'state_id', @$marketNm[0]['state']);
												$t1M1[] = $stateNm[0]['title'];
											} else { $t1M1[] = '';}
										}
										$stateT1 = implode(', ', array_unique($t1M1));
										/***********************************End******************************************/
										/***********************************Tear 2******************************************/
										$t2Ids = explode(',', $planning['tier2_id']);
										unset($t2M1);
										foreach($t2Ids as $t2)
										{
											$marketNm = $this->Front_model->getData('m_market', 'market_id', $t2);
											if(!empty($marketNm[0]['state']))
											{
												$stateNm = $this->Front_model->getData('states', 'state_id', @$marketNm[0]['state']);
												$t2M1[] = $stateNm[0]['title'];
											} else { $t2M1[] = '';}
										}
										$stateT2 = implode(', ', array_unique($t2M1));
										/***********************************End******************************************/
										/***********************************Tear 3******************************************/
										$t3Ids = explode(',', $planning['tier3_id']);
										unset($t3M1);
										foreach($t3Ids as $t3)
										{
											$marketNm = $this->Front_model->getData('m_market', 'market_id', $t3);
											if(!empty($marketNm[0]['state']))
											{
												$stateNm = $this->Front_model->getData('states', 'state_id', @$marketNm[0]['state']);
												$t3M1[] = $stateNm[0]['title'];
											} else { $t3M1[] = '';}
										}
										$stateT3 = implode(', ', array_unique($t3M1));
										/***********************************End******************************************/
										/***********************************Tear 4******************************************/
										$t4Ids = explode(',', $planning['tier4_id']);
										unset($t4M1);
										foreach($t4Ids as $t4)
										{
											$marketNm = $this->Front_model->getData('m_market', 'market_id', $t4);
											if(!empty($marketNm[0]['state']))
											{
												$stateNm = $this->Front_model->getData('states', 'state_id', @$marketNm[0]['state']);
												$t4M1[] = $stateNm[0]['title'];
											} else { $t4M1[] = '';}
										}
										$stateT4 = implode(', ', array_unique($t4M1));
										/***********************************End******************************************/
										
										$reworkDet = $this->Front_model->getDataLast1('brief_rework', 'brief_module_id', $planning['brief_module_id']);
										if(count($reworkDet)>0)
										{$download = base_url()."uploads/briefRework/".$reworkDet[0]['rework'];} 
										else 
										{ $download = base_url()."uploads/briefModule/".$planning['filename']; }
								?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $planning['brief_module_id'];?></td>
                                            <td nowrap><?php echo date('d-m-Y', strtotime($planning['created_at']));?></td>
                                            <td title="<?php echo $stateM;?>"><?php echo count(array_filter(array_unique($stateM1)));?></td>
											<td title="<?php echo $stateT1;?>"><?php echo count(array_filter(array_unique($t1M1)));?></td>
											<td title="<?php echo $stateT2;?>"><?php echo count(array_filter(array_unique($t2M1)));?></td>
											<td title="<?php echo $stateT3;?>"><?php echo count(array_filter(array_unique($t3M1)));?></td>
											<td title="<?php echo $stateT4;?>"><?php echo count(array_filter(array_unique($t4M1)));?></td>
                                            <td>
                                                <?php
                                                $userIds = explode(',', $planning['assisted_by_id']);
                                                foreach($userIds as $user)
                                                {
                                                    $userDta = $this->Front_model->getData('users', 'user_id', $user);
                                                    ?>
                                                    <span class="tag-blue"><?php echo @ucwords($userDta[0]['fname'].' '.$userDta[0]['lname']);?></span>
                                                <?php } ?>
                                            </td>
                                            <td nowrap><?php echo $brandNm[0]['title'];?></td>
                                            <td><?php echo $planning['b_status']; ?></td>
                                            <td><a href="<?php echo base_url();?>project-assessment/<?php echo $planning['brief_module_id'];?>" class="btn btn-orange btn-xs">Open</a></td>

                                        </tr>
                                    <?php } }else {?>
                                    <tr>
                                        <td colspan="9" class="text-center">No Record Found</td>
                                    </tr>
                                <?php }?>
                            </table>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
