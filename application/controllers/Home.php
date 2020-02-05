<?php 
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('frontend/Categories_model');
        $this->load->model('frontend/Banner_model');
        $this->load->library('form_validation');
        $this->load->model('Is_unique'); // * check unique value

    }


    public function index()
    {
        $data['metaData'] = $this->Settings_model->get_settings();
        $data['categories'] = $this->Categories_model->get_feature_categories();
        
        $val = ['seller_id' => 0, 'status' => 1];
        $data['banner'] = $this->Banner_model->get_banner($val);

        $data['metaData']['title'] = $data['metaData'][7]->value;
        $data['metaData']['description'] = $data['metaData'][11]->value;
        $data['metaData']['keyword'] = $data['metaData'][6]->value;
        $data['metaData']['icon'] = $data['metaData'][5]->value;
        $data['metaData']['logo'] = $data['metaData'][4]->value;

        $this->load->view('frontend/theme/default/templates/header', $data);
        $this->load->view('frontend/theme/default/home');
        $this->load->view('frontend/theme/default/templates/footer');
    }
}

?>