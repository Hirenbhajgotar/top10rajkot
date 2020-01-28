<?php 
class Home_content extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('Product_Model');
        $this->load->model('Category_Model');
        $this->load->model('Is_unique'); // * check unique value 
        $this->load->model('ScoUrl_Model'); // * sco url model

        $this->load->library('form_validation');

        $this->load->library('ajax_pagination');

        $this->perPage = 5;
    }

    // * home content lst
    public function homeContentList()
    {
        $data['title'] = "Home content";

        $this->load->view('generalTheme/header');
        $this->load->view('generalTheme/sidebar');
        $this->load->view('home_content/home_content_list', $data);
        $this->load->view('generalTheme/footer');
    }

    // * add home content
    public function addHomeContent()
    {
        $data['title'] = "Add home content";

        $this->load->view('generalTheme/header');
        $this->load->view('generalTheme/sidebar');
        $this->load->view('home_content/add_home_content', $data);
        $this->load->view('generalTheme/footer');
    } 


}

?>