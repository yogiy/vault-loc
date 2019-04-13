<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class BeneficiaryModule extends CI_Controller
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
        
        $data['cities'] = $this->Loc_modal->metroCities($data['pdid_data']['metro_id'], $data['pdid_data']['tier1_id'], $data['pdid_data']['tier2_id'], $data['pdid_data']['tier3_id'], $data['pdid_data']['tier4_id']);        
        
        $data['thematic_areas']         = $this->Loc_modal->getThematicAreas();
        $data['sub_thematic_areas'] 	= $this->Front_model->getData('loc_thematic_areas', 'parent_id', $data['pdid_data']['thematic_area_id']);
		$data['micro_thematic_areas'] 	= $this->Front_model->getData('loc_thematic_areas', 'parent_id', $data['pdid_data']['sub_theme_id']);

        // print_r($data['cities']);
        $data['levels'] = $this->Loc_modal->getLevelDataByThematicArea($data['pdid_data']['thematic_area_id']);
        // $data['levels'] = $this->Loc_modal->getLevelDataByThematicArea(6);
        $dataFilter = array(
            'pdid' => $data['brief_id']
        );
        
        $data['overall_snapshot'] = $this->Loc_modal->getOverallSnapshot($dataFilter);
        $data['beneficiary_db'] = $this->Loc_modal->getBeneficiaryDB(0, 10, $dataFilter);
        
        $data['admin_folder']    = "False";
        $data["results"]         = "True";
		
        $data['title']			 = 'Beneficiary Module';
        $data['keyword']       	 = 'Beneficiary Module';
        $data['description']     = 'Beneficiary Module';
        $data['breadcrumb']      = 'Beneficiary Module';
        $data['page_name']       = 'page/beneficiary_module';
        $this->load->view('index', $data);

        // $this->load->view('beneficiary_module', $data);
    }

    public function getShapesFromDB(){
         echo $this->Loc_modal->getShapesFromDB();       
    }

    public function getSubDataList()
    {
        if ($this->input->post('inObj')) {
            echo $this->Loc_modal->getSubThematicAreas($this->input->post('inObj'));
        }
    }

    public function getMicroDataList()
    {
        if ($this->input->post('inObj')) {
            echo $this->Loc_modal->getMicroThematicAreas($this->input->post('inObj'));
        }
    }

    public function getCityData()
    {
        if ($this->input->post('inObj')) {
            echo $this->Loc_modal->getCityData($this->input->post('inObj'));
        }
    }

    public function getSearchResult()
    {
        // if ($this->input->post('q')) {
        echo $this->Loc_modal->searchBeneficiaryDB($this->input->post('q'));
        // }
    }

    public function getNextSetResult(){
        // PASS FILTER AND SEE IF THE DATA IS AS PER 
        // PDID DATA
        
        $pdid =  $this->input->post('pdid'); 
        $cityID = $this->input->post('cityID');
        $levelID = $this->input->post('levelID');
        $dataFilter = array(
            'pdid' =>$pdid 
        );
        
        if($cityID != 0){
            array_push($dataFilter, array('city_id'=> $cityID));
        }
        if($levelID != 0){
            array_push($dataFilter, array('level_id'=> $levelID));
        }

        $offset = $this->input->post('q') * 10;
        $limit = 10;
        $query = $this->Loc_modal->getBeneficiaryDB($offset, $limit, $dataFilter);
        $output = '';
        foreach ($query as $value) {
            $output .= '<tr>';
            $output .= '<td> ' . $value->village_name . ' </td>';
            $output .= '<td> ' . $value->beneficiary_name . ' </td>';
            $output .= '<td class="tphoneicon"> ' . $value->phone_no . ' </td>';
            $output .= '<td>' . $value->education_details . ' </td>';
            if ($value->training) {
                $output .= '<td class="peargreen"></td>';
            } else {
                $output .= '<td class="lightorange"></td>';
            }
            $output .= '</tr>';
        }
        // print_r($query);
        echo $output;
    }

    private function map_upload($worksheet, $highestRow, $pdid, $cityID, $levelID)
    {
        for ($row = 2; $row <= $highestRow; $row++) {
            if ($worksheet->getCellByColumnAndRow(1, $row)->getValue() == '') {
                break;
            }

            $data_excel[$row - 2]['pdid'] = $pdid;
            $data_excel[$row - 2]['city_id'] = $cityID;
            $data_excel[$row - 2]['level_id'] = $levelID;
            // $data_excel[$row - 2]['city'] = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
            $data_excel[$row - 2]['description'] = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
            $data_excel[$row - 2]['latitude'] = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
            $data_excel[$row - 2]['longitude'] = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
            $data_excel[$row - 2]['pincode'] = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
            $data_excel[$row - 2]['count'] = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
            $data_excel[$row - 2]['percentage'] = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
        }
        $this->Loc_modal->saveMapDBBatch($data_excel);

        return true;
    }

    private function beneficiary_upload($worksheet, $highestRow, $pdid, $cityID, $levelID)
    {
        for ($row = 2; $row <= $highestRow; $row++) {
            if ($worksheet->getCellByColumnAndRow(1, $row)->getValue() == '') {
                break;
            }
            $data_excel[$row - 2]['pdid'] = $pdid;
            $data_excel[$row - 2]['city_id'] = $cityID;
            $data_excel[$row - 2]['level_id'] = $levelID;
            $data_excel[$row - 2]['village_name'] = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
            $data_excel[$row - 2]['pincode'] = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
            $data_excel[$row - 2]['beneficiary_name'] = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
            $data_excel[$row - 2]['phone_no'] = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
            $data_excel[$row - 2]['education_details'] = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
            $data_excel[$row - 2]['training'] = $worksheet->getCellByColumnAndRow(6, $row)->getValue() == 'Yes' ? '1' : '0';
        }
        $this->Loc_modal->saveBeneficiaryDBBatch($data_excel);
        
        return true;
    }

    private function overall_upload($worksheet, $highestRow, $pdid, $cityID, $levelID)
    {
        for ($row = 2; $row <= $highestRow; $row++) {
            if ($worksheet->getCellByColumnAndRow(1, $row)->getValue() == '') {
                break;
            }
            $data_excel[$row - 2]['pdid'] = $pdid;
            $data_excel[$row - 2]['city_id'] = $cityID;
            $data_excel[$row - 2]['level_id'] = $levelID;
            $data_excel[$row - 2]['training'] = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
            $data_excel[$row - 2]['villages'] = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
            $data_excel[$row - 2]['impact'] = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
            $data_excel[$row - 2]['target'] = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
            $data_excel[$row - 2]['completion'] = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
        }
        $this->Loc_modal->saveOverallSnapShotBatch($data_excel);
        return true;
    }

    public function uploadBenefitSheets()
    { //PhpSpreadsheet
        $output = "";
        $status = null;
        $config['allowed_types'] = 'csv|xls|xlsx';
         
        $pdid = $_POST['pdid'] ;
        $cityID = $_POST['cityID'];
        $levelID = $_POST['levelID'];

        if ($_POST['type'] == "map") {
            $config['upload_path'] = './uploads/benefit/map/';
            $output .= "Map type added. ";
        } else if ($_POST['type'] == "overall") {
            $config['upload_path'] = './uploads/benefit/overall/';
            $output .= "Ovrall type added. ";
        } else {
            $config['upload_path'] = './uploads/benefit/bene/';
            $output .= "Bene type added. ";
        }

        if (isset($_FILES["files"]["name"])) {
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('files')) {
                $data = $this->upload->data();
                $output .= "File uploaded to: " . $data['full_path'];
                $inputFileName = $data['full_path'];
                /**  Identify the type of $inputFileName  **/
                $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
                /**  Create a new Reader of the type that has been identified  **/
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
                $reader->setReadDataOnly(true);
                /**  Load $inputFileName to a Spreadsheet Object  **/
                $spreadsheet = $reader->load($inputFileName);
                $data_excel = array();

                $worksheet = $spreadsheet->getActiveSheet();
                // Get the highest row and column numbers referenced in the worksheet
                $highestRow = $worksheet->getHighestRow(); // e.g. 10
                $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
                $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 5

                if ($_POST['type'] == "map") {
                    $status = $this->map_upload($worksheet, $highestRow, $pdid, $cityID, $levelID);
                } else if ($_POST['type'] == "overall") {
                    $status = $this->overall_upload($worksheet, $highestRow, $pdid, $cityID, $levelID);
                } else {
                    $status = $this->beneficiary_upload($worksheet, $highestRow, $pdid, $cityID, $levelID);
                }

            } else {
                $error = array('error' => $this->upload->display_errors());

                $output .= json_encode($error);
                $status = false;
            }
        } else {
            $output .= "File not added. ";
            $status = false;
        }
        echo json_encode(array('status' => $status, 'msg' => $output));
    }

}
