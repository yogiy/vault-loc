<?php $role = $this->session->userdata('role');?>
<style>
    .card{width:100%; float:left;}
    .card .body ul{margin:0 0 15px; padding:0;text-align:center;width:100%;float:left;}
    .card .body ul li{margin:10px; padding:10px;display:inline-block; list-style:none; width:22.7%; float:left; min-height:50px; border:1px solid #ccc;text-align:center;line-height:50px; box-shadow: 0 0 5px #afc4dc;}
</style>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-sm-6"><h2>Change Password</h2></div>
                <div class="col-sm-6">
                     </div>
            </div>
        </div>
        <ol class="breadcrumb bc-3">
            <li><a href="<?php echo base_url();?>dashboard"><i class="entypo-home"></i>Home</a></li>
            <li class="active"><strong>Change Password</strong></li>
        </ol>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default" data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title ">
                            Change password
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open_multipart(base_url().'admin/password/update',array('name'=>'change_password','id'=>'change_password','class'=>'form-horizontal form-groups-bordered','autocomplete'=>'off'));?>
                        <input type="hidden" name="id" value="<?php echo $this->session->userdata('user_id');?>">
                        <?php echo $this->session->flashdata('msg');?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="total" class="col-sm-2 control-label">Existing password <span class="mendatory">*</span></label>
                                    <div class="form-line   col-md-10">  <input class="form-line form-control" type="password" name="opass" id="opass" required placeholder="Existing password">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="total" class="col-sm-2 control-label">New password <span class="mendatory">*</span></label>
                                    <div class="form-line   col-md-10">  <input class="form-line form-control" type="password" name="npass" id="npass" required placeholder="New password">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="total" class="col-sm-2 control-label">Confirm new password <span class="mendatory">*</span> </label>
                                    <div class="form-line   col-md-10"> <input class="form-line form-control" type="password" name="cnpass" id="cnpass" required placeholder="Confirm new password">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-offset-2 col-sm-9 button-demo ">
                                <input type="submit" id="submit_form" class="btn btn-blue btn-md waves-effect" value="Save">
                                <a href="<?php echo base_url();?>admin/dashboard" class="btn btn-md btn-white waves-effect">Cancel</a>
                            </div>
                        </div>
                        <?php echo form_close();?>
                    </div> <!-- body end -->
                </div> <!-- card end -->
            </div> <!-- col end -->
        </div> <!-- row end -->
    </div> <!-- container-fluid end -->
</section>