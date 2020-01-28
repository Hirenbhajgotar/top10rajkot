<?php
class MailTemplate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mail_template_model');
        $this->load->model('Category_Model');
        $this->load->model('Is_unique'); // * check unique value 
        $this->load->model('ScoUrl_Model'); // * sco url model
        $this->load->library('form_validation');
        $this->load->library('ajax_pagination');
        $this->perPage = 5;
    }

    // * mail template list
    public function listMailTemplate()
    {
        $data = array();

        $conditions['returnType'] = 'count';

        $totalRec = $this->Mail_template_model->getMailTemplatePage(false, $conditions);

        $config['target']      = '#dataList';
        $config['base_url']    = base_url('MailTemplate/ajaxPaginationProduct/');
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';

        $this->ajax_pagination->initialize($config);

        $conditions = array(
            'limit' => $this->perPage
        );
        $data['title'] = "Mail template list";
        $data['mailTemplates'] = $this->Mail_template_model->get_mail_template();

        $this->load->view('generalTheme/header');
        $this->load->view('generalTheme/sidebar');
        $this->load->view('mailTemplate/mail_template_list', $data);
        $this->load->view('generalTheme/footer');
    }

    // * add mail template
    public function addMailTemplate()
    {
        $data['title'] = "Add mail template";

        // * Set validation rules
        $this->form_validation->set_rules('shortcodes', 'Short codes', 'trim');
        $this->form_validation->set_rules('mail_title', 'Mail title', 'required|trim');
        $this->form_validation->set_rules('sort_order', 'Sort order', 'trim');
        $this->form_validation->set_rules('sms_notify', 'Sms notify', 'trim');
        $this->form_validation->set_rules('mail_notify', 'Mail notify', 'trim');
        $this->form_validation->set_rules('sms_content', 'Sms content', 'required|trim');
        $this->form_validation->set_rules('mail_content', 'Mail content', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('generalTheme/header');
            $this->load->view('generalTheme/sidebar');
            $this->load->view('mailTemplate/add_mail_template', $data);
            $this->load->view('generalTheme/footer');
        } else {
            if ($_FILES['mail_attachment']['size'] > 0) {
                //* Upload Image
                $this->load->library('upload');
                $imgPath = './assets/images/mail_template';
                $name_parts = pathinfo($_FILES['mail_attachment']['name']);
                $name_full  = preg_replace('/\s+/', '', $name_parts['filename']);
                $file_name  = $name_full . '-' . date('Ymd-his');

                $config['upload_path'] = $imgPath;
                $config['file_name'] = $file_name;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|word';
                $config['max_size'] = '2048';
                $config['max_width'] = '2000';
                $config['max_height'] = '2000';

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('mail_attachment')) {
                    $data['img_error'] = $this->upload->display_errors();
                    $this->load->view('generalTheme/header');
                    $this->load->view('generalTheme/sidebar');
                    $this->load->view('mailTemplate/add_mail_template', $data);
                    $this->load->view('generalTheme/footer');
                } else {
                    $data['upload_data'] = $this->upload->data();
                    $image = $data['upload_data']['file_name'];

                    if ($last_id = $this->Mail_template_model->add_mail_template($image)) {
                        if ($row = $this->Mail_template_model->get_mail_template($last_id)) {
                            // * save user history
                            $track_id = 'mail_template_id=' . $last_id;
                            $ip = $this->User_Model->get_ip();
                            $comment = 'added mail template: <b>' . $row['mail_title'] . '</b>';
                            $this->Category_Model->user_history($track_id, $ip, $comment);
                            $this->session->set_flashdata('success', 'Mail template has been created.');
                        }
                    }
                }
            } else {
                if ($last_id = $this->Mail_template_model->add_mail_template($image)) {
                    if ($row = $this->Mail_template_model->get_mail_template($last_id)) {
                        // * save user history
                        $track_id = 'mail_template_id=' . $last_id;
                        $ip = $this->User_Model->get_ip();
                        $comment = 'added mail template: <b>' . $row['mail_title'] . '</b>';
                        $this->Category_Model->user_history($track_id, $ip, $comment);
                        $this->session->set_flashdata('success', 'Mail template has been created.');
                    }
                }
            }
            redirect('MailTemplate/listMailTemplate');
        }
    }

    // * update mail template
    public function updateMailTemplate($id)
    {
        $data['title'] = "Update mail template";
        $data['mail_template'] = $this->Mail_template_model->get_mail_template($id);

        $this->load->view('generalTheme/header');
        $this->load->view('generalTheme/sidebar');
        $this->load->view('mailTemplate/update_mail_template', $data);
        $this->load->view('generalTheme/footer');
    }

    // * updatea mail templates data
    public function updateMailTemplateData($id)
    {
        $data['title'] = "Update mail template";
        $data['mail_template'] = $this->Mail_template_model->get_mail_template($id);

        // * Set validation rules
        $this->form_validation->set_rules('shortcodes', 'Short codes', 'trim');
        $this->form_validation->set_rules('mail_title', 'Mail title', 'required|trim');
        $this->form_validation->set_rules('sort_order', 'Sort order', 'trim');
        $this->form_validation->set_rules('sms_notify', 'Sms notify', 'trim');
        $this->form_validation->set_rules('mail_notify', 'Mail notify', 'trim');
        $this->form_validation->set_rules('sms_content', 'Sms content', 'required|trim');
        $this->form_validation->set_rules('mail_content', 'Mail content', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('generalTheme/header');
            $this->load->view('generalTheme/sidebar');
            $this->load->view('mailTemplate/update_mail_template', $data);
            $this->load->view('generalTheme/footer');
        } else {
            // * remove image from folder
            if (file_exists('./assets/images/mail_template/' . $data['prodmail_templateuct']['mail_attachment'])) {
                unlink('./assets/images/products/' . $data['prodmail_templateuct']['mail_attachment']);
            }
            if ($_FILES['mail_attachment']['size'] > 0) {
                //* Upload Image
                $this->load->library('upload');
                $imgPath = './assets/images/mail_template';
                $name_parts = pathinfo($_FILES['mail_attachment']['name']);
                $name_full  = preg_replace('/\s+/', '', $name_parts['filename']);
                $file_name  = $name_full . '-' . date('Ymd-his');

                $config['upload_path'] = $imgPath;
                $config['file_name'] = $file_name;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|word';
                $config['max_size'] = '2048';
                $config['max_width'] = '2000';
                $config['max_height'] = '2000';

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('mail_attachment')) {
                    $data['img_error'] = $this->upload->display_errors();
                    $this->load->view('generalTheme/header');
                    $this->load->view('generalTheme/sidebar');
                    $this->load->view('mailTemplate/update_mail_template', $data);
                    $this->load->view('generalTheme/footer');
                } else {
                    $data['upload_data'] = $this->upload->data();
                    $image = $data['upload_data']['file_name'];

                    if ($last_id = $this->Mail_template_model->update_mail_template($id, $image)) {
                        if ($row = $this->Mail_template_model->get_mail_template($last_id)) {
                            // * save user history
                            $track_id = 'mail_template_id=' . $last_id;
                            $ip = $this->User_Model->get_ip();
                            $comment = 'updated mail template: <b>' . $row['mail_title'] . '</b>';
                            $this->Category_Model->user_history($track_id, $ip, $comment);
                            $this->session->set_flashdata('success', 'Mail template has been updated.');
                        }
                    }
                }
            } else {
                if ($last_id = $this->Mail_template_model->update_mail_template($id, $image)) {
                    if ($row = $this->Mail_template_model->get_mail_template($last_id)) {
                        // * save user history
                        $track_id = 'mail_template_id=' . $last_id;
                        $ip = $this->User_Model->get_ip();
                        $comment = 'updated mail template: <b>' . $row['mail_title'] . '</b>';
                        $this->Category_Model->user_history($track_id, $ip, $comment);
                        $this->session->set_flashdata('success', 'Mail template has been updated.');
                    }
                }
            }
            redirect('MailTemplate/listMailTemplate');
        }
    }

    // * delete mail template
    public function deleteMailTemplate()
    {
        $id = $this->input->post('chk');

        $track_id = $id;
        $ip = $this->User_Model->get_ip();

        $this->Mail_template_model->save_delete_history($track_id, $ip); //* save user history
        if ($this->Mail_template_model->delete_mail_template($id)) {
            $this->session->set_flashdata('success', 'Group has been deleted Successfully.');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    // * ajax pagination 
    public function ajaxPaginationMailTemplate()
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
        $totalRec = $this->Mail_template_model->getMailTemplatePage(false, $conditions);
        // Get record count 

        // Pagination configuration 
        $config['target']      = '#dataList';
        $config['base_url']    = base_url('MailTemplate/ajaxPaginationMailTemplate/');
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
        $data['mailTemplates'] = $this->Mail_template_model->getMailTemplatePage(false, $conditions);
        $data['start'] = $offset;
        // Load the data list view 
        $this->load->view('mailTemplate/ajaxdata', $data, false);
    }
}
