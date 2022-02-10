<?php 

class Leavequestion_model extends CI_Model{

	/**
	 *  Check Duplicate Question
	 *  @return true or false
	 */
	public function check_duplicate($leave_name, $id, $parent_leave_id){
		if($id != ''){
			$sql = "SELECT leave_question_id FROM leave_question WHERE leave_question='$leave_name' AND parent_id = '$parent_leave_id' AND leave_question_id != '$id'";
		} else{
			$sql = "SELECT leave_question_id FROM leave_question WHERE leave_question='$leave_name' AND parent_id = '$parent_leave_id'";
		}
	    $query = $this->db->query($sql);
	    if ($query->num_rows($query) > 0) {
	        return 'false';
	    } else {
	        return 'true';
	    }
  	}

  	/**
  	 * Get Order Question List
  	 * @return Result Array
  	 */
  	public function get_leave_question_list(){
        $sql = "SELECT lq.*, lm.leave_type_name from leave_question as lq INNER JOIN leave_type_master as lm ON lm.leave_type_id = lq.leave_type_id";
        $query = $this->db->query($sql);
        return $query->result_array();
	}
}