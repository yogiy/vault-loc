<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProjectDevelopment extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('front/Front_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
        $this->load->library('email');
    }


    public function projectDevelopment()
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
		
        $data["plannings"]      = $this->Front_model->searchProjectDevelopmentData();
        $data['admin_folder']    = "False";
        $data["results"]         = "True";

        $data['title']			 = 'Project Development';
        $data['keyword']       	 = 'Project Development';
        $data['description']     = 'Project Development';
        $data['breadcrumb']      = 'Project Development';
        $data['page_name']       = 'page/projectDevelopment';
        $this->load->view('index',$data);
    }

    public function searchProjectDevelopment()
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

        if(!empty($pdid) ||!empty($zone_id) ||!empty($client_id) ||!empty($state_id) ||!empty($brand_id) ||!empty($status)) {
            $data = array('pDpdid' => $pdid,'pDzone_id' => $zone_id,'pDclient_id' => $client_id,'pDstate_id' => $state_id,'pDbrand_id' => $brand_id,'pDstatus' => $status,'pDplnSess'=>'True');
            $this->session->set_userdata($data);
        }
        redirect(base_url().'project-development', 'refresh');exit;
        exit;
    }

    public function unsetProjectDevelopment()
    {
        if ($this->session->userdata('front_user_logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
        $this->session->unset_userdata('pDpdid');
        $this->session->unset_userdata('pDzone_id');
        $this->session->unset_userdata('pDclient_id');
        $this->session->unset_userdata('pDstate_id');
        $this->session->unset_userdata('pDbrand_id');
        $this->session->unset_userdata('pDstatus');
        $this->session->unset_userdata('pDplnSess');
        redirect(base_url().'project-development', 'refresh');exit;
        exit;
    }


    public function projectDevelopmentForm()
    {
        if ($this->session->userdata('front_user_id') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $data['admin_folder']  = "False";
        $data['brief_id']    =   $this->uri->segment(2);
        $data['briefs']   =   $this->Front_model->getData('brief_modules', 'brief_module_id', $this->uri->segment(2));

        $data['client'] = $this->Front_model->getData('users', 'user_id', $data['briefs'][0]['client_id']);
        $data['ideations'] = $this->Front_model->getDataDesc('project_development', 'brief_module_id', $data['brief_id'],'project_development_id');
        $data['feedbacks'] = $this->Front_model->getDataDesc('brief_feedback', 'brief_module_id', $data['brief_id'],'brief_feedback_id');
        if(!empty( $data['briefs'][0]['metro_id']) &&  $data['briefs'][0]['metro_id'] != 0)
        {
            $data['market'] = $this->Front_model->getData('m_market', 'tier_town', $data['briefs'][0]['metro_id']);
            if(!empty( $data['market']))
            {$data['zone'] = $this->Front_model->getData('m_zones', 'zone_id', $data['market'][0]['zone']);
                $data['state'] = $this->Front_model->getData('states', 'state_id', $data['market'][0]['state']);
            }else{
                $data['market'] = array('title'=>'N/A');
                $data['zone'] = array('title'=>'N/A');
                $data['state'] = array('title'=>'N/A');

            }
        }
        else{
            $data['market'] = array('title'=>'N/A');
            $data['zone'] = array('title'=>'N/A');
            $data['state'] = array('title'=>'N/A');

        }

        $data['brands'] = $this->Front_model->getData('m_brands', 'brand_id', $data['briefs'][0]['brand_id']);

        $data["results"]         = "True";
        $data['title']			 = 'Project Development';
        $data['keyword']       	 = 'Project Development';
        $data['description']     = 'Project Development';
        $data['breadcrumb']      = 'Project Development';
        $data['page_name']       = 'page/projectDevelopmentForm';
        $this->load->view('index',$data);
    }

    public function projectDevelopmentStore()
    {
        $brief_module_id = $this->uri->segment(2);
        $briefs       =   $this->Front_model->getData('brief_modules', 'brief_module_id',$brief_module_id);

        $assisted_by = $this->Front_model->getDataIn('users', 'user_id',$briefs[0]['assisted_by_id']);
        $team_assigned= $this->Front_model->getDataIn('users', 'user_id',$briefs[0]['team_assigned_id']);
        unset($email);unset($email2);
        foreach ($assisted_by as $assisted) {
            $email[] = $assisted['email'];
            $email_user = implode(",", $email);
        }
        foreach ($team_assigned as $team) {
            $email2[] = $team['email'];
            $email_user2 = implode(",", $email2);
        }
       $client= $this->Front_model->getData('users', 'user_id', $briefs[0]['client_id']);
        $brands = $this->Front_model->getData('m_brands', 'brand_id', $briefs[0]['brand_id']);
        $ideations = $this->Front_model->getDataDesc('project_development', 'brief_module_id', $brief_module_id,'project_development_id');

        if(!empty($_FILES['ideation_stage']['name'])) {
            $ideaStageName = $_FILES['ideation_stage']['name'];
            $ideaStageExp  = explode('.', $ideaStageName);
            $ideaStageext  = $ideaStageExp[count($ideaStageExp)-1];
            $ideaStageNm	  = $ideaStageExp[count($ideaStageExp)-2];
                $ideaStage = time()."-".$ideaStageNm.".".$ideaStageext;
                $ideaStagePath = "./uploads/projectDevelopment/".$ideaStageName;
                move_uploaded_file($_FILES['ideation_stage']['tmp_name'], $ideaStagePath);
                @rename("./uploads/projectDevelopment/".$ideaStageName, "./uploads/projectDevelopment/".$ideaStage);

        }else{
            if(!empty($ideations))
                $ideaStage = $ideations[0]['ideation_stage'];
            else
                $ideaStage ='';
        }

        $app_url = base_url().'uploads/projectDevelopment/'.$ideaStage;

        if(empty($_REQUEST['mail_send'])) {
            $_REQUEST['mail_send'] = 0;
        }
        else{
            // print_r($ideaStagePath);die;
            /******************Email mail funtion *******************/
            $name = $client[0]['fname'].' '.$client[0]['lname'];
            $to = $_REQUEST['client_name'].','.$email_user.','.$email_user2;
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
													<div class="logo" style="padding:5px;text-align:center;background: #39bdc9;color: #fff; ">
															<h1>Vault Application</h1>
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
															<p>you have receive a new email attachment. <a class="btn btn-warning btn-sm" href="'.$app_url.'">Click here </a> to view and download.</p>
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
            $subject  = $briefs[0]['title'].' | '.$brands[0]['title'].' | '.$name;
            $from 	  = 'Vault Application <info@finance.productionserver.co.in>';
            // To send HTML mail, the Content-type header must be set
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            // Create email headers
            $headers .= 'From: '.$from."\r\n".
                'X-Mailer: PHP/' . phpversion();
            @mail($to, $subject, $message, $headers);
        }

        $data = array(
            'ideation_stage' =>$ideaStage,
            'brief_module_id'=> $brief_module_id,
            'follow_up_date'=>@$_REQUEST['follow_up_date'],
            'concept'=>@$_REQUEST['concept'],
            'outline'=>@$_REQUEST['outline'],
            'direction'=>@$_REQUEST['direction'],
            'establish'=>@$_REQUEST['establish'],
            'mail_send'=>@$_REQUEST['mail_send'],
            'mail_id'=>@$_REQUEST['client_name'],
            'b_status'=>@$_REQUEST['status'],
            'ip_address' => $_SERVER['REMOTE_ADDR']
        );
        $this->Front_model->insertData('project_development', $data);
        redirect(base_url().'project-development/'.$brief_module_id, 'refresh');exit;
    }

    public function projectDevelopmentUpdate()
    {
        $brief_module_id = $this->uri->segment(2);
        $project_development_id= $this->uri->segment(3);
        $briefs       =   $this->Front_model->getData('brief_modules', 'brief_module_id',$brief_module_id);
        $assisted_by = $this->Front_model->getDataIn('users', 'user_id',$briefs[0]['assisted_by_id']);
        $team_assigned= $this->Front_model->getDataIn('users', 'user_id',$briefs[0]['team_assigned_id']);
        unset($email);unset($email2);
        foreach ($assisted_by as $assisted) {
            $email[] = $assisted['email'];
            $email_user = implode(",", $email);
        }
        foreach ($team_assigned as $team) {
            $email2[] = $team['email'];
            $email_user2 = implode(",", $email2);
        }
        $client= $this->Front_model->getData('users', 'user_id', $briefs[0]['client_id']);
        $brands = $this->Front_model->getData('m_brands', 'brand_id', $briefs[0]['brand_id']);
        $ideations = $this->Front_model->getDataDesc('project_development', 'brief_module_id', $brief_module_id,'project_development_id');
        $reworks = $this->Front_model->getDataDesc('brief_rework', 'brief_module_id', $brief_module_id,'brief_rework_id');
        $mous = $this->Front_model->getDataDesc('brief_mou', 'brief_module_id', $brief_module_id,'brief_mou_id');

        if(!empty($_FILES['ideation_stage']['name'])) {
            $ideaStageName = $_FILES['ideation_stage']['name'];
            $ideaStageExp  = explode('.', $ideaStageName);
            $ideaStageext  = $ideaStageExp[count($ideaStageExp)-1];
            $ideaStageNm	  = $ideaStageExp[count($ideaStageExp)-2];
                $ideaStage = time()."-".$ideaStageNm.".".$ideaStageext;
                $ideaStagePath = "./uploads/projectDevelopment/".$ideaStageName;
                move_uploaded_file($_FILES['ideation_stage']['tmp_name'], $ideaStagePath);
                @rename("./uploads/projectDevelopment/".$ideaStageName, "./uploads/projectDevelopment/".$ideaStage);

        }else{
            if(!empty($ideations))
                $ideaStage = $ideations[0]['ideation_stage'];
            else
                $ideaStage ='';
        }

        $app_url = base_url().'uploads/projectDevelopment/'.$ideaStage;

        if(empty($_REQUEST['mail_send'])) {
            $_REQUEST['mail_send'] = 0;
        }
        else{
            // print_r($ideaStagePath);die;
            /******************Email mail funtion *******************/
            $name = $client[0]['fname'].' '.$client[0]['lname'];
            $to = $_REQUEST['client_name'].','.$email_user.','.$email_user2;
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
															<p>you have receive a new email attachment. <a class="btn btn-primary" href="'.$app_url.'">Click here </a> to download.</p>
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
            $subject  = $briefs[0]['title'].' | '.$brands[0]['title'].' | '.$name;
            $from 	  = 'Vault Application <info@finance.productionserver.co.in>';
            // To send HTML mail, the Content-type header must be set
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            // Create email headers
            $headers .= 'From: '.$from."\r\n".
                'X-Mailer: PHP/' . phpversion();
            @mail($to, $subject, $message, $headers);
        }


        $data = array(
            'ideation_stage' =>$ideaStage,
            'brief_module_id'=> $brief_module_id,
            'follow_up_date'=>@$_REQUEST['follow_up_date'],
            'concept'=>@$_REQUEST['concept'],
            'outline'=>@$_REQUEST['outline'],
            'direction'=>@$_REQUEST['direction'],
            'establish'=>@$_REQUEST['establish'],
            'mail_send'=>@$_REQUEST['mail_send'],
            'mail_id'=>@$_REQUEST['client_name'],
            'b_status'=>@$_REQUEST['status'],
            'ip_address' => $_SERVER['REMOTE_ADDR']
        );

        $this->Front_model->updateData('project_development',$data,'project_development_id',$project_development_id );

        /* -----------------------------------------Feedback-----------------------------------------*/
        if(!empty($_REQUEST['feedback_b_status'])) {
            $feedback = $this->Front_model->getDataDesc('brief_feedback', 'brief_module_id', $brief_module_id,'brief_feedback_id');
            $data4 = array(
                'brief_module_id'=> $brief_module_id,
                'b_status'=>@$_REQUEST['feedback_b_status'],
                'ip_address' => $_SERVER['REMOTE_ADDR']
            );
            if(!empty($feedback))
                $this->Front_model->updateData('brief_feedback',$data4,'brief_feedback_id',$feedback[0]['brief_feedback_id'] );
            else
                $this->Front_model->insertData(' brief_feedback', $data4);

        }
        /* -----------------------------------------Rework-----------------------------------------*/
        if(!empty($_REQUEST['rework_excel']) || !empty($_REQUEST['rework_follow_up_date'])
            || !empty($_REQUEST['rework_mail_send']) || !empty($_REQUEST['rework_b_status'])) {

            if(!empty($_FILES['rework_excel']['name'])) {
                $reworkName = $_FILES['rework_excel']['name'];
                $reworkExp  = explode('.', $reworkName);
                $reworkExt  = $reworkExp[count($reworkExp)-1];
                $reworkNm	  = $reworkExp[count($reworkExp)-2];
                    $rework = time()."-".$reworkNm.".".$reworkExt;
                    $reworkPath = "./uploads/briefRework/".$reworkName;
                    move_uploaded_file($_FILES['rework_excel']['tmp_name'], $reworkPath);
                    @rename("./uploads/briefRework/".$reworkName, "./uploads/briefRework/".$rework);

            }else{
                if(!empty($reworks))
                    $rework = $reworks[0]['rework'];
                else
                    $rework ='';
            }
            if(empty($_REQUEST['rework_mail_send'])) {
                $_REQUEST['rework_mail_send'] = 0;
            }
            else{
                $rework_url = base_url().'uploads/briefRework/'.$rework;
                // print_r($ideaStagePath);die;
                /******************Email mail funtion *******************/
                $name = $client[0]['fname'].' '.$client[0]['lname'];
                $to = $_REQUEST['rework_client_name'].','.$email_user.','.$email_user2;
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
															<p>you have receive a new email attachment of rework. <a class="btn btn-primary" href="'.$rework_url.'">Click here </a> to download.</p>
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
                $subject  = 'Rework |'.$briefs[0]['title'].' | '.$brands[0]['title'].' | '.$name;
                $from 	  = 'Vault Application <info@finance.productionserver.co.in>';
                // To send HTML mail, the Content-type header must be set
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                // Create email headers
                $headers .= 'From: '.$from."\r\n".
                    'X-Mailer: PHP/' . phpversion();
                @mail($to, $subject, $message, $headers);
            }

            if(empty($_REQUEST['rework_b_status'])) {
                $_REQUEST['rework_b_status'] = 'WIP';
            }

            $data2 = array(
                'brief_module_id'=> $brief_module_id,
                'follow_up_date'=>@$_REQUEST['rework_follow_up_date'],
                'mail_send'=>@$_REQUEST['rework_mail_send'],
                'mail_id'=>@$_REQUEST['rework_client_name'],
                'b_status'=>@$_REQUEST['rework_b_status'],
                'rework'=> $rework,
                'ip_address' => $_SERVER['REMOTE_ADDR']
            );
            $this->Front_model->insertData('brief_rework', $data2);

        }

        /* -----------------------------------------Mou-----------------------------------------*/
        if(!empty($_REQUEST['mou_excel']) || !empty($_REQUEST['receipt_date']) || !empty($_REQUEST['mou_b_status']) || !empty($_REQUEST['mou_budget'])) {
            if(!empty($_FILES['mou_excel']['name'])) {
                $mouName = $_FILES['mou_excel']['name'];
                $mouExp  = explode('.', $mouName);
                $mouExt  = $mouExp[count($mouExp)-1];
                $mouNm	  = $mouExp[count($mouExp)-2];
                    $mou = time()."-".$mouNm.".".$mouExt;
                    $mouPath = "./uploads/briefMou/".$mouName;
                    move_uploaded_file($_FILES['mou_excel']['tmp_name'], $mouPath);
                    @rename("./uploads/briefMou/".$mouName, "./uploads/briefMou/".$mou);

            }else{
                if(!empty($mous))
                    $mou = $mous[0]['mou'];
                else
                    $mou ='';
            }
            if(empty($_REQUEST['mou_budget'])) {
                $_REQUEST['mou_budget'] = 0;
            }
            if(empty($_REQUEST['receipt_date'])) {
                $_REQUEST['receipt_date'] = date('y-m-d');
            }
            if(empty($_REQUEST['mou_b_status'])) {
                $_REQUEST['mou_b_status'] = 'WIP';
            }
            $data3 = array(
                'brief_module_id'=> $brief_module_id,
                'receipt_date'=>@$_REQUEST['receipt_date'],
                'b_status'=>@$_REQUEST['mou_b_status'],
                'budget'=>@$_REQUEST['mou_budget'],
                'mou'=> $mou,
                'ip_address' => $_SERVER['REMOTE_ADDR']
            );
            $this->Front_model->insertData('brief_mou', $data3);

        }
        redirect(base_url().'project-development/'.$brief_module_id, 'refresh');exit;
    }


    public function projectDevelopmentFeedback()
    {
        $brief_module_id = $this->uri->segment(2);
        $briefs     =   $this->Front_model->getData('brief_modules', 'brief_module_id', $this->uri->segment(2));
        $briefs       =   $this->Front_model->getData('brief_modules', 'brief_module_id',$brief_module_id);
        $assisted_by = $this->Front_model->getDataIn('users', 'user_id',$briefs[0]['assisted_by_id']);
        $team_assigned= $this->Front_model->getDataIn('users', 'user_id',$briefs[0]['team_assigned_id']);
        unset($email);unset($email2);
        foreach ($assisted_by as $assisted) {
            $email[] = $assisted['email'];
            $email_user = implode(",", $email);
        }
        foreach ($team_assigned as $team) {
            $email2[] = $team['email'];
            $email_user2 = implode(",", $email2);
        }

        $data = array(
            'brief_module_id'=> $brief_module_id,
            'feedback'=>$_REQUEST['feedback'],
            'b_status'=>'WIP',
            'ip_address' => $_SERVER['REMOTE_ADDR']
        );
        $this->Front_model->insertData('brief_feedback', $data);
            /******************Email mail funtion *******************/
             $to = $email_user.','.$email_user2;
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
															<td colspan="2" style="font-size: 18px;font-weight: 700;color:#53566b">Dear Team,</td>
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
															<td style="font-size: 14px;font-weight: lighter;color:#53566b; padding-bottom: 10px;" width="50%">Feedback: </td>
															<td style="font-size: 14px;font-weight: lighter;color:#53566b; padding-bottom: 10px;" width="50%">'.$_REQUEST['feedback'].'</td>
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
            $subject  = $briefs[0]['title'];
            $from 	  = 'Vault Application <info@finance.productionserver.co.in>';
            // To send HTML mail, the Content-type header must be set
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            // Create email headers
            $headers .= 'From: '.$from."\r\n".
                'X-Mailer: PHP/' . phpversion();
            @mail($to, $subject, $message, $headers);

        redirect(base_url().'project-development/'.$brief_module_id, 'refresh');exit;
    }

}
