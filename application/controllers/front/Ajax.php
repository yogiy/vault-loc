<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ajax extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('front/Front_model');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('security');
        $this->load->helper('cookie');
        $this->load->library('pagination');
        $this->load->library('email');
        $this->load->library('user_agent');
    }


    public function viewBriefPopup() {
        $theme_id 		= $_REQUEST['val'];
        $themeDet 		= $this->Front_model->getData('thematic_areas', 'thematic_area_id', $theme_id);
        $caseStudies 	= $this->Front_model->getData('m_archieves', 'thematic_area_id', $themeDet[0]['parent']);
        echo '
		<script>
			$(document).ready(function(){
				$(".close").click(function () { $("#popUp").hide(); });	
			});
		</script>';

        echo '
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title text-center" id="myModalLabel"><label>Suggested Case Study</label></h4>
						<div class="row">';
        $i=0;
        foreach($caseStudies as $caseStudy)
        {
            ++$i;
            if($caseStudy['type']=='Image')
            { $imgType ='<img src="'.base_url().'uploads/caseStudy/images/'.$caseStudy['images'].'" class="img-responsive">';}

            if($caseStudy['type']=='Video')
            {  $imgType ='<img src="'.base_url().'assets/front/images/youtube.png" class="img-responsive">';}

            if($caseStudy['type']=='Presentation')
            {  $imgType ='<img src="'.base_url().'assets/front/images/powerpoint.png" class="img-responsive">';}

            echo '
								<div class="col-xs-6">
									<div class="img-box">
										<a href="#">'.$imgType.'<div class="img-content"><p>'.$caseStudy['title'].'</p></div></a>
									</div>
								</div>';
            if($i%4==0){break;}
        }
        echo '</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-warning btn-sm">more</button>
					</div>
				</div>
			</div>';
    }

    public function reportPlan()
    {
        echo '
			<script>
				$(document).ready(function(){
					$(".close").click(function () { $("#popUp1").hide(); });	
				});
				
				$(document).ready(function(){
					$(".file1").change(function(e){
						var fileName = e.target.files[0].name;
						$(".fileTextNm1").html(fileName);
					});
				});	
				
				$(document).ready(function(){
					$(".file2").change(function(e){
						var fileName = e.target.files[0].name;
						$(".fileTextNm2").html(fileName);
					});
				});	
				
				$(document).ready(function(){
					$(".file3").change(function(e){
						var fileName = e.target.files[0].name;
						$(".fileTextNm3").html(fileName);
					});
				});	
				
				$(document).ready(function(){
					$(".file4").change(function(e){
						var fileName = e.target.files[0].name;
						$(".fileTextNm4").html(fileName);
					});
				});	
			</script>
			<div class="modal-dialog" role="document">
				<div class="modal-content gray-modal">
				  <div class="modal-body">
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title text-center" id="myModalLabel"><label>Add Report</label></h4>';
        echo '
					<input type="hidden" name="id" value="'.$_REQUEST['val'].'">
					<div class="row mt-30">
						<div class="col-xs-3 col-sm-offset-3">
							<label>Baseline Study</label>
						</div>
						<div class="col-xs-6">
							<div class="row">
								<div class="col-sm-12">											
									<div class="upload-btn-wrapper upload-green">
									  <button class="btn">Upload</button>
									  <input type="file" name="baseline" class="file1 report" />
									  <span class="col-sm-12 fileTextNm1" style="font-size: 12px;margin-bottom: 10px;padding-left: 0px;"></span>
									</div>											
								</div>
							</div>	
						</div>
					</div>
					<div class="row">
						<div class="col-xs-3 col-sm-offset-3">
							<label>Need Assessment</label>
						</div>
						<div class="col-xs-6">
							<div class="row">
								<div class="col-sm-12">											
									<div class="upload-btn-wrapper upload-green">
									  <button class="btn">Upload</button>
									  <input type="file" name="assessment" class="file2 report" />
									  <span class="col-sm-12 fileTextNm2" style="font-size: 12px;margin-bottom: 10px;padding-left: 0px;"></span>
									</div>											
								</div>
							</div>	
						</div>
					</div>
					<div class="row">
						<div class="col-xs-3 col-sm-offset-3">
							<label>Monitoring Report</label>
						</div>
						<div class="col-xs-6">
							<div class="row">
								<div class="col-sm-12">											
									<div class="upload-btn-wrapper upload-green">
									  <button class="btn">Upload</button>
									  <input type="file" name="monitoring" class="file3 report" />
									  <span class="col-sm-12 fileTextNm3" style="font-size: 12px;margin-bottom: 10px;padding-left: 0px;"></span>
									</div>											
								</div>
							</div>	
						</div>
					</div>
					<div class="row">
						<div class="col-xs-3 col-sm-offset-3">
							<label>Final Report</label>
						</div>
						<div class="col-xs-6">
							<div class="row">
								<div class="col-sm-12">											
									<div class="upload-btn-wrapper upload-green">
									  <button class="btn">Upload</button>
									  <input type="file" name="finalReport" class="file4 report" />
									  <span class="col-sm-12 fileTextNm4" style="font-size: 12px;margin-bottom: 10px;padding-left: 0px;"></span>
									</div>											
								</div>
							</div>	
						</div>
					</div>
					<div class="row">
						<div class="col-xs-3 col-sm-offset-6">
							<div class="upload-btn-wrapper center-block">
							  <input type="submit" name="baseline" class="btn" />
							</div>
						</div>
					</div>';

        echo '<div class="row custom-table">
						<div class="col-sm-12">
							<div class="scroll-table">
								<table class="table table-responsive table-bordered mb-20 table-top-orange">
									<tr>
										<td>Report Name</td>
										<td>Uploaded On</td>
										<td>State</td>
										<td>Zone</td>
										<td>Brand</td>
										<td>Status</td>
									</tr>';
        $reportDet = $this->Front_model->getDataDesc('reports', 'brief_module_id', $_REQUEST['val'], 'report_id');
        $briefDet = $this->Front_model->getData('brief_modules', 'brief_module_id', $_REQUEST['val']);
        $brandDet = @$this->Front_model->getData('m_zones', 'zone_id', $briefDet[0]['brand_id']);
        if(!empty($briefDet[0]['metro_id']))
        {
            $metroDet 	= $this->Front_model->getData('m_market', 'market_id', $briefDet[0]['metro_id']);
            $stateDet 	= $this->Front_model->getData('states', 'state_id', $metroDet[0]['state']);
            $stateNm 	= $stateDet[0]['title'];
            $zoneDet 	= $this->Front_model->getData('m_zones', 'zone_id', $metroDet[0]['zone']);
            $zoneNm 	= $zoneDet[0]['title'];
        } else {
            $stateNm = "N/A";
            $zoneNm = "N/A";
        }
        if(count($reportDet)>0){
            foreach($reportDet as $data)
            {
                $filename1 = explode('-', $data['filename']);
                $filePath1 = base_url().'uploads/report/'.$data['filename'];
                echo '<tr>
												<td>'.$data['type'].' <a href="'.$filePath1.'"><i class="fa fa-download"></i></a></td>
												<td>'.date('d-m-Y', strtotime($data['created_at'])).'</td>
												<td>'.$stateNm.'</td>
												<td>'.$zoneNm.'</td>
												<td>'.$brandDet[0]['title'].'</td>
												<td>'.$briefDet[0]['b_status'].'</td>
											</tr>';
            }
        } else {
            echo "<tr><td colspan='8'>No, Record Found.</td></tr>";
        }
        echo '</table>
							</div>
						</div>
					</div>
				  </div>
				</div>
			  </div>';
    }

    public function actionPlan()
    {
        $reworkDet = $this->Front_model->getData2Desc('brief_rework', 'brief_module_id', $_REQUEST['val'],'first_excel',0, 'brief_rework_id');
        $briefDet = $this->Front_model->getData('brief_modules', 'brief_module_id', $_REQUEST['val']);
        $filename = explode('-', $briefDet[0]['filename']);
        $filePath = base_url().'uploads/briefModule/'.$briefDet[0]['filename'];

        $brandDet = @$this->Front_model->getData('m_zones', 'zone_id', $briefDet[0]['brand_id']);
        if(!empty($briefDet[0]['metro_id']))
        {
            $metroDet 	= $this->Front_model->getData('m_market', 'market_id', $briefDet[0]['metro_id']);
            $stateDet 	= $this->Front_model->getData('states', 'state_id', $metroDet[0]['state']);
            $stateNm 	= $stateDet[0]['title'];
            $zoneDet 	= $this->Front_model->getData('m_zones', 'zone_id', $metroDet[0]['zone']);
            $zoneNm 	= $zoneDet[0]['title'];
        } else {
            $stateNm = "N/A";
            $zoneNm = "N/A";
        }
        //print_r($metroDet);
        echo '
			<script>
				$(document).ready(function(){
					$(".close").click(function () { $("#popUp").hide(); });	
				});
				
				$(document).ready(function(){
					$(".file1").change(function(e){
						var fileName = e.target.files[0].name;
						$(".fileTextNm1").html(fileName);
					});
				});	
			</script>
			<div class="modal-dialog" role="document">
				<div class="modal-content gray-modal">
				  <div class="modal-body">
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title text-center" id="myModalLabel"><label>Add Rework</label></h4>';

        echo '
					<input type="hidden" name="id" value="'.$_REQUEST['val'].'">
					<div class="row mt-30">
						<div class="col-xs-3 col-sm-offset-3">
							<label>Upload File</label>
						</div>
						<div class="col-xs-6">
							<div class="row">
								<div class="col-sm-12">											
									<div class="upload-btn-wrapper upload-green">
									  <button class="btn">Upload</button>
									  <input type="file" name="baseline" class="file1 report" />
									  <span class="col-sm-12 fileTextNm1" style="font-size: 12px;margin-bottom: 10px;padding-left: 0px;"></span>
									</div>											
								</div>
							</div>	
						</div>
					</div>
					
					<div class="row">
						<div class="col-xs-4 col-sm-offset-6">
							<div class="upload-btn-wrapper center-block">
							  <input type="submit" name="baseline" class="btn" />
							</div>
						</div>
						
					</div>';

        if(!empty($reworkDet)){
            echo '<div class="row custom-table">
						<div class="col-sm-12">
							<div class="scroll-table">
								<table class="table table-responsive table-bordered mb-20 table-top-orange">
									<tr>
										<td>Report Name</td>
										<td>Uploaded on</td>
										<td>State</td>
										<td>Zone</td>
										<td>Brand</td>
										<td>Status</td>
									</tr>';

            foreach($reworkDet as $data)
            {
                $filename1 = explode('-', $data['rework']);
                $filePath1 = base_url().'uploads/briefModule/'.$data['rework'];
                echo '<tr>
											<td>'.$filename1[1].' <a href="'.$filePath1.'"><i class="fa fa-download"></i></a></td>
											<td>'.date('d-m-Y', strtotime($data['created_at'])).'</td>
											<td>'.$stateNm.'</td>
											<td>'.$zoneNm.'</td>
											<td>'.$brandDet[0]['title'].'</td>
											<td>'.$data['b_status'].'</td>
										</tr>';
            }
            echo '</table>
							</div>
						</div>
					</div>';}
        echo '</div>
				</div>
			  </div>';
    }

    public function UploadPlan()
    {
        $reworkDet = $this->Front_model->getData2Desc('brief_rework', 'brief_module_id', $_REQUEST['val'],'first_excel',1, 'brief_rework_id');
        $briefDet = $this->Front_model->getData('brief_modules', 'brief_module_id', $_REQUEST['val']);
        $filename = explode('-', $briefDet[0]['filename']);
        $filePath = base_url().'uploads/briefModule/'.$briefDet[0]['filename'];

        $brandDet = @$this->Front_model->getData('m_zones', 'zone_id', $briefDet[0]['brand_id']);
        if(!empty($briefDet[0]['metro_id']))
        {
            $metroDet 	= $this->Front_model->getData('m_market', 'market_id', $briefDet[0]['metro_id']);
            $stateDet 	= $this->Front_model->getData('states', 'state_id', $metroDet[0]['state']);
            $stateNm 	= $stateDet[0]['title'];
            $zoneDet 	= $this->Front_model->getData('m_zones', 'zone_id', $metroDet[0]['zone']);
            $zoneNm 	= $zoneDet[0]['title'];
        } else {
            $stateNm = "N/A";
            $zoneNm = "N/A";
        }
        echo '
			<script>
				$(document).ready(function(){
					$(".close").click(function () { $("#uploadExcel").hide(); });	
				});
				
				$(document).ready(function(){
					$(".file1").change(function(e){
						var fileName = e.target.files[0].name;
						$(".fileTextNm1").html(fileName);
					});
				});	
			</script>
			<div class="modal-dialog" role="document">
				<div class="modal-content gray-modal">
				  <div class="modal-body">
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title text-center" id="myModalLabel"><label>Upload File</label></h4>';

        echo '
					<input type="hidden" name="id" value="'.$_REQUEST['val'].'">
					<div class="row mt-30">
						<div class="col-xs-3 col-sm-offset-3">
							<label>Upload File</label>
						</div>
						<div class="col-xs-6">
							<div class="row">
								<div class="col-sm-12">											
									<div class="upload-btn-wrapper upload-green">
									  <button class="btn">Upload</button>
									  <input type="file" name="baseline" class="file1 report" />
									  <span class="col-sm-12 fileTextNm1" style="font-size: 12px;margin-bottom: 10px;padding-left: 0px;"></span>
									</div>											
								</div>
							</div>	
						</div>
					</div>
					
					<div class="row">
						<div class="col-xs-4 col-sm-offset-6">
							<div class="upload-btn-wrapper center-block">
							  <input type="submit" name="baseline" class="btn" />
							</div>
						</div>
						
					</div>';
        echo '</div>
				</div>
			  </div>';
    }

    public function uploadExcel()
    {
        if(!empty($_FILES['baseline']['name']))
        {
            if(!empty($_FILES['baseline']['name']))
            {
                $img1Name = $_FILES['baseline']['name'];
                $img1Exp  = explode('.', $img1Name);
                $img1ext  = $img1Exp[count($img1Exp)-1];
                $img1Nm	  = $img1Exp[count($img1Exp)-2];
                if($img1ext=='xlsx' || $img1ext=='csv' || $img1ext=='ppt' || $img1ext=='pptx' || $img1ext=='pps' || $img1ext=='png' || $img1ext=='PNG' || $img1ext=='jpg' || $img1ext=='JPG' || $img1ext=='jpeg' || $img1ext=='JPEG' || $img1ext=='doc' || $img1ext=='docx')
                {
                    //@unlink("./uploads/briefRework/".$_REQUEST['baseline']);
                    $baseline = time()."-".$img1Nm.".".$img1ext;
                    $img1Path = "./uploads/briefRework/".$img1Name;
                    $iimg1mv  = move_uploaded_file($_FILES['baseline']['tmp_name'], $img1Path);
                    @rename("./uploads/briefRework/".$img1Name, "./uploads/briefRework/".$baseline);
                }
                else
                {
                    $this->session->set_flashdata('msg', '<font class="msg_red">Wrong File format for Image!</font>');
                    redirect(base_url().'planning-module', 'refresh');exit;
                }
            }
        }
        //print_r($this->session->userdata('front_user_id'));die;

        $created_at = date('Y-m-d');
        $data = array(
            'brief_module_id' 	=> $_REQUEST['id'],
            'rework' 			=> $baseline,
            'first_excel'       => 1,
            'user_id'=> $this->session->userdata('front_user_id'),
            'created_at' 		=> $created_at,
            'ip_address' 		=> $_SERVER['REMOTE_ADDR']
        );

        //echo "<pre>"; print_r($data);die;
        $this->Front_model->insertData('brief_rework', $data);
        /******************************Emailer******************************/
        $briefDet = $this->Front_model->getData('brief_modules', 'brief_module_id', $_REQUEST['id']);
        $usrDet = $this->Front_model->getData('users', 'user_id', $briefDet[0]['user_id']);

        $to = $usrDet[0]['email'];
        $name = ucwords($usrDet[0]['fname'].' '.$usrDet[0]['lname']);
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        // Create email headers
        $headers .= 'From: info@animonlive.com'."\r\n".
            'Reply-To: noreply@animonlive.com'."\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $message = '
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title></title>
		</head>
		<body style="padding:0px; margin:0px; background-color:#FFFFFF">
			<table style="max-width:700px; min-width:320px; -webkit-text-size-adjust:100%; mso-table-lspace:0pt; mso-table-rspace:0pt;" border="0" cellpadding="0" cellspacing="0" align="center">
				<tbody>
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td style="border:1px solid #d6d9e4;" width="700">
							<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
								<tbody>
									<tr>
										<td style="text-align:left;">
											<div class="col-sm-3">
												<div class="logo" style="padding:5px;text-align:center;">
															<a href="'.base_url().'client/login"><img src="'.base_url().'assets/front/images/vault-logo.png" style="width: 150px;" class="logo-vault img-responsive"></a>
												</div>
											</div>
										</td>
									</tr>
									<tr><td style="border-bottom:1px solid #ddd;"></td></tr>
									<tr>
										<td align="center" bgcolor="#fcfcfc" style="padding:15px 30px;">
											<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
												<tbody>
													<tr>
														<td colspan="2" style="font-size: 18px;font-weight: 700;color:#53566b">Dear '.ucwords($usrDet[0]['fname'].' '.$usrDet[0]['lname']).',</td>
													</tr>
													<tr><td>&nbsp;</td></tr>
													
													<tr>
														<td style="font-size: 14px;font-weight: lighter;color:#53566b; padding-bottom: 10px; width="100%">
														<p>Excel uploaded with PDID <strong>'.$_REQUEST['id'].'</strong></p>
														</td>
													</tr>
													
													<tr><td>&nbsp;</td></tr>
													<tr><td align="left" style="font-size:14px; color:#33324f;">Best Regards</td></tr>
													<tr><td align="left" style="font-size:18px;font-weight:700;color:#53566b;">Vault Application</td></tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
		</body>
		</html>';
        //echo $message;die;
        $subject  = 'Vault - Rework';
        $from 	  = 'Vault Application <info@animonlive.com>';
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        // Create email headers
        $headers .= 'From: '.$from."\r\n".
            'X-Mailer: PHP/' . phpversion();
        @mail($to, $subject, $message, $headers);
        /*****************************End**********************************/

        $this->session->set_flashdata('msg', '<font class="msg_green"><strong>Success!</strong> Excel uploaded successfully.</font>');
        redirect(base_url().'planning-module', 'refresh');exit;
        exit;
    }

    public function uploadRework()
    {
        if(!empty($_FILES['baseline']['name']))
        {
            if(!empty($_FILES['baseline']['name']))
            {
                $img1Name = $_FILES['baseline']['name'];
                $img1Exp  = explode('.', $img1Name);
                $img1ext  = $img1Exp[count($img1Exp)-1];
                $img1Nm	  = $img1Exp[count($img1Exp)-2];
                if($img1ext=='xlsx' || $img1ext=='csv' || $img1ext=='ppt' || $img1ext=='pptx' || $img1ext=='pps' || $img1ext=='png' || $img1ext=='PNG' || $img1ext=='jpg' || $img1ext=='JPG' || $img1ext=='jpeg' || $img1ext=='JPEG' || $img1ext=='doc' || $img1ext=='docx')
                {
                    //@unlink("./uploads/briefRework/".$_REQUEST['baseline']);
                    $baseline = time()."-".$img1Nm.".".$img1ext;
                    $img1Path = "./uploads/briefRework/".$img1Name;
                    $iimg1mv  = move_uploaded_file($_FILES['baseline']['tmp_name'], $img1Path);
                    @rename("./uploads/briefRework/".$img1Name, "./uploads/briefRework/".$baseline);
                }
                else
                {
                    $this->session->set_flashdata('msg', '<font class="msg_red">Wrong File format for Image!</font>');
                    redirect(base_url().'planning-module', 'refresh');exit;
                }
            }
        }

        $created_at = date('Y-m-d');
        $data = array(
            'brief_module_id' 	=> $_REQUEST['id'],
            'rework' 			=> $baseline,
            'user_id'=> $this->session->userdata('front_user_id'),
            'created_at' 		=> $created_at,
            'ip_address' 		=> $_SERVER['REMOTE_ADDR']
        );

        //echo "<pre>"; print_r($data);die;
        $this->Front_model->insertData('brief_rework', $data);
        /******************************Emailer******************************/
        $briefDet = $this->Front_model->getData('brief_modules', 'brief_module_id', $_REQUEST['id']);
        $usrDet = $this->Front_model->getData('users', 'user_id', $briefDet[0]['user_id']);

        $to = $usrDet[0]['email'];
        $name = ucwords($usrDet[0]['fname'].' '.$usrDet[0]['lname']);
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        // Create email headers
        $headers .= 'From: info@animonlive.com'."\r\n".
            'Reply-To: noreply@animonlive.com'."\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $message = '
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title></title>
		</head>
		<body style="padding:0px; margin:0px; background-color:#FFFFFF">
			<table style="max-width:700px; min-width:320px; -webkit-text-size-adjust:100%; mso-table-lspace:0pt; mso-table-rspace:0pt;" border="0" cellpadding="0" cellspacing="0" align="center">
				<tbody>
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td style="border:1px solid #d6d9e4;" width="700">
							<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
								<tbody>
									<tr>
										<td style="text-align:left;">
											<div class="col-sm-3">
												<div class="logo" style="padding:5px;text-align:center;">
															<a href="'.base_url().'client/login"><img src="'.base_url().'assets/front/images/vault-logo.png" style="width: 150px;" class="logo-vault img-responsive"></a>
												</div>
											</div>
										</td>
									</tr>
									<tr><td style="border-bottom:1px solid #ddd;"></td></tr>
									<tr>
										<td align="center" bgcolor="#fcfcfc" style="padding:15px 30px;">
											<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
												<tbody>
													<tr>
														<td colspan="2" style="font-size: 18px;font-weight: 700;color:#53566b">Dear '.ucwords($usrDet[0]['fname'].' '.$usrDet[0]['lname']).',</td>
													</tr>
													<tr><td>&nbsp;</td></tr>
													
													<tr>
														<td style="font-size: 14px;font-weight: lighter;color:#53566b; padding-bottom: 10px; width="100%">
														<p>Rework was made with PDID <strong>'.$_REQUEST['id'].'</strong></p>
														</td>
													</tr>
													
													<tr><td>&nbsp;</td></tr>
													<tr><td align="left" style="font-size:14px; color:#33324f;">Best Regards</td></tr>
													<tr><td align="left" style="font-size:18px;font-weight:700;color:#53566b;">Vault Application</td></tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
		</body>
		</html>';
        //echo $message;die;
        $subject  = 'Vault - Rework';
        $from 	  = 'Vault Application <info@animonlive.com>';
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        // Create email headers
        $headers .= 'From: '.$from."\r\n".
            'X-Mailer: PHP/' . phpversion();
        @mail($to, $subject, $message, $headers);
        /*****************************End**********************************/

        $this->session->set_flashdata('msg', '<font class="msg_green"><strong>Success!</strong> Rework has been saved.</font>');
        redirect(base_url().'planning-module', 'refresh');exit;
        exit;
    }

    public function uploadReport()
    {
        if(!empty($_FILES['baseline']['name']))
        {
            if(!empty($_FILES['baseline']['name']))
            {
                $img1Name = $_FILES['baseline']['name'];
                $img1Exp  = explode('.', $img1Name);
                $img1ext  = $img1Exp[count($img1Exp)-1];
                $img1Nm	  = $img1Exp[count($img1Exp)-2];
                if($img1ext=='xlsx' || $img1ext=='csv' || $img1ext=='ppt' || $img1ext=='pptx' || $img1ext=='pps' || $img1ext=='png' || $img1ext=='PNG' || $img1ext=='jpg' || $img1ext=='JPG' || $img1ext=='jpeg' || $img1ext=='JPEG' || $img1ext=='doc' || $img1ext=='docx')
                {
                    //@unlink("./uploads/report/".$_REQUEST['baseline']);
                    $baseline = time()."baseline-".$img1Nm.".".$img1ext;
                    $img1Path = "./uploads/report/".$img1Name;
                    $iimg1mv  = move_uploaded_file($_FILES['baseline']['tmp_name'], $img1Path);
                    @rename("./uploads/report/".$img1Name, "./uploads/report/".$baseline);
                    $created_at = date('Y-m-d');
                    $data = array(
                        'brief_module_id' 	=> $_REQUEST['id'],
                        'type' 				=> 'Baseline Study',
                        'filename' 			=> $baseline,
                        'created_at' 		=> $created_at,
                        'ip_address' 		=> $_SERVER['REMOTE_ADDR']
                    );

                    $this->Front_model->insertData('reports', $data);
                }
                else
                {
                    $this->session->set_flashdata('msg', '<font class="msg_red">Wrong File format for <strong>Baseline Study</strong>!</font>');
                    redirect(base_url().'planning-module', 'refresh');exit;
                }
            }
        }

        if(!empty($_FILES['assessment']['name']))
        {
            if(!empty($_FILES['assessment']['name']))
            {
                $img1Name = $_FILES['assessment']['name'];
                $img1Exp  = explode('.', $img1Name);
                $img1ext  = $img1Exp[count($img1Exp)-1];
                $img1Nm	  = $img1Exp[count($img1Exp)-2];
                if($img1ext=='xlsx' || $img1ext=='csv' || $img1ext=='ppt' || $img1ext=='pptx' || $img1ext=='pps' || $img1ext=='png' || $img1ext=='PNG' || $img1ext=='jpg' || $img1ext=='JPG' || $img1ext=='jpeg' || $img1ext=='JPEG' || $img1ext=='doc' || $img1ext=='docx')
                {
                    //@unlink("./uploads/report/".$_REQUEST['assessment']);
                    $assessment = time()."assessment-".$img1Nm.".".$img1ext;
                    $img1Path = "./uploads/report/".$img1Name;
                    $iimg1mv  = move_uploaded_file($_FILES['assessment']['tmp_name'], $img1Path);
                    @rename("./uploads/report/".$img1Name, "./uploads/report/".$assessment);
                    $created_at = date('Y-m-d');
                    $data = array(
                        'brief_module_id' 	=> $_REQUEST['id'],
                        'type' 				=> 'Need Assessment',
                        'filename' 			=> $assessment,
                        'created_at' 		=> $created_at,
                        'ip_address' 		=> $_SERVER['REMOTE_ADDR']
                    );

                    $this->Front_model->insertData('reports', $data);
                }
                else
                {
                    $this->session->set_flashdata('msg', '<font class="msg_red">Wrong File format for <strong>Need Assessment</strong>!</font>');
                    redirect(base_url().'planning-module', 'refresh');exit;
                }
            }
        }

        if(!empty($_FILES['monitoring']['name']))
        {
            if(!empty($_FILES['monitoring']['name']))
            {
                $img1Name = $_FILES['monitoring']['name'];
                $img1Exp  = explode('.', $img1Name);
                $img1ext  = $img1Exp[count($img1Exp)-1];
                $img1Nm	  = $img1Exp[count($img1Exp)-2];
                if($img1ext=='xlsx' || $img1ext=='csv' || $img1ext=='ppt' || $img1ext=='pptx' || $img1ext=='pps' || $img1ext=='png' || $img1ext=='PNG' || $img1ext=='jpg' || $img1ext=='JPG' || $img1ext=='jpeg' || $img1ext=='JPEG' || $img1ext=='doc' || $img1ext=='docx')
                {
                    //@unlink("./uploads/report/".$_REQUEST['monitoring']);
                    $monitoring = time()."monitoring-".$img1Nm.".".$img1ext;
                    $img1Path = "./uploads/report/".$img1Name;
                    $iimg1mv  = move_uploaded_file($_FILES['monitoring']['tmp_name'], $img1Path);
                    @rename("./uploads/report/".$img1Name, "./uploads/report/".$monitoring);
                    $created_at = date('Y-m-d');
                    $data = array(
                        'brief_module_id' 	=> $_REQUEST['id'],
                        'type' 				=> 'Monitoring Report',
                        'filename' 			=> $monitoring,
                        'created_at' 		=> $created_at,
                        'ip_address' 		=> $_SERVER['REMOTE_ADDR']
                    );

                    $this->Front_model->insertData('reports', $data);
                }
                else
                {
                    $this->session->set_flashdata('msg', '<font class="msg_red">Wrong File format for <strong>Monitoring Report</strong>!</font>');
                    redirect(base_url().'planning-module', 'refresh');exit;
                }
            }
        }

        if(!empty($_FILES['finalReport']['name']))
        {
            if(!empty($_FILES['finalReport']['name']))
            {
                $img1Name = $_FILES['finalReport']['name'];
                $img1Exp  = explode('.', $img1Name);
                $img1ext  = $img1Exp[count($img1Exp)-1];
                $img1Nm	  = $img1Exp[count($img1Exp)-2];
                if($img1ext=='xlsx' || $img1ext=='csv' || $img1ext=='ppt' || $img1ext=='pptx' || $img1ext=='pps' || $img1ext=='png' || $img1ext=='PNG' || $img1ext=='jpg' || $img1ext=='JPG' || $img1ext=='jpeg' || $img1ext=='JPEG' || $img1ext=='doc' || $img1ext=='docx')
                {
                    //@unlink("./uploads/report/".$_REQUEST['finalReport']);
                    $finalReport = time()."finalReport-".$img1Nm.".".$img1ext;
                    $img1Path = "./uploads/report/".$img1Name;
                    $iimg1mv  = move_uploaded_file($_FILES['finalReport']['tmp_name'], $img1Path);
                    @rename("./uploads/report/".$img1Name, "./uploads/report/".$finalReport);
                    $created_at = date('Y-m-d');
                    $data = array(
                        'brief_module_id' 	=> $_REQUEST['id'],
                        'type' 				=> 'Final Report',
                        'filename' 			=> $finalReport,
                        'created_at' 		=> $created_at,
                        'ip_address' 		=> $_SERVER['REMOTE_ADDR']
                    );

                    $this->Front_model->insertData('reports', $data);
                }
                else
                {
                    $this->session->set_flashdata('msg', '<font class="msg_red">Wrong File format for <strong>Final Report</strong>!</font>');
                    redirect(base_url().'planning-module', 'refresh');exit;
                }
            }
        }

        $this->session->set_flashdata('msg', '<font class="msg_green"><strong>Success!</strong> Report has been saved.</font>');
        redirect(base_url().'planning-module', 'refresh');exit;
        exit;
    }

    public function downloadPlanReport()
    {
        $baseLine1 		= $this->Front_model->getData2last('reports', 'brief_module_id', $_REQUEST['val'], 'type', 'Baseline Study', 'report_id');
        $assessment1 	= $this->Front_model->getData2last('reports', 'brief_module_id', $_REQUEST['val'], 'type', 'Need Assessment', 'report_id');
        $monitoring1 	= $this->Front_model->getData2last('reports', 'brief_module_id', $_REQUEST['val'], 'type', 'Monitoring Report', 'report_id');
        $finalReport1 	= $this->Front_model->getData2last('reports', 'brief_module_id', $_REQUEST['val'], 'type', 'Final Report', 'report_id');

        if(!empty($baseLine1[0]['filename']))
        { $baselineUrl = '<a href = "'.base_url().'uploads/report/'.$baseLine1[0]['filename'].'"><i class="fa fa-download"></i> Download</a></a>'; } else { $baselineUrl = "N/A"; }

        if(!empty($assessment1[0]['filename']))
        { $assessmentUrl = '<a href = "'.base_url().'uploads/report/'.$assessment1[0]['filename'].'"><i class="fa fa-download"></i> Download</a></a>';} else { $assessmentUrl = "N/A"; }

        if(!empty($monitoring1[0]['filename']))
        { $monitoringUrl = '<a href = "'.base_url().'uploads/report/'.$monitoring1[0]['filename'].'"><i class="fa fa-download"></i> Download</a></a>';} else { $monitoringUrl = "N/A"; }

        if(!empty($finalReport1[0]['filename']))
        { $finalUrl = '<a href = "'.base_url().'uploads/report/'.$finalReport1[0]['filename'].'"><i class="fa fa-download"></i> Download</a></a>';} else { $finalUrl = "N/A";}

        echo '
			<script>
				$(document).ready(function(){
					$(".close").click(function () { $("#popUp2").hide(); });	
				});
			</script>
			<div class="modal-dialog" role="document">
				<div class="modal-content gray-modal">
				  <div class="modal-body">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title text-center" id="myModalLabel"><label>Download Latest Report</label></h4>
					<hr>
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-4"><label>Baseline Study</label></div>
						<div class="col-md-4">'.$baselineUrl.'</div>
						<div class="col-md-2"></div>
					</div>
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-4"><label>Need Assessment</label></div>
						<div class="col-md-4">'.$assessmentUrl.'</div>
						<div class="col-md-2"></div>
					</div>
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-4"><label>Monitoring Report</label></div>
						<div class="col-md-4">'.$monitoringUrl.'</div>
						<div class="col-md-2"></div>
					</div>
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-4"><label>Final Report</label></div>
						<div class="col-md-4">'.$finalUrl.'</div>
						<div class="col-md-2"></div>
					</div>
					<br><br>
				  </div>
			  </div>
		    </div>';
    }

    public function downloadPlanRework()
    {



        echo '
			<script>
				$(document).ready(function(){
					$(".close").click(function () { $("#popUp2").hide(); });	
				});
			</script>
			<div class="modal-dialog" role="document">
				<div class="modal-content gray-modal">
				  <div class="modal-body">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title text-center" id="myModalLabel"><label>Download Latest File</label></h4>
					<hr>';
        echo '<div class="row custom-table">
						<div class="col-sm-12">
							<div class="scroll-table">
								<table class="table table-responsive table-bordered mb-20 table-top-orange">
									<tr>
										<td>Report Name</td>
										<td>Uploaded on</td>
										<td>Uploaded By</td>
										<td>Team</td>
										<td>State</td>
										<td>Zone</td>
										<td>Brand</td>
										<td>Status</td>
									</tr>';
        $users= $this->Front_model->getData('users', 'status','Active');
        foreach ($users as $user){
            $reworkDet = $this->Front_model->getData3last('brief_rework', 'brief_module_id', $_REQUEST['val'],'first_excel',1,'user_id',$user['user_id'], 'brief_rework_id');
            $briefDet = $this->Front_model->getData('brief_modules', 'brief_module_id', $_REQUEST['val']);

            $brandDet = @$this->Front_model->getData('m_zones', 'zone_id', $briefDet[0]['brand_id']);
            if(!empty($briefDet[0]['metro_id']))
            {
                $metroDet 	= $this->Front_model->getData('m_market', 'market_id', $briefDet[0]['metro_id']);
                $stateDet 	= $this->Front_model->getData('states', 'state_id', $metroDet[0]['state']);
                $stateNm 	= $stateDet[0]['title'];
                $zoneDet 	= $this->Front_model->getData('m_zones', 'zone_id', $metroDet[0]['zone']);
                $zoneNm 	= $zoneDet[0]['title'];
            } else {
                $stateNm = "N/A";
                $zoneNm = "N/A";
            }


            foreach($reworkDet as $data)
            {
                $filename1 = explode('-', $data['rework']);
                $filePath1 = base_url().'uploads/briefModule/'.$data['rework'];
                $user_name = $this->Front_model->getData('users', 'user_id', $data['user_id']);
                //print_r($data);die;
                $role = $this->Front_model->getData('roles', 'role_id', $user_name[0]['role_id']);
                echo '<tr>
											<td>'.$filename1[1].' <a href="'.$filePath1.'" download><i class="fa fa-download"></i></a></td>
											<td>'.date('d-m-Y', strtotime($data['created_at'])).'</td>
											<td>'.$user_name[0]['fname'].' '.$user_name[0]['lname'].'</td>
											<td>'.$role[0]['title'].'</td>
											
											<td>'.$stateNm.'</td>
											<td>'.$zoneNm.'</td>
											<td>'.$brandDet[0]['title'].'</td>
											<td>'.$data['b_status'].'</td>
										</tr>';
            }
            /*echo '<tr class="text-bold">
                <td>'.$filename[1].' <a href="'.$filePath.'"><i class="fa fa-download"></i></a></td>
                <td>'.date('d-m-Y', strtotime($briefDet[0]['created_at'])).'</td>
                <td>'.$stateNm.'</td>
                <td>'.@$zoneDet[0]['title'].'</td>
                <td>'.@$brandDet[0]['title'].'</td>
                <td>'.@$briefDet[0]['b_status'].'</td>
            </tr>';*/

        }
        echo '</table>
							</div>
						</div>
					</div>';

        echo'</div>
			  </div>
		    </div>';
    }

    public function downloadArchiveReport()
    {
        $baseLine1 		= $this->Front_model->getDatalast('brief_baseline_study', 'brief_module_id', $_REQUEST['val'], 'brief_baseline_study_id');
        $assessment1 	= $this->Front_model->getDatalast('brief_need_assessment', 'brief_module_id', $_REQUEST['val'], 'brief_need_assessment_id');

        if(!empty($baseLine1[0]['baseline_study']))
        { $baselineUrl = '<a href = "'.base_url().'uploads/briefBaselineStudy/'.$baseLine1[0]['baseline_study'].'"><button class="btn btn-green btn-sm">Download</button></a>'; } else { $baselineUrl = "N/A"; }

        if(!empty($assessment1[0]['need_assessment']))
        { $assessmentUrl = '<a href = "'.base_url().'uploads/briefNeedAssessment/'.$assessment1[0]['need_assessment'].'"><button class="btn btn-green btn-sm">Download</button></a>';} else { $assessmentUrl = "N/A"; }

        echo '
			<div class="col-sm-4">
				<div class="row">
					<div class="col-sm-6">
						<label>Baseline Study</label>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							'.$baselineUrl.'
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<label>Need Assessment</label>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							'.$assessmentUrl.'
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<label>Monitoring Report</label>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<button class="btn btn-green btn-sm" onclick="return reportMonitor('.$_REQUEST['val'].');">Download</button></a>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<label>Final Report</label>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<button class="btn btn-green btn-sm" onclick="return reportFinal('.$_REQUEST['val'].');">Download</button></a>
						</div>
					</div>
				</div>
			</div>';
    }

    public function downloadMonitorReport()
    {
        $monitoringRprt 	= $this->Front_model->getDatalast('brief_monitoring', 'brief_module_id', $_REQUEST['val'], 'brief_monitoring_id');

        if(!empty($monitoringRprt[0]['pre_preparation_excel']))
        { $pre_preparation_excel = '<a href = "'.base_url().'uploads/briefMonitoring/'.$monitoringRprt[0]['pre_preparation_excel'].'"><i class="fa fa-download"></i> Download</a></a>'; } else { $pre_preparation_excel = "N/A"; }

        if(!empty($monitoringRprt[0]['iInterim_excel']))
        { $iInterim_excel = '<a href = "'.base_url().'uploads/briefMonitoring/'.$monitoringRprt[0]['iInterim_excel'].'"><i class="fa fa-download"></i> Download</a></a>';} else { $iInterim_excel = "N/A"; }

        if(!empty($monitoringRprt[0]['final_excel']))
        { $final_excel = '<a href = "'.base_url().'uploads/briefMonitoring/'.$monitoringRprt[0]['final_excel'].'"><i class="fa fa-download"></i> Download</a></a>';} else { $final_excel = "N/A"; }

        echo '
			<script>
				$(document).ready(function(){
					$(".close").click(function () { $("#popUp").hide(); });	
				});
			</script>
			<div class="modal-dialog" role="document">
				<div class="modal-content gray-modal">
				  <div class="modal-body">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title text-center" id="myModalLabel"><label>Download Monitoring Latest Report</label></h4>
					<hr>
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-4"><label>Pre-Preparation</label></div>
						<div class="col-md-4">'.$pre_preparation_excel.'</div>
						<div class="col-md-2"></div>
					</div>
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-4"><label>Interim Reports</label></div>
						<div class="col-md-4">'.$iInterim_excel.'</div>
						<div class="col-md-2"></div>
					</div>
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-4"><label>Final Reports</label></div>
						<div class="col-md-4">'.$final_excel.'</div>
						<div class="col-md-2"></div>
					</div>
				
					<br><br>
				  </div>
			  </div>
		    </div>';
    }

    public function downloadFinalReport()
    {
        $finalRprt 	= $this->Front_model->getDatalast('brief_reporting', 'brief_module_id', $_REQUEST['val'], 'brief_reporting_id');

        if(!empty($finalRprt[0]['pre_preparation_excel']))
        { $pre_preparation_excel = '<a href = "'.base_url().'uploads/briefReporting/'.$finalRprt[0]['pre_preparation_excel'].'"><i class="fa fa-download"></i> Download</a></a>'; } else { $pre_preparation_excel = "N/A"; }

        if(!empty($finalRprt[0]['iInterim_excel']))
        { $iInterim_excel = '<a href = "'.base_url().'uploads/briefReporting/'.$finalRprt[0]['iInterim_excel'].'"><i class="fa fa-download"></i> Download</a></a>';} else { $iInterim_excel = "N/A"; }

        if(!empty($finalRprt[0]['final_excel']))
        { $final_excel = '<a href = "'.base_url().'uploads/briefReporting/'.$finalRprt[0]['final_excel'].'"><i class="fa fa-download"></i> Download</a></a>';} else { $final_excel = "N/A"; }

        echo '
			<script>
				$(document).ready(function(){
					$(".close").click(function () { $("#popUp").hide(); });	
				});
			</script>
			<div class="modal-dialog" role="document">
				<div class="modal-content gray-modal">
				  <div class="modal-body">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title text-center" id="myModalLabel"><label>Download Latest Final Report</label></h4>
					<hr>
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-4"><label>Pre-Preparation</label></div>
						<div class="col-md-4">'.$pre_preparation_excel.'</div>
						<div class="col-md-2"></div>
					</div>
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-4"><label>Interim Reports</label></div>
						<div class="col-md-4">'.$iInterim_excel.'</div>
						<div class="col-md-2"></div>
					</div>
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-4"><label>Final Reports</label></div>
						<div class="col-md-4">'.$final_excel.'</div>
						<div class="col-md-2"></div>
					</div>
				
					<br><br>
				  </div>
			  </div>
		    </div>';
    }


    public function showCity() {
        $state_id = $_REQUEST['state'];
        $rsonVl = $this->Front_model->getData2Asc('cities', 'state_id', 'status', $state_id, 'Active', 'title');
        if (empty($rsonVl)) {
            echo "1";
        } else {
            echo "<option value=''>-Select-</option>";
            if (!empty($state_id)) {
                foreach ($rsonVl as $value) {
                    echo "<option value='" . $value['city_id'] . "'>" . $value['title'] . "</option>";
                }
            }
        }
    }
    public function viewAssistedBy() {
        $id = implode(',', $_REQUEST['val']);
        $rsonVl = $this->Front_model->getData2In('users', 'status', 'Active', 'role_id', $id, 'title');
        if (empty($rsonVl)) {
            echo "1";
        } else {
            //echo "<option value=''>-Select-</option>";
            if (!empty($id)) {
                foreach ($rsonVl as $value) {
                    echo "<option value='" . $value['user_id'] . "'>" . ucwords($value['fname'].' '.$value['lname']) . "</option>";
                }
            }
        }
    }

    public function updateStatus() {
        $id = $_REQUEST['id'];
        $b_status = $_REQUEST['val'];
        $data = array('b_status' => $b_status);
        $this->Front_model->updateData('brief_modules', $data, 'brief_module_id', $id);
    }

}
