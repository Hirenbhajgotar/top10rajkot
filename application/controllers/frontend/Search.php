<?php 
defined("BASEPATH") OR exit("direct access not allowed");
class Search extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('frontend/Categories_model');
        $this->load->model('frontend/Products_model');
        $this->load->model('Is_unique'); // * check unique value

    }

    public function index()
    {
        $search_result = $this->security->xss_clean(trim($this->input->get('product')));
        $filter_catefory = $this->security->xss_clean(trim($this->input->get('category')));

        $data['metaData'] = $this->Settings_model->get_settings();
        $data['products'] = $this->Products_model->get_search_products($search_result, $filter_catefory);
        $data['search_key'] = $search_result;


        // echo '<pre>';
        // print_r($data);
        // // print_r($filter_catefory);
        // echo '</pre>';
        // exit;
        $data['metaData']['title'] = $data['metaData'][7]->value;
        $data['metaData']['description'] = $data['metaData'][11]->value;
        $data['metaData']['keyword'] = $data['metaData'][6]->value;
        $data['metaData']['icon'] = $data['metaData'][5]->value;
        $data['metaData']['logo'] = $data['metaData'][4]->value;

        $this->load->view('frontend/theme/default/templates/header', $data);
        $this->load->view('frontend/theme/default/search_product/index');
        $this->load->view('frontend/theme/default/templates/footer');
    }
}

?>