<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CsrOverview extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('front/Front_model');
        $this->load->helper('url');
        $this->load->model('front/Loc_modal');

    }

    public function index()
    {
        if ($this->session->userdata('front_user_logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
        $data['states'] = $this->Loc_modal->getStatesCount();
        $data['projects'] =  $this->Loc_modal->getDataFromGeneralTable('Total CSR Projects');
        $data['companies'] =  $this->Loc_modal->getCompanyCount();
        $data['expanse'] =  $this->Loc_modal->getExpenditureCount('2016-17');
        
        $data['csr_chart_data'] = $this->Loc_modal->getTotalCSRExpenditure();
        
        // $this->Loc_modal->getThematicSpend('2014-15');
        $data['years'] = $this->Loc_modal->getFiscalYears();

        $data['admin_folder']    = "False";
        $data["results"]         = "True";
		
        $data['title']			 = 'CSR Overview';
        $data['keyword']       	 = 'CSR Overview';
        $data['description']     = 'CSR Overview';
        $data['breadcrumb']      = 'CSR Overview';
        $data['page_name']       = 'page/csr_overview';
        $this->load->view('index', $data);

        // $this->load->view('csr_overview', $data);
    }
    public function getCSRExdenditureByFiscalYear(){
        if ($this->input->post('inObj')) {
            echo $this->Loc_modal->getExpenditureCount($this->input->post('inObj'));
        }
    }

    public function getThematicSpendData(){
        if ($this->input->post('inObj')) {
            echo $this->Loc_modal->getThematicSpend($this->input->post('inObj'));
        }
    }
}
