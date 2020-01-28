<?php 
class Admin extends CI_Controller
{
    public function index()
    {
        $this->load->view('generalTheme/header');
        $this->load->view('generalTheme/sidebar');
        $this->load->view('admin/deshbord');
        $this->load->view('generalTheme/footer');
    }

    // * update profile
    public function update_profile()
    {
        $data['user'] = $this->Administrator_Model->get_admin_data();
        $data['title'] = 'Update Profile';
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // exit;
        // $this->load->view('administrator/header-script');
        // $this->load->view('administrator/header');
        // $this->load->view('administrator/header-bottom');
        // $this->load->view('administrator/update-profile', $data);
        // $this->load->view('administrator/footer');
        $this->load->view('generalTheme/header');
        $this->load->view('generalTheme/sidebar');
        $this->load->view('admin/change_profile', $data);
        $this->load->view('generalTheme/footer');
    }

    // * update admin profile data
    public function updateAdminProfileData()
    {
        // if (!file_exists(APPPATH . 'views/administrator/' . $page . '.php')) {
        //     show_404();
        // }
        // echo '<pre>';
        // print_r($this->input->post());
        // echo '</pre>';
        // exit;
        //* Check login
        if (!$this->session->userdata('login')) {
            redirect('administrator/index');
        }

        $data['title'] = 'Update Profile';

        //$data['add-user'] = $this->Administrator_Model->get_categories();

        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('generalTheme/header');
            $this->load->view('generalTheme/sidebar');
            $this->load->view('admin/change_profile', $data);
            $this->load->view('generalTheme/footer');
        } else {
            //Upload Image

            $config['upload_path'] = './assets/images/users';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '2048';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $id = $this->input->post('id');
                $data['img'] = $this->Administrator_Model->get_user($id);
                $errors =  array('error' => $this->upload->display_errors());
                $post_image = $data['img']['image'];
            } else {
                $data =  array('upload_data' => $this->upload->data());
                $post_image = $_FILES['userfile']['name'];
            }

            $this->Administrator_Model->update_user_data($post_image);

            //Set Message
            $this->session->set_flashdata('success', 'User has been Updated Successfull.');
            redirect('Admin/update_profile');
        }
    }
}

?>