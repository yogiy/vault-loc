<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ajax extends CI_Controller
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
	
	public function showTheme() {
        $id = $_REQUEST['thematicArea'];
        $rsonVl = $this->Crud_model->getData2Asc('thematic_areas', 'parent', 'status', $id, 'Active', 'title');
        if (empty($rsonVl)) {
            echo "1";
        } else {
            echo "<option value=''>-Select-</option>";
            if (!empty($id)) {
                foreach ($rsonVl as $value) {
                    echo "<option value='" . $value['thematic_area_id'] . "'>" . $value['title'] . "</option>";
                }
            }
        }
    }
	
	public function showCity() {
        $state_id = $_REQUEST['state'];
        $rsonVl = $this->Crud_model->getData2Asc('cities', 'state_id', 'status', $state_id, 'Active', 'title');
        if (empty($rsonVl)) {
            echo "1";
        } else {
            echo "<option value=''>-Select-</option>";
            if (!empty($state_id)) {
                foreach ($rsonVl as $value) {
                    echo "<option value='" . $value['city_id'] . "'>" . $value['title'] . "</option>";
                }
            }
        }
    }

    /******************************************************/
}
/***************************End****************************/

