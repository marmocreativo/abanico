<?php
class DireccionesModel extends CI_Model {
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
    $this->db->where('DIRECCION_TIPO !=', 'borrada');
    $query = $this->db->get('direcciones');
    return $query->result();
  }
  /*
    * Lista Básica de las direcciones excepto dirección Fiscal
 */
  function lista_direcciones($id_usuario){
    $this->db->where('ID_USUARIO', $id_usuario);
    $this->db->where('DIRECCION_TIPO !=', 'fiscal');
    $this->db->where('DIRECCION_TIPO !=', 'perfil');
    $this->db->where('DIRECCION_TIPO !=', 'borrada');
    $query = $this->db->get('direcciones');
    return $query->result();
  }
  /*
  * Una sola dirección la primera de la lista
  */
  function direccion_rapida($id_usuario){
    $this->db->where('ID_USUARIO', $id_usuario);
    $this->db->where('DIRECCION_TIPO !=', 'fiscal');
    $this->db->where('DIRECCION_TIPO !=', 'perfil');
    $query = $this->db->get('direcciones');
    return $query->row_array();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($id){
    return $this->db->get_where('direcciones',array('ID_DIRECCION'=>$id))->row_array();
  }
  /*
    * Obtengo la dirección enlazada a una tienda
 */
  function direccion_de_tienda($id){
    return $this->db->get_where('direcciones',array('ID_TIENDA'=>$id))->row_array();
  }
  /*
    * Obtengo tObtengo la dirección etiquetada como FISCAL
 */
  function direccion_fiscal($id){
    return $this->db->get_where('direcciones',array('ID_USUARIO'=>$id,'DIRECCION_TIPO'=>'fiscal'))->row_array();
  }
  /*
    * Obtengo tObtengo la dirección etiquetada como FISCAL
 */
  function direccion_perfil($id){
    return $this->db->get_where('direcciones',array('ID_USUARIO'=>$id,'DIRECCION_TIPO'=>'perfil'))->row_array();
  }
  /*
    * Dirección en una sola línea
 */
  function direccion_formateada($id){
   $dir = $this->db->get_where('direcciones',array('ID_DIRECCION'=>$id))->row_array();
   if(!empty($dir)){
     return $dir['DIRECCION_CALLE_Y_NUMERO'].', '.$dir['DIRECCION_BARRIO'].', '.$dir['DIRECCION_MUNICIPIO'].', '.$dir['DIRECCION_CIUDAD'].', '.$dir['DIRECCION_ESTADO'].', '.$dir['DIRECCION_CODIGO_POSTAL'].', '.$dir['DIRECCION_PAIS'];
   }else{
     return 'No hay dirección registrada';
   }
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('direcciones',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Actualizo una entrada
    * $id es el identificador de la entrada
    * $parametros son los campos actualizados
 */
  function actualizar($id,$parametros){
    $this->db->where('ID_DIRECCION',$id);
    return $this->db->update('direcciones',$parametros);
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('direcciones',array('ID_DIRECCION'=>$id));
  }

}
?>
