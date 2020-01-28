<?php 
class Seller_banner extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Seller_banner_model');
        $this->load->model('Seller_model');
        $this->load->library('form_validation');
        $this->load->model('Is_unique'); // * check unique value
        $this->load->library('ajax_pagination');

        $this->perPage = 5;
    }

    // * banner list
    public function banner_list()
    {
        $this->form_validation->set_rules('seller', 'Seller', 'required|trim');
        if ($this->form_validation->run() === FALSE) {
            $data['title'] = "Select seller";

            $this->load->view('generalTheme/header');
            $this->load->view('generalTheme/sidebar');
            $this->load->view('seller_banner/select_seller', $data);
            $this->load->view('generalTheme/footer');
        } else {
            $data['title'] = "Banner list";
            $seller_id = $this->input->post();
            $data['banners_info'] = $this->Seller_banner_model->get_banner_info($seller_id['seller']);
        
            //
            $this->load->view('generalTheme/header');
            $this->load->view('generalTheme/sidebar');
            $this->load->view('seller_banner/banner_list', $data);
            $this->load->view('generalTheme/footer');
        }
    }

    public function select_seller()
    {
        $data['title'] = "Select seller";
        $data['sellers'] = $this->Seller_model->get_seller();
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // exit;
        
        $this->load->view('generalTheme/header');
        $this->load->view('generalTheme/sidebar');
        $this->load->view('seller_banner/select_seller', $data);
        $this->load->view('generalTheme/footer');
    }
}

?>