<?php 
class CmsPage_Model extends CI_Model
{
    // * add Cms data
    public function addCms()
    {
        $data = [
            'seller_id' => $this->input->post('seller_id'),
            'title' => $this->input->post('title'),
            'seo_keyword' => $this->input->post('seo_keyword'),
            'description' => $this->input->post('description'),
            'meta_title' => $this->input->post('meta_title'),
            'meta_keyword' => $this->input->post('meta_keyword'),
            'meta_description' => $this->input->post('meta_description'),
            'maintenance_mode' => $this->input->post('maintenance_mode'),
            'date_addedd' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s"),
            'status' => $this->input->post('status'),
        ];
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // exit;
        $query = $this->db->insert('tr_cms_page', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    // * update cms
    public function updateCms($id)
    {
        // * update buyer data
        $data = [
            'seller_id' => $this->input->post('seller_id'),
            'title' => $this->input->post('title'),
            'seo_keyword' => $this->input->post('seo_keyword'),
            'description' => $this->input->post('description'),
            'meta_title' => $this->input->post('meta_title'),
            'meta_keyword' => $this->input->post('meta_keyword'),
            'meta_description' => $this->input->post('meta_description'),
            'maintenance_mode' => $this->input->post('maintenance_mode'),
            'date_addedd' => $this->input->post('date_addedd'),
            'date_modified' => date("Y-m-d H:i:s"),
            'status' => $this->input->post('status'),
        ];

        $query = $this->db->where('id', $id)
            ->update('tr_cms_page', $data);
        return  $id;
        
    }

    // * get seller data
    public function getSellers($id = '')
    {
        if ($id) {
            $query = $this->db->get_where('tr_seller', ['id' => $id]);
            return $query->row();
        }
        $query = $this->db->get('tr_seller');
        return $query->result();
    }

    // *get Cms data
    public function getCms($id = '')
    {
        if ($id) {
            $query = $this->db->get_where('tr_cms_page', ['id' => $id]);
            return $query->row_array();
        } else {
           
            $query = $this->db->query("SELECT c.id, c.title, c.status, CONCAT(s.firstname, ' ' , s.lastname) as seller_name FROM `tr_cms_page` c LEFT JOIN `tr_seller` s ON (c.seller_id = s.id) ORDER BY c.id DESC LIMIT 5");
            return $query->result_array();
        }
    }

    // * save_delete_history
    public function save_delete_history($ids, $ip)
    {
        $userid = $this->session->userdata();
        $userid = $userid['user_id'];

        foreach ($ids as $id) {
            // $name = $this->Usergroup_Model->get_name($id);
            $row = $this->CmsPage_Model->getCms($id);
            $name[] = $row['title'];
        }
        $data = array(
            'user_id' => $userid,
            'track_id' => '',
            'comment' => 'deleted cms: <b>' . implode(" , ", $name) . '</b>',
            'ip' => $ip,
            'date_added' => date("Y-m-d H:i:s"),
            'is_view' => '1'
        );
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // exit;
        $this->db->insert('tr_user_history', $data);
        return true;
    }

    // * delete cms
    public function deleteCms($id)
    {
        $this->db->where_in('id', $id);
        $this->db->delete('tr_cms_page');
        return true;
    }

    // * get ajaxPagination page
    public function getCmsPage($cmsName = FALSE, $params = array())
    {
        if ($cmsName === FALSE) {
            // $this->db->select('c.*,s.*');
            $this->db->select("c.*,CONCAT(s.firstname, ' ', s.lastname) AS seller_name ");
            $this->db->from('tr_cms_page c');
            $this->db->join('tr_seller s', 'c.seller_id = s.id', 'left' );

            if (array_key_exists("where", $params)) {
                foreach ($params['where'] as $key => $val) {
                    $this->db->where($key, $val);
                }
            }

            if (array_key_exists("search", $params)) {
                // Filter data by searched keywords 
                if (!empty($params['search']['keywords'])) {
                    $this->db->like('c.title', $params['search']['keywords']);
                }
            }

            // Sort data by ascending or desceding order 
            if (!empty($params['search']['sortBy'])) {
                // $this->db->order_by('title', $params['search']['sortBy']);
                $this->db->order_by('c.id', 'desc');
            } else {
                $this->db->order_by('c.id', 'desc');
            }

            if (array_key_exists("returnType", $params) && $params['returnType'] == 'count') {
                $result = $this->db->count_all_results();
            } else {

                if (array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')) {
                    if (!empty($params['id'])) {

                        $this->db->where('c.id', $params['id']);
                    }
                    $query = $this->db->get();
                    $result = $query->row_array();
                } else {

                    $this->db->order_by('c.id', 'desc');
                    if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                        $this->db->limit($params['limit'], $params['start']);
                    } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                        $this->db->limit($params['limit']);
                    }

                    $query = $this->db->get();
                    $result = ($query->num_rows() > 0) ? $query->result_array() : FALSE;
                }
            }
            return $result;
        }

        // $query = $this->db->get_where('tr_cms_page', array('username' => $cmsName));
        $query = $this->db->get_where('tr_cms_page', array('username' => $cmsName));
        return $query->row_array();
    }




}

?>