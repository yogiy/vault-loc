<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProjectManagement extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('front/Front_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
        $this->load->library('email');
    }


    public function projectManagement()
    {
        if ($this->session->userdata('front_user_logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $data["categories"]     = $this->Front_model->getDataC('m_categories', 'status', 'Active');
        $data["clients"]        = $this->Front_model->getDataAsc('users', 'role_id', 5, 'fname');
        $data["brands"]     	= $this->Front_model->getDataAsc('m_brands', 'status', 'Active', 'title');
        $data["states"]     	= $this->Front_model->getDataAsc('states', 'country_id', 1, 'title');
        $data["zones"]     		= $this->Front_model->getDataAsc('m_zones', 'status', 'Active', 'title');

        $data["plannings"]      = $this->Front_model->searchProjectManagementData();
        $data['admin_folder']    = "False";
        $data["results"]         = "True";

        $data['title']			 = 'Project Management';
        $data['keyword']       	 = 'Project Management';
        $data['description']     = 'Project Management';
        $data['breadcrumb']      = 'Project Management';
        $data['page_name']       = 'page/projectManagement';
        $this->load->view('index',$data);
    }

    public function searchProjectManagement()
    {
        if ($this->session->userdata('front_user_logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $pdid 		= $_REQUEST['pdid'];
        $zone_id 	= $_REQUEST['zone_id'];
        $client_id 	= $_REQUEST['client_id'];
        $state_id 	= $_REQUEST['state_id'];
        $brand_id	= $_REQUEST['brand_id'];
        $status 	= $_REQUEST['status'];

        if(!empty($pdid) ||!empty($zone_id) ||!empty($client_id) ||!empty($state_id) ||!empty($brand_id) ||!empty($status))
        {
            $data = array('pMpdid' => $pdid,'pMzone_id' => $zone_id,'pMclient_id' => $client_id,'pMstate_id' => $state_id,'pMbrand_id' => $brand_id,'pMstatus' => $status,'pMplnSess'=>'True');
            $this->session->set_userdata($data);
        }
        redirect(base_url().'project-management', 'refresh');exit;
        exit;
    }

    public function unsetProjectManagement()
    {
        if ($this->session->userdata('front_user_logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $this->session->unset_userdata('pMpdid');
        $this->session->unset_userdata('pMzone_id');
        $this->session->unset_userdata('pMclient_id');
        $this->session->unset_userdata('pMstate_id');
        $this->session->unset_userdata('pMbrand_id');
        $this->session->unset_userdata('pMstatus');
        $this->session->unset_userdata('pMplnSess');
        redirect(base_url().'project-management', 'refresh');exit;
        exit;
    }


    public function projectManagementForm()
    {
        if ($this->session->userdata('front_user_id') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }


        $data['admin_folder']  = "False";
        $data['brief_id']    =   $this->uri->segment(2);
        $data['mou'] = $this->Front_model->getDataDesc('brief_mou', 'brief_module_id', $data['brief_id'],'brief_mou_id');
        $data['briefs']       =   $this->Front_model->getData('brief_modules', 'brief_module_id', $this->uri->segment(2));
        $data['client'] = $this->Front_model->getData('users', 'user_id', $data['briefs'][0]['client_id']);
        $data['reworks']= $this->Front_model->getDataDesc('brief_rework', 'brief_module_id', $data['brief_id'],'brief_rework_id');

        $data["results"]         = "True";
        $data['title']			 = 'Project Management';
        $data['keyword']       	 = 'Project Management';
        $data['description']     = 'Project Management';
        $data['breadcrumb']      = 'Project Management';
        $data['page_name']       = 'page/projectManagementForm';
        $this->load->view('index',$data);
    }


    public function projectManagementStore()
    {
        $brief_module_id = $this->uri->segment(2);
        $briefs       =   $this->Front_model->getData('brief_modules', 'brief_module_id',$brief_module_id);
        $client= $this->Front_model->getData('users', 'user_id', $briefs[0]['client_id']);
        $mou       =   $this->Front_model->getDataDesc('brief_mou', 'brief_module_id', $brief_module_id,'brief_mou_id');
        $brands = $this->Front_model->getData('m_brands', 'brand_id', $briefs[0]['brand_id']);
        $baseline_study = $this->Front_model->getDataDesc('brief_baseline_study', 'brief_module_id', $brief_module_id,'brief_baseline_study_id');
        $monitoring = $this->Front_model->getDataDesc('brief_monitoring', 'brief_module_id', $brief_module_id,'brief_monitoring_id');
        $reporting = $this->Front_model->getDataDesc('brief_reporting', 'brief_module_id', $brief_module_id,'brief_reporting_id');
        $need_assessment = $this->Front_model->getDataDesc('brief_need_assessment', 'brief_module_id', $brief_module_id,'brief_need_assessment_id');
        $management = $this->Front_model->getDataDesc('project_management', 'brief_module_id', $brief_module_id,'project_management_id');

        /* -----------------------------------------Mou-----------------------------------------*/
        $data= array(
            'brief_module_id'=> $brief_module_id,
            'user_id'=> $this->session->userdata('front_user_id'),
            'receipt_date'=>@$_REQUEST['receipt_date'],
            'fund_disbursement'=>@$_REQUEST['fund_disbursement'],
            'fund_start_date'=>@$_REQUEST['fund_start_date'],
            'fund_end_date'=>@$_REQUEST['fund_end_date'],
            'reporting_schedule'=>@$_REQUEST['reporting_schedule'],
            'report_start_date'=>@$_REQUEST['report_start_date'],
            'report_end_date'=>@$_REQUEST['report_end_date'],
            'budget'=>@$_REQUEST['budget'],
            'ip_address' => $_SERVER['REMOTE_ADDR']
        );
        $this->Front_model->updateData('brief_mou',$data,'brief_mou_id',$mou[0]['brief_mou_id'] );
        /* -----------------------------------------Mou End-----------------------------------------*/

        /* -----------------------------------------Baseline Study-----------------------------------------*/

        if(!empty($_FILES['baseline_study']['name'])) {
            $baselineStudyName = $_FILES['baseline_study']['name'];
            $baselineStudyExp  = explode('.', $baselineStudyName);
            $baselineStudyExt  = $baselineStudyExp[count($baselineStudyExp)-1];
            $baselineStudyNm	  = $baselineStudyExp[count($baselineStudyExp)-2];
                $baselineStudy = time()."-".$baselineStudyNm.".".$baselineStudyExt;
                $baselineStudyPath = "./uploads/briefBaselineStudy/".$baselineStudyName;
                move_uploaded_file($_FILES['baseline_study']['tmp_name'], $baselineStudyPath);
                @rename("./uploads/briefBaselineStudy/".$baselineStudyName, "./uploads/briefBaselineStudy/".$baselineStudy);

        }else{
            if(!empty($baseline_study))
                $baselineStudy = $baseline_study[0]['baseline_study'];
            else
                $baselineStudy ='';
        }

        $app_url = base_url().'uploads/briefBaselineStudy/'.$baselineStudy;
        if(empty($_REQUEST['base_mail_send'])) {
            $_REQUEST['base_mail_send'] = 0;
        }

        if(($_REQUEST['base_mail_send'] =='on')) {
            $_REQUEST['base_mail_send'] = 1;
        }

        if(($_REQUEST['base_mail_send'] == '1')) {

            //  print_r($_REQUEST['base_mail_send']);die;
            /******************Email mail funtion *******************/
            $name = $client[0]['fname'].' '.$client[0]['lname'];
            $to = $_REQUEST['base_mail_id'];
            // To send HTML mail, the Content-type header must be set
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            // Create email headers
            $headers .= 'From: swati22chaudhary@gmail.com'."\r\n".
                'Reply-To: noreply@gmail.com'."\r\n" .
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
																<a href="http://productionserver.co.in/vault/client/login"><img src="http://productionserver.co.in/vault/assets/front/images/vault-logo.png" style="width: 150px;" class="logo-vault img-responsive"></a>
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
															<td colspan="2" style="font-size: 18px;font-weight: 700;color:#53566b">Dear '.ucfirst($name).',</td>
														</tr>
														<tr><td>&nbsp;</td></tr>
														<tr>
															<td style="font-size: 14px;font-weight: lighter;color:#53566b; padding-bottom: 10px;" width="50%">Project ID: </td>
															<td style="font-size: 14px;font-weight: lighter;color:#53566b; padding-bottom: 10px;" width="50%">PDID: '.$briefs[0]['brief_module_id'].'</td>
														</tr>
														<tr>
															<td style="font-size: 14px;font-weight: lighter;color:#53566b; padding-bottom: 10px;" width="50%">Project name: </td>
															<td style="font-size: 14px;font-weight: lighter;color:#53566b; padding-bottom: 10px;" width="50%">'.$briefs[0]['title'].'</td>
														</tr>
														<tr>
															<td style="font-size: 14px;font-weight: lighter;color:#53566b; padding-bottom: 10px;" width="50%">Brand name: </td>
															<td style="font-size: 14px;font-weight: lighter;color:#53566b; padding-bottom: 10px;" width="50%">'.$brands[0]['title'].'</td>
														</tr>
														<tr>
															<td style="font-size: 14px;font-weight: lighter;color:#53566b; padding-bottom: 10px;" width="50%">Client name: </td>
															<td style="font-size: 14px;font-weight: lighter;color:#53566b; padding-bottom: 10px;" width="50%">'.$name.'</td>
														</tr>
														<tr>
															<td style="font-size: 14px;font-weight: lighter;color:#53566b; padding-bottom: 10px;text-align:center;" width="100%">
															<p>you have receive a new email attachment of base-line study. <a class="btn btn-primary" href="'.$app_url.'">Click here </a> to download.</p>
</td>
														</tr>
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
            $subject  = 'Base-line study |'.$briefs[0]['title'].' | '.$brands[0]['title'].' | '.$name;
            $from 	  = 'Vault Application <info@finance.productionserver.co.in>';
            // To send HTML mail, the Content-type header must be set
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            // Create email headers
            $headers .= 'From: '.$from."\r\n".
                'X-Mailer: PHP/' . phpversion();
            @mail($to, $subject, $message, $headers);
        }

        if(empty($_REQUEST['base_b_status'])) {
            $_REQUEST['base_b_status'] = 'WIP';
        }

        $data2 = array(
            'brief_module_id'=> $brief_module_id,
            'user_id'=> $this->session->userdata('front_user_id'),
            'mail_send'=>@$_REQUEST['base_mail_send'],
            'mail_id'=>@$_REQUEST['base_mail_id'],
            'b_status'=>@$_REQUEST['base_b_status'],
            'baseline_study'=> $baselineStudy,
            'ip_address' => $_SERVER['REMOTE_ADDR']
        );
        $this->Front_model->insertData('brief_baseline_study', $data2);

        /* -----------------------------------------Need Assessment-----------------------------------------*/
        if(!empty($_FILES['need_assessment']['name'])) {
            $needAssessmentName = $_FILES['need_assessment']['name'];
            $needAssessmentExp  = explode('.', $needAssessmentName);
            $needAssessmentExt  = $needAssessmentExp[count($needAssessmentExp)-1];
            $needAssessmentNm	  = $needAssessmentExp[count($needAssessmentExp)-2];
                $needAssessment = time()."-".$needAssessmentNm.".".$needAssessmentExt;
                $needAssessmentPath = "./uploads/briefNeedAssessment/".$needAssessmentName;
                move_uploaded_file($_FILES['need_assessment']['tmp_name'], $needAssessmentPath);
                @rename("./uploads/briefNeedAssessment/".$needAssessmentName, "./uploads/briefNeedAssessment/".$needAssessment);

        }else{
            if(!empty($need_assessment))
                $needAssessment = $need_assessment[0]['need_assessment'];
            else
                $needAssessment ='';
        }

        $needAssessmentUrl = base_url().'uploads/briefNeedAssessment/'.$needAssessment;

        if(empty($_REQUEST['need_mail_send'])) {
            $_REQUEST['need_mail_send'] = 0;
        }
        if(($_REQUEST['need_mail_send'] =='on')) {
            $_REQUEST['need_mail_send'] = 1;
        }
        //

        if(($_REQUEST['need_mail_send'] == '1')) {
            //print_r($_REQUEST['need_mail_send']);die;
            /******************Email mail funtion *******************/
            $name = $client[0]['fname'].' '.$client[0]['lname'];
            $to = $_REQUEST['need_mail_id'];
            // To send HTML mail, the Content-type header must be set
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            // Create email headers
            $headers .= 'From: swati22chaudhary@gmail.com'."\r\n".
                'Reply-To: noreply@gmail.com'."\r\n" .
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
																<a href="http://productionserver.co.in/vault/client/login"><img src="http://productionserver.co.in/vault/assets/front/images/vault-logo.png" style="width: 150px;" class="logo-vault img-responsive"></a>
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
															<td colspan="2" style="font-size: 18px;font-weight: 700;color:#53566b">Dear '.ucfirst($name).',</td>
														</tr>
														<tr><td>&nbsp;</td></tr>
														<tr>
															<td style="font-size: 14px;font-weight: lighter;color:#53566b; padding-bottom: 10px;" width="50%">Project ID: </td>
															<td style="font-size: 14px;font-weight: lighter;color:#53566b; padding-bottom: 10px;" width="50%">PDID: '.$briefs[0]['brief_module_id'].'</td>
														</tr>
														<tr>
															<td style="font-size: 14px;font-weight: lighter;color:#53566b; padding-bottom: 10px;" width="50%">Project name: </td>
															<td style="font-size: 14px;font-weight: lighter;color:#53566b; padding-bottom: 10px;" width="50%">'.$briefs[0]['title'].'</td>
														</tr>
														<tr>
															<td style="font-size: 14px;font-weight: lighter;color:#53566b; padding-bottom: 10px;" width="50%">Brand name: </td>
															<td style="font-size: 14px;font-weight: lighter;color:#53566b; padding-bottom: 10px;" width="50%">'.$brands[0]['title'].'</td>
														</tr>
														<tr>
															<td style="font-size: 14px;font-weight: lighter;color:#53566b; padding-bottom: 10px;" width="50%">Client name: </td>
															<td style="font-size: 14px;font-weight: lighter;color:#53566b; padding-bottom: 10px;" width="50%">'.$name.'</td>
														</tr>
														<tr>
															<td style="font-size: 14px;font-weight: lighter;color:#53566b; padding-bottom: 10px;text-align:center;" width="100%">
															<p>you have receive a new email attachment of need assessment. <a class="btn btn-primary" href="'.$needAssessmentUrl.'">Click here </a> to download.</p>
</td>
														</tr>
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
            $subject  = 'Base-line study |'.$briefs[0]['title'].' | '.$brands[0]['title'].' | '.$name;
            $from 	  = 'Vault Application <info@finance.productionserver.co.in>';
            // To send HTML mail, the Content-type header must be set
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            // Create email headers
            $headers .= 'From: '.$from."\r\n".
                'X-Mailer: PHP/' . phpversion();
            @mail($to, $subject, $message, $headers);
        }

        if(empty($_REQUEST['need_b_status'])) {
            $_REQUEST['need_b_status'] = 'WIP';
        }

        $data3 = array(
            'brief_module_id'=> $brief_module_id,
            'user_id'=> $this->session->userdata('front_user_id'),
            'mail_send'=>@$_REQUEST['need_mail_send'],
            'mail_id'=>@$_REQUEST['need_mail_id'],
            'b_status'=>@$_REQUEST['need_b_status'],
            'need_assessment'=> $needAssessment,
            'ip_address' => $_SERVER['REMOTE_ADDR']
        );
        $this->Front_model->insertData('brief_need_assessment', $data3);

        /* -----------------------------------------Monitoring-----------------------------------------*/
        if(!empty($_FILES['pre_preparation_excel']['name'])) {
            $prePreparationName = $_FILES['pre_preparation_excel']['name'];
            $prePreparationExp  = explode('.', $prePreparationName);
            $prePreparationExt  = $prePreparationExp[count($prePreparationExp)-1];
            $prePreparationNm	  = $prePreparationExp[count($prePreparationExp)-2];
                $prePreparation = time()."-pre_preparation".$prePreparationNm.".".$prePreparationExt;
                $prePreparationPath = "./uploads/briefMonitoring/".$prePreparationName;
                move_uploaded_file($_FILES['pre_preparation_excel']['tmp_name'], $prePreparationPath);
                @rename("./uploads/briefMonitoring/".$prePreparationName, "./uploads/briefMonitoring/".$prePreparation);

        }else{
            if(!empty($monitoring[0]['pre_preparation_excel']))
                $prePreparation = $monitoring[0]['pre_preparation_excel'];
            else
                $prePreparation ='';
        }

        if(!empty($_FILES['iInterim_excel']['name'])) {
            $iInterimName = $_FILES['iInterim_excel']['name'];
            $iInterimExp  = explode('.', $iInterimName);
            $iInterimExt  = $iInterimExp[count($iInterimExp)-1];
            $iInterimNm	  = $iInterimExp[count($iInterimExp)-2];
            if($iInterimExt=='xlsx' || $iInterimExt=='csv'|| $iInterimExt=='xls' || $iInterimExt=='pptx'
                || $iInterimExt=='jpg' || $iInterimExt=='jpeg'
                || $iInterimExt=='png' || $iInterimExt=='JPG' || $iInterimExt=='JPEG'
                || $iInterimExt=='PNG' || $iInterimExt=='doc'
                || $iInterimExt=='docx' || $iInterimExt=='ppt'
                || $iInterimExt=='pdf') {
                $iInterim = time()."-iInterim".$iInterimNm.".".$iInterimExt;
                $iInterimPath = "./uploads/briefMonitoring/".$iInterimName;
                move_uploaded_file($_FILES['iInterim_excel']['tmp_name'], $iInterimPath);
                @rename("./uploads/briefMonitoring/".$iInterimName, "./uploads/briefMonitoring/".$iInterim);
            }
            else {

                $this->session->set_flashdata('msg', '<font class="msg_red">Wrong File format for need assessment!</font>');
                redirect(base_url().'project-management/'.$brief_module_id, 'refresh');exit;
            }
        }else{
            if(!empty($monitoring[0]['iInterim_excel']))
                $iInterim = $monitoring[0]['iInterim_excel'];
            else
                $iInterim ='';
        }

        if(!empty($_FILES['final_excel']['name'])) {
            $finalExcelName = $_FILES['final_excel']['name'];
            $finalExcelExp  = explode('.', $finalExcelName);
            $finalExcelExt  = $finalExcelExp[count($finalExcelExp)-1];
            $finalExcelNm	  = $finalExcelExp[count($finalExcelExp)-2];
                $finalExcel = time()."-final".$finalExcelNm.".".$finalExcelExt;
                $finalExcelPath = "./uploads/briefMonitoring/".$finalExcelName;
                move_uploaded_file($_FILES['final_excel']['tmp_name'], $finalExcelPath);
                @rename("./uploads/briefMonitoring/".$finalExcelName, "./uploads/briefMonitoring/".$finalExcel);

        }else{
            if(!empty($monitoring[0]['final_excel']))
                $finalExcel = $monitoring[0]['final_excel'];
            else
                $finalExcel ='';
        }

        if(empty($_REQUEST['pre_preparation_b_status'])) {
            $_REQUEST['pre_preparation_b_status'] = 'WIP';
        }
        if(empty($_REQUEST['iInterim_b_status'])) {
            $_REQUEST['iInterim_b_status'] = 'WIP';
        }
        if(empty($_REQUEST['final_b_status'])) {
            $_REQUEST['final_b_status'] = 'WIP';
        }
        $data4 = array(
            'brief_module_id'=> $brief_module_id,
            'user_id'=> $this->session->userdata('front_user_id'),
            'pre_preparation_b_status'=>@$_REQUEST['pre_preparation_b_status'],
            'pre_preparation_excel'=> $prePreparation,
            'pre_preparation_follow_up_date'=>@$_REQUEST['pre_preparation_follow_up_date'],
            'iInterim_excel'=> $iInterim,
            'iInterim_follow_up_date' => @$_REQUEST['iInterim_follow_up_date'],
            'iInterim_b_status'=>@$_REQUEST['iInterim_b_status'],
            'final_b_status'=>@$_REQUEST['final_b_status'],
            'final_follow_up_date'=>@$_REQUEST['final_follow_up_date'],
            'final_excel'=> $finalExcel,
            'ip_address' => $_SERVER['REMOTE_ADDR']
        );
        $this->Front_model->insertData('brief_monitoring', $data4);

        /* -----------------------------------------Reporting-----------------------------------------*/
        if(!empty($_FILES['report_pre_preparation_excel']['name'])) {
            $reportPrePreparationName = $_FILES['report_pre_preparation_excel']['name'];
            $reportPrePreparationExp  = explode('.', $reportPrePreparationName);
            $reportPrePreparationExt  = $reportPrePreparationExp[count($reportPrePreparationExp)-1];
            $reportPrePreparationNm	  = $reportPrePreparationExp[count($reportPrePreparationExp)-2];
                $reportPrePreparation = time()."-pre_preparation".$reportPrePreparationNm.".".$reportPrePreparationExt;
                $reportPrePreparationPath = "./uploads/briefReporting/".$reportPrePreparationName;
                move_uploaded_file($_FILES['report_pre_preparation_excel']['tmp_name'], $reportPrePreparationPath);
                @rename("./uploads/briefReporting/".$reportPrePreparationName, "./uploads/briefReporting/".$reportPrePreparation);

        }else{
            if(!empty($reporting[0]['report_pre_preparation_excel']))
                $reportPrePreparation = $reporting[0]['report_pre_preparation_excel'];
            else
                $reportPrePreparation ='';
        }

        if(!empty($_FILES['report_iInterim_excel']['name'])) {
            $reportiInterimName = $_FILES['report_iInterim_excel']['name'];
            $reportiInterimExp  = explode('.', $reportiInterimName);
            $reportiInterimExt  = $reportiInterimExp[count($reportiInterimExp)-1];
            $reportiInterimNm	  = $reportiInterimExp[count($reportiInterimExp)-2];
                $reportiInterim = time()."-reportiInterim".$reportiInterimNm.".".$reportiInterimExt;
                $reportiInterimPath = "./uploads/briefReporting/".$reportiInterimName;
                move_uploaded_file($_FILES['report_iInterim_excel']['tmp_name'], $reportiInterimPath);
                @rename("./uploads/briefReporting/".$reportiInterimName, "./uploads/briefReporting/".$reportiInterim);

        }else{
            if(!empty($reporting[0]['report_iInterim_excel']))
                $reportiInterim = $reporting[0]['report_iInterim_excel'];
            else
                $reportiInterim ='';
        }

        if(!empty($_FILES['report_final_excel']['name'])) {
            $reportFinalExcelName = $_FILES['report_final_excel']['name'];
            $reportFinalExcelExp  = explode('.', $reportFinalExcelName);
            $reportFinalExcelExt  = $reportFinalExcelExp[count($reportFinalExcelExp)-1];
            $reportFinalExcelNm	  = $reportFinalExcelExp[count($reportFinalExcelExp)-2];
                $reportFinalExcel = time()."-final".$reportFinalExcelNm.".".$reportFinalExcelExt;
                $reportFinalExcelPath = "./uploads/briefReporting/".$reportFinalExcelName;
                move_uploaded_file($_FILES['report_final_excel']['tmp_name'], $reportFinalExcelPath);
                @rename("./uploads/briefReporting/".$reportFinalExcelName, "./uploads/briefReporting/".$reportFinalExcel);

        }else{
            if(!empty($reporting[0]['report_final_excel']))
                $reportFinalExcel = $reporting[0]['report_final_excel'];
            else
                $reportFinalExcel ='';
        }

        if(empty($_REQUEST['report_pre_preparation_b_status'])) {
            $_REQUEST['report_pre_preparation_b_status'] = 'WIP';
        }
        if(empty($_REQUEST['report_iInterim_b_status'])) {
            $_REQUEST['report_iInterim_b_status'] = 'WIP';
        }
        if(empty($_REQUEST['report_final_b_status'])) {
            $_REQUEST['report_final_b_status'] = 'WIP';
        }

        $data5 = array(
            'brief_module_id'=> $brief_module_id,
            'user_id'=> $this->session->userdata('front_user_id'),
            'pre_preparation_b_status'=>@$_REQUEST['report_pre_preparation_b_status'],
            'pre_preparation_excel'=> $reportPrePreparation,
            'pre_preparation_follow_up_date'=>@$_REQUEST['report_pre_preparation_follow_up_date'],
            'iInterim_excel'=> $reportiInterim,
            'iInterim_follow_up_date' => @$_REQUEST['report_iInterim_follow_up_date'],
            'iInterim_b_status'=>@$_REQUEST['report_iInterim_b_status'],
            'final_b_status'=>@$_REQUEST['report_final_b_status'],
            'final_follow_up_date'=>@$_REQUEST['report_final_follow_up_date'],
            'final_excel'=> $reportFinalExcel,
            'ip_address' => $_SERVER['REMOTE_ADDR'],
'status' => 'Active'
        );
        $this->Front_model->insertData('brief_reporting', $data5);

        /* -----------------------------------------Project Management-----------------------------------------*/
        if(!empty($_FILES['beneficiary_import']['name'])) {
            $filename = $_FILES["beneficiary_import"]["tmp_name"];
            if (($handle = fopen($filename, "r")) !== FALSE) {
                $row = 0;
                while (($dataChk = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $row++;
                    if ($row > 1) {
                        if (empty($dataChk[1])) {
                            $this->session->set_flashdata('msg', '<font class="msg_red">Year can not be empty in line ' . $row . '!</font>');
                            redirect(base_url() . 'project-management/' . $brief_module_id, 'refresh');
                            exit;
                        }
                        if (empty($dataChk[2])) {
                            $this->session->set_flashdata('msg', '<font class="msg_red">Month can not be empty in line ' . $row . '!</font>');
                            redirect(base_url() . 'project-management/' . $brief_module_id, 'refresh');
                            exit;
                        }
                        if (empty($dataChk[3])) {
                            $this->session->set_flashdata('msg', '<font class="msg_red">Projected impact can not be empty in line ' . $row . '!</font>');
                            redirect(base_url() . 'project-management/' . $brief_module_id, 'refresh');
                            exit;
                        }
                        if (empty($dataChk[4])) {
                            $this->session->set_flashdata('msg', '<font class="msg_red">Actual impact can not be empty in line ' . $row . '!</font>');
                            redirect(base_url() . 'project-management/' . $brief_module_id, 'refresh');
                            exit;
                        }
                    }
                }
                fclose($handle);
            }
            if (($handle = fopen($filename, "r")) !== FALSE) {
                $row1 = 0;
            while (($getData = fgetcsv($handle, 10000, ",")) !== FALSE) {
                $row1++;
                if ($row1 > 1) {

                    $data2 = array(
                        'brief_module_id' => $brief_module_id,
                        'user_id' => $this->session->userdata('front_user_id'),
                        'year' => $getData[1],
                        'month' => $getData[2],
                        'projected_impact' => $getData[3],
                        'actual_impact' => $getData[4],
                        'b_status' => 'WIP',
                        'created_at' => date('y-m-d h:i:s'),
                        'ip_address' => $_SERVER['REMOTE_ADDR']
                    );
                    $this->Front_model->insertData('benificary_impact', $data2);
                }
            }
            fclose($handle);
        }
        }else{
            if(!empty($management))
                $_FILES['beneficiary_import']['name']= $management[0]['beneficiary_import'];
            else
                $_FILES['beneficiary_import']['name'] ='';
        }

        if(!empty($_FILES['project_assessment']['name'])) {
            $filename2=$_FILES["project_assessment"]["tmp_name"];

            if (($handle = fopen($filename2, "r")) !== FALSE) {
                $row = 0;
                while (($dataChk = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $row++;
                    if ($row > 1) {
                        if (empty($dataChk[1])) {
                            $this->session->set_flashdata('msg', '<font class="msg_red">Programs can not be empty in line ' . $row . '!</font>');
                            redirect(base_url() . 'project-management/' . $brief_module_id, 'refresh');
                            exit;
                        }
                        if (empty($dataChk[2])) {
                            $this->session->set_flashdata('msg', '<font class="msg_red">Activity can not be empty in line ' . $row . '!</font>');
                            redirect(base_url() . 'project-management/' . $brief_module_id, 'refresh');
                            exit;
                        }
                    }
                }
                fclose($handle);
            }
            if (($handle = fopen($filename2, "r")) !== FALSE) {
                $row1 = 0;
                while (($getData = fgetcsv($handle, 10000, ",")) !== FALSE) {
                    $row1++;
                    if ($row1 > 1) {
                        $data22 = array(
                            'brief_module_id' => $brief_module_id,
                            'user_id' => $this->session->userdata('front_user_id'),
                            'programs' => $getData[1],
                            'activity' => $getData[2],
                            'jan' => $getData[3],
                            'feb' => $getData[4],
                            'mar' => $getData[5],
                            'apr' => $getData[6],
                            'may' => $getData[7],
                            'jun' => $getData[8],
                            'jul' => $getData[9],
                            'aug' => $getData[10],
                            'sep' => $getData[11],
                            'oct' => $getData[12],
                            'nov' => $getData[13],
                            'decem' => $getData[14],
                            'b_status' => 'Completed',
                            'created_at' => date('y-m-d h:i:s'),
                            'ip_address' => $_SERVER['REMOTE_ADDR'],
'status' => 'Active'
                        );
                        $this->Front_model->insertData('project_assessment', $data22);
                    }
                }
                fclose($handle);
            }
        }else{
            if(!empty($management))
                $_FILES['project_assessment']['name'] = $management[0]['project_assessment'];
            else
                $_FILES['project_assessment']['name'] ='';
        }

        $data6 = array(
            'brief_module_id'=> $brief_module_id,
            'user_id'=> $this->session->userdata('front_user_id'),
            'beneficiary_import'=> $_FILES['beneficiary_import']['name'],
            'set_reminder'=>@$_REQUEST['set_reminder'],
            'project_assessment'=> $_FILES['project_assessment']['name'],
            'ip_address' => $_SERVER['REMOTE_ADDR']
        );
        $this->Front_model->insertData('project_management', $data6);

        redirect(base_url().'project-management/'.$brief_module_id, 'refresh');exit;
    }


    public function ngoExcelExport()
    {
        $brief_module_id = $this->uri->segment(2);
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=ngo-excel.csv');
        $output = fopen("php://output", "w");

        $label[] = "S.No";
        $label[] = "NGO";
        $label[] = "Sectors working in";
        $label[] = "State";
        $label[] = "City";
        $label[] = "Type of NGO";
        $label[] = "Unique Id of VO/NGO";
        $label[] = "Registration No";
        $label[] = "Date of Establishment/Registration";
        $label[] = "License Renewal";
        $label[] = "Address";
        $label[] = "Contact person";
        $label[] = "Mobile No";
        $label[] = "Telephone";
        $label[] = "E-mail";
        $label[] = "Operational Area-States";
        $label[] = "Operational Area-City/District";
        $label[] = "Major Activities/Achievements";
        $label[] = "Ranking from Website";
        $label[] = "Annual Turnover";
        $label[] = "USP";
        $label[] = "Registration Certificate";
        $label[] = "Number of years of exp.";
        $label[] = "Audit";
        $label[] = "Brands";
        $label[] = "Trustees";
        $label[] = "Ranking Of NGO";
        $label[] = "Legal Compliance";
        $label[] = "Sustainability Index";
        $label[] = "Measurable Results";
        $label[] = "Long Term Impact";
        $label[] = "Scalability";
        $label[] = "Government of NGO";


        fputcsv($output, $label);

        $partnerIdentifications = $this->Front_model->getDataLast2('partner_identifications', 'status', 'Active', 'partner_identification_id');
//print_r($partnerIdentifications);die;
        $partnerIds = explode(',',$partnerIdentifications[0]['ngo_ids']);
        if($partnerIdentifications[0]['legal_compliance'] == 1){
            $legal_compliance ='Yes';
        }else{
            $legal_compliance ='No';
        }

        if($partnerIdentifications[0]['sustainability_index'] == 1){
            $sustainability_index ='Yes';
        }else{
            $sustainability_index ='No';
        }

        if($partnerIdentifications[0]['measurable_results'] == 1){
            $measurable_results ='Yes';
        }else{
            $measurable_results ='No';
        }

        if($partnerIdentifications[0]['long_impact'] == 1){
            $long_impact ='Yes';
        }else{
            $long_impact ='No';
        }
        if($partnerIdentifications[0]['scalability'] == 1){
            $scalability ='Yes';
        }else{
            $scalability ='No';
        }
        if($partnerIdentifications[0]['government_ngo'] == 1){
            $government_ngo ='Yes';
        }else{
            $government_ngo ='No';
        }
        foreach ($partnerIds as $partnerId){
            $ngo = $this->Front_model->getDataC('m_ngo', 'ngo_id',$partnerId);
            $arr = "";
            @++$i;
            $id = $ngo[0]['ngo_id'];
            $title = $ngo[0]['title'];
            foreach (explode(',',$ngo[0]['sector_id']) as $sector){

                $checkSectors =$this->Front_model->getData('m_sectors','sector_id',$sector);
                $sectors[]= $checkSectors[0]['title'];
            }
            $sector_id = implode(',',$sectors);

            $checkState =$this->Front_model->getData('states','state_id',$ngo[0]['state']);
            $checkCity =$this->Front_model->getData('cities','city_id',$ngo[0]['city']);
            $state= $checkState[0]['title'];
            $city= $checkCity[0]['title'];
            $ngo_type = $ngo[0]['ngo_type'];
            $unique_id = $ngo[0]['unique_id'];
            $registeration_no = $ngo[0]['registeration_no'];
            $registeration_date = date('Y-m-d',strtotime($ngo[0]['registeration_date']));
            $licence_renew = $ngo[0]['licence_renew'];
            $address = $ngo[0]['address'];
            $contact_person = $ngo[0]['contact_person'];
            $mobile = $ngo[0]['mobile'];
            $phone = $ngo[0]['phone'];
            $email = $ngo[0]['email'];
            $operational_area_city = $ngo[0]['operational_area_city'];
            $operational_area_state = $ngo[0]['operational_area_state'];
            $activity = $ngo[0]['activity'];
            $ranking_f_website = $ngo[0]['ranking_f_website'];
            $annual_turnover = $ngo[0]['annual_turnover'];
            $usp = $ngo[0]['usp'];
            $registeration_certificate = $ngo[0]['registeration_certificate'];
            $experience = $ngo[0]['experience'];
            $audit = $ngo[0]['audit'];
            $brand = $ngo[0]['brand'];
            $trustee = $ngo[0]['trustee'];
            $ngo_ranking = $ngo[0]['ngo_ranking'];

            unset($sectors);
            fputcsv($output, array($i,$title,$sector_id,$state,$city,$ngo_type,$unique_id,$registeration_no,
                $registeration_date,$licence_renew,$address,$contact_person,$mobile,$phone,$email,$operational_area_city,
                $operational_area_state,$activity,$ranking_f_website,$annual_turnover,$usp,$registeration_certificate,
                $experience,$audit,$brand,$trustee,$ngo_ranking,$legal_compliance,$sustainability_index,$measurable_results,$long_impact,$scalability,$government_ngo ));
        }


        redirect(base_url().'project-management/'.$brief_module_id, 'refresh');exit;
    }

}
