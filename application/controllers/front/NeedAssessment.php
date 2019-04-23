<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NeedAssessment extends CI_Controller
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

        $data['apiKey'] = 'AIzaSyAUbRHtu3k_fg3jDGk_qAatE5jA4bC_ndE';
        $data['brief_id']    =   $this->uri->segment(2);
        $data['pdid_data'] =    $this->Loc_modal->getNeedAssessmentDataByPDID($data['brief_id']);
        
        $data['thematic_areas'] = $this->Loc_modal->getThematicAreas();
        $data['sub_thematic_areas'] 	= $this->Front_model->getData('loc_thematic_areas', 'parent_id', $data['pdid_data']['thematic_area_id']);
		$data['micro_thematic_areas'] 	= $this->Front_model->getData('loc_thematic_areas', 'parent_id', $data['pdid_data']['sub_theme_id']);

        // print_r($data['pdid_data']['thematic_area_id']);
        $cityMetaData = array(
            'sexratio' => 953.00000000000,
            'p_lit_t' => 94.68690702090,
            'p_lit_m' => 96.05387320920,
            'p_lit_f' => 93.20329593590
        );
        $data['city_meta_data'] =  $cityMetaData;

        $data['cities'] = $this->Loc_modal->metroCities($data['pdid_data']['metro_id'], $data['pdid_data']['tier1_id'], $data['pdid_data']['tier2_id'], $data['pdid_data']['tier3_id'], $data['pdid_data']['tier4_id']);                
        $data['levels'] = $this->Loc_modal->getLevelDataByThematicArea($data['pdid_data']['thematic_area_id']);
        // $data['levels'] = $this->Loc_modal->getLevelDataByThematicArea(6);

        $data['admin_folder']    = "False";
        $data["results"]         = "True";
		
        $data['title']			 = 'Need Assessment';
        $data['keyword']       	 = 'Need Assessment';
        $data['description']     = 'Need Assessment';
        $data['breadcrumb']      = 'Need Assessment';
        $data['page_name']       = 'page/need_assessment';
        $this->load->view('index', $data);
        
        // $this->load->view('need_assessment', $data);
    }
    
    public function getPerformanceData(){
        if ($this->input->post('inObj')) {
            echo $this->Loc_modal->getThematicPerformanceData($this->input->post('inObj'), $this->input->post('district'));
        }
    }

    public function getSubDataList()
    {
        $data = array();

        if ($this->input->post('inObj')) {
            $data['sub_theme'] = $this->Loc_modal->getSubThematicAreas($this->input->post('inObj'));
            $data['key_areas'] = $this->Loc_modal->getNeedAssessmentKeyArea($this->input->post('inObj'));
            $data['distribution'] = $this->Loc_modal->getNeedAssessmentDistribution($this->input->post('inObj'));
        }

        echo json_encode($data);
    }

    public function getMicroDataList()
    {
        if ($this->input->post('inObj')) {
            echo $this->Loc_modal->getMicroThematicAreas($this->input->post('inObj'));
        }
    }

    public function getLevelMapData(){
        $city = $this->input->post('city');
        $level1 = $this->input->post('level');

        echo $this->Loc_modal->getLevelMapData($city, $level1);
    }

    public function getCityMetaData(){
        // this method need to be replaced with some method where city id is corelated with metadata needed for need_assessment
        if ($this->input->post('inObj')) {
            $data = array(
                'sexratio' => 923.00000000000,
                'p_lit_t' => 94.68690702090,
                'p_lit_m' => 96.05387320920,
                'p_lit_f' => 93.20329593590
            );
            echo json_encode($data);
        }
    }


    public function getCityData()
    {
        if ($this->input->post('inObj')) {
            echo $this->Loc_modal->getCityData($this->input->post('inObj'));
        }
    }

    public function getLevelDetails(){
        if ($this->input->post('inObj')) {
            echo $this->Loc_modal->getLevelDetails($this->input->post('inObj'));
        }
    }

    public function getShapesFromDB(){
        echo $this->Loc_modal->getShapesFromDB();       
    }

    public function getMapDBData(){
        $pdid =  $this->input->post('pdid'); 
        $cityID = $this->input->post('cityID');
        $levelID = $this->input->post('levelID');
        
        echo $this->Loc_modal->getMapDBData($pdid, $cityID, $levelID);        
    }



}
?>