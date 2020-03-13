<?php
class ProductosRangosMayoreoModel extends CI_Model {
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
  function lista($id_producto,$orden,$limite){
    if(!empty($id_producto)){
      $this->db->where('ID_PRODUCTO',$id_producto);
    }
    if(!empty($orden)){
      $this->db->order_by($orden);
    }
    if(!empty($limite)){
      $this->db->limit($limite);
    }
    $query = $this->db->get('productos_rangos_mayoreo');
    return $query->result();
  }

  function lista_unidades($id_producto){
    if(!empty($id_producto)){
      $this->db->where('ID_PRODUCTO',$id_producto);
    }
    //$query = $this->db->group_by('RANGO_UNIDAD');
    $query = $this->db->get('productos_rangos_mayoreo');
    return $query->result();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($id){
    return $this->db->get_where('productos_rangos_mayoreo',array('ID_RANGO'=>$id))->row_array();
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('productos_rangos_mayoreo',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Actualizo una entrada
    * $id es el identificador de la entrada
    * $parametros son los campos actualizados
 */
  function actualizar($id,$parametros){
    $this->db->where('ID_COMBINACION',$id);
    return $this->db->update('productos_rangos_mayoreo',$parametros);
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('productos_rangos_mayoreo',array('ID_RANGO'=>$id));
  }

}
?>
