<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-sm-6">
                    <h2>NGOs List</h2>
                </div>
                <div class="col-sm-6">
                    <div style="text-align:right">
                        <a href="<?php echo base_url();?>admin/settings" class="btn bg-orange">Back</a>
                        <a href="<?php echo base_url();?>admin/bulkUploadNGO" class="btn bg-primary">Excel Import</a>
                        <a href="<?php echo base_url();?>admin/settings/ngo/add" class="btn btn-blue" >Add new</a> &nbsp;
                    </div>
                </div>
            </div>
        </div>
        <ol class="breadcrumb bc-3">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="entypo-home"></i>Home</a></li>
            <li><a href="<?php echo base_url();?>admin/settings">Admin Settings</a></li>
            <li class="active"><strong>NGOs List</strong></li>
        </ol>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php echo $this->session->flashdata('msg');?>
                <div class="panel panel-default" data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title "></div>
                    </div>
                    <div class="card">
                        <div class="body">
                            <div class="clearfix">
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover dataTable table-striped"  id="table-2"  data-page-length="50">
                                            <thead>
                                            <tr>
                                                <th style="text-align:center;border-left: 1px solid #ebebeb;">S.No.</th>
                                                <th>Title</th>
												<th>Sectors</th>
												<th nowrap>Type of NGO</th>
												<th>Address</th>
												<th>Email Id</th>
												<th style="text-align:center;" class="no-sorting">Status</th>
                                                <th class="no-sorting" style="text-align:center;border-right: 1px solid #ebebeb !important;">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
												if($count > 0) 
												{
													$j=0;
													for($i=0; $i<$count; $i++) 
													{
														$j++;
														$sectors = $this->Crud_model->getDataIn('m_sectors', 'sector_id', $results[$i]['sector_id']);
														
                                            ?>
                                                    <tr>
                                                        <td style="text-align:center;border-left: 1px solid #ebebeb;"><?php echo $j;?></td>
                                                        <td><?php echo $results[$i]['title'];?></td>
														<td class="sectorsPad"><?php foreach($sectors as $sector){?><span><?php echo $sector['title'];?></span><?php }?></td>
														<td><?php echo $results[$i]['ngo_type'];?></td>
														<td><?php echo $results[$i]['address'];?></td>
														<td><?php echo $results[$i]['email'];?></td>
														<td style="text-align:center;">
                                                            <?php if($results[$i]['status']=='Active'){ ?>
                                                                <a href="<?php echo base_url();?>admin/settings/ngo/<?php echo $results[$i]['ngo_id'];?>/Deactive" title="Click for Deactive" onclick="return action('deactive');">
                                                                    <i class="fa fa-toggle-on" aria-hidden="true" style="color:green; font-size:18px;"></i>
                                                                </a>
                                                            <?php } else { ?>
                                                                <a href="<?php echo base_url();?>admin/settings/ngo/<?php echo $results[$i]['ngo_id'];?>/Active" title="Click for Active" onclick="return action('active');">
                                                                    <i class="fa fa-toggle-off" aria-hidden="true" style="color:green; font-size:18px;"></i>
                                                                </a>
                                                            <?php } ?>
                                                        </td>
                                                        <td style="text-align:center;border-right: 1px solid #ebebeb !important;">
                                                            <a  href="<?php echo base_url();?>admin/settings/ngo/edit/<?php echo $results[$i]['ngo_id'];?>" class="actionP">
                                                                <i class="fa fa-pencil-square-o"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php }} ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>