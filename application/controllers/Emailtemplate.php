<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emailtemplate extends Auth_Controller {

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
	 * Email Template
	 * @return Layout
	 */
	public function email_template(){
		if(@$this->userType == '0'){
			$data['template_list'] = $this->Common_model->getall_data('*', 'email_template', '');
			$this->load->view('template/header');
			$this->load->view('emailtemplate/email-template', $data);
			$this->load->view('template/footer');
		} else{
			redirect('leave-requests');
		} 
	}

	/**
	 * Insert Leave
	 * @return Result
	 */
	public function insert_emailtemplate(){
		$template_id = $this->input->post('template_name');
		$data['text'] = $this->input->post('template_content');
		$data['updateDate'] = date("Y-m-d H:i:s");
		$result = $this->Common_model->update($data, 'email_template', array('template_id' => $template_id));
		if($result){
			$this->session->set_flashdata('message', 'Email Template Updated Successfully.');
			redirect('email-template');
		} else{
			$this->session->set_flashdata('error', 'Email Template Update Failed.');
			redirect('email-template');
		}
	}

	/**
	 * Get Template Content
	 * @return Result
	 */
	public function get_template_content(){
		$templateId = $this->input->post('templateId');
		$templateContent = $this->Common_model->getSingle_data('text', 'email_template', array('template_id' => $templateId));
		echo $templateContent['text']; exit;
	}

}