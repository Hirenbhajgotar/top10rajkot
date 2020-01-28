<?php 
class CmsPage extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CmsPage_Model');
        $this->load->library('form_validation');
        $this->load->model('Is_unique'); // * check unique value
        $this->load->model('ScoUrl_Model'); // * sco url model
        $this->load->library('ajax_pagination');    

        $this->perPage = 5;
    }
    // *  Vew CmsPage
    public function CmsPageList()
    {
        $data = array();
        $conditions['returnType'] = 'count';
        $totalRec = $this->CmsPage_Model->getCmsPage(false, $conditions);
        $config['target']      = '#dataList';
        $config['base_url']    = base_url('CmsPage/ajaxPaginationCms/');
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';

        $this->ajax_pagination->initialize($config);

        $conditions = array(
            'limit' => $this->perPage
        );
        $data['title'] = 'CMS Page';
        $data['cmsData'] = $this->CmsPage_Model->getCms();
        
        $this->load->view('generalTheme/header');
        $this->load->view('generalTheme/sidebar');
        $this->load->view('CMSPages/cms_page_list', $data);
        $this->load->view('generalTheme/footer');
    }

    // * add addCmsPage
    public function addCmsPage()
    {
        $data['title'] = 'Add cms page';
        $data['sellers'] = $this->CmsPage_Model->getSellers();
        
        // * Set 'cms page' validation rules
        $this->form_validation->set_rules('seller_id', 'Seller', 'required|trim');
        $this->form_validation->set_rules('title', 'Cms title', 'required|trim');
        $this->form_validation->set_rules('seo_keyword', 'Seo keyword', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');
        $this->form_validation->set_rules('meta_description', 'Meta description', 'trim');
        $this->form_validation->set_rules('meta_title', 'Meta title', 'trim');
        $this->form_validation->set_rules('meta_keyword', 'Meta keyword', 'trim');
        $this->form_validation->set_rules('maintenance_mode', 'Maintenance mode', 'trim');

        if ($this->form_validation->run() === FALSE) {
            // $this->load->view('administrator/header-script');
            // $this->load->view('administrator/header');
            // $this->load->view('administrator/header-bottom');
            // $this->load->view('CMSPages/addCmsPage', $data);
            // $this->load->view('administrator/footer');

            $this->load->view('generalTheme/header');
            $this->load->view('generalTheme/sidebar');
            $this->load->view('CMSPages/add_cms_page', $data);
            $this->load->view('generalTheme/footer');
        } else {
            if ($last_id = $this->CmsPage_Model->addCms()) {
                if ($row = $this->CmsPage_Model->getCms($last_id)) {
                    // * save user history
                    $track_id = 'cms_id=' . $last_id;
                    $ip = $this->User_Model->get_ip();
                    $comment = 'Cms added: <b>' . $row['title'] . '</b>';
                    
                    //* save sco url
                    $keyword = $row['seo_keyword'];
                    $this->ScoUrl_Model->saveSco($track_id, $keyword);
                    $this->Category_Model->user_history($track_id, $ip, $comment);
                    $this->session->set_flashdata('success', 'CMS page has been created.');
                }
            }
            redirect('CmsPage/CmsPageList');
        }
    }

    // * delete cms
    public function deleteCms()
    {
        $id = $this->input->post('chk');

        $track_id = $id;
        $ip = $this->User_Model->get_ip();
        $this->CmsPage_Model->save_delete_history($track_id, $ip);
        $this->ScoUrl_Model->deleteSco($id, "cms_id="); //* save sco url
        if ($this->CmsPage_Model->deleteCms($id)) {

            $this->session->set_flashdata('success', 'Cms page has been deleted Successfully.');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    // * update cms
    public function updateCms($id)
    {
        $data['title'] = 'Updata cms';
        $data['cmsData'] = $this->CmsPage_Model->getCms($id);
        $seller_id = $data['cmsData']['seller_id'];
        $data['seller'] = $this->CmsPage_Model->getSellers($seller_id);
        $data['allSellers'] = $this->CmsPage_Model->getSellers();

        // $this->load->view('administrator/header-script');
        // $this->load->view('administrator/header');
        // $this->load->view('administrator/header-bottom');
        // $this->load->view('CMSPages/updateCmsPage', $data);
        // $this->load->view('administrator/footer');

        $this->load->view('generalTheme/header');
        $this->load->view('generalTheme/sidebar');
        $this->load->view('CMSPages/update_cms_page', $data);
        $this->load->view('generalTheme/footer');
    }

    // * update cms data
    public function updateCmsData($id)
    {
        $data['title'] = 'Updata cms';
        $data['cmsData'] = $this->CmsPage_Model->getCms($id);
        $seller_id = $data['cmsData']['seller_id'];
        $data['seller'] = $this->CmsPage_Model->getSellers($seller_id);
        $data['allSellers'] = $this->CmsPage_Model->getSellers();

        // * Set 'cms page' validation rules
        $this->form_validation->set_rules('seller_id', 'Seller', 'required|trim');
        $this->form_validation->set_rules('title', 'Cms title', 'required|trim');
        $this->form_validation->set_rules('seo_keyword', 'Seo keyword', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');
        $this->form_validation->set_rules('meta_title', 'Meta title', 'trim');
        $this->form_validation->set_rules('meta_keyword', 'Meta keyword', 'trim');
        $this->form_validation->set_rules('maintenance_mode', 'Maintenance mode', 'trim');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('generalTheme/header');
            $this->load->view('generalTheme/sidebar');
            $this->load->view('CMSPages/update_cms_page', $data);
            $this->load->view('generalTheme/footer');
        } else {
            if ($last_id = $this->CmsPage_Model->updateCms($id)) {
                if ($row = $this->CmsPage_Model->getCms($last_id)) {
                    // * insert data into "user's history" table
                    $track_id = 'cms_id=' . $last_id;
                    $ip = $this->User_Model->get_ip();
                    $comment = 'cms update: <b>' . $row['title'] . '</b>';
                    $this->Category_Model->user_history($track_id, $ip, $comment);

                    // * save sco url
                    $query = "cms_id=" . $last_id;
                    $sco = $this->ScoUrl_Model->getSco($query);

                    $scoId = $sco->id;
                    $scoQuery = $sco->query;
                    $keyword = $row['seo_keyword'];
                    $this->ScoUrl_Model->updateSco($scoId, $scoQuery, $keyword);
                    $this->session->set_flashdata('success', 'CMS page has been updated.');
                }
            }
            redirect('CmsPage/CmsPageList');
        }
    }

    // * ajax pagination
    function ajaxPaginationCms()
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
        $totalRec = $this->CmsPage_Model->getCmsPage(false, $conditions);
        // Get record count 

        // Pagination configuration 
        $config['target']      = '#dataList';
        $config['base_url']    = base_url('CmsPage/ajaxPaginationCms/');
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';

        // Initialize pagination library 
        $this->ajax_pagination->initialize($config);
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        unset($conditions['returnType']);

        // Get records 
        $data['cmsData'] = $this->CmsPage_Model->getCmsPage(false, $conditions);
        $data['start'] = $offset;
        // Load the data list view 
        $this->load->view('CMSPages/ajaxdata', $data, false);
    }
}

?>