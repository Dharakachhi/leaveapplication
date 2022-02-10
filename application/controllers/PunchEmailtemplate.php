<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PunchEmailtemplate extends Auth_Controller {

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
	 * Punch Email Template
	 * @return Layout
	 */
	public function punchemail_template(){
			$data['template_list'] = $this->Common_model->getall_data('*', 'punch_email_template', '');
			$this->load->view('template/header');
			$this->load->view('punchemailtemplate/punch-email-template', $data);
			$this->load->view('template/footer');
	}

	/**
	 * Insert Punch
	 * @return Result
	 */
	public function insert_punchemailtemplate(){
		$template_id = $this->input->post('template_name');
		$data['text'] = $this->input->post('template_content');
		$data['subject'] = $this->input->post('email_subject');
		$data['updateDate'] = date("Y-m-d H:i:s");
		$result = $this->Common_model->update($data, 'punch_email_template', array('template_id' => $template_id));
		if($result){
			$this->session->set_flashdata('message', 'Punch Email Template Updated Successfully.');
			redirect('punch-email-template');
		} else{
			$this->session->set_flashdata('error', 'Punch Email Template Update Failed.');
			redirect('punch-email-template');
		}
	}

	/**
	 * Get Template Content
	 * @return Result
	 */
	public function get_template_content(){
		$templateId = $this->input->post('templateId');
		$templateContent = $this->Common_model->getSingle_data('subject,text', 'punch_email_template', array('template_id' => $templateId));
		echo json_encode($templateContent);exit;
	}

}