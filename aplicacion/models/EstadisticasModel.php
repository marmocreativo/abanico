<?php
class EstadisticasModel extends CI_Model {
  function __construct()
  {
      parent::__construct();
      // Función Construct
  }

  /*
    * Creo una nueva entrada usando los parámetros
 */
  function objeto_visto($objeto,$id_objeto){
    $ip = $this->input->ip_address();
      $parametros = array(
        'VISTA_IP'=>$ip,
        'VISTA_CANTIDAD'=>1,
        'ID_OBJETO'=>$id_objeto,
        'VISTA_TIPO'=>$objeto,
        'VISTA_FECHA'=>date('Y-m-d H:i:s')
      );
    $this->db->insert('vistas_generales',$parametros);
    //return $this->db->insert_id();
  }
  /*
    * Productos más vistos
 */
  function mas_vistos($objeto,$limite){
    $data = $this->db->select('*')
     ->select('SUM(VISTA_CANTIDAD) as cantidad_total')
     ->from('vistas_generales')
     ->order_by('cantidad_total','desc')
     ->where('VISTA_TIPO',$objeto)
     ->limit($limite)
     ->group_by(['VISTA_IP','ID_OBJETO'])
     ->get()->result_array();
   return $data;
  }
  /*
    * Productos más vendidos
 */
  function mas_vendidos($limite){
    $data = $this->db->select('*')
     ->select('SUM(CANTIDAD) as cantidad_total')
     ->from('pedidos_productos')
     ->order_by('cantidad_total','desc')
     ->limit($limite)
     ->group_by('ID_PRODUCTO')
     ->get()->result_array();
   return $data;
  }
  /*
    * Productos más vendidos
 */
  function mas_contactos($limite){
    $data = $this->db->select('*')
     ->select('count(ID_CONVERSACION) as cantidad_total')
     ->from('conversaciones')
     ->order_by('cantidad_total','desc')
     ->where('CONVERSACION_TIPO','mensaje servicio')
     ->limit($limite)
     ->group_by('ID_OBJETO')
     ->get()->result_array();
   return $data;
  }
  /*
  *Conteo productos en categoria
  */
  function categorias_mas_productos($limite){
    $data = $this->db->select('*')
     ->select('count(categorias_productos.ID_PRODUCTO) as cantidad_total')
     ->from('categorias_productos')
     ->join('categorias','categorias.ID_CATEGORIA = categorias_productos.ID_CATEGORIA')
     ->order_by('cantidad_total','desc')
     ->where('CATEGORIA_TIPO','productos')
     ->limit($limite)
     ->group_by('categorias_productos.ID_CATEGORIA')
     ->get()->result_array();
   return $data;
  }
  /*
  *Conteo veces vistas
  */
  function conteo_vistas_ip($ip,$id){
      $this->db->where(['VISTA_IP'=>$ip,'VISTA_TIPO'=>'producto','ID_OBJETO'=>$id]);
      $query = $this->db->get('vistas_generales');
      return $query->num_rows();
  }

  /*
  *Conteo todos
  */
  function conteo_pedidos(){
      $query = $this->db->get('pedidos');
      return $query->num_rows();
  }
  /*
  *Conteo cancelaciones
  */
  function conteo_pedidos_cancelados(){
      $this->db->where('PEDIDO_ESTADO_PEDIDO','cancelado');
      $query = $this->db->get('pedidos');
      return $query->num_rows();
  }
  /*
  *Conteo cancelaciones
  */
  function conteo_pedidos_pagados(){
      $this->db->where('PEDIDO_ESTADO_PEDIDO','pagado');
      $query = $this->db->get('pedidos');
      return $query->num_rows();
  }
  /*
  *Conteo cancelaciones
  */
  function conteo_pedidos_entregados(){
      $this->db->where('PEDIDO_ESTADO_PEDIDO','entregado');
      $query = $this->db->get('pedidos');
      return $query->num_rows();
  }
  /*
  *Conteo cancelaciones
  */
  function conteo_pedidos_pendientes(){
      $this->db->where('PEDIDO_ESTADO_PEDIDO','pendiente');
      $query = $this->db->get('pedidos');
      return $query->num_rows();
  }
  /*
  *Conteo por dia
  */
  function conteo_pedidos_dia($fecha){
      $this->db->where('PEDIDO_FECHA_REGISTRO >=', date('Y-m-d H:i:s', strtotime("-1 day", strtotime($fecha) ) ) );
      $this->db->where('PEDIDO_FECHA_REGISTRO <=', date('Y-m-d H:i:s', strtotime("+1 day", strtotime($fecha) ) ) );
      $query = $this->db->get('pedidos');
      return $query->num_rows();
  }


}
?>
