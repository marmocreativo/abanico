<?php
class Opciones extends CI_Model {

 function get_opciones(){
  $this->db->from('opciones');
  $this->db->where('ACTIVO',"1");
  $query = $this->db->get();
  return $query->result();
 }
 function lista_opciones(){
  $this->db->from('opciones');
  $query = $this->db->get();
  return $query->result();
 }
 // Crear
 function crear($parametros){
   $this->db->insert('opciones',$parametros);
   return $this->db->insert_id();
 }
 // actualizar
 function actualizar($nombre,$parametros){
   $this->db->where('OPCION_NOMBRE',$nombre);
   return $this->db->update('opciones',$parametros);
 }

}
?>
