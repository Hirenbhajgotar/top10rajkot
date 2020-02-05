<?php
class Category extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('frontend/Categories_model');

        $this->load->helper('text');
        $this->load->library('form_validation');
        $where = ['key' => 'other_per_page_limit'];
        global $per_page; //* declare global var
        $per_page = $this->Settings_model->get_settings($where);
        $this->perPage = $per_page->value;
        $this->load->model('frontend/Sellerprofile');
        $this->load->library('ajax_pagination');
    }

    public function index($seo)
    {
        // $data['metaData'] = $this->Settings_model->get_settings();
        // $data['category_id'] = $this->Categories_model->get_cat_id($seo);
        // $res = ['id' => $data['category_id']->cate_id];
        // $data['sec_meta_data'] = $this->Categories_model->get_categories($res);
        // $data['products'] = $this->Categories_model->get_products($data['category_id']->cate_id);

        // $this->load->view('frontend/theme/default/templates/header', $data);
        // $this->load->view('frontend/theme/default/category/index');
        // $this->load->view('frontend/theme/default/templates/footer');

        global $per_page;
        $list = array();
        $this->load->library('pagination');
        $this->load->helper('url');
        $data['category_id'] = $this->Categories_model->get_cat_id($seo);

        // * pagination configuration
        $config = array();
        $config["base_url"] = base_url() . "category/{$seo}";
        $config["total_rows"] = $this->Categories_model->get_product($data['category_id']->cate_id);
        $config["per_page"] = $this->perPage;
        $config["uri_segment"] = 3;
        $config['next_tag_open'] = '<li><span>';
        $config['next_tag_close'] = '</span></li>';
        $config['prev_tag_open'] = '<li><span>';
        $config['prev_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        if ($this->uri->segment(3)) {
            $page = ($this->uri->segment(3));
        } else {
            $page = 0;
        }

        $data["links"] = $this->pagination->create_links();
        $data['metaData'] = $this->Settings_model->get_settings();
        $data['category_id'] = $this->Categories_model->get_cat_id($seo);
        $res = ['id' => $data['category_id']->cate_id];

        $data['sec_meta_data'] = $this->Categories_model->get_categories($res);
        $data['products'] = $this->Categories_model->get_products($data['category_id']->cate_id, $config["per_page"], $page);

        foreach ($data['products'] as $pro) {
            $data['seller_seo_keyword'][] = $this->Categories_model->get_seller_seo($pro->seller_id);
            $data['product_seo_keyword'][] = $this->Categories_model->get_product_seo($pro->id);
        }
        
        // * set metadata
        $data['metaData']['title'] = $data['sec_meta_data']->meta_title;
        $data['metaData']['description'] = $data['sec_meta_data']->meta_description;
        $data['metaData']['keyword'] = $data['sec_meta_data']->meta_keyword;
        $data['metaData']['icon'] = $data['metaData'][5]->value;
        $data['metaData']['logo'] = $data['metaData'][4]->value;

        $this->load->view('frontend/theme/default/templates/header', $data);
        $this->load->view('frontend/theme/default/category/index');
        $this->load->view('frontend/theme/default/templates/footer');        
    }
}
