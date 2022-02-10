<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Punchstatus extends Auth_Controller {

	/**
	 * construct
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('Common_model');
		$this->load->model('Punchstatus_model');
		$this->userId = $this->session->userdata('userId');
		$this->userType = $this->session->userdata('userType');
	}

	/**
	 * Supervisor List
	 * @return Layout
	 */
	public function punchstatus_list(){
			$data['punch_status'] = $this->Common_model->getall_data('*', 'punch_status','1 ORDER BY id DESC');
			$this->load->view('template/header');
			$this->load->view('punch_status/punch_status_list',$data);
			$this->load->view('template/footer');
	}


	/**
	 * Create Supervisor
	 * @return Layout
	 */
	public function create_punch_status(){
			$this->load->view('template/header');
			$this->load->view('punch_status/add_punchstatus');
			$this->load->view('template/footer');
	}
		/**
	 * Create Supervisor
	 * @return Layout
	 */
	public function dublicate_status($id=''){
		$punch_status_name = $this->input->post('punch_status_name');
		$result = $this->Punchstatus_model->dublicate_status($punch_status_name, $id);
		echo $result; exit;
	}


	/**
	 * Insert Supervisor
	 * @return Result
	 */
	public function insert_punchstatus(){
		$data['punch_status_name'] = trim($this->input->post('punch_status_name'));
		$data['order_by'] = $this->input->post('order_by');
		$data['isActive'] = $this->input->post('punch_status');
		$data['createDate'] = date("Y-m-d H:i:s");
		$data['updateDate'] = date("Y-m-d H:i:s");
		$result = $this->Common_model->insert($data, 'punch_status');
		if($result){
			$this->session->set_flashdata('message', 'Punch Status Created Successfully.');
			redirect('punch-status');
		} else{
			$this->session->set_flashdata('error', 'Punch Status Create Failed.');
			redirect('punch-status');
		}
	}

	/**
	 * Edit Supervisor
	 * @return Layout
	 */
	public function edit_punchstatus($id){
			$data['punch_status'] = $this->Common_model->getSingle_data('*', 'punch_status', array('id' => $id));
			$this->load->view('template/header');
			$this->load->view('punch_status/edit_punchstatus', $data);
			$this->load->view('template/footer');
	}

		/**
	 * Delete Supervisor
	 * @return Layout
	 */
	public function delete_punchstatus($id){
		$result = $this->Common_model->delete('punch_status', array('id' => $id));
			if($result){
			$this->session->set_flashdata('message', 'Punch Status Delete Successfully.');
			redirect('punch-status');
		} else{
			$this->session->set_flashdata('error', 'Punch Status Delete Failed.');
			redirect('punch-status');
		}
	}

	/**
	 * Update Supervisor
	 * @return Result
	 */
	public function update_punchstatus(){
		$status_id = $this->input->post('status_id');
		$data['punch_status_name'] = trim($this->input->post('punch_status_name'));
		$data['order_by'] = $this->input->post('order_by');
		$data['isActive'] = $this->input->post('punch_status');
		$data['updateDate'] = date("Y-m-d H:i:s");
		
		$result = $this->Common_model->update($data, 'punch_status', array('id' => $status_id));
		if($result){
			$this->session->set_flashdata('message', 'Punch Status Updated Successfully.');
			redirect('punch-status');
		} else{
			$this->session->set_flashdata('error', 'Punch Status Update Failed.');
			redirect('punch-status');
		}
	}

	public function change_punch_status(){
		$data['isActive'] = $this->input->post('status');
		$statusId = $this->input->post('statusId');
		$result = $this->Common_model->update($data, 'punch_status', array('id' => $statusId));
		if($result){
			echo "update";
		} else{
			echo "error";
		}
		exit;
	}
}