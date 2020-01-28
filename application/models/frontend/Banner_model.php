<?php 
class Banner_model extends CI_Model
{
    public function get_banner($val)
    {
        $query = $this->db->select()
                          ->from("tr_banner")
                          ->where($val)
                          ->order_by('short_order')
                          ->get();
        return $query->result();
        
    }
}

?>