<?php
class UsuariosModel extends CI_Model {
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
  function lista($parametros,$tipo_usuario,$orden,$limite){
    if(!empty($parametros)){
      $this->db->or_like($parametros);
    }
    if(!empty($tipo_usuario)){
      $this->db->where('USUARIO_TIPO', $tipo_usuario);
    }
    if(!empty($orden)){
      $this->db->order_by($orden);
    }
    if(!empty($limite)){
      $this->db->limit($limite);
    }
    $query = $this->db->get('usuarios');
    return $query->result();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($id){
    return $this->db->get_where('usuarios',array('ID_USUARIO'=>$id))->row_array();
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('usuarios',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Actualizo una entrada
    * $id es el identificador de la entrada
    * $parametros son los campos actualizados
 */
  function actualizar($id,$parametros){
    $this->db->where('ID_USUARIO',$id);
    return $this->db->update('usuarios',$parametros);
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('usuarios',array('ID_USUARIO'=>$id));
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
    $this->db->where('ID_USUARIO',$id);
    return $this->db->update('usuarios',array('USUARIO_ESTADO'=>$activo));
  }
  /*
    * Cambio el estado de la entrada, puede ser cualquier estado
    * $id es el identificador de la entrada
    * $activo es el estado al que se quiere cambiar la entrada
 */
  function estado($id,$estado){
    $this->db->where('ID_USUARIO',$id);
    return $this->db->update('usuarios',array('USUARIO_ESTADO'=>$estado));
  }
  /*
    * Cambio el tipo de Usuario
    * $id es el identificador de la entrada
    * $activo es el estado al que se quiere cambiar la entrada
 */
  function permiso($id,$permiso){
    $this->db->where('ID_USUARIO',$id);
    return $this->db->update('usuarios',array('USUARIO_TIPO'=>$permiso));
  }
  /*
    * Conteo por tipo Usuario
 */
  function conteo_por_tipo($tipo){
    $this->db->where('USUARIO_TIPO',$tipo);
    $this->db->where('USUARIO_ESTADO','activo');
    $query = $this->db->get('usuarios');
    return $query->num_rows();
  }

  /*
    * Funciones de Verificación
  */
  public function id_usuario_existe($id){
    $this->db->where('ID_USUARIO',$id);
    $query = $this->db->get('usuarios');
    if ($query->num_rows() > 0){
        return true;
    }else{
        return false;
    }
  }

}
?>
