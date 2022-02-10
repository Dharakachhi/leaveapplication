<?php 

class Punchstatus_model extends CI_Model{

  	/**
	 *  Check Duplicate User Email
	 *  @return true or false
	 */
	public function dublicate_status($punch_status_name, $id){
		if($id != ''){
			$sql = "SELECT id FROM punch_status WHERE punch_status_name='$punch_status_name' AND id != '$id'";
		} else{
			$sql = "SELECT id FROM punch_status WHERE punch_status_name='$punch_status_name'";
		}
	    $query = $this->db->query($sql);
	    if ($query->num_rows($query) > 0) {
	        return 'false';
	    } else {
	        return 'true';
	    }
  	}
}