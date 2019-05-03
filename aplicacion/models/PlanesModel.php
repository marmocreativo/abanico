<?php
class PlanesModel extends CI_Model {
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
  function lista($parametros){
    if(!empty($parametros)){
      $this->db->where($parametros);
    }
    $query = $this->db->get('planes');
    return $query->result();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($id){
    return $this->db->get_where('planes',array('ID_PLAN'=>$id))->row_array();
  }
  function detalles_usuario($id){
    return $this->db->get_where('planes_usuarios',array('ID_PLAN_USUARIO'=>$id))->row_array();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function plan_activo_usuario($id,$tipo){
    $this->db->group_start();
    $this->db->where('PLAN_TIPO',$tipo);
    $this->db->where('ID_USUARIO',$id);
    $this->db->where('FECHA_TERMINO >=',date('Y-m-d'));
    $this->db->group_end();
    $this->db->group_start();
    $this->db->or_where('PLAN_ESTADO','pagado');
    $this->db->group_end();
    $query = $this->db->get('planes_usuarios');
    return $query->row_array();
  }
  function plan_pendiente_usuario($id,$tipo){
    $this->db->group_start();
    $this->db->where('PLAN_TIPO',$tipo);
    $this->db->where('ID_USUARIO',$id);
    $this->db->where('FECHA_TERMINO >=',date('Y-m-d'));
    $this->db->group_end();
    $this->db->group_start();
    $this->db->or_where('PLAN_ESTADO','pendiente');
    $this->db->or_where('PLAN_ESTADO','espera pago');
    $this->db->or_where('PLAN_ESTADO','pagado');
    $this->db->group_end();
    $query = $this->db->get('planes_usuarios');
    return $query->row_array();
  }
  function lista_pagos($id){
    $this->db->where('ID_PLAN_USUARIO',$id);
    $query = $this->db->get('planes_pagos');
    return $query->result();
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('planes',$parametros);
    return $this->db->insert_id();
  }
  function crear_plan_usuario($parametros){
    $this->db->insert('planes_usuarios',$parametros);
    return $this->db->insert_id();
  }
  function crear_pago_plan($parametros){
    $this->db->insert('planes_pagos',$parametros);
    return $this->db->insert_id();
  }
  function actualizar_pago_plan($id,$parametros){
    $this->db->where('ID_PAGO',$id);
    return $this->db->update('planes_pagos',$parametros);
  }
  /*
    * Actualizo una entrada
    * $id es el identificador de la entrada
    * $parametros son los campos actualizados
 */
  function actualizar($id,$parametros){
    $this->db->where('ID_PLAN',$id);
    return $this->db->update('planes',$parametros);
  }
  function actualizar_plan_usuario($id,$parametros){
    $this->db->where('ID_PLAN_USUARIO',$id);
    return $this->db->update('planes_usuarios',$parametros);
  }
  /*
    * Auto Renovar
 */
  function auto_renovar($id,$estado){

    $this->db->where('ID_PLAN_USUARIO',$id);
    return $this->db->update('planes_usuarios',array('AUTO_RENOVAR'=>$estado));
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('planes',array('ID_PLAN'=>$id));
  }


}
?>
