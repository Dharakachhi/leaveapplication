<?php 

class Descipline_model extends CI_Model{

  	/**
	 *  Check Duplicate User Email
	 *  @return true or false
	 */
	public function dublicate_status($discipline_name, $id){
		if($id != ''){
			$sql = "SELECT id FROM discipline WHERE discipline_name='$discipline_name' AND id != '$id'";
		} else{
			$sql = "SELECT id FROM discipline WHERE discipline_name='$discipline_name'";
		}
	    $query = $this->db->query($sql);
	    if ($query->num_rows($query) > 0) {
	        return 'false';
	    } else {
	        return 'true';
	    }
  	}
}