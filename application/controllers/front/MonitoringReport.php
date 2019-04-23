<?php
defined('BASEPATH') or exit('No direct script access allowed');
use Dompdf\Dompdf;

class MonitoringReport extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('front/Front_model');
        $this->load->helper('url');
        $this->load->helper('file');
        $this->load->model('front/Loc_modal');

    }

    public function index()
    {

        if ($this->session->userdata('front_user_logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $data['apiKey'] = 'AIzaSyAUbRHtu3k_fg3jDGk_qAatE5jA4bC_ndE';
        $data['brief_id'] = $this->uri->segment(2);
        $data['pdid_data'] = $this->Loc_modal->getNeedAssessmentDataByPDID($data['brief_id']);

        $data['thematic_areas'] = $this->Loc_modal->getThematicAreas();
        $data['sub_thematic_areas'] = $this->Front_model->getData('loc_thematic_areas', 'parent_id', $data['pdid_data']['thematic_area_id']);
        $data['micro_thematic_areas'] = $this->Front_model->getData('loc_thematic_areas', 'parent_id', $data['pdid_data']['sub_theme_id']);

        $data['mou'] = $this->Front_model->getDataDesc('brief_mou', 'brief_module_id', $data['brief_id'], 'brief_mou_id');

        $data['cities'] = $this->Loc_modal->metroCities($data['pdid_data']['metro_id'], $data['pdid_data']['tier1_id'], $data['pdid_data']['tier2_id'], $data['pdid_data']['tier3_id'], $data['pdid_data']['tier4_id']);

        // print_r($data['pdid_data']['thematic_area_id']);
        $data['levels'] = $this->Loc_modal->getLevelDataByThematicArea($data['pdid_data']['thematic_area_id']);
        // $data['levels'] = $this->Loc_modal->getLevelDataByThematicArea(6);

        $data['ngolist'] = $this->Loc_modal->getNGOListByThematicArea($data['pdid_data']['thematic_area_id']);

        $data['admin_folder'] = "False";
        $data["results"] = "True";

        $data['title'] = 'Monitoring Report';
        $data['keyword'] = 'Monitoring Report';
        $data['description'] = 'Monitoring Report';
        $data['breadcrumb'] = 'Monitoring Report';
        $data['page_name'] = 'page/monitoring_reports';

        $this->load->view('index', $data);
        // $this->load->view('monitoring_reports', $data);
    }

    public function getLevelMapData(){
        $city = $this->input->post('city');
        $level1 = $this->input->post('level');

        echo $this->Loc_modal->getLevelMapData($city, $level1);
    }
    
    public function getMapDBData(){
        $pdid =  $this->input->post('pdid'); 
        $cityID = $this->input->post('cityID');
        $levelID = $this->input->post('levelID');
        
        echo $this->Loc_modal->getMapDBData($pdid, $cityID, $levelID);        
    }
    
    public function getImageListForNGOByPdid()
    {
        $pdid = $this->input->post('pdid');
        $ngoID = $this->input->post('ngoID');
        echo $this->Loc_modal->getImageListForNGOByPdid($pdid, $ngoID, "json");
    }

    public function base64Img($path)
    {
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        return $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    }

    public function generatePDF()
    {

// instantiate and use the dompdf class
        $mapImgs = str_replace(" ", "+", $_POST['mapImg']);
        $ngoID = $_POST['ngoID'];
        $pdid = $_POST['pdid'];
        $reportingName = $_POST['reportingName'];
        $ngoName = $_POST['ngoName'];
        $thematicName = $_POST['thematicName'];
        $subThemeName = $_POST['subThemeName'];
        $microThemeName = $_POST['microThemeName'];
        $cityName = $_POST['cityName'];
        $levelName = $_POST['levelName'];

        $reportImgs = $this->Loc_modal->getImageListForNGOByPdid($pdid, $ngoID, "object");
        $logoImg = $this->base64Img(base_url() . "assets/front/images/indeed-logo.png");
        $thankImg = $this->base64Img(base_url() . "assets/front/images/thank-you.jpg");

        $bgImgIntro = $this->base64Img(base_url() . "assets/front/images/iaeed-image.png");
        $bgImg = $this->base64Img(base_url() . "assets/front/images/bg-image.png");
        $bgThankImg = $this->base64Img(base_url() . "assets/front/images/thank.png");

        $html_new = '<!DOCTYPE html>
        <html>
        <head>
            <title>Monitoring Reports</title>
            <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
        </head>
        <body style="margin: 0px; font-family: \'Roboto\', sans-serif;">
                 <table style="width: 100%; background-image:url(' . $bgImgIntro . ');  background-position: bottom; background-repeat:no-repeat; background-size: cover; ">
                    <tr>
                        <td align="right">
                            <img src="' . $logoImg . '" width="170px" style="margin-top: 50px; margin-right:40px;">
                        </td>
                    </tr>

                    <tr>
                         <td  style=" text-align:right;  font-size: 40px; text-transform: uppercase; color: #F79421; margin-bottom: 20px; font-weight: 700; margin-right: 40px; display: block;" >
                                   Monitoring Reports
                                  <p style="font-size: 24px; text-transform: uppercase; color: #3E3E3E; text-align:right; margin-top: 10px; font-weight: 600;">Dentsu Aegis Network</p>
                         </td>
                    </tr>
                    <tr>
                        <td style="height:354px;"></td>
                    </tr>
                </table>
                 <table style="width:100%; padding-top: 30px; ">
                        <tr>
                           <td  align="right">
                               <button style=" background-color: #E7E6E6; color:#F79421; border: 1px solid #E7E6E6; padding: 2px; font-size: 15px; width: 150px;  margin-right:40px;  ">
                                      PDID :' . $pdid . '
                              </button>
                           </td>
                          </tr>

                     <tr>
                         <td style="color: #F79421; font-size: 14px; width: 150px;"><b>Monitoring Reports</b> <br><br>
                         </td>
                      </tr>

                      <tr>
                        <td style="color: #F79421; font-size: 14px; text-align: end;">Reporting Schedule
                        </td>
                        <td>
                            <span>' . $reportingName . '</span>
                        </td>
                        <td style="color: #F79421; font-size: 14px;">Thematic Area
                        </td>
                        <td>
                            <span>' . $thematicName . '</span>
                        </td>
                            <td style="color: #F79421; font-size: 14px; text-align: end;">City</td>
                        <td>
                            <span>' . $cityName . '</span>
                        </td>
                      </tr>
                    <tr>
                    <td style="color: #F79421; font-size: 14px; text-align: end;">NGO</td>
                    <td>
                        <span>' . $ngoName . '</span>
                    </td>

                    <td style="color: #F79421; font-size: 14px;">Sub-Theme</td>
                    <td>
                        <span>' . $subThemeName . '</span>
                    </td>

                    <td style="color: #F79421; font-size: 14px; text-align: end;">Level</td>
                    <td>
                        <span>' . $levelName . '</span>
                    </td>
                </tr>
                <tr>
                    <td style="color: #F79421; font-size: 14px; visibility: hidden;">Reporting Schedule</td>
                    <td style="visibility: hidden;">
                        <select name="" style="padding: 5px; background-color: #E7E6E6; border: 1px solid #E7E6E6; outline: none; margin-left: 10px;">
                            <option value="">None Value</option>
                        </select>
                    </td>
                    <td style="color: #F79421; font-size: 14px; ">Micro Theme</td>
                    <td>
                        <span>' . $microThemeName . '</span>
                    </td>
                    <td style="color: #F79421; font-size: 14px; visibility: hidden;">Reporting Schedule</td>
                    <td style="visibility: hidden;">
                        <select name="" style="padding: 5px; background-color: #E7E6E6; border: 1px solid #E7E6E6; outline: none; margin-left: 10px;">
                            <option value="">None Value</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td colspan="6">
                        <center>
                            <br>
                            <img center src="' . $mapImgs . '" width="600" height="360" >
                        </center>

                    </td>
                </tr>
               </table>';

        for ($count = 0; $count < count($reportImgs); $count++) {
            $html_new .= '<table style="width: 100%; background-image:url(' . $bgImg . ');  background-position: bottom; background-repeat:no-repeat; background-size: cover;">
                    <tr>
                       <td>
                        <table style="border: 2px solid #A4E2E5; width: 90%; margin-left: auto; margin-right: auto; padding: 10px; ">

                          <tr>
                              <td colspan="4" style="font-size: 26px; color: #000; text-align: center; text-transform: uppercase; font-weight: 600; padding-bottom: 20px;">Image File</td>
                          </tr>
                         <tr>

                           <td >
                             <img src="' . $this->base64Img(base_url() . $reportImgs[$count++]) . '" style="width: 400px; height: 450px;">
                            </td>
                            <td style="visibility: hidden;">
                            <img src="' . $this->base64Img(base_url('assets/front/images/vga.png')) . '" style="width: 100px; height: 500px;">
                           </td>';
            if (array_key_exists($count, $reportImgs)) {
                $html_new .= '   <td >
                                <img src="' . $this->base64Img(base_url() . $reportImgs[$count]) . '" style="width: 400px; height: 450px;">
                            </td>';
            }

            $html_new .= '</tr>
                    </table>
                    </td>
                </tr>
             </table>';
        }

        $html_new .= '<table style="width: 100%; background-image:url(' . $bgThankImg . ');  background-position: bottom;  margin-top: 80px; background-repeat:no-repeat; background-size: cover;">
                    <tr>
                        <td style="height:100px"></td>
                    </tr>

                    <tr>
                        <td style="padding-left: 40px; font-size: 50px; font-family: \'Mrs Sheppards\', cursive; " >
                        <img src="' . $thankImg . '" width="250">
                        </td>
                    </tr>
                    <tr>
                         <td style="height:323px"></td>
                    </tr>
                    <tr>
                         <td style=" font-size: 14px; color: #595959; margin-bottom: 0px; font-weight: 500; padding-left: 40px;">
                             <b style="font-size: 26px; font-weight: 600;"> DENTSU AEGIS NETWORK INDIA</b><br>
                                  Poonam Chambers, B Wing, 6th Floor, Dr.Annie Besant Road Mumbai 400018, Maharashtra, India

                        </td>
                    </tr>
                    <tr style="visibility: hidden;">
                         <td style="height:58px"></td>
                    </tr>
                </table>
        </body>
        </html>';

        $dompdf = new Dompdf();
        $dompdf->setBasePath(FCPATH . '/assets/front/css/');
        $dompdf->loadHtml($html_new);
// (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');
// Render the HTML as PDF
        $dompdf->render();
// Output the generated PDF to Browser
        $dompdf->stream();
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

    // method get called when city is change to represent data on map marker
    public function getCityData()
    {
        if ($this->input->post('inObj')) {
            echo $this->Loc_modal->getCityData($this->input->post('inObj'));
        }
    }

    public function getShapesFromDB()
    {
        echo $this->Loc_modal->getShapesFromDB();
    }

    public function getImageDataByNgo()
    {
        $ngoID = $this->input->post('ngoID');
        $pdid = $this->input->post('pdid');
        echo $this->Loc_modal->getImageDataByNgo($pdid, $ngoID);
    }

    public function uploadMonitoringImgs()
    {

        if (isset($_FILES["files"]["name"])) {
            $config['upload_path'] = './uploads/reporting/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $output = "";
            $this->load->library('upload', $config);

            $ngoID = $_POST['ngoID'];
            $report_schedule = $_POST['report_schedule'];
            $pdid = $_POST['pdid'];
            $imagess = "";
            for ($count = 0; $count < count($_FILES["files"]["name"]); $count++) {
                $_FILES["file"]["name"] = $_FILES["files"]["name"][$count];
                $_FILES["file"]["type"] = $_FILES["files"]["type"][$count];
                $_FILES["file"]["tmp_name"] = $_FILES["files"]["tmp_name"][$count];
                $_FILES["file"]["error"] = $_FILES["files"]["error"][$count];
                $_FILES["file"]["size"] = $_FILES["files"]["size"][$count];

                if ($this->upload->do_upload('file')) {

                    $data = $this->upload->data();
                    $output .= '<li><img src="' . base_url() . 'uploads/reporting/' . $data["file_name"] . '" /></li>';
                    $imagess .= 'uploads/reporting/' . $data["file_name"] . "|";
                }
            }
            $imagess = rtrim($imagess, "|");

            $this->Loc_modal->saveReportingData($ngoID, $report_schedule, $pdid, $imagess);

            echo $output;
        }
    }

}
