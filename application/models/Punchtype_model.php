<?php 

class Punchtype_model extends CI_Model{

  	/**
	 *  Check Duplicate User Email
	 *  @return true or false
	 */
	public function dublicate_type($punch_type_name, $id){
		if($id != ''){
			$sql = "SELECT id FROM punch_type WHERE punch_type_name='$punch_type_name' AND id != '$id'";
		} else{
			$sql = "SELECT id FROM punch_type WHERE punch_type_name='$punch_type_name'";
		}
	    $query = $this->db->query($sql);
	    if ($query->num_rows($query) > 0) {
	        return 'false';
	    } else {
	        return 'true';
	    }
  	}
}