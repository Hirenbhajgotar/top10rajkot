<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
class Message extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('frontend/Auth_model');
        $this->load->model('frontend/Message_model');

        $this->load->library('ajax_pagination');
    }

    public function index()
    {
        $data['metaData'] = $this->Settings_model->get_settings();
        
        $data['buyer_mobile'] = $this->session->userdata('authenticated_buyer_mobile');
        $where = ['mobile_no' => $data['buyer_mobile']];
        $data['buyers_data'] = $this->Auth_model->get_buyer($where);
        $buyer_id = ['buyer_id' => $data['buyers_data']->id];
        $data['buyer_lead'] = $this->Message_model->get_buyer_lead($buyer_id);
        $data['total_num_rows'] = $this->Message_model->total_num_rows(DB_CHATS_MESSAGE, $buyer_id);
      
        // * set metadata
        $data['metaData']['title'] = $data['metaData'][7]->value;
        $data['metaData']['description'] = $data['metaData'][11]->value;
        $data['metaData']['keyword'] = $data['metaData'][6]->value;
        $data['metaData']['icon'] = $data['metaData'][5]->value;
        $data['metaData']['logo'] = $data['metaData'][4]->value;

        $this->load->view('frontend/theme/default/templates/header', $data);
        $this->load->view('frontend/theme/default/messages/message');
        $this->load->view('frontend/theme/default/templates/footer');
    }

    // *get chat messaes
    public function get_lead_messages($leadId = '')
    {
        $leadId = $this->input->post('leadId');

        // * display chat messages
        echo $this->_get_chat_messages($leadId);
    }

    // * insert chat messages
    public function set_message()
    {
        $lead_id =  $this->security->xss_clean(trim($this->input->post('ajax_chat_lead_id')));
        $this->Message_model->set_message();
        
        // * display chat messages
        echo $this->_get_chat_messages($lead_id);
    }

    // * get messages
    public function get_messages()
    {
        // echo 'File name:'. ' ' .__FILE__;
        // echo '<br>';
        // echo 'Line no.:'. ' '.__LINE__;
        // exit;
        $data = $this->Message_model->get_messages();
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // exit;
        $html_output1 = '';

        foreach ($data as $item) {

            if ($item->send_from_seller == 1) {
                $html_output1 .= "<div class='row' id='seller_message'>";
                $html_output1 .= $item->messages;
                $html_output1 .= "</div>";
            }
            if ($item->send_from_buyer == 1) {
                $html_output1 .= "<div class='row' id='buyer_message'>";
                $html_output1 .= "<div class='text-right'>";
                $html_output1 .= $item->messages;
                $html_output1 .= "</div>";
                $html_output1 .= "</div>";
            }
        }
        $output = [
            'content' => $html_output1,
        ];
        echo json_encode($output);
    }

    // * get previous records
    public function get_previous_record()
    {
        $leadId = $this->input->post('leadId');
        $offset = $this->input->post('click');
        
        echo $this->_get_previous_chat_messages($leadId, $offset);
    }

    // * get previous chat messages
    public function _get_previous_chat_messages($leadId = '', $offset = '')
    {
        $limit = 5;
        $offset = $offset * $limit;
        $data = $this->Message_model->previous_records($leadId, $limit, $offset);
        
        $html_output = '';

        foreach ($data as $item) {

            if ($item->send_from_seller == 1) {
                $html_output .= "<div class='row' id='seller_message'>";
                $html_output .= $item->messages;
                $html_output .= "</div>";
            }
            if ($item->send_from_buyer == 1) {
                $html_output .= "<div class='row' id='buyer_message'>";
                $html_output .= "<div class='text-right'>";
                $html_output .= $item->messages;
                $html_output .= "</div>";
                $html_output .= "</div>";
            }
        }
        $output = [
            'content' => $html_output
        ];
        return json_encode($output);
    }

    // * display chat messages
    public function _get_chat_messages($leadId = '')
    {
        $msgs = $this->Message_model->get_chat_messages($leadId);
        $num_rows = $this->Message_model->total_num_rows(DB_CHATS_MESSAGE, ['lead_id' => $leadId]);
        $header_info = $this->Message_model->get_lead_info($leadId);

        $html_output = '';

        foreach ($msgs as $item) {

            if ($item->send_from_seller == 1) {
                $html_output .= "<div class='row' id='seller_message'>";
                $html_output .= $item->messages;
                $html_output .= "</div>";
            }
            if ($item->send_from_buyer == 1) {
                $html_output .= "<div class='row' id='buyer_message'>";
                $html_output .= "<div class='text-right'>";
                $html_output .= $item->messages;
                $html_output .= "</div>";
                $html_output .= "</div>";
            }
        }
        // $html_output .= "<br><br>";
        // $html_output .= "<form id='chat_message_form'>";
        // $html_output .= "<textarea class='form-control' name='ajax_message_field' id='message_field' rows='3'></textarea>";
        // $html_output .= "<input type='hidden' name='ajax_chat_buyer_id' value='$item->buyer_id'>";
        // $html_output .= "<input type='hidden' name='ajax_chat_seller_id' value='$item->seller_id '>";
        // $html_output .= "<input type='hidden' name='ajax_chat_lead_id' value='$item->lead_id'>";
        // $html_output .= "<button id='MessageSubmitAjax' onclick='sendChatMessages()' type='submit' class='btn btn-primary'>Send</button>";
        // $html_output .= "</form>";

        $output = [
            'status'      => 'ok',
            'content'     => $html_output,
            'header_info' => $header_info,
            'num_rows'    => $num_rows,
            'buyerId'     => $item->buyer_id,
            'sellerId'    => $item->seller_id,
            'leadId'      => $item->lead_id,
        ];
        
        return json_encode($output);
    }


}

?>