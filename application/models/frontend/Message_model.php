<?php 
class Message_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('db_tables');
        // $this->db_tables->index();
    }

    public function get_buyer_lead($buyer_id)
    {
        $buyerId = $buyer_id['buyer_id'];
        $sql = "SELECT bl.id as bl_id, bl.buyer_id as bl_buyer_id, bl.seller_id as bl_seller_id, bl.category_id as bl_category_id, bl.product_id as bl_product_id, bl.description as bl_description, 
        p.id as p_id, p.seller_id as p_seller_id, p.category_id as p_category_id, p.product_name as p_product_name, p.product_model as p_product_model, p.product_image as p_product_image, p.product_description as p_product_description, 
        s.id as s_id, s.email as s_email, s.mobile as s_email, s.firstname as s_firstname, s.lastname as s_lastname 
        FROM `tr_buyer_to_leads` bl LEFT JOIN `tr_products` p ON (bl.product_id = p.id) 
        LEFT JOIN `tr_seller` s ON (bl.seller_id = s.id) 
        WHERE bl.buyer_id = $buyerId AND bl.status = 1 AND p.status = 1 AND s.status = 1 ORDER BY bl.id DESC ";
       
       $query = $this->db->query($sql);
        return $query->result();
    }

    public function get_chat_messages($leadId = '')
    {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get_where(DB_CHATS_MESSAGE, ['lead_id' => $leadId], 5);
                          
        return array_reverse($query->result());
    }

    // * get total number of rows
    public function total_num_rows($table_name = '', $where = '')
    {
        // DB_CHATS_MESSAGE
        $query = $this->db->get_where($table_name, $where);
        return $query->num_rows();
    }

    // * get previous records
    public function previous_records($leadId = '', $limit = '', $offset = '')
    {   
        $sql = "
            SELECT * FROM ". DB_CHATS_MESSAGE." WHERE lead_id = $leadId ORDER BY id desc LIMIT $limit OFFSET $offset
        ";
        $query = $this->db->query($sql);
        return array_reverse($query->result());        
    }

    // * set messages
    public function set_message()
    {
        $ajax_message_field =  $this->security->xss_clean(trim($this->input->post('ajax_message_field')));
        $ajax_chat_buyer_id =  $this->security->xss_clean(trim($this->input->post('ajax_chat_buyer_id')));
        $ajax_chat_lead_id =  $this->security->xss_clean(trim($this->input->post('ajax_chat_lead_id')));
        $ajax_chat_seller_id =  $this->security->xss_clean(trim($this->input->post('ajax_chat_seller_id')));
        
        $data = [
            'buyer_id' => $ajax_chat_buyer_id,
            'seller_id' => $ajax_chat_seller_id,
            'lead_id' => $ajax_chat_lead_id,
            'messages' => $ajax_message_field,
            'is_buyer_read' => 1,
            'is_seller_read' => 0,
            'send_from_buyer' => 1,
            'send_from_seller' => 0,
            'date_added' => date("Y-m-d H:i:s"),
        ];
        return $this->db->insert(DB_CHATS_MESSAGE, $data);
    } 


    public function get_messages()
    {
        $leadId = 26;
        $this->db->order_by('id', 'desc');
        $query = $this->db->get_where(DB_CHATS_MESSAGE, ['lead_id' => $leadId], 5);
        return $query->result();
    }

    // * get lead info
    public function get_lead_info($leadId = '')
    {
        // echo '<pre>';
        // print_r($leadId);
        // echo '</pre>';
        // exit;
        $sql = "
            SELECT l.id as lead_id, l.description as lead_description, 
            s.id as seller_id, s.firstname as seller_firstname, s.lastname as seller_lastname, 
            p.id as product_id, p.product_image as product_image 
            FROM ".DB_BUYER_TO_LEADS." l
            LEFT JOIN ".DB_SELLER." s ON (l.seller_id = s.id)
            LEFT JOIN ". DB_PRODUCTS." p ON (l.product_id = p.id) 
            WHERE l.id = $leadId AND l.status = 1
        ";
        $query = $this->db->query($sql);
        return $query->result();

    }


}

?>