<?php 
class Seller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Seller_model');
        $this->load->library('form_validation');
        $this->load->model('Is_unique'); // * check unique value
        $this->load->library('ajax_pagination');

        $this->perPage = 5;
    }


    public function seller_list($category_id = '')
    {
        // SELECT sm.*, s.* FROM `tr_seller_membership` sm LEFT JOIN `tr_seller` s ON (sm.id = s.id) WHERE sm.category_id = 84
        $data['title'] = "Seller list";
        $data['seller_id'] = $this->Seller_model->get_seller_membership($category_id);
        $data['metaData'] = $this->Settings_model->get_settings();
        foreach ($data['seller_id'] as $item) {
            // $data['sellers'][] = $this->Seller_model->get_seller($item->seller_id);
            $data['sellers'][] = $this->Seller_model->seller_all_info($item->seller_id);
        }
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // exit;
       
        $this->load->view('frontend/theme/default/templates/header', $data);
        $this->load->view('frontend/theme/default/seller/index');
        $this->load->view('frontend/theme/default/templates/footer');
    }

    


}
