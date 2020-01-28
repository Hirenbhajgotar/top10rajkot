<?php 
class Buyer extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Buyer_Model');
        $this->load->library('form_validation');
        $this->load->model('Is_unique'); // * check unique value
        $this->load->library('ajax_pagination');

        $this->perPage = 5;
    }
    
    
    // * view buyer
    public function buyerList()
    {

        $data = array();

        $conditions['returnType'] = 'count';

        $totalRec = $this->Buyer_Model->getBuyerPage(false, $conditions);

        $config['target']      = '#dataList';
        $config['base_url']    = base_url('Buyer/ajaxPaginationBuyer/');
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';

        $this->ajax_pagination->initialize($config);

        $conditions = array(
            'limit' => $this->perPage
        );

        $data['title'] = 'Buyer';
        $data['buyers'] = $this->Buyer_Model->get_buyers();

        $this->load->view('generalTheme/header');
        $this->load->view('generalTheme/sidebar');
        $this->load->view('buyer/buyer_list', $data);
        $this->load->view('generalTheme/footer');
    }

    public function addBuyer()
    {
        $id = $this->input->post('country_id');
        $data['title'] = 'Add buyer';
        $data['countries'] = $this->Buyer_Model->get_countries();
        $data['states'] = $this->Buyer_Model->get_states($id);
        $data['india_states'] = $this->Buyer_Model->get_india_state();
        
        // * Set 'buyer' validation rules
        $this->form_validation->set_rules('first_name', 'First name', 'required|trim');
        $this->form_validation->set_rules('last_name', 'Last name', 'trim');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[tr_buyer.email]|valid_email|trim');
        $this->form_validation->set_rules('mobile_no', 'Mobile Number', 'required|trim|numeric|exact_length[10]');
        $this->form_validation->set_rules('gender', 'Gender', 'trim');
        $this->form_validation->set_rules('password', 'Password', 'trim');
        $this->form_validation->set_rules('confirm_password', 'Confirm password', 'required|matches[password]|trim');
        // * set 'address' validation rules
        $this->form_validation->set_rules('company', 'Company', 'trim');
        $this->form_validation->set_rules('address_1', 'Address_1', 'required|trim');
        $this->form_validation->set_rules('country_id', 'Country', 'trim');
        $this->form_validation->set_rules('state_id', 'State', 'trim');
        $this->form_validation->set_rules('city', 'City', 'trim');
        $this->form_validation->set_rules('postcode', 'Postcode', 'trim');

        if ($this->form_validation->run() === FALSE) {
           
            $this->load->view('generalTheme/header');
            $this->load->view('generalTheme/sidebar');
            $this->load->view('Buyer/add_buyer', $data);
            $this->load->view('generalTheme/footer');
        } else {
            if ($last_id = $this->Buyer_Model->addBuyer()) {
                if ($row = $this->Buyer_Model->get_Buyer($last_id)) {
                   
                    $track_id = 'buyer_id=' . $last_id;
                    $ip = $this->User_Model->get_ip();
                    $comment = 'buyer added: <b>' . $row['first_name'] . ' ' . $row['last_name'] . '</b>';
                    $this->Category_Model->user_history($track_id, $ip, $comment);
                    $this->session->set_flashdata('success', 'Your product has been created.');
                }
            }
            redirect('Buyer/buyerList');
        }

        
    }

    // * update buyer
    public function updateBuyer($id)
    {
        $data['title'] = 'Update buyer';
        $data['buyer'] = $this->Buyer_Model->get_Buyer($id);
        $data['address'] = $this->Buyer_Model->getAddress($id);

        $data['countries'] = $this->Buyer_Model->get_countries();
        $data['states'] = $this->Buyer_Model->get_states($id);
        $data['india_states'] = $this->Buyer_Model->get_india_state();
        $state_id = $data['address'][0]['country_id'];
        $data['selected_states'] = $this->Buyer_Model->selected_state($state_id);
        $data['newsletter'] = $this->Buyer_Model->get_newsletter($id);


        $this->load->view('generalTheme/header');
        $this->load->view('generalTheme/sidebar');
        $this->load->view('Buyer/update_buyer', $data);
        $this->load->view('generalTheme/footer');
    }

    // * update buyer data
    public function updateBuyerData($id)
    {
        $data['title'] = 'Updata buyer';
        $cid = $this->input->post('country_id');

        $data['buyer'] = $this->Buyer_Model->get_Buyer($id);
        $data['address'] = $this->Buyer_Model->getAddress($id);

        $data['countries'] = $this->Buyer_Model->get_countries();
        $data['states'] = $this->Buyer_Model->get_states($cid);
        // $data['india_states'] = $this->Buyer_Model->get_india_state();
        $state_id = $data['address'][0]['country_id'];
        $data['selected_states'] = $this->Buyer_Model->selected_state($state_id);
        $data['newsletter'] = $this->Buyer_Model->get_newsletter($id);
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // exit;
        // * Set "buyer's" validation rules
        $this->form_validation->set_rules('first_name', 'First name', 'required|trim');
        $this->form_validation->set_rules('last_name', 'Last name', 'trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('mobile_no', 'Mobile Number', 'required|trim|numeric|exact_length[10]');
        $this->form_validation->set_rules('gender', 'Gender', 'trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('confirm_password', 'Confirm password', 'trim|required|matches[password]');
        // * set "address's" validation rules
        $this->form_validation->set_rules('company', 'Company', 'trim');
        $this->form_validation->set_rules('address_1', 'Address_1', 'required|trim');
        $this->form_validation->set_rules('country_id', 'Country', 'trim');
        $this->form_validation->set_rules('state_id', 'State', 'trim');
        $this->form_validation->set_rules('city', 'City', 'trim');
        $this->form_validation->set_rules('postcode', 'Postcode', 'trim');


        if ($this->form_validation->run() === FALSE) {
            $this->load->view('generalTheme/header');
            $this->load->view('generalTheme/sidebar');
            $this->load->view('Buyer/update_buyer', $data);
            $this->load->view('generalTheme/footer');
        } else {
            // * check unique value
            $buyer_email = $this->input->post('email');
            if ($this->Is_unique->check('email', 'tr_buyer', $buyer_email, $id)) {
                $data['img_error'] = "Email id allready taken by unother person please enter unique email address!";
                $this->load->view('generalTheme/header');
                $this->load->view('generalTheme/sidebar');
                $this->load->view('Buyer/update_buyer', $data);
                $this->load->view('generalTheme/footer');
            } else {
                if ($last_id = $this->Buyer_Model->updateBuyer($id)) {
                    if ($row = $this->Buyer_Model->get_Buyer($last_id)) {
                       
                        $track_id = 'buyer_id=' . $last_id;
                        $ip = $this->User_Model->get_ip();
                        $comment = 'buyer updated: <b>' . $row['first_name'] . ' ' . $row['last_name'] . '</b>';
                        $this->Category_Model->user_history($track_id, $ip, $comment);
                        $this->session->set_flashdata('success', 'Buyer has been updated.');
                    }
                }
                redirect('Buyer/buyerList');
            }
            
        }
    }

    // * delete buyer
    public function delete_buyer()
    {
        $id = $this->input->post('chk');
        
        $track_id = $id;
        $ip = $this->User_Model->get_ip();
        $this->Buyer_Model->save_delete_history($track_id, $ip);

        if ($this->Buyer_Model->delete_buyer($id)) {

            $this->session->set_flashdata('success', 'Buyer has been deleted Successfully.');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    // * ajax pagination
    function ajaxPaginationBuyer()
    {
        // Define offset 
        $page = $this->input->post('page');

        if (!$page) {
            $offset = 0;
        } else {
            $offset = $page;
        }
        $keywords = $this->input->post('keywords');
        $sortBy = $this->input->post('sortBy');
        if (!empty($keywords)) {
            $conditions['search']['keywords'] = $keywords;
        }
        if (!empty($sortBy)) {
            $conditions['search']['sortBy'] = $sortBy;
        }
        $conditions['returnType'] = 'count';
        $totalRec = $this->Buyer_Model->getBuyerPage(false, $conditions);
        // Get record count 

        // Pagination configuration 
        $config['target']      = '#dataList';
        $config['base_url']    = base_url('Buyer/ajaxPaginationBuyer/');
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';

        // Initialize pagination library 
        $this->ajax_pagination->initialize($config);
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        unset($conditions['returnType']);

        // Get records 
        $data['buyers'] = $this->Buyer_Model->getBuyerPage(false, $conditions);
        $data['start'] = $offset;
        // Load the data list view 
        $this->load->view('buyer/ajaxdata', $data, false);
    }

    // * get states
    public function get_states()
    {
        // header('Access-Control-Allow-Origin: *');
        $country_id = $this->input->post('country_id');
        // $country_id = $_POST;
        $query = $this->db->order_by('name', 'tr_state')
            ->where('country_id', $country_id)
            ->get('tr_state');
        $states = $query->result();
        echo json_encode($states);
    }
    
}

?>