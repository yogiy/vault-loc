<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-sm-6">
                    <h2>CSR OverView (Excel Import)</h2>
                </div>
                <div class="col-sm-6">
                    <div style="text-align:right">
                        <a href="<?php echo base_url();?>admin/settings/csroverview/display" class="btn bg-orange">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <ol class="breadcrumb bc-3">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="entypo-home"></i>Home</a></li>
            <li><a href="<?php echo base_url();?>admin/settings">Location Settings</a></li>
            <li><a href="<?php echo base_url();?>admin/settings/csroverview/display">CSR Overview</a></li>
            <li class="active"><strong> Thematic Area Spend Import</strong></li>

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
                            <div class="col-md-12">
                                <div class="col-sm-offset-4 col-sm-3">
                                    <div class="form-group">
                                        <label for="file_upload">File Upload</label>
                                        <input type="file" accept=".xlsx, .xls, .csv" class="form-control" id="uploadFile" name="uploadFile"  value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-sm-offset-4 col-sm-3">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" id="submitFile" name="submit">
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
<script>
$(document).ready(function(){

var fileToUpload;
    $("#uploadFile").on("change paste keyup", function (event) {
        event.preventDefault();
        fileToUpload = $(this).get(0).files[0];

    });


	$('#submitFile').on('click', function(event){
        event.preventDefault();
        if(fileToUpload !== undefined){
            var formData = new FormData();
            formData.append("files", fileToUpload);
            $.ajax({
                url: '<?php echo site_url("admin/bulkUploadCSROverview"); ?>',
                method: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(res){
                    response = JSON.parse(res);
                    // console.log(response);
                    if(response.status){
                        alert('Upload Successful..');
                        location.reload();
                    }else{
                        console.log(location.msg);
                    }
                }
            });
        }
        
    });
});
</script>