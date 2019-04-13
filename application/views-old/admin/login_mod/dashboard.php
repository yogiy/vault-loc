<?php

?>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-sm-6">
                    <h2>Dashboard</h2>
                </div>
            </div>
        </div>
        <ol class="breadcrumb bc-3">
            <li>
                <a href="<?php echo base_url();?>dashboard"><i class="entypo-home"></i>Home</a>
            </li>
            <li class="active">Dashboard</a>
            </li>

        </ol>
        <div class="row clearfix">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <div class="blue-class">
                            <p>Total Clients</p>
                       <h2><?php echo $clients;?></h2>
                    </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="orange-class">
                            <p>Total Employees</p>
                       <h2><?php echo $employees;?></h2>
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                       <div class="blue-class">
                        <p>Total Markets</p>
                       <h2><?php echo $markets;?></h2>
                    </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="orange-class">
                            <p>Total Thematic Areas</p>
                       <h2><?php echo $themeticAreas;?></h2>
                        </div>
                    </div>
                </div>
                <div class="mb-3"></div>
                <div class="row">
                    <div class="col-md-3 text-center">
                        <div class="orange-class">
                            <p>Total NGOS</p>
                       <h2><?php echo $ngos;?></h2>
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="blue-class">
                            <p>Total Case Studies</p>
                       <h2><?php echo $caseStudies;?></h2>
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="orange-class">
                            <p>Total Storage Space</p>
                       <h2><?php echo $rest_storage_space;?></h2>
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="blue-class">
                            <p>Total New NGO -ADD NOTIFICATION</p>
                       <h2><?php echo $new_ngos;?></h2>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</section>