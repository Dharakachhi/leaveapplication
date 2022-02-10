<?php 

class User_model extends CI_Model{

  	/**
	 *  Check Duplicate User Email
	 *  @return true or false
	 */
	public function check_duplicate_email($user_email, $id){
		if($id != ''){
			$sql = "SELECT id FROM user_master WHERE email='$user_email' AND id != '$id'";
		} else{
			$sql = "SELECT id FROM user_master WHERE email='$user_email'";
		}
	    $query = $this->db->query($sql);
	    if ($query->num_rows($query) > 0) {
	        return 'false';
	    } else {
	        return 'true';
	    }
  	}
}