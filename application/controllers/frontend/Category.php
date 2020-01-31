<?php
class Category extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('frontend/Categories_model');
    }

    public function index($seo)
    {
        $data['metaData'] = $this->Settings_model->get_settings();
        $data['category_id'] = $this->Categories_model->get_cat_id($seo);
        $res = ['id' => $data['category_id']->cate_id];
        $data['sec_meta_data'] = $this->Categories_model->get_categories($res);
        $data['products'] = $this->Categories_model->get_products($data['category_id']->cate_id);
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // exit;
        $this->load->view('frontend/theme/default/templates/header', $data);
        $this->load->view('frontend/theme/default/category/index');
        $this->load->view('frontend/theme/default/templates/footer');
    }
}
