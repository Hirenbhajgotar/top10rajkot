<?php 
class Products_model extends CI_Model
{
    public function get_products($id = '')
    {
        $query = $this->db->get_where("tr_products", $id);
        return $query->result();
    }
}

?>