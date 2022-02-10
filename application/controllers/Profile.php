<?php
	ob_start();
	ob_end_flush(); ?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Auth_Controller {

	/**
	 * construct
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('Profile_model');
		$this->load->model('Common_model');
		$this->load->model('Supervisor_model');

		$this->userId = $this->session->userdata('userId');
		$this->userType = $this->session->userdata('userType');

		$this->sup_id = $this->session->userdata('sup_id');
		$this->rehab_director = $this->session->userdata('userName');
		$this->checkHeader = $this->session->userdata('checkHeader');
	}

	/**
	 * Create Leave Type
	 * @return Layout
	 */
	public function profile_form(){
		$this->load->view('template/header');
		if(@$this->userId && @$this->userType != '2'){
			$data['user_detail'] = $this->Common_model->getSingle_data('*', 'user_master', array('id' => $this->userId));
			$this->load->view('login/user_profile', $data);
		}
		if(@$this->userType == '2'){
			$data['sup_detail'] = $this->Common_model->getSingle_data('*', 'facilities_list', array('id' => $this->sup_id));
			$this->load->view('login/sup_profile', $data);
		}
		$this->load->view('template/footer');
	}

		/**
	 * Change password
	 * @return Layout
	 */
	public function change_password(){
		$this->load->view('template/header');
		if(@$this->userType == '2'){
			$data['user_detail'] = $this->Common_model->getSingle_data('id,password, supervisor_email', 'facilities_list', array('id' => $this->sup_id));
			$this->load->view('login/change_password', $data);
		}else{
			$data['user_detail'] = $this->Common_model->getSingle_data('id,password', 'user_master', array('id' => $this->userId));
			$this->load->view('login/change_password', $data);
		}
		$this->load->view('template/footer');
	}
		/**
	 * update password
	 * @return Layout
	 */
	public function update_password(){
		$user_Id = $this->input->post('pw_user_Id');
		$data['password'] = md5($this->input->post('confirm_password'));
		$this->load->view('template/header');
		if(@$this->userType == '2'){
			$result = $this->Common_model->update($data, 'facilities_list', array('id' => $user_Id));
		}else{
			$result = $this->Common_model->update($data, 'user_master', array('id' => $user_Id));
		}
			
		if($result){
			$this->session->set_flashdata('message', 'Password Updated Successfully.');
			redirect('change-password');
		} else{
			$this->session->set_flashdata('error', 'Password Update Failed.');
			redirect('change-password');
		}
	}

	/**
	 * Check Duplicate Password
	 * @return True or False
	 */
	public function check_password($id = ''){
		$old_password = md5($this->input->post('old_password'));
		if(@$this->userType == '2'){
			$table_name = "facilities_list";
		}else{
			$table_name = "user_master";
		}
		$result = $this->Profile_model->check_password($table_name,$old_password, $id);
		echo $result; exit;
	}

	public function check_duplicate_email_edit($id = '') {
		$supervisor_email = $this->input->post('pw_user_email');
		$supervisor_password = $this->input->post('new_password');
		$result = $this->Supervisor_model->check_duplicate_email($supervisor_email, $supervisor_password, $id);
		echo $result;exit;
	}

	/**
	 * Update Profile Data
	 * @return Result
	 */
	public function update_profile(){
		$userId = $this->input->post('userId');
		$data['firstName'] = $this->input->post('first_name');
		$data['lastName'] = $this->input->post('last_name');
		$email = $this->input->post('user_email');
		$data['updateDate'] = date('Y-m-d H:i:s');

		$result = $this->Common_model->update($data, 'user_master', array('id' => $userId));
		if($result){
			$name = $data['firstName'] ." ".$data['lastName'];
			$this->session->set_userdata('userName', $name);
			$this->session->set_userdata('userEmail', $email);
			$this->session->set_flashdata('message', 'Profile Updated Successfully.');
			redirect('profile');
		} else{
			$this->session->set_flashdata('error', 'Profile Update Failed.');
			redirect('profile');
		}
	}



	/**
	 * Update supervisor Profile Data
	 * @return Result
	 */
	public function update_sup_profile(){
		$supId = $this->input->post('supId');
		$userType = $this->input->post('userType');
		$data['facility_name'] = $this->input->post('sup_name');
		$sup_email = $this->input->post('sup_email');
		$data['rehab_director'] = $this->input->post('rehab_director');
		$data['regl_mgr'] = $this->input->post('regl_mgr');
		$data['regl_mgr_email'] = $this->input->post('regl_mgr_email');
		$data['updateDate'] = date('Y-m-d H:i:s');
		$result = $this->Common_model->update($data, 'facilities_list', array('id' => $supId));
		if($result){
			$this->session->set_userdata('sup_id',$supId);
			$this->session->set_userdata('userName',$data['rehab_director']);
			$this->session->set_userdata('userEmail',$sup_email);
			$this->session->set_userdata('userType', $userType);
			$this->session->set_flashdata('message', 'Profile Updated Successfully.');
			redirect('profile');
		} else{
			$this->session->set_flashdata('error', 'Profile Update Failed.');
			redirect('profile');
		}

	}


	/**
	 * Check Duplicate User Email
	 * @return True or False
	 */
	public function check_duplicate_email($id = ''){
		$user_email = $this->input->post('user_email');
		$result = $this->Profile_model->check_duplicate_email($user_email, $id);
		echo $result; exit;
	}
}


