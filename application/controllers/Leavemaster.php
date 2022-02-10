<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leavemaster extends Auth_Controller {

	/**
	 * construct
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('Common_model');
		$this->load->model('Leavetype_model');
		$this->userId = $this->session->userdata('userId');
		$this->userType = $this->session->userdata('userType');
	}

	/**
	 * Leave List
	 * @return Layout
	 */
	public function leave_list(){
		if(@$this->userType != '2'){
			$data['leave_type'] = $this->Common_model->getall_data('*', 'leave_type_master', array('createBy' => $this->userId));
			$this->load->view('template/header');
			$this->load->view('leave/leave_list', $data);
			$this->load->view('template/footer');
		} else{
			redirect('leave-requests');
		}
	}

	/**
	 * Create Leave Type
	 * @return Layout
	 */
	public function create_leaveType(){
		if(@$this->userType != '2'){
			$this->load->view('template/header');
			$this->load->view('leave/add_leave');
			$this->load->view('template/footer');
		} else{
			redirect('leave-requests');
		}
	}

	/**
	 * Insert Leave
	 * @return Result
	 */
	public function insert_leaveType(){
		$data['leave_type_name'] = $this->input->post('leave_name');
		$data['isActive'] = $this->input->post('leave_status');
		$data['order_by'] = $this->input->post('order_by');
		$data['email_labelal'] = $this->input->post('email_labelal');
        $data['email_labelmz'] = $this->input->post('email_labelmz');
		if($this->input->post('email_checkbox')){
			$data['custome_email'] = $this->input->post('email_checkbox');
		}else{
			$data['custome_email'] = '0';
		}
		if($this->input->post('default_email_checkbox')){
            $data['default_email_checkbox'] = $this->input->post('default_email_checkbox');
        }else{
            $data['default_email_checkbox'] = '0';
        }
		$data['createBy'] = $this->userId;
		$data['createDate'] = date("Y-m-d H:i:s");
		$data['updateDate'] = date("Y-m-d H:i:s");

		$result = $this->Common_model->insert($data, 'leave_type_master');
		if($result){
			$this->session->set_flashdata('message', 'Leave Type Inserted Successfully.');
			redirect('leave-reason');
		} else{
			$this->session->set_flashdata('error', 'Leave Type Insert Failed.');
			redirect('leave-reason');
		}
	}

	/**
	 * Edit Leave Type
	 * @return Layout
	 */
	public function edit_leaveType($id){
		if(@$this->userType != '2'){
			$data['single_leave'] = $this->Common_model->getSingle_data('*', 'leave_type_master', array('leave_type_id' => $id));
			$this->load->view('template/header');
			$this->load->view('leave/edit_leave', $data);
			$this->load->view('template/footer');
		} else{
			redirect('leave-requests');
		}
	}

	/**
	 * Update Leave
	 * @return Result
	 */
	public function update_leaveType(){
		$leave_id = $this->input->post('leave_id');
		$data['leave_type_name'] = $this->input->post('leave_name');
		$data['isActive'] = $this->input->post('leave_status');
		$data['order_by'] = $this->input->post('order_by');
		$data['email_labelal'] = $this->input->post('email_labelal');
        $data['email_labelmz'] = $this->input->post('email_labelmz');
		if($this->input->post('email_checkbox')){
			$data['custome_email'] = $this->input->post('email_checkbox');
		}else{
			$data['custome_email'] = '0';
		}
		if($this->input->post('default_email_checkbox')){
            $data['default_email_checkbox'] = $this->input->post('default_email_checkbox');
        }else{
            $data['default_email_checkbox'] = '0';
        }
		$data['updateDate'] = date("Y-m-d H:i:s");

		$result = $this->Common_model->update($data, 'leave_type_master', array('leave_type_id' => $leave_id));
		if($result){
			if($data['isActive'] == '0'){
				$data2['isActive'] = $this->input->post('leave_status');
				$relatedResult = $this->Common_model->update($data2, 'leave_question', array('leave_type_id' => $leave_id));
			}
			$this->session->set_flashdata('message', 'Leave Type Updated Successfully.');
			redirect('leave-reason');
		} else{
			$this->session->set_flashdata('error', 'Leave Type Update Failed.');
			redirect('leave-reason');
		}
	}

	/*
	 * Check Duplicate Email
	 */
	public function check_duplicate($id = ''){
		$leave_name = $this->input->post('leave_name');
		$result = $this->Leavetype_model->check_duplicate($leave_name, $id);
		echo $result; exit;
	}

	public function change_leave_status(){
		$data['isActive'] = $this->input->post('status');
		$leaveId = $this->input->post('leaveId');
		$result = $this->Common_model->update($data, 'leave_type_master', array('leave_type_id' => $leaveId));
		if($result){
			if($data['isActive'] == '0'){
				$relatedResult = $this->Common_model->update($data, 'leave_question', array('leave_type_id' => $leaveId));
			}
			echo "update";
		} else{
			echo "error";
		}
		exit;
	}
}