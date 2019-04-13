<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BriefModule extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->model('front/Front_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('pagination');
		$this->load->library('email');
	}
	
	public function briefModule()
	{
		if ($this->session->userdata('front_user_logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
		$data["clients"]        = $this->Front_model->getDataAsc('users', 'role_id', 5, 'fname');
		$data["brands"]     	= $this->Front_model->getDataAsc('m_brands', 'status', 'Active', 'title');
		$data["categories"]     = $this->Front_model->getDataAsc('m_categories', 'status', 'Active', 'title');
		//$data["teams"]     	= $this->Front_model->getDataAsc('m_teams', 'status', 'Active', 'title');
		$data["roles"]     		= $this->Front_model->getData2InAsc('roles ', 'status', 'Active', 'role_id', '3,4,6,7', 'title');
		$data["assistedBy"]     = $this->Front_model->getDataAsc('m_assisted_by', 'status', 'Active', 'title');
		
		$data["metros"]     	= $this->Front_model->getDataAsc('m_market', 'tier_town', 1, 'title');
		$data["tier1"]     		= $this->Front_model->getDataAsc('m_market', 'tier_town', 2, 'title');
		$data["tier2"]     		= $this->Front_model->getDataAsc('m_market', 'tier_town', 3, 'title');
		$data["tier3"]     		= $this->Front_model->getDataAsc('m_market', 'tier_town', 4, 'title');
		$data["tier4"]     		= $this->Front_model->getDataAsc('m_market', 'tier_town', 5, 'title');
		
		// $data["themes"]  		= $this->Front_model->getDataNot('thematic_areas', 'parent', 0, 'title');
		$data['thematic_areas'] 	= $this->Front_model->getData('loc_thematic_areas', 'parent_id', 0);
		
		$data['admin_folder']    = "False";
        $data["results"]         = "True";
		
        $data['title']			 = 'Brief Module';
        $data['keyword']       	 = 'Brief Module';
        $data['description']     = 'Brief Module';
        $data['breadcrumb']      = 'Brief Module';
        $data['page_name']       = 'page/briefModule';
        $this->load->view('index',$data);
	}

	public function getSubDataList()
    {
		$this->load->model('front/Loc_modal');
        if ($this->input->post('inObj')) {
            echo $this->Loc_modal->getSubThematicAreas($this->input->post('inObj'));
        }
	}
	
	public function getMicroDataList()
    {
		$this->load->model('front/Loc_modal');
        if ($this->input->post('inObj')) {
            echo $this->Loc_modal->getMicroThematicAreas($this->input->post('inObj'));
        }
    }
	
	public function briefModuleUp()
	{
		if ($this->session->userdata('front_user_logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
		$user_id 					= $this->session->userdata('front_user_id');
		$client_id 					= $_REQUEST['client_id'];
		$brand_id 					= $_REQUEST['brand_id'];
		$category_id 				= $_REQUEST['category_id'];
		$project_name 				= $_REQUEST['project_name'];
		$theme_id 					= $_REQUEST['theme_id'];
		$sub_theme_id 				= $_REQUEST['sub_theme_id'];
		$micro_theme_id 			= $_REQUEST['micro_theme_id'];
		$project_duration_from 		= date('Y-m-d',strtotime($_REQUEST['project_duration_from']));
		$project_duration_to 		= date('Y-m-d',strtotime($_REQUEST['project_duration_to']));
		$team_id 					= implode(',', $_REQUEST['team_id']);
		$assisted_by_id 			= implode(',', $_REQUEST['assisted_by_id']);
		$budget 					= $_REQUEST['budget'];
		
		$operational_deadline 		= date('Y-m-d',strtotime($_REQUEST['operational_deadline']));
		$client_submission_deadline = date('Y-m-d',strtotime($_REQUEST['client_submission_deadline']));
		$notes 						= $_REQUEST['notes'];
		$created_at					= date('Y-m-d');
		
		if(empty($client_id))
		{
			$this->session->set_flashdata('msg', '<font class="msg_red">Client can\'t be empty.</font>');
			redirect(base_url().'brief-module', 'refresh');exit;
		}
		
		if(empty($brand_id))
		{
			$this->session->set_flashdata('msg', '<font class="msg_red">Brand can\'t be empty.</font>');
			redirect(base_url().'brief-module', 'refresh');exit;
		}
		
		if(empty($category_id))
		{
			$this->session->set_flashdata('msg', '<font class="msg_red">Category can\'t be empty.</font>');
			redirect(base_url().'brief-module', 'refresh');exit;
		}
		
		$dataCheck = $this->Front_model->getData2('brief_modules', 'title', $_REQUEST['project_name'], 'client_id', $_REQUEST['client_id']);
        if (count($dataCheck) > 0) 
		{
			$this->session->set_flashdata('msg', '<font class="msg_red"><strong>Error! </strong>This project name is already taken, Please choose another.</font>');
			redirect(base_url().'brief-module', 'refresh');exit;
            exit;
        }
		
		/*if(!empty($_FILES['filename']['name']))
		{
			if(!empty($_FILES['filename']['name']))
			{   
				$img1Name = $_FILES['filename']['name'];
				$img1Exp  = explode('.', $img1Name);
				$img1ext  = $img1Exp[count($img1Exp)-1];
				$img1Nm	  = $img1Exp[count($img1Exp)-2];
				if($img1ext=='xlsx' || $img1ext=='csv')
				{
					//@unlink("./uploads/briefModule/".$_REQUEST['filename']);
					$filename = time()."-".$img1Nm.".".$img1ext;
					$img1Path = "./uploads/briefModule/".$img1Name;
					$iimg1mv  = move_uploaded_file($_FILES['filename']['tmp_name'], $img1Path);
					@rename("./uploads/briefModule/".$img1Name, "./uploads/briefModule/".$filename);
				}
				else
				{
					$this->session->set_flashdata('msg', '<font class="msg_red">Wrong File format for Image!</font>');
					redirect(base_url().'brief-module', 'refresh');exit;
				}
			}
		}*/
		
		/*******************Read data from csv****************************/
		$filename = $_FILES["filename"]["tmp_name"];
        if(!empty($filename)) 
		{
			/****************Make market master Array for checking state exist or not****************/
			$metros = $this->Front_model->getDataAsc('m_market', 'tier_town', 1, 'title');
			$tier1  = $this->Front_model->getDataAsc('m_market', 'tier_town', 2, 'title');
			$tier2  = $this->Front_model->getDataAsc('m_market', 'tier_town', 3, 'title');
			$tier3  = $this->Front_model->getDataAsc('m_market', 'tier_town', 4, 'title');
			$tier4  = $this->Front_model->getDataAsc('m_market', 'tier_town', 5, 'title');
			
			unset($metrosMasterArr);
			foreach($metros as $metro)
			{ $metrosMasterArr[] = $metro['title']; }
			
			unset($tier1MasterArr);
			foreach($tier1 as $t1)
			{ $tier1MasterArr[] = $t1['title']; }
			
			unset($tier2MasterArr);
			foreach($tier2 as $t2)
			{ $tier2MasterArr[] = $t2['title']; }
			
			unset($tier3MasterArr);
			foreach($tier3 as $t3)
			{ $tier3MasterArr[] = $t3['title']; }
			
			unset($tier4MasterArr);
			foreach($tier4 as $t4)
			{ $tier4MasterArr[] = $t4['title']; }
			/**************************************End*********************************************/
			
			if(($handle = fopen($filename, "r")) !== FALSE) 
			{
				$row = 0;
				unset($metrosFileArr);
				unset($tier1FileArr);
				unset($tier2FileArr);
				unset($tier3FileArr);
				unset($tier4FileArr);
				while (($dataArr = fgetcsv($handle, 1000, ",")) !== FALSE)
				{
					$row++;
					if($row > 1) 
					{
						if(!empty($dataArr[0])){ $metrosFileArr[]	= $dataArr[0]; }
						if(!empty($dataArr[1])){ $tier1FileArr[]	= $dataArr[1]; }
						if(!empty($dataArr[2])){ $tier2FileArr[]	= $dataArr[2]; }
						if(!empty($dataArr[3])){ $tier3FileArr[]	= $dataArr[3]; }
						if(!empty($dataArr[4])){ $tier4FileArr[]	= $dataArr[4]; }
					}
				}
				fclose($handle);
			}
			
			$i = 1;
			foreach($metrosFileArr as $metrochk)
			{
				++$i;
				if(!in_array($metrochk, $metrosMasterArr))
				{ 
					$this->session->set_flashdata('msg', '<font class="msg_red">Metros are not found in masters, in line '.$i.'.</font>');
					redirect(base_url().'brief-module', 'refresh');exit;
				}
				else
				{
					$mtroId = $this->Front_model->getData('m_market', 'title', $metrochk);
					$metroIds[] = $mtroId[0]['market_id'];
				}
			}
			
			$j = 1;
			foreach($tier1FileArr as $t1chk)
			{
				++$j;
				if(!in_array($t1chk, $tier1MasterArr))
				{ 
					$this->session->set_flashdata('msg', '<font class="msg_red">Tier 1 are not found in masters, in line '.$j.'.</font>');
					redirect(base_url().'brief-module', 'refresh');exit;
				}
				else
				{
					$t1Id = $this->Front_model->getData('m_market', 'title', $t1chk);
					$t1Ids[] = $t1Id[0]['market_id'];
				}
			}
			
			$k = 1;
			foreach($tier2FileArr as $t2chk)
			{
				++$k;
				if(!in_array($t2chk, $tier2MasterArr))
				{ 
					$this->session->set_flashdata('msg', '<font class="msg_red">Tier 2 are not found in masters, in line '.$k.'.</font>');
					redirect(base_url().'brief-module', 'refresh');exit;
				}
				else
				{
					$t2Id = $this->Front_model->getData('m_market', 'title', $t2chk);
					$t2Ids[] = $t2Id[0]['market_id'];
				}
			}
			
			$l = 1;
			foreach($tier3FileArr as $t3chk)
			{
				++$l;
				if(!in_array($t3chk, $tier3MasterArr))
				{ 
					$this->session->set_flashdata('msg', '<font class="msg_red">Tier 3 are not found in masters, in line '.$l.'.</font>');
					redirect(base_url().'brief-module', 'refresh');exit;
				}
				else
				{
					$t3Id = $this->Front_model->getData('m_market', 'title', $t3chk);
					$t3Ids[] = $t3Id[0]['market_id'];
				}
			}
			
			$m = 1;
			foreach($tier4FileArr as $t4chk)
			{
				++$m;
				if(!in_array($t4chk, $tier4MasterArr))
				{ 
					$this->session->set_flashdata('msg', '<font class="msg_red">Tier 4 are not found in masters, in line '.$m.'.</font>');
					redirect(base_url().'brief-module', 'refresh');exit;
				}
				else
				{
					$t4Id = $this->Front_model->getData('m_market', 'title', $t4chk);
					$t4Ids[] = $t4Id[0]['market_id'];
				}
			}
			
			$metro_id 	= implode(',', $metroIds);
			$tier1_id 	= implode(',', $t1Ids);
			$tier2_id 	= implode(',', $t2Ids);
			$tier3_id 	= implode(',', $t3Ids);
			$tier4_id 	= implode(',', $t4Ids);
		}
		else{
			$metro_id 	= implode(',', $_REQUEST['metro_id']);
			$tier1_id 	= implode(',', $_REQUEST['tier1_id']);
			$tier2_id 	= implode(',', $_REQUEST['tier2_id']);
			$tier3_id 	= implode(',', $_REQUEST['tier3_id']);
			$tier4_id 	= implode(',', $_REQUEST['tier4_id']);
		}
		/************************End**********************************/
		
		// $thematicArea = $this->Front_model->getData('thematic_areas', 'thematic_area_id', $theme_id);
		$data = array(
				'user_id' 				 	 => $user_id,
				'client_id' 				 => $client_id,
				'brand_id' 					 => $brand_id,
				'category_id' 				 => $category_id,
				'title' 				 	 => $project_name,
				'thematic_area_id' 			 => $theme_id,
				'theme_id' 				 	 => $theme_id,
				'sub_theme_id' 				 => $sub_theme_id,
				'micro_theme_id' 			 => $micro_theme_id,
				'project_duration_from' 	 => $project_duration_from,
				'project_duration_to' 		 => $project_duration_to,
				'team_assigned_id' 			 => $team_id,
				'assisted_by_id' 			 => $assisted_by_id,
				'budget' 					 => $budget,
				'metro_id' 					 => $metro_id,
				'tier1_id' 					 => $tier1_id,
				'tier2_id' 					 => $tier2_id,
				'tier3_id' 					 => $tier3_id,
				'tier4_id' 					 => $tier4_id,
				'operational_deadline' 		 => $operational_deadline,
				'client_submission_deadline' => $client_submission_deadline,
				'notes' 					 => $notes,
				'filename' 					 => $filename,
				'created_at' 				 => $created_at,
				'ip_address' 				 => $_SERVER['REMOTE_ADDR']
			);
		
		//echo "<pre>"; print_r($data);die;
		$this->Front_model->insertData('brief_modules', $data);
		$briefId =  $this->db->insert_id();
		$this->session->set_userdata(array('popUpShow' => 'True','theme_id' => $theme_id, 'briefId'=>$briefId));
        /******************************Emailer******************************/
		$usrIds = $_REQUEST['assisted_by_id'];
		foreach($usrIds as $usrId)
		{
			$usrDet = $this->Front_model->getData('users', 'user_id', $usrId);
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
																<a href="http://productionserver.co.in/vault/client/login"><img src="'.base_url().'assets/front/images/vault-logo.png" style="width: 150px;" class="logo-vault img-responsive"></a>
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
															<td style="font-size: 14px;font-weight: lighter;color:#53566b; padding-bottom: 10px; width="100%">
															<p>Your are assigned to the project <strong>'.$project_name.'</strong> with PDID:  <strong>'.$briefId.'</strong></p>
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
            $subject  = $project_name;
            $from 	  = 'Vault Application <info@animonlive.com>';
            // To send HTML mail, the Content-type header must be set
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            // Create email headers
            $headers .= 'From: '.$from."\r\n".
                'X-Mailer: PHP/' . phpversion();
            @mail($to, $subject, $message, $headers);
		}
		/*****************************End**********************************/
		
		redirect(base_url().'brief-module', 'refresh');exit;
        exit;
	}
	
	public function editBriefModule()
	{
		if ($this->session->userdata('front_user_logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
		$id = $this->uri->segment(3);
        $single_data = $this->Front_model->getData('brief_modules', 'brief_module_id', $id)[0];
        $data = array('data' => $single_data, 'id' => $id);
		
		$data["clients"]        = $this->Front_model->getDataAsc('users', 'role_id', 5, 'fname');
		$data["brands"]     	= $this->Front_model->getDataAsc('m_brands', 'status', 'Active', 'title');
		$data["categories"]     = $this->Front_model->getDataAsc('m_categories', 'status', 'Active', 'title');
		//$data["teams"]     		= $this->Front_model->getDataAsc('m_teams', 'status', 'Active', 'title');
		$data["roles"]     		= $this->Front_model->getData2InAsc('roles ', 'status', 'Active', 'role_id', '3,4,6,7', 'title');
		$data["assistedBy"]     = $this->Front_model->getDataAsc('m_assisted_by', 'status', 'Active', 'title');
		
		$data["metros"]     	= $this->Front_model->getDataAsc('m_market', 'tier_town', 1, 'title');
		$data["tier1"]     		= $this->Front_model->getDataAsc('m_market', 'tier_town', 2, 'title');
		$data["tier2"]     		= $this->Front_model->getDataAsc('m_market', 'tier_town', 3, 'title');
		$data["tier3"]     		= $this->Front_model->getDataAsc('m_market', 'tier_town', 4, 'title');
		$data["tier4"]     		= $this->Front_model->getDataAsc('m_market', 'tier_town', 5, 'title');
		
		// print_r($single_data);
		// $data["themes"]  		= $this->Front_model->getDataNot('thematic_areas', 'parent', 0, 'title');
		$data['thematic_areas'] 		= $this->Front_model->getData('loc_thematic_areas', 'parent_id', 0);
		$data['sub_thematic_areas'] 	= $this->Front_model->getData('loc_thematic_areas', 'parent_id', $single_data['thematic_area_id']);
		$data['micro_thematic_areas'] 	= $this->Front_model->getData('loc_thematic_areas', 'parent_id', $single_data['sub_theme_id']);
		
		$data['admin_folder']    = "False";
        $data["results"]         = "True";
		
        $data['title']			 = 'Update Brief Module';
        $data['keyword']       	 = 'Update Brief Module';
        $data['description']     = 'Update Brief Module';
        $data['breadcrumb']      = 'Update Brief Module';
        $data['page_name']       = 'page/editBriefModule';
        $this->load->view('index',$data);
	}
	
	public function briefModuleUpdate()
	{
		if ($this->session->userdata('front_user_logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
		$id 						= $_REQUEST['id'];
		$client_id 					= $_REQUEST['client_id'];
		$brand_id 					= $_REQUEST['brand_id'];
		$category_id 				= $_REQUEST['category_id'];
		$project_name 				= $_REQUEST['project_name'];
		$theme_id 					= $_REQUEST['theme_id'];
		$sub_theme_id 				= $_REQUEST['sub_theme_id'];
		$micro_theme_id 			= $_REQUEST['micro_theme_id'];
		$project_duration_from 		= date('Y-m-d',strtotime($_REQUEST['project_duration_from']));
		$project_duration_to 		= date('Y-m-d',strtotime($_REQUEST['project_duration_to']));
		$team_id 					= implode(',', $_REQUEST['team_id']);
		$assisted_by_id 			= implode(',', $_REQUEST['assisted_by_id']);
		$budget 					= $_REQUEST['budget'];
		$metro_id 					= $_REQUEST['metro_id'];
		$tier1_id 					= $_REQUEST['tier1_id'];
		$tier2_id 					= $_REQUEST['tier2_id'];
		$tier3_id 					= $_REQUEST['tier3_id'];
		$tier4_id 					= $_REQUEST['tier4_id'];
		$operational_deadline 		= date('Y-m-d',strtotime($_REQUEST['operational_deadline']));
		$client_submission_deadline = date('Y-m-d',strtotime($_REQUEST['client_submission_deadline']));
		$notes 						= $_REQUEST['notes'];
		$created_at					= date('Y-m-d');
		
		if(empty($client_id))
		{
			$this->session->set_flashdata('msg', '<font class="msg_red">Client can\'t be empty.</font>');
			redirect(base_url().'brief-module/edit/'.$id, 'refresh');exit;
		}
		
		if(empty($brand_id))
		{
			$this->session->set_flashdata('msg', '<font class="msg_red">Brand can\'t be empty.</font>');
			redirect(base_url().'brief-module/edit/'.$id, 'refresh');exit;
		}
		
		if(empty($category_id))
		{
			$this->session->set_flashdata('msg', '<font class="msg_red">Category can\'t be empty.</font>');
			redirect(base_url().'brief-module/edit/'.$id, 'refresh');exit;
		}
		
		$dataCheck = $this->Front_model->getData3Not('brief_modules', 'title', $project_name, 'client_id', $client_id, 'brief_module_id', $id);
        if (count($dataCheck) > 0) 
		{
			$this->session->set_flashdata('msg', '<font class="msg_red"><strong>Error! </strong>This project name is already taken, Please choose another.</font>');
			redirect(base_url().'brief-module/edit/'.$id, 'refresh');exit;
            exit;
        }
		
		/*if(!empty($_FILES['filename']['name']))
		{
			if(!empty($_FILES['filename']['name']))
			{   
				$img1Name = $_FILES['filename']['name'];
				$img1Exp  = explode('.', $img1Name);
				$img1ext  = $img1Exp[count($img1Exp)-1];
				$img1Nm	  = $img1Exp[count($img1Exp)-2];
				if($img1ext=='xlsx' || $img1ext=='csv')
				{
					//@unlink("./uploads/briefModule/".$_REQUEST['filename']);
					$filename = time()."-".$img1Nm.".".$img1ext;
					$img1Path = "./uploads/briefModule/".$img1Name;
					$iimg1mv  = move_uploaded_file($_FILES['filename']['tmp_name'], $img1Path);
					@rename("./uploads/briefModule/".$img1Name, "./uploads/briefModule/".$filename);
				}
				else
				{
					$this->session->set_flashdata('msg', '<font class="msg_red">Wrong File format for Image!</font>');
					redirect(base_url().'brief-module/edit/'.$id, 'refresh');exit;
				}
			}
		} else {$filename = $_REQUEST['filename'];}*/
		
		/*******************Read data from csv****************************/
		$filename = $_FILES["filename"]["tmp_name"];
        if(!empty($filename)) 
		{
			/****************Make market master Array for checking state exist or not****************/
			$metros = $this->Front_model->getDataAsc('m_market', 'tier_town', 1, 'title');
			$tier1  = $this->Front_model->getDataAsc('m_market', 'tier_town', 2, 'title');
			$tier2  = $this->Front_model->getDataAsc('m_market', 'tier_town', 3, 'title');
			$tier3  = $this->Front_model->getDataAsc('m_market', 'tier_town', 4, 'title');
			$tier4  = $this->Front_model->getDataAsc('m_market', 'tier_town', 5, 'title');
			
			unset($metrosMasterArr);
			foreach($metros as $metro)
			{ $metrosMasterArr[] = $metro['title']; }
			
			unset($tier1MasterArr);
			foreach($tier1 as $t1)
			{ $tier1MasterArr[] = $t1['title']; }
			
			unset($tier2MasterArr);
			foreach($tier2 as $t2)
			{ $tier2MasterArr[] = $t2['title']; }
			
			unset($tier3MasterArr);
			foreach($tier3 as $t3)
			{ $tier3MasterArr[] = $t3['title']; }
			
			unset($tier4MasterArr);
			foreach($tier4 as $t4)
			{ $tier4MasterArr[] = $t4['title']; }
			/**************************************End*********************************************/
			
			if(($handle = fopen($filename, "r")) !== FALSE) 
			{
				$row = 0;
				unset($metrosFileArr);
				unset($tier1FileArr);
				unset($tier2FileArr);
				unset($tier3FileArr);
				unset($tier4FileArr);
				while (($dataArr = fgetcsv($handle, 1000, ",")) !== FALSE)
				{
					$row++;
					if($row > 1) 
					{
						if(!empty($dataArr[0])){ $metrosFileArr[]	= $dataArr[0]; }
						if(!empty($dataArr[1])){ $tier1FileArr[]	= $dataArr[1]; }
						if(!empty($dataArr[2])){ $tier2FileArr[]	= $dataArr[2]; }
						if(!empty($dataArr[3])){ $tier3FileArr[]	= $dataArr[3]; }
						if(!empty($dataArr[4])){ $tier4FileArr[]	= $dataArr[4]; }
					}
				}
				fclose($handle);
			}
			
			$i = 1;
			foreach($metrosFileArr as $metrochk)
			{
				++$i;
				if(!in_array($metrochk, $metrosMasterArr))
				{ 
					$this->session->set_flashdata('msg', '<font class="msg_red">Metros are not found in masters, in line '.$i.'.</font>');
					redirect(base_url().'brief-module/edit/'.$id, 'refresh');exit;
				}
				else
				{
					$mtroId = $this->Front_model->getData('m_market', 'title', $metrochk);
					$metroIds[] = $mtroId[0]['market_id'];
				}
			}
			
			$j = 1;
			foreach($tier1FileArr as $t1chk)
			{
				++$j;
				if(!in_array($t1chk, $tier1MasterArr))
				{ 
					$this->session->set_flashdata('msg', '<font class="msg_red">Tier 1 are not found in masters, in line '.$j.'.</font>');
					redirect(base_url().'brief-module/edit/'.$id, 'refresh');exit;
				}
				else
				{
					$t1Id = $this->Front_model->getData('m_market', 'title', $t1chk);
					$t1Ids[] = $t1Id[0]['market_id'];
				}
			}
			
			$k = 1;
			foreach($tier2FileArr as $t2chk)
			{
				++$k;
				if(!in_array($t2chk, $tier2MasterArr))
				{ 
					$this->session->set_flashdata('msg', '<font class="msg_red">Tier 2 are not found in masters, in line '.$k.'.</font>');
					redirect(base_url().'brief-module/edit/'.$id, 'refresh');exit;
				}
				else
				{
					$t2Id = $this->Front_model->getData('m_market', 'title', $t2chk);
					$t2Ids[] = $t2Id[0]['market_id'];
				}
			}
			
			$l = 1;
			foreach($tier3FileArr as $t3chk)
			{
				++$l;
				if(!in_array($t3chk, $tier3MasterArr))
				{ 
					$this->session->set_flashdata('msg', '<font class="msg_red">Tier 3 are not found in masters, in line '.$l.'.</font>');
					redirect(base_url().'brief-module/edit/'.$id, 'refresh');exit;
				}
				else
				{
					$t3Id = $this->Front_model->getData('m_market', 'title', $t3chk);
					$t3Ids[] = $t3Id[0]['market_id'];
				}
			}
			
			$m = 1;
			foreach($tier4FileArr as $t4chk)
			{
				++$m;
				if(!in_array($t4chk, $tier4MasterArr))
				{ 
					$this->session->set_flashdata('msg', '<font class="msg_red">Tier 4 are not found in masters, in line '.$m.'.</font>');
					redirect(base_url().'brief-module/edit/'.$id, 'refresh');exit;
				}
				else
				{
					$t4Id = $this->Front_model->getData('m_market', 'title', $t4chk);
					$t4Ids[] = $t4Id[0]['market_id'];
				}
			}
			
			$metro_id 	= implode(',', $metroIds);
			$tier1_id 	= implode(',', $t1Ids);
			$tier2_id 	= implode(',', $t2Ids);
			$tier3_id 	= implode(',', $t3Ids);
			$tier4_id 	= implode(',', $t4Ids);
		}
		else{
			$metro_id 	= implode(',', $_REQUEST['metro_id']);
			$tier1_id 	= implode(',', $_REQUEST['tier1_id']);
			$tier2_id 	= implode(',', $_REQUEST['tier2_id']);
			$tier3_id 	= implode(',', $_REQUEST['tier3_id']);
			$tier4_id 	= implode(',', $_REQUEST['tier4_id']);
		}
		/************************End**********************************/
		
		// $thematicArea = $this->Front_model->getData('thematic_areas', 'thematic_area_id', $theme_id);
		
		$data = array(
				'client_id' 				 => $client_id,
				'brand_id' 					 => $brand_id,
				'category_id' 				 => $category_id,
				'title' 				 	 => $project_name,
				'thematic_area_id' 			 => $theme_id,
				'theme_id' 				 	 => $theme_id,
				'sub_theme_id' 				 => $sub_theme_id,
				'micro_theme_id' 			 => $micro_theme_id,
				'project_duration_from' 	 => $project_duration_from,
				'project_duration_to' 		 => $project_duration_to,
				'team_assigned_id' 			 => $team_id,
				'assisted_by_id' 			 => $assisted_by_id,
				'budget' 					 => $budget,
				'metro_id' 					 => $metro_id,
				'tier1_id' 					 => $tier1_id,
				'tier2_id' 					 => $tier2_id,
				'tier3_id' 					 => $tier3_id,
				'tier4_id' 					 => $tier4_id,
				'operational_deadline' 		 => $operational_deadline,
				'client_submission_deadline' => $client_submission_deadline,
				'notes' 					 => $notes,
				'filename' 					 => $filename
			);
		
		//echo "<pre>"; print_r($data);die;
		$this->Front_model->updateData('brief_modules', $data, 'brief_module_id', $id);
		//$this->session->set_flashdata('msg', '<font class="msg_green"><strong>Success!</strong> Record has been saved.</font>');
		//$this->session->set_userdata(array('popUpShow' => 'True','theme_id' => $theme_id));
        redirect(base_url().'planning-module', 'refresh');exit;
        exit;
	}
}
