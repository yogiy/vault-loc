<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-sm-6">
                    <h2>Customer Status</h2>
                </div>
                <div class="col-sm-6">
                    <div style="text-align:right">
                        <a href="<?php echo base_url();?>settingss/cost-center/display" class="btn bg-orange">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <ol class="breadcrumb bc-3">
            <li>
                <a href="<?php echo base_url();?>dashboard"><i class="entypo-home"></i>Home</a>
            </li>
            <li>
                <a href="<?php echo base_url();?>settingss">settingss</a>
            </li>
            <li class="active">
                <strong>Customer Status</strong>
            </li>
        </ol>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <?php echo $this->session->flashdata('msg');?>
                    <div class="body">
                        <?php echo form_open_multipart(base_url().'settings/performanceReason/update',array('method'=>'post', 'name'=>'add_cost_center','id'=>'add_common','class'=>'form-horizontal form-groups-bordered','autocomplete'=>'off'));?>
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <div class="panel panel-default" data-collapsed="0">

                            <div class="panel-heading">
                                <div class="panel-title ">
                                    Update Customer Status
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="bgcolor-1">
                                    <div class="row clearfix">
                                        <div class="col-sm-12">
											<div class="form-group">
												<label for="total" class="col-md-12">Title</label>
												<div class="form-line col-md-12">
													<input type="text" name="title" class="form-control" value="<?php echo $data['title'];?>" placeholder="Title">
												</div>
											</div>
										</div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-sm-12">
                                            <div class="button-demo">
                                                <input type="submit" id="submit_form" class="btn btn-blue btn-md waves-effect" value="Save">
                                                <a href="<?php echo base_url();?>settingss/performanceReason/display" class="btn btn-md bg-orange waves-effect">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close();?>
                    </div>
                </div>
            </div>
        </div>
</section>