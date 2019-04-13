<?php
$admin_id = $this->session->userdata('admin_id');
$user = $this->Crud_model->getData('admins','admin_id',$admin_id);
$usrName = ucwords($user[0]['fname'].' '. $user[0]['lname']);
$email = $user[0]['email'];
$role = $user[0]['role_id'];

$page = $this->uri->segment(1);
$reprtNm = $this->uri->segment(2);
$lst = $this->uri->segment(3);


if($lst !='users')
{
    if($reprtNm !='add')
    {
        $this->session->unset_userdata('fnameAF');
        $this->session->unset_userdata('lnameAF');
        $this->session->unset_userdata('emailAF');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $title;?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Finance Admin Panel" />
    <meta name="author" content=""/>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/font-icons/entypo/css/entypo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/neon-core.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/neon-theme.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/neon-forms.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/js/datatables/datatables.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/js/select2/select2-bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/js/select2/select2.css">
    <script src="<?php echo base_url();?>assets/admin/js/jquery-1.11.3.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/datatables/datatables.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/moment.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/select2/select2.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/validation/jquery.validate.js"></script>
    <script src="<?php echo base_url();?>assets/admin/validation/validate.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/demo.js"></script>
</head>
<body class="page-body">
<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
    
