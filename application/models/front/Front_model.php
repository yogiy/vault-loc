<?php
class Front_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function getLogin($table, $username, $pass, $role)
    {
        $que = "select * from $table where username='".$username."' and password='".$pass."' and role_id IN ($role) and status='Active' ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function insertData($table, $data1)
    { return $this->db->insert($table,$data1); }

    public function updateData($table, $data, $field, $id)
    {
        $this->db->where($field, $id);
        return $this->db->update($table, $data);
    }

    public function deleteData($id, $table, $field)
    { return $this->db->delete($table, array($field => $id)); }

    public function countAll($table)
    { return $this->db->count_all($table); }

    public function getDataC($table, $field, $value)
    {
        $que = "SELECT * FROM $table WHERE $field = '".$value."' ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function getData($table, $field, $value)
    {
        $que = "SELECT * FROM $table WHERE $field = '".$value."' AND status = 'Active' ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function getDataLast1($table, $field, $value)
    {
        $que = "SELECT * FROM $table WHERE $field = '".$value."' AND status = 'Active' ORDER BY brief_rework_id DESC limit 1 ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function getDataAll($table)
    {
        $que = "SELECT * FROM $table ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function getDataIn($table, $field, $value)
    {
        $que = "SELECT * FROM $table WHERE $field IN ($value) ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function getData2($table, $field1, $value1, $field2, $value2)
    {
        $que = "SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 = '".$value2."' ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function getData2Asc($table, $field1, $value1, $field2, $value2, $sort)
    {
        $que = "SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2= '".$value2."' ORDER BY $sort ASC ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function getData2Desc($table, $field1, $value1, $field2, $value2, $sort)
    {
        $que = "SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2= '".$value2."' ORDER BY $sort DESC ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

	public function getDatalast($table, $field, $value, $sort)
    {
        $que = "SELECT * FROM $table WHERE $field = '".$value."' AND status = 'Active' ORDER BY $sort DESC limit 5";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function getData2last($table, $field1, $value1, $field2, $value2, $sort)
    {
        $que = "SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 = '".$value2."' ORDER BY $sort DESC limit 1 ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }
    public function getData2last12($table, $field1, $value1, $field2, $value2, $sort)
    {
        $que = "SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 = '".$value2."' ORDER BY $sort DESC limit 13";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function getData2In($table, $field1, $value1, $field2, $value2)
    {
        $que = "SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 IN ($value2) ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

	public function getData2InAsc($table, $field1, $value1, $field2, $value2, $sort)
    {
        $que = "SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 IN ($value2) ORDER BY $sort ASC ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function getData2Not($table, $field1, $value1, $field2, $value2)
    {
        $que = "SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 != '".$value2."' ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

	public function getData3Not($table, $field1, $value1, $field2, $value2, $field3, $value3)
    {
        $que = "SELECT * FROM $table WHERE $field1 = '".$value1."' AND  $field2 = '".$value2."' AND $field3 != '".$value3."' ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function getData3Desc($table, $field1, $value1, $field2, $value2, $field3, $value3, $sort)
    {
        $que = "SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2= '".$value2."' AND $field3= '".$value3."' ORDER BY $sort DESC ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function getData3last($table, $field1, $value1, $field2, $value2, $field3, $value3, $sort)
    {
        $que = "SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 = '".$value2."' AND $field3 = '".$value3."' ORDER BY $sort DESC limit 1 ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function getData3InAsc($table, $field1, $value1, $field2, $value2, $field3, $value3, $sort)
    {
        $que = "SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 = '".$value2."'  AND $field3 IN ($value3) ORDER BY $sort Asc  limit 1 ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }
    public function getData3InDESC($table, $field1, $value1, $field2, $value2, $field3, $value3, $sort)
    {
        $que = "SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 = '".$value2."'  AND $field3 IN ($value3) ORDER BY $sort DESC limit 1 ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }




    public function getDataAllsort($table, $sort)
    {
        $que = "SELECT * FROM $table order by $sort desc";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function getDataAsc($table, $field1, $value1, $sort)
    {
        $que = "SELECT * FROM $table WHERE $field1 = '".$value1."' ORDER BY $sort ASC ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function getDataDesc($table, $field1, $value1, $sort)
    {
        $que = "SELECT * FROM $table WHERE $field1 = '".$value1."' ORDER BY $sort DESC ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function getDataNot($table, $field1, $value1, $sort)
    {
        $que = "SELECT * FROM $table WHERE $field1 != '".$value1."' ORDER BY $sort DESC ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function get_generalInAsc($table, $field, $value, $sort)
    {
        $que = " SELECT * FROM $table WHERE $field IN ($value) order by $sort";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

	public function getDataLast2($table, $field, $value, $sort)
    {
        $que = "SELECT * FROM $table WHERE $field = '".$value."' AND status = 'Active' ORDER BY $sort DESC limit 1 ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

	public function getDataLike($table, $field, $value, $sort)
    {
		$que = "SELECT * FROM $table WHERE $field LIKE '%".$value."%' AND parent=0 AND status = 'Active' ORDER BY $sort DESC limit 1 ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }
    /*****************************End***************************************/
    public function searchPlanningData()
    {
        $pdid 		= $this->session->userdata('pdid');
        $zone_id 	= $this->session->userdata('zone_id');
        $client_id 	= $this->session->userdata('client_id');
        $state_id 	= $this->session->userdata('state_id');
        $brand_id	= $this->session->userdata('brand_id');
        $status 	= $this->session->userdata('status');

        $que = "SELECT * FROM brief_modules b 
				LEFT JOIN m_market m on m.market_id = b.metro_id				
				WHERE b.status = 'Active' ";

        if(!empty($pdid))
        { $que .=" And b.brief_module_id ='".$pdid."' "; }

        if(!empty($zone_id))
        { $que .=" And m.zone ='".$zone_id."' "; }

        if(!empty($client_id))
        { $que .=" And b.client_id ='".$client_id."' "; }

        if(!empty($state_id))
        { $que .=" And m.state ='".$state_id."' "; }

        if(!empty($brand_id))
        { $que .=" And b.brand_id	 ='".$brand_id."' "; }

        if(!empty($status))
        { $que .=" And b.b_status ='".$status."' "; }

        $que .=" ORDER BY b.brief_module_id DESC ";
        //echo $que;
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function searchProjectDevelopmentData()
    {
        $pdid 		= $this->session->userdata('pDpdid');
        $zone_id 	= $this->session->userdata('pDzone_id');
        $client_id 	= $this->session->userdata('pDclient_id');
        $state_id 	= $this->session->userdata('pDstate_id');
        $brand_id	= $this->session->userdata('pDbrand_id');
        $status 	= $this->session->userdata('pDstatus');

        $que = "SELECT * FROM brief_modules b 
				LEFT JOIN m_market m on m.market_id = b.metro_id				
				WHERE b.status = 'Active' ";
        if(!empty($pdid))
        { $que .=" And b.brief_module_id ='".$pdid."' "; }

        if(!empty($zone_id))
        { $que .=" And m.zone ='".$zone_id."' "; }

        if(!empty($client_id))
        { $que .=" And b.client_id ='".$client_id."' "; }

        if(!empty($state_id))
        { $que .=" And m.state ='".$state_id."' "; }

        if(!empty($brand_id))
        { $que .=" And b.brand_id	 ='".$brand_id."' "; }

        if(!empty($status))
        { $que .=" And b.b_status ='".$status."' "; }

        $que .=" ORDER BY b.brief_module_id DESC ";
        //echo $que;
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function searchProjectManagementData()
    {
        $pdid 		= $this->session->userdata('pMpdid');
        $zone_id 	= $this->session->userdata('pMzone_id');
        $client_id 	= $this->session->userdata('pMclient_id');
        $state_id 	= $this->session->userdata('pMstate_id');
        $brand_id	= $this->session->userdata('pMbrand_id');
        $status 	= $this->session->userdata('pMstatus');

        $que = "SELECT * FROM brief_modules b 
				LEFT JOIN m_market m on m.market_id = b.metro_id
				LEFT JOIN brief_mou mou on mou.brief_module_id = b.brief_module_id								
				WHERE b.status = 'Active' and mou.b_status ='Completed'";

        if(!empty($pdid))
        { $que .=" And b.brief_module_id ='".$pdid."' "; }

        if(!empty($zone_id))
        { $que .=" And m.zone ='".$zone_id."' "; }

        if(!empty($client_id))
        { $que .=" And b.client_id ='".$client_id."' "; }

        if(!empty($state_id))
        { $que .=" And m.state ='".$state_id."' "; }

        if(!empty($brand_id))
        { $que .=" And b.brand_id	 ='".$brand_id."' "; }

        if(!empty($status))
        { $que .=" And mou.b_status ='".$status."' "; }

        $que .=" ORDER BY b.brief_module_id DESC ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

	public function searchProjectAssessmentData()
	{
		$pdid = $this->session->userdata('pApdid');
		$zone_id = $this->session->userdata('pAzone_id');
		$client_id = $this->session->userdata('front_user_id');
		$state_id = $this->session->userdata('pAstate_id');
		$brand_id = $this->session->userdata('pAbrand_id');
        $status 	= $this->session->userdata('pAstatus');

		$que = "SELECT * FROM brief_modules b
		LEFT JOIN m_market m on m.market_id = b.metro_id
		LEFT JOIN brief_mou mou on mou.brief_module_id = b.brief_module_id
		WHERE b.status = 'Active' and mou.b_status ='Completed'";

		if(!empty($pdid))
		{ $que .=" And b.brief_module_id ='".$pdid."' "; }

		if(!empty($zone_id))
		{ $que .=" And m.zone ='".$zone_id."' "; }

		if(!empty($client_id))
		{ $que .=" And b.client_id ='".$client_id."' "; }

		if(!empty($state_id))
		{ $que .=" And m.state ='".$state_id."' "; }

		if(!empty($brand_id))
		{ $que .=" And b.brand_id ='".$brand_id."' "; }

        if(!empty($status))
        { $que .=" And mou.b_status ='".$status."' "; }

        $que .=" ORDER BY b.brief_module_id DESC ";
		// echo $que;die;
		$query1= $this->db->query($que);
		$result = $query1->result_array();
		return $result;
	}
    public function searchProjectAssessmentCsData()
    {
        $pdid = $this->session->userdata('pApdid');
        $zone_id = $this->session->userdata('pAzone_id');
        $client_id 	= $this->session->userdata('pAclient_id');
        $state_id = $this->session->userdata('pAstate_id');
        $brand_id = $this->session->userdata('pAbrand_id');
        $status 	= $this->session->userdata('pAstatus');

        $que = "SELECT * FROM brief_modules b
		LEFT JOIN m_market m on m.market_id = b.metro_id
		LEFT JOIN brief_mou mou on mou.brief_module_id = b.brief_module_id
		WHERE b.status = 'Active' and mou.b_status ='Completed'";

        if(!empty($pdid))
        { $que .=" And b.brief_module_id ='".$pdid."' "; }

        if(!empty($zone_id))
        { $que .=" And m.zone ='".$zone_id."' "; }

        if(!empty($client_id))
        { $que .=" And b.client_id ='".$client_id."' "; }

        if(!empty($state_id))
        { $que .=" And m.state ='".$state_id."' "; }

        if(!empty($brand_id))
        { $que .=" And b.brand_id ='".$brand_id."' "; }

        if(!empty($status))
        { $que .=" And mou.b_status ='".$status."' "; }

        $que .=" ORDER BY b.brief_module_id DESC ";
        // echo $que;die;
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

	public function searchPartnerIdentificationData()
    {
        $city_id 	= $this->session->userdata('city_id');
        $state_id 	= $this->session->userdata('state_id');
        $theme_id 	= $this->session->userdata('theme_id');

        $que = "SELECT * FROM m_ngo
				WHERE status = 'Active' ";

        if(!empty($theme_id))
        { $que .=" And sector_id IN (".$theme_id.") "; }

        if(!empty($city_id))
        { $que .=" And city ='".$city_id."' "; }

        if(!empty($state_id))
        { $que .=" And state	 ='".$state_id."' "; }

        /*if(!empty($theme_id))
        { $que .=" And theme_id ='".$theme_id."' "; }*/

        $que .=" ORDER BY ngo_id DESC ";
        //echo $que;
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

	public function searchReportArchive()
    {

		$brand_id 	= $this->session->userdata('brand_id');
		$title 	  	= $this->session->userdata('title');
		$zone_id  	= $this->session->userdata('zone_id');
		$state_id 	= $this->session->userdata('state_id');
		$status   	= $this->session->userdata('status');
		$client_id	= $this->session->userdata('front_user_id');

        $que = "SELECT * FROM brief_modules b 
				LEFT JOIN m_market m on m.market_id = b.metro_id				
				WHERE b.status = 'Active' ";

        if(!empty($title))
        { $que .=" And b.title ='".$title."' "; }

        if(!empty($zone_id))
        { $que .=" And m.zone ='".$zone_id."' "; }

        if(!empty($state_id))
        { $que .=" And m.state ='".$state_id."' "; }

        if(!empty($brand_id))
        { $que .=" And b.brand_id	 ='".$brand_id."' "; }

        if(!empty($status))
        { $que .=" And b.b_status ='".$status."' "; }

		 if(!empty($client_id))
        { $que .=" And b.client_id ='".$client_id."' "; }

        $que .=" ORDER BY b.brief_module_id DESC ";
        //echo $que;
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

	public function baselineStudyData($brief_id,$daterange1,$daterange2)
    {
        $que = "SELECT * FROM brief_baseline_study bb 
				WHERE bb.brief_module_id ='".$brief_id."'";

        if(!empty($daterange1) && !empty($daterange2)) {
            $que .=" And bb.created_at BETWEEN  '" .$daterange1. "' AND '" . $daterange2 ."' ";
        }

        $que .=" ORDER BY bb.brief_baseline_study_id DESC ";

        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;

    }

    public function projectAssessmentData($table,$brief_id,$daterange)
    {
        $que = "SELECT * FROM $table
				WHERE brief_module_id ='".$brief_id."' 
				AND  DATE_FORMAT(created_at,'%Y-%m') =  '" .$daterange. "'
				ORDER BY ".$table."_id DESC ";

        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;

    }

    public function projectAssessmentComplitionData($table,$brief_id,$status)
    {
        $que = "SELECT * FROM $table
				WHERE brief_module_id ='".$brief_id."' 
				And b_status='".$status."'";

        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;

    }

    public function projectAssessmentPreparationData($table,$brief_id,$status1)
    {
        $que = "SELECT * FROM $table
				WHERE brief_module_id ='".$brief_id."' 
				And pre_preparation_b_status='".$status1."'
				";

        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function projectAssessmentInterimData($table,$brief_id,$status1)
    {
        $que = "SELECT * FROM $table
				WHERE brief_module_id ='".$brief_id."' 
				And iInterim_b_status='".$status1."'
				";

        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function projectAssessmentFinalData($table,$brief_id,$status1)
    {
        $que = "SELECT * FROM $table
				WHERE brief_module_id ='".$brief_id."' 
				And final_b_status='".$status1."'
				";

        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }





}
