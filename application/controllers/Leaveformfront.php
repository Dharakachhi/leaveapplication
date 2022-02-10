<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leaveformfront extends CI_Controller {

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
	public function leave_form(){
		$where = ' isActive = "1" ORDER BY order_by ASC';
		$data['leave_list'] = $this->Common_model->getall_data('leave_type_id, leave_type_name', 'leave_type_master', $where);
		$data['state_list'] = $this->Common_model->getall_data('id, name', 'states', array('country_id' => '233'));
		$this->load->view('template/Leaveheader');
		$this->load->view('leaveformfront/leave-form', $data);
		$this->load->view('template/Leavefooter');
	}

	/**
	 * Insert Leave
	 * @return Result
	 */
	public function insert_leaveform(){
		$data['firstName'] = $this->input->post('first_name');
		$data['lastName'] = $this->input->post('last_name');
		$lastName = substr($data['lastName'], 0, 1);
		$str1 = 'abcdefghijklABCDEFGHIJKL';
		$str2 = 'mnopqrstuvwxyzMNOPQRSTUVWXYZ';
		$data['leave_reason'] = $this->input->post('leave_reason');
		$defaultEmail = '';

		$leavereason = $this->Common_model->getSingle_data('custome_email, email_labelmz, email_labelal, default_email_checkbox', 'leave_type_master', array('leave_type_id' => $data['leave_reason']));

		if(@$leavereason['custome_email'] == 1  && @$leavereason['custome_email'] == '1'){
			if(@$leavereason['default_email_checkbox'] == 1  && @$leavereason['default_email_checkbox'] == '1'){
				if(strpos($str1, @$lastName) !== false){
	                $data['manager'] = 'Maria Korey';
	                $email = $leavereason['email_labelal'];
	            }
	            if(strpos($str2, @$lastName) !== false){
	                $data['manager'] = 'Elida Sanchez';
	                $email = $leavereason['email_labelmz'];
	            }

	            // Default Email
	            if(strpos($str1, @$lastName) !== false){
					$data['manager'] = 'Maria Korey';
					$defaultEmail = 'requestal@tendertouch.com';
				}
				if(strpos($str2, @$lastName) !== false){
					$data['manager'] = 'Elida Sanchez';
					$defaultEmail = 'requestmz@tendertouch.com';
				}
			} else{
				if(strpos($str1, @$lastName) !== false){
	                $data['manager'] = 'Maria Korey';
	                $email = $leavereason['email_labelal'];
	            }
	            if(strpos($str2, @$lastName) !== false){
	                $data['manager'] = 'Elida Sanchez';
	                $email = $leavereason['email_labelmz'];
	            }
			}
		}else {
			if(strpos($str1, @$lastName) !== false){
		    $data['manager'] = 'Maria Korey';
		    $email = 'requestal@tendertouch.com';

			}
			if(strpos($str2, @$lastName) !== false){
			    $data['manager'] = 'Elida Sanchez';
			    $email = 'requestmz@tendertouch.com';
			}
		}

		// if(strpos($str1, $lastName) !== false){
		//     $data['manager'] = 'Maria Korey';
		//     $email = 'requestal@tendertouch.com';
		// }
		// if(strpos($str2, $lastName) !== false){
		//     $data['manager'] = 'Elida Sanchez';
		//     $email = 'requestmz@tendertouch.com';
		// }

		$data['people'] = $this->input->post('people');
		$sup_date = $this->input->post('sup_date');
		if(@$sup_date){
			$data['sup_date'] =  date('Y-m-d', strtotime($sup_date));
		}else{
			$data['sup_date']=  '0000-00-00';
		}
		$discussed_supervisor = $this->input->post('discussed_supervisor');
		if(@$discussed_supervisor){
			$data['discs_supervisor'] = '1';
		}else{
			$data['discs_supervisor'] = '0';
		}
		$employee_signature = $this->input->post('employee_signature');
		if(@$employee_signature){
			$data['employee_signature'] = $this->input->post('employee_signature');
		}else{
		$data['employee_signature'] = '';
		}
		$signed_date = $this->input->post('signed_date');
		if(@$signed_date){
			$data['signed_date'] = date('Y-m-d', strtotime($signed_date));
		}else{
			$data['signed_date'] = '0000-00-00';
		}
		$superviser_signature = $this->input->post('superviser_signature');
		if(@$superviser_signature){
			$data['superviser_signature'] = $superviser_signature;
		}else{
			$data['superviser_signature'] = '';
		}
		$superviser_sign_date = $this->input->post('superviser_sign_date');
		if(@$superviser_sign_date){
			$data['superviser_sign_date'] = date('Y-m-d', strtotime($superviser_sign_date));
		}else{
			$data['superviser_sign_date'] = '0000-00-00';
		}

		$data['leave_detail'] = json_encode($_POST);
		$data['contactNumber'] = $this->input->post('contact_number');
		$data['user_email'] = $this->input->post('email_id');
		$data['state'] = $this->input->post('state');
		$data['discipline'] = $this->input->post('discipline');
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
		$data['leave_status'] = 'Pending';
		$data['comment_status'] = $this->input->post('comment_status');
		$data['date_submitted'] = date("Y-m-d");
		$data['createDate'] = date("Y-m-d H:i:s");
		$data['updateDate'] = date("Y-m-d H:i:s");

		$countfiles = $this->input->post('file_name');
		$countfileStatus = $this->input->post('file_status');
		$fileList = array();
		$i=0;
		if(!empty(@$countfiles)){
	        foreach(@$countfiles as $file){
	        	if(@$countfileStatus[$i] == 'Success'){
	        		$fileList[] = $file;
	        	}
	        	$i++;
	        }
		}

        if(!empty(@$fileList)){
        	$data['attachment_file'] = implode(',', $fileList);
        }

		$result = $this->Common_model->insert($data, 'leave_form_master');
		if($result){
			$body = '';
			$leaveName = $this->Common_model->getSingle_data('leave_type_name', 'leave_type_master', array('	leave_type_id' => $data['leave_reason']));
			$EmailTemplate = $this->Common_model->getSingle_data('text', 'email_template', array('	template_name' => 'Email Template For Request'));
			$Ename = $data['firstName']." ".$data['lastName'];
			if($this->input->post('tbd')){
				$dateLeave = $last_day_work." to TBD";
			} else{
				$dateLeave = $last_day_work." to ".$return_date;
			}
			
			$emailPara = array('{Employee Name}', '{Employee Email}', '{Employee Contact}', '{Employee Facility}', '{Leave Reason}', '{Dates of the Leave Request}', '{Comment}', '{Leave Status}');
			$dataPara = array($Ename, $data['user_email'], $data['contactNumber'], $data['facility'], $leaveName['leave_type_name'], $dateLeave, $data['comment_status'], 'Pending');

			$body = str_replace($emailPara, $dataPara, $EmailTemplate['text']);

			$mailLog['date'] = date('Y-m-d H:i:s');
			$mailLog['mail Send'] = 'Leave Request';
			$mailLog['Employee Name'] = $Ename;
			// Email Send to HR
			$to_mail = $email;
			$hrMailMessage = 'A new leave request from {Employee Name} for the dates {Dates of the Leave Request} has been made. Please log on to the portal to Approve or deny.';
			$hrMailBody = str_replace($emailPara, $dataPara, $hrMailMessage);
			$resHR = simpleMail($to_mail,'Leave Request',$hrMailBody);
			$mailLog['Email Send to HR'] = $resHR;

			if(@$defaultEmail != ''){
				$to_mail = $defaultEmail;
				$hrMailMessage = 'A new leave request from {Employee Name} for the dates {Dates of the Leave Request} has been made. Please log on to the portal to Approve or deny.';
				$hrMailBody = str_replace($emailPara, $dataPara, $hrMailMessage);
				$resHR = simpleMail($to_mail,'Leave Request',$hrMailBody);
				$mailLog['Email Send to default HR'] = $resHR;
			}

			// Email Send to Employee
			$to_mail_emp = $data['user_email'];
			$resEmp = simpleMail($to_mail_emp,'Leave Request',$body);
			$mailLog['Email Send to Employee'] = $resEmp;
			file_put_contents(FILE_PATH.'uploads/log/'.date("d-m-Y").'_maillog.txt', "\n\n---------- Leave Request -------------\n".print_r($mailLog,true) , FILE_APPEND);

			$this->session->set_flashdata('message', 'Leave Requested Submitted');
			redirect('leave-message');
		} else{
			$this->session->set_flashdata('error', 'Leave Request Failed.');
			redirect('leave-message');
		}
	}

	/**
	 * Get Leave Sub Question
	 * @return Layout
	 */
	public function get_leave_question(){
		$leaveID = $this->input->post('leaveID');
		$data['leave_detail'] = $this->Common_model->getall_data('*', 'leave_question', array('leave_type_id ' => $leaveID, 'isSubquestion' => '0', 'isActive' => '1'));
		$data['question_detail'] = $this->Leaveform_model->get_question_data($leaveID);
		$this->load->view('leaveformfront/leave-question', $data);
	}

	/**
	 * Get Leave Sub Question based on other Question
	 * @return Layout
	 */
	public function get_leave_sub_question(){
		$questionId = $this->input->post('questionId');
		$typeId = $this->input->post('typeId');
		if(@$questionId != '0'){
	        $data['leave_detail'] = $this->Common_model->getall_data('*', 'leave_question', array('related_question' => $typeId, 'related_question_option' => $questionId, 'isSubquestion' => '1', 'isActive' => '1'));
	      } else{
	        $data['leave_detail'] = $this->Common_model->getall_data('*', 'leave_question', array('related_question' => $typeId, 'isSubquestion' => '1', 'isActive' => '1'));
	      }
		$data['question_detail'] = $this->Leaveform_model->get_sub_question_data($typeId, $questionId);
		$this->load->view('leaveformfront/leave-sub-question', $data);
	}

	/**
	 * Success message show page
	 * @return Layout
	 */
	public function leave_message(){
		$this->load->view('template/Leaveheader');
		$this->load->view('leaveformfront/leave-message');
		$this->load->view('template/Leavefooter');
	}

	/**
	 * file upload in leave form
	 * @return Result
	 */
	public function upload_file(){
		$fileName = '';
        $status = '';
		if (!empty(@$_FILES['attachment_file']['name'])) {
            $path = FILE_PATH . './uploads/attachment/'; 
            if (!file_exists(@$path)) {
                mkdir($path, 0777, true);
            }

            $config['upload_path'] = $path;
            $config['allowed_types'] = '*';
            $config['max_size'] = 4096;
            $config['max_width'] = 2000;
            $config['max_height'] = 2000;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('attachment_file')) {
                $error = $this->upload->display_errors();
                // $this->session->set_flashdata('error', $error);
                // redirect('add/product');
                $fileName = $_FILES['attachment_file']['name'];
                $status = 'error';
            }
            else{
                $post_image = $this->upload->data();
                $fileName = $post_image['file_name'];
                $status = 'success';
            }
        }
        $arr = array('message' => $status, 'name' => $fileName);
        echo json_encode($arr); exit;
	}

	/**
	 * file remove in leave form
	 * @return Result
	 */
	public function delete_upload_file(){
		$fileName = $this->input->post('fileName');
		$path = FILE_PATH . 'uploads/attachment/'.$fileName;
		if( file_exists($path) ){
	      unlink($path);
	      echo 'success'; 
	   }else{
	      echo 'error'; 
	   } 
	}
}