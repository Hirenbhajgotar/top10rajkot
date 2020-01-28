<?php
class Banner extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_Model');
        $where = ['key' => 'other_per_page_limit'];
        global $per_page; //* declare global var
        $per_page = $this->Settings_model->get_settings($where);
        
        $this->perPage = $per_page->value;
    }

    // * banner list
    public function bannerList()
    {
        global $per_page; //* $per_page super global var 

        $data = array();

        $conditions['returnType'] = 'count';

        $totalRec = $this->Site_banner_model->getBannerPage(false, $conditions);

        $config['target']      = '#dataList';
        $config['base_url']    = base_url('Banner/ajaxPaginationBanner/');
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';

        $this->ajax_pagination->initialize($config);

        $conditions = array(
            'limit' => $this->perPage
        );
        
        $data['title'] = "Banner list";
        $limit = $per_page->value;
        $data['banners'] = $this->Site_banner_model->get_banner('', $limit);

        $this->load->view('generalTheme/header');
        $this->load->view('generalTheme/sidebar');
        $this->load->view('site_banner/banner_list', $data);
        $this->load->view('generalTheme/footer');
    }

    // * add banner
    public function addBanner()
    {
        $data['title'] = "Add Banner";

        $this->form_validation->set_rules('name', 'Name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('position', 'Position', 'required|trim|xss_clean');
        $this->form_validation->set_rules('link', 'Link', 'trim|xss_clean');
        // $this->form_validation->set_rules('image', 'Image', 'required|trim|xss_clean');
        $this->form_validation->set_rules('short_order', 'Short order', 'trim|xss_clean|numeric');
        $this->form_validation->set_rules('status', 'Status', 'trim|xss_clean');

        if ($this->form_validation->run() === false) {
            $this->load->view('generalTheme/header');
            $this->load->view('generalTheme/sidebar');
            $this->load->view('site_banner/add_banner', $data);
            $this->load->view('generalTheme/footer');
        } else {
            //* Upload Image
            $this->load->library('upload');
            $imgPath = './assets/images/site_banner';
            $name_parts = pathinfo($_FILES['image']['name']);
            $name_full  = preg_replace('/\s+/', '', $name_parts['filename']);
            $file_name  = $name_full . '-' . date('Ymd-his');

            $config['upload_path'] = $imgPath;
            $config['file_name'] = $file_name;
            $config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
            $config['max_size'] = '2048';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';

            $this->upload->initialize($config);
            if (!$this->upload->do_upload('image')) {
                $data['img_error'] = $this->upload->display_errors();
                $this->load->view('generalTheme/header');
                $this->load->view('generalTheme/sidebar');
                $this->load->view('site_banner/add_banner', $data);
                $this->load->view('generalTheme/footer');
            } else {
                $data['upload_data'] = $this->upload->data();
                $image = $data['upload_data']['file_name'];

                if ($last_id = $this->Site_banner_model->create_banner($image)) {
                    $l_id = ['id' => $last_id];
                    if ($row = $this->Site_banner_model->get_banner($l_id)) {
                        // * save user history
                        $track_id = 'banner_id=' . $last_id;
                        $ip = $this->User_Model->get_ip();
                        $comment = 'added banner: <b>' . $row->name . '</b>';
                        $this->Category_Model->user_history($track_id, $ip, $comment);

                            $this->session->set_flashdata('success', 'Your banner has been created.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Somthing went wrong please trya again letter!.');
                }
                redirect('Banner/bannerList');
            }
        }
    }

    // * updatea banner
    public function updateBanner($id = '')
    {
        $data['title'] = 'Updata Banner';
        $data['banner'] = $this->Site_banner_model->get_banner(['id' => $id]);
        
        $this->load->view('generalTheme/header');
        $this->load->view('generalTheme/sidebar');
        $this->load->view('site_banner/update_banner', $data);
        $this->load->view('generalTheme/footer');
    }

    // * update banner data
    public function updateBannerData($id = '')
    {
        $data['title'] = 'Updata Banner';
        $data['banner'] = $this->Site_banner_model->get_banner(['id' => $id]);
        
        $this->form_validation->set_rules('name', 'Name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('position', 'Position', 'required|trim|xss_clean');
        $this->form_validation->set_rules('link', 'Link', 'trim|xss_clean');
        $this->form_validation->set_rules('short_order', 'Short order', 'trim|xss_clean|numeric');
        $this->form_validation->set_rules('status', 'Status', 'trim|xss_clean');

        if ($this->form_validation->run() === false) {
            $this->load->view('generalTheme/header');
            $this->load->view('generalTheme/sidebar');
            $this->load->view('site_banner/update_banner', $data);
            $this->load->view('generalTheme/footer');
        } else {
            if ($_FILES['image']['size'] > 0) {
                // * remove image from folder
                if (file_exists('./assets/images/site_banner/' . $data['banner']->image)) {
                    unlink('./assets/images/site_banner/' . $data['banner']->image);
                }

                //* Upload Image
                $this->load->library('upload');
                $imgPath = './assets/images/site_banner';
                $name_parts = pathinfo($_FILES['image']['name']);
                $name_full  = preg_replace('/\s+/', '', $name_parts['filename']);
                $file_name  = $name_full . '-' . date('Ymd-his');

                $config['upload_path'] = $imgPath;
                $config['file_name'] = $file_name;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
                $config['max_size'] = '2048';
                $config['max_width'] = '2000';
                $config['max_height'] = '2000';

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('image')) {
                    $data['img_error'] = $this->upload->display_errors();
                    $this->load->view('generalTheme/header');
                    $this->load->view('generalTheme/sidebar');
                    $this->load->view('site_banner/update_banner', $data);
                    $this->load->view('generalTheme/footer');
                } else {
                    $data['upload_data'] = $this->upload->data();
                    $image = $data['upload_data']['file_name'];

                    if ($last_id = $this->Site_banner_model->update_banner($id, $image)) {
                        $l_id = ['id' => $last_id];
                        if ($row = $this->Site_banner_model->get_banner($l_id)) {
                            // * save user history
                            $track_id = 'banner_id=' . $last_id;
                            $ip = $this->User_Model->get_ip();
                            $comment = 'update banner: <b>' . $row->name . '</b>';
                            $this->Category_Model->user_history($track_id, $ip, $comment);

                            $this->session->set_flashdata('success', 'Your banner has been updated.');
                        }
                    } else {
                        $this->session->set_flashdata('error', 'Somthing went wrong please trya again letter!.');
                    }
                    redirect('Banner/bannerList');
                }
            } else {
                if ($last_id = $this->Site_banner_model->update_banner($id)) {
                    $l_id = ['id' => $last_id];
                    if ($row = $this->Site_banner_model->get_banner($l_id)) {
                        // * save user history
                        $track_id = 'banner_id=' . $last_id;
                        $ip = $this->User_Model->get_ip();
                        $comment = 'update banner: <b>' . $row->name . '</b>';
                        $this->Category_Model->user_history($track_id, $ip, $comment);

                        $this->session->set_flashdata('success', 'Your banner has been updated.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Somthing went wrong please trya again letter!.');
                }
                redirect('Banner/bannerList');
            }
        }
    }

    // *delere banner
    public function deleteBanner()
    {
        
        $id = $this->input->post('chk');

        $track_id = $id;
        $ip = $this->User_Model->get_ip();
        // $comment = 'category updated id = ' . $last_id;
        $this->Site_banner_model->save_delete_history($track_id, $ip); //* save user history
        if ($this->Site_banner_model->delete_banner($id)) {

            $this->session->set_flashdata('success', 'Banner has been deleted Successfully.');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    // * ajax pagination
    public function ajaxPaginationBanner()
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
        // $totalRec = $this->Product_Model->getProducPage(false, $conditions);
        $totalRec = $this->Site_banner_model->getBannerPage(false, $conditions);
        // Get record count 

        // Pagination configuration 
        $config['target']      = '#dataList';
        $config['base_url']    = base_url('Banner/ajaxPaginationBanner/');
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';

        // Initialize pagination library 
        $this->ajax_pagination->initialize($config);
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        unset($conditions['returnType']);


        // Get records 
        // $data['users'] = $this->User_Model->get_users(false, $conditions);
        $data['banners'] = $this->Site_banner_model->getBannerPage(false, $conditions);
        $data['start'] = $offset;
        // Load the data list view 
        $this->load->view('site_banner/ajaxdata', $data, false);
    }



}
