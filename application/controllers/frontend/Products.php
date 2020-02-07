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

    // public function product_list($id = '')
    // {
    //     $data['title'] = "products";
    //     $data['products'] = $this->Products_model->get_products(['seller_id' => $id]);
    //     $data['seller_info'] = $this->Seller_model->seller_info($id);

    //     $this->load->view('frontend/theme/default/templates/header');
    //     $this->load->view('frontend/theme/default/products/product_list', $data);
    //     $this->load->view('frontend/theme/default/templates/footer');
    // }
    public function product_list($seo, $page = 'product_list')
    {
        $data['seo'] = $seo;
        $data['metaData'] = $this->Settings_model->get_settings();
        $data['sec_meta_data'] = $this->Products_model->get_seller_metadata($seo);
        $data['products'] = $this->Products_model->get_products($seo);

        $i = 0;
        foreach ($data['products'] as $pro) {
            $seo_p = $this->Products_model->get_product_seo($pro->id);
            $data['products'][$i]->product_seo_keyword = $seo_p->keyword;
            $i++;
        }


        $data['metaData']['title'] = $data['sec_meta_data']->meta_title;
        $data['metaData']['description'] = $data['sec_meta_data']->meta_description;
        $data['metaData']['keyword'] = $data['sec_meta_data']->meta_keyword;
        $data['metaData']['icon'] = $data['metaData'][5]->value;
        $data['metaData']['logo'] = $data['metaData'][4]->value;

        $this->load->view('frontend/theme/default/templates/header', $data);
        $this->load->view('frontend/theme/default/products/' . $page);
        $this->load->view('frontend/theme/default/templates/footer');
    } 

    public function product_detail($seo, $page = 'product_detail')
    {
        $data['metaData'] = $this->Settings_model->get_settings();
        $data['sec_meta_data'] = $this->Products_model->get_product_details($seo);

        $data['products'] = $this->Products_model->get_product_details($seo);
        $data['re_products'] = $this->Products_model->get_releted_products($data['products']['category_id']);

        //$data['seller_info'] = $this->Seller_model->seller_info($id);
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // exit;

        $i = 0;
        foreach ($data['re_products'] as $pro) {
            $seo_p = $this->Products_model->get_product_seo($pro['id']);
            $data['re_products'][$i]['product_seo_keyword'] = $seo_p->keyword;
            $i++;
        }
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // exit;

        // * set metadata
        $data['metaData']['title'] = $data['sec_meta_data']['meta_title'];
        $data['metaData']['description'] = $data['sec_meta_data']['meta_description'];
        $data['metaData']['keyword'] = $data['sec_meta_data']['meta_keyword'];
        $data['metaData']['icon'] = $data['metaData'][5]->value;
        $data['metaData']['logo'] = $data['metaData'][4]->value;

        // $data['metaData']['title'] = $data['sec_meta_data']['meta_title'];
        // $data['metaData']['description'] = $data['sec_meta_data']['meta_description'];
        // $data['metaData']['keyword'] = $data['sec_meta_data']['meta_keyword'];
        // $data['metaData']['icon'] = $data['metaData'][5]->value;
        // $data['metaData']['logo'] = $data['metaData'][4]->value;

        $this->load->view('frontend/theme/default/templates/header', $data);
        $this->load->view('frontend/theme/default/products/' . $page);
        $this->load->view('frontend/theme/default/templates/footer');
    } 

}
