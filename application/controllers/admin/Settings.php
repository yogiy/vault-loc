<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings extends CI_Controller
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

    /****************************settings**************************/
    public function index()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $data["results"] = TRUE;
        $data['admin_folder'] = 'TRUE';
        $data['title'] = 'Admin Settings';
        $data['page_name'] = 'settings/settings';
        $this->load->view('index', $data);
    }
	
	/****************************Roles Section**************************/
    public function roleList()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
       
		$data["results"] 		= $this->Crud_model->getDataAll('roles');
        $data['count'] 			= count($data["results"]);
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Role list';
        $data['page_name'] 		= 'settings/role/index';
        $this->load->view('index', $data);
    }

    public function addRole()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
		$data["permissions"] 	= $this->Crud_model->getData('permissions', 'status', 'Active');
		
        $data["results"] 		= 'True';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Add new role';
        $data['page_name'] 		= 'settings/role/add';
        $this->load->view('index', $data);
    }

    public function insertRole()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
			exit;
        }

        if (empty($_REQUEST['title'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter title</div>');
            redirect(base_url() . 'admin/settings/role/add', 'refresh');
            exit;
        }

        $dataCheck = $this->Crud_model->getData('roles', 'title', $_REQUEST['title']);
        if (count($dataCheck) > 0) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>This title is already taken, Please choose another</div>');
            redirect(base_url() . 'admin/settings/role/add', 'refresh');
            exit;
        }

        $data = array('title' => $_REQUEST['title']);
        $this->Crud_model->insertData('roles', $data);

        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/roles/display', 'refresh');
        exit;
    }

    public function editRole()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $id = $this->uri->segment(5);
        $single_data = $this->Crud_model->getData('roles', 'role_id', $id);
        $data = array('data' => $single_data[0], 'id' => $id);
	
		$data["permissions"] 	= $this->Crud_model->getData('permissions', 'status', 'Active');
		
        $data["results"] 		= 'TRUE';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Update role';
        $data['page_name'] 		= 'settings/role/edit';
        $this->load->view('index', $data);
    }

    public function updateRole()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
			exit;
        }

        $id 	= $this->input->post('id');
		$title 	= $this->input->post('title');
        
		if(!empty($_REQUEST['permission_ids'])){
			$permission_ids 	= implode(',', $_REQUEST['permission_ids']);
		} else { $permission_ids = "";}	

        if (empty($title)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter title</div>');
            redirect(base_url() . 'admin/settings/role/edit/' . $id, 'refresh');
            exit;
        }

        $dataCheck = $this->Crud_model->getData2Condition2NotEqual('roles', 'title', 'role_id', $_REQUEST['title'], $id);
        if (count($dataCheck) > 0) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>This title is already taken, Please choose another</div>');
            redirect(base_url() . 'admin/settings/role/edit/' . $id, 'refresh');
            exit;
        }

        $data = array('title' => $title, 'permission_id' => $permission_ids);
        $this->Crud_model->updateData('roles', $data, 'role_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/roles/display', 'refresh');
        exit;
    }

    public function changeStatusRole()
    {
        $id = $this->uri->segment(4);
        $status = $this->uri->segment(5);
        $data = array('status' => $status);
         $this->Crud_model->updateData('roles', $data, 'role_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success! </strong>Role has been ' . strtolower($status) . '</div>');
        redirect(base_url() . 'admin/settings/roles/display', 'refresh');
        exit;
    }
    /******************End*********************************/
	
    /****************************Users**************************/
    public function userList()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
        $data["results"] 		= $this->Crud_model->getDataAll('users');
        $data['count'] 			= count($data["results"]);
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Users list';
        $data['page_name'] 		= 'settings/user/index';
        $this->load->view('index', $data);
    }

    public function addUser()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
		$data["groups"] 		= $this->Crud_model->getData('roles', 'status', 'Active');
        $data["results"] 		= 'True';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Add new user';
        $data['page_name'] 		= 'settings/user/add';
        $this->load->view('index', $data);
    }

    public function insertUser()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
			exit;
        }

        if (empty($_REQUEST['fname'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter first name</div>');
            redirect(base_url() . 'admin/settings/user/add', 'refresh');
            exit;
        }
		
		if (empty($_REQUEST['username'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter username</div>');
            redirect(base_url() . 'admin/settings/user/add', 'refresh');
            exit;
        }

        $dataCheck1 = $this->Crud_model->getData('users', 'username', $_REQUEST['username']);
        if (count($dataCheck1) > 0) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>This username is already taken, Please choose another</div>');
            redirect(base_url() . 'admin/settings/user/add', 'refresh');
            exit;
        }
		
		$dataCheck = $this->Crud_model->getData('users', 'email', $_REQUEST['email']);
        if (count($dataCheck) > 0) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>This email is already taken, Please choose another</div>');
            redirect(base_url() . 'admin/settings/user/add', 'refresh');
            exit;
        }

        $data = array(
				'role_id' 		=> $_REQUEST['role_id'],
				'username' 		=> $_REQUEST['username'],
				'email' 		=> $_REQUEST['email'],
				'password' 		=> md5($_REQUEST['pass']),
				'fname' 		=> $_REQUEST['fname'],
				'lname' 		=> $_REQUEST['lname'],
				'valid_from' 	=> date('Y-m-d', strtotime($_REQUEST['valid_from'])),
				'valid_to' 		=> date('Y-m-d', strtotime($_REQUEST['valid_to']))
			);
			
        $this->Crud_model->insertData('users', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/users/display', 'refresh');
        exit;
    }

    public function editUser()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $id = $this->uri->segment(5);
        $single_data = $this->Crud_model->getData('users', 'user_id', $id);
        $data = array('data' => $single_data[0], 'id' => $id);
		
		$data["groups"] 		= $this->Crud_model->getData('roles', 'status', 'Active');
		
        $data["results"] 		= 'TRUE';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Update user';
        $data['page_name'] 		= 'settings/user/edit';
        $this->load->view('index', $data);
    }

    public function updateUser()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
			exit;
        }

        $id 	= $this->input->post('id');
        $fname 	= $this->input->post('fname');

        if (empty($fname)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter title</div>');
            redirect(base_url() . 'admin/settings/user/edit/' . $id, 'refresh');
            exit;
        }

        $data = array(
				'role_id' 		=> $_REQUEST['role_id'],
				'fname' 		=> $_REQUEST['fname'],
				'lname' 		=> $_REQUEST['lname'],
				'valid_from' 	=> date('Y-m-d', strtotime($_REQUEST['valid_from'])),
				'valid_to' 		=> date('Y-m-d', strtotime($_REQUEST['valid_to']))
			);
		//print_r($data);die;
        $this->Crud_model->updateData('users', $data, 'user_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/users/display', 'refresh');
        exit;
    }

    public function changeStatusUser()
    {
        $id = $this->uri->segment(4);
        $status = $this->uri->segment(5);
        $data = array('status' => $status);
        $this->Crud_model->updateData('users', $data, 'user_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success! </strong>User has been ' . strtolower($status) . '</div>');
        redirect(base_url() . 'admin/settings/users/display', 'refresh');
        exit;
    }

    /******************End*********************************/
	
	/****************************Client**************************/
    public function clientList()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
		$role					= "5";
        $data["results"] 		= $this->Crud_model->getDataIn('users', 'role_id', $role);
		
        $data['count'] 			= count($data["results"]);
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Client list';
        $data['page_name'] 		= 'settings/client/index';
        $this->load->view('index', $data);
    }

    public function addClient()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
		$role					= "5";
        $data["groups"] 		= $this->Crud_model->getData2In('roles', 'status', 'Active', 'role_id', $role);
		$data["brands"] 		= $this->Crud_model->getDataAsc('m_brands', 'status', 'Active', 'title');
		$data["categories"] 	= $this->Crud_model->getDataAsc('m_categories', 'status', 'Active', 'title');
		
        $data["results"] 		= 'True';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Add new client';
        $data['page_name'] 		= 'settings/client/add';
        $this->load->view('index', $data);
    }

    public function insertClient()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
			exit;
        }

        if (empty($_REQUEST['fname'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter first name</div>');
            redirect(base_url() . 'admin/settings/client/add', 'refresh');
            exit;
        }
		
		if (empty($_REQUEST['username'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter username</div>');
            redirect(base_url() . 'admin/settings/client/add', 'refresh');
            exit;
        }

        $dataCheck1 = $this->Crud_model->getData('users', 'username', $_REQUEST['username']);
        if (count($dataCheck1) > 0) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>This username is already taken, Please choose another</div>');
            redirect(base_url() . 'admin/settings/client/add', 'refresh');
            exit;
        }
		
		$dataCheck = $this->Crud_model->getData('users', 'email', $_REQUEST['email']);
        if (count($dataCheck) > 0) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>This email is already taken, Please choose another</div>');
            redirect(base_url() . 'admin/settings/client/add', 'refresh');
            exit;
        }

        $data = array(
				'role_id' 		=> $_REQUEST['role_id'],
				'username' 		=> $_REQUEST['username'],
				'email' 		=> $_REQUEST['email'],
				'password' 		=> md5($_REQUEST['pass']),
				'fname' 		=> $_REQUEST['fname'],
				'lname' 		=> $_REQUEST['lname'],
				//'valid_from' 	=> date('Y-m-d', strtotime($_REQUEST['valid_from'])),
				//'valid_to' 		=> date('Y-m-d', strtotime($_REQUEST['valid_to']))
				'phone' 		=> $_REQUEST['phone'],
				'mobile' 		=> $_REQUEST['mobile'],
				'brand_id' 		=> $_REQUEST['brand_id'],
				'category_id' 	=> $_REQUEST['category_id'],
				'industry_name' => $_REQUEST['industry_name'],
				'designation' 	=> $_REQUEST['designation'],
				'assign' 		=> $_REQUEST['assign']
			);
			
        $this->Crud_model->insertData('users', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/clients/display', 'refresh');
        exit;
    }

    public function editClient()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $id = $this->uri->segment(5);
        $single_data = $this->Crud_model->getData('users', 'user_id', $id);
        $data = array('data' => $single_data[0], 'id' => $id);
		
		$role					= "5";
        $data["groups"] 		= $this->Crud_model->getData2In('roles', 'status', 'Active', 'role_id', $role);
		$data["brands"] 		= $this->Crud_model->getDataAsc('m_brands', 'status', 'Active', 'title');
		$data["categories"] 	= $this->Crud_model->getDataAsc('m_categories', 'status', 'Active', 'title');
		
        $data["results"] 		= 'TRUE';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Update client';
        $data['page_name'] 		= 'settings/client/edit';
        $this->load->view('index', $data);
    }

    public function updateClient()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
			exit;
        }

        $id 	= $this->input->post('id');
        $fname 	= $this->input->post('fname');

        if (empty($fname)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter title</div>');
            redirect(base_url() . 'admin/settings/client/edit/' . $id, 'refresh');
            exit;
        }

        $data = array(
				//'role_id' 		=> $_REQUEST['role_id'],
				'fname' 		=> $_REQUEST['fname'],
				'lname' 		=> $_REQUEST['lname'],
				//'valid_from' 	=> date('Y-m-d', strtotime($_REQUEST['valid_from'])),
				//'valid_to' 		=> date('Y-m-d', strtotime($_REQUEST['valid_to']))
				'phone' 		=> $_REQUEST['phone'],
				'mobile' 		=> $_REQUEST['mobile'],
				'brand_id' 		=> $_REQUEST['brand_id'],
				'category_id' 	=> $_REQUEST['category_id'],
				'industry_name' => $_REQUEST['industry_name'],
				'designation' 	=> $_REQUEST['designation'],
				'assign' 		=> $_REQUEST['assign']
			);
		//print_r($data);die;
        $this->Crud_model->updateData('users', $data, 'user_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/clients/display', 'refresh');
        exit;
    }

    public function changeStatusClient()
    {
        $id = $this->uri->segment(4);
        $status = $this->uri->segment(5);
        $data = array('status' => $status);
        $this->Crud_model->updateData('users', $data, 'user_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success! </strong>Client has been ' . strtolower($status) . '</div>');
        redirect(base_url() . 'admin/settings/clients/display', 'refresh');
        exit;
    }

    /******************End*********************************/
	
	/****************************Employee**************************/
    public function employeeList()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
        $role					= "3,4,6,7";
        $data["results"] 		= $this->Crud_model->getDataIn('users', 'role_id', $role);
        $data['count'] 			= count($data["results"]);
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Employee list';
        $data['page_name'] 		= 'settings/employee/index';
        $this->load->view('index', $data);
    }

    public function addEmployee()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
		$role					= "3,4,6,7";
		$data["groups"] 		= $this->Crud_model->getData2In('roles', 'status', 'Active', 'role_id', $role);
        $data["results"] 		= 'True';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Add new employee';
        $data['page_name'] 		= 'settings/employee/add';
        $this->load->view('index', $data);
    }

    public function insertEmployee()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
			exit;
        }

        if (empty($_REQUEST['fname'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter first name</div>');
            redirect(base_url() . 'admin/settings/employee/add', 'refresh');
            exit;
        }
		
		if (empty($_REQUEST['username'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter username</div>');
            redirect(base_url() . 'admin/settings/employee/add', 'refresh');
            exit;
        }

        $dataCheck1 = $this->Crud_model->getData('users', 'username', $_REQUEST['username']);
        if (count($dataCheck1) > 0) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>This username is already taken, Please choose another</div>');
            redirect(base_url() . 'admin/settings/employee/add', 'refresh');
            exit;
        }
		
		$dataCheck = $this->Crud_model->getData('users', 'email', $_REQUEST['email']);
        if (count($dataCheck) > 0) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>This email is already taken, Please choose another</div>');
            redirect(base_url() . 'admin/settings/employee/add', 'refresh');
            exit;
        }

        $data = array(
				'role_id' 		=> $_REQUEST['role_id'],
				'username' 		=> $_REQUEST['username'],
				'email' 		=> $_REQUEST['email'],
				'password' 		=> md5($_REQUEST['pass']),
				'fname' 		=> $_REQUEST['fname'],
				'lname' 		=> $_REQUEST['lname'],
				'valid_from' 	=> date('Y-m-d', strtotime($_REQUEST['valid_from'])),
				'valid_to' 		=> date('Y-m-d', strtotime($_REQUEST['valid_to']))
			);
		
		//echo "<pre>";print_r($data);die;
        $this->Crud_model->insertData('users', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/employees/display', 'refresh');
        exit;
    }

    public function editEmployee()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $id = $this->uri->segment(5);
        $single_data = $this->Crud_model->getData('users', 'user_id', $id);
        $data = array('data' => $single_data[0], 'id' => $id);
		
		$role					= "3,4,6,7";
		$data["groups"] 		= $this->Crud_model->getData2In('roles', 'status', 'Active', 'role_id', $role);
		
        $data["results"] 		= 'TRUE';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Update employee';
        $data['page_name'] 		= 'settings/employee/edit';
        $this->load->view('index', $data);
    }

    public function updateEmployee()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
			exit;
        }

        $id 	= $this->input->post('id');
        $fname 	= $this->input->post('fname');
        $newPassword = $_REQUEST['pass'];
        if (empty($fname)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter title</div>');
            redirect(base_url() . 'admin/settings/employee/edit/' . $id, 'refresh');
            exit;
        }

        $data = array(
				'role_id' 		=> $_REQUEST['role_id'],
				'fname' 		=> $_REQUEST['fname'],
				'lname' 		=> $_REQUEST['lname'],
				'valid_from' 	=> date('Y-m-d', strtotime($_REQUEST['valid_from'])),
				'valid_to' 		=> date('Y-m-d', strtotime($_REQUEST['valid_to']))
			);

        if (!empty($newPassword)) {
            $data['password'] = md5($newPassword);
        }
        //print_r($data);die;

        $this->Crud_model->updateData('users', $data, 'user_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/employees/display', 'refresh');
        exit;
    }

    public function changeStatusEmployee()
    {
        $id = $this->uri->segment(4);
        $status = $this->uri->segment(5);
        $data = array('status' => $status);
        $this->Crud_model->updateData('users', $data, 'user_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success! </strong>Employee has been ' . strtolower($status) . '</div>');
        redirect(base_url() . 'admin/settings/employees/display', 'refresh');
        exit;
    }

    /******************End*********************************/
	
	/****************************NGO**************************/
    public function ngoList()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
        $data["results"] 		= $this->Crud_model->getDataAll('m_ngo');
        $data['count'] 			= count($data["results"]);
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'NGO list';
        $data['page_name'] 		= 'settings/ngo/index';
        $this->load->view('index', $data);
    }

    public function addNgo()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
		$data["sectors"] = $this->Crud_model->getData('m_sectors', 'status', 'Active');
		$data["brands"] = $this->Crud_model->getData('m_brands', 'status', 'Active');
		
		$data["results"] 		= 'True';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Add new NGO';
        $data['page_name'] 		= 'settings/ngo/add';
        $this->load->view('index', $data);
    }

    public function insertNgo()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
			exit;
        }

        if (empty($_REQUEST['title'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter title</div>');
            redirect(base_url() . 'admin/settings/ngo/add', 'refresh');
            exit;
        }
		
		if(!empty($_REQUEST['sector_id'])){
			$sector_id 	= implode(',', $_REQUEST['sector_id']);
		} else { $sector_id = "";}
		
		if(!empty($_REQUEST['brand'])){
			$brand 	= implode(',', $_REQUEST['brand']);
		} else { $brand = "";}	
		
		if(!empty(@$_REQUEST['ngo_type']))
		{$ngo_type = $_REQUEST['ngo_type'];} else {$ngo_type="";}
		
		if(!empty(@$_REQUEST['state']))
		{$state = $_REQUEST['state'];} else {$state="";}
	
		if(!empty(@$_REQUEST['city']))
		{$city = $_REQUEST['city'];} else {$city="";}
	
		if(!empty(@$_REQUEST['title']))
		{$title = $_REQUEST['title'];} else {$title="";}
	
		if(!empty(@$_REQUEST['unique_id']))
		{$unique_id = $_REQUEST['unique_id'];} else {$unique_id="";}
	
		if(!empty(@$_REQUEST['registeration_no']))
		{$registeration_no = $_REQUEST['registeration_no'];} else {$registeration_no="";}
	
		if(!empty(@$_REQUEST['registeration_date']))
		{$registeration_date = date('Y-m-d', strtotime($_REQUEST['registeration_date']));} else {$registeration_date="";}
	
		if(!empty(@$_REQUEST['licence_renew']))
		{$licence_renew = $_REQUEST['licence_renew'];} else {$licence_renew="";}
	
		if(!empty(@$_REQUEST['address']))
		{$address = $_REQUEST['address'];} else {$address="";}
	
		if(!empty(@$_REQUEST['contact_person']))
		{$contact_person = $_REQUEST['contact_person'];} else {$contact_person="";}
	
		if(!empty(@$_REQUEST['mobile']))
		{$mobile = $_REQUEST['mobile'];} else {$mobile="";}
	
		if(!empty(@$_REQUEST['phone']))
		{$phone = $_REQUEST['phone'];} else {$phone="";}
	
		if(!empty(@$_REQUEST['email']))
		{$email = $_REQUEST['email'];} else {$email="";}
	
		if(!empty(@$_REQUEST['operational_area_city']))
		{$operational_area_city = $_REQUEST['operational_area_city'];} else {$operational_area_city="";}
	
		if(!empty(@$_REQUEST['operational_area_state']))
		{$operational_area_state = $_REQUEST['operational_area_state'];} else {$operational_area_state="";}
	
		if(!empty(@$_REQUEST['activity']))
		{$activity = $_REQUEST['activity'];} else {$activity="";}
	
		if(!empty(@$_REQUEST['ranking_f_website']))
		{$ranking_f_website = $_REQUEST['ranking_f_website'];} else {$ranking_f_website="";}
	
		if(!empty(@$_REQUEST['annual_turnover']))
		{$annual_turnover = $_REQUEST['annual_turnover'];} else {$annual_turnover="";}
	
		if(!empty(@$_REQUEST['usp']))
		{$usp = $_REQUEST['usp'];} else {$usp="";}
	
		if(!empty(@$_REQUEST['registeration_certificate']))
		{$registeration_certificate = $_REQUEST['registeration_certificate'];} else {$registeration_certificate="";}
	
		if(!empty(@$_REQUEST['experience']))
		{$experience = $_REQUEST['experience'];} else {$experience="";}
	
		if(!empty(@$_REQUEST['audit']))
		{$audit = $_REQUEST['audit'];} else {$audit="";}
	
		if(!empty(@$_REQUEST['trustee']))
		{$trustee = $_REQUEST['trustee'];} else {$trustee="";}
	
		if(!empty(@$_REQUEST['ngo_ranking']))
		{$ngo_ranking = $_REQUEST['ngo_ranking'];} else {$ngo_ranking="";}
		
        $data = array(
				'sector_id' 				=> $sector_id,
				'ngo_type' 					=> $ngo_type,
				'state' 					=> $state,
				'city' 						=> $city,
				'title' 					=> ucfirst(strtolower($title)),
				'unique_id' 				=> $unique_id,
				'registeration_no' 			=> $registeration_no,
				'registeration_date' 		=> $registeration_date,
				'licence_renew' 			=> $licence_renew,
				'address' 					=> $address,
				'contact_person' 			=> $contact_person,
				'mobile' 					=> $mobile,
				'phone' 					=> $phone,
				'email' 					=> $email,
				'operational_area_city' 	=> $operational_area_city,
				'operational_area_state'	=> $operational_area_state,
				'activity' 					=> $activity,
				'ranking_f_website' 		=> $ranking_f_website,
				'annual_turnover' 			=> $annual_turnover,
				'usp' 						=> $usp,
				'registeration_certificate' => $registeration_certificate,
				'experience' 				=> $experience,
				'audit' 					=> $audit,
				'brand' 					=> $brand,
				'trustee' 					=> $trustee,
				'ngo_ranking' 				=> $ngo_ranking
				
			);
		
		//echo "<pre>";print_r($data);die;
        $this->Crud_model->insertData('m_ngo', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/ngo/display', 'refresh');
        exit;
    }

    public function editNgo()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $id = $this->uri->segment(5);
        $single_data = $this->Crud_model->getData('m_ngo', 'ngo_id', $id);
        $data = array('data' => $single_data[0], 'id' => $id);
		
		$data["sectors"] = $this->Crud_model->getData('m_sectors', 'status', 'Active');
		$data["brands"] = $this->Crud_model->getData('m_brands', 'status', 'Active');
		
        $data["results"] 		= 'TRUE';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Update NGO';
        $data['page_name'] 		= 'settings/ngo/edit';
        $this->load->view('index', $data);
    }

    public function updateNgo()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
			exit;
        }

        $id 	= $this->input->post('id');
        $fname 	= $this->input->post('fname');
		
		if (empty($_REQUEST['title'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter title</div>');
            redirect(base_url() . 'admin/settings/user/edit/' . $id, 'refresh');
            exit;
        }
		
		if(!empty($_REQUEST['sector_id'])){
			$sector_id 	= implode(',', $_REQUEST['sector_id']);
		} else { $sector_id = "";}
		
		if(!empty($_REQUEST['brand'])){
			$brand 	= implode(',', $_REQUEST['brand']);
		} else { $brand = "";}	
		
		if(!empty(@$_REQUEST['ngo_type']))
		{$ngo_type = $_REQUEST['ngo_type'];} else {$ngo_type="";}
		
		if(!empty(@$_REQUEST['state']))
		{$state = $_REQUEST['state'];} else {$state="";}
	
		if(!empty(@$_REQUEST['city']))
		{$city = $_REQUEST['city'];} else {$city="";}
	
		if(!empty(@$_REQUEST['title']))
		{$title = $_REQUEST['title'];} else {$title="";}
	
		if(!empty(@$_REQUEST['unique_id']))
		{$unique_id = $_REQUEST['unique_id'];} else {$unique_id="";}
	
		if(!empty(@$_REQUEST['registeration_no']))
		{$registeration_no = $_REQUEST['registeration_no'];} else {$registeration_no="";}
	
		if(!empty(@$_REQUEST['registeration_date']))
		{$registeration_date = date('Y-m-d', strtotime($_REQUEST['registeration_date']));} else {$registeration_date="";}
	
		if(!empty(@$_REQUEST['licence_renew']))
		{$licence_renew = $_REQUEST['licence_renew'];} else {$licence_renew="";}
	
		if(!empty(@$_REQUEST['address']))
		{$address = $_REQUEST['address'];} else {$address="";}
	
		if(!empty(@$_REQUEST['contact_person']))
		{$contact_person = $_REQUEST['contact_person'];} else {$contact_person="";}
	
		if(!empty(@$_REQUEST['mobile']))
		{$mobile = $_REQUEST['mobile'];} else {$mobile="";}
	
		if(!empty(@$_REQUEST['phone']))
		{$phone = $_REQUEST['phone'];} else {$phone="";}
	
		if(!empty(@$_REQUEST['email']))
		{$email = $_REQUEST['email'];} else {$email="";}
	
		if(!empty(@$_REQUEST['operational_area_city']))
		{$operational_area_city = $_REQUEST['operational_area_city'];} else {$operational_area_city="";}
	
		if(!empty(@$_REQUEST['operational_area_state']))
		{$operational_area_state = $_REQUEST['operational_area_state'];} else {$operational_area_state="";}
	
		if(!empty(@$_REQUEST['activity']))
		{$activity = $_REQUEST['activity'];} else {$activity="";}
	
		if(!empty(@$_REQUEST['ranking_f_website']))
		{$ranking_f_website = $_REQUEST['ranking_f_website'];} else {$ranking_f_website="";}
	
		if(!empty(@$_REQUEST['annual_turnover']))
		{$annual_turnover = $_REQUEST['annual_turnover'];} else {$annual_turnover="";}
	
		if(!empty(@$_REQUEST['usp']))
		{$usp = $_REQUEST['usp'];} else {$usp="";}
	
		if(!empty(@$_REQUEST['registeration_certificate']))
		{$registeration_certificate = $_REQUEST['registeration_certificate'];} else {$registeration_certificate="";}
	
		if(!empty(@$_REQUEST['experience']))
		{$experience = $_REQUEST['experience'];} else {$experience="";}
	
		if(!empty(@$_REQUEST['audit']))
		{$audit = $_REQUEST['audit'];} else {$audit="";}
	
		if(!empty(@$_REQUEST['trustee']))
		{$trustee = $_REQUEST['trustee'];} else {$trustee="";}
	
		if(!empty(@$_REQUEST['ngo_ranking']))
		{$ngo_ranking = $_REQUEST['ngo_ranking'];} else {$ngo_ranking="";}
		
        $data = array(
				'sector_id' 				=> $sector_id,
				'ngo_type' 					=> $ngo_type,
				'state' 					=> $state,
				'city' 						=> $city,
				'title' 					=> ucfirst(strtolower($title)),
				'unique_id' 				=> $unique_id,
				'registeration_no' 			=> $registeration_no,
				'registeration_date' 		=> $registeration_date,
				'licence_renew' 			=> $licence_renew,
				'address' 					=> $address,
				'contact_person' 			=> $contact_person,
				'mobile' 					=> $mobile,
				'phone' 					=> $phone,
				'email' 					=> $email,
				'operational_area_city' 	=> $operational_area_city,
				'operational_area_state'	=> $operational_area_state,
				'activity' 					=> $activity,
				'ranking_f_website' 		=> $ranking_f_website,
				'annual_turnover' 			=> $annual_turnover,
				'usp' 						=> $usp,
				'registeration_certificate' => $registeration_certificate,
				'experience' 				=> $experience,
				'audit' 					=> $audit,
				'brand' 					=> $brand,
				'trustee' 					=> $trustee,
				'ngo_ranking' 				=> $ngo_ranking
				
			);
		//echo "<pre>";print_r($data);die;
        $this->Crud_model->updateData('m_ngo', $data, 'ngo_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/ngo/display', 'refresh');
        exit;
    }

    public function changeStatusNgo()
    {
        $id = $this->uri->segment(4);
        $status = $this->uri->segment(5);
        $data = array('status' => $status);
        $this->Crud_model->updateData('m_ngo', $data, 'ngo_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success! </strong>NGO has been ' . strtolower($status) . '</div>');
        redirect(base_url() . 'admin/settings/ngo/display', 'refresh');
        exit;
    }

    /******************End*********************************/
	
	/****************************Markets**************************/
    public function marketList()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
        $data["results"] 		= $this->Crud_model->getDataAll('m_market');
        $data['count'] 			= count($data["results"]);
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Market list';
        $data['page_name'] 		= 'settings/market/index';
        $this->load->view('index', $data);
    }

    public function addMarket()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
		$data["tier_town"] = $this->Crud_model->getData('m_tier_town', 'status', 'Active');
        $data["states"]  = $this->Crud_model->getData('states', 'status', 'Active');
        $data["countries"] = $this->Crud_model->getData('countries', 'status', 'Active');
        $data["zones"] = $this->Crud_model->getData('m_zones', 'status', 'Active');
        $data["results"] 		= 'True';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Add new market';
        $data['page_name'] 		= 'settings/market/add';
        $this->load->view('index', $data);
    }

    public function insertMarket()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
			exit;
        }

        if (empty($_REQUEST['title'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter title</div>');
            redirect(base_url() . 'admin/settings/market/add', 'refresh');
            exit;
        }
		
		if(!empty(@$_REQUEST['title']))
		{$title = $_REQUEST['title'];} else {$title="";}
	
		if(!empty(@$_REQUEST['zone']))
		{$zone = $_REQUEST['zone'];} else {$zone="";}
	
		if(!empty(@$_REQUEST['state']))
		{$state = $_REQUEST['state'];} else {$state="";}
	
		if(!empty(@$_REQUEST['tier_town']))
		{$tier_town = $_REQUEST['tier_town'];} else {$tier_town="";}
	
		if(!empty(@$_REQUEST['longitude']))
		{$longitude = $_REQUEST['longitude'];} else {$longitude="";}
	
		if(!empty(@$_REQUEST['latitude']))
		{$latitude = $_REQUEST['latitude'];} else {$latitude="";}
	
        $data = array(
				'title' 		=> ucfirst(strtolower($title)),
				'zone' 			=> $zone,
				'state' 		=> $state,
				'tier_town' 	=> $tier_town,
				'longitude' 	=> $longitude,
				'latitude' 		=> $latitude
			);
		
		//echo "<pre>";print_r($data);die;
        $this->Crud_model->insertData('m_market', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/markets/display', 'refresh');
        exit;
    }

    public function editMarket()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $id = $this->uri->segment(5);
        $single_data = $this->Crud_model->getData('m_market', 'market_id', $id);
        $data = array('data' => $single_data[0], 'id' => $id);
		
		$data["tier_town"] = $this->Crud_model->getData('m_tier_town', 'status', 'Active');
        $data["states"]  = $this->Crud_model->getData('states', 'status', 'Active');
        $data["countries"] = $this->Crud_model->getData('countries', 'status', 'Active');
        $data["zones"] = $this->Crud_model->getData('m_zones', 'status', 'Active');

        $data["results"] 		= 'TRUE';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Update market';
        $data['page_name'] 		= 'settings/market/edit';
        $this->load->view('index', $data);
    }

    public function updateMarket()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
			exit;
        }

        $id 	= $this->input->post('id');
        $fname 	= $this->input->post('fname');

		if (empty($_REQUEST['title'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter title</div>');
            redirect(base_url() . 'admin/settings/market/edit/' . $id, 'refresh');
            exit;
        }
		if(!empty(@$_REQUEST['title']))
		{$title = $_REQUEST['title'];} else {$title="";}
	
		if(!empty(@$_REQUEST['zone']))
		{$zone = $_REQUEST['zone'];} else {$zone="";}
	
		if(!empty(@$_REQUEST['state']))
		{$state = $_REQUEST['state'];} else {$state="";}
	
		if(!empty(@$_REQUEST['tier_town']))
		{$tier_town = $_REQUEST['tier_town'];} else {$tier_town="";}
	
		if(!empty(@$_REQUEST['longitude']))
		{$longitude = $_REQUEST['longitude'];} else {$longitude="";}
	
		if(!empty(@$_REQUEST['latitude']))
		{$latitude = $_REQUEST['latitude'];} else {$latitude="";}
	
        $data = array(
				'title' 		=> ucfirst(strtolower($title)),
				'zone' 			=> $zone,
				'state' 		=> $state,
				'tier_town' 	=> $tier_town,
				'longitude' 	=> $longitude,
				'latitude' 		=> $latitude
			);
		//echo "<pre>";print_r($data);die;
        $this->Crud_model->updateData('m_market', $data, 'market_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/markets/display', 'refresh');
        exit;
    }

    public function changeStatusMarket()
    {
        $id = $this->uri->segment(4);
        $status = $this->uri->segment(5);
        $data = array('status' => $status);
        $this->Crud_model->updateData('m_market', $data, 'market_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success! </strong>Market has been ' . strtolower($status) . '</div>');
        redirect(base_url() . 'admin/settings/markets/display', 'refresh');
        exit;
    }

    /******************End*********************************/
	
	/****************************Thematic Areas Section**************************/
    public function thematicAreaList()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
       
		$data["results"] 		= $this->Crud_model->getData('thematic_areas', 'parent', 0);
        $data['count'] 			= count($data["results"]);
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Thematic Area list';
        $data['page_name'] 		= 'settings/thematicArea/index';
        $this->load->view('index', $data);
    }

    public function addThematicArea()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
        $data["results"] 		= 'True';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Add new thematic area';
        $data['page_name'] 		= 'settings/thematicArea/add';
        $this->load->view('index', $data);
    }

    public function insertThematicArea()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
			exit;
        }

        if (empty($_REQUEST['title'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter title</div>');
            redirect(base_url() . 'admin/settings/thematicArea/add', 'refresh');
            exit;
        }

        $dataCheck = $this->Crud_model->getData('thematic_areas', 'title', $_REQUEST['title']);
        if (count($dataCheck) > 0) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>This title is already taken, Please choose another</div>');
            redirect(base_url() . 'admin/settings/thematicArea/add', 'refresh');
            exit;
        }

        $data = array('title' => ucfirst(strtolower($_REQUEST['title'])));
        $this->Crud_model->insertData('thematic_areas', $data);

        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/thematicAreas/display', 'refresh');
        exit;
    }

    public function editThematicArea()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $id = $this->uri->segment(5);
        $single_data = $this->Crud_model->getData('thematic_areas', 'thematic_area_id', $id);
        $data = array('data' => $single_data[0], 'id' => $id);

        $data["results"] 		= 'TRUE';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Update thematic area';
        $data['page_name'] 		= 'settings/thematicArea/edit';
        $this->load->view('index', $data);
    }

    public function updateThematicArea()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
			exit;
        }

        $id 	= $this->input->post('id');
        $title 	= $this->input->post('title');

        if (empty($title)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter title</div>');
            redirect(base_url() . 'admin/settings/thematicArea/edit/' . $id, 'refresh');
            exit;
        }

        $dataCheck = $this->Crud_model->getData2Condition2NotEqual('thematic_areas', 'title', 'thematic_area_id', $_REQUEST['title'], $id);
        if (count($dataCheck) > 0) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>This title is already taken, Please choose another</div>');
            redirect(base_url() . 'admin/settings/thematicArea/edit/' . $id, 'refresh');
            exit;
        }

        $data = array('title' => ucfirst(strtolower($title)));
        $this->Crud_model->updateData('thematic_areas', $data, 'thematic_area_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/thematicAreas/display', 'refresh');
        exit;
    }

    public function changeStatusThematicArea()
    {
        $id = $this->uri->segment(4);
        $status = $this->uri->segment(5);
        $data = array('status' => $status);
         $this->Crud_model->updateData('thematic_areas', $data, 'thematic_area_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success! </strong>Thematic area has been ' . strtolower($status) . '</div>');
        redirect(base_url() . 'admin/settings/thematicAreas/display', 'refresh');
        exit;
    }
    /******************End*********************************/
	
	/****************************Theme Section**************************/
    public function themeList()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
		$parentId				= $this->uri->segment(6);
        $data["results"] 		= $this->Crud_model->getData('thematic_areas', 'parent', $parentId);
        $data['count'] 			= count($data["results"]);
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Theme list';
        $data['page_name'] 		= 'settings/theme/index';
        $this->load->view('index', $data);
    }

    public function addTheme()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
        $data["results"] 		= 'True';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Add new theme';
        $data['page_name'] 		= 'settings/theme/add';
        $this->load->view('index', $data);
    }

    public function insertTheme()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
			exit;
        }

        if (empty($_REQUEST['title'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter title</div>');
            redirect(base_url() . 'admin/settings/thematicArea/theme/add/'.$_REQUEST['parent'], 'refresh');
            exit;
        }

        $dataCheck = $this->Crud_model->getData('thematic_areas', 'title', $_REQUEST['title']);
        if (count($dataCheck) > 0) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>This title is already taken, Please choose another</div>');
            redirect(base_url() . 'admin/settings/thematicArea/theme/add/'.$_REQUEST['parent'], 'refresh');
            exit;
        }

        $data = array('title' => ucfirst(strtolower($_REQUEST['title'])), 'parent' => $_REQUEST['parent']);
        $this->Crud_model->insertData('thematic_areas', $data);

        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/thematicArea/theme/display/'.$_REQUEST['parent'], 'refresh');
        exit;
    }

    public function editTheme()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $id = $this->uri->segment(7);
        $single_data = $this->Crud_model->getData('thematic_areas', 'thematic_area_id', $id);
        $data = array('data' => $single_data[0], 'id' => $id);

        $data["results"] 		= 'TRUE';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Update thematic area';
        $data['page_name'] 		= 'settings/thematicArea/edit';
        $this->load->view('index', $data);
    }

    public function updateTheme()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
			exit;
        }

        $id 	= $this->input->post('id');
        $parent = $this->input->post('parent');
		$title 	= $this->input->post('title');

        if (empty($title)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter title</div>');
            redirect(base_url() . 'admin/settings/thematicArea/theme/edit/'.$_REQUEST['parent'], 'refresh');
            exit;
        }

        $dataCheck = $this->Crud_model->getData2Condition2NotEqual('thematic_areas', 'title', 'thematic_area_id', $_REQUEST['title'], $id);
        if (count($dataCheck) > 0) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>This title is already taken, Please choose another</div>');
            redirect(base_url() . 'admin/settings/thematicArea/theme/edit/'.$_REQUEST['parent'].'/'.$id, 'refresh');
            exit;
        }

        $data = array('title' => ucfirst(strtolower($title)));
        $this->Crud_model->updateData('thematic_areas', $data, 'thematic_area_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/thematicArea/theme/edit/'.$_REQUEST['parent'].'/'.$id, 'refresh');
        exit;
    }

    public function changeStatusTheme()
    {
        $parent = $this->uri->segment(5);
		$id = $this->uri->segment(6);
        $status = $this->uri->segment(7);
        $data = array('status' => $status);
        $this->Crud_model->updateData('thematic_areas', $data, 'thematic_area_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success! </strong>Theme has been ' . strtolower($status) . '</div>');
        redirect(base_url() . 'admin/settings/thematicArea/theme/display/'.$parent, 'refresh');
        exit;
    }
    /******************End*********************************/
	
	/****************************Category**************************/
    public function categoryList()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
        $data["results"] 		= $this->Crud_model->getDataAll('m_categories');
        $data['count'] 			= count($data["results"]);
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Category list';
        $data['page_name'] 		= 'settings/category/index';
        $this->load->view('index', $data);
    }

    public function addCategory()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
		$data["results"] 		= 'True';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Add new category';
        $data['page_name'] 		= 'settings/category/add';
        $this->load->view('index', $data);
    }

    public function insertCategory()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
			exit;
        }

        if (empty($_REQUEST['title'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter title</div>');
            redirect(base_url() . 'admin/settings/category/add', 'refresh');
            exit;
        }
	
        $data = array('title' => ucfirst(strtolower($_REQUEST['title'])));
		
		$this->Crud_model->insertData('m_categories', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/categories/display', 'refresh');
        exit;
    }

    public function editCategory()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $id = $this->uri->segment(5);
        $single_data = $this->Crud_model->getData('m_categories', 'category_id', $id);
        $data = array('data' => $single_data[0], 'id' => $id);
		
        $data["results"] 		= 'TRUE';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Update category';
        $data['page_name'] 		= 'settings/category/edit';
        $this->load->view('index', $data);
    }

    public function updateCategory()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
			exit;
        }

        $id 	= $this->input->post('id');
		
		if (empty($_REQUEST['title'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter title</div>');
            redirect(base_url() . 'admin/settings/category/edit/' . $id, 'refresh');
            exit;
        }
	
        $data = array('title' => ucfirst(strtolower($_REQUEST['title'])));
		//echo "<pre>";print_r($data);die;
        $this->Crud_model->updateData('m_categories', $data, 'category_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/categories/display', 'refresh');
        exit;
    }

    public function changeStatusCategory()
    {
        $id = $this->uri->segment(4);
        $status = $this->uri->segment(5);
        $data = array('status' => $status);
        $this->Crud_model->updateData('m_categories', $data, 'category_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success! </strong>Category has been ' . strtolower($status) . '</div>');
        redirect(base_url() . 'admin/settings/categories/display', 'refresh');
        exit;
    }

    /******************End*********************************/
	
	/****************************Brand**************************/
    public function brandList()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
        $data["results"] 		= $this->Crud_model->getDataAll('m_brands');
        $data['count'] 			= count($data["results"]);
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Brand list';
        $data['page_name'] 		= 'settings/brand/index';
        $this->load->view('index', $data);
    }

    public function addBrand()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
		$data["results"] 		= 'True';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Add new brand';
        $data['page_name'] 		= 'settings/brand/add';
        $this->load->view('index', $data);
    }

    public function insertBrand()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
			exit;
        }

        if (empty($_REQUEST['title'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter title</div>');
            redirect(base_url() . 'admin/settings/brand/add', 'refresh');
            exit;
        }
	
        $data = array('title' => ucfirst(strtolower($_REQUEST['title'])));
		
		$this->Crud_model->insertData('m_brands', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/brands/display', 'refresh');
        exit;
    }

    public function editBrand()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $id = $this->uri->segment(5);
        $single_data = $this->Crud_model->getData('m_brands', 'brand_id', $id);
        $data = array('data' => $single_data[0], 'id' => $id);
		
        $data["results"] 		= 'TRUE';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Update brand';
        $data['page_name'] 		= 'settings/brand/edit';
        $this->load->view('index', $data);
    }

    public function updateBrand()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
			exit;
        }

        $id 	= $this->input->post('id');
		
		if (empty($_REQUEST['title'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter title</div>');
            redirect(base_url() . 'admin/settings/brand/edit/' . $id, 'refresh');
            exit;
        }
	
        $data = array('title' => ucfirst(strtolower($_REQUEST['title'])));
		//echo "<pre>";print_r($data);die;
        $this->Crud_model->updateData('m_brands', $data, 'brand_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/brands/display', 'refresh');
        exit;
    }

    public function changeStatusBrand()
    {
        $id = $this->uri->segment(4);
        $status = $this->uri->segment(5);
        $data = array('status' => $status);
        $this->Crud_model->updateData('m_brands', $data, 'brand_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success! </strong>Brand has been ' . strtolower($status) . '</div>');
        redirect(base_url() . 'admin/settings/brands/display', 'refresh');
        exit;
    }
    /******************End*********************************/
	
	/****************************Team**************************/
    public function teamList()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
        $data["results"] 		= $this->Crud_model->getDataAll('m_teams');
        $data['count'] 			= count($data["results"]);
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Team list';
        $data['page_name'] 		= 'settings/team/index';
        $this->load->view('index', $data);
    }

    public function addTeam()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
		$data["results"] 		= 'True';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Add new team';
        $data['page_name'] 		= 'settings/team/add';
        $this->load->view('index', $data);
    }

    public function insertTeam()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
			exit;
        }

        if (empty($_REQUEST['title'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter title</div>');
            redirect(base_url() . 'admin/settings/team/add', 'refresh');
            exit;
        }
	
        $data = array('title' => ucfirst(strtolower($_REQUEST['title'])));
		
		$this->Crud_model->insertData('m_teams', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/teams/display', 'refresh');
        exit;
    }

    public function editTeam()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $id = $this->uri->segment(5);
        $single_data = $this->Crud_model->getData('m_teams', 'team_id', $id);
        $data = array('data' => $single_data[0], 'id' => $id);
		
        $data["results"] 		= 'TRUE';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Update team';
        $data['page_name'] 		= 'settings/team/edit';
        $this->load->view('index', $data);
    }

    public function updateTeam()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
			exit;
        }

        $id 	= $this->input->post('id');
		
		if (empty($_REQUEST['title'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter title</div>');
            redirect(base_url() . 'admin/settings/team/edit/' . $id, 'refresh');
            exit;
        }
	
        $data = array('title' => ucfirst(strtolower($_REQUEST['title'])));
		//echo "<pre>";print_r($data);die;
        $this->Crud_model->updateData('m_teams', $data, 'team_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/teams/display', 'refresh');
        exit;
    }

    public function changeStatusTeam()
    {
        $id = $this->uri->segment(4);
        $status = $this->uri->segment(5);
        $data = array('status' => $status);
        $this->Crud_model->updateData('m_teams', $data, 'team_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success! </strong>Team has been ' . strtolower($status) . '</div>');
        redirect(base_url() . 'admin/settings/teams/display', 'refresh');
        exit;
    }
    /******************End*********************************/
	
	/****************************Case Study**************************/
    public function caseStudyList()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
        $data["results"] 		= $this->Crud_model->getDataAll('m_archieves');
        $data['count'] 			= count($data["results"]);
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Case study list';
        $data['page_name'] 		= 'settings/caseStudy/index';
        $this->load->view('index', $data);
    }

    public function addCaseStudy()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
		$data["thematicAreas"] 	= $this->Crud_model->getData2Asc('thematic_areas', 'parent', 'status', 0, 'Active', 'title');
		
		$data["results"] 		= 'True';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Add new case study';
        $data['page_name'] 		= 'settings/caseStudy/add';
        $this->load->view('index', $data);
    }

    public function insertCaseStudy()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
			exit;
        }

        if (empty($_REQUEST['title'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter title</div>');
            redirect(base_url() . 'admin/settings/caseStudy/add', 'refresh');
            exit;
        }
		
		if(!empty(@$_REQUEST['title']))
		{$title = $_REQUEST['title'];} else {$title="";}
	
		if(!empty(@$_REQUEST['description']))
		{$description = $_REQUEST['description'];} else {$description="";}
	
		if(!empty(@$_REQUEST['thematic_area_id']))
		{$thematic_area_id = $_REQUEST['thematic_area_id'];} else {$thematic_area_id="";}
	
		if(!empty(@$_REQUEST['theme_id']))
		{$theme_id = $_REQUEST['theme_id'];} else {$theme_id="";}
	
		if(!empty(@$_REQUEST['type']))
		{$type = $_REQUEST['type'];} else {$type="";}
	
		if($_REQUEST['type']=='Image')
		{
			if(!empty($_FILES['images']['name']))
			{   
				$img1Name = $_FILES['images']['name'];
				$img1Exp  = explode('.', $img1Name);
				$img1ext  = $img1Exp[count($img1Exp)-1];
				$img1Nm	  = $img1Exp[count($img1Exp)-2];
				if($img1ext=='jpg' || $img1ext=='png' || $img1ext=='JPG' || $img1ext=='JPEG' || $img1ext=='jpeg'  || $img1ext=='PNG' || $img1ext=='gif')
				{
					//@unlink("./uploads/caseStudy/images/".$_REQUEST['images']);
					$filename = time()."-images".".".$img1ext;
					$img1Path= "./uploads/caseStudy/images/".$img1Name;
					$iimg1mv=move_uploaded_file($_FILES['images']['tmp_name'], $img1Path);
					@rename("./uploads/caseStudy/images/".$img1Name, "./uploads/caseStudy/images/".$filename);
				}
				else
				{
					$this->session->set_flashdata('msg', '<font class="msg_red">Wrong File format for Image!</font>');
					redirect(base_url().'admin/setting/caseStudy/add', 'refresh');exit;
				}
			}
		}
		if($_REQUEST['type']=='Video')
		{
			$filename = $_REQUEST['utube'];
		}
		if($_REQUEST['type']=='Presentation')
		{
			if(!empty($_FILES['presentation']['name']))
			{   
				$img1Name = $_FILES['presentation']['name'];
				$img1Exp  = explode('.', $img1Name);
				$img1ext  = $img1Exp[count($img1Exp)-1];
				$img1Nm	  = $img1Exp[count($img1Exp)-2];
				if($img1ext=='ppt' || $img1ext=='pptx')
				{
					//@unlink("./uploads/caseStudy/presentation/".$_REQUEST['presentation']);
					$filename = time()."-presentation".".".$img1ext;
					$img1Path= "./uploads/caseStudy/presentation/".$img1Name;
					$iimg1mv=move_uploaded_file($_FILES['presentation']['tmp_name'], $img1Path);
					@rename("./uploads/caseStudy/presentation/".$img1Name, "./uploads/caseStudy/presentation/".$filename);
				}
				else
				{
					$this->session->set_flashdata('msg', '<font class="msg_red">Wrong File format for Image!</font>');
					redirect(base_url().'admin/setting/caseStudy/add', 'refresh');exit;
				}
			}
		}
	
        $data = array(
				'title' 			=> ucfirst(strtolower($_REQUEST['title'])),
				'description' 		=> $description,
				'thematic_area_id' 	=> $thematic_area_id,
				'theme_id' 			=> $theme_id,
				'type' 				=> $type,
				'images' 			=> $filename
			);
		
		//echo "<pre>"; print_r($data);die;
		$this->Crud_model->insertData('m_archieves', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/caseStudies/display', 'refresh');
        exit;
    }

    public function editCaseStudy()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $id = $this->uri->segment(5);
        $single_data = $this->Crud_model->getData('m_archieves', 'archieve_id', $id);
        $data = array('data' => $single_data[0], 'id' => $id);
		
		$data["thematicAreas"] 	= $this->Crud_model->getData2Asc('thematic_areas', 'parent', 'status', 0, 'Active', 'title');
		
        $data["results"] 		= 'TRUE';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Update case study';
        $data['page_name'] 		= 'settings/caseStudy/edit';
        $this->load->view('index', $data);
    }

    public function updateCaseStudy()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
			exit;
        }

        $id = $this->input->post('id');
		
		if (empty($_REQUEST['title'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter title</div>');
            redirect(base_url() . 'admin/settings/caseStudy/edit/' . $id, 'refresh');
            exit;
        }
	
       if(!empty(@$_REQUEST['title']))
		{$title = $_REQUEST['title'];} else {$title="";}
	
		if(!empty(@$_REQUEST['description']))
		{$description = $_REQUEST['description'];} else {$description="";}
	
		if(!empty(@$_REQUEST['thematic_area_id']))
		{$thematic_area_id = $_REQUEST['thematic_area_id'];} else {$thematic_area_id="";}
	
		if(!empty(@$_REQUEST['theme_id']))
		{$theme_id = $_REQUEST['theme_id'];} else {$theme_id="";}
	
		if(!empty(@$_REQUEST['type']))
		{$type = $_REQUEST['type'];} else {$type="";}
	
		if($_REQUEST['type']=='Image')
		{
			if(!empty($_FILES['images']['name']))
			{  
				$img1Name = $_FILES['images']['name'];
				$img1Exp  = explode('.', $img1Name);
				$img1ext  = $img1Exp[count($img1Exp)-1];
				$img1Nm	  = $img1Exp[count($img1Exp)-2];
				if($img1ext=='jpg' || $img1ext=='png' || $img1ext=='JPG' || $img1ext=='JPEG' || $img1ext=='jpeg'  || $img1ext=='PNG')
				{
					//@unlink("./uploads/caseStudy/images/".$_REQUEST['images']);
					$filename = time()."-images".".".$img1ext;
					$img1Path= "./uploads/caseStudy/images/".$img1Name;
					$iimg1mv=move_uploaded_file($_FILES['images']['tmp_name'], $img1Path);
					@rename("./uploads/caseStudy/images/".$img1Name, "./uploads/caseStudy/images/".$filename);
				}
				else
				{
					$this->session->set_flashdata('msg', '<font class="msg_red">Wrong File format for Image!</font>');
					redirect(base_url() . 'admin/settings/caseStudy/edit/' . $id, 'refresh');
				}
			} else { $filename = $_REQUEST['filename']; }
		}
		if($_REQUEST['type']=='Video')
		{
			$filename = $_REQUEST['utube'];
		}
		if($_REQUEST['type']=='Presentation')
		{
			if(!empty($_FILES['presentation']['name']))
			{  
				$img1Name = $_FILES['presentation']['name'];
				$img1Exp  = explode('.', $img1Name);
				$img1ext  = $img1Exp[count($img1Exp)-1];
				$img1Nm	  = $img1Exp[count($img1Exp)-2];
				if($img1ext=='ppt' || $img1ext=='pptx')
				{
					//@unlink("./uploads/caseStudy/presentation/".$_REQUEST['presentation']);
					$filename = time()."-presentation".".".$img1ext;
					$img1Path= "./uploads/caseStudy/presentation/".$img1Name;
					$iimg1mv=move_uploaded_file($_FILES['presentation']['tmp_name'], $img1Path);
					@rename("./uploads/caseStudy/presentation/".$img1Name, "./uploads/caseStudy/presentation/".$filename);
				}
				else
				{
					$this->session->set_flashdata('msg', '<font class="msg_red">Wrong File format for Image!</font>');
					redirect(base_url() . 'admin/settings/caseStudy/edit/' . $id, 'refresh');
				}
			} else { $filename = $_REQUEST['filename']; }
		}
	
        $data = array(
				'title' 			=> ucfirst(strtolower($_REQUEST['title'])),
				'description' 		=> $description,
				'thematic_area_id' 	=> $thematic_area_id,
				'theme_id' 			=> $theme_id,
				'type' 				=> $type,
				'images' 			=> $filename
			);
		//echo "<pre>";print_r($data);die;
        $this->Crud_model->updateData('m_archieves', $data, 'archieve_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/caseStudies/display', 'refresh');
        exit;
    }

    public function changeStatusCaseStudy()
    {
        $id = $this->uri->segment(4);
        $status = $this->uri->segment(5);
        $data = array('status' => $status);
        $this->Crud_model->updateData('m_archieves', $data, 'archieve_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success! </strong>Case study has been ' . strtolower($status) . '</div>');
        redirect(base_url() . 'admin/settings/caseStudies/display', 'refresh');
        exit;
    }
    /******************End*********************************/
	
	/****************************State**************************/
    public function stateList()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $data["results"] 		= $this->Crud_model->getData('states','country_id',1);
        $data['count'] 			= count($data["results"]);
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'States list';
        $data['page_name'] 		= 'settings/state/index';
        $this->load->view('index', $data);
    }

    public function addState()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $data["results"] 		= 'True';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Add new state';
        $data['page_name'] 		= 'settings/state/add';
        $this->load->view('index', $data);
    }

    public function addDistrict(){
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $data["results"] 		= $this->Crud_model->getData('states','country_id',1);
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Add District';
        $data['page_name'] 		= 'settings/state/district';
        $this->load->view('index', $data);
    }

    public function insertState()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
            exit;
        }

        if (empty($_REQUEST['title'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter name</div>');
            redirect(base_url() . 'admin/settings/state/add', 'refresh');
            exit;
        }

        $data = array('title' => ucfirst(strtolower($_REQUEST['title'])),'country_id'=>'101');

        $this->Crud_model->insertData('states', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/states/display', 'refresh');
        exit;
    }

    public function editState()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $id = $this->uri->segment(5);
        $single_data = $this->Crud_model->getData('states', 'state_id', $id);
        $data = array('data' => $single_data[0], 'state_id' => $id);

        $data["results"] 		= 'TRUE';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Update State';
        $data['page_name'] 		= 'settings/state/edit';
        $this->load->view('index', $data);
    }

    public function updateState()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
            exit;
        }

        $id= $this->input->post('state_id');

        if (empty($_REQUEST['title'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter name</div>');
            redirect(base_url() . 'admin/settings/state/edit/' . $id, 'refresh');
            exit;
        }

        $data = array('title' => ucfirst(strtolower($_REQUEST['title'])));
        $this->Crud_model->updateData('states', $data, 'state_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/states/display', 'refresh');
        exit;
    }

    public function changeStatusState()
    {
        $id = $this->uri->segment(4);
        $status = $this->uri->segment(5);
        $data = array('status' => $status);
        $this->Crud_model->updateData('states', $data, 'state_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success! </strong>State has been ' . strtolower($status) . '</div>');
        redirect(base_url() . 'admin/settings/states/display', 'refresh');
        exit;
    }
    /******************End*********************************/

    /****************************City**************************/
    public function cityList()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $data["results"] 		= $this->Crud_model->get_generalAll_sort_asc('cities','title');
       //print_r($data["results"] );die;
        $data['count'] 			= count($data["results"]);
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Cities list';
        $data['page_name'] 		= 'settings/city/index';
        $this->load->view('index', $data);
    }

    public function addCity()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $data["results"] 		= 'True';
        $data['admin_folder'] 	= 'TRUE';
        $data['states'] 	=  $this->Crud_model->get_generalAll_sort_asc('states','title');
        $data['title'] 			= 'Add new city';
        $data['page_name'] 		= 'settings/city/add';
        $this->load->view('index', $data);
    }

    public function insertCity()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
            exit;
        }

        if (empty($_REQUEST['title'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter name</div>');
            redirect(base_url() . 'admin/settings/city/add', 'refresh');
            exit;
        }
        if (empty($_REQUEST['state_id'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please select state</div>');
            redirect(base_url() . 'admin/settings/city/add', 'refresh');
            exit;
        }

        $data = array('title' => ucfirst(strtolower($_REQUEST['title'])),'state_id'=>$_REQUEST['state_id']);

        $this->Crud_model->insertData('cities', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/cities/display', 'refresh');
        exit;
    }

    public function editCity()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $id = $this->uri->segment(5);
        $single_data = $this->Crud_model->getData('cities', 'city_id', $id);
        $data = array('data' => $single_data[0], 'city_id' => $id);

        $data["results"] 		= 'TRUE';
        $data['admin_folder'] 	= 'TRUE';
        $data['states'] 	=  $this->Crud_model->get_generalAll_sort_asc('states','title');
        $data['title'] 			= 'Update City';
        $data['page_name'] 		= 'settings/city/edit';
        $this->load->view('index', $data);
    }

    public function updateCity()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
            exit;
        }

        $id= $this->input->post('city_id');

        if (empty($_REQUEST['title'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter name</div>');
            redirect(base_url() . 'admin/settings/city/edit/' . $id, 'refresh');
            exit;
        }
        if (empty($_REQUEST['state_id'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please select state</div>');
            redirect(base_url() . 'admin/settings/city/edit/' . $id, 'refresh');
            exit;
        }


        $data = array('title' => ucfirst(strtolower($_REQUEST['title'])),'state_id' => $_REQUEST['state_id']);
        $this->Crud_model->updateData('cities', $data, 'city_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/cities/display', 'refresh');
        exit;
    }

    public function changeStatusCity()
    {
        $id = $this->uri->segment(4);
        $status = $this->uri->segment(5);
        $data = array('status' => $status);
        $this->Crud_model->updateData('cities', $data, 'city_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success! </strong>City has been ' . strtolower($status) . '</div>');
        redirect(base_url() . 'admin/settings/cities/display', 'refresh');
        exit;
    }
    /******************End*********************************/

    /****************************assistedBy**************************/
    public function assistedByList()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $data["results"] 		= $this->Crud_model->getDataAll('m_assisted_by');
        $data['count'] 			= count($data["results"]);
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Sector list';
        $data['page_name'] 		= 'settings/assistedBy/index';
        $this->load->view('index', $data);
    }

    public function addAssistedBy()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $data["results"] 		= 'True';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Add new Sector';
        $data['page_name'] 		= 'settings/assistedBy/add';
        $this->load->view('index', $data);
    }

    public function insertAssistedBy()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
            exit;
        }

        if (empty($_REQUEST['title'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter title</div>');
            redirect(base_url() . 'admin/settings/assistedBy/add', 'refresh');
            exit;
        }

        $data = array('title' => ucfirst(strtolower($_REQUEST['title'])));

        $this->Crud_model->insertData('m_assisted_by', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/assistedBy/display', 'refresh');
        exit;
    }

    public function editAssistedBy()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $id = $this->uri->segment(5);
        $single_data = $this->Crud_model->getData('m_assisted_by', 'assisted_by_id', $id);
        $data = array('data' => $single_data[0], 'id' => $id);

        $data["results"] 		= 'TRUE';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Update Sector';
        $data['page_name'] 		= 'settings/assistedBy/edit';
        $this->load->view('index', $data);
    }

    public function updateAssistedBy()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
            exit;
        }
        $id = $this->input->post('id');

        if (empty($_REQUEST['title'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter title</div>');
            redirect(base_url() . 'admin/settings/assistedBy/edit/' . $id, 'refresh');
            exit;
        }

        $data = array('title' => ucfirst(strtolower($_REQUEST['title'])));
        //echo "<pre>";print_r($data);die;
        $this->Crud_model->updateData('m_assisted_by', $data, 'assisted_by_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/assistedBy/display', 'refresh');
        exit;
    }

    public function changeStatusAssistedBy()
    {
        $id = $this->uri->segment(4);
        $status = $this->uri->segment(5);
        $data = array('status' => $status);
        $this->Crud_model->updateData('m_assisted_by', $data, 'assisted_by_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success! </strong>Sector has been ' . strtolower($status) . '</div>');
        redirect(base_url() . 'admin/settings/assistedBy/display', 'refresh');
        exit;
    }
    /******************End*********************************/

    /****************************sector section**************************/
    public function sectorList()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $data["results"] 		= $this->Crud_model->getDataAll('m_sectors');
        $data['count'] 			= count($data["results"]);
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Sector list';
        $data['page_name'] 		= 'settings/sector/index';
        $this->load->view('index', $data);
    }

    public function addSector()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $data["results"] 		= 'True';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Add New Sector';
        $data['page_name'] 		= 'settings/sector/add';
        $this->load->view('index', $data);
    }

    public function insertSector()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
            exit;
        }

        if (empty($_REQUEST['title'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter title</div>');
            redirect(base_url() . 'admin/settings/sector/add', 'refresh');
            exit;
        }

        $data = array('title' => ucfirst(strtolower($_REQUEST['title'])));

        $this->Crud_model->insertData('m_sectors', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/sectors/display', 'refresh');
        exit;
    }

    public function editSector()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $id = $this->uri->segment(5);
        $single_data = $this->Crud_model->getData('m_sectors', 'sector_id', $id);
        $data = array('data' => $single_data[0], 'id' => $id);

        $data["results"] 		= 'TRUE';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Update Sector';
        $data['page_name'] 		= 'settings/sector/edit';
        $this->load->view('index', $data);
    }

    public function updateSector()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
            exit;
        }
        $id = $this->input->post('id');

        if (empty($_REQUEST['title'])) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter title</div>');
            redirect(base_url() . 'admin/settings/sector/edit/' . $id, 'refresh');
            exit;
        }

        $data = array('title' => ucfirst(strtolower($_REQUEST['title'])));
        $this->Crud_model->updateData('m_sectors', $data, 'sector_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'admin/settings/sectors/display', 'refresh');
        exit;
    }

    public function changeStatusSector()
    {
        $id = $this->uri->segment(4);
        $status = $this->uri->segment(5);
        $data = array('status' => $status);
        $this->Crud_model->updateData('m_sectors', $data, 'sector_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success! </strong>Sector has been ' . strtolower($status) . '</div>');
        redirect(base_url() . 'admin/settings/sectors/display', 'refresh');
        exit;
    }


    public function csr_overview(){
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
        $data["results"] 		= $this->Crud_model->getDataAll('thematic_spends');
        $data['count'] 			= count($data["results"]);
        
        $data['admin_folder'] = 'TRUE';
        $data['title'] = 'CSR Overview';
        
        $data['page_name'] = 'settings/csroverview/index';
        $this->load->view('index', $data);
    }

    public function editCSRProjectCount(){
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
        $data['project_count'] = $this->Crud_model->getDataFromGeneralTable('Total CSR Projects');   
        $data["results"] 		= 'True';
        $data['admin_folder'] 	= 'TRUE';
        $data['title'] 			= 'Update CSR Project Count';
        $data['page_name'] 		= 'settings/csroverview/edit';
        $this->load->view('index', $data);
    }

    public function updateCSRProjectCount()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url() . 'admin', 'refresh');
			exit;
        }

        $project_count = $this->input->post('inObj');
		// echo "<pre>";print_r($project_count);die;
        $this->Crud_model->updateDataGeneralTable('Total CSR Projects', $project_count);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been updated.</div>');
        redirect(base_url() . 'admin/settings/csroverview/display', 'refresh');
        exit;
    }

    public function csrBulkUpload() {
        if($this->session->userdata('logged_in')!='1')
        { redirect(base_url().'admin', 'refresh'); }

        $data["results"]    ='True';
        $data['admin_folder']  = 'TRUE';
        $data['title']         = 'Thematic Area Spend Upload';
        $data['page_name']     = 'settings/csroverview/bulkUpload';
        $this->load->view('index',$data);
    }

    public function thematic_overview(){
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $data["thematic_area"]  = $this->Crud_model->getData('loc_thematic_areas', 'parent_id', '0');;
        $data["results"] 		= 'True';        
        $data['admin_folder'] = 'TRUE';
        $data['title'] = 'Thematic Overview';
        
        $data['page_name'] = 'settings/thematicOverview/index';
        $this->load->view('index', $data);
    }

    public function need_assessment(){
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $data["thematic_area"]  = $this->Crud_model->getData('loc_thematic_areas', 'parent_id', '0');;
        $data["results"] 		= 'True';        
        $data['admin_folder'] = 'TRUE';
        $data['title'] = 'Need Assessment';
        
        $data['page_name'] = 'settings/needAssessment/index';
        $this->load->view('index', $data);
    }

    /******************End*********************************/
}
/***************************End****************************/
