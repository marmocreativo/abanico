<?php
class RutasGuiasModel extends CI_Model {
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
    $query = $this->db->get('rutas_abanico');
    return $query->result();
  }
  /*
    * Enlisto todas las entradas
    * $parametros Debe ser un array de Columnas y Valores, Busco usando la función LIKE
    * $orden indicará la Columna y si es ascendente o descendente
    * $limite Solo se usará si hay una cantidad limite de productos a mostrar
 */
  function lista_rutas($guia){
      $this->db->where('GUIA_CODIGO',$guia);
      $this->db->order_by('RUTA_FECHA_REGISTRO DESC');
    $query = $this->db->get('rutas_abanico');
    return $query->result();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($guia){
    return $this->db->get_where('rutas_abanico',array('GUIA_CODIGO'=>$guia))->row_array();
  }

  /*
    * Conteo de productos
 */
  function conteo_rutas_abanico_usuario($id_usuario){

    $this->db->where('ID_USUARIO',$id_usuario);
    $query = $this->db->count_all_results('rutas_abanico');
    return $query;
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('rutas_abanico',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Actualizo una entrada
    * $id es el identificador de la entrada
    * $parametros son los campos actualizados
 */
  function actualizar($id,$parametros){
    $this->db->where('ID_PEDIDO',$id);
    return $this->db->update('rutas_abanico',$parametros);
  }
  /*
    * Cambio el estado de la entrada, puede ser cualquier estado
    * $id es el identificador de la entrada
    * $activo es el estado al que se quiere cambiar la entrada
 */
  function estado($id,$activo){
    $this->db->where('ID_PEDIDO',$id);
    return $this->db->update('rutas_abanico',array('PAIS_ESTADO'=>$activo));
  }

}
?>
