<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title;?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/dist/css/bootstrap.min.css">

    <link rel="icon" href="<?php echo base_url();?>assets/admin/dist/images/favicon.jpeg" type="image/x-icon">
    
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet"> 

    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/404.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="<?php echo base_url();?>assets/admin/dist/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(window).scroll(function(){
            var sticky = $('.sticky'),
            scroll = $(window).scrollTop();

            if (scroll >= 70) sticky.addClass('fixed');
            else sticky.removeClass('fixed');
        });
    </script>
    <script type = "text/javascript">  
        $(document).ready(function(){
            $('.popup').delay(2000).fadeIn('slow');
        });
    </script>
    

</head>
<body class="vendor_profilebody">
<div class="about404 error404">
    <div class="container">
        <div class="row">
            <div class="banner-content">
                <div id="header"> </div>
                
            </div>
        </div>
    </div>
</div>
<section class="error-body">
    <div class="container text-center">
        <div class="error-text">
            <h1>SOMETHIMG WENT WRONG!</h1>
            <div class="next1">
                <div class="head404">404</div>
                <h3 id="subheading">Sorry, the page not found!</h3>
                <!--<img src="<?php echo base_url();?>assets/admin/dist/images/cartoon.png" alt="">
                <ul class="social-error">
                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                </ul> -->
                <div class="404_btn"><button onclick='window.location.href="<?php echo base_url();?>"'>BACK TO HOME PAGE</button></div>
            </div>
        </div>
    </div>
</section>


</body>
</html>
