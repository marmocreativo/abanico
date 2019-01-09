<?php
class GuiasPedidosModel extends CI_Model {
  function __construct()
  {
      parent::__construct();
      // Función Construct
  }
  /*
    * Enlisto todas las entradas
    * $parametros Debe ser un array de Columnas y Valores, Busco usando la función LIKE
    * $orden indicará la Columna y si es ascendente o descendente
    * $limite Solo se usará si hay una cantidad limite de productos a mostrar
 */
  function lista($parametros,$orden,$limite){
    if(!empty($parametros)){
      $this->db->or_like($parametros);
    }
    if(!empty($orden)){
      $this->db->order_by($orden);
    }
    if(!empty($limite)){
      $this->db->limit($limite);
    }
    $query = $this->db->get('guias_abanico');
    return $query->result();
  }
  /*
    * Enlisto todas las entradas
    * $parametros Debe ser un array de Columnas y Valores, Busco usando la función LIKE
    * $orden indicará la Columna y si es ascendente o descendente
    * $limite Solo se usará si hay una cantidad limite de productos a mostrar
 */
  function lista_guias($id_pedido){
      $this->db->where('ID_PEDIDO',$id_pedido);
    $query = $this->db->get('guias_abanico');
    return $query->result();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($guia){
    return $this->db->get_where('guias_abanico',array('GUIA_CODIGO'=>$guia))->row_array();
  }

  /*
    * Conteo de productos
 */
  function conteo_guias_abanico_usuario($id_usuario){

    $this->db->where('ID_USUARIO',$id_usuario);
    $query = $this->db->count_all_results('guias_abanico');
    return $query;
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('guias_abanico',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Actualizo una entrada
    * $id es el identificador de la entrada
    * $parametros son los campos actualizados
 */
  function actualizar($guia,$parametros){
    $this->db->where('GUIA_CODIGO',$guia);
    return $this->db->update('guias_abanico',$parametros);
  }
  /*
    * Cambio el estado de la entrada, puede ser cualquier estado
    * $id es el identificador de la entrada
    * $activo es el estado al que se quiere cambiar la entrada
 */
  function estado($id,$activo){
    $this->db->where('ID_PEDIDO',$id);
    return $this->db->update('guias_abanico',array('PAIS_ESTADO'=>$activo));
  }

}
?>
