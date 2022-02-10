<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discipline extends Auth_Controller {

	/**
	 * construct
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('Common_model');
		$this->load->model('Descipline_model');
		$this->userId = $this->session->userdata('userId');
		$this->userType = $this->session->userdata('userType');
	}

	/**
	 * Supervisor List
	 * @return Layout
	 */
	public function discipline_list(){
			$data['discipline'] = $this->Common_model->getall_data('*', 'discipline','1 ORDER BY id DESC');
			$this->load->view('template/header');
			$this->load->view('discipline/discipline_list',$data);
			$this->load->view('template/footer');
	}


	/**
	 * Create Supervisor
	 * @return Layout
	 */
	public function create_discipline(){
			$this->load->view('template/header');
			$this->load->view('discipline/add_discipline');
			$this->load->view('template/footer');
	}
		/**
	 * Create Supervisor
	 * @return Layout
	 */
	public function dublicate_discipline_status($id=''){
		$discipline_name = $this->input->post('discipline_name');
		$result = $this->Descipline_model->dublicate_status($discipline_name, $id);
		echo $result; exit;
	}


	/**
	 * Insert Supervisor
	 * @return Result
	 */
	public function insert_discipline(){
		$data['discipline_name'] = trim($this->input->post('discipline_name'));
		$data['order_by'] = $this->input->post('order_by');
		$data['isActive'] = $this->input->post('discipline_status');
		$data['createDate'] = date("Y-m-d H:i:s");
		$data['updateDate'] = date("Y-m-d H:i:s");
		$result = $this->Common_model->insert($data, 'discipline');
		if($result){
			$this->session->set_flashdata('message', 'Discipline Created Successfully.');
			redirect('discipline');
		} else{
			$this->session->set_flashdata('error', 'Discipline Create Failed.');
			redirect('discipline');
		}
	}

	/**
	 * Edit Supervisor
	 * @return Layout
	 */
	public function edit_discipline($id){
			$data['discipline'] = $this->Common_model->getSingle_data('*', 'discipline', array('id' => $id));
			$this->load->view('template/header');
			$this->load->view('discipline/edit_discipline', $data);
			$this->load->view('template/footer');
	}

		/**
	 * Delete Supervisor
	 * @return Layout
	 */
	public function delete_discipline($id){
		$result = $this->Common_model->delete('discipline', array('id' => $id));
			if($result){
			$this->session->set_flashdata('message', 'Discipline Delete Successfully.');
			redirect('discipline');
		} else{
			$this->session->set_flashdata('error', 'Discipline Delete Failed.');
			redirect('discipline');
		}
	}

	/**
	 * Update Supervisor
	 * @return Result
	 */
	public function update_discipline(){
		$discipline_id = $this->input->post('discipline_id');
		$data['discipline_name'] = trim($this->input->post('discipline_name'));
		$data['order_by'] = $this->input->post('order_by');
		$data['isActive'] = $this->input->post('discipline_status');
		$data['updateDate'] = date("Y-m-d H:i:s");
		
		$result = $this->Common_model->update($data, 'discipline', array('id' => $discipline_id));
		if($result){
			$this->session->set_flashdata('message', 'Discipline Updated Successfully.');
			redirect('discipline');
		} else{
			$this->session->set_flashdata('error', 'Discipline Update Failed.');
			redirect('discipline');
		}
	}

	public function change_discipline_status(){
		$data['isActive'] = $this->input->post('status');
		$statusId = $this->input->post('statusId');
		$result = $this->Common_model->update($data, 'discipline', array('id' => $statusId));
		if($result){
			echo "update";
		} else{
			echo "error";
		}
		exit;
	}
}