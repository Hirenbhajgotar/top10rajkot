<?php 
class ScoUrl_Model extends CI_Model
{
    // * save sco
    public function saveSco($query, $keyword)
    {
        $data = [
            'query' => $query,
            'keyword' => $keyword
        ];
        $this->db->insert('tr_sco_url', $data);
        return true;
    }
    
    // * get sco
    public function getSco($query)
    {
        $row = $this->db->get_where('tr_sco_url', ['query' => $query]);
        return $row->row();
    }

    // * update sco
    public function updateSco($id, $query, $keyword)
    {
        $data = [
            'query' => $query,
            'keyword' => $keyword
        ];
        $res = $this->db->where('id', $id)
                        ->update('tr_sco_url', $data);
        return true;
    }

    // * delete sco 
    public function deleteSco($ids, $comment)
    {
        foreach ($ids as $id) {
            $res = $comment.$id;
            $this->db->where_in('query', $res);
            $this->db->delete('tr_sco_url');
        }
        return true;
    }
}

?>