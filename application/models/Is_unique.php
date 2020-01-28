<?php 
class Is_unique extends CI_Model
{
    public function check($column_name = '', $table = '', $name = '', $id = '')
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where_not_in('id', $id);
        $this->db->where($column_name, $name); //# 'column_name' = column name | 'name' = input value
        $query = $this->db->get();
        // echo '<pre>';
        // print_r($query->row());
        // echo '</pre>';
        // exit;
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
}

?>