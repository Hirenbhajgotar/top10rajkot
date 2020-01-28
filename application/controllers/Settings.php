<?php 
class Settings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Settings_model');
        $this->load->model('Category_Model');
        $this->load->model('Is_unique'); // * check unique value 
        $this->load->model('ScoUrl_Model'); // * sco url model

        $this->load->library('form_validation');

        $this->load->library('ajax_pagination');

        $this->perPage = 5;
    }

    public function index()
    {
        $data['title'] = 'Settings';
        $data['settings'] = $this->Settings_model->get_settings();
        
        $this->load->view('generalTheme/header');
        $this->load->view('generalTheme/sidebar');
        $this->load->view('settings/setting_list', $data);
        $this->load->view('generalTheme/footer');
    }

    // * edit settings
    public function editSettings()
    {
        $data = [];
        $data['title'] = 'Settings';
        $data['settings'] = $this->Settings_model->get_settings();

        // * Set validation rules
        $this->form_validation->set_rules('store_name', 'Store Name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('store_owner', 'Store owner', 'required|trim|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean');
        $this->form_validation->set_rules('telephone', 'Telephone', 'required|trim|xss_clean');
        $this->form_validation->set_rules('meta_key_word', 'Meta key word', 'required|trim|xss_clean');
        $this->form_validation->set_rules('meta_title', 'Meta title', 'required|trim|xss_clean');
        $this->form_validation->set_rules('geocode', 'Geocode', 'required|trim|xss_clean');
        $this->form_validation->set_rules('maintenance_mode', 'Maintenance_mode', 'required|trim|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'required|trim|xss_clean');
        $this->form_validation->set_rules('meta_tag_description', 'Meta_tag_description', 'required|trim|xss_clean');
        $this->form_validation->set_rules('mail_protocol', 'Mail protocol', 'required|trim|xss_clean');
        $this->form_validation->set_rules('mail_perameter', 'Mail perameter', 'required|trim|xss_clean');
        $this->form_validation->set_rules('smtp_hostname', 'Smtp hostname', 'required|trim|xss_clean');
        $this->form_validation->set_rules('smtp_username', 'Smtp username', 'required|trim|xss_clean');
        $this->form_validation->set_rules('smtp_password', 'Smtp password', 'required|trim|xss_clean');
        $this->form_validation->set_rules('smtp_port', 'Smtp port', 'required|trim|xss_clean');
        $this->form_validation->set_rules('smtp_timeout', 'Smtp timeout', 'required|trim|xss_clean');
        $this->form_validation->set_rules('per_page_limit', 'per page limit', 'required|trim|xss_clean');
       
        if ($this->form_validation->run() === false) {
            $this->load->view('generalTheme/header');
            $this->load->view('generalTheme/sidebar');
            $this->load->view('settings/setting_list', $data);
            $this->load->view('generalTheme/footer');
        } else {
            // * remove logo image from folder
            if (file_exists('./assets/images/site_logo/' . $data['settings'][4]->value)) {
                unlink('./assets/images/site_logo/' . $data['settings'][4]->value);
            }
            // * remove fevicon icon from folder
            if (file_exists('./assets/images/fevicon_icon/' . $data['settings'][5]->value)) {
                unlink('./assets/images/fevicon_icon/' . $data['settings'][5]->value);
            }

            //* Upload Logo Image
            $imgPath = './assets/images/site_logo';
            $name_parts = pathinfo($_FILES['logo']['name']);
            $name_full  = preg_replace('/\s+/', '', $name_parts['filename']);
            $file_name  = $name_full . '-' . date('Ymd-his');

            $config['upload_path'] = $imgPath;
            $config['file_name'] = $file_name;
            $config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
            $config['max_size'] = '2048';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';

            $this->load->library('upload', $config, 'logo_image_upload');
            $this->logo_image_upload->initialize($config);
            $logo_image = $this->logo_image_upload->do_upload('logo');
           


            //* Upload fevicon icon
            $imgPath = './assets/images/fevicon_icon';
            $name_parts = pathinfo($_FILES['icon']['name']);
            $name_full  = preg_replace('/\s+/', '', $name_parts['filename']);
            $file_name  = $name_full . '-' . date('Ymd-his');

            $config['upload_path'] = $imgPath;
            $config['file_name'] = $file_name;
            $config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
            $config['max_size'] = '2048';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';

            $this->load->library('upload', $config, 'fevicon_icon_image_upload');
            $this->fevicon_icon_image_upload->initialize($config);
            $icon_image = $this->fevicon_icon_image_upload->do_upload('icon');

            if (!$logo_image AND !$icon_image) {
                $data['img_error'] = $this->logo_image_upload->display_errors();
                $data['img_error'] = $this->fevicon_icon_image_upload->display_errors();
                $this->load->view('generalTheme/header');
                $this->load->view('generalTheme/sidebar');
                $this->load->view('settings/setting_list', $data);
                $this->load->view('generalTheme/footer');
            } else {
                $logo_image_data = $this->logo_image_upload->data();
                $fevicon_icon_image_data = $this->fevicon_icon_image_upload->data();

                // * site logo image
                $site_logo = $logo_image_data['file_name'];
                // * fevicon icon
                $fev_icon = $fevicon_icon_image_data['file_name'];

                if ($this->Settings_model->insert_settings($site_logo, $fev_icon)) {
                    $this->session->set_flashdata('success', 'Your settings has been saved.');
                }                
                redirect('Settings/index');
            }

        }

    }

    
}

?>