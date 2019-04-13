<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-sm-6">
                    <h2>Need Assessment</h2>
                </div>
                <div class="col-sm-6">
                    <div style="text-align:right">
                        <a href="<?php echo base_url();?>admin/settings" class="btn bg-orange">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <ol class="breadcrumb bc-3">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="entypo-home"></i>Home</a></li>
            <li><a href="<?php echo base_url();?>admin/settings">Location Settings</a></li>
            <li class="active"><strong>Need Assessment</strong></li>
        </ol>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php echo $this->session->flashdata('msg');?>
                <div class="panel panel-default" data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title ">Upload Need Assessment Excel</div>
                    </div>
                    <div class="panel-body">
                                <div class="bgcolor-1"><!-- bgcolor-1 -->

									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
                                                <label for="total" class="col-md-12">Thematic Areas</label>
                                                <div class="form-line col-md-12">
                                                    <select class="form-control" name="thematic_area" id="thematic_area_drop">
                                                        <option>--Select--</option>
                                                        <?php foreach ($thematic_area as $area) {?>
                                                            <option value="<?php echo $area['id']?>"><?php echo $area['name']?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                            <br />
                                            <br />
                                            <div class="form-group" style="padding-top:25px;">
												<div class="form-line col-md-3">
                                                    <input id="keyPerformanceDataInput" type="file" name="xls_files" accept=".xlsx, .xls, .csv" style="display: none;" />
                                                    <input style="width:100%" class="btn btn-blue" id="uploadKeyPerformanceData" type="submit" value="Upload Key Performance Data" />
												</div>
                                                <div class="form-line col-md-3">
                                                    <input id="keyDistributionDataInput" type="file" name="xls_files" accept=".xlsx, .xls, .csv" style="display: none;" />
                                                    <input style="width:100%" class="btn btn-blue" id="uploadKeyDistributionData" type="submit" value="Upload Distribution Data" />
												</div>
                                                
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
<script>
$(document).ready(function(){
    var thematicAreaId;
    $('#thematic_area_drop').on('change', function(event){
        event.preventDefault();
        thematicAreaId = $(this).val();
        
    });

    $("#keyPerformanceDataInput").on("change paste keyup", function (event) {
        event.preventDefault();
        var formData = new FormData();
        formData.append("files", $(this).get(0).files[0]);
        $.ajax({
            url: "<?php echo site_url("admin/bulkUploadKeyPerformanceData"); ?>",
            method: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
                response = JSON.parse(data);
                console.log(response);
                if(response.status){
                    alert('Upload Successful..');
                    location.reload();
                }else{
                    console.log(location.msg);
                }
            }
        });
    });

    $('#uploadKeyPerformanceData').on('click', function(event){
        event.preventDefault();
        $('#keyPerformanceDataInput').trigger('click');
        
    });

    $("#keyDistributionDataInput").on("change paste keyup", function (event) {
        event.preventDefault();
        var formData = new FormData();
        
        formData.append("thematicAreaId", thematicAreaId);
        formData.append("files", $(this).get(0).files[0]);
        $.ajax({
            url: "<?php echo site_url("admin/bulkUploadKeyDistributionData"); ?>",
            method: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
                response = JSON.parse(data);
                console.log(response);
                if(response.status){
                    alert('Upload Successful..');
                    location.reload();
                }else{
                    console.log(location.msg);
                }
            }
        });

    });
    $('#uploadKeyDistributionData').on('click', function(event){
        event.preventDefault();
        if(thematicAreaId !== undefined){
            $('#keyDistributionDataInput').trigger('click');
        }else{
            alert('Please select Thematic Area ...');
        }

    });

	
});
</script>