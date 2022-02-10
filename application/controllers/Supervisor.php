<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supervisor extends Auth_Controller {

	/**
	 * construct
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('Common_model');
		$this->load->model('Supervisor_model');
		$this->userId = $this->session->userdata('userId');
		$this->userType = $this->session->userdata('userType');
	}

	/**
	 * Supervisor List
	 * @return Layout
	 */
	public function supervisor_list(){
			$data['facilities_list'] = $this->Common_model->getall_data('*', 'facilities_list','1 ORDER BY id DESC');
			$this->load->view('template/header');
			$this->load->view('supervisor/supervisor_list', $data);
			$this->load->view('template/footer');
	}


	/**
	 * Create Supervisor
	 * @return Layout
	 */
	public function create_supervisor(){
			$this->load->view('template/header');
			$this->load->view('supervisor/add_supervisor');
			$this->load->view('template/footer');
	}


	/**
	 * Insert Supervisor
	 * @return Result
	 */
	public function insert_supervisor(){
		$data['facility_name'] = trim($this->input->post('facility_name'));
		$data['supervisor_email'] = trim($this->input->post('supervisor_email'));
		$data['password'] = md5($this->input->post('sup_password'));
		$data['rehab_director'] = trim($this->input->post('rehab_director'));
		$data['regl_mgr'] = trim($this->input->post('regl_mgr'));
		$data['regl_mgr_email'] = trim($this->input->post('regl_mgr_email'));
		$data['isActive'] = $this->input->post('sup_status');
		$data['userType'] = 2;
		$data['createDate'] = date("Y-m-d H:i:s");
		$data['updateDate'] = date("Y-m-d H:i:s");
		$result = $this->Common_model->insert($data, 'facilities_list');
		if($result){
			$this->session->set_flashdata('message', 'Supervisor Created Successfully.');
			redirect('supervisor-list');
		} else{
			$this->session->set_flashdata('error', 'Supervisor Create Failed.');
			redirect('supervisor-list');
		}
	}

	/**
	 * Edit Supervisor
	 * @return Layout
	 */
	public function edit_supervisor($id){
			$data['single_supervisor'] = $this->Common_model->getSingle_data('*', 'facilities_list', array('id' => $id));
			$this->load->view('template/header');
			$this->load->view('supervisor/edit_supervisor', $data);
			$this->load->view('template/footer');
	}

		/**
	 * Delete Supervisor
	 * @return Layout
	 */
	public function delete_supervisor($id){
		$result = $this->Common_model->delete('facilities_list', array('id' => $id));
			if($result){
			$this->session->set_flashdata('message', 'Supervisor Delete Successfully.');
			redirect('supervisor-list');
		} else{
			$this->session->set_flashdata('error', 'Supervisor Delete Failed.');
			redirect('supervisor-list');
		}
	}

	/**
	 * Update Supervisor
	 * @return Result
	 */
	public function update_supervisor(){
		$sup_id = $this->input->post('sup_id');
		$data['facility_name'] = trim($this->input->post('facility_name'));
		$data['supervisor_email'] = trim($this->input->post('supervisor_email'));
		if($this->input->post('password_sup') != ''){
		$data['password'] = md5($this->input->post('password_sup'));
		}
		$data['rehab_director'] = trim($this->input->post('rehab_director'));
		$data['regl_mgr'] = trim($this->input->post('regl_mgr'));
		$data['regl_mgr_email'] = trim($this->input->post('regl_mgr_email'));
		$data['isActive'] = $this->input->post('sup_status');
		$data['userType'] = 2;
		$data['updateDate'] = date("Y-m-d H:i:s");
		
		$result = $this->Common_model->update($data, 'facilities_list', array('id' => $sup_id));
		if($result){
			$this->session->set_flashdata('message', 'Supervisor Updated Successfully.');
			redirect('supervisor-list');
		} else{
			$this->session->set_flashdata('error', 'Supervisor Update Failed.');
			redirect('supervisor-list');
		}
	}

	/*
	 * Check Duplicate Email
	 */
	public function check_duplicate_email($id = '') {
		$supervisor_email = $this->input->post('supervisor_email');
		$supervisor_password = $this->input->post('sup_password');
		$result = $this->Supervisor_model->check_duplicate_email($supervisor_email, $supervisor_password, $id);
		echo $result; exit;
	}

	public function check_duplicate_email_edit($id = '') {
		$supervisor_email = $this->input->post('supervisor_email');
		$supervisor_password = $this->input->post('password_sup');
		if ($supervisor_password == '') {
			$result = $this->Common_model->getSingle_data('password', 'facilities_list', array('supervisor_email' => $supervisor_email));
			$supervisor_password = $result['password'];
		}
		$result = $this->Supervisor_model->check_duplicate_email($supervisor_email, $supervisor_password, $id);
		echo $result; exit;
	}

	public function change_sup_status(){
		$data['isActive'] = $this->input->post('status');
		$supId = $this->input->post('supId');
		$result = $this->Common_model->update($data, 'facilities_list', array('id' => $supId));
		if($result){
			echo "update";
		} else{
			echo "error";
		}
		exit;
	}
}