<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Archives extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->model('front/Front_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('pagination');
		$this->load->library('email');
	}
	
	public function index()
	{
		if ($this->session->userdata('front_user_logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
		$data['admin_folder']    = "False";
        $data["results"]         = "True";
		
        $data['title']			 = 'Archives';
        $data['keyword']       	 = 'Archives';
        $data['description']     = 'Archives';
        $data['breadcrumb']      = 'Archives';
        $data['page_name']       = 'page/archives';
        $this->load->view('index',$data);
	}
	
	public function searchArchiveUp()
	{
		if ($this->session->userdata('front_user_logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
		if(!empty($_REQUEST['pdId']))
		{ $pdId = $_REQUEST['pdId'];$archiveSess=True; } else { $pdId =""; $archiveSess=False; }
		
		$data = array('pdId' => $pdId, 'archiveSess'=>$archiveSess);
		$this->session->set_userdata($data);
        redirect(base_url().'archives', 'refresh');exit;
	}
	
	public function reportArchive()
	{
		if ($this->session->userdata('front_user_logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
		$data["brands"]     	= $this->Front_model->getDataAsc('m_brands', 'status', 'Active', 'title');
		$data["zones"]     		= $this->Front_model->getDataC('m_zones', 'status', 'Active');
		$data["states"]     	= $this->Front_model->getDataC('states', 'country_id', 1);
		
		$data["archives"]      = $this->Front_model->searchReportArchive();
		
		$data['admin_folder']    = "False";
        $data["results"]         = "True";
		
        $data['title']			 = 'Report Archives';
        $data['keyword']       	 = 'Report Archives';
        $data['description']     = 'Report Archives';
        $data['breadcrumb']      = 'Report Archives';
        $data['page_name']       = 'page/reportArchive';
        $this->load->view('index',$data);
	}
	
	public function searchReportArchives()
	{
		if ($this->session->userdata('front_user_logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
		$brand_id 	= $_REQUEST['brand_id'];
		$title 		= $_REQUEST['title'];
		$zone_id 	= $_REQUEST['zone_id'];
		$state_id 	= $_REQUEST['state_id'];
		$status 	= $_REQUEST['status'];
		
		if(!empty($brand_id) ||!empty($title) ||!empty($zone_id) ||!empty($state_id) ||!empty($status))
		{
			$data = array('brand_id' => $brand_id,'title' => $title,'zone_id' => $zone_id,'state_id' => $state_id,'status' => $status,'reprtArchSess'=>'True');
			$this->session->set_userdata($data);
		}
        redirect(base_url().'report-archive', 'refresh');exit;
        exit;
	}
	
	public function unsetReportArchives()
	{
		if ($this->session->userdata('front_user_logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
		$this->session->unset_userdata('brand_id');
		$this->session->unset_userdata('title');
		$this->session->unset_userdata('zone_id');
		$this->session->unset_userdata('state_id');
		$this->session->unset_userdata('status');
		$this->session->unset_userdata('reprtArchSess');
        redirect(base_url().'report-archive', 'refresh');exit;
        exit;
	}
	
}
