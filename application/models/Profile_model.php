<?php 

class Profile_model extends CI_Model{

	/**
	 *  Check Duplicate User Email
	 *  @return true or false
	 */
	public function check_duplicate_email($email, $id){
	    $sql = "SELECT id FROM user_master WHERE email='$email' AND id != '$id'";
	    $query = $this->db->query($sql);
	    if ($query->num_rows($query) > 0) {
	        return 'false';
	    } else {
	        return 'true';
	    }
  	}

  		/**
	 *  Check password
	 *  @return true or false
	 */
	public function check_password($table_name,$old_password, $id){
		$sql = "SELECT id FROM $table_name WHERE password != '$old_password' AND id = '$id'";
	    $query = $this->db->query($sql);
	    if ($query->num_rows($query) > 0) {
	        return 'false';
	    } else {
	        return 'true';
	    }
  	}
}