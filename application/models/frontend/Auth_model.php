<?php
class Auth_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('db_tables');
        $this->db_tables->index();
    }

    public function login($email, $e_password)
    {
        $this->db->where('email', $email);
        $this->db->where('password', $e_password);

        $result = $this->db->get('tr_buyer');

        if ($result->num_rows() == 1) {
            return $result->row(0);
        } else {
            return false;
        }
    }

    // * insert seller
    public function register($e_password = '')
    {
        $buyer_data = [];
        $buyer_data = [
            'email' => $this->input->post('email'),
            'mobile_no' => $this->input->post('mobile_no'),
            'email_verify' => 0,
            'mobile_verify' => 1,
            'date_addedd' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s"),
            'last_login' => date("Y-m-d H:i:s"),
            'status' => 1,
        ];
        if ($this->input->post('name') != '') {
            $name = explode(" ", $this->input->post('name'));

            if (array_key_exists(0, $name)) {
                $buyer_data['last_name'] = set_value($name[0], '');
            }
            if (array_key_exists(1, $name)) {
                $buyer_data['last_name'] = set_value($name[1], '');
            }
        }
        $this->db->insert(DB_BUYER, $buyer_data);
        $insert_id = $this->db->insert_id();
        
        // #buyer address
        $buyer_adress = [
            'buyer_id'      => $insert_id,
            'seller_id'     => 0,
            'city'          => $this->input->post('city'),
            'date_added'    => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        ];
        $this->db->insert(DB_ADDRESS, $buyer_adress);

        // #save buyer history
        $buyer_history = [
            'buyer_id'   => $insert_id,
            'track_id'   => 'buyer_id='. $insert_id,
            'comment'    => '<b>Buyer LogedIn</b>',
            'ip'         => $this->input->ip_address(),
            'date_added' => date("Y-m-d H:i:s"),
            'is_view'    => 0
        ];
        return $this->db->insert(DB_BUYER_HISTORY, $buyer_history);
    }

    // *set buyer history
    public function set_buyer_history($mobile = '')
    {
        $query =  $this->db->where('mobile_no', $mobile)
                           ->get(DB_BUYER);
        $res = $query->row();
        
        $buyer_history = [
            'buyer_id'   => $res->id,
            'track_id'   => 'buyer_id='.$res->id,
            'comment'    => '<b>buyer logedin</b>',
            'ip'         => $this->input->ip_address(),
            'date_added' => date("Y-m-d H:i:s"),
            'is_view'    => 0,
        ];
        return $this->db->insert(DB_BUYER_HISTORY, $buyer_history);
    }

    // * get buyer data
    //@method mixed get_guyer() only accept array as a first($where) argument
    public function get_buyer($where)
    {
        if (is_array($where)) {
            $query = $this->db->get_where("tr_buyer", $where);
            return $query->row();
        }
    }

    // * set data on buyer_to_leads
    public function set_buyer_to_leads($data)
    {
        $res = [
            'buyer_id' => $data['buyer_id'],
            'seller_id' => $data['seller_id'],
            'category_id' => $data['category_id'],
            'product_id' => $data['product_id'],
            'description' => $data['buyer_inquiry'],
            'is_view' => 0,
            'send_to_seller' => 0,
            'status' => 1,
            'date_added' => date("Y-m-d H:i:s"),
            // 'date_expired' => date("Y-m-d H:i:s"),
        ];
        $this->db->insert(DB_BUYER_TO_LEADS, $res);
        $last_inserted_id = $this->db->insert_id();
        
        $chat_msg = [
            'buyer_id' => $data['buyer_id'],
            'seller_id' => $data['seller_id'],
            'lead_id' => $last_inserted_id,
            'messages' => $data['buyer_inquiry'],
            'is_buyer_read' => 0,
            'is_seller_read' => 0,
            'send_from_buyer' => 1,
            'send_from_seller' => 0,
            'date_added' => date("Y-m-d H:i:s"),
        ];
        return $this->db->insert(DB_CHATS_MESSAGE, $chat_msg);

    } 

    

    // *update profile
    public function update_profile($id = '', $e_password = '')
    {
        $data = [
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'mobile_no' => $this->input->post('mobile_no'),
            'email' => $this->input->post('email'),
            'gender' => $this->input->post('gender'),
            'password' => $e_password,
            'gender' => $this->input->post('gender'),
            'date_addedd' => $this->input->post('date_addedd'),
            'date_modified' => date("Y-m-d H:i:s"),
            'last_login' => date("Y-m-d H:i:s"),
            'status' => $this->input->post('status'),
            'email_verify' => $this->input->post('email_verify'),
            'mobile_verify' => $this->input->post('mobile_verify'),
        ];
        $query = $this->db->where("id", $id)
                          ->update("tr_buyer", $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    // * change password
    public function change_password($where, $set_field)
    {
        $query = $this->db->set($set_field)
                          ->where($where)
                          ->update("tr_buyer");
        if ($query) {
            return true;
        } else {
            return false;
        }           
    }

    // *check data exist or not
    //@method mixed check_data_exist() only accept array as a first($item) argument
    public function check_data_exist($item)
    {
        $query = $this->db->get_where("tr_buyer", $item);
        if (!empty($query->row())) {
            return true;
        } else {
            return false;
        }

    }




}
