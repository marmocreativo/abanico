<?php
class serviciosModel extends CI_Model {
  function __construct()
  {
      parent::__construct();
      // Función Construct
  }
  /*
    * Enlisto todas las entradas
    * $parametros Debe ser un array de Columnas y Valores, Busco usando la función LIKE
    * $orden indicará la Columna y si es ascendente o descendente
    * $limite Solo se usará si hay una cantidad limite de servicios a mostrar
 */
  function lista($parametros,$id_usuario,$orden,$limite){
    if(!empty($parametros)){
      $this->db->or_like($parametros);
    }
    if(!empty($id_usuario)){
      $this->db->where('ID_USUARIO', $id_usuario);
    }
    if(!empty($orden)){
      $this->db->order_by($orden);
    }
    if(!empty($limite)){
      $this->db->limit($limite);
    }
    $query = $this->db->get('servicios');
    return $query->result();
  }
  /*
    * Enlisto todas las entradas
    * $parametros Debe ser un array de Columnas y Valores, Busco usando la función LIKE
    * $orden indicará la Columna y si es ascendente o descendente
    * $limite Solo se usará si hay una cantidad limite de productos a mostrar
 */
  function busqueda($parametros_or,$parametros_and,$orden,$limite){
    if(!empty($parametros_or)){
      $this->db->or_like($parametros_or);
    }
    if(!empty($parametros_and)){
      $this->db->where($parametros_and);
    }
    if(!empty($orden)){
      $this->db->order_by($orden);
    }
    if(!empty($limite)){
      $this->db->limit($limite);
    }
    $query = $this->db->get('servicios');
    return $query->result();
  }
  /*
    * Enlisto todas las entradas
    * $parametros Debe ser un array de Columnas y Valores, Busco usando la función LIKE
    * $orden indicará la Columna y si es ascendente o descendente
    * $limite Solo se usará si hay una cantidad limite de servicios a mostrar
 */
  function lista_activos($parametros,$id_usuario,$orden,$limite){
    if(!empty($parametros)){
      $this->db->or_like($parametros);
    }
    if(!empty($id_usuario)){
      $this->db->where('ID_USUARIO', $id_usuario);
    }
    $this->db->order_by('ID_SERVICIO','RANDOM');
    if(!empty($limite)){
      $this->db->limit($limite);
    }
    $this->db->where('SERVICIO_ESTADO', 'activo');
    $query = $this->db->get('servicios');
    return $query->result();
  }
  /*
    * Enlisto todas las entradas
    * $parametros Debe ser un array de Columnas y Valores, Busco usando la función LIKE
    * $orden indicará la Columna y si es ascendente o descendente
    * $limite Solo se usará si hay una cantidad limite de servicios a mostrar
 */
  function lista_categoria_activos($parametros,$id_CATEGORIA,$orden,$limite){
    // Join
    $this->db->join('categorias_servicios', 'servicios.ID_SERVICIO = categorias_servicios.ID_SERVICIO');
    // Parametros
    if(!empty($parametros)){
      $this->db->or_like($parametros);
    }
    if(!empty($id_CATEGORIA)){
      $this->db->where('ID_CATEGORIA', $id_CATEGORIA);
    }
      $this->db->order_by('ID_SERVICIO','RANDOM');
    if(!empty($limite)){
      $this->db->limit($limite);
    }
    $this->db->where('SERVICIO_ESTADO', 'activo');
    $query = $this->db->get('servicios');
    return $query->result();
  }
  /*
    * Conteo de servicios
 */
  function conteo_servicios_usuario($id_usuario){

    $this->db->where('ID_USUARIO',$id_usuario);
    $query = $this->db->count_all_results('servicios');
    return $query;
  }

  /*
    * Enlisto todas las entradas
    * $parametros Debe ser un array de Columnas y Valores, Busco usando la función LIKE
    * $orden indicará la Columna y si es ascendente o descendente
    * $limite Solo se usará si hay una cantidad limite de productos a mostrar
 */
  function lista_favoritos_activos($favoritos){

    $this->db->where_in('ID_SERVICIO',$favoritos);
    $this->db->order_by('SERVICIO_FECHA_PUBLICACION','DESC');
    $this->db->where('SERVICIO_ESTADO', 'activo');
    $query = $this->db->get('servicios');
    return $query->result();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($id){
    return $this->db->get_where('servicios',array('ID_SERVICIO'=>$id))->row_array();
  }
  function detalles_tienda_usuario($id){
    return $this->db->get_where('servicios',array('ID_USUARIO'=>$id))->row_array();
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('servicios',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Actualizo una entrada
    * $id es el identificador de la entrada
    * $parametros son los campos actualizados
 */
  function actualizar($id,$parametros){
    $this->db->where('ID_SERVICIO',$id);
    return $this->db->update('servicios',$parametros);
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('servicios',array('ID_SERVICIO'=>$id));
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar_servicios_usuario($id){
    return $this->db->delete('servicios',array('ID_USUARIO'=>$id));
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
    $this->db->where('ID_SERVICIO',$id);
    return $this->db->update('servicios',array('SERVICIO_ESTADO'=>$activo));
  }
  /*
    * Desactivar servicios de un Usuario
 */
  function descativar_servicios_usuario($id){
    $this->db->where('ID_USUARIO',$id);
    return $this->db->update('servicios',array('SERVICIO_ESTADO'=>'inactivo'));
  }
  /*
    * Cambio el estado de la entrada, puede ser cualquier estado
    * $id es el identificador de la entrada
    * $activo es el estado al que se quiere cambiar la entrada
 */
  function estado($id,$activo){
    $this->db->where('SERVICIO_ESTADO',$id);
    return $this->db->update('servicios',array('SERVICIO_ESTADO'=>$activo));
  }
  /*
    * Creo el orden de los elementos
    * $orden son los identificadores de las entradas en el orden en que quiero que aparezcan
 */
  function ordenar($orden){
  }

  /*
    * Funciones de Verificación
  */
  public function id_usuario_existe($id){
    $this->db->where('ID_USUARIO',$id);
    $query = $this->db->get('servicios');
    if ($query->num_rows() > 0){
        return true;
    }else{
        return false;
    }
  }

}
?>
