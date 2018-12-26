<?php
class FavoritosModel extends CI_Model {
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
    $query = $this->db->get('favoritos');
    return $query->result();
  }
  /*
    * Enlisto los favorfitos de un usuario de una categoría en específico
 */
  function favoritos_usuario($id,$objeto){
    $this->db->where('ID_USUARIO',$id);
      $this->db->where('FAVORITO_TIPO',$objeto);
    $query = $this->db->get('favoritos');
    return $query->result();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($id,$id_usuario,$objeto){
    return $this->db->get_where('favoritos',array('ID_USUARIO'=>$id_usuario,'ID_OBJETO'=>$id,'FAVORITO_TIPO'=>$objeto))->row_array();
  }
  /*
    * Reviso si ya existe en favorito
 */
  function es_favorito($id_objeto,$id_usuario,$objeto){
    $this->db->where('ID_OBJETO',$id_objeto);
    $this->db->where('ID_USUARIO',$id_usuario);
    $this->db->where('FAVORITO_TIPO',$objeto);
    $query = $this->db->get('favoritos');
    return $query->row_array();
  }

  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('favoritos',$parametros);
    return $this->db->insert_id();
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('favoritos',array('ID_FAVORITO'=>$id));
  }

}
?>
