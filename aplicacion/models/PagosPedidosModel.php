<?php
class PagosPedidosModel extends CI_Model {
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
  function lista($id_pedido){
    $this->db->where('ID_PEDIDO',$id_pedido);
    $query = $this->db->get('pedidos_pagos');
    return $query->result();
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($id){
    return $this->db->get_where('pedidos_pagos',array('ID'=>$id))->row_array();
  }
  function detalles_folio($folio){
    return $this->db->get_where('pedidos_pagos',array('PAGO_FOLIO'=>$folio))->row_array();
  }
  /*
    * Creo una nueva entrada usando los parámetros
 */
  function crear($parametros){
    $this->db->insert('pedidos_pagos',$parametros);
    return $this->db->insert_id();
  }
  function actualizar_oxxo($id,$parametros){
    $this->db->where('PAGO_FOLIO',$id);
    return $this->db->update('pedidos_pagos',$parametros);
  }
  function actualizar($id,$parametros){
    $this->db->where('ID_PEDIDO',$id);
    return $this->db->update('pedidos_pagos',$parametros);
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($id){
    return $this->db->delete('pedidos_pagos',array('ID_SLIDER'=>$id));
  }

}
?>
