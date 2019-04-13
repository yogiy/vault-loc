<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PlanningModule extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->model('front/Front_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('pagination');
		$this->load->library('email');
	}
	
	public function planningModule()
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
		
		$data["plannings"]      = $this->Front_model->searchPlanningData();
		
		$data['admin_folder']    = "False";
        $data["results"]         = "True";
		
        $data['title']			 = 'Planning Module';
        $data['keyword']       	 = 'Planning Module';
        $data['description']     = 'Planning Module';
        $data['breadcrumb']      = 'Planning Module';
        $data['page_name']       = 'page/planningModule';
        $this->load->view('index',$data);
	}
	
	public function searchPlanning()
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
			$data = array('pdid' => $pdid,'zone_id' => $zone_id,'client_id' => $client_id,'state_id' => $state_id,'brand_id' => $brand_id,'status' => $status,'plnSess'=>'True');
			$this->session->set_userdata($data);
		}
        redirect(base_url().'planning-module', 'refresh');exit;
        exit;
	}
	
	public function unsetPlanning()
	{
		if ($this->session->userdata('front_user_logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
		$this->session->unset_userdata('pdid');
		$this->session->unset_userdata('zone_id');
		$this->session->unset_userdata('client_id');
		$this->session->unset_userdata('state_id');
		$this->session->unset_userdata('brand_id');
		$this->session->unset_userdata('status');
		$this->session->unset_userdata('plnSess');
        redirect(base_url().'planning-module', 'refresh');exit;
        exit;
	}
}
