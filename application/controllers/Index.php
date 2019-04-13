<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->model('front/Front_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('pagination');
		$this->load->library('email');
	}
	
	public function index()
	{
		$data['admin_folder']    = "False";
        $data["results"]         = "True";
        
		$data['title']         	 = 'Vault';
        $data['description']     = 'Vault';
        $data['keyword']         = 'Vault';
        $data['breadcrumb']      = 'Home';
		$data['page_name']       = 'login/home';
		$this->load->view('index',$data);
	}
	
	public function clientLogin()
	{
		$data['admin_folder']    = "False";
        $data["results"]         = "True";
		
		$data['role']			 = '5';
		
        $data['title']			 = 'Client Login';
        $data['keyword']       	 = 'Client Login';
        $data['description']     = 'Client Login';
        $data['breadcrumb']      = 'Client Login';
        $data['page_name']       = 'login/clientLogin';
        $this->load->view('index',$data);
	}
	
	public function agencyLogin()
	{
		$data['admin_folder']    = "False";
        $data["results"]         = "True";
		
		$data['role']			 = '2,3,4,6,7';
		
        $data['title']			 = 'Agency Login';
        $data['keyword']       	 = 'Agency Login';
        $data['description']     = 'Agency Login';
        $data['breadcrumb']      = 'Agency Login';
        $data['page_name']       = 'login/agencyLogin';
        $this->load->view('index',$data);
	}
	
	public function loginUp()
	{
		$username 	= $_REQUEST['username'];
		$pass 	= md5($_REQUEST['password']);
		$ref	= $_REQUEST['ref'];
		$role	= $_REQUEST['role'];
		
		if(empty($username))
		{
			$this->session->set_flashdata('msg', '<font class="msg_red">User ID can\'t be empty!</font>');
			redirect($ref, 'refresh');exit;
		}
		if(empty($pass))
		{
			$this->session->set_flashdata('msg', '<font class="msg_red">Password can\'t be empty!</font>');
			redirect($ref, 'refresh');exit;
		}
		
		$loginVal = $this->Front_model->getLogin('users', $username, $pass, $role);
		//echo "<pre>";print_r($loginVal);die;
		if(count($loginVal)>0)
		{
			$newdata = array('front_user_id'  => $loginVal[0]['user_id'], 'role' => $loginVal[0]['role_id'], 'front_user_logged_in' => 1);
			$this->session->set_userdata($newdata);
			//echo "<pre>";print_r($_SESSION);die;
			$dt		 = date("Y-m-d H:i:s");
			$data1 	 = array('last_login' => date('Y-m-d H:i:s'));
			$data1 	 = $this->security->xss_clean($data1);
			$dataRtn = $this->Front_model->updateData('users', $data1, 'user_id', $this->session->userdata('front_user_id'));
			redirect(base_url()."dashboard", 'refresh');exit;
		}
		else
		{
			$this->session->set_flashdata('msg', '<font class="msg_red">Invalid user details!</font>');
			redirect($ref, 'refresh');exit;
		}
	}
	
	public function logout()
	{
		$this->session->unset_userdata('front_user_id');
		$this->session->unset_userdata('front_user_logged_in');
		$this->session->sess_destroy();
		redirect(base_url(), 'refresh');exit;
	}

	public function forgotPassword()
	{
		$data['admin_folder']    = "False";
        $data["results"]         = "True";
        $data['title']         	 = "Forgot Password";
        $data['description']     = "Forgot Password";
        $data['keyword']         = "Forgot Password";
        $data['breadcrumb']      = "Forgot Password";
        $data['page_name']       = 'login/forgotPassword';
        $this->load->view('index',$data);
    }
	
	public function change_password_up()
	{
		$val1		= urldecode($_REQUEST['val']);
		$returndata = array();
		$strArray 	= explode("&", $val1);
		for($i=0;$i<count($strArray);$i++) 
		{
			$array = explode("=", $strArray[$i]);
			$nam[] = $array[0];
			$val[] = $array[1];
		}
		
		$password 	= $val[0];
		$npassword	= $val[1];
		$cnpassword	= $val[2];

		if(empty($password))
		{ echo '<font class="msg_red">Old password can not be empty!</font>';exit; }

		if(empty($npassword))
		{ echo '<font class="msg_red">New password can not be empty!</font>';exit; }

		if(empty($cnpassword))
		{ echo '<font class="msg_red">Confirm password can not be empty!</font>';exit; }

		if($npassword!=$cnpassword)
		{ echo '<font class="msg_red">New Password and Confirm New Password are not matched!</font>';exit; }

		$passCount=count($this->Front_model->getData('users', 'password', md5($password)));
		if($passCount<1)
		{ echo '<font class="msg_red">Your old password are not matched!</font>';exit; }
		
		$userId     =$this->session->userdata('front_user_id');
		$data1 = array('password'=>md5($npassword));
		//echo "<pre>";print_r($data1);
		$dataRtn = $this->Front_model->updateData('users',$data1, 'user_id', $userId);
		echo '<font class="msg_green">New password has been changed!</font>';exit;
	}
	
	public function error()
	{
		$data['admin_folder']  = 'False';
        $data["results"]       = "True";
        $data['title']         = '404';
        $data['keyword']       = '404';
        $data['description']   = '404';
        $data['breadcrumb']    = '404';
        $data['page_name']     = '404';
        $this->load->view('index',$data);
	}
}
