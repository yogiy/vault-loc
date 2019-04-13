<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-sm-6">
                    <h2>Market (Excel Import)</h2>
                </div>
                <div class="col-sm-6">
                    <div style="text-align:right">
                        <a href="<?php echo base_url();?>admin/settings/markets/display" class="btn bg-orange">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <ol class="breadcrumb bc-3">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="entypo-home"></i>Home</a></li>
            <li><a href="<?php echo base_url();?>admin/settings">Admin Settings</a></li>
            <li><a href="<?php echo base_url();?>admin/settings/markets/display">Market List</a></li>
            <li class="active"><strong> Excel Import</strong></li>

        </ol>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php echo $this->session->flashdata('msg');?>
                <div class="panel panel-default" data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title "></div>
                    </div>
                    <div class="panel-body">
                        <div class="clearfix">
                            <?php echo form_open_multipart(base_url().'admin/bulkUploadMarketStore',array('method'=>'post', 'name'=>'add_common','id'=>'add_common','class'=>'form-horizontal form-groups-bordered','autocomplete'=>'off'));?>
                            <div class="col-md-12">
                                <div class="col-sm-offset-4 col-sm-3">
                                    <div class="form-group">
                                        <label for="file_upload">File Upload</label>
                                        <input type="file" class="form-control" id="uploadFile" name="uploadFile"  value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-sm-offset-4 col-sm-3">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" id="submit" name="submit">
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close();?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
