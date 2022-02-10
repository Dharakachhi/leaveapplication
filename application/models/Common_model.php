<?php 
class Common_model extends CI_Model{

  /**
   *  Insert Function
   *  @return Last insert ID
   */
  public function insert($data ,$table){
    $this->db->insert($table, $data);
    return $this->db->insert_id();
  }

  /**
   *  Update Function
   *  @return true or false
   */
  public function update($data, $table, $where){
  	$this->db->where($where);
  	return $this->db->update($table, $data);
  }

  /**
   *  Delete Function
   *  @return true or false
   */
  public function delete($table, $where){
    $this->db->where($where);
    return $this->db->delete($table);
  }

  /**
   *  Get Multiple Data
   *  @return result array
   */
  public function getall_data($data, $table, $where=''){
  	$this->db->select($data);
  	$this->db->from($table);
    if($where != ''){
      $this->db->where($where);
    }
  	$info = $this->db->get();
  	return $info->result_array();
  }

  /**
   *  Get Single Data
   *  @return Row array
   */
  public function getSingle_data($data, $table, $where=''){
    $this->db->select($data);
    $this->db->from($table);
    if($where != ''){
      $this->db->where($where);
    }
    $info = $this->db->get();
    return $info->row_array();
  }
  
}