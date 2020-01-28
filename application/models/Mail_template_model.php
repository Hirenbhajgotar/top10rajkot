<?php 
class Mail_template_model extends CI_Model
{
    // * add mail template
    public function add_mail_template($image = '')
    {
        $userid = $this->session->userdata();
        $userid = $userid['user_id'];

       $data = [
           'shortcodes' => $this->input->post('shortcodes'),
            'mail_title' => $this->input->post('mail_title'), 
            'sort_order' => $this->input->post('sort_order'),
            'mail_attachment' => $image, 
            'sms_notify' => $this->input->post('sms_notify'), 
            'mail_notify' => $this->input->post('mail_notify'), 
            'status' => $this->input->post('status'), 
            'sms_content' => $this->input->post('sms_content'), 
            'mail_content' => $this->input->post('mail_content'),
            'datemodify' => date("Y-m-d H:i:s"),
            'userId' => $userid, 
       ];

       $this->db->insert('tr_mail_template', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

    // * get mail template
    public function get_mail_template($id = '')
    {
        if ($id) {
            $query = $this->db->get_where('tr_mail_template', array('id' => $id));
            return $query->row_array();
        } else {
            $query = $this->db->order_by('id', 'desc')
                ->limit(5)
                ->get('tr_mail_template');
            return $query->result_array();
        }
    }

    // *delete mail template
    public function delete_mail_template($ids)
    {
        foreach ($ids as $id) {
            $data['mail_template'] = $this->Mail_template_model->get_mail_template($id);
           
            if (file_exists('../assets/images/mail_template/' . $data['mail_template']['mail_attachment'])) {
                unlink('../assets/images/mail_template/' . $data['mail_template']['mail_attachment']);
            }

            $this->db->where_in('id', $id);
            $this->db->delete('tr_mail_template');
        }
        return true;
    } 

    // * update mail template
    public function update_mail_template($id, $image = '')
    {
        $userid = $this->session->userdata();
        $userid = $userid['user_id'];

        $data = [
            'shortcodes' => $this->input->post('shortcodes'),
            'mail_title' => $this->input->post('mail_title'),
            'sort_order' => $this->input->post('sort_order'),
            'mail_attachment' => $image,
            'sms_notify' => $this->input->post('sms_notify'),
            'mail_notify' => $this->input->post('mail_notify'),
            'status' => $this->input->post('status'),
            'sms_content' => $this->input->post('sms_content'),
            'mail_content' => $this->input->post('mail_content'),
            'datemodify' => date("Y-m-d H:i:s"),
            'userId' => $userid,
        ];
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // exit;
        $query = $this->db->where('id', $id)
            ->update('tr_mail_template', $data);
        return  $id;
    }


    public function getMailTemplatePage($mailTemplateName = FALSE, $params = array())
    {
        if ($mailTemplateName === FALSE) {

            $this->db->select('*');
            $this->db->from('tr_mail_template');

            if (array_key_exists("where", $params)) {
                foreach ($params['where'] as $key => $val) {
                    $this->db->where($key, $val);
                }
            }

            if (array_key_exists("search", $params)) {
                // Filter data by searched keywords 
                if (!empty($params['search']['keywords'])) {
                    $this->db->like('mail_title', $params['search']['keywords']);
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

    // * save delete history
    public function save_delete_history($ids, $ip)
    {
        $userid = $this->session->userdata();
        $userid = $userid['user_id'];

        foreach ($ids as $id) {
            $row = $this->Mail_template_model->get_mail_template($id);
            $name[] = $row['mail_title'];
        }
        $data = array(
            'user_id' => $userid,
            'track_id' => '',
            'comment' => 'deleted mail template: <b>' . implode(" , ", $name) . '</b>',
            'ip' => $ip,
            'date_added' => date("Y-m-d H:i:s"),
            'is_view' => '1'
        );
       
        $this->db->insert(' tr_user_history', $data);
        return true;
    }

}

?>