<?php
class Lenguajes_activos extends CI_Model {

 function get_lenguajes_activos(){
  $this->db->select("*");
  $this->db->from('lenguajes');
  $this->db->where('LENGUAJE_ESTADO',"activo");
  $query = $this->db->get();
  return $query->result();
 }
 function get_lenguaje($id){
  $query = $this->db->get_where('lenguajes', array('LENGUAJE_ISO' => $id),1);
  return $query->result();
 }

}
?>
