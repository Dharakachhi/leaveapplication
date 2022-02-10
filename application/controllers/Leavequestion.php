<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leavequestion extends Auth_Controller {

	/**
	 * construct
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('Common_model');
		$this->load->model('Leavequestion_model');
		$this->userId = $this->session->userdata('userId');
		$this->userType = $this->session->userdata('userType');
	}

	/**
	 * Leave Question
	 * @return Layout
	 */
	public function leave_question_list(){
		if(@$this->userType != '2'){
			$data['leave_question'] = $this->Leavequestion_model->get_leave_question_list();
			$this->load->view('template/header');
			$this->load->view('leavequestion/leavequestion_list', $data);
			$this->load->view('template/footer');
		} else{
			redirect('leave-requests');
		}
	}

	/**
	 * Create Leave Question
	 * @return Layout
	 */
	public function create_leavequestion(){
		if(@$this->userType != '2'){
			$data['leave_type'] = $this->Common_model->getall_data('leave_type_id, leave_type_name', 'leave_type_master', ' 1 ORDER BY order_by ASC');
			$this->load->view('template/header');
			$this->load->view('leavequestion/add_leavequestion', $data);
			$this->load->view('template/footer');
		} else{
			redirect('leave-requests');
		}
	}

	/**
	 * Insert Leave Question
	 * @return Result
	 */
	public function insert_leavequestion(){

		$data['leave_question'] = $this->input->post('question_name');
		$data['isActive'] = $this->input->post('leave_status');
		$data['parent_id'] = $this->input->post('parent_leave');
		$data['leave_type_id'] = $this->input->post('parent_leave');

		if($this->input->post('is_mandatory')){
			$data['isMandatory'] = $this->input->post('is_mandatory');
		} else{
			$data['isMandatory'] = '0';
		}
		if($this->input->post('is_subquestion')){
			$data['isSubquestion'] = $this->input->post('is_subquestion');
			$data['related_question'] = $this->input->post('related_question');
			$data['related_question_option'] = $this->input->post('related_question_option');
		} else{
			$data['isSubquestion'] = '0';
			$data['related_question'] = '0';
			$data['related_question_option'] = '0';
		}
		
		$input_type = $this->input->post('input_type');
		$data['input_type'] = $input_type;
		
		$data['createBy'] = $this->userId;
		$data['createDate'] = date("Y-m-d H:i:s");
		$data['updateDate'] = date("Y-m-d H:i:s");

		$result = $this->Common_model->insert($data, 'leave_question');
		if($result){
			if($input_type == 'Checkbox' || $input_type == 'Dropdown'){
				$lableArr = $this->input->post('lable_name');
				$lableorderArr = $this->input->post('lable_order');
				$or = 0;
				if(!empty($lableArr)){
					foreach($lableArr as $lableVal){
						$data1['leave_question_id'] = $result;
						$data1['lable_name'] = $lableVal;
						$data1['lable_order'] = $lableorderArr[$or];
						$data1['createDate'] = date("Y-m-d H:i:s");
						$data1['updateDate'] = date("Y-m-d H:i:s");

						$optionResult = $this->Common_model->insert($data1, 'leave_question_detail');
						$or++;
					}
				}
			}

			$this->session->set_flashdata('message', 'Leave Question Inserted Successfully.');
			redirect('leave-question');
		} else{
			$this->session->set_flashdata('error', 'Leave Question Insert Failed.');
			redirect('leave-question');
		}
	}

	/**
	 * Edit Leave Question
	 * @return Layout
	 */
	public function edit_leavequestion($id){
		if(@$this->userType != '2'){
			$data['single_leave'] = $this->Common_model->getSingle_data('*', 'leave_question', array('leave_question_id' => $id));
			$data['single_leave_detail'] = $this->Common_model->getall_data('*', 'leave_question_detail', array('leave_question_id' => $id));
			$data['related_question_detail'] = $this->Common_model->getall_data('*', 'leave_question_detail', array('leave_question_id' => $data['single_leave']['related_question']));
			$data['leave_type'] = $this->Common_model->getall_data('leave_type_id, leave_type_name', 'leave_type_master', ' 1 ORDER BY order_by ASC');
			$data['leave_question'] = $this->Common_model->getall_data('leave_question_id, 	leave_question, input_type', 'leave_question', array('leave_question_id !=' => $id, 'leave_type_id' => $data['single_leave']['leave_type_id'], 'isSubquestion' => '0', 'isActive' => '1'));
			$this->load->view('template/header');
			$this->load->view('leavequestion/edit_leavequestion', $data);
			$this->load->view('template/footer');
		} else{
			redirect('leave-requests');
		}
	}

	/**
	 * Update Leave Question
	 * @return Result
	 */
	public function update_leavequestion(){

		$question_id = $this->input->post('question_id');
		$data['leave_question'] = $this->input->post('question_name');
		$data['isActive'] = $this->input->post('leave_status');
		$data['parent_id'] = $this->input->post('parent_leave');
		$data['leave_type_id'] = $this->input->post('parent_leave');

		if($this->input->post('is_mandatory')){
			$data['isMandatory'] = $this->input->post('is_mandatory');
		} else{
			$data['isMandatory'] = '0';
		}

		if($this->input->post('is_subquestion')){
			$data['isSubquestion'] = $this->input->post('is_subquestion');
			$data['related_question'] = $this->input->post('related_question');
			$data['related_question_option'] = $this->input->post('related_question_option');
		} else{
			$data['isSubquestion'] = '0';
			$data['related_question'] = '0';
			$data['related_question_option'] = '0';
		}

		$input_type = $this->input->post('input_type');
		$data['input_type'] = $input_type;
		$data['updateDate'] = date("Y-m-d H:i:s");

		// $deleteOptionResult = $this->Common_model->delete('leave_question_detail', array('leave_question_id' => $question_id));
		$getOptionResult = $this->Common_model->getall_data('leave_question_detail_id', 'leave_question_detail', array('leave_question_id' => $question_id));
		foreach($getOptionResult as $option){
			$optionArr[] = $option['leave_question_detail_id'];
		}
		if($input_type == 'Checkbox' || $input_type == 'Dropdown'){
			$lableArr = $this->input->post('lable_name');
			$lableorderArr = $this->input->post('lable_order');
			$or = 0;
			if(!empty($lableArr)){
				foreach($lableArr as $lableVal){
					$data1['leave_question_id'] = $question_id;
					$data1['lable_name'] = $lableVal;
					$data1['lable_order'] = $lableorderArr[$or];
					$data1['updateDate'] = date("Y-m-d H:i:s");

					if(!empty($optionArr)){
						$optionResult = $this->Common_model->update($data1, 'leave_question_detail', array('leave_question_detail_id' => @$optionArr[$or]));
						if (($key = array_search(@$optionArr[$or], $optionArr)) !== false) {
						    unset($optionArr[$key]);
						}
					} else{
						$data1['createDate'] = date("Y-m-d H:i:s");
						$optionResult = $this->Common_model->insert($data1, 'leave_question_detail');
					}
					$or++;
				}
			}
		}

		if(!empty($optionArr)){
			$optionList = implode(',', $optionArr);
			$where = ' leave_question_detail_id IN ('.$optionList.')';
			$optionResult = $this->Common_model->delete('leave_question_detail', $where);
		}

		$result = $this->Common_model->update($data, 'leave_question', array('leave_question_id' => $question_id));
		if($result){
			if($data['isActive'] == '0'){
				$data2['isActive'] = $this->input->post('leave_status');
				$relatedResult = $this->Common_model->update($data2, 'leave_question', array('related_question' => $question_id));
			}
			$this->session->set_flashdata('message', 'Leave Question Updated Successfully.');
			redirect('leave-question');
		} else{
			$this->session->set_flashdata('error', 'Leave Question Update Failed.');
			redirect('leave-question');
		}
	}

	/**
	 * Get Related Question Option
	 * @return Option list
	 */
	public function get_question_sub_option(){
		$leaveId = $this->input->post('leaveId');
		$optionResult = $this->Common_model->getall_data('leave_question_detail_id, lable_name', 'leave_question_detail', array('leave_question_id' => $leaveId));
		$optionList = '<label class="col-md-3 control-label">Question Option:</label>
                        <div class="col-md-9">
                            <select name="related_question_option" id="related_question_option" class="form-control select2">
                                <option value="">Select Question Option</option>';
        if(!empty($optionResult)){
        	foreach($optionResult as $optionVal){
        		$optionList .= '<option value="'.@$optionVal['leave_question_detail_id'].'">'.@$optionVal['lable_name'].'</option>';
        	}
        }
        $optionList .= '</select>
        				<label id="related_question_option-error" class="error" for="related_question_option"></label>
                    </div>';
        echo $optionList; exit;
	}

	/**
	 * Check Duplicate Email
	 */
	public function check_duplicate_question($id = ''){
		$question_name = $this->input->post('question_name');
		$parent_leave_id = $this->input->post('parent_leave_id');
		$result = $this->Leavequestion_model->check_duplicate($question_name, $id, $parent_leave_id);
		echo $result; exit;
	}

	/**
	 * Get Leave Level
	 * @return level
	 */
	public function get_leave_level(){
		$leaveId = $this->input->post('leaveId');
		$result = $this->Common_model->getSingle_data('parent_id', 'leave_question', array('leave_type_id' => $leaveId));
		if($result['parent_id'] == '0'){
			echo '2';
		} else if($result['parent_id'] != '0'){
			echo '3';
		} else{
			echo '1';
		}
		exit;
	}

	/**
	 * Active Or InActive Leave Question
	 * @return Result
	 */
	public function change_leave_status(){
		$data['isActive'] = $this->input->post('status');
		$leaveId = $this->input->post('leaveId');
		$result = $this->Common_model->update($data, 'leave_question', array('leave_question_id' => $leaveId));
		if($result){
			if($data['isActive'] == '0'){
				$relatedResult = $this->Common_model->update($data, 'leave_question', array('related_question' => $leaveId));
			}
			echo "update";
		} else{
			echo "error";
		}
		exit;
	}

	/**
	 * Get Question Based on Leave type
	 * @return Result
	 */
	public function get_leave_question(){
		$leaveID = $this->input->post('leaveID');
		$isSubquestion = $this->input->post('isSubquestion');
		$questionId = $this->input->post('questionId');
		if($isSubquestion == '1'){
			$status = '';
		} else{
			$status = 'disabled';
		}

		if($questionId != '0'){
			$questionResult = $this->Common_model->getall_data('*', 'leave_question', array('leave_type_id' => $leaveID, 'leave_question_id !=' => $questionId, 'isSubquestion' => '0', 'isActive' => '1'));
		} else{
			$questionResult = $this->Common_model->getall_data('*', 'leave_question', array('leave_type_id' => $leaveID, 'isSubquestion' => '0', 'isActive' => '1'));
		}
		

		$optionList = '<select name="related_question" id="related_question" class="form-control select2" '.$status.'>
                        <option id="0" value="">Select Related Question</option>';
        if(!empty($questionResult)){
        	foreach($questionResult as $questionVal){
        		$optionList .= '<option id="'.@$questionVal['input_type'].'" value="'.@$questionVal['leave_question_id'].'">'.@$questionVal['leave_question'].'</option>';
        	}
        }
        $optionList .= '</select>
        				<label id="related_question-error" class="error" for="related_question"></label>';
        echo $optionList; exit;
	}
}