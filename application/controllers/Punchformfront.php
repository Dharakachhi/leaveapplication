<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Punchformfront extends CI_Controller {

	/**
	 * construct
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('Common_model');
		$this->load->model('Leaveform_model');
		$this->userId = $this->session->userdata('userId');
		$this->userType = $this->session->userdata('userType');
		$this->load->helper('mailhelper');
	}


	/**
	 * Create Leave Type
	 * @return Layout
	 */
	public function punch_form(){
		$where_f = 'isActive = "1" ORDER BY facility_name ASC';
		$data['facilities_list'] = $this->Common_model->getall_data('id, facility_name', 'facilities_list', $where_f);
		$where = 'isActive = "1" ORDER BY order_by ASC';
		$data['punch_status'] = $this->Common_model->getall_data('*', 'punch_status', $where);
		$data['punch_type'] = $this->Common_model->getall_data('*', 'punch_type', $where);
		$data['discipline'] = $this->Common_model->getall_data('*', 'discipline', $where);
		$this->load->view('template/Leaveheader');
		$this->load->view('punchformfront/punch-form',$data);
		$this->load->view('template/Leavefooter');
	}


	/**
	 * Insert Leave
	 * @return Result
	 */
	public function insert_punchform(){
		$data['first_name'] = trim($this->input->post('first_name'));
		$data['last_name'] = trim($this->input->post('last_name'));
		$data['email_id'] = trim($this->input->post('email_id'));
		$data['ssn'] = $this->input->post('ssn');
		$data['discipline'] = $this->input->post('discipline');
		$data['facility'] = $this->input->post('facility');
		$data['date'] = date("Y-m-d",strtotime($this->input->post('date')));
		$data['punch_status'] = $this->input->post('punch_status');
		$data['punch_type'] = $this->input->post('punch_type');
		$data['punch_time'] = $this->input->post('punch_time');
		$data['lunch_minutes'] = $this->input->post('lunch_minutes');
		$data['reason'] = $this->input->post('reason');
		$data['optima_login_id'] = $this->input->post('optima_login_id');
		$data['response_status_sup'] = "New";
		$data['response_status_hr'] = "New";
		$data['comment_status'] = $this->input->post('comment_status');
		$data['createDate'] = date("Y-m-d H:i:s");
		$data['updateDate'] = date("Y-m-d H:i:s");
		$result = $this->Common_model->insert($data, 'punch_form_master');
		if($result){
			$punch_status_id = $this->Common_model->getSingle_data('punch_status,facility', 'punch_form_master', array('id' => $result));
			if(!empty($punch_status_id)){
				$punch_status = $this->Common_model->getSingle_data('punch_status_name','punch_status',array('id' => $punch_status_id['punch_status']));
				$supervisor = $this->Common_model->getSingle_data('supervisor_email,facility_name,rehab_director','facilities_list',array('id' => $punch_status_id['facility']));
				$email_info = $this->Common_model->getSingle_data('*','email_info','');

			$body = '';
			$Ename = $data['first_name']." ".$data['last_name'];
			if($this->userType == '2' || $this->userType == '0') {
			$response_status = $data['response_status_sup'];

			}
			if($this->userType == '1' || $this->userType == '0'){ 
			$response_status = $data['response_status_hr'];
			}else{
				$response_status = $data['response_status_sup'];
			}
			$url_edit =  base_url().'edit-punch/'.$result;
			$edit_id_url = '<a href="'.$url_edit.'" target="_blank" itemprop="url">View Punch Request</a>';

			$emailPara = array('{Employee Name}', '{Employee Email}', '{Employee Facility}', '{Supervisor Name}','{HR Name}', '{Punch Reason}', '{Dates of the Punch Request}','{URL}', '{Comment}', '{Punch Status}');
			$dataPara = array($Ename, $data['email_id'], $supervisor['facility_name'], $supervisor['rehab_director'],"", $punch_status['punch_status_name'], $data['date'],$edit_id_url, $data['comment_status'], $response_status);
			// $from = 'timeandattendance@tendertouch.com';
			$to_mail_employee = $data['email_id'];
			// $to_mail_employee ="test84587@gmail.com";
			$to_mail_supervisor = $supervisor['supervisor_email'];
			// $to_mail_supervisor = "dhara.k288@gmail.com";
			
			$mailLog['date'] = date('Y-m-d H:i:s');
			$mailLog['Employee Name'] = $Ename;
			if($response_status == 'New'){

				$EmailTemplate_employee = $this->Common_model->getSingle_data('subject,text', 'punch_email_template', array('template_name' => 'Email Template For Employee New Request'));
				$body = str_replace($emailPara, $dataPara, $EmailTemplate_employee['text']);
				$res = simpleMail_punch($email_info,$to_mail_employee,$EmailTemplate_employee['subject'],$body);

				$EmailTemplate_supervisor = $this->Common_model->getSingle_data('subject,text', 'punch_email_template', array('template_name' => 'Email Template For Supervisor New Request'));
				$body = str_replace($emailPara, $dataPara, $EmailTemplate_supervisor['text']);
				$res_sup = simpleMail_punch($email_info,$to_mail_supervisor,$EmailTemplate_supervisor['subject'],$body);

				$mailLog['mail Send'] = 'Punch Request New';
				$mailLog['Email Send to Employee'] = $res;
				$mailLog['Email Send to Supervisor'] = $res_sup;
				$mailLog['employee mail subject'] = $EmailTemplate_employee['subject'];
				$mailLog['supervisor mail subject'] = $EmailTemplate_supervisor['subject'];
				file_put_contents(FILE_PATH.'uploads/log/'.date("d-m-Y").'_maillog.txt', "\n\n---------- Punch Request New -------------\n".print_r($mailLog,true) , FILE_APPEND);
			}
	       
			$this->session->set_flashdata('message', 'Punch-Time Requested Submitted');
			redirect('punch-message');
			}
		} else{
			$this->session->set_flashdata('error', 'Punch-Time Request Failed.');
			redirect('tarf');

		}
	}

	/**
	 * Success message show page
	 * @return Layout
	 */
	public function punch_message(){
		$this->load->view('template/Leaveheader');
		$this->load->view('punchformfront/punch-message');
		$this->load->view('template/Leavefooter');
	}
}