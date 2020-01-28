<?php 
class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_Model');
        $this->load->model('Category_Model');
        $this->load->model('Is_unique'); // * check unique value 
        $this->load->model('ScoUrl_Model'); // * sco url model

        $this->load->library('form_validation');

        $this->load->library('ajax_pagination');

        $this->perPage = 5;
    }

    // * view product
    public function productList()
    {
        $data = array();

        $conditions['returnType'] = 'count';

        $totalRec = $this->Product_Model->getProducPage(false, $conditions);

        $config['target']      = '#dataList';
        $config['base_url']    = base_url('Products/ajaxPaginationProduct/');
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';

        $this->ajax_pagination->initialize($config);

        $conditions = array(
            'limit' => $this->perPage
        );

        $data['title'] = 'Products';
        $data['products'] = $this->Product_Model->get_products();
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // exit;
        $this->load->view('generalTheme/header');
        $this->load->view('generalTheme/sidebar');
        $this->load->view('Products/product_list', $data);
        $this->load->view('generalTheme/footer');
    }

    // * add product
    public function addProducts()
    {
        $data['title'] = 'Add product';
        $data['categories'] = $this->Category_Model->get_categories();
        $data['sellers'] = $this->Product_Model->get_sellers();
        
        // * Set validation rules
        $this->form_validation->set_rules('seller_id', 'Seller Name', 'required');
        $this->form_validation->set_rules('category_id', 'Category name', 'required');
        $this->form_validation->set_rules('product_name', 'Product name', 'required');
        $this->form_validation->set_rules('product_model', 'Product model', 'required|is_unique[tr_products.product_model]');
        $this->form_validation->set_rules('seo_keyword', 'Seo keyword', 'required');
        

        if ($this->form_validation->run() === FALSE) {
            
            $this->load->view('generalTheme/header');
            $this->load->view('generalTheme/sidebar');
            $this->load->view('Products/add_product', $data);
            $this->load->view('generalTheme/footer');
        } else {
            if ($_FILES['product_image']['size'] > 0) {
                //* Upload Image
                $this->load->library('upload');
                $imgPath = './assets/images/products';
                $name_parts = pathinfo($_FILES['product_image']['name']);
                $name_full  = preg_replace('/\s+/', '', $name_parts['filename']);
                $file_name  = $name_full . '-' . date('Ymd-his');

                $config['upload_path'] = $imgPath;
                $config['file_name'] = $file_name;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '2048';
                $config['max_width'] = '2000';
                $config['max_height'] = '2000';

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('product_image')) {
                    $data['img_error'] = $this->upload->display_errors();

                    $this->load->view('generalTheme/header');
                    $this->load->view('generalTheme/sidebar');
                    $this->load->view('Products/add_product', $data);
                    $this->load->view('generalTheme/footer');
                } else {
                    $data['upload_data'] = $this->upload->data();

                    $image = $data['upload_data']['file_name'];

                    if ($last_id = $this->Product_Model->create_product($image)) {
                        if ($row = $this->Product_Model->get_product($last_id)) {

                            // * save user history
                            $track_id = 'product_id=' . $last_id;
                            $ip = $this->User_Model->get_ip();
                            $comment = 'added product: <b>' . $row['product_name'] . '</b>';
                            $this->Category_Model->user_history($track_id, $ip, $comment);

                            //* save sco url
                            $keyword = $row['seo_keyword'];
                            $this->ScoUrl_Model->saveSco($track_id, $keyword);
                            $this->session->set_flashdata('success', 'Your product has been created.');
                        }
                    }

                    redirect('Products/productList');
                }
            } else {
                if ($last_id = $this->Product_Model->create_product()) {
                    if ($row = $this->Product_Model->get_product($last_id)) {

                        // * save user history
                        $track_id = 'product_id=' . $last_id;
                        $ip = $this->User_Model->get_ip();
                        $comment = 'added product: <b>' . $row['product_name'] . '</b>';
                        $this->Category_Model->user_history($track_id, $ip, $comment);

                        //* save sco url
                        $keyword = $row['seo_keyword'];
                        $this->ScoUrl_Model->saveSco($track_id, $keyword);
                        $this->session->set_flashdata('success', 'Your product has been created.');
                    }
                }

                redirect('Products/productList');
            }
            
        }
        
    }

    // * update product
    public function updateProduct($id)
    {
        $data['title'] = 'Update product';
        $data['product'] = $this->Product_Model->get_product($id);
        $data['categories'] = $this->Category_Model->get_categories();
        $data['sellers'] = $this->Product_Model->get_sellers();

        $this->load->view('generalTheme/header');
        $this->load->view('generalTheme/sidebar');
        $this->load->view('Products/update_product', $data);
        $this->load->view('generalTheme/footer');
    }

    // * updatea product data 
    public function updateProductData($id)
    {
        $data['title'] = 'Update product';
        $data['product'] = $this->Product_Model->get_product($id);
        $data['categories'] = $this->Category_Model->get_categories();
        $data['sellers'] = $this->Product_Model->get_sellers();

        // * Set validation rules
        $this->form_validation->set_rules('seller_id', 'Seller Name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('category_id', 'Category name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('product_name', 'Product name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('product_model', 'Product model', 'required|trim|xss_clean');
        $this->form_validation->set_rules('seo_keyword', 'Seo keyword', 'required|trim|xss_clean');
       

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('generalTheme/header');
            $this->load->view('generalTheme/sidebar');
            $this->load->view('Products/update_product', $data);
            $this->load->view('generalTheme/footer');
        } else {
            // * check unique value
            $product_model = $this->input->post('product_model');
            if ($this->Is_unique->check('product_model', 'tr_products', $product_model, $id)) {
                $data['img_error'] = "Please enter unique value in 'Product Model' field ";
                $this->load->view('generalTheme/header');
                $this->load->view('generalTheme/sidebar');
                $this->load->view('Products/update_product', $data);
                $this->load->view('generalTheme/footer');
            } else {
                // * remove image from folder
                if (file_exists('./assets/images/products/' . $data['product']['product_image'])) {
                    unlink('./assets/images/products/' . $data['product']['product_image']);
                }

                if ($_FILES['product_image']['size'] > 0) {
                    //* Upload Image
                    $this->load->library('upload');
                    $imgPath = './assets/images/products';
                    $name_parts = pathinfo($_FILES['product_image']['name']);
                    $name_full  = preg_replace('/\s+/', '', $name_parts['filename']);
                    $file_name  = $name_full . '-' . date('Ymd-his');

                    $config['upload_path'] = $imgPath;
                    $config['file_name'] = $file_name;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size'] = '2048';
                    $config['max_width'] = '2000';
                    $config['max_height'] = '2000';

                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('product_image')) {
                        $data['img_error'] = $this->upload->display_errors();

                        $this->load->view('generalTheme/header');
                        $this->load->view('generalTheme/sidebar');
                        $this->load->view('Products/update_product', $data);
                        $this->load->view('generalTheme/footer');
                    } else {
                        $data['upload_data'] = $this->upload->data();

                        $image = $data['upload_data']['file_name'];

                        if ($last_id = $this->Product_Model->update_product($id, $image)) {
                            if ($row = $this->Product_Model->get_product($last_id)) {
                                // *save user history
                                $track_id = 'updated_product_id=' . $last_id;
                                $ip = $this->User_Model->get_ip();
                                $comment = 'updated product: <b>' . $row['product_name'] . '<b>';

                                $this->Category_Model->user_history($track_id, $ip, $comment);

                                // * save sco url
                                $query = "product_id=" . $last_id;
                                $sco = $this->ScoUrl_Model->getSco($query);

                                $scoId = $sco->id;
                                $scoQuery = $sco->query;
                                $keyword = $row['seo_keyword'];
                                $this->ScoUrl_Model->updateSco($scoId, $scoQuery, $keyword);
                                $this->session->set_flashdata('success', 'Your product has been updated.');
                            }
                        }
                        redirect('Products/productList');
                    }
                } else {
                    if ($last_id = $this->Product_Model->update_product($id)) {
                        if ($row = $this->Product_Model->get_product($last_id)) {
                            // *save user history
                            $track_id = 'updated_product_id=' . $last_id;
                            $ip = $this->User_Model->get_ip();
                            $comment = 'updated product: <b>' . $row['product_name'] . '<b>';

                            $this->Category_Model->user_history($track_id, $ip, $comment);

                            // * save sco url
                            $query = "product_id=" . $last_id;
                            $sco = $this->ScoUrl_Model->getSco($query);

                            $scoId = $sco->id;
                            $scoQuery = $sco->query;
                            $keyword = $row['seo_keyword'];
                            $this->ScoUrl_Model->updateSco($scoId, $scoQuery, $keyword);
                            $this->session->set_flashdata('success', 'Your product has been updated.');
                        }
                    }
                    redirect('Products/productList');
                }
            }
        }
    }

    // * delete product
    public function delete_product()
    {
        $id = $this->input->post('chk');
        
        $track_id = $id;
        $ip = $this->User_Model->get_ip();
        // $comment = 'category updated id = ' . $last_id;
        $this->Product_Model->save_delete_history($track_id, $ip); //* save user history
        $this->ScoUrl_Model->deleteSco($id, "product_id="); //* save sco url
        if ($this->Product_Model->delete_product($id)) {

            $this->session->set_flashdata('success', 'Group has been deleted Successfully.');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    // * ajax pagination
    function ajaxPaginationProduct()
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
        // $totalRec = $this->Category_Model->get_categoriesPage(false, $conditions);
        $totalRec = $this->Product_Model->getProducPage(false, $conditions);
        // Get record count 

        // Pagination configuration 
        $config['target']      = '#dataList';
        $config['base_url']    = base_url('Product/ajaxPaginationProduct/');
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
        $data['products'] = $this->Product_Model->getProducPage(false, $conditions);
        $data['start'] = $offset;
        // Load the data list view 
        $this->load->view('products/ajaxdata', $data, false);
    }

}

?>