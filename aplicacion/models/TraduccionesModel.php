<?php
class TraduccionesModel extends CI_Model {
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
  function lista($id_objeto,$tipo_objeto,$lenguaje){

    $this->db->where('ID_OBJETO', $id_objeto);
    $this->db->where('TIPO_OBJETO', $tipo_objeto);
    $this->db->where('LENGUAJE', $lenguaje);
    $query = $this->db->get('traducciones');
    return $query->row_array();
  }

  function detalles($id){
    return $this->db->get_where('traducciones',array('ID_TRADUCCION'=>$id))->row_array();
  }


  function crear($parametros){
    $this->db->insert('traducciones',$parametros);
    return $this->db->insert_id();
  }

  function actualizar($id,$parametros){
    $this->db->where('ID_PRODUCTO',$id);
    return $this->db->update('traducciones',$parametros);
  }


}
?>
