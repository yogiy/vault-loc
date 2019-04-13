<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller
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


    /***************************Auth***************************/
    public function index()
    {
        $this->load->view('admin/login_mod/login');
    }

    public function login_up()
    {

        if ($this->input->post('submit')) {
            //print_r(1);die;
            $email = $this->input->post('email');
            $pass = $this->input->post('pass');

            if (empty($email) || empty($pass)) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter valid login details</div>');
                redirect(base_url().'admin', 'refresh');
                exit;
            } elseif (empty($pass)) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter password</div>');
                redirect(base_url().'admin', 'refresh');
                exit;
            } else {
                $data = $this->Crud_model->get_login_value($email, $pass);
                $count = $data->num_rows();
                $result = $data->row_array();
                if ($count == '1') {
                    $newdata = array(
                        'admin_id' => $result['admin_id'],
                        'f_name' => $result['fname'],
                        'l_name' => $result['lname'],
                        'role' => $result['role_id'],
                        'email' => $result['email'],
                        'logged_in' => 1
                    );
                    //print_r($newdata);die;
                    $this->session->set_userdata($newdata);
                    $id = $result['admin_id'];
                    $dt = date("Y-m-d H:i:s");
                    $data = $this->Crud_model->update_login_time($dt, $id);
                    redirect(base_url() . 'admin/dashboard', 'refresh');
                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong> Invalid login details</div>');
                    redirect(base_url().'admin', 'refresh');
                    exit;
                }
            }
        }
    }

    /************************Forgot Password********************/
    public function forgot_password()
    {
        $this->load->view('admin/login_mod/forgot_password');
    }

    public function forgot_password_up()
    {
        $email =$_REQUEST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $this->session->set_flashdata('msg', '<font class="msg_red">Invalid Email Format!</font>');
            redirect(base_url().'forgot/password', 'refresh');exit;
        }

        $chk_dup_mail=$this->Crud_model->get_general('admins', 'email', $email);
        $name= @$chk_dup_mail[0]['name'];
        if(@count($chk_dup_mail)<1)
        {
            $this->session->set_flashdata('msg', '<font class="msg_red">This email address is not registered.</font>');
            redirect(base_url().'forgot/password', 'refresh');exit;
        }
        else
        {
            $randNo=rand(100000, 999999);
            $data1 = array(
                'rand'=>$randNo,
                'opened'=>1
            );
            //echo "<pre>";print_r($data1);die;
            $dataRtn = $this->Crud_model->general_update('admins',$data1, 'email', $email);
            //echo "===";die;
            $verifyEml="&email=".$email."&id=".$chk_dup_mail[0]['id']."&opened=1"."&rand=".$randNo;
            $verifytxt=base64_encode($verifyEml);
            /******************Start Mail Function************************/
            $loginNew = $this->Crud_model->get_general('admins', 'email', $email);
            $name=$loginNew[0]['fname'].' '.$loginNew[0]['lname'];
            $to=$email;
            $message='
					<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
					<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
					<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<title></title>
					
				</head>
				<body style="padding:0px; margin:0px; background-color:#FFFFFF">
					<table style="max-width:700px; min-width:320px; -webkit-text-size-adjust:100%; mso-table-lspace:0pt; mso-table-rspace:0pt;" border="0" cellpadding="0" cellspacing="0" align="center">
						<tbody>
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td style="border:1px solid #d6d9e4;" width="700">
									<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
										<tbody>
											<tr>
												<td style="text-align:left;">
													<div class="col-sm-3">
														<div class="logo" style="padding:5px;text-align:center;">
															<h1>Finance Application</h1>
														</div>
													</div>
												</td>
											</tr>
											<tr><td style="border-bottom:1px solid #ddd;"></td></tr>
											<tr>
												<td align="center" bgcolor="#fcfcfc" style="padding:15px 30px;">
													<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
														<tbody>
															<tr>
																<td colspan="2" style="font-size: 18px;font-weight: 700;color:#53566b">Hi '.ucfirst($name).',</td>
															</tr>
															<tr><td>&nbsp;</td></tr>
															<tr>
																<td style="font-size: 14px;font-weight: lighter;color:#53566b; padding-bottom: 10px;" width="100%">A request to reset your account password was received. Click the button to reset your password and log in to your account.</td>
															</tr>
															<tr><td style="height:10px;"></td></tr>
															<tr>
																<td style="font-size: 14px;font-weight: lighter;color:#53566b; padding-bottom: 10px;" width="100%"><a href="'.base_url().'page-reset/'.$verifytxt.'" class="btn btn-warning" style="background: #666666;padding: 5px 10px;color: #FFF;text-decoration:  none;border-radius: 3px;">Reset your password</a></td>
															</tr>
															
															<tr><td>&nbsp;</td></tr>
															<tr><td align="left" style="font-size:14px; color:#33324f;">Best Regards,</td></tr>
															<tr><td style="height:4px;"></td></tr>
															<tr><td align="left" style="font-size:18px;font-weight:700;color:#53566b;">Finance Application</td></tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</body>
				</html>';
            //echo $message;die;
            $subject  = 'Finance application password reset';
            $from 	  = 'info@finance.productionserver.co.in';
            // To send HTML mail, the Content-type header must be set
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            // Create email headers
            $headers .= 'From: '.$from."\r\n".
                'X-Mailer: PHP/' . phpversion();
            @mail($to, $subject, $message, $headers);
        }
        redirect(base_url().'forgot/password', 'refresh');exit;
    }

    public function forgot_successful()
    {
        $data["results"] = 'True';
        $data['admin_folder'] = 'TRUE';

        $data['title']         = 'Forgot Successful';
        $data['keyword']       = 'Forgot Successful';
        $data['description']   = 'Forgot Successful';
        $data['breadcrumb']    = 'Forgot Successful';
        $data['page_name']     = 'login_mod/forgot_successful';
        $this->load->view('index',$data);
    }

    public function page_reset()
    {
        $this->load->view('admin/login_mod/page_reset');
    }


    public function reset_password_up()
    {
        $npass = $_REQUEST['npass'];
        $cpass = $_REQUEST['cpass'];

        $id = $_REQUEST['id'];
        $abc = array_filter(explode('&', base64_decode($id)));
        //echo "<pre>";print_r($abc);die;
        $id = explode('=', $abc[2]);

        if(empty($npass))
        {
            $this->session->set_flashdata('msg', '<font class="msg_red">Please enter new password!</font>');
            redirect(base_url().'page-reset/'.$id, 'refresh');exit;
        }
        if(empty($cpass))
        {
            $this->session->set_flashdata('msg', '<font class="msg_red">Please enter confirm password!</font>');
            redirect(base_url().'page-reset/'.$id, 'refresh');exit;
        }
        if($npass != $cpass)
        {
            $this->session->set_flashdata('msg', '<font class="msg_red">New password and confirm password are not same!</font>');
            redirect(base_url().'page-reset/'.$id, 'refresh');exit;
        }

        $data1 = array(
            'password'=>md5($npass),
            'plain'=>$npass,
            'rand'=>"",
            'opened'=>0
        );
        //print_r($data1);die;
        $data1 = $this->security->xss_clean($data1);
        $dataRtn = $this->Crud_model->general_update('admins', $data1, 'admin_id', $id[1]);

        /******************Email mail funtion *******************/
        $userId = $id[1];
        $loginNew = $this->Crud_model->get_general('admins', 'admin_id', $userId);
        $name=$loginNew[0]['fname'].' '.$loginNew[0]['lname'];
        $to = $loginNew[0]['email'];
        $subject = 'You’ve successfully reset your Password';
        $from = 'posp@maxlifeinsurance.com ';
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        // Create email headers
        $headers .= 'From: posp@maxlifeinsurance.com '."\r\n".
            'Reply-To: noreply@maxlife.com'."\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $message = '
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<title></title>
			</head>
			<body style="padding:0px; margin:0px; background-color:#FFFFFF">
				<table style="max-width:700px; min-width:320px; -webkit-text-size-adjust:100%; mso-table-lspace:0pt; mso-table-rspace:0pt;" border="0" cellpadding="0" cellspacing="0" align="center">
					<tbody>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td style="border:1px solid #d6d9e4;" width="700">
								<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
									<tbody>
										<tr>
											<td style="text-align:left;">
												<div class="col-sm-3">
													<div class="logo" style="padding:5px;text-align:center;">
															<h1>Finance Application</h1>
														</div>
												</div>
											</td>
										</tr>
										<tr><td style="border-bottom:1px solid #ddd;"></td></tr>
										<tr>
											<td align="center" bgcolor="#fcfcfc" style="padding:15px 30px;">
												<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
													<tbody>
														<tr>
															<td colspan="2" style="font-size: 18px;font-weight: 700;color:#53566b">Dear '.ucfirst($name).',</td>
														</tr>
														<tr><td>&nbsp;</td></tr>
														<tr>
															<td style="font-size: 14px;font-weight: lighter;color:#53566b; padding-bottom: 10px;" width="100%">You have successfully reset your password. You can now login into your account with your new password to Organize Spectacular Experiences!</td>
														</tr>
														
														<tr><td>&nbsp;</td></tr>
														<tr><td align="left" style="font-size:14px; color:#33324f;">Best Regards</td></tr>
														<tr><td align="left" style="font-size:18px;font-weight:700;color:#53566b;">Finance Application</td></tr>
													</tbody>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</body>
			</html>';
        //echo $message;die;
        $subject  = 'Finance application password reset';
        $from 	  = 'info@finance.productionserver.co.in';
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        // Create email headers
        $headers .= 'From: '.$from."\r\n".
            'X-Mailer: PHP/' . phpversion();
        @mail($to, $subject, $message, $headers);

        redirect(base_url(), 'refresh');exit;
    }
    /*************************End******************************/

    public function dashboard()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
		if($_SERVER['HTTP_HOST'] =='localhost')
		{
			$df = disk_free_space("C:");
			/* and get disk space total (in bytes) */
			$dt = disk_total_space("C:");
		}else{
			$df = disk_free_space("/var/www/html");
			/* and get disk space total (in bytes) */
			$dt = disk_total_space("/var/www/html");
		}
        /* now we calculate the disk space used (in bytes) */
        $du = $dt - $df;
        /* percentage of disk used - this will be used to also set the width % of the progress bar */
        $dp = sprintf('%.2f',($du / $dt) * 100);
        /* and we formate the size from bytes to MB, GB, etc. */
        $df = $this->formatSize($df);
        $du = $this->formatSize($du);
        $dt = $this->formatSize($dt);
        $data["all_storage_space"] = $dt;
        $data["free_space"] = $df;
        $data["rest_storage_space"] = $du;
        $today = date('Y-m-d h:i:s');
        $fifteendays = date('Y-m-d h:i:s', strtotime('-10 days', strtotime($today)));
       // print_r($today);
       // print_r($fifteendays);die;
        $data["new_ngos"] = $this->Crud_model->recordBetween('m_ngo','created_date',$fifteendays,$today);
        $data["clients"] = $this->Crud_model->recordCountEqual('users','role_id',5);
        $data["employees"] = $this->Crud_model->recordCountNotEqual('users','role_id',5,'role_id',1,'role_id',2);
        $data["markets"] = $this->Crud_model->recordCountAll('m_market');
        $data["themeticAreas"] = $this->Crud_model->recordCountAll('thematic_areas');
        $data["ngos"] = $this->Crud_model->recordCountAll('m_ngo');
        $data["caseStudies"] = $this->Crud_model->recordCountAll('m_archieves');
        $data["results"] ='TRUE';
        $data['admin_folder'] = 'TRUE';
        $data['title'] = 'Dashboard';
        $data['page_name'] = 'login_mod/dashboard';
        //print_r($data);die;
        $this->load->view('index', $data);
    }


    function formatSize( $bytes ) {
        $types = array( 'B', 'KB', 'MB', 'GB', 'TB' );
        for( $i = 0; $bytes >= 1024 && $i < ( count( $types ) -1 );$bytes /= 1024, $i++ );
        return( round( $bytes, 2 ) . " " . $types[$i] );
    }


    /*********************User Section***********************/
    public function user_list()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }
        $data["results"] = $this->Crud_model->get_generalAll_sort_asc('admins', 'fname');
        $data['count'] = count($data["results"]);
        $data['admin_folder'] = 'TRUE';
        $data['title'] = 'User List';
        $data['page_name'] = 'user_mod/users';
        $this->load->view('index', $data);
    }

    public function add_user()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $data["results"] = 'True';
        $data['admin_folder'] = 'TRUE';
        $data['title'] = 'Add new user';
        $data['page_name'] = 'user_mod/add_user';
        $this->load->view('index', $data);
    }

    public function insert_user()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
        }

        $fname = $_REQUEST['fname'];
        $lname = @$_REQUEST['lname'];
        $email = $_REQUEST['email'];
        $role = $_REQUEST['role'];
        $pass = $_REQUEST['pass'];
        $cpass = $_REQUEST['c_pass'];

        if (empty($fname)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter first name</div>');
            redirect(base_url() . 'users/add', 'refresh');
            exit;
        }
        $this->session->set_userdata(array('fnameAF' => $fname, 'lnameAF' => $lname));

        if (empty($role)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please select role</div>');
            redirect(base_url() . 'users/add', 'refresh');
            exit;
        }

        if (empty($email)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter email Id</div>');
            redirect(base_url() . 'users/add', 'refresh');
            exit;
        }

        /***************Password policy**********************/
        $uppercase = preg_match('@[A-Z]@', $pass);
        $lowercase = preg_match('@[a-z]@', $pass);
        $number = preg_match('@[0-9]@', $pass);

        if (!$uppercase || !$lowercase || !$number || strlen($pass) < 6) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Password must be of minimum 6 characters with at least 1 capital letter, 1 small letter and 1 numeric digit</div>');
            redirect(base_url() . 'users/add', 'refresh');
            exit;
        }
        /******************End************************/


        $usrDup = $this->Crud_model->get_general('admins', 'email', $_REQUEST['email']);
        if (count($usrDup) > 0) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>This email is already taken, Please choose another</div>');
            redirect(base_url() . 'users/add', 'refresh');
            exit;
        }
        $this->session->set_userdata(array('emailAF' => $email));

        if (empty($pass)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter password</div>');
            redirect(base_url() . 'users/add', 'refresh');
            exit;
        }

        /***************Password policy**********************/
        $uppercase = preg_match('@[A-Z]@', $pass);
        $lowercase = preg_match('@[a-z]@', $pass);
        $number = preg_match('@[0-9]@', $pass);

        if (!$uppercase || !$lowercase || !$number || strlen($pass) < 6) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Password must be of minimum 6 characters with at least 1 capital letter, 1 small letter and 1 numeric digit</div>');
            redirect(base_url() . 'users/add', 'refresh');
            exit;
        }
        /******************End************************/

        if (empty($cpass)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter confirm password</div>');
            redirect(base_url() . 'users/add', 'refresh');
            exit;
        }

        if ($pass != $cpass) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Password and confirm password are not matched</div>');
            redirect(base_url() . 'users/add', 'refresh');
            exit;
        }

        if (!empty($_FILES['images']['name'])) {
            if (!empty($_FILES['images']['name'])) {
                $img1Name = $_FILES['images']['name'];
                $img1Exp = explode('.', $img1Name);
                $img1ext = $img1Exp[count($img1Exp) - 1];
                $img1Nm = $img1Exp[count($img1Exp) - 2];
                if ($img1ext == 'jpg' || $img1ext == 'png' || $img1ext == 'JPG' || $img1ext == 'JPEG' || $img1ext == 'jpeg' || $img1ext == 'PNG') {
                    @unlink("./uploads/profile/" . $_FILES['images']['name']);
                    $img1_nm = time() . $img1Nm . "-profile" . "." . $img1ext;
                    $img1Path = "./uploads/profile/" . $img1Name;
                    $iimg1mv = move_uploaded_file($_FILES['images']['tmp_name'], $img1Path);
                    @rename("./uploads/profile/" . $img1Name, "./uploads/profile/" . $img1_nm);
                }
            }
        } else {
            $img1_nm = '';
        }

        $data1 = array('fname' => $fname, 'lname' => $lname, 'email' => $email, 'password' => md5($pass), 'plain' => $pass, 'role' => $role, 'creation_date' => date('Y-m-d H:i:s'), 'img1' => $img1_nm);
        //print_r($data1);die;
        $dataRtn = $this->Crud_model->general_insert('admins', $data1);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'users/display', 'refresh');
        exit;
    }

    public function edit_user()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $id = $this->uri->segment(3);
        $single_data = $this->Crud_model->get_general('admins', 'admin_id', $id);
        $data = array('data' => $single_data[0], 'id' => $id);

        $data["results"] = 'TRUE';
        $data['admin_folder'] = 'TRUE';
        $data['title'] = 'Update user';
        $data['page_name'] = 'user_mod/edit_user';
        $this->load->view('index', $data);
    }

    public function update_user()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
        }

        $id = $this->input->post('id');
        $fname = $_REQUEST['fname'];
        $lname = @$_REQUEST['lname'];
        $role = $_REQUEST['role'];


        if (empty($fname)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please enter first name</div>');
            redirect(base_url() . 'users/edit/' . $id, 'refresh');
            exit;
        }

        if (empty($role)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Please select role</div>');
            redirect(base_url() . 'users/edit/' . $id, 'refresh');
            exit;
        }

        if (!empty($_FILES['images']['name'])) {
            if (!empty($_FILES['images']['name'])) {
                $img1Name = $_FILES['images']['name'];
                $img1Exp = explode('.', $img1Name);
                $img1ext = $img1Exp[count($img1Exp) - 1];
                $img1Nm = $img1Exp[count($img1Exp) - 2];
                if ($img1ext == 'jpg' || $img1ext == 'png' || $img1ext == 'JPG' || $img1ext == 'JPEG' || $img1ext == 'jpeg' || $img1ext == 'PNG') {
                    @unlink("./uploads/profile/" . $_FILES['images']['name']);
                    $img1_nm = time() . $img1Nm . "-profile" . "." . $img1ext;
                    $img1Path = "./uploads/profile/" . $img1Name;
                    $iimg1mv = move_uploaded_file($_FILES['images']['tmp_name'], $img1Path);
                    @rename("./uploads/profile/" . $img1Name, "./uploads/profile/" . $img1_nm);
                }
            }
        } else {
            $img1_nm = $_REQUEST['images'];
        }

        $data1 = array('fname' => $fname, 'role' => $role, 'lname' => $lname, 'img1' => $img1_nm);
        $dataRtn = $this->Crud_model->general_update('admins', $data1, 'admin_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Record has been saved.</div>');
        redirect(base_url() . 'users/display', 'refresh');
        exit;
    }

    public function delete_user() {
        $id = $this->uri->segment(3);
        $val = $this->Crud_model->delete_general($id, 'admin_id', 'admins');
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success! </strong>User has been deleted</div>');
        redirect(base_url() . 'users/display', 'refresh');
        exit;
    }

    public function chngSts_user() {
        $id = $this->uri->segment(2);
        $status = $this->uri->segment(3);
        $data1 = array('status' => $status);
        $dataRtn = $this->Crud_model->general_update('admins', $data1, 'admin_id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success! </strong>User name has been ' . strtolower($status) . '</div>');
        redirect(base_url() . 'users/display', 'refresh');
        exit;
    }

    /****************************End*****************************/

    public function changePassword()
    {
        if ($this->session->userdata('logged_in') != '1') {
            redirect(base_url(), 'refresh');
            exit;
        }

        $data["results"] = 'True';
        $data['admin_folder'] = 'TRUE';
        $data['title'] = 'Change Password';
        $data['page_name'] = 'user_mod/change_password';
        $this->load->view('index', $data);
    }

    public function updatePassword()
    {
        $id = $_REQUEST['id'];
        $opass = $_REQUEST['opass'];
        $npass = $_REQUEST['npass'];
        $cnpass = $_REQUEST['cnpass'];

        if (empty($opass)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Existing password can not be empty</div>');
            redirect(base_url() . 'admin/password/change', 'refresh');
            exit;
        }

        if (empty($npass)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>New password can not be empty</div>');
            redirect(base_url() . 'admin/password/change', 'refresh');
            exit;
        }

        if (empty($npass)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Confirm password can not be empty</div>');
            redirect(base_url() . 'admin/password/change', 'refresh');
            exit;
        }

        /***************Password policy**********************/
        $uppercase = preg_match('@[A-Z]@', $npass);
        $lowercase = preg_match('@[a-z]@', $npass);
        $number = preg_match('@[0-9]@', $npass);

        if (!$uppercase || !$lowercase || !$number || strlen($npass) < 6) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Password must be of minimum 6 characters with at least 1 capital letter, 1 small letter and 1 numeric digit</div>');
            redirect(base_url() . 'admin/password/change', 'refresh');
            exit;
        }
        /******************End************************/

        if ($npass != $cnpass) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Both password are not matched, please try again</div>');
            redirect(base_url() . 'admin/password/change', 'refresh');
            exit;
        }

        $chk = count($this->Crud_model->get_general_mul('admins', 'admin_id', 'password', $id, md5($opass)));
        if ($chk < 1) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>Existing password are incorrect, please try again.</div>');
            redirect(base_url() . 'admin/password/change', 'refresh');
            exit;
        }

        $data1 = array('password' => md5($npass), 'plain' => $npass);
        $this->Crud_model->general_update('admins', $data1, 'id', $id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success! </strong>New password has been changed</div>');
        redirect(base_url() . 'admin/password/change', 'refresh');
        exit;
    }


    public function logout()
    {
        $this->session->unset_userdata('admin_id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect(base_url().'admin', 'refresh');
        exit;
    }

    /***************************Auth***************************/

}
/***************************End****************************/

