<?php 
class Settings_model extends CI_Model
{
    // ! get settings
    public function get_settings($where = '')
    {
        if ($where) {
            $query = $this->db->get_where('tr_setting', $where);
            return $query->row();
        } else {
            $query = $this->db->get('tr_setting');
            return $query->result();
        }
    }


    // ! insert settings
    public function insert_settings($logo_image = '', $fev_icon = '')
    {
        // * general setting
        $general_code = "config";
        $general = [
            'config_store_name' => $this->input->post('store_name'),
            'config_store_owner' => $this->input->post('store_owner'),
            'config_email' => $this->input->post('email'),
            'config_logo' => $logo_image,
            'config_icon' => $fev_icon,
            'config_telephone' => $this->input->post('telephone'),
            'config_meta_key_word' => $this->input->post('meta_key_word'),
            'config_meta_title' => $this->input->post('meta_title'),
            'config_geocode' => $this->input->post('geocode'),
            'config_maintenance_mode' => $this->input->post('maintenance_mode'),
            'config_address' => $this->input->post('address'),
            'config_meta_tag_description' => $this->input->post('meta_tag_description'),
        ];
       
        foreach ($general as $key => $item) {
            $genaral_data = [
                'code' => $general_code,
                'key' => $key,
                'value' => $item
            ];
            
            $this->db->where('key', $key);
            $this->db->update('tr_setting', $genaral_data);
        }
        
       
        // * SMTP Mail setting
        $mail = [
            'mail_protocol' => $this->input->post('mail_protocol'),
            'mail_perameter' => $this->input->post('mail_perameter'),
            'mail_smtp_hostname' => $this->input->post('smtp_hostname'),
            'mail_smtp_username' => $this->input->post('smtp_username'),
            'mail_smtp_password' => $this->input->post('smtp_password'),
            'mail_smtp_port' => $this->input->post('smtp_port'),
            'mail_smtp_timeout' => $this->input->post('smtp_timeout'),
        ];
        $mail_code = "mail";
        
        foreach ($mail as $key => $item) {
            $mail_data = [
                'code' => $mail_code,
                'key' => $key,
                'value' => $item
            ];
            
            $this->db->where('key', $key);
            $this->db->update('tr_setting', $mail_data);
        }
 

        // * other setting
        $other = [
            'other_per_page_limit' => $this->input->post('per_page_limit'),
        ];

        $other_code = "other";

        foreach ($other as $key => $item) {
           $other_data = [
                'code' => $other_code,
                'key' => $key,
                'value' => $item
           ];
           $this->db->where('key', $key);
            $this->db->update('tr_setting', $other_data);
        }
        return true;
    }

}

?>