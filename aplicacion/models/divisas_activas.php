<?php
class Divisas_activas extends CI_Model {

 function get_divisas_activas(){
  $this->db->select("*");
  $this->db->from('divisas');
  $this->db->where('ACTIVO',"1");
  $query = $this->db->get();
  return $query->result();
 }

}
?>
