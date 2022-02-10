<?php 

class Supervisor_model extends CI_Model{

  	/**
	 *  Check Duplicate User Email
	 *  @return true or false
	 */
	public function check_duplicate_email($supervisor_email, $supervisor_password, $id) {
		if ($id != '' && $id != 'undefined') {
			$sql = "SELECT id FROM facilities_list WHERE supervisor_email='$supervisor_email' AND password='" . md5($supervisor_password) . "' AND id != '$id'";
		} else {
			$sql = "SELECT id FROM facilities_list WHERE supervisor_email='$supervisor_email' AND password='" . md5($supervisor_password) . "'";
		}
		$query = $this->db->query($sql);
		if ($query->num_rows($query) > 0) {
			return 'false';
		} else {
			return 'true';
		}
	}
}