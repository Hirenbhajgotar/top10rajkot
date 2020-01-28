<?php 
class Site_banner_model extends CI_Model
{
    // * create banner
    public function create_banner($image)
    {
        $data = [
            'name' => $this->input->post('name'),
            'position' => $this->input->post('position'),
            'link' => $this->input->post('link'),
            'image' => $image,
            'status' => $this->input->post('status'),
            'short_order' => $this->input->post('short_order'),
            'date_added' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s"),
        ];
        $query = $this->db->insert("tr_banner", $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

    // * get banner
    public function get_banner($id = '', $limit = '')
    {
        if ($id) {
            $query = $this->db->get_where("tr_banner", $id);
            return $query->row();
        } else {
            $query = $this->db->order_by('id', 'desc')
            ->limit($limit)
            ->get("tr_banner");
            return $query->result();
        }
    }

    // * update banner
    public function update_banner($id, $image = '')
    {
        if ($image) {
            $data = [
                'name' => $this->input->post('name'),
                'position' => $this->input->post('position'),
                'link' => $this->input->post('link'),
                'image' => $image,
                'status' => $this->input->post('status'),
                'short_order' => $this->input->post('short_order'),
                'date_added' => date("Y-m-d H:i:s"),
                'date_modified' => date("Y-m-d H:i:s"),
            ];
            $query = $this->db->where('id', $id)
                ->update('tr_banner', $data);
            return  $id;
        } else {
            $query = $this->db->set($this->input->post())
                ->where('id', $id)
                ->update("tr_banner");
            return  $id;
        }
    }

    // * save delete history
    public function save_delete_history($ids, $ip)
    {
        
        $userid = $this->session->userdata();
        $userid = $userid['user_id'];

        foreach ($ids as $id) {
            $id = ['id' => $id];
            $row = $this->Site_banner_model->get_banner($id);
            $name[] = $row->name;
        }
        // echo '<pre>';
        // print_r($name);
        // echo '</pre>';
        // exit;
        $data = array(
            'user_id' => $userid,
            'track_id' => '',
            'comment' => 'deleted banner: <b>' . implode(" , ", $name) . '</b>',
            'ip' => $ip,
            'date_added' => date("Y-m-d H:i:s"),
            'is_view' => '1'
        );

        $this->db->insert('tr_user_history', $data);
        return true;
    }

    // * delete banner
    public function delete_banner($ids = '')
    {
        foreach ($ids as $id) {
            $get_data = ['id' => $id];
            $data['banner'] = $this->Site_banner_model->get_banner($get_data);
            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';
            // exit;

            if (file_exists('../assets/images/site_banner/' . $data['banner']->image)) {
                unlink('../assets/images/site_banner/' . $data['banner']->image);
            }

            $this->db->where_in('id', $id);
            $this->db->delete('tr_banner');
        }

        return true;
    }

    // * get total records
    public function getBannerPage($productName = FALSE, $params = array())
    {
        if ($productName === FALSE) {

            $this->db->select('*');
            $this->db->from('tr_banner');

            if (array_key_exists("where", $params)) {
                foreach ($params['where'] as $key => $val) {
                    $this->db->where($key, $val);
                }
            }

            if (array_key_exists("search", $params)) {
                // Filter data by searched keywords 
                if (!empty($params['search']['keywords'])) {
                    $this->db->like('name', $params['search']['keywords']);
                }
            }

            // Sort data by ascending or desceding order 
            if (!empty($params['search']['sortBy'])) {
                // $this->db->order_by('product_name', $params['search']['sortBy']);
                $this->db->order_by('id', 'desc');
            } else {
                $this->db->order_by('id', 'desc');
            }

            if (array_key_exists("returnType", $params) && $params['returnType'] == 'count') {
                $result = $this->db->count_all_results();
            } else {

                if (array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')) {
                    if (!empty($params['id'])) {

                        $this->db->where('id', $params['id']);
                    }
                    $query = $this->db->get();
                    $result = $query->row_array();
                } else {

                    $this->db->order_by('id', 'desc');
                    if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                        $this->db->limit($params['limit'], $params['start']);
                    } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                        $this->db->limit($params['limit']);
                    }

                    $query = $this->db->get();
                    $result = ($query->num_rows() > 0) ? $query->result_array() : FALSE;
                }
            }

            // Return fetched data 
            return $result;
        }

        // $query = $this->db->get_where('tr_user', array('username' => $username));
        // $query = $this->db->get_where('tr_products', array('username' => $productName));
        // return $query->row_array();
    }


}

?>