<?php
class Divisas_activas extends CI_Model {

  function get_divisas_activas(){
    $this->db->from('divisas');
    $this->db->where('DIVISA_ESTADO',"activo");
    $query = $this->db->get();
    return $query->result();
  }
 function get_divisa($id){
  $query = $this->db->get_where('divisas', array('ID_DIVISA' => $id),1);
  return $query->result();
 }

}
?>
