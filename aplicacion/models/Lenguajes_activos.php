<?php
class Lenguajes_activos extends CI_Model {

 function get_lenguajes_activos(){
  $this->db->select("*");
  $this->db->from('lenguajes');
  $this->db->where('ACTIVO',"1");
  $query = $this->db->get();
  return $query->result();
 }

}
?>
