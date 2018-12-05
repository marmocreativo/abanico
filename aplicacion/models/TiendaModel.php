<?php
class TiendaModel extends CI_Model{

    public function get_productos(){
        $query = $this->db->get("productos");
        return $query->result();
    }

    public function datos_producto($id){
        $query = $this->db->where("ID_PRODUCTO",$id);
        $query = $this->db->get("productos",1);
        return $query->result();
    }
}
?>
