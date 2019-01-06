<?php
class NotificacionesModel extends CI_Model {
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
  function lista($id_usuario,$limite){
    if(!empty($id_usuario)){
      $this->db->where('ID_USUARIO',$id_usuario);
    }
    $this->db->order_by('NOTIFICACION_FECHA_REGISTRO','DESC');
    if(!empty($limite)){
      $this->db->limit($limite);
    }
    $query = $this->db->get('notificaciones');
    return $query->result();
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('notificaciones',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function marcar_leido($id){
    $this->db->where('ID_NOTIFICACION',$id);
    $this->db->update('notificaciones',array('NOTIFICACION_ESTADO','leido'));
    return $this->db->insert_id();
  }
  function marcar_no_leido($id){
    $this->db->where('ID_NOTIFICACION',$id);
    $this->db->update('notificaciones',array('NOTIFICACION_ESTADO','no leido'));
    return $this->db->insert_id();
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('notificaciones',array('ID_NOTIFICACION'=>$id));
  }

  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar_fecha($fecha){
    return $this->db->delete('notificaciones',array('NOTIFICACION_FECHA_REGISTRO <'=>$fecha));
  }

}
?>
