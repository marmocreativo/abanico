<?php
class PuntosRegistroModel extends CI_Model {
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
    $query = $this->db->get('puntos_registro');
    return $query->result();
  }
  /*
    * Lista Básica de las puntos_registro excepto dirección Fiscal
 */
  function lista_puntos_registro($id_usuario){
    $this->db->where('ID_USUARIO', $id_usuario);
    $this->db->where('PUNTO_TIPO !=', 'fiscal');
    $this->db->where('PUNTO_TIPO !=', 'perfil');
    $query = $this->db->get('puntos_registro');
    return $query->result();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($id){
    return $this->db->get_where('puntos_registro',array('ID_PUNTO'=>$id))->row_array();
  }
  /*
    * Dirección en una sola línea
 */
  function direccion_formateada($id){
   $dir = $this->db->get_where('puntos_registro',array('ID_PUNTO'=>$id))->row_array();
   if(!empty($dir)){
     return $dir['PUNTO_CALLE_Y_NUMERO'].', '.$dir['PUNTO_BARRIO'].', '.$dir['PUNTO_MUNICIPIO'].', '.$dir['PUNTO_CIUDAD'].', '.$dir['PUNTO_ESTADO'].', '.$dir['PUNTO_CODIGO_POSTAL'].', '.$dir['PUNTO_PAIS'];
   }else{
     return 'No hay dirección registrada';
   }
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('puntos_registro',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Actualizo una entrada
    * $id es el identificador de la entrada
    * $parametros son los campos actualizados
 */
  function actualizar($id,$parametros){
    $this->db->where('ID_PUNTO',$id);
    return $this->db->update('puntos_registro',$parametros);
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('puntos_registro',array('ID_PUNTO'=>$id));
  }

}
?>
