<?php
class AutenticacionModel extends CI_Model {
  function __construct()
  {
      parent::__construct();
      // Función Construct
  }
  /*
    * Las siguientes funciones verifican datos del usuario de la base de datos para su autenticación
    * Primero verifico si existe un registro del correo en la base de datos, si existe regreso el HASH de la contraseña
 */
  function verificar_registro($correo){
    $usuario = $this->db->get_where('usuarios',array('USUARIO_CORREO'=>$correo))->row_array();
    if(!empty($usuario)){ return TRUE; }else{ return FALSE; }
  }
  /*
    * Para verificar la contraseña obtengo el HASH de la función anterior y la verifico usando PHP
 */
  function verificar_password($correo,$pass){
    $usuario = $this->db->get_where('usuarios',array('USUARIO_CORREO'=>$correo))->row_array();
    $hash = $usuario['USUARIO_PASSWORD'];
    if(password_verify ($pass,$hash)){
      return TRUE;
    }else{
      return FALSE;
    }
  }
  /*
    * Obtener los datos de un usuario
 */
  function detalles($correo){
    return $this->db->get_where('usuarios',array('USUARIO_CORREO'=>$correo))->row_array();
  }
  /*
    * Obtener el id del Usuario
 */
 function id_usuario($correo){
   $usuario = $this->db->get_where('usuarios',array('USUARIO_CORREO'=>$correo))->row_array();
   return $usuario['ID_USUARIO'];
 }
 /*
   * Para crear un código de seguridad
*/
 function crear_pin($id){
   // Creo un PIN de 10 caracteres aleatorios
    $clave = "";
    $caracteres = array_merge(range('A','Z'), range('a','z'), range('0','9'));
    $max = count($caracteres) - 1;
    for ($i = 0; $i < 10; $i++) {
      $rand = mt_rand(0, $max);
      $clave .= $caracteres[$rand];
    }
    // genero los parámetros
    $parametros = array(
      'ID_USUARIO' => $id,
      'CLAVE' => $clave,
      'FECHA_REGISTRO'=>date('Y-m-d H:i:s'),
      'ESTADO'=>'activo'
    );

   $this->db->insert('seguridad_usuarios',$parametros);
   return $clave;
 }
   /*
     * Para crear un código de seguridad
  */
   function verificar_pin($id,$clave){
     // reviso la base de datos a ver si hay un string que coincida el id con la clave
     $seguridad = $this->db->get_where('seguridad_usuarios',array('ID_USUARIO'=>$id,'CLAVE'=>$clave))->row_array();
     //var_dump($seguridad);
     // Si no existe un registro, inmediatamente regreso FALSE de lo contrario reviso...
     if(!empty($seguridad)){
       // ...La fecha y el estado
       $fecha = $seguridad['FECHA_REGISTRO'];
       $estado = $seguridad['ESTADO'];
       // Si el estado es activo reviso la fecha de lo contrario regreso FALSE
       if($estado =='activo'){
         if(strtotime($fecha) <= strtotime('-3 Hours')){
           //echo 'fecha';
           return FALSE;
         }else{
           // Solo si se cumplen todas las condiciones anteriores regreso TRUE
           return TRUE;
         }
       }else{
         //echo 'estado';
         return FALSE;
       }
     }else{
       //echo 'seguridad';
       return FALSE;
     }
   }
   /*
     * Método Para restaurar contraseña
  */
   function restaurar_pass($id,$parametros){
     $this->db->where('ID_USUARIO',$id);
     return $this->db->update('usuarios',$parametros);
   }
   /*
     * Método Para desactivar Pin
  */
   function desactivar_pin($id,$clave){
     $this->db->where(array('ID_USUARIO'=>$id,'CLAVE'=>$clave));
     return $this->db->update('seguridad_usuarios',array('ESTADO'=>'inactivo'));
   }
}
?>
