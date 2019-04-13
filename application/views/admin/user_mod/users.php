<?php
$page=$this->uri->segment(1);
$role = $this->session->userdata('role');
?>

<section class="content">
    <div class="container-fluid">
                    <div class="block-header">
                <div class="row clearfix">
                    <div class="col-sm-6">
                        <h2>Users</h2>
                    </div>
                    <div class="col-sm-6">
                        <div style="text-align:right">
							<a href="<?php echo base_url();?>masters" class="btn bg-orange">Back</a>
							<a href="<?php echo base_url();?>users/add" class="btn btn-blue" >Add new</a>
                        </div>
                    </div>
                </div>
            </div>
            <ol class="breadcrumb bc-3">
                <li>
                    <a href="<?php echo base_url();?>dashboard"><i class="entypo-home"></i>Home</a>
                </li>
                <li class="active">
                    <strong>Users</strong>
                </li>
            </ol>

        <!-- Large Size -->

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php echo $this->session->flashdata('msg');?>
                <div class="panel panel-default" data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title "></div>
                    </div>
					<div class="card">
                        <div class="body">
							<!-- Exportable Table -->
							<div class="clearfix">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="table-responsive">
										<table class="table table-bordered table-hover dataTable table-striped"  id="table-4"  data-page-length="20">
											<thead>
											<tr>
												<th class="no-sorting">S.No</th>
												<th class="sorting_asc">Name</th>
												<th class="no-sorting">Email</th>
												<th class="no-sorting">Role</th>
												<th class="no-sorting">Last Login</th>
												<th class="no-sorting">Create date</th>
												<th class="no-sorting">Status</th>
												<th class="no-sorting">Actions</th>
											</tr>
											</thead>
											<tbody>
											<?php
												if($count>0)
												{
													$j=0;
													$quoteTot=0;
													for($i=0;$i<$count;$i++)
													{
														$j++;
											?>
											<tr>
												<td style="text-align:center;border-left: 1px solid #ebebeb;"><?php echo $j;?></td>
												<td><?php echo ucwords($results[$i]['fname'].' '.$results[$i]['lname']);?></td>
												<td><?php echo $results[$i]['email'];?></td>
												<td><?php if($results[$i]['role'] =='2')echo "Employee"; else echo "Admin";?></td>

												<td><?php if($results[$i]['last_login'] != '0000-00-00 00:00:00'){ echo date('d-M-y h:i A', strtotime($results[$i]['last_login']));} else { echo "--";}?></td>

												<td><?php if($results[$i]['creation_date'] != '0000-00-00 00:00:00'){ echo date('d-M-y h:i A', strtotime($results[$i]['creation_date']));} else { echo "--";}?></td>

												<td>
													<?php if($results[$i]['status']=='Active'){?>
														<a href="<?php echo base_url();?>users/<?php echo $results[$i]['id'];?>/Deactive" title="Click for deactivate" onclick="return action('deactive');">
															<i class="fa fa-toggle-on" aria-hidden="true" style="color:green; font-size:18px;"></i>
														</a>
													<?php } else { ?>
														<a href="<?php echo base_url();?>users/<?php echo $results[$i]['id'];?>/Active" title="Click for activate" onclick="return action('active');">
															<i class="fa fa-toggle-off" aria-hidden="true" style="color:green; font-size:18px;"></i>
														</a>
													<?php }?>
												</td>
												<!--===========Action=================-->

												<td style="text-align:center;border-right: 1px solid #ebebeb !important;">
													<a  href="<?php echo base_url();?>users/edit/<?php echo $results[$i]['id'];?>" class="actionP">
																<i class="fa fa-pencil-square-o"></i>
													</a>
												</td>
												<?php }} ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- #END# Exportable Table -->
						</div> <!-- body end -->
					</div> <!-- card end -->
				</div>
            </div> <!-- col end -->
        </div> <!-- row end -->
    </div> <!-- container-fluid end -->
</section>