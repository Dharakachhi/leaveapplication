<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * construct
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('Common_model');
		$this->load->model('Login_model');
		$this->load->helper('mailhelper');
	}

	/**
	 * Admin Login Page
	 * @return Layout
	 */
	public function index(){
		if (!$this->session->userdata('userEmail')){
			$this->load->view('template/Loginheader');
			$this->load->view('login/login');
			$this->load->view('template/Loginfooter');
		} else{
			redirect('leave-requests');
		}
	}

	/**
	 * Check Login Detail
	 * @return result
	 */
	public function check_frontlogin(){
		$email = $this->input->post('user_email');
		$password = md5($this->input->post('user_password'));
		$result = $this->Common_model->getSingle_data('*', 'user_master', array('email' => $email, 'password' => $password, 'isActive' => '1'));
		$supervisor = $this->Common_model->getSingle_data('*', 'facilities_list', array('supervisor_email' => $email, 'password' => $password, 'isActive' => '1'));
		if(!empty($result)){
			$checkHeader = explode(",", $result['check_header']);
			$name = $result['firstName'] ." ".$result['lastName'];
			$this->session->set_userdata('userId', $result['id']);
			$this->session->set_userdata('userName', $name);
			$this->session->set_userdata('userEmail', $result['email']);
			$this->session->set_userdata('userType', $result['user_type']);
			$this->session->set_userdata('checkHeader', $result['check_header']);
			if($result['user_type'] == '1'){
				$this->session->set_userdata('ResStatus','Approved');
			}else{
					$this->session->set_userdata('ResStatus','0');
			}


			if((((@$checkHeader[0] == '1' && @$checkHeader[1] == '0') || (@$checkHeader[0] == '0' && @$checkHeader[1] == '1')) && $result['user_type'] == '1') || ((@$checkHeader[0] == '1' || @$checkHeader[1] == '1' ) && ($result['user_type'] == '0' || $result['user_type'] == '1')) ||  $result['user_type'] == '0'){
				redirect('leave-requests');
			}
			if((@$checkHeader[0] == '0' || @$checkHeader[1] == '0') && $result['user_type'] == '1'){
				redirect('time-adjustment-request');
			}

		} else if(!empty($supervisor)){
			$this->session->set_userdata('sup_id',$supervisor['id']);
			$this->session->set_userdata('userName',$supervisor['rehab_director']);
			$this->session->set_userdata('userEmail',$supervisor['supervisor_email']);
			$this->session->set_userdata('userType', $supervisor['userType']);
			$this->session->set_userdata('ResStatus','New');

			redirect('time-adjustment-request');
		}else{
			$this->session->set_flashdata('error', 'Incorrect Email or Password');
			redirect(base_url());

		}
	}

	/**
	 * Logout
	 */
	public function front_logout(){
		session_destroy();
		redirect(base_url());
	}

	/**
	 * Create Account Page
	 * @return Layout
	 */
	public function create_user(){
		if (!$this->session->userdata('userEmail')){
			$this->load->view('template/Loginheader');
			$this->load->view('login/create_user');
			$this->load->view('template/Loginfooter');
		} else{
			redirect(base_url());
		}
	}

	/**
	 * Insert User
	 */
	public function insert_user(){
		$data['firstName'] = $this->input->post('firstName');
		$data['lastName'] = $this->input->post('lastName');
		$data['email'] = $this->input->post('user_email');
		$data['password'] = md5($this->input->post('user_password'));
		$data['isActive'] = '1';
		$data['user_type'] = $this->input->post('user_type');
		$data['createDate'] = date("Y-m-d H:i:s");
		$data['updateDate'] = date("Y-m-d H:i:s");
		$result = $this->Common_model->insert($data, 'user_master');
		if($result){
			$this->session->set_flashdata('message', 'Account Created Successfully.');
			redirect('login');
		} else{
			$this->session->set_flashdata('error', 'Account Create Failed.');
			redirect('login');
		}
	}

	/*
	 * Check Duplicate Email
	 */
	public function check_duplicate_email(){
		$user_email = $this->input->post('user_email');
		$result = $this->Login_model->check_duplicate_email($user_email);
		echo $result; exit;
	}

	/**
	 * Forgot Password
	 * @return Layout
	 */
	public function forgot_password(){
		if (!$this->session->userdata('userEmail')){
			$this->load->view('template/Loginheader');
			$this->load->view('login/forget_password');
			$this->load->view('template/Loginfooter');
		} else{
			redirect(base_url());
		}
	}

	/**
	 * Send Link for change Password
	 */
	public function forgot_mail(){
		$user_email = $this->input->post('user_email');
		$result = $this->Common_model->getSingle_data('id', 'user_master', array('email' => $user_email));
		$facility = $this->Common_model->getSingle_data('id', 'facilities_list', array('supervisor_email' => $user_email));
		if(!empty($result)){
			$to_mail = $user_email;
			$key="_MY_SECRET_STRING";
	        $url = base64_encode($result['id'].$key);
	        $url = str_replace('=', '', $url);
			$link = base_url('reset-password/'.$url);

            $Subject = "Reset Password";
            $body = '<div style="line-height:1.38;margin-top:0pt;margin-bottom:0pt">
			  <div style="line-height:1.38;margin-top:0pt;margin-bottom:0pt">
			    <span style="font-size: 18.6667px;">Reset Your Password From below link: </span>
			  </div>
			</div>
			<div style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><br></div>
			<p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;" align="left">
			  <span style="font-size: 11pt; font-family: " lucida="" grande";="" color:="" rgb(0,="" 0,="" 0);="" background-color:="" transparent;="" font-weight:="" 400;="" font-style:="" normal;="" font-variant:="" text-decoration:="" none;="" vertical-align:="" baseline;="" white-space:="" pre-wrap;"=""><a href="'.$link.'" class="btn-primary" target="_blank" itemprop="url">Reset Your Password Now</a></span>
			</p>';
            $res = simpleMail($to_mail,$Subject,$body);
            file_put_contents(FILE_PATH.'uploads/log/'.date("d-m-Y").'_maillog.txt', "\n---------- Forgot Email Send to Employee -------------\n".$res , FILE_APPEND);
            if(strpos($res, 'Successfully') !== false){
				$this->session->set_flashdata('message', 'Check your email and click the link to reset your password.');
            	redirect('login');
            } else{
            	$this->session->set_flashdata('error', 'Mail send failed');
            	redirect('login');
            }
		}elseif(!empty($facility)){
			$to_mail = $user_email;
			$key="_MY_SECRET_STRING";
	        $url = base64_encode($facility['id'].$key);
	        $url = str_replace('=', '', $url);
			$link = base_url('reset-password/'.$url);
            $Subject = "Reset Password";
            $body = '<div style="line-height:1.38;margin-top:0pt;margin-bottom:0pt">
			  <div style="line-height:1.38;margin-top:0pt;margin-bottom:0pt">
			    <span style="font-size: 18.6667px;">Reset Your Password From below link: </span>
			  </div>
			</div>
			<div style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><br></div>
			<p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;" align="left">
			  <span style="font-size: 11pt; font-family: " lucida="" grande";="" color:="" rgb(0,="" 0,="" 0);="" background-color:="" transparent;="" font-weight:="" 400;="" font-style:="" normal;="" font-variant:="" text-decoration:="" none;="" vertical-align:="" baseline;="" white-space:="" pre-wrap;"=""><a href="'.$link.'" class="btn-primary" target="_blank" itemprop="url">Reset Your Password Now</a></span>
			</p>';
            $res = simpleMail($to_mail,$Subject,$body);
            file_put_contents(FILE_PATH.'uploads/log/'.date("d-m-Y").'_maillog.txt', "\n---------- Forgot Email Send to Employee -------------\n".$res , FILE_APPEND);
            if(strpos($res, 'Successfully') !== false){
				$this->session->set_flashdata('message', 'Check your email and click the link to reset your password.');
            	redirect('login');
            } else{
            	$this->session->set_flashdata('error', 'Mail send failed');
            	redirect('login');
            }

		} else{
			$this->session->set_flashdata('error', 'Incorrect Email ID');
            redirect('forgot-password');
		}
	}

	/**
	 * Reset Password Page
	 * @return Layout
	 */
	public function reset_password($id){
		if (!$this->session->userdata('userEmail')){
			$decrypted_id = base64_decode($id);
	        $arr = explode("_", $decrypted_id, 2);
	        $data['user_id'] = $arr[0];
			$this->load->view('template/Loginheader');
			$this->load->view('login/reset_password', $data);
			$this->load->view('template/Loginfooter');
		} else{
			redirect(base_url());
		}
	}

	/**
	 * Change Password
	 */
	public function change_password(){
		$user_id = $this->input->post('user_id');
		$data['password'] = md5($this->input->post('user_password'));
		$data['updateDate'] = date("Y-m-d H:i:s");

		$result = $this->Common_model->update($data, 'user_master', array('id' => $user_id));
		$facility = $this->Common_model->update($data, 'facilities_list', array('id' => $user_id));
		if($result){
			$this->session->set_flashdata('message', 'Password Updated Successfully.');
			redirect('login');
		}else if($facility){
			$this->session->set_flashdata('message', 'Password Updated Successfully.');
			redirect('login');
		} else{
			$this->session->set_flashdata('error', 'Password Update Failed.');
			redirect('login');
		}
	}
}