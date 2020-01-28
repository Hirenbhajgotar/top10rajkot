<?php 
class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('frontend/Products_model');
        $this->load->model('Seller_model');
        $this->load->library('form_validation');
        $this->load->model('Is_unique'); // * check unique value
        
    }

    public function product_list($id = '')
    {
        // SELECT b.*, s.*, bi.* FROM `tr_banner` b LEFT JOIN `tr_seller` s ON (b.seller_id = s.id) LEFT JOIN `tr_banner_image` bi ON (b.id = bi.banner_id) WHERE b.seller_id = 39
        $data['title'] = "products";
        $data['products'] = $this->Products_model->get_products(['seller_id' => $id]);
        $data['seller_info'] = $this->Seller_model->seller_info($id);
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // exit;
        $this->load->view('frontend/theme/default/templates/header');
        $this->load->view('frontend/theme/default/products/product_list', $data);
        $this->load->view('frontend/theme/default/templates/footer');
    } 
}

?>