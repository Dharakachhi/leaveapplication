<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leaveform extends Auth_Controller {

	/**
	 * construct
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('Common_model');
		$this->load->model('Leaveform_model');
		$this->load->helper('mailhelper');
		$this->userId = $this->session->userdata('userId');
		$this->userType = $this->session->userdata('userType');
	}

	/**
	 * Leave List
	 * @return Layout
	 */
	public function leave_list(){
		$data['state_list'] = $this->Common_model->getall_data('id, name', 'states', array('country_id' => '233'));
		$this->load->view('template/header');
		$this->load->view('leaveform/leave_list', $data);
		$this->load->view('template/footer');
	}

	/**
	 * Get filter Leave list
	 * @return Result
	 */
	public function get_leave_list(){
		$searchName = $this->input->post('searchName');
		$fromDate = $this->input->post('fromDate');
		$toDate = $this->input->post('toDate');
		$leaveDate = $this->input->post('leaveDate');
		$searchState = $this->input->post('searchState');
		$searchStatus = $this->input->post('searchStatus');
		$searchManager = $this->input->post('searchManager');

		$whereArr = array();

		if($searchName != ''){
			$whereArr[] = '(firstName like "%'.$searchName.'%" OR lastName like "%'.$searchName.'%")';
		}

		if($fromDate != '' && $toDate != ''){
			$dateRange = array();
			while (strtotime($fromDate) <= strtotime($toDate)) {
			    $dateRange[] = '("'.date('Y-m-d', strtotime($fromDate)).'" BETWEEN last_day_work AND return_date)';
			    $fromDate = date ("Y-m-d", strtotime("+1 days", strtotime($fromDate)));
			}
			if(!empty($dateRange)){
				$whereArr[] = '('.implode(' OR ', $dateRange).')';
			}
		}
		if($fromDate != '' && $toDate == ''){
			$whereArr[] = '("'.date('Y-m-d', strtotime($fromDate)).'" BETWEEN last_day_work AND return_date)';
		}
		if($fromDate == '' && $toDate != ''){
			$whereArr[] = '("'.date('Y-m-d', strtotime($toDate)).'" BETWEEN last_day_work AND return_date)';
		}

		if($leaveDate != ''){
			$whereArr[] = 'date_submitted ="'.date('Y-m-d', strtotime($leaveDate)).'"';
		}
		if($searchState != ''){
			if($searchState != '0'){
				$whereArr[] = 'state ="'.$searchState.'"';
			} else{
				$whereArr[] = 'state !=""';
			}
		}
		if($searchStatus != ''){
			if($searchStatus != '0'){
				$whereArr[] = 'leave_status ="'.$searchStatus.'"';
			} else{
				$whereArr[] = 'leave_status !=""';
			}
			
		}
		// if($searchManager != ''){
		// 	if($searchManager != '0'){
		// 		$whereArr[] = 'manager ="'.$searchManager.'"';
		// 	} else{
		// 		$whereArr[] = 'manager !=""';
		// 	}
		// }
		if($searchManager != ''){
			if($searchManager != '0'){
				if($searchManager == 'a-l'){
					$whereArr[] = "(LEFT(lfm.lastName, 1) IN ('a','b','c','d','e','f','g','h','i','j','k','l','A','B','C','D','E','F','G','H','I','J','K','L'))";
				}else if($searchManager == 'm-z'){
					$whereArr[] = "(LEFT(lfm.lastName, 1) IN ('m','n','o','p','q','r','s','t','u','v','w','x','y','z','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'))";
				}else{

				$whereArr[] = 'lfm.manager ="'.$searchManager.'"';
				}
			} else{
				$whereArr[] = 'lfm.manager !=""';
			}
		}

		if(!empty($whereArr)){
			$where = 'WHERE ';
			$where .= implode(' AND ', $whereArr);
		} else{
			$where = 'WHERE 1';
		}
			
		if($searchName == '' && $fromDate == '' && $toDate == '' && $leaveDate == '' && $searchState == '' && $searchStatus == '' && $searchManager == ''){
			$data['leaveResult'] = array();
		} else{
			$data['leaveResult'] = $this->Leaveform_model->get_leave_list($where);
		}
		$this->load->view('leaveform/filter_leave_list', $data);
	}

	/**
	 * Get Leave Detail
	 * @return Result
	 */
	public function get_leave_detail(){
		$leaveId = $this->input->post('leaveId');
		$data['state_list'] = $this->Common_model->getall_data('id, name', 'states', array('country_id' => '233'));
		$where = ' isActive = "1" ORDER BY order_by ASC';
		$data['leave_list'] = $this->Common_model->getall_data('leave_type_id, leave_type_name', 'leave_type_master', $where);
		$data['leaveDetail'] = $this->Leaveform_model->get_leave_detail($leaveId);
		$this->load->view('leaveform/filter_leave_detail', $data);
	}

	/**
	 * Edit Leave Page
	 * @return Layout
	 */
	public function edit_leave($id){
		$data['leave_detail'] = $this->Common_model->getSingle_data('*', 'leave_form_master', array('leave_form_id' => $id));
		$where = ' isActive = "1" ORDER BY order_by ASC';
		$data['leave_list'] = $this->Common_model->getall_data('leave_type_id, leave_type_name', 'leave_type_master', $where);
		$data['state_list'] = $this->Common_model->getall_data('id, name', 'states', array('country_id' => '233'));
		$this->load->view('template/header');
		$this->load->view('leaveform/leave-form', $data);
		$this->load->view('template/footer');
	}

	/**
	 * Load Sub Question Detail
	 * @return Result
	 */
	public function get_subquestion_detail(){
		$questionId = $this->input->post('questionId');
		$leaveDetail = $this->Common_model->getSingle_data('leave_detail, leave_reason', 'leave_form_master', array('leave_form_id' => $questionId));
		$questions = json_decode($leaveDetail['leave_detail']);
		$leave_detail = (array)$questions;
		$data['leave_detail_field'] = $leaveDetail['leave_detail'];
		$data['leave_detail'] = $leave_detail;
		$subQuestionArr = array();
		$leave_question_list = $this->Common_model->getall_data('*', 'leave_question', array('leave_type_id' => $leaveDetail['leave_reason'], 'isSubquestion' => '0'));
		$data['question_detail'] = $this->Leaveform_model->get_question_data($leaveDetail['leave_reason']);
		$data['leave_question_list'] = $leave_question_list;
		if(!empty($leave_question_list)){
			foreach($leave_question_list as $question){
				$questionAlias= url_title(@$question['leave_question'], 'underscore', true);
				if(@$leave_detail[$questionAlias] != ''){
					if(@$question['input_type'] == 'Checkbox' || @$question['input_type'] == 'Dropdown'){
						$leave_questionList = $this->Common_model->getall_data('*', 'leave_question', array('related_question' => @$question['leave_question_id'], 'related_question_option' => @$leave_detail[$questionAlias]));
						$data['sub_question_detail'][$questionAlias] = $this->Leaveform_model->get_sub_question_data(@$question['leave_question_id'], @$leave_detail[$questionAlias]);
					} else{
						$lqWhere = ' related_question="'.@$question['leave_question_id'].'" AND (related_question_option="0" OR related_question_option IS NULL)';
						$leave_questionList = $this->Common_model->getall_data('*', 'leave_question', $lqWhere);
						// echo $this->db->last_query()."<br>";
						$data['sub_question_detail'][$questionAlias] = $this->Leaveform_model->get_sub_question_data(@$question['leave_question_id'], '0');
						// echo $this->db->last_query()."<br>";
					}
					$subQuestionArr[$questionAlias] = $leave_questionList;
				}
			}
		}
		$data['leave_question_detail'] = $subQuestionArr;
		// echo "<pre>";
		// print_r($data); exit;
		$result = $this->load->view('leaveform/leave-sub-detail', $data);
	}

	/**
	 * Load Sub Question Detail
	 * @return Result
	 */
	public function get_subquestion_detail_view(){
		$questionId = $this->input->post('questionId');
		$leaveDetail = $this->Common_model->getSingle_data('leave_detail, leave_reason', 'leave_form_master', array('leave_form_id' => $questionId));
		$questions = json_decode($leaveDetail['leave_detail']);
		$leave_detail = (array)$questions;
		$data['leave_detail_field'] = $leaveDetail['leave_detail'];
		$data['leave_detail'] = $leave_detail;
		$subQuestionArr = array();
		$leave_question_list = $this->Common_model->getall_data('*', 'leave_question', array('leave_type_id' => $leaveDetail['leave_reason'], 'isSubquestion' => '0'));
		$data['question_detail'] = $this->Leaveform_model->get_question_data($leaveDetail['leave_reason']);
		$data['leave_question_list'] = $leave_question_list;
		if(!empty($leave_question_list)){
			foreach($leave_question_list as $question){
				$questionAlias= url_title(@$question['leave_question'], 'underscore', true);
				if(@$leave_detail[$questionAlias] != ''){
					if(@$question['input_type'] == 'Checkbox' || @$question['input_type'] == 'Dropdown'){
						$leave_questionList = $this->Common_model->getall_data('*', 'leave_question', array('related_question' => @$question['leave_question_id'], 'related_question_option' => @$leave_detail[$questionAlias]));
						$data['sub_question_detail'][$questionAlias] = $this->Leaveform_model->get_sub_question_data(@$question['leave_question_id'], @$leave_detail[$questionAlias]);
					} else{
						$leave_questionList = $this->Common_model->getall_data('*', 'leave_question', array('related_question' => @$question['leave_question_id'], 'related_question_option' => '0'));
						$data['sub_question_detail'][$questionAlias] = $this->Leaveform_model->get_sub_question_data(@$question['leave_question_id'], '0');
					}
					$subQuestionArr[$questionAlias] = $leave_questionList;
				}
			}
		}
		$data['leave_question_detail'] = $subQuestionArr;
		$result = $this->load->view('leaveform/leave-sub-detail-view', $data);
	}

	/**
	 * Update Leave Detail
	 * @return Result
	 */
	public function update_leaveform(){
		$leaveFormId = $this->input->post('leaveFormId');
		$leaveId = $this->input->post('leaveId');

		$data['firstName'] = $this->input->post('first_name');
		$data['lastName'] = $this->input->post('last_name');
		$lastName = substr($data['lastName'], 0, 1);
		$str1 = 'abcdefghijklABCDEFGHIJKL';
		$str2 = 'mnopqrstuvwxyzMNOPQRSTUVWXYZ';

		if(strpos($str1, $lastName) !== false){
		    $data['manager'] = 'Maria Korey';
		    // $email = 'requestal@tendertouch.com';
		}

		if(strpos($str2, $lastName) !== false){
		    $data['manager'] = 'Elida Sanchez';
		    // $email = 'requestmz@tendertouch.com';
		}

		$data['people'] = $this->input->post('people');
		$sup_date = $this->input->post('sup_date');
		if($sup_date){
			$data['sup_date'] =  date('Y-m-d', strtotime($sup_date));
		}else{
			$data['sup_date']=  '0000-00-00';
		}
		$discussed_supervisor = $this->input->post('discussed_supervisor');
		if($discussed_supervisor){
			$data['discs_supervisor'] = '1';
		}else{
			$data['discs_supervisor'] = '0';
		}
		$employee_signature = $this->input->post('employee_signature');
		if($employee_signature){
			$data['employee_signature'] = $this->input->post('employee_signature');
		}else{
		$data['employee_signature'] = '';
		}
		$signed_date = $this->input->post('signed_date');
		if($signed_date){
			$data['signed_date'] = date('Y-m-d', strtotime($signed_date));
		}else{
			$data['signed_date'] = '0000-00-00';
		}
		$superviser_signature = $this->input->post('superviser_signature');
		if($superviser_signature){
			$data['superviser_signature'] = $superviser_signature;
		}else{
			$data['superviser_signature'] = '';
		}
		$superviser_sign_date = $this->input->post('superviser_sign_date');
		if($superviser_sign_date){
			$data['superviser_sign_date'] = date('Y-m-d', strtotime($superviser_sign_date));
		}else{
			$data['superviser_sign_date'] = '0000-00-00';
		}

		// $data['leave_detail'] = json_encode($_POST);
		$data['contactNumber'] = $this->input->post('contact_number');
		$data['user_email'] = $this->input->post('email_id');
		$data['state'] = $this->input->post('state');
		$data['discipline'] = $this->input->post('discipline');
		// $data['leave_reason'] = $this->input->post('leave_reason');
		$data['contact_method'] = $this->input->post('contact_method');
		$data['facility'] = $this->input->post('facility');
		$last_day_work = $this->input->post('last_day_work');
		$data['last_day_work'] = date('Y-m-d', strtotime($last_day_work));
		$return_date = $this->input->post('return_date');
		if($this->input->post('tbd')){
			$data['tbd'] = '1';
			$data['return_date'] = '0000-00-00';
		} else{
			$data['tbd'] = '0';
			$data['return_date'] = date('Y-m-d', strtotime($return_date));
		}
		$data['date_flexible'] = $this->input->post('date_flexible');
		$data['leave_status'] = $this->input->post('request_status');
		$data['comment_status'] = $this->input->post('comment_status');
		$data['updateDate'] = date("Y-m-d H:i:s");

		$result = $this->Common_model->update($data, 'leave_form_master', array('leave_form_id' =>$leaveFormId));
		if($result){
			$leaveName = $this->Common_model->getSingle_data('leave_type_name', 'leave_type_master', array('	leave_type_id' => $leaveId));

			$body = '';
			$Ename = $data['firstName']." ".$data['lastName'];
			if($this->input->post('tbd')){
				$dateLeave = $last_day_work." to TBD";
			} else{
				$dateLeave = $last_day_work." to ".$return_date;
			}

			$emailPara = array('{Employee Name}', '{Employee Email}', '{Employee Contact}', '{Employee Facility}', '{Leave Reason}', '{Dates of the Leave Request}', '{Comment}', '{Leave Status}');
			$dataPara = array($Ename, $data['user_email'], $data['contactNumber'], $data['facility'], $leaveName['leave_type_name'], $dateLeave, $data['comment_status'], $data['leave_status']);

			$to_mail = $data['user_email'];
			// $to_mail = "dhara.k288@gmail.com";
			$mailLog['date'] = date('Y-m-d H:i:s');
			$mailLog['Employee Name'] = $Ename;
			if($data['leave_status'] == 'Approved'){
				$EmailTemplate = $this->Common_model->getSingle_data('text', 'email_template', array('	template_name' => 'Email Template For Approved'));

				$body = str_replace($emailPara, $dataPara, $EmailTemplate['text']);
				$res = simpleMail($to_mail,'Leave Approved',$body);
				$mailLog['mail Send'] = 'Leave Approved';
				// $mailLog['mail Body'] = $body;
				$mailLog['Email Send to Employee'] = $res;
				file_put_contents(FILE_PATH.'uploads/log/'.date("d-m-Y").'_maillog.txt', "\n\n---------- Leave Approved -------------\n".print_r($mailLog,true) , FILE_APPEND);
			}
	        if($data['leave_status'] == 'Denied'){
	        	$EmailTemplate = $this->Common_model->getSingle_data('text', 'email_template', array('	template_name' => 'Email Template For Rejected'));

	        	$body = str_replace($emailPara, $dataPara, $EmailTemplate['text']);
				$res = simpleMail($to_mail,'Leave Rejected',$body);
				$mailLog['mail Send'] = 'Leave Denied';
				// $mailLog['mail Body'] = $body;
				$mailLog['Email Send to Employee'] = $res;
				file_put_contents(FILE_PATH.'uploads/log/'.date("d-m-Y").'_maillog.txt', "\n\n---------- Leave Denied -------------\n".print_r($mailLog,true) , FILE_APPEND);
			}
			if($data['leave_status'] == 'Cancel Request'){
	        	$EmailTemplate = $this->Common_model->getSingle_data('text', 'email_template', array('template_name' => 'Email Template For Cancelled'));
	        	$body = str_replace($emailPara, $dataPara, $EmailTemplate['text']);
				$res = simpleMail($to_mail,'Leave Cancelled',$body);
				$mailLog['mail Send'] = 'Leave Cancelled';
				// $mailLog['mail Body'] = $body;
				$mailLog['Email Send to Employee'] = $res;
				file_put_contents(FILE_PATH.'uploads/log/'.date("d-m-Y").'_maillog.txt', "\n\n---------- Leave Cancelled -------------\n".print_r($mailLog,true) , FILE_APPEND);
			}
			$this->session->set_flashdata('message', 'Leave Requested Submitted');
			redirect('leave-requests');
		} else{
			$this->session->set_flashdata('error', 'Leave Request Failed.');
			redirect('leave-requests');
		}
	}

	/**
	 * Change by Bhumi
	 * Delete Leave
	 */
	public function delete_leaveform_id($encid){
		$result = $this->Common_model->delete('leave_form_master', array('leave_form_id' => $encid));
		if($result){
			$this->session->set_flashdata('message', 'Delete Successfully');
			redirect('leave-requests');
		}else{
			$this->session->set_flashdata('error', 'Something Went Worng.');
			redirect('leave-requests');
		}
	}
}