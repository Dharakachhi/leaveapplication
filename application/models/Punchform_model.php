<?php 

class Punchform_model extends CI_Model{

  /**
   * Get Punch List
   * @return Result Array
   */
  public function get_punch_list($where){
    if($this->userType == '2'){
      $where .= " AND punch_form_master.facility =".$this->sup_id;
    }
    $sql = "SELECT punch_form_master.*,facilities_list.facility_name,facilities_list.supervisor_email,facilities_list.rehab_director from punch_form_master JOIN facilities_list ON facilities_list.id=punch_form_master.facility $where"; 
    $query = $this->db->query($sql);
    return $query->result_array();
  }
}