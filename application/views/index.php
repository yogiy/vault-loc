<?php
	if($admin_folder === 'TRUE')
	{
		$this->load->view('admin/common/header',$title);
		$this->load->view('admin/common/menusidebar');
		$this->load->view('admin/'.$page_name,$results);
		$this->load->view('admin/common/footer');exit;
	}
	
	if($admin_folder === 'False')
	{
		$page = $this->uri->segment(1);
		
		if($page=='')
		{
			$this->load->view('front/'.$page_name,$results);
		}
		
		elseif($page=='agencyLogin' || $page=='clientLogin')
		{
			$this->load->view('front/'.$page_name,$results);
		}
		
		elseif($page=='dashboard' || $page=='brief-module' || $page=='planning-module' || $page=='project-development' || $page=='project-management' || $page=='partner-identification' || $page=='archives' || $page=='report-archive' || $page=='project-assessment')
		{
			$this->load->view('front/common/header');
			$this->load->view('front/common/menusidebar');
			$this->load->view('front/'.$page_name,$results);
			$this->load->view('front/common/footer');exit;
		}
		elseif($page == 'csr_overview' || $page=='thematic_overview' || $page=='need_assessment' || $page=='beneficiary_module'){
			$this->load->view('front/'.$page_name,$results);
		}
		
		elseif($page=='404' )
		{
			$this->load->view('front/'.$page_name,$results);die;
		}
		elseif($page=='500' )
		{
			$this->load->view('front/'.$page_name,$results);die;
		}
		else {
			$this->load->view('front/'.$page_name,$results);die;
		}	
	}
