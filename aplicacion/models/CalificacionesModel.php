<?php
class CalificacionesModel extends CI_Model {
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
    $query = $this->db->get('calificaciones_productos');
    return $query->result();
  }
  /*
    * Enlisto los calificaciones_productos de un usuario de una categoría en específico
 */
  function calificaciones_producto($id,$id_calificacion){
    $this->db->where('ID_PRODUCTO',$id);
    if(!empty($id_calificacion)){
      $this->db->where('ID_CALIFICACION !=',$id_calificacion);
    }
    $this->db->order_by('CALIFICACION_FECHA_REGISTRO','DESC');
    $this->db->join('usuarios', 'calificaciones_productos.ID_USUARIO_CALIFICADOR = usuarios.ID_USUARIO');
    $query = $this->db->get('calificaciones_productos');
    return $query->result();
  }
  /*
    * Enlisto los calificaciones_productos de un usuario de una categoría en específico
 */
  function calificaciones_usuario($id){
    $this->db->where('ID_CALIFICADOR',$id);
    $this->db->order_by('CALIFICACION_FECHA_REGISTRO','DESC');
    $this->db->join('usuarios', 'calificaciones_productos.ID_USUARIO_CALIFICADOR = usuarios.ID_USUARIO');
    $query = $this->db->get('calificaciones_productos');
    return $query->result();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function ya_calificado($id,$id_usuario){
    $this->db->join('usuarios', 'calificaciones_productos.ID_USUARIO_CALIFICADOR = usuarios.ID_USUARIO');
    return $this->db->get_where('calificaciones_productos',array('ID_PRODUCTO'=>$id,'ID_USUARIO_CALIFICADOR'=>$id_usuario))->row_array();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($id,$id_usuario,$objeto){
    return $this->db->get_where('calificaciones_productos',array('ID_USUARIO'=>$id_usuario,'ID_OBJETO'=>$id,'CALIFICACION_TIPO'=>$objeto))->row_array();
  }

  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('calificaciones_productos',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Cambio el estado de la entrada, puede ser cualquier estado
    * $id es el identificador de la entrada
    * $activo es el estado al que se quiere cambiar la entrada
 */
  function estado($id,$estado){
    $this->db->where('ID_CALIFICACION',$id);
    return $this->db->update('calificaciones_productos',array('CALIFICACION_ESTADO'=>$estado));
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('calificaciones_productos',array('ID_CALIFICACION'=>$id));
  }

}
?>
