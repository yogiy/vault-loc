<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BulkUpload extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Crud_model');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('security');
        $this->load->helper('cookie');
        $this->load->library('pagination');
        $this->load->library('email');
        $this->load->library('user_agent');
    }

    public function thematicArea()
    {
        if ($this->session->userdata('logged_in') != '1') {redirect(base_url() . 'admin', 'refresh');}

        $data["results"] = 'True';
        $data['admin_folder'] = 'TRUE';
        $data['title'] = 'Thematic Area Upload';
        $data['page_name'] = 'settings/thematicArea/bulkUpload';
        $this->load->view('index', $data);
    }

    public function thematicAreaStore()
    {
        $filename = $_FILES["uploadFile"]["tmp_name"];
        if (empty($filename)) {
            $this->session->set_flashdata('msg', '<font class="msg_red">Please choose csv file for thematic area csv import!</font>');
            redirect(base_url() . 'admin/bulk_upload', 'refresh');exit;
        }
        if (($handle = fopen($filename, "r")) !== false) {
            $row = 0;
            while (($dataChk = fgetcsv($handle, 1000, ",")) !== false) {
                $row++;
                if ($row > 1) {
                    if (empty($dataChk[0])) {
                        $this->session->set_flashdata('msg', '<font class="msg_red">Thematic area must not be empty in line ' . $row . '!</font>');
                        redirect(base_url() . 'admin/bulkUploadThematicArea', 'refresh');exit;
                    }
                    if (empty($dataChk[1])) {
                        $this->session->set_flashdata('msg', '<font class="msg_red">Sub-theme Thematic area must not be empty in line ' . $row . '!</font>');
                        redirect(base_url() . 'admin/bulkUploadThematicArea', 'refresh');exit;
                    }
                }

            }
            fclose($handle);
        }
        if (($handle1 = fopen($filename, "r")) !== false) {
            $row1 = 0;
            while (($data = fgetcsv($handle1, 1000, ",")) !== false) {
                $row1++;
                if ($row1 > 1) {
                    $dataCheckThematic = $this->Crud_model->get_general_mulIn('thematic_areas', 'title', 'parent', $data[1], 0);
                    if (count($dataCheckThematic) == 0) {
                        $data1 = array(
                            'title' => $data[1],
                        );
                        $this->Crud_model->insertData('thematic_areas', $data1);
                        $thematic_area = $this->Crud_model->get_general_mulIn('thematic_areas', 'title', 'parent', $data[1], '0');
                        $dataCheckSubTheme = $this->Crud_model->get_general_mulIn('thematic_areas', 'title', 'parent', $data[2], $thematic_area[0]['thematic_area_id']);
                        if (count($dataCheckThematic) > 0 && count($dataCheckSubTheme) > 0) {
                            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>This thematic and sub-theme is already taken, Please choose another</div>');
                            redirect(base_url() . 'admin/settings/thematicAreas/display', 'refresh');
                            exit;
                        }
                        $data2 = array(
                            'title' => $data[2],
                            'parent' => $thematic_area[0]['thematic_area_id'],
                        );
                        $this->Crud_model->insertData('thematic_areas', $data2);
                    } else {
                        $thematic_area = $this->Crud_model->get_general_mulIn('thematic_areas', 'title', 'parent', $data[1], '0');
                        $dataCheckSubTheme = $this->Crud_model->get_general_mulIn('thematic_areas', 'title', 'parent', $data[2], $thematic_area[0]['thematic_area_id']);
                        if (count($dataCheckThematic) > 0 && count($dataCheckSubTheme) > 0) {
                            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>This thematic and sub-theme is already taken, Please choose another</div>');
                            redirect(base_url() . 'admin/settings/thematicAreas/display', 'refresh');
                            exit;
                        }
                        $data2 = array(
                            'title' => $data[2],
                            'parent' => $thematic_area[0]['thematic_area_id'],
                        );
                        $this->Crud_model->insertData('thematic_areas', $data2);
                    }
                }
            }
            fclose($handle1);
            $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success! </strong>Excel imported successfully</div>');
            redirect(base_url() . 'admin/settings/thematicAreas/display', 'refresh');exit;

        }

    }

    public function market()
    {
        if ($this->session->userdata('logged_in') != '1') {redirect(base_url() . 'admin', 'refresh');}

        $data["results"] = 'True';
        $data['admin_folder'] = 'TRUE';
        $data['title'] = 'Market List Upload';
        $data['page_name'] = 'settings/market/bulkUpload';
        $this->load->view('index', $data);
    }

    public function marketStore()
    {
        $filename = $_FILES["uploadFile"]["tmp_name"];
        if (empty($filename)) {
            $this->session->set_flashdata('msg', '<font class="msg_red">Please choose csv file for thematic area csv import!</font>');
            redirect(base_url() . 'admin/bulk_upload', 'refresh');exit;
        }
        if (($handle = fopen($filename, "r")) !== false) {
            $row = 0;
            while (($dataChk = fgetcsv($handle, 1000, ",")) !== false) {
                $row++;
                if ($row > 1) {
                    if (empty($dataChk[1])) {
                        $this->session->set_flashdata('msg', '<font class="msg_red">Country can not be empty in line ' . $row . '!</font>');
                        redirect(base_url() . 'admin/bulkUploadMarket', 'refresh');exit;
                    }
                    if (empty($dataChk[2])) {
                        $this->session->set_flashdata('msg', '<font class="msg_red">Zone can not be empty in line ' . $row . '!</font>');
                        redirect(base_url() . 'admin/bulkUploadMarket', 'refresh');exit;
                    }
                    if (empty($dataChk[3])) {
                        $this->session->set_flashdata('msg', '<font class="msg_red">Tier-town can not be empty in line ' . $row . '!</font>');
                        redirect(base_url() . 'admin/bulkUploadMarket', 'refresh');exit;
                    }
                    if (empty($dataChk[4])) {
                        $this->session->set_flashdata('msg', '<font class="msg_red">State can not be empty in line ' . $row . '!</font>');
                        redirect(base_url() . 'admin/bulkUploadMarket', 'refresh');exit;
                    }
                    if (empty($dataChk[5])) {
                        $this->session->set_flashdata('msg', '<font class="msg_red">Name can not be empty in line ' . $row . '!</font>');
                        redirect(base_url() . 'admin/bulkUploadMarket', 'refresh');exit;
                    }
                    if (empty($dataChk[6])) {
                        $this->session->set_flashdata('msg', '<font class="msg_red">Latitude can not be empty in line ' . $row . '!</font>');
                        redirect(base_url() . 'admin/bulkUploadMarket', 'refresh');exit;
                    }
                    if (empty($dataChk[7])) {
                        $this->session->set_flashdata('msg', '<font class="msg_red">Longitude can not be empty in line ' . $row . '!</font>');
                        redirect(base_url() . 'admin/bulkUploadMarket', 'refresh');exit;
                    }
                }
            }
            fclose($handle);
        }
        if (($handle1 = fopen($filename, "r")) !== false) {
            $row1 = 0;
            while (($data = fgetcsv($handle1, 1000, ",")) !== false) {
                $row1++;
                if ($row1 > 1) {
                    $checkCountry = $this->Crud_model->getData('countries', 'name', $data[1]);
                    if (count($checkCountry) == 0) {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>This country is not in our database, Please check the country master</div>');
                        redirect(base_url() . 'admin/settings/markets/display', 'refresh');
                        exit;
                    }
                    $checkZone = $this->Crud_model->getData('m_zones', 'title', $data[2]);
                    if (count($checkZone) == 0) {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>This zone is not in our database, Please check the zone master</div>');
                        redirect(base_url() . 'admin/settings/markets/display', 'refresh');
                        exit;
                    }
                    $checkTierTown = $this->Crud_model->getData('m_tier_town', 'title', $data[3]);
                    if (count($checkTierTown) == 0) {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>This tier-town is not in our database, Please check the  tier-town master</div>');
                        redirect(base_url() . 'admin/settings/markets/display', 'refresh');
                        exit;
                    }
                    $checkState = $this->Crud_model->getData('states', 'title', $data[4]);
                    if (count($checkState) == 0) {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>This state is not in our database, Please check the  state master</div>');
                        redirect(base_url() . 'admin/settings/markets/display', 'refresh');
                        exit;
                    }
                    $dataCheckMarket = $this->Crud_model->get_general_mul7('m_market', 'country', 'zone', 'tier_town', 'state', 'title', 'latitude', 'longitude', $checkCountry[0]['id'], $checkZone[0]['zone_id'], $checkTierTown[0]['tier_town_id'], $checkState[0]['state_id'], $data[5], $data[6], $data[7]);

                    if (count($dataCheckMarket) > 0) {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>This market is already taken, Please choose another</div>');
                        redirect(base_url() . 'admin/settings/markets/display', 'refresh');
                        exit;
                    }
                    $data2 = array(
                        'country' => $checkCountry[0]['id'],
                        'zone' => $checkZone[0]['zone_id'],
                        'tier_town' => $checkTierTown[0]['tier_town_id'],
                        'state' => $checkState[0]['state_id'],
                        'title' => $data[5],
                        'latitude' => $data[6],
                        'longitude' => $data[7],

                    );
                    $this->Crud_model->insertData('m_market', $data2);

                }
            }
            fclose($handle1);
            $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success! </strong>Excel imported successfully</div>');
            redirect(base_url() . 'admin/settings/markets/display', 'refresh');exit;
        }
    }


    public function NGO()
    {
        if ($this->session->userdata('logged_in') != '1') {redirect(base_url() . 'admin', 'refresh');}

        $data["results"] = 'True';
        $data['admin_folder'] = 'TRUE';
        $data['title'] = 'NGO Upload';
        $data['page_name'] = 'settings/ngo/bulkUpload';
        $this->load->view('index', $data);
    }

    public function NGOStore()
    {
        $filename = $_FILES["uploadFile"]["tmp_name"];
        if (empty($filename)) {
            $this->session->set_flashdata('msg', '<font class="msg_red">Please choose csv file for thematic area csv import!</font>');
            redirect(base_url() . 'admin/bulk_upload', 'refresh');exit;
        }
        if (($handle = fopen($filename, "r")) !== false) {
            $row = 0;
            while (($dataChk = fgetcsv($handle, 1000, ",")) !== false) {
                $row++;
                if ($row > 1) {
                    if (empty($dataChk[1])) {
                        $this->session->set_flashdata('msg', '<font class="msg_red">Sectors can not be empty in line ' . $row . '!</font>');
                        redirect(base_url() . 'admin/bulkUploadNGO', 'refresh');exit;
                    }
                    if (empty($dataChk[2])) {
                        $this->session->set_flashdata('msg', '<font class="msg_red">NGO-type can not be empty in line ' . $row . '!</font>');
                        redirect(base_url() . 'admin/bulkUploadNGO', 'refresh');exit;
                    }
                    if (empty($dataChk[3])) {
                        $this->session->set_flashdata('msg', '<font class="msg_red">State can not be empty in line ' . $row . '!</font>');
                        redirect(base_url() . 'admin/bulkUploadNGO', 'refresh');exit;
                    }
                    if (empty($dataChk[4])) {
                        $this->session->set_flashdata('msg', '<font class="msg_red">City can not be empty in line ' . $row . '!</font>');
                        redirect(base_url() . 'admin/bulkUploadNGO', 'refresh');exit;
                    }
                    if (empty($dataChk[5])) {
                        $this->session->set_flashdata('msg', '<font class="msg_red">NGO name can not be empty in line ' . $row . '!</font>');
                        redirect(base_url() . 'admin/bulkUploadNGO', 'refresh');exit;
                    }
                    if (empty($dataChk[6])) {
                        $this->session->set_flashdata('msg', '<font class="msg_red">Unique Id of VO/NGO
 can not be empty in line ' . $row . '!</font>');
                        redirect(base_url() . 'admin/bulkUploadNGO', 'refresh');exit;
                    }
                    if (empty($dataChk[7])) {
                        $this->session->set_flashdata('msg', '<font class="msg_red">Registration No
 can not be empty in line ' . $row . '!</font>');
                        redirect(base_url() . 'admin/bulkUploadNGO', 'refresh');exit;
                    }
                    if (empty($dataChk[8])) {
                        $this->session->set_flashdata('msg', '<font class="msg_red">Date of Establishment/Registration

 can not be empty in line ' . $row . '!</font>');
                        redirect(base_url() . 'admin/bulkUploadNGO', 'refresh');exit;
                    }
                    if (empty($dataChk[9])) {
                        $this->session->set_flashdata('msg', '<font class="msg_red">License Renewal

 can not be empty in line ' . $row . '!</font>');
                        redirect(base_url() . 'admin/bulkUploadNGO', 'refresh');exit;
                    }
                    if (empty($dataChk[10])) {
                        $this->session->set_flashdata('msg', '<font class="msg_red">Address

 can not be empty in line ' . $row . '!</font>');
                        redirect(base_url() . 'admin/bulkUploadNGO', 'refresh');exit;
                    }
                    if (empty($dataChk[11])) {
                        $this->session->set_flashdata('msg', '<font class="msg_red">Contact person

 can not be empty in line ' . $row . '!</font>');
                        redirect(base_url() . 'admin/bulkUploadNGO', 'refresh');exit;
                    }
                    if (empty($dataChk[22])) {
                        $this->session->set_flashdata('msg', '<font class="msg_red">Number of years of exp.

 can not be empty in line ' . $row . '!</font>');
                        redirect(base_url() . 'admin/bulkUploadNGO', 'refresh');exit;
                    }
                    if (empty($dataChk[23])) {
                        $this->session->set_flashdata('msg', '<font class="msg_red">Audit

 can not be empty in line ' . $row . '!</font>');
                        redirect(base_url() . 'admin/bulkUploadNGO', 'refresh');exit;
                    }
                    if (empty($dataChk[24])) {
                        $this->session->set_flashdata('msg', '<font class="msg_red">Brands

 can not be empty in line ' . $row . '!</font>');
                        redirect(base_url() . 'admin/bulkUploadNGO', 'refresh');exit;
                    }
                    if (empty($dataChk[26])) {
                        $this->session->set_flashdata('msg', '<font class="msg_red">Ranking Of NGO

 can not be empty in line ' . $row . '!</font>');
                        redirect(base_url() . 'admin/bulkUploadNGO', 'refresh');exit;
                    }

                }
            }
            fclose($handle);
        }
        if (($handle1 = fopen($filename, "r")) !== false) {
            $row1 = 0;
            while (($data = fgetcsv($handle1, 1000, ",")) !== false) {
                $row1++;
                if ($row1 > 1) {
                    $checkState = $this->Crud_model->getData('states', 'title', $data[3]);
                    if (count($checkState) == 0) {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>This state is not in our database, Please check the  state master</div>');
                        redirect(base_url() . 'admin/settings/ngo/display', 'refresh');
                        exit;
                    }
                    $checkCity = $this->Crud_model->getData('cities', 'title', $data[4]);
                    if (count($checkCity) == 0) {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>This city is not in our database, Please check the  state master</div>');
                        redirect(base_url() . 'admin/settings/ngo/display', 'refresh');
                        exit;
                    }
                    foreach (explode(',', $data[1]) as $this_data) {
                        $checkSectors = $this->Crud_model->getData('m_sectors', 'title', $this_data);
                        if (count($checkSectors) == 0) {
                            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>This sectors working in is not in our database, Please check the zone master</div>');
                            redirect(base_url() . 'admin/settings/ngo/display', 'refresh');
                            exit;
                        }
                        $sectors[] = $checkSectors[0]['sector_id'];
                    }
                    $dataCheckNGo = $this->Crud_model->getData('m_ngo', 'registeration_no', $data[7]);
                    if (count($dataCheckNGo) > 0) {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>This ngo is already taken, Please choose another</div>');
                        redirect(base_url() . 'admin/settings/ngo/display', 'refresh');
                        exit;
                    }
                    $data2 = array(
                        'sector_id' => implode(',', $sectors),
                        'ngo_type' => $data[2],
                        'state' => $checkState[0]['state_id'],
                        'city' => $checkCity[0]['city_id'],
                        'title' => $data[5],
                        'unique_id' => $data[6],
                        'registeration_no' => $data[7],
                        'registeration_date' => $data[8],
                        'licence_renew' => $data[9],
                        'address' => $data[10],
                        'contact_person' => $data[11],
                        'mobile' => $data[12],
                        'phone' => $data[13],
                        'email' => $data[14],
                        'operational_area_city' => $data[15],
                        'operational_area_state' => $data[16],
                        'activity' => $data[17],
                        'ranking_f_website' => $data[18],
                        'annual_turnover' => $data[19],
                        'usp' => $data[20],
                        'registeration_certificate' => $data[21],
                        'experience' => $data[22],
                        'audit' => $data[23],
                        'brand' => $data[24],
                        'trustee' => $data[25],
                        'ngo_ranking' => $data[26],

                    );
                    $this->Crud_model->insertData('m_ngo', $data2);

                }
                unset($sectors);
            }
            fclose($handle1);
            $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success! </strong>Excel imported successfully</div>');
            redirect(base_url() . 'admin/settings/ngo/display', 'refresh');exit;
        }
    }

    /**********************************LOCATION MODULE************************************************/
    private function csrOverviewUpdateData($worksheet, $highestRow, $highestColumnIndex){
        $fiscalYear = array();
        $count = 0;        
        for($colm = 2; $colm<= $highestColumnIndex; ){
            $data[$count]['fy_year'] = substr($worksheet->getCellByColumnAndRow($colm, 1)->getValue(), 4, 7); // GET SEVEN CHARACTER FROM STRING i.e. 2014-15 from FY 2014-15
            
            for ($row = 2; $row < $highestRow; $row++) {
                if ($worksheet->getCellByColumnAndRow(1, $row)->getValue() == '') {
                    break;
                }
                
                $data[$count]['thematic_area_spend_'.($row-1)]      = $worksheet->getCellByColumnAndRow($colm, $row)->getValue(); 
                $data[$count]['thematic_area_percent_'.($row-1)]    = round($worksheet->getCellByColumnAndRow($colm+1, $row)->getCalculatedValue() * 100, 2); 
                $data[$count]['total_spend']      = $worksheet->getCellByColumnAndRow($colm, $row+1)->getValue(); 

            }
            $colm = $colm + 2; 
            $count++;
        }
        $this->Crud_model->insertBulkData('thematic_spends', $data);
        
        return true;
    }

    // CSR OVERVIEW FISCAL DATA WITH PERCENT COMPOSITION
    public function csrOverview(){
        $output = "";
        $status = null;
        $config['allowed_types'] = 'csv|xls|xlsx';
        $config['upload_path'] = './uploads/csrOverview/';
        if (isset($_FILES["files"]["name"])) {
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('files')) {
                $data = $this->upload->data();
                $output .= "File uploaded to: " . $data['full_path'];
                $result = $this->getWorkbookExcel($data);
                $status = $this->csrOverviewUpdateData($result['worksheet'], $result['highestRow'], $result['highestColumnIndex']);

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

    private function thematicStateUpdateData($worksheet, $highestRow, $highestColumnIndex, $thematicAreaId){
        for ($row = 2; $row <= $highestRow; $row++) {
            if ($worksheet->getCellByColumnAndRow(1, $row)->getValue() == '') {
                break;
            }

            $data_excel[$row - 2]['state_name'] = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
            $data_excel[$row - 2]['amount_spend'] = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
            $data_excel[$row - 2]['thematic_area_id'] = $thematicAreaId;
        }
        $this->Crud_model->insertBulkData('thematic_states_data', $data_excel);
        return true;
    }

    public function thematicState(){
        $output = "";
        $status = null;
        $config['allowed_types'] = 'csv|xls|xlsx';
        $config['upload_path'] = './uploads/thematicOverview/stateData/';
        $thematicAreaId = $_POST['thematicAreaId'];

        if (isset($_FILES["files"]["name"])) {
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('files')) {
                $data = $this->upload->data();
                $output .= "File uploaded to: " . $data['full_path'];
                $result = $this->getWorkbookExcel($data);
                $status = $this->thematicStateUpdateData($result['worksheet'], $result['highestRow'], $result['highestColumnIndex'], $thematicAreaId);

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

    private function thematicMasterUpdateData($worksheet, $highestRow){
        $this->load->model('front/Loc_modal');
        for($row = 2; $row <= $highestRow; $row++){
            if ($worksheet->getCellByColumnAndRow(1, $row)->getValue() == '') {
                break;
            }
            $data_excel[$row - 2]['company']            = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
            $data_excel[$row - 2]['thematic_area_id']   = ($worksheet->getCellByColumnAndRow(2, $row)->getValue() == 'NEC/ Not Mentioned') ? 0 : $this->Loc_modal->getThematicId($worksheet->getCellByColumnAndRow(2, $row)->getValue());
            $data_excel[$row - 2]['state_id']           = $this->Loc_modal->getStateId($worksheet->getCellByColumnAndRow(3, $row)->getValue());
            $data_excel[$row - 2]['district_id']        = $worksheet->getCellByColumnAndRow(4, $row)->getValue() == 'NEC/ Not Mentioned' ? 0 : $this->Loc_modal->getDistrictId($worksheet->getCellByColumnAndRow(4, $row)->getValue(), $data_excel[$row - 2]['state_id']);

            $data_excel[$row - 2]['lat']                = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
            $data_excel[$row - 2]['lng']                = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
            $data_excel[$row - 2]['fy_2014-15']         = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
            $data_excel[$row - 2]['fy_2014-15_percent'] = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
            $data_excel[$row - 2]['fy_2015-16']         = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
            $data_excel[$row - 2]['fy_2015-16_percent'] = $worksheet->getCellByColumnAndRow(10, $row)->getValue();

            $data_excel[$row - 2]['fy_2016-17']         = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
            $data_excel[$row - 2]['fy_2016-17_percent'] = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
            $data_excel[$row - 2]['fy_2017-18']         = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
            $data_excel[$row - 2]['fy_2017-18_percent'] = $worksheet->getCellByColumnAndRow(14, $row)->getValue();

        }

        // print_r($data_excel);
        // die;
        $this->Crud_model->insertBulkData('thematic_overview', $data_excel);

        return true;
    }

    public function thematicMaster(){
        $output = "";
        $status = null;
        $config['allowed_types'] = 'csv|xls|xlsx';
        $config['upload_path'] = './uploads/thematicOverview/masterData/';
        if (isset($_FILES["files"]["name"])) {
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('files')) {
                $data = $this->upload->data();
                $output .= "File uploaded to: " . $data['full_path'];
                $result = $this->getWorkbookExcel($data);
                $status = $this->thematicMasterUpdateData($result['worksheet'], $result['highestRow'], $result['highestColumnIndex']);

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

    private function performanceParameterUpdateData($worksheet, $highestRow, $highestColumn, $thematic_area_id){
        $query = array("thematic_area_id", "param_name");
        $row = 2;
        for($col = 2; $col<= $highestColumn; $col++){
            if ($worksheet->getCellByColumnAndRow(1, $row)->getValue() == '') {
                break;
            }
            $name = preg_replace('/\s+/', '_', $worksheet->getCellByColumnAndRow($col, $row)->getValue());
            array_push($query, $name);
        }
               
        for ($row = 4; $row <= $highestRow; $row++) {
            if ($worksheet->getCellByColumnAndRow(1, $row)->getValue() == '') {
                break;
            }
            
            for($col = 0; $col < sizeof($query); $col++){
                if($col == 0){
                    $data_excel[$row - 4]['thematic_area_id'] = $thematic_area_id;
                }else{
                    $valu = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                    $key = "`".$query[$col]."`";
                    $data_excel[$row - 4][$key] =  $valu == 'NA' ? 0.0 :$valu ;
                }
            }   
        }

        $this->Crud_model->insertBulkData('performance_parameters', $data_excel);

        return true;
    }

    public function performanceParameter(){
        $output = "";
        $status = null;
        $config['allowed_types'] = 'csv|xls|xlsx';
        $config['upload_path'] = './uploads/thematicOverview/performanceData/';
        $thematicAreaId = $_POST['thematicAreaId'];

        if (isset($_FILES["files"]["name"])) {
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('files')) {
                $data = $this->upload->data();
                $output .= "File uploaded to: " . $data['full_path'];
                $result = $this->getWorkbookExcel($data);
                $status = $this->performanceParameterUpdateData($result['worksheet'], $result['highestRow'], $result['highestColumnIndex'], $thematicAreaId);

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
    

    private function keyPerformanceUploadData($worksheet, $highestRow, $highestColumnIndex){
        $this->load->model('front/Loc_modal');
        for($row = 2; $row <= $highestRow; $row++){
            if ($worksheet->getCellByColumnAndRow(1, $row)->getValue() == '') {
                break;
            }
            $data_excel[$row - 2]['thematic_area_id']   = $this->Loc_modal->getThematicId($worksheet->getCellByColumnAndRow(1, $row)->getValue());
            $data_excel[$row - 2]['parameters']         = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
            $data_excel[$row - 2]['fy_2015-16']         = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
            $data_excel[$row - 2]['fy_2016-17']         = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
            $data_excel[$row - 2]['fy_2016-18']         = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
            $data_excel[$row - 2]['fy_2017-19']         = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
        }

        $this->Crud_model->insertBulkData('need_assesment_key_performance_areas', $data_excel);

        return true;

    }

    public function keyPerformanceData(){
        $output = "";
        $status = null;
        $config['allowed_types'] = 'csv|xls|xlsx';
        $config['upload_path'] = './uploads/needAssessment/performanceData/';
        
        if (isset($_FILES["files"]["name"])) {
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('files')) {
                $data = $this->upload->data();
                $output .= "File uploaded to: " . $data['full_path'];
                $result = $this->getWorkbookExcel($data);
                $status = $this->keyPerformanceUploadData($result['worksheet'], $result['highestRow'], $result['highestColumnIndex']);

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


    private function keyDistributionUploadData($worksheet, $highestRow, $highestColumnIndex, $thematicAreaId){
        for($row = 2; $row <= $highestRow; $row++){
            if ($worksheet->getCellByColumnAndRow(1, $row)->getValue() == '') {
                break;
            }
            $data_excel[$row - 2]['thematic_area_id']   = $thematicAreaId;
            $data_excel[$row - 2]['data_key']         = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
            $data_excel[$row - 2]['data_value']         = round($worksheet->getCellByColumnAndRow(2, $row)->getCalculatedValue()* 100, 2);
        }

        $this->Crud_model->insertBulkData('need_assesment_distribution', $data_excel);

        return true;
    }

    public function keyDistributionData(){
        $output = "";
        $status = null;
        $config['allowed_types'] = 'csv|xls|xlsx';
        $config['upload_path'] = './uploads/needAssessment/distributionData/';
        $thematicAreaId = $_POST['thematicAreaId'];
        
        if (isset($_FILES["files"]["name"])) {
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('files')) {
                $data = $this->upload->data();
                $output .= "File uploaded to: " . $data['full_path'];
                $result = $this->getWorkbookExcel($data);
                $status = $this->keyDistributionUploadData($result['worksheet'], $result['highestRow'], $result['highestColumnIndex'], $thematicAreaId);

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

     // saves district according to states and update performance table colmns with these districts
     private function saveDistricts($worksheet, $highestRow, $stateId){
        $this->load->model('front/Loc_modal');
       
        for ($row = 2; $row <= $highestRow; $row++) {
            if ($worksheet->getCellByColumnAndRow(1, $row)->getValue() == '') {
                break;
            }
            
            $data_excel[$row - 2]['title'] = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
            $data_excel[$row - 2]['state_id'] = $stateId;
            // $data_excel[$row - 2]['code'] = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
        }
        $this->Loc_modal->saveDistrictDBBatch($data_excel);

        return true;
    } 

    public function districtData(){
        $output = "";
        $status = null;
        $config['allowed_types'] = 'csv|xls|xlsx';
        $config['upload_path'] = './uploads/masters/temp/';
        $stateId  = $_POST['stateId'];
        
        if (isset($_FILES["files"]["name"])) {
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('files')) {
                $data = $this->upload->data();
                $output .= "File uploaded to: " . $data['full_path'];
                $result = $this->getWorkbookExcel($data);
                $status = $this->saveDistricts($result['worksheet'], $result['highestRow'], $stateId);

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

private function getWorkbookExcel($data){
        $inputFileName = $data['full_path'];
        /**  Identify the type of $inputFileName  **/
        $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
        /**  Create a new Reader of the type that has been identified  **/
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        $reader->setReadDataOnly(true);
        /**  Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = $reader->load($inputFileName);

        $worksheet = $spreadsheet->getActiveSheet();
        // Get the highest row and column numbers referenced in the worksheet
        $highestRow = $worksheet->getHighestRow(); // e.g. 10
        $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 5
       
        $res['worksheet'] = $worksheet;
        $res['highestRow'] = $highestRow;
        $res['highestColumn'] = $highestColumn;
        $res['highestColumnIndex'] = $highestColumnIndex;

        return $res;
    }

    



    /************************************************************End*******************************************************/
}
