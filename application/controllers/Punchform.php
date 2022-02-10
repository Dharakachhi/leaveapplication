<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Punchform extends Auth_Controller {

	/**
	 * construct
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('Common_model');
		$this->load->model('Punchform_model');
		$this->load->helper('mailhelper');
		$this->sup_id = $this->session->userdata('sup_id');
		$this->rehab_director = $this->session->userdata('userName');
		$this->userType = $this->session->userdata('userType');
		$this->checkHeader = $this->session->userdata('checkHeader');


	}

	/**
	 * Punch List
	 * @return Layout
	 */
	public function punch_list(){

		$search_employee_name = $this->session->userdata('EmpName');
		$fromDate = $this->session->userdata('FromDate');
		$toDate = $this->session->userdata('ToDate');
		$search_response_status = $this->session->userdata('ResStatus');
		$facility = $this->session->userdata('FacSup');
		$facility_name = $this->session->userdata('FacName');

		if($search_employee_name != '' || $fromDate != '' || $toDate != '' || $search_response_status != '' || $facility != '' || $facility_name != ''){

			$data = $this->get_punch($search_employee_name,$fromDate,$toDate,$search_response_status,$facility,$facility_name);

		}else{

			if($this->userType == '2'){
				$where = "facility = ".$this->sup_id." AND response_status_sup = '".$this->session->userdata('ResStatus')."' AND response_status_hr = '".$this->session->userdata('ResStatus')."'";
			}elseif($this->userType == '1'){
				$where = "response_status_sup = '".$this->session->userdata('ResStatus')."' AND (response_status_hr = '".$this->session->userdata('ResStatus')."' || response_status_hr IS NULL || response_status_hr = '' )";
			}else{
				$where = "";
			}
			$data['punchResult'] = $this->Common_model->getall_data('*', 'punch_form_master', $where);
			$data['facilities_list'] = $this->Common_model->getall_data('*', 'facilities_list');
			$data['discipline'] = $this->Common_model->getall_data('*', 'discipline');
			$data['punch_status'] = $this->Common_model->getall_data('*', 'punch_status');
			$data['punch_type'] = $this->Common_model->getall_data('*', 'punch_type');
		}
			$this->load->view('template/header');
			$this->load->view('punchform/punch_list',$data);
			$this->load->view('template/footer');
	}



	public function get_punch($search_employee_name,$fromDate,$toDate,$search_response_status,$facility,$facility_name){
		$this->session->set_userdata('EmpName', $search_employee_name);
		$this->session->set_userdata('FromDate', $fromDate);
		$this->session->set_userdata('ToDate', $toDate);
		$this->session->set_userdata('ResStatus', $search_response_status);
		$this->session->set_userdata('FacSup', $facility);
		$this->session->set_userdata('FacName', $facility_name);

	 	$search_employee_name = $this->session->userdata('EmpName');
		$fromDate = $this->session->userdata('FromDate');
	 	$toDate = $this->session->userdata('ToDate');
		$search_response_status = $this->session->userdata('ResStatus');
		$facility = $this->session->userdata('FacSup');
		$facility_name = $this->session->userdata('FacName');
		$whereArr = array();

		if($facility != ''){
			if($facility != '0'){	
				if($facility == 'a-l'){

				$whereArr[] = "(facilities_list.facility_name BETWEEN 'a' AND 'l')";
				}else
				if($facility == 'm-z'){

				$whereArr[] = "(facilities_list.facility_name BETWEEN 'm' AND 'z')";
				}
			}else{
				$facility =  "(facilities_list.facility_name '1')";
			}
		}

		if($search_employee_name != ''){
			$whereArr[] = '(punch_form_master.first_name like "%'.$search_employee_name.'%" OR punch_form_master.last_name like "%'.$search_employee_name.'%")';
		}

		if($facility_name != ''){
			$whereArr[] = '(facilities_list.facility_name like "%'.$facility_name.'%")';
		}

		if($search_response_status != ''){
			if($search_response_status != '0'){

				if($search_response_status == 'Completed' || $search_response_status == 'Canceled'){
						$whereArr[] = '(punch_form_master.response_status_hr ="'.$search_response_status.'")';
					}
				else if($search_response_status == 'Approved'){

					$whereArr[] = '((punch_form_master.response_status_sup ="'.$search_response_status.'") AND (punch_form_master.response_status_hr != "Completed" && punch_form_master.response_status_hr != "Canceled"))';
					
				}
				else if($search_response_status == 'New'){
					if($this->userType == '1' ){
						$whereArr[] = "((punch_form_master.response_status_hr = '' AND punch_form_master.response_status_sup != '') AND (punch_form_master.response_status_hr != '' AND punch_form_master.response_status_sup = ''))";
					}else{
					$whereArr[] = '(punch_form_master.response_status_sup ="'.$search_response_status.'" AND punch_form_master.response_status_hr = "'.$search_response_status.'")';
					}
					
				}else if($search_response_status == 'Denied'){
					if($this->userType == '1'){
						$whereArr[] = "((punch_form_master.response_status_hr = '' AND punch_form_master.response_status_sup != '') AND (punch_form_master.response_status_hr != '' AND punch_form_master.response_status_sup = ''))";
					}else{
					$whereArr[] = '(punch_form_master.response_status_sup ="'.$search_response_status.'" AND (punch_form_master.response_status_hr != "Completed" || punch_form_master.response_status_hr != "Canceled"))';
					}
					
				}else{
					if($this->userType == '1'){
					$whereArr[] = '(punch_form_master.response_status_hr ="'.$search_response_status.'")';
					}else if ($this->userType == '2') {
					$whereArr[] = '(punch_form_master.response_status_sup ="'.$search_response_status.'")';
					}else{
						$whereArr[] = '(punch_form_master.response_status_sup ="'.$search_response_status.'")';
					}
				}
			}
			 else if($this->userType == '1'){
			 	$whereArr[] = '((punch_form_master.response_status_sup ="Approved") || ((punch_form_master.response_status_sup = "New" || punch_form_master.response_status_sup = "Denied")  AND punch_form_master.response_status_hr = "Completed" || punch_form_master.response_status_hr = "Canceled"))';
			 }else{
				$whereArr[] = '(punch_form_master.response_status_sup != "" OR punch_form_master.response_status_hr != "")';
			}
			
		}
		$where_status = '';
		if($this->userType == '1'){
			if(@$search_response_status == ''){
			$where_status = " AND (punch_form_master.response_status_sup != 'Denied' AND punch_form_master.response_status_sup != 'New' AND punch_form_master.response_status_sup = 'Approved')";

			}
		}
		if($fromDate != '' && $toDate != ''){
			$whereArr[] = '(DATE_FORMAT(punch_form_master.date,"%Y-%m-%d") BETWEEN "'.date('Y-m-d', strtotime($fromDate)).'" AND "'.date('Y-m-d', strtotime($toDate)).'")'.$where_status;
			
		}
		
		if($fromDate != '' && $toDate == ''){

			$whereArr[] = '(DATE_FORMAT(punch_form_master.date,"%Y-%m-%d") BETWEEN "'.date('Y-m-d', strtotime($fromDate)).'" AND "'.date('Y-m-d', strtotime($fromDate)).'")'.$where_status;
		}
		if($fromDate == '' && $toDate != ''){
			$whereArr[] = '(DATE_FORMAT(punch_form_master.date,"%Y-%m-%d") BETWEEN "'.date('Y-m-d', strtotime($toDate)).'" AND "'.date('Y-m-d', strtotime($toDate)).'")'.$where_status;
		}
		if(!empty($whereArr)){
			$where = 'WHERE ';
			$where .= implode(' AND ', $whereArr);
		} else{
			$where = 'WHERE 1';
		}

		if($search_employee_name == '' && $fromDate == '' && $toDate == '' &&  $search_response_status == '' && $facility == ''){
			$data['punchResult'] = array();
		} else{
			$data['punchResult'] = $this->Punchform_model->get_punch_list($where);
		}
		$data['facilities_list'] = $this->Common_model->getall_data('*', 'facilities_list');
		$data['punch_status'] = $this->Common_model->getall_data('*', 'punch_status');
		$data['punch_type'] = $this->Common_model->getall_data('*', 'punch_type');
		$data['discipline'] = $this->Common_model->getall_data('*', 'discipline');

		return $data;
	}

	/**
	 * Get filter Punch list
	 * @return Result
	 */
	public function get_punch_list(){
		$search_employee_name = $this->input->post('search_employee_name');
		$fromDate = $this->input->post('fromDate');
		$toDate = $this->input->post('toDate');
		$search_response_status = $this->input->post('search_response_status');
		$facility = $this->input->post('facility');
		$facility_name = $this->input->post('facility_name');
		$data = $this->get_punch($search_employee_name,$fromDate,$toDate,$search_response_status,$facility,$facility_name);

		$this->load->view('punchform/filter_punch_list', $data);
	}

	public function refresh_datatable()
	{
		$search_employee_name = $this->session->unset_userdata('EmpName');
		$fromDate = $this->session->unset_userdata('FromDate');
		$toDate = $this->session->unset_userdata('ToDate');
		$search_response_status = $this->session->unset_userdata('ResStatus');
		$facility = $this->session->unset_userdata('FacSup');
		$facility_name = $this->session->unset_userdata('FacName');

		$data = array();
		
		$this->load->view('punchform/filter_punch_list', $data);

	}


	/**
	 * Edit Punch Page
	 * @return Layout
	 */
	public function edit_punch($id){
		$data['punch_detail'] = $this->Common_model->getSingle_data('*', 'punch_form_master', array('id' => $id));
		$data['punch_type_time'] = $this->Common_model->getSingle_data('punch_type_name', 'punch_type', array('id' => $data['punch_detail']['punch_type']));
		$where_f = 'isActive = "1" ORDER BY facility_name ASC';
		$data['facilities_list'] = $this->Common_model->getall_data('id, facility_name', 'facilities_list', $where_f);
		$where = 'isActive = "1" ORDER BY order_by ASC';
		$data['punch_status'] = $this->Common_model->getall_data('*', 'punch_status',  $where);
		$data['punch_type'] = $this->Common_model->getall_data('*', 'punch_type',  $where);
		$data['discipline'] = $this->Common_model->getall_data('*', 'discipline',  $where);
		$this->load->view('template/header');
		$this->load->view('punchform/punch-form', $data);
		$this->load->view('template/footer');
	}

	/**
	 * Email Send to employee, supervisor, Payropll start
	 * @return Layout
	 */
	public function email_send($punch_form,$response_st){


			$punch_status = $this->Common_model->getSingle_data('punch_status_name','punch_status',array('id' => $punch_form['punch_status']));
			$supervisor = $this->Common_model->getSingle_data('supervisor_email,facility_name,rehab_director','facilities_list',array('id' => $punch_form['facility']));
			$where = "(`check_header` LIKE '%0%' && `user_type` = '1' && `isActive` = '1')";
			$hr_email = $this->Common_model->getall_data('*','user_master' , $where);
			$email_info = $this->Common_model->getSingle_data('*','email_info','');
			
	 		$to_mail_supervisor = $supervisor['supervisor_email'];
			$body = '';
			$Ename = $punch_form['first_name']." ".$punch_form['last_name'];
			$response_status = $response_st;
			$url_edit =  base_url().'edit-punch/'.$punch_form['id'];
			$edit_id_url = 'click Here : <a href="'.$url_edit.'" target="_blank" itemprop="url">View Punch Request</a>';

			$emailPara = array('{Employee Name}', '{Employee Email}', '{Employee Facility}', '{Supervisor Name}','{HR Name}', '{Punch Reason}', '{Dates of the Punch Request}','{URL}','{Comment}', '{Punch Status}');
			$dataPara = array($Ename, $punch_form['email_id'],  $supervisor['facility_name'], $supervisor['rehab_director'], "", $punch_status['punch_status_name'], $punch_form['date'],$edit_id_url, $punch_form['comment_status'], $response_status);

			$to_mail = $punch_form['email_id'];
		
			$mailLog['date'] = date('Y-m-d H:i:s');
			$mailLog['Employee Name'] = $Ename;
			
			if($response_status == 'Approved'){
				$EmailTemplate = $this->Common_model->getSingle_data('subject,text', 'punch_email_template', array('template_name' => 'Email Template For Employee Approved'));

				$body = str_replace($emailPara, $dataPara, $EmailTemplate['text']);
				$res = simpleMail_punch($email_info,$to_mail,$EmailTemplate['subject'],$body);

				
				$EmailTemplate_hr = $this->Common_model->getSingle_data('subject,text', 'punch_email_template', array('template_name' => 'Email Template For HR Payroll Approved'));
				foreach (@$hr_email as $key => $value) {
					$hr_name = $value['firstName']." ".$value['lastName'];
					$dataPara_hr = array($Ename, $punch_form['email_id'],  $supervisor['facility_name'], $supervisor['rehab_director'], $hr_name, $punch_status['punch_status_name'], $punch_form['date'],$edit_id_url, $punch_form['comment_status'], $response_status);
					
					$body_hr = str_replace($emailPara, $dataPara_hr, $EmailTemplate_hr['text']);
			 		$check_header = explode(",",@$value['check_header']);
					if((@$check_header[0] == '0' || @$check_header[1] == '0') && @$hr_email != ''){
						$res_hr = simpleMail_punch($email_info,$value['email'],$EmailTemplate_hr['subject'],$body_hr);
						$mailLog['mail Send'][] = 'Punch Request Approved';
						$mailLog['Email Send to HR'][] = $res_hr;
						$mailLog['Hr name'][] = $hr_name;
					}
			 	}
				$mailLog['Email Send to Employee'] = $res;
				$mailLog['mail subject'] = $EmailTemplate['subject'];
				$mailLog['mail subject to HR'] = $EmailTemplate_hr['subject'];
				file_put_contents(FILE_PATH.'uploads/log/'.date("d-m-Y").'_maillog.txt', "\n\n---------- Punch Request Approved -------------\n".print_r($mailLog,true) , FILE_APPEND);
			}
			
		
	    if($response_status == 'Denied'){
	    	$EmailTemplate = $this->Common_model->getSingle_data('subject,text', 'punch_email_template', array('template_name' => 'Email Template For Employee Denied'));

	    	$body = str_replace($emailPara, $dataPara, $EmailTemplate['text']);
			$res = simpleMail_punch($email_info,$to_mail,$EmailTemplate['subject'],$body);
			$mailLog['mail Send'] = 'Punch Request Denied';
			$mailLog['Email Send to Employee'] = $res;
			$mailLog['mail subject'] = $EmailTemplate['subject'];
			file_put_contents(FILE_PATH.'uploads/log/'.date("d-m-Y").'_maillog.txt', "\n\n---------- Punch Request Denied -------------\n".print_r($mailLog,true) , FILE_APPEND);
		}
		  if($response_status == 'Canceled'){
		  	$EmailTemplate = $this->Common_model->getSingle_data('subject,text', 'punch_email_template', array('template_name' => 'Email Template For Employee Canceled'));
	    	$body = str_replace($emailPara, $dataPara, $EmailTemplate['text']);
			$res = simpleMail_punch($email_info,$to_mail,$EmailTemplate['subject'],$body);

			$EmailTemplate_sup = $this->Common_model->getSingle_data('subject,text', 'punch_email_template', array('template_name' => 'Email Template For Supervisor Canceled'));
			$body_sup = str_replace($emailPara, $dataPara, $EmailTemplate_sup['text']);
			$res_sup = simpleMail_punch($email_info,$to_mail_supervisor,$EmailTemplate_sup['subject'],$body_sup);

			$mailLog['mail Send'] = 'Punch Request Canceled';
			$mailLog['Email Send to Employee'] = $res;
			$mailLog['Email Send to Supervisor'] = $res_sup;
			$mailLog['mail subject'] = $EmailTemplate['subject'];
			$mailLog['mail subject to supervisor'] = $EmailTemplate_sup['subject'];
			file_put_contents(FILE_PATH.'uploads/log/'.date("d-m-Y").'_maillog.txt', "\n\n---------- Punch Request Canceled -------------\n".print_r($mailLog,true) , FILE_APPEND);
		}
		if($response_status == 'Completed'){
		  	$EmailTemplate = $this->Common_model->getSingle_data('subject,text', 'punch_email_template', array('template_name' => 'Email Template For Employee Completed'));
	    	$body = str_replace($emailPara, $dataPara, $EmailTemplate['text']);
			$res = simpleMail_punch($email_info,$to_mail,$EmailTemplate['subject'],$body);

			$EmailTemplate_sup = $this->Common_model->getSingle_data('subject,text', 'punch_email_template', array('template_name' => 'Email Template For Supervisor Completed'));
			$body_sup = str_replace($emailPara, $dataPara, $EmailTemplate_sup['text']);
			$res_sup = simpleMail_punch($email_info,$to_mail_supervisor,$EmailTemplate_sup['subject'],$body_sup);

			$mailLog['mail Send'] = 'Punch Request Completed';
			$mailLog['Email Send to Employee'] = $res;
			$mailLog['Email Send to Supervisor'] = $res_sup;
			$mailLog['mail subject'] = $EmailTemplate['subject'];
			$mailLog['mail subject to supervisor'] = $EmailTemplate_sup['subject'];
			file_put_contents(FILE_PATH.'uploads/log/'.date("d-m-Y").'_maillog.txt', "\n\n---------- Punch Request Completed -------------\n".print_r($mailLog,true) , FILE_APPEND);
		}
		

	}

/**
	 * Update Response Status 
	 * @return Result
	 */
	public function update_response_Status()
	{	

		$id = $this->input->post('punchId');
		if ($this->input->post('response_status')) {
			$response_st = $this->input->post('response_status');
			if($response_st  ==  'Completed' || $response_st  ==  'Canceled'){
				$data['response_status_hr'] = $response_st ;
				$data['response_status_sup'] = "Approved";
			}else if($response_st  ==  'New'){
				$data['response_status_sup'] = $response_st ;
				$data['response_status_hr'] = $response_st ;
			}else{
				$data['response_status_sup'] = $response_st ;
				$data['response_status_hr'] = "New";
			}
			
		}

		$facility = $this->input->post('facility');
		$search_employee_name = $this->input->post('search_employee_name');
		$search_response_status = $this->input->post('search_response_status');
		$fromDate = $this->input->post('from__punch');
		$toDate = $this->input->post('to__punch');
		$facility_name = $this->input->post('facility_name');

		$result = $this->Common_model->update($data, 'punch_form_master', array('id' =>$id));
		if($result){
			$punch_form = $this->Common_model->getSingle_data('*', 'punch_form_master', array('id' => $id));
			if(!empty($punch_form)){
				if(! ((@$response_st  ==  'Completed' || @$response_st  ==  'Canceled') && @$this->userType == 2 )){
					$this->email_send($punch_form,$response_st);
				}
			}

		$data = $this->get_punch($search_employee_name,$fromDate,$toDate,$search_response_status,$facility,$facility_name);
		
		$this->load->view('punchform/filter_punch_list', $data);

		}else{
			echo 'error';
		} 
		
	}
	/**
	 * Update Punch Detail
	 * @return Result
	 */
	public function update_punchform()
	{
		$id = $this->input->post('punchId');
		$data['first_name'] = trim($this->input->post('first_name'));
		$data['last_name'] = trim($this->input->post('last_name'));
		$data['email_id'] = trim($this->input->post('email_id'));
		$data['ssn'] = $this->input->post('ssn');
		$data['discipline']= $this->input->post('discipline');
		$data['facility'] = $this->input->post('facility');
		$data['date'] = date("Y-m-d",strtotime($this->input->post('date')));
		$data['punch_status'] = $this->input->post('punch_status');
		$data['punch_type'] =  $this->input->post('punch_type');
		$punch_type = $this->Common_model->getSingle_data('punch_type_name', 'punch_type', array('id' => $data['punch_type']));
		if($punch_type['punch_type_name'] == 'IN' || $punch_type['punch_type_name'] == 'OUT'){
			$data['lunch_minutes'] = '';	
			$data['punch_time'] = $this->input->post('punch_time');
		}else{
			$data['punch_time'] = '';	
			$data['lunch_minutes'] = $this->input->post('lunch_minutes');
		}
		$data['reason'] = $this->input->post('reason');
		$data['optima_login_id'] = $this->input->post('optima_login_id');
		if($this->input->post('response_status')){
			$response_st = $this->input->post('response_status');
			if($response_st  ==  'Completed' || $response_st  ==  'Canceled'){
				$data['response_status_hr'] = $response_st ;
				$data['response_status_sup'] = "Approved";
			}else if($response_st  ==  'New'){
				$data['response_status_sup'] = $response_st ;
				$data['response_status_hr'] = $response_st ;
			}else{
				$data['response_status_sup'] = $response_st ;
				$data['response_status_hr'] = "New" ;
			}
		}
		$data['comment_status'] = $this->input->post('comment_status');
		$data['createDate'] = date("Y-m-d H:i:s");
		$data['updateDate'] = date("Y-m-d H:i:s");
		$result = $this->Common_model->update($data, 'punch_form_master', array('id' =>$id));
		if($result){
			$punch_form = $this->Common_model->getSingle_data('*', 'punch_form_master', array('id' => $id));
			if(!empty($punch_form)){
				if(!empty(@$response_st)){
					$this->email_send($punch_form,$response_st);
				}
			}
		$this->session->set_flashdata('message', 'Punch Requested Submitted Successfully');
		redirect('time-adjustment-request');
		}else{
			$this->session->set_flashdata('error', 'Punch Request Failed.'); 
			redirect('time-adjustment-request');
		}  
		
	}

		/**
	 * Get Punch Detail
	 * @return Result
	 */
	public function get_punch_detail(){
		$punchId = $this->input->post('punchId');
		$data['punch_detail'] = $this->Common_model->getSingle_data('*', 'punch_form_master', array('id' => $punchId));
		$data['punch_type_time'] = $this->Common_model->getSingle_data('punch_type_name', 'punch_type', array('id' => $data['punch_detail']['punch_type']));
		$data['facilities_list'] = $this->Common_model->getall_data('*', 'facilities_list', array('isActive' => '1'));
		$where = ' isActive = "1" ORDER BY order_by ASC';
		$data['punch_status'] = $this->Common_model->getall_data('*', 'punch_status', $where);
		$data['punch_type'] = $this->Common_model->getall_data('*', 'punch_type', $where);
		$data['discipline'] = $this->Common_model->getall_data('*', 'discipline', $where);
		$this->load->view('punchform/filter_punch_detail',$data);
	}

	/**
	 * Delete Punch Request
	 * @return Layout
	 */
	public function delete_punch($id){
		$result = $this->Common_model->delete('punch_form_master', array('id' => $id));
		if($result){
			$this->session->set_flashdata('message', 'Delete Successfully');
			redirect('time-adjustment-request');
		}else{
			$this->session->set_flashdata('error', 'Something Went Worng.');
			redirect('time-adjustment-request');
		}
	}
	

}