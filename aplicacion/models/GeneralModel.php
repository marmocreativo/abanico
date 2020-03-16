<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GeneralModel extends CI_Model {

  function __construct()
  {
      parent::__construct();
      // Función Construct
  }


 function lista($tabla,$parametros_or,$parametros_and,$orden,$limite,$offset){

   if(!empty($parametros_or)){
     $this->db->group_start();
     $this->db->or_like($parametros_or);
     $this->db->group_end();
   }
   if(!empty($parametros_and)){
     $this->db->group_start();
     $this->db->where($parametros_and);
     $this->db->group_end();
   }
   if(!empty($orden)){
     $this->db->order_by($orden);
   }
   if(!empty($limite)){
     $this->db->limit($limite,$offset);
   }
    $query = $this->db->get($tabla);
    return $query->result();
  }
  /*
    * Enlisto todas las entradas
 */

  /*
    * Enlisto las entradas de forma agrupada por una columna
 */
 function lista_agrupada($tabla,$parametros_or,$parametros_and,$orden,$agrupar){

   if(!empty($parametros_or)){
     $this->db->group_start();
     $this->db->or_like($parametros_or);
     $this->db->group_end();
   }
   if(!empty($parametros_and)){
     $this->db->group_start();
     $this->db->where($parametros_and);
     $this->db->group_end();
   }
   if(!empty($orden)){
     $this->db->order_by($orden);
   }
   if(!empty($agrupar)){
     $this->db->group_by($agrupar);
   }
    $query = $this->db->get($tabla);
    return $query->result();
  }
  /*
    * Funciones de Verificación
  */
  public function campo_existe($tabla,$parametros){
    $this->db->where($parametros);
    $query = $this->db->get($tabla);
    if ($query->num_rows() > 0){
        return true;
    }else{
        return false;
    }
  }
  /*
    * Obtengo todos los detalles de una sola entrada
 */
  function detalles($tabla,$parametros){
    return $this->db->get_where($tabla,$parametros)->row_array();
  }
  /*
    *Obtener solo una cierta cantidad de campos
  */
  function detalles_especificos($tabla,$select,$parametros){
    $this->db->select($select);
    return $this->db->get_where($tabla,$parametros)->row_array();
  }


  function verificar_uri($tabla,$parametros){
    $usuario = $this->db->get_where($tabla,$parametros)->row_array();
    if(!empty($usuario)){ return TRUE; }else{ return FALSE; }
  }
  /*
    * Creo una nueva entrada usando los parámetros
  */
  function crear($tabla,$parametros){
    $this->db->insert($tabla,$parametros);
    return $this->db->insert_id();
  }
  /*
    * Actualizo una entrada
    * $id es el identificador de la entrada
    * $parametros son los campos actualizados
 */
  function actualizar($tabla,$identificadores,$parametros){
    $this->db->where($identificadores);
    return $this->db->update($tabla,$parametros);
  }
  /*
    * Borro una entrada
    * $id es el identificador de la entrada
 */
  function borrar($tabla,$parametros){
    return $this->db->delete($tabla,$parametros);
  }

  /*
    * Interruptor cambia el estado de una entrada de activo a inactivo
    * $id es el identificador de la entrada
    * $activo es el estado actual de la entrada
 */
  function activar($tabla,$parametros,$estado_actual){

    switch($estado_actual){
      case "activo":
        $estado_final = "inactivo";
      break;
      case "inactivo":
        $estado_final = "activo";
      break;
      default:
        $estado_final = "activo";
      break;
    }

    $this->db->where($parametros);
    return $this->db->update($tabla,array('ESTADO'=>$estado_final));
  }


  /*
  *Conteo algo
  */

  function conteo_elementos($tabla,$parametros){
      $this->db->where($parametros);
      $query = $this->db->get($tabla);
      return $query->num_rows();
  }



}
?>
