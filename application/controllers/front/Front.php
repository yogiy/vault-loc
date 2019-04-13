<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->model('front/Front_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('pagination');
		$this->load->library('email');
	}
	
	public function dashboard()
	{
		if ($this->session->userdata('front_user_logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		
		$data['admin_folder']    = "False";
        $data["results"]         = "True";
		
        $data['title']			 = 'Agency Login';
        $data['keyword']       	 = 'Agency Login';
        $data['description']     = 'Agency Login';
        $data['breadcrumb']      = 'Agency Login';
        $data['page_name']       = 'login/dashboard';
        $this->load->view('index',$data);
	}
	
	/************************Common Function************************************/
	public function randomNumber($length) 
	{
		$result = '';
		for($i = 0; $i < $length; $i++) 
		{
			$result .= mt_rand(0, 9);
		}
		return $result;
	}
	
	function crypto_rand_secure($min, $max)
    {
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);
        return $min + $rnd;
    }

    function getToken($length)
    {
        $token = "";
        $codeAlphabet= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max-1)];
        }

        return $token;
    }
}
