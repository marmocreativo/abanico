<?php
class TiendaModel extends CI_Model{

    public function lista($id){
      if(!empty($parametros)){
        $this->db->or_like($parametros);
      }
      if(!empty($orden)){
        $this->db->order_by($orden);
      }
      if(!empty($limite)){
        $this->db->limit($limite);
      }
      $query = $this->db->get('paises');
      return $query->result();
    }

    public function detalles($id){
        return $this->db->get_where('tiendas',array('ID_TIENDA'=>$id))->row_array();
    }
    
    public function tienda_usuario($id){
        return $this->db->get_where('tiendas',array('ID_USUARIO'=>$id),1)->row_array();
    }
    /*
      * Creo una nueva entrada usando los parámetros
   */
    function crear($parametros){
      $this->db->insert('tiendas',$parametros);
      return $this->db->insert_id();
    }
    /*
      * Actualizo una entrada
      * $id es el identificador de la entrada
      * $parametros son los campos actualizados
   */
    function actualizar($id,$parametros){
      $this->db->where('ID_TIENDA',$id);
      return $this->db->update('tiendas',$parametros);
    }
    /*
      * Borro una entrada
      * $id es el identificador de la entrada
   */
    function borrar($id){
      return $this->db->delete('tiendas',array('ID_TIENDA'=>$id));
    }
    /*
      * Interruptor cambia el estado de una entrada de activo a inactivo
      * $id es el identificador de la entrada
      * $activo es el estado actual de la entrada
   */
    function activar($id,$activo){

      switch($activo){
        case "activo":
          $activo = "inactivo";
        break;
        case "inactivo":
          $activo = "activo";
        break;
        default:
          $activo = "activo";
        break;
      }
      $this->db->where('ID_TIENDA',$id);
      return $this->db->update('tiendas',array('TIENDA_ESTADO'=>$activo));
    }
    /*
      * Cambio el estado de la entrada, puede ser cualquier estado
      * $id es el identificador de la entrada
      * $activo es el estado al que se quiere cambiar la entrada
   */
    function estado($id,$activo){
      $this->db->where('ID_TIENDA',$id);
      return $this->db->update('tiendas',array('TIENDA_ESTADO'=>$activo));
    }
    /*
      * Creo el orden de los elementos
      * $orden son los identificadores de las entradas en el orden en que quiero que aparezcan
   */
    function ordenar($orden){
      $i = 0;
      foreach($orden as $orden){
        $this->db->where('ID_TIENDA',$orden);
        return $this->db->update('tiendas',array('ORDEN'=>$i));
        $i++;
      }
    }
}
?>
