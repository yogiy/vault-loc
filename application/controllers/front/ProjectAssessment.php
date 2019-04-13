<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProjectAssessment extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('front/Front_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
        $this->load->library('email');
    }

    public function beneficiary(){
        if ($this->session->userdata('front_user_logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
        
        $data['admin_folder']  = "False";
        $data['brief_id']    =   $this->uri->segment(2);

    }


    public function projectAssessment()
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
		
        if($this->session->userdata('role') == '5')
            $data["plannings"]      = $this->Front_model->searchProjectAssessmentData();
        if($this->session->userdata('role') == '6')
            $data["plannings"]      = $this->Front_model->searchProjectAssessmentCsData();

        $data['admin_folder']    = "False";
        $data["results"]         = "True";

        $data['title']			 = 'Project Assessment';
        $data['keyword']       	 = 'Project Assessment';
        $data['description']     = 'Project Assessment';
        $data['breadcrumb']      = 'Project Assessment';
        $data['page_name']       = 'page/projectAssessment';
        $this->load->view('index',$data);
    }

    public function searchProjectAssessment()
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
            $data = array(
                'pApdid' => $pdid,
                'pAzone_id' => $zone_id,
                'pAclient_id' => $client_id,
                'pAstate_id' => $state_id,
                'pAbrand_id' => $brand_id,
                'pAstatus' => $status,
                'pAplnSess'=>'True'
            );
            $this->session->set_userdata($data);
        }
        redirect(base_url().'project-assessment', 'refresh');exit;
        exit;
    }

    public function unsetProjectAssessment()
    {
        if ($this->session->userdata('front_user_logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $this->session->unset_userdata('pApdid');
        $this->session->unset_userdata('pAzone_id');
        $this->session->unset_userdata('pAstate_id');
        $this->session->unset_userdata('pAbrand_id');
        $this->session->unset_userdata('pAstatus');
        $this->session->unset_userdata('pAplnSess');
        redirect(base_url().'project-assessment', 'refresh');exit;
        exit;
    }


    public function projectAssessmentReport()
    {
        if ($this->session->userdata('front_user_logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $data['admin_folder']  = "False";
        $data['brief_id']    =   $this->uri->segment(2);
        $data['briefs']       =   $this->Front_model->getData('brief_modules', 'brief_module_id', $data['brief_id']);
         $data['benificary_impact']  =   $this->Front_model->getData2last12('benificary_impact', 'brief_module_id', $data['brief_id'],'status','Active','benificary_impact_id');
        $data['project_assessment'] =   $this->Front_model->getData('project_assessment', 'brief_module_id', $data['brief_id']);
        $data["results"]         = "True";
        $data['title']			 = 'Project Assessment';
        $data['keyword']       	 = 'Project Assessment';
        $data['description']     = 'Project Assessment';
        $data['breadcrumb']      = 'Project Assessment';
        $data['page_name']       = 'page/projectAssessmentReport';
        $this->load->view('index',$data);
    }

}
