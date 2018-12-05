<?php
class Opciones extends CI_Model {

 function get_opciones(){
  $this->db->from('opciones');
  $this->db->where('ACTIVO',"1");
  $query = $this->db->get();
  return $query->result();
 }

}
?>
