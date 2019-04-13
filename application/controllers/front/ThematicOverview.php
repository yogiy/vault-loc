<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ThematicOverview extends CI_Controller
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
       
        $data['states'] = $this->Loc_modal->getStates();
        $data['years'] = $this->Loc_modal->getLastFiscalYears();

        $data['thematic'] = $this->Loc_modal->getThematicAreas();
        $data['top_states'] = $this->Loc_modal->getTopThematicStates( 0);
        
        $data['apiKey'] = 'AIzaSyAUbRHtu3k_fg3jDGk_qAatE5jA4bC_ndE';

        $data['admin_folder']    = "False";
        $data["results"]         = "True";
		
        $data['title']			 = 'Thematic Overview';
        $data['keyword']       	 = 'Thematic Overview';
        $data['description']     = 'Thematic Overview';
        $data['breadcrumb']      = 'Thematic Overview';
        $data['page_name']       = 'page/thematic_overview';
        $this->load->view('index', $data);
    }


    public function saveStateShape(){
        $geomData = $_POST['inObj'];
        print_r($geomData);
        if ($this->input->post('inObj')) {
            // echo json_encode($geomData); 
            // $this->Loc_modal->getCompanyListByThematicArea( $this->input->post('inObj'));
        }
    }

    public function getCompanyList(){
        if ($this->input->post('inObj')) {
            echo $this->Loc_modal->getCompanyListByThematicArea( $this->input->post('inObj'));
        }        
    }
    
    public function getTopStatesData(){
        if ($this->input->post('inObj')) {
            echo $this->Loc_modal->getTopThematicStates( $this->input->post('inObj'));
        }
    }

    public function getCSRMapData(){
        $thematic_id = $this->input->post('inObj'); 
        $fiscal_year = $this->input->post('fiscal_year'); 
        
        if ($fiscal_year) {
            echo $this->Loc_modal->getThematicStateMapData($fiscal_year, $thematic_id);
        }
    }

    public function getDistrictList()
    {
        if ($this->input->post('inObj')) {
            echo $this->Loc_modal->getDistrictList($this->input->post('inObj'));
        }
    }

    public function getPerformanceData(){
        if ($this->input->post('inObj')) {
            echo $this->Loc_modal->getThematicPerformanceData($this->input->post('inObj'), $this->input->post('district'));
        }
    }

    public function getCSRExpenditureData()
    {
        if ($this->input->post('inObj')) {
            echo $this->Loc_modal->getThematicCSRSpend($this->input->post('inObj'));
        }
    }

    private function thematic_map_upload($worksheet, $highestRow, $fiscal_data, $thematic_area_id ){
        for ($row = 2; $row <= $highestRow; $row++) {
            if ($worksheet->getCellByColumnAndRow(1, $row)->getValue() == '') {
                break;
            }

            $data_excel[$row - 2]['state_name'] = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
            $data_excel[$row - 2]['amount_spend'] = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
            $data_excel[$row - 2]['fiscal_year'] = $fiscal_data;
            $data_excel[$row - 2]['thematic_area_id'] = $thematic_area_id;
        }
        $this->Loc_modal->saveThematicMapDBBatch($data_excel);

        return true;
    }

    public function uploadMapSheets()
    {
        $output = "";
        $status = null;
        $config['allowed_types'] = 'csv|xls|xlsx';
        $config['upload_path'] = './uploads/thematic/map/';
        $fiscal_data = $_POST['fiscal_data'];
        $thematic_area_id = $_POST['thematic_data'];

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
                $status = $this->thematic_map_upload($worksheet, $highestRow, $fiscal_data, $thematic_area_id);

            }else{
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
