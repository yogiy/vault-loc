<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-sm-6">
                    <h2>CSR Overview</h2>
                </div>
                <div class="col-sm-6">
                    <div style="text-align:right">
                        <a href="<?php echo base_url();?>admin/settings" class="btn bg-orange">Back</a>
                        <a href="<?php echo base_url();?>admin/settings/csroverview/bulkUpload" class="btn bg-primary">Thematic Area Spend Import</a>
                        <a href="<?php echo base_url();?>admin/settings/csroverview/edit" class="btn btn-blue" >Update CSR Projects Count</a> &nbsp;
                    </div>
                </div>
            </div>
        </div>
        <ol class="breadcrumb bc-3">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="entypo-home"></i>Home</a></li>
            <li><a href="<?php echo base_url();?>admin/settings">Location Settings</a></li>
            <li class="active"><strong>CSR Overview</strong></li>
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
                                                <th>Fiscal Year</th>
												<th>Education & Skill Development</th>
												<th>Healthcare</th>
												<th>Rural Development</th>
												<th>Environment</th>
												<th>Art & Culture</th>
												<th>Women Empowerment</th>
												<th>Relief Funds</th>
												<th>Armed Forces</th>
												<th>Technology</th>
												<th>Urban Slum</th>
												<th>Other</th>
												<th>Sports</th>
												<th>Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
												if($count > 0) 
												{
													
													for($i=0; $i<$count; $i++) 
													{
														
														
                                            ?>
                                                    <tr>
                                                        <td><?php echo $results[$i]['fy_year'];?></td>
														<td><?php echo $results[$i]['thematic_area_spend_1'];?></td>
														<td><?php echo $results[$i]['thematic_area_spend_2'];?></td>
														<td><?php echo $results[$i]['thematic_area_spend_3'];?></td>
														<td><?php echo $results[$i]['thematic_area_spend_4'];?></td>
														<td><?php echo $results[$i]['thematic_area_spend_5'];?></td>
														<td><?php echo $results[$i]['thematic_area_spend_6'];?></td>
														<td><?php echo $results[$i]['thematic_area_spend_7'];?></td>
														<td><?php echo $results[$i]['thematic_area_spend_8'];?></td>
														<td><?php echo $results[$i]['thematic_area_spend_9'];?></td>
														<td><?php echo $results[$i]['thematic_area_spend_10'];?></td>
														<td><?php echo $results[$i]['thematic_area_spend_11'];?></td>
														<td><?php echo $results[$i]['thematic_area_spend_12'];?></td>
														<td><?php echo $results[$i]['total_spend'];?></td>
														
                                                        
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
<style>
.sectorsPad span {
    padding: 2px 6px;
    margin: 2px 0px;
    background-color: rgba(57, 190, 200, 0.44);
    border-radius: 3px;
    display: block;
    white-space: nowrap;
}
</style>