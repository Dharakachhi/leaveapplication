<?php 

class Leavetype_model extends CI_Model{

	/**
	 *  Check Duplicate User Email
	 *  @return true or false
	 */
	public function check_duplicate($leave_name, $id){
		if($id != ''){
			$sql = "SELECT leave_type_id FROM leave_type_master WHERE leave_type_name='$leave_name' AND leave_type_id != '$id'";
		} else{
			$sql = "SELECT leave_type_id FROM leave_type_master WHERE leave_type_name='$leave_name'";
		}
	    $query = $this->db->query($sql);
	    if ($query->num_rows($query) > 0) {
	        return 'false';
	    } else {
	        return 'true';
	    }
  	}
}