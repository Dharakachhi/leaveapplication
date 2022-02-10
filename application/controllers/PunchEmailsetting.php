<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PunchEmailsetting extends Auth_Controller {

	/**
	 * construct
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('Common_model');
		$this->userId = $this->session->userdata('userId');
		$this->userType = $this->session->userdata('userType');
	}

	/**
	 * Punch Email Setting
	 * @return Layout
	 */
	public function punchemail_setting(){
		if(@$this->userType == '0'){
			$data['email_info'] = $this->Common_model->getSingle_data('*', 'email_info', '');
			$this->load->view('template/header');
			$this->load->view('punchemailsetting/punch-email-setting',$data);
			$this->load->view('template/footer');
		} else{
			redirect('time-adjustment-request');
		} 
	}

	/**
	 * Insert Punch email setting
	 * @return Result
	 */
	public function insert_punchemailsetting(){
		$id = $this->input->post('email_id');
		$data['host'] = $this->input->post('host');
		$data['port'] = $this->input->post('port');
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		$data['from_email'] = $this->input->post('from_email');
		$data['email_title'] = $this->input->post('email_title');
		$data['updateDate'] = date("Y-m-d H:i:s");

		$result = $this->Common_model->update($data, 'email_info', array('id' => $id));
		if($result){
			$this->session->set_flashdata('message', 'Punch Email Setting Updated Successfully.');
			redirect('punch-email-setting');
		} else{
			$this->session->set_flashdata('error', 'Punch Email Setting Update Failed.');
			redirect('punch-email-setting');
		}
	}

}