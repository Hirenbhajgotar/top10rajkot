<?php
class Buyer_Model extends CI_Model
{
    // * get address
    public function getAddress($id)
    {
        $query = $this->db->get_where('tr_address', ['buyer_id' => $id]);
        return $query->result_array();
    }


    // * get buyer
    public function get_Buyer($id)
    {
        $query = $this->db->get_where('tr_buyer', ['id' => $id]);
        return $query->row_array();
    }

    // * get buyers
    public function get_buyers()
    {
        $query = $this->db->order_by('id', 'desc')
                          ->limit(5)
                          ->get('tr_buyer');
        return $query->result_array();
    }

    // * add buyer
    public function addBuyer()
    {
        // * insert data into "buyer's" table
        $data = [
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'mobile_no' => $this->input->post('mobile_no'),
            'gender' => $this->input->post('gender'),
            'password' => $this->input->post('password'),
            'email_verify' => 1,
            'mobile_verify' => 1,
            'last_login' => date("Y-m-d H:i:s"),
            'date_addedd' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s"),
            'status' => $this->input->post('status'),
        ];

        $this->db->insert('tr_buyer', $data);
        $insert_id = $this->db->insert_id();

        // * insert data into "address's" table
        $address_data = [
            'buyer_id' => $insert_id,
            'seller_id' => '',
            'firstname' => $this->input->post('first_name'),
            'lastname' => $this->input->post('last_name'),
            'company' => $this->input->post('company'),
            'address_1' => $this->input->post('address_1'),
            'address_2' => $this->input->post('address_2'),
            'country_id' => $this->input->post('country_id'),
            'state_id' => $this->input->post('state_id'),
            'city' => $this->input->post('city'),
            'postcode' => $this->input->post('postcode'),
            'date_added' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s"),
        ];        
        $this->db->insert('tr_address', $address_data);

        // * inset newsletter's data
        if ($this->input->post('newsletter') != NULL) {
            // echo 'set';
            $newsletter_data = [
                'buyer_id' => $insert_id,
                'date_added' => date("Y-m-d H:i:s"),
            ];
            $this->db->insert('tr_newsletter', $newsletter_data);
        }

        // * return last inserted id (buyer id)
        return  $insert_id;
    }

    // * update buyer
    public function updateBuyer($id)
    {
        
        // * update buyer data
        $data = [
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'mobile_no' => $this->input->post('mobile_no'),
            'gender' => $this->input->post('gender'),
            'password' => $this->input->post('password'),
            'email_verify' => 1,
            'mobile_verify' => 1,
            'last_login' => date("Y-m-d H:i:s"),
            'date_addedd' => $this->input->post('date_addedd'),
            'date_modified' => date("Y-m-d H:i:s"),
            'status' => $this->input->post('status'),
        ];
        
        $query = $this->db->where('id', $id)
            ->update('tr_buyer', $data);
        
        // * updatea buyer's address
        $address_data = [
            'buyer_id' => $id,
            'seller_id' => '',
            'firstname' => $this->input->post('first_name'),
            'lastname' => $this->input->post('last_name'),
            'company' => $this->input->post('company'),
            'address_1' => $this->input->post('address_1'),
            'address_2' => $this->input->post('address_2'),
            'country_id' => $this->input->post('country_id'),
            'state_id' => $this->input->post('state_id'),
            'city' => $this->input->post('city'),
            'postcode' => $this->input->post('postcode'),
            'date_added' => $this->input->post('date_addedd'),
            'date_modified' => date("Y-m-d H:i:s"),
        ];
        $query = $this->db->where('buyer_id', $id)
            ->update('tr_address', $address_data);

        // * inset newsletter's data
        if ($this->input->post('newsletter') == NULL) {
            $this->db->where_in('buyer_id', $id);
            $this->db->delete('tr_newsletter');
        } 
        return  $id;
    }

    // * save_delete_history
    public function save_delete_history($ids, $ip)
    {
        $userid = $this->session->userdata();
        $userid = $userid['user_id'];

        foreach ($ids as $id) {
            // $name = $this->Usergroup_Model->get_name($id);
            $row = $this->Buyer_Model->get_Buyer($id);
            $name[] = $row['first_name'] . ' ' . $row['last_name'];
            // echo '<pre>';
            // print_r($name);
            // echo '</pre>';
        }
        // exit;
        $data = array(
            'user_id' => $userid,
            'track_id' => '',
            'comment' => 'deleted buyer: <b>' . implode(" , ", $name) . '</b>',
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

    // * delete buyer
    public function delete_buyer($id)
    {
        $this->db->where_in('id', $id);
        $this->db->delete('tr_buyer');

        // * delete newsletter data
        $this->Buyer_Model->delete_newsletter($id);

        // * delete buyer's address data
        $this->Buyer_Model->delete_address($id);
        return true;
    }

    // * delete newsletter
    public function delete_newsletter($id)
    {
        $this->db->where_in('buyer_id', $id);
        $this->db->delete(' tr_newsletter');
        return true;
    }

    // * delete buyer's address
    public function delete_address($id)
    {
        $this->db->where_in('buyer_id', $id);
        $this->db->delete('tr_address');
        return true;
    }

    public function getBuyerPage($buyerName = FALSE, $params = array())
    {
        if ($buyerName === FALSE) {

            $this->db->select('*');
            $this->db->from('tr_buyer');

            if (array_key_exists("where", $params)) {
                foreach ($params['where'] as $key => $val) {
                    $this->db->where($key, $val);
                }
            }

            if (array_key_exists("search", $params)) {
                // Filter data by searched keywords 
                if (!empty($params['search']['keywords'])) {
                    $search_value = explode(" ", trim($params['search']['keywords']));
                    
                    if (count($search_value) > 1) {
                        
                        foreach ($search_value as $key => $data) {
                            $this->db->like('first_name', $search_value[0]);
                            $this->db->like('last_name', $search_value[1]);
                        }
                       
                    } else {
                        $value = implode("", $search_value);
                   
                        $this->db->like('first_name', $value);
                        $this->db->or_like('last_name', $value);
                    }
                }
            }

            // Sort data by ascending or desceding order 
            if (!empty($params['search']['sortBy'])) {
                // $this->db->order_by('first_name', $params['search']['sortBy']);
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
        $query = $this->db->get_where('tr_buyer', array('username' => $buyerName));
        return $query->row_array();
    }

    // * get countries
    public function get_countries()
    {
        $query = $this->db->get('tr_country');
        return $query->result();
    }

    // * get staes
    public function get_states($id = '')
    {
        if ($id) {
            $query = $this->db->get_where('tr_state', ['country_id' => $id]);
            return $query->result();
        } else {
            $query = $this->db->get('tr_state');
            return $query->result();
        }
    }

    // * selected_state
    public function selected_state($id = '')
    {
        $query = $this->db->select('*')
                          ->where(['country_id' => $id])
                          ->get('tr_state');
        // return $query->row();
        // $query = $this->db->get('tr_state');
        return $query->result();
    }

    // * get newsletter
    public function get_newsletter($id)
    {
        $query = $this->db->get_where('tr_newsletter', ['buyer_id' => $id]);
        return $query->row();

    }

    // * get india's states
    public function get_india_state()
    {
        $query = $this->db->get_where('tr_state', ['country_id' => 1]);
        return $query->result();
        
    }
}
