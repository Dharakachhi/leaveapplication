<?php 

class Leaveform_model extends CI_Model{

  	/**
  	 * Get Order Question List
  	 * @return Result Array
  	 */
  	public function get_question_data($leaveID){
        $sql = "SELECT lqd.* from leave_question as lq Inner JOIN leave_question_detail as lqd ON lqd.leave_question_id = lq.leave_question_id WHERE lq.leave_type_id = '$leaveID' AND lq.isSubquestion='0' AND lq.isActive = '1'";
        $query = $this->db->query($sql);
        return $query->result_array();
	}

	/**
  	 * Get Order Question List
  	 * @return Result Array
  	 */
  	public function get_sub_question_data($questionId, $typeId){
      if($typeId != '0'){
        $sql = "SELECT lqd.* from leave_question as lq Inner JOIN leave_question_detail as lqd ON lqd.leave_question_id = lq.leave_question_id WHERE lq.related_question = '$questionId' AND lq.related_question_option = '$typeId' AND lq.isSubquestion='1' AND lq.isActive = '1'";
      } else{
        $sql = "SELECT lqd.* from leave_question as lq Inner JOIN leave_question_detail as lqd ON lqd.leave_question_id = lq.leave_question_id WHERE lq.related_question = '$questionId' AND lq.isSubquestion='1' AND lq.isActive = '1'";
      }
      $query = $this->db->query($sql);
      return $query->result_array();
	}

  /**
   * Get Leave List
   * @return Result Array
   */
  public function get_leave_list($where){
    $sql = "SELECT lfm.leave_form_id, lfm.firstName, lfm.lastName, lfm.facility, lfm.manager, lfm.leave_status, ltm.leave_type_name, lfm.last_day_work, lfm.createDate from leave_form_master as lfm Inner JOIN leave_type_master as ltm ON ltm.leave_type_id = lfm.leave_reason ".$where;
    $query = $this->db->query($sql);
    return $query->result_array();
  }
  
  /**
   * Get Leave List
   * @return Result Array
   */
  public function get_leave_detail($leaveId){
    $sql = "SELECT lfm.*, ltm.leave_type_name from leave_form_master as lfm Inner JOIN leave_type_master as ltm ON ltm.leave_type_id = lfm.leave_reason WHERE lfm.leave_form_id= '$leaveId'";
    $query = $this->db->query($sql);
    return $query->row_array();
  }

  public function get_leave_data_list($userId){
    if($userId == '0'){
      $sql = "SELECT lfm.*, ltm.leave_type_name from leave_form_master as lfm Inner JOIN leave_type_master as ltm ON ltm.leave_type_id = lfm.leave_reason";
    } else{
      $sql = "SELECT lfm.*, ltm.leave_type_name from leave_form_master as lfm Inner JOIN leave_type_master as ltm ON ltm.leave_type_id = lfm.leave_reason WHERE lfm.user_id = '$userId'";
    }
    $query = $this->db->query($sql);
    return $query->result_array();
  }
}