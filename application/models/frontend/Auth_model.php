<?php
class Auth_model extends CI_Model
{
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
        $data = [
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'mobile_no' => $this->input->post('mobile_no'),
            'password' => $e_password,
            'gender' => $this->input->post('gender'),
            'email_verify' => 1,
            'mobile_verify' => 1,
            'date_addedd' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s"),
            'last_login' => date("Y-m-d H:i:s"),
            'status' => 1,
        ];
        return $this->db->insert('tr_buyer', $data);
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
