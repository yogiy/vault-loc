<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PartnerIdentification extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->model('front/Front_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('pagination');
		$this->load->library('email');
	}
	
	public function partnerIdentification()
	{
		if ($this->session->userdata('front_user_logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
		$data["themes"]  		= $this->Front_model->getDataAsc('m_sectors', 'status', 'Active', 'title');
		$data["states"] 		= $this->Front_model->getDataAsc('states', 'status', 'Active', 'title');
		
		$data["ngos"]      		= $this->Front_model->searchPartnerIdentificationData('m_ngo', 'status', 'Active');
		
		$data['admin_folder']   = "False";
        $data["results"]        = "True";
		
        $data['title']			= 'Partner Identification';
        $data['keyword']       	= 'Partner Identification';
        $data['description']    = 'Partner Identification';
        $data['breadcrumb']     = 'Partner Identification';
        $data['page_name']      = 'page/partnerIdentification';
        $this->load->view('index',$data);
	}
	
	public function searchPartnerIdentification()
	{
		if ($this->session->userdata('front_user_logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
		if(!empty($_REQUEST['city']))
		{ $city_id = $_REQUEST['city']; } else { $city_id =""; }

		if(!empty($_REQUEST['state']))
		{ $state_id = $_REQUEST['state']; } else { $state_id =""; }

		if(!empty($_REQUEST['theme_id']))
		{ $theme_id = $_REQUEST['theme_id']; } else { $theme_id =""; }
		
		if(!empty($city_id) ||!empty($state_id) ||!empty($theme_id))
		{
			$data = array('city_id' => $city_id,'state_id' => $state_id,'theme_id' => $theme_id,'prtIdnSess'=>'True');
			$this->session->set_userdata($data);
		}
        redirect(base_url().'partner-identification', 'refresh');
        exit;
	}
	
	public function unsetPartnerIdentification()
	{
		if ($this->session->userdata('front_user_logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
		$this->session->unset_userdata('city_id');
		$this->session->unset_userdata('state_id');
		$this->session->unset_userdata('theme_id');
		$this->session->unset_userdata('prtIdnSess');
        redirect(base_url().'partner-identification', 'refresh');
        exit;
	}
	
	public function savePartnerIdentification()
	{
		if ($this->session->userdata('front_user_logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
		//echo "<pre>"; print_r($_REQUEST);die;
		$user_id = $this->session->userdata('front_user_id');
		
		if(!empty($_REQUEST['ngo_id']))
		{ $ngo_ids = implode(',', $_REQUEST['ngo_id']); } 
		else 
		{
			$this->session->set_flashdata('msg', '<font class="msg_red">Please select min one NGO.</font>');
			redirect(base_url().'partner-identification', 'refresh');exit;
		}
	
		if(!empty($_REQUEST['legal_compliance']))
		{ $legal_compliance = implode(',', $_REQUEST['ngo_id']); } else { $legal_compliance =""; }
		
		if(!empty($_REQUEST['sustainability_index']))
		{ $sustainability_index = $_REQUEST['sustainability_index']; } else { $sustainability_index =""; }
		
		if(!empty($_REQUEST['measurable_results']))
		{ $measurable_results = $_REQUEST['measurable_results']; } else { $measurable_results =""; }
	
		if(!empty($_REQUEST['long_impact']))
		{ $long_impact = $_REQUEST['long_impact']; } else { $long_impact =""; }
	
		if(!empty($_REQUEST['scalability']))
		{ $scalability = $_REQUEST['scalability']; } else { $scalability =""; }
	
		if(!empty($_REQUEST['government_ngo']))
		{ $government_ngo = $_REQUEST['government_ngo']; } else { $government_ngo =""; }
		
		$created_at = date('Y-m-d');
		$data = array(
				'user_id' 				=> $user_id,
				'ngo_ids' 				=> $ngo_ids,
				'legal_compliance' 		=> $legal_compliance,
				'sustainability_index' 	=> $sustainability_index,
				'measurable_results' 	=> $measurable_results,
				'long_impact' 			=> $long_impact,
				'scalability' 			=> $scalability,
				'government_ngo' 		=> $government_ngo,
				'created_at' 			=> $created_at,
				'ip_address' 			=> $_SERVER['REMOTE_ADDR']
			);
		
		//echo "<pre>"; print_r($data);die;
		$this->Front_model->insertData('partner_identifications', $data);
		$this->session->set_flashdata('msg', '<font class="msg_green">Selection has been saved.</font>');
        redirect(base_url().'partner-identification', 'refresh');
        exit;
	}
}
