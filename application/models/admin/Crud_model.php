<?php
class Crud_model extends CI_Model
{
    var $title = '';
    var $content = '';
    var $date = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_login_value($email, $pass)
    {
        $password = md5($pass);
        return $query = $this->db->get_where('admins', array('email' => $email,'password'=>$password, 'status'=>'Active'));
    }

    public function recordBetween($table, $field, $value1, $value2)
    {
        $que = "select * from $table where  $field between '".$value1."' and '".$value2."'";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return count($result);
    }

    public function recordCountEqual($table, $field, $value)
    {
        $que = "select * from $table where $field = '".$value."'";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return count($result);
    }

    public function recordCountNotEqual($table, $field1, $value1, $field2, $value2, $field3, $value3)
    {
        $que = "select * from $table where $field1 != '".$value1."' and $field2 != '".$value2."' and $field3 != '".$value3."'";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return count($result);
    }

    public function recordCountAll($table)
    {
        $que = "select * from $table";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return count($result);
    }

    public function get_user_data($limit, $start, $table, $field, $value, $sort)
    {
        $que = "select * from $table where $field= '".$value."' order by $sort desc limit $start, $limit ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        //echo "<pre>";print_r($result);die;
        return $result;
    }

    public function get_user_data_all($limit, $start, $table, $sort)
    {
        $que = "select * from $table order by $sort desc limit $start, $limit ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        //echo "<pre>";print_r($result);die;
        return $result;
    }

    public function update_login_time($dt,$id)
    {
        $data = array('last_login' => $dt);
        $this->db->where('admin_id', $id);
        $this->db->update('admins', $data);
    }
	
    public function insertData($table, $data1)
    {
        return $this->db->insert($table,$data1);
    }

    public function insertBulkData($table, $data1)
    {
        return $this->db->insert_batch($table,$data1);
    }

	public function updateData($table, $data, $field, $id)
    {
        $this->db->where($field, $id);
        return $this->db->update($table, $data);
    }

    public function general_single_data($table, $field, $value)
    { return $query = $this->db->get_where($table, array($field => $value)); }

    public function deleteData($id, $table, $field)
    { return $this->db->delete($table, array($field => $id)); }

    public function countAll($table)
    { return $this->db->count_all($table); }
	
	public function getData($table, $field, $value)
    {
        $que = "SELECT * FROM $table WHERE $field = '".$value."' ";
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
	
	public function getData2In($table, $field1, $value1, $field2, $value2)
    {
        $que = "SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 IN ($value2) ";
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

    public function get_general_sort($table, $field1, $value1, $sort)
    {
        $que = "SELECT * FROM $table WHERE $field1 = '".$value1."' ORDER BY $sort DESC ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function get_general_not_sort($table, $field1, $value1, $sort)
    {
        $que = "SELECT * FROM $table WHERE $field1 != '".$value1."' ORDER BY $sort DESC ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function get_generalAll_sort_asc($table, $sort)
    {
        $que = "SELECT * FROM $table order by $sort asc ";
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

    public function get_general_mulIn($table, $field1, $field2, $value1, $value2)
    {
        $que = " SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 IN ($value2) ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function getData2($table, $field1, $field2, $value1, $value2)
    {
        $que = " SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 = '".$value2."' ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function getData2Condition2NotEqual($table, $field1, $field2, $value1, $value2)
    {
        $que = " SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 != '".$value2."' ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }
    public function get_general_mul_not_sort_asc($table, $field1, $field2, $value1, $value2,$sort)
    {
        $que = " SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 != '".$value2."'ORDER BY $sort ASC ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function get_general_mul_not_sort_desc($table, $field1, $field2, $value1, $value2,$sort)
    {
        $que = " SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 != '".$value2."'ORDER BY $sort DESC ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function get_general_mul_sort($table, $field1, $field2, $value1, $value2, $sort)
    {
        $que = " SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 = '".$value2."' ORDER BY $sort DESC ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function getData2Asc($table, $field1, $field2, $value1, $value2, $sort)
    {
        $que = " SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 = '".$value2."' ORDER BY $sort ASC ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function get_general_mul_sort2_asc($table, $field1, $field2, $value1, $value2, $sort, $sort2)
    {
        $que = " SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 = '".$value2."' ORDER BY $sort2 DESC, $sort ASC ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function get_general_mul3_sort($table, $field1, $field2, $field3, $value1, $value2, $value3, $sort)
    {
        $que = " SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 = '".$value2."' AND $field3 = '".$value3."' ORDER BY $sort DESC ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function get_general_mul3_not($table, $field1, $field2, $field3, $value1, $value2, $value3)
    {
        $que = " SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 = '".$value2."' AND $field3 != '".$value3."' ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function get_general_mul3_not_sort_asc($table, $field1, $field2, $field3, $value1, $value2, $value3, $sort)
    {
        $que = " SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 = '".$value2."' AND $field3 != '".$value3."' ORDER BY $sort ASC ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function get_general_mul3_not_sort_desc($table, $field1, $field2, $field3, $value1, $value2, $value3, $sort)
    {
        $que = " SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 = '".$value2."' AND $field3 != '".$value3."' ORDER BY $sort DESC ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function get_general_mul3_sort_asc($table, $field1, $field2, $field3, $value1, $value2, $value3, $sort)
    {
        $que = " SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 = '".$value2."' AND $field3 = '".$value3."' ORDER BY $sort ASC ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function get_general_mul4_sort($table, $field1, $field2, $field3, $field4, $value1, $value2, $value3, $value4, $sort)
    {
        $que = " SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 = '".$value2."' AND $field3 = '".$value3."' AND $field4 = '".$value4."' ORDER BY $sort DESC ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function get_general_mul4_not($table, $field1, $field2, $field3, $field4, $value1, $value2, $value3, $value4, $sort)
    {
        $que = " SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 = '".$value2."' AND $field3 = '".$value3."' AND $field4 != '".$value4."' ORDER BY $sort DESC ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function get_general_mul5_sort($table, $field1, $field2, $field3, $field4, $field5, $value1, $value2, $value3, $value4, $value5, $sort)
    {
        $que = " SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 = '".$value2."' AND $field3 = '".$value3."' AND $field4 = '".$value4."' AND $field5 = '".$value5."' ORDER BY $sort DESC ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }
    public function get_general_mul6($table, $field1, $field2, $field3, $field4, $field5,$field6, $value1, $value2, $value3, $value4, $value5, $value6)
    {
        $que = " SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 = '".$value2."' AND $field3 = '".$value3."' AND $field4 = '".$value4."' AND $field5 = '".$value5."'AND $field6 = '".$value6."'";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }
    public function get_general_mul7($table, $field1, $field2, $field3, $field4, $field5,$field6,$field7, $value1, $value2, $value3, $value4, $value5, $value6, $value7)
    {
        $que = " SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 = '".$value2."' AND $field3 = '".$value3."' AND $field4 = '".$value4."' AND $field5 = '".$value5."'AND $field6 = '".$value6."'AND $field7 = '".$value7."'";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }
    public function get_general_mul26($table, $field1, $field2, $field3, $field4, $field5,$field6,$field7,$field8,$field9,$field10,$field11,$field12,$field13,$field14,$field15,$field16,$field17,$field18,$field19,$field20,$field21,$field22,$field23,$field24,$field25,$field26, $value1, $value2, $value3, $value4, $value5, $value6, $value7, $value8, $value9, $value10, $value11, $value12, $value13, $value14, $value15, $value16, $value17, $value18, $value19, $value20, $value21, $value22, $value23, $value24, $value25, $value26)
    {
        $que = " SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 = '".$value2."' AND $field3 = '".$value3."' AND $field4 = '".$value4."' AND $field5 = '".$value5."'AND $field6 = '".$value6."'AND $field7 = '".$value7."'
        AND $field8 = '".$value8."'
        AND $field9 = '".$value9."'
        AND $field10 = '".$value10."'
        AND $field11 = '".$value11."'
        AND $field12 = '".$value12."'
        AND $field13 = '".$value13."'
        AND $field14 = '".$value14."'
        AND $field15 = '".$value15."'
        AND $field16 = '".$value16."'
        AND $field17 = '".$value17."'
        AND $field18 = '".$value18."'
        AND $field19 = '".$value19."'
        AND $field20 = '".$value20."'
        AND $field21 = '".$value21."'        
        AND $field22 = '".$value22."'
        AND $field23 = '".$value23."'
        AND $field24 = '".$value24."'
        AND $field25 = '".$value25."'
        AND $field26 = '".$value26."'";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function get_new_cnt($table, $field, $value)
    {
        $dt = date('Y-m-d');
        $que = " SELECT * FROM $table WHERE $field = '".$value."' AND DATE_FORMAT(entry_date,'%Y-%m-%d')= '".$dt."' ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    public function get_slug_edit($table, $field1, $field2, $value1, $value2)
    {
        $que = " SELECT * FROM $table WHERE $field1 = '".$value1."' AND $field2 != '".$value2."' ";
        $query1= $this->db->query($que);
        $result = $query1->result_array();
        return $result;
    }

    /////LOCATion
    public function getDataFromGeneralTable($dataKey){
        $query = $this->db->get_where('general_data', array('data_key' => $dataKey))->result();
        return $query[0]->data_value;
    }

    public function updateDataGeneralTable($dataKey, $dataValue){
        $data = array(
            'data_value' => $dataValue
        );

        $this->db->where('data_key', $dataKey);
        $this->db->update('general_data', $data); 
        return true;
    }
    


    /*****************************End***************************************/
}