<?php 
class Auth extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model("frontend/Auth_model");
        $this->load->library('form_validation');
        $this->load->model('Is_unique'); // * check unique value
        $this->load->library('ajax_pagination');
        
        $this->perPage = 5;
    }
    
    // * login
    public function login()
    {
		echo'ok';
		exit; 	
        $data['title'] = 'Sign In';

        $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('frontend/theme/default/templates/header');
            $this->load->view('frontend/theme/default/auth/login', $data);
            $this->load->view('frontend/theme/default/templates/footer');
        } else {
            // get username and Encrypt Password
            $email = $this->input->post('email');
            $encrypt_password = md5($this->input->post('password'));

            $auth_id = $this->Auth_model->login($email, $encrypt_password);
           
            if ($auth_id) {
                //Create Session
                $authenticated_data = array(
                    'auth_id' => $auth_id->id,
                    'auth_email' => $auth_id->email,
                    'auth_login' => true
                );

                $this->session->set_userdata($authenticated_data);

                //Set Message
                $this->session->set_flashdata('success', 'You are now logged in.');
                // redirect('users/dashboard');
                redirect(base_url());
            } else {
                $this->session->set_flashdata('error', 'Login is invalid.');
                redirect('login');
            }
        }
    }

    // * logout
    public function logout()
    {
        // unset user data
        $this->session->unset_userdata('authenticated_buyer_mobile');
        $this->session->unset_userdata('authenticated_buyer_id');
        // $this->session->unset_userdata('auth_id');
        // $this->session->unset_userdata('auth_email');
        // $this->session->unset_userdata('auth_login');

        //Set Message
        $this->session->set_flashdata('user_loggedout', 'You are logged out.');
        redirect(base_url());
    }

    // * register
    public function register()
    {
        if ($this->session->userdata('login')) {
            redirect('posts');
        }

        $data['metaData'] = $this->Settings_model->get_settings();

        $data['title'] = 'Sign Up';
        
        $this->form_validation->set_rules('first_name', 'First Name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[tr_buyer.email]');
        $this->form_validation->set_rules('mobile_no', 'Mobile no', 'required|trim|xss_clean|exact_length[10]|numeric');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'matches[password]|trim|xss_clean');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('frontend/theme/default/templates/header', $data);
            $this->load->view('frontend/theme/default/auth/register');
            $this->load->view('frontend/theme/default/templates/footer');
        } else {
            //Encrypt Password
            $encrypt_password = md5($this->input->post('password'));
            // $this->User_Model->register($encrypt_password);
            $this->Auth_model->register($encrypt_password);

            //Set Message
            $this->session->set_flashdata('user_registered', 'You are registered and can log in.');
            redirect(base_url());
        }
    }

    public function check_mobile_exist()
    {
        header('Access-Control-Allow-Origin: *');
        $this->load->helper('string');
        $mobile = $this->input->post('mobile_no');
        $query = $this->db->where('mobile_no', $mobile)
                          ->get(DB_BUYER);

        if ($query->num_rows() > 0) {
            // $this->session->set_userdata($mobile);
            $this->session->unset_userdata('otp');
            $this->session->set_userdata('otp', random_string('numeric', 6));
            $this->session->unset_userdata('registered');
            $this->session->set_userdata('registered', true);
            
            echo $this->session->userdata('otp');
            echo '<br>';
            echo 1;
        } else {
            echo 0;
        }
    }


    // * store buyer's information
    public function store_buyer_info()
    {
        header('Access-Control-Allow-Origin: *');
        $this->load->helper('string');
        // $otp = random_string('numeric', 6);
        // $auth_sess_data = [
        //     'authenticated_buyer_mobile' => $this->input->post('mobile_no'),
        //     'auth_name_verify' => $this->input->post('name'),
        //     'auth_email_verify' => $this->input->post('email'),
        //     'auth_city_verify' => $this->input->post('city')
        // ];
        // $this->session->set_userdata($auth_sess_data);
        $this->session->unset_userdata('otp');
        $this->session->set_userdata('otp', random_string('numeric', 6));
        // $this->session->unset_userdata('otp');
        echo $this->session->userdata('otp');
        echo '<br>';
        echo 1;
    }

    // *otp verification
    public function otp_verification()
    {
        header('Access-Control-Allow-Origin: *');
        $otp = $this->input->post('otp');
        if ($this->session->userdata('otp') == $otp) {
            // $this->session->unset_userdata('registered');
            // #check buyer is login or not
            if ($this->session->userdata('registered')) {
                $buyer_mobile = $this->input->post('mobile_no');
                $where = ['mobile_no' => $buyer_mobile];
                $buyer_data = $this->Auth_model->get_buyer($where);
                
                // #set buyer mobile number on session
                $this->session->set_userdata('authenticated_buyer_mobile', $buyer_mobile);
                $this->session->set_userdata('authenticated_buyer_id', $buyer_data->id);
                
                // #set buyer history
                $this->Auth_model->set_buyer_history($buyer_mobile);
                $this->session->unset_userdata('registered');
            } else {
                $this->session->unset_userdata('registered');

                $buyer_mobile = $this->input->post('mobile_no');
                $this->session->set_userdata('authenticated_buyer_mobile', $buyer_mobile);
                $this->Auth_model->register();
            }
            echo json_encode(['verify' => 'data_verify', 'buyer_id' => $buyer_data->id]);
            // echo 'verify';
        } else {
            echo "not_verify";
        }
    }


    // *resend otp
    public function resend_otp()
    {
        $this->load->helper('string');
        $this->session->unset_userdata('otp');
        $this->session->set_userdata('otp', random_string('numeric', 6));
        // echo random_string('numeric', 6);
        echo $this->session->userdata('otp');
    }


    // * buyer inquiry
    public function buyer_inquiry()
    {
        $buyer_inquiry = $this->security->xss_clean(trim($this->input->post('buyer_inquiry')));
        $seller_id = $this->security->xss_clean(trim($this->input->post('seller_id_input')));
        $category_id = $this->security->xss_clean(trim($this->input->post('category_id_input')));
        $buyer_id = $this->security->xss_clean(trim($this->input->post('buyer_id_input')));
        
        $data = [
            'buyer_inquiry' => $buyer_inquiry,
            'seller_id' => $seller_id,
            'category_id' => $category_id,
            'buyer_id' => $buyer_id,
        ];
        if ($this->Auth_model->set_buyer_to_leads($data)) {
            echo 1;
        } else {
            echo 0;
        }

    }

    // * show profile
    public function profile($id = '')
    {
        $where = ['id' => $id];
        $data['title'] = 'My profile';
        $data['buyer_data'] = $this->Auth_model->get_buyer($where);
       
        $this->load->view('frontend/theme/default/templates/header');
        $this->load->view('frontend/theme/default/auth/profile', $data);
        $this->load->view('frontend/theme/default/templates/footer');
    }

    // * update profile
    public function update_profile($id = '')
    {
        $where = ['id' => $id];
        $data['title'] = 'Update profile';
        $data['buyer_data'] = $this->Auth_model->get_buyer($where);

        // * set validation rules
        $this->form_validation->set_rules('first_name', 'First Name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|callback_check_email_exists['.$id.']');
        $this->form_validation->set_rules('mobile_no', 'Mobile no', 'required|trim|xss_clean|exact_length[10]|numeric');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'matches[password]|trim|xss_clean');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('frontend/theme/default/templates/header');
            $this->load->view('frontend/theme/default/auth/update_profile', $data);
            $this->load->view('frontend/theme/default/templates/footer');
        } else {
            //Encrypt Password
            $encrypt_password = md5($this->input->post('password'));
            
            if ($this->Auth_model->update_profile($id, $encrypt_password)) {
                //Set Message
                $this->session->set_flashdata('success', 'You profile has been updated.');
                redirect("My-profile/$id");
            } else {
                $this->session->set_flashdata('error', 'Somthing went wrong Please try again latter!.');
                redirect("update-profile/{$id}");
            }        
        }
    }

    // * check email exist
    public function check_email_exists($email, $id)
    {
        $this->form_validation->set_message('check_email_exists', 'This email is already taken by someone.');

        if ($this->Is_unique->check('email', 'tr_buyer', $email, $id)) {
            return false;
        } else {
            return true;
        }
    }

    // * check data exist or not
    public function check_data_exist($data)
    {
        $this->form_validation->set_message('check_data_exist', 'This email is not registered Please enter registered email.');
        $item = ['email' => $data];
        if ($this->Auth_model->check_data_exist($item)) {
            return true;
        } else {
            return false;
        }
    }


    // * change password
    public function change_password($id = '')
    {
        $data['title'] = "Change password";
        $data['id'] = $id;

        // *set validation rules
        $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'matches[password]|trim|xss_clean');

        if ($this->form_validation->run() === false) {
            $this->load->view('frontend/theme/default/templates/header');
            $this->load->view('frontend/theme/default/auth/change_password', $data);
            $this->load->view('frontend/theme/default/templates/footer');
        } else {
            $encrypt_password = md5($this->input->post('password'));
            $where = ['id' => $id];
            $set_field = ['password' => $encrypt_password];
            
            if ($this->Auth_model->change_password($where, $set_field)) {
                $this->session->set_flashdata('success', 'You password has been updated.');
                redirect("My-profile/$id");
            } else {
                $this->session->set_flashdata('error', 'Somthing went wrong Please try again latter!.');
                redirect("My-profile/{$id}");
            }
        }
        

    }


    // * forgot password
    public function forgot_password()
    {
        $data['title'] = "Forgot password";
        $email = $this->input->post('email');

        $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|callback_check_data_exist');
        // $this->form_validation->set_rules($config['check_email']);
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('frontend/theme/default/templates/header');
            $this->load->view('frontend/theme/default/auth/forgot_password', $data);
            $this->load->view('frontend/theme/default/templates/footer');
        } else {
            $this->session->set_userdata('verifies_email', $email);
            redirect("verify-otp",'refresh');
        }
    }

    

    // * verify otp
    public function verify_otp()
    {
        // $verifies_email = $this->session->userdata('verifies_email');

        $this->form_validation->set_rules('otp', 'Otp', 'required|trim|xss_clean');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('frontend/theme/default/templates/header');
            $this->load->view('frontend/theme/default/auth/input_otp');
            $this->load->view('frontend/theme/default/templates/footer');
        } else {
            $opt = $this->input->post('otp');
            $verify_opt = true;

            if ($verify_opt) {
                redirect('new-password','refresh');                
            } else {
                echo 'otp not verify';
            }
        }
    }


    // * new password
    public function new_password()
    {
        $data['title'] = 'New password';
        $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean');
        $this->form_validation->set_rules('comfirm_password', 'Confirm password', 'required|trim|xss_clean|matches[password]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('frontend/theme/default/templates/header');
            $this->load->view('frontend/theme/default/auth/new_password', $data);
            $this->load->view('frontend/theme/default/templates/footer');
        } else {
            $encrypt_password = md5($this->input->post('password'));
            $where = ['email' => $this->session->userdata('verifies_email')];
            $set_field = ['password' => $encrypt_password];
            if ($this->Auth_model->change_password($where, $set_field)) {
                // echo 'success';
                $this->session->set_flashdata('success', 'Your password have been changed.');
                redirect('login','refresh');
            } else {
                // echo 'false';
                $this->session->set_flashdata('error', 'Somthing went wrong please try again latter.');
                redirect('login','refresh');
            }
            // * unset verify email
            $this->session->unset_userdata('verifies_email');
        }
    }




}

?>