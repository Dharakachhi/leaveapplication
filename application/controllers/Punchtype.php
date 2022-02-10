<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Punchtype extends Auth_Controller {

	/**
	 * construct
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('Common_model');
		$this->load->model('Punchtype_model');
		$this->userId = $this->session->userdata('userId');
		$this->userType = $this->session->userdata('userType');
	}

	/**
	 * Supervisor List
	 * @return Layout
	 */
	public function punchtype_list(){
			$data['punch_type'] = $this->Common_model->getall_data('*', 'punch_type','1 ORDER BY id DESC');
			$this->load->view('template/header');
			$this->load->view('punch_type/punch_type_list',$data);
			$this->load->view('template/footer');
	}


	/**
	 * Create Supervisor
	 * @return Layout
	 */
	public function create_punch_type(){
			$this->load->view('template/header');
			$this->load->view('punch_type/add_punchtype');
			$this->load->view('template/footer');
	}
		/**
	 * Create Supervisor
	 * @return Layout
	 */
	public function dublicate_type($id=''){
		$punch_type_name = $this->input->post('punch_type_name');
		$result = $this->Punchtype_model->dublicate_type($punch_type_name, $id);
		echo $result; exit;
	}


	/**
	 * Insert Supervisor
	 * @return Result
	 */
	public function insert_punchtype(){
		$data['punch_type_name'] = trim($this->input->post('punch_type_name'));
		$data['order_by'] = $this->input->post('order_by');
		$data['isActive'] = $this->input->post('punchtype_status');
		$data['createDate'] = date("Y-m-d H:i:s");
		$data['updateDate'] = date("Y-m-d H:i:s");
		$result = $this->Common_model->insert($data, 'punch_type');
		if($result){
			$this->session->set_flashdata('message', 'Punch Type Created Successfully.');
			redirect('punch-type');
		} else{
			$this->session->set_flashdata('error', 'Punch Type Create Failed.');
			redirect('punch-type');
		}
	}

	/**
	 * Edit Supervisor
	 * @return Layout
	 */
	public function edit_punchtype($id){
			$data['punch_type'] = $this->Common_model->getSingle_data('*', 'punch_type', array('id' => $id));
			$this->load->view('template/header');
			$this->load->view('punch_type/edit_punchtype', $data);
			$this->load->view('template/footer');
	}

		/**
	 * Delete Supervisor
	 * @return Layout
	 */
	public function delete_punchtype($id){
		$result = $this->Common_model->delete('punch_type', array('id' => $id));
			if($result){
			$this->session->set_flashdata('message', 'Punch Type Delete Successfully.');
			redirect('punch-type');
		} else{
			$this->session->set_flashdata('error', 'Punch Type Delete Failed.');
			redirect('punch-type');
		}
	}

	/**
	 * Update Supervisor
	 * @return Result
	 */
	public function update_punchtype(){
		$type_id = $this->input->post('type_id');
		$data['punch_type_name'] = trim($this->input->post('punch_type_name'));
		$data['order_by'] = $this->input->post('order_by');
		$data['isActive'] = $this->input->post('punchtype_status');
		$data['updateDate'] = date("Y-m-d H:i:s");
		
		$result = $this->Common_model->update($data, 'punch_type', array('id' => $type_id));
		if($result){
			$this->session->set_flashdata('message', 'Punch Type Updated Successfully.');
			redirect('punch-type');
		} else{
			$this->session->set_flashdata('error', 'Punch Type Update Failed.');
			redirect('punch-type');
		}
	}

	public function change_punch_type(){
		$data['isActive'] = $this->input->post('status');
		$typeId = $this->input->post('typeId');
		$result = $this->Common_model->update($data, 'punch_type', array('id' => $typeId));
		if($result){
			echo "update";
		} else{
			echo "error";
		}
		exit;
	}
}