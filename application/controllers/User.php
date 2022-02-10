<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Auth_Controller {

	/**
	 * construct
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('Common_model');
		$this->load->model('User_model');
		$this->userId = $this->session->userdata('userId');
		$this->userType = $this->session->userdata('userType');
	}

	/**
	 * User List
	 * @return Layout
	 */
	public function user_list(){
		if(@$this->userType != '2'){
			if(@$this->userType == '1'){
				$data['user_list'] = $this->Common_model->getall_data('*', 'user_master', array('user_type' => '2'));
			} else{
				$data['user_list'] = $this->Common_model->getall_data('*', 'user_master', array('user_type !=' => '0'));
			}
			
			$this->load->view('template/header');
			$this->load->view('user/user_list', $data);
			$this->load->view('template/footer');
		} else{
			redirect('leave-requests');
		}
	}

	/**
	 * Create User
	 * @return Layout
	 */
	public function create_user(){
		if(@$this->userType != '2'){
			$data['hr_list'] = $this->Common_model->getall_data('id, firstName, lastName', 'user_master', array('isActive' => '1', 'user_type' => '1'));
			$data['state_list'] = $this->Common_model->getall_data('id, name', 'states', array('country_id' => '233'));
			$this->load->view('template/header');
			$this->load->view('user/add_user', $data);
			$this->load->view('template/footer');
		} else{
			redirect('leave-requests');
		}
	}

	/**
	 * Insert User
	 * @return Result
	 */
	public function insert_user(){
		$data['firstName'] = $this->input->post('firstName');
		$data['lastName'] = $this->input->post('lastName');
		$data['email'] = $this->input->post('user_email');
		$data['password'] = md5($this->input->post('user_password'));
		$data['isActive'] = $this->input->post('user_status');
		$data['user_type'] = $this->input->post('user_type');
		$data['phone'] = $this->input->post('user_phone');
		$data['preferred_contact_method'] = $this->input->post('contact_method');
		$data['discipline'] = $this->input->post('discipline');
		$data['state'] = $this->input->post('state');
		$data['facility'] = $this->input->post('facility');
		$data['check_header'] = (implode(",",$this->input->post('check_header')));
		$data['createDate'] = date("Y-m-d H:i:s");
		$data['updateDate'] = date("Y-m-d H:i:s");
		$result = $this->Common_model->insert($data, 'user_master');
		if($result){
			$this->session->set_flashdata('message', 'User Created Successfully.');
			redirect('user-list');
		} else{
			$this->session->set_flashdata('error', 'User Create Failed.');
			redirect('user-list');
		}
	}

	/**
	 * Edit User
	 * @return Layout
	 */
	public function edit_user($id){
		if(@$this->userType != '2'){
			$data['single_user'] = $this->Common_model->getSingle_data('*', 'user_master', array('id' => $id));
			$data['check_header'] = (explode(",",$data['single_user']['check_header']));
			$data['hr_list'] = $this->Common_model->getall_data('id, firstName, lastName', 'user_master', array('isActive' => '1', 'user_type' => '1', 'id != ' => $id));
			$data['state_list'] = $this->Common_model->getall_data('id, name', 'states', array('country_id' => '233'));
			$this->load->view('template/header');
			$this->load->view('user/edit_user', $data);
			$this->load->view('template/footer');
		} else{
			redirect('leave-requests');
		}
	}

	/**
	 * Update User
	 * @return Result
	 */
	public function update_user(){
		$user_id = $this->input->post('user_id');
		$data['firstName'] = $this->input->post('firstName');
		$data['lastName'] = $this->input->post('lastName');
		$data['email'] = $this->input->post('user_email');
		if($this->input->post('user_password1') != ''){
			$data['password'] = md5($this->input->post('user_password1'));
		}
		$data['phone'] = $this->input->post('user_phone');
		$data['preferred_contact_method'] = $this->input->post('contact_method');
		$data['discipline'] = $this->input->post('discipline');
		$data['state'] = $this->input->post('state');
		$data['facility'] = $this->input->post('facility');
		$data['isActive'] = $this->input->post('user_status');
		$data['check_header'] = (implode(",",$this->input->post('check_header')));
		$data['user_type'] = $this->input->post('user_type');
		$data['updateDate'] = date("Y-m-d H:i:s");

		$result = $this->Common_model->update($data, 'user_master', array('id' => $user_id));
		if($result){
			$this->session->set_flashdata('message', 'User Updated Successfully.');
			redirect('user-list');
		} else{
			$this->session->set_flashdata('error', 'User Update Failed.');
			redirect('user-list');
		}
	}

	/*
	 * Check Duplicate Email
	 */
	public function check_duplicate_email($id=''){
		$user_email = $this->input->post('user_email');
		$result = $this->User_model->check_duplicate_email($user_email, $id);
		echo $result; exit;
	}

	public function change_user_status(){
		$data['isActive'] = $this->input->post('status');
		$userId = $this->input->post('userId');
		$result = $this->Common_model->update($data, 'user_master', array('id' => $userId));
		if($result){
			echo "update";
		} else{
			echo "error";
		}
		exit;
	}
}