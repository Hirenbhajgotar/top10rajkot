<?php 
class Product_model extends CI_Model
{
    // * create product
    public function create_product($image = '')
    {
        $data = [
            'seller_id' => $this->input->post('seller_id'),
            'category_id' => $this->input->post('category_id'),
            'product_name' => $this->input->post('product_name'),
            'product_model' => $this->input->post('product_model'),
            'seo_keyword' => $this->input->post('seo_keyword'),
            'sort_order' => $this->input->post('sort_order'),
            'product_image' => $image,
            'product_description' => $this->input->post('product_description'),
            'meta_title' => $this->input->post('meta_title'),
            'meta_description' => $this->input->post('meta_description'),
            'meta_keyword' => $this->input->post('meta_keyword'),
            'date_added' => date("Y-m-d H:i:s"),
            'date_modifide' => date("Y-m-d H:i:s"),
            'status' => $this->input->post('status'),
            // 'user_id' => $this->session->userdata('user_id')
        ];

        $this->db->insert('tr_products', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

    // * get product row
    public function get_product($id = '')
    {
        $query = $this->db->get_where('tr_products', array('id' => $id));
        return $query->row_array();
    }

    // * get products
    public function get_products()
    {
        $query = $this->db->order_by('id', 'desc')
                              ->limit(5)
                              ->get('tr_products');
        return $query->result_array();
    }

    // * get sellers
    public function get_sellers()
    {
        $query = $this->db->get('tr_seller');
        return $query->result();
    }

    // * update product
    public function update_product($id, $image)
    {
        $data = [
            'seller_id' => $this->input->post('seller_id'),
            'category_id' => $this->input->post('category_id'),
            'product_name' => $this->input->post('product_name'),
            'product_model' => $this->input->post('product_model'),
            'seo_keyword' => $this->input->post('seo_keyword'),
            'sort_order' => $this->input->post('sort_order'),
            'product_image' => $image,
            'product_description' => $this->input->post('product_description'),
            'meta_title' => $this->input->post('meta_title'),
            'meta_description' => $this->input->post('meta_description'),
            'meta_keyword' => $this->input->post('meta_keyword'),
            // 'date_added' => date("Y-m-d H:i:s"),
            'date_added' => $this->input->post('date_added'),
            'date_modifide' => date("Y-m-d H:i:s"),
            'status' => $this->input->post('status'),
        ];
        
        $query = $this->db->where('id', $id)
            ->update('tr_products', $data);
        return  $id;
    }

    // * save delete history
    public function save_delete_history($ids, $ip)
    {
        $userid = $this->session->userdata();
        $userid = $userid['user_id'];

        foreach ($ids as $id) { 
            // $name = $this->Usergroup_Model->get_name($id);
            $row = $this->Product_Model->get_product($id);
            $name[] = $row['product_name'];
        }
        $data = array(
            'user_id' => $userid,
            'track_id' => '',
            'comment' => 'deleted category: <b>' . implode(" , ", $name) . '</b>',
            'ip' => $ip,
            'date_added' => date("Y-m-d H:i:s"),
            'is_view' => '1'
        );

        $this->db->insert('tr_user_history', $data);
        return true;
    }
    
    // * delete product
    public function delete_product($id)
    {
        foreach ($id as $ids) {
            $data['product'] = $this->Product_Model->get_product($ids);

            if (file_exists('../assets/images/category/' . $data['product']['category_image'])) {
                unlink('../assets/images/category/' . $data['product']['category_image']);
            }

            $this->db->where_in('id', $ids);
            $this->db->delete('tr_products');
            
        }
        return true;
    }

    public function getProducPage($productName = FALSE, $params = array())
    {
        if ($productName === FALSE) {

            $this->db->select('*');
            $this->db->from('tr_products');

            if (array_key_exists("where", $params)) {
                foreach ($params['where'] as $key => $val) {
                    $this->db->where($key, $val);
                }
            }

            if (array_key_exists("search", $params)) {
                // Filter data by searched keywords 
                if (!empty($params['search']['keywords'])) {
                    $this->db->like('product_name', $params['search']['keywords']);
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