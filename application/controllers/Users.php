<?php
class Users extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');

		$this->load->library('ajax_pagination');

		$this->perPage = 5;
	}

	public function dashboard()
	{
		if (!$this->session->userdata('login')) {
			redirect('login');
		}
		
		$data['title'] = 'Dashboard';

		$this->load->view('templates/header');
		$this->load->view('users/dashboard', $data);
		$this->load->view('templates/footer');
	}


	public function add_user($page = 'add-user')
	{

		if (!file_exists(APPPATH . 'views/users/' . $page . '.php')) {
			show_404();
		}

		// Check login
		if (!$this->session->userdata('login')) {
			redirect('administrator/index');
		}

		$data['title'] = 'Create User';

		$data['usergroups'] = $this->User_Model->get_usergroup();


		//$data['add-user'] = $this->Administrator_Model->get_categories();

		$this->form_validation->set_rules('firstname', 'Firstname', 'required');

		$this->form_validation->set_rules('lastname', 'Lastname', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');

		$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
		//$this->form_validation->set_rules('contact', 'Contact', 'required|callback_check_contact_exists');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('confirmPassword', 'ConfirmPassword', 'required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		//$this->form_validation->set_rules('userfile', 'Userfile', 'required');
		$this->form_validation->set_rules('confirmPassword', 'Password Confirmation', 'trim|required|matches[password]');

		if (empty($this->input->post('firstname'))) {
			$data['firstname'] = '';
		} else {
			$data['firstname'] = $this->input->post('firstname');
		}

		if (empty($this->input->post('lastname'))) {
			$data['lastname'] = '';
		} else {
			$data['lastname'] = $this->input->post('lastname');
		}

		if (empty($this->input->post('username'))) {
			$data['username'] = '';
		} else {
			$data['username'] = $this->input->post('username');
		}

		if (empty($this->input->post('email'))) {
			$data['email'] = '';
		} else {
			$data['email'] = $this->input->post('email');
		}

		if (empty($this->input->post('contact'))) {
			$data['contact'] = '';
		} else {
			$data['contact'] = $this->input->post('contact');
		}

		if (empty($this->input->post('gender'))) {
			$data['gender'] = '0';
		} else {
			$data['gender'] = $this->input->post('gender');
		}

		if (empty($this->input->post('status'))) {
			$data['status'] = '0';
		} else {
			$data['status'] = $this->input->post('status');
		}

		if (empty($this->input->post('user_group_id'))) {
			$data['user_group_id'] = '';
		} else {
			$data['user_group_id'] = $this->input->post('user_group_id');
		}





		if ($this->form_validation->run() === FALSE) {
			$this->load->view('administrator/header-script');
			$this->load->view('administrator/header');
			$this->load->view('administrator/header-bottom');
			$this->load->view('users/' . $page, $data);
			$this->load->view('administrator/footer');
		} else {
			//Upload Image
			$config['upload_path'] = './assets/images/users';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '2048';
			$config['max_width'] = '2000';
			$config['max_height'] = '2000';

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload()) {
				$errors =  array('error' => $this->upload->display_errors());
				$post_image = 'noimage.jpg';
			} else {
				$data =  array('upload_data' => $this->upload->data());
				$post_image = $_FILES['userfile']['name'];
			}
			$user = $this->User_Model->add_user($post_image);
			$userid = $this->session->userdata();
			$ip = $this->User_Model->get_ip();
			$this->User_Model->save_history($user, $userid, $ip);
			//Set Message
			$this->session->set_flashdata('success', 'User has been created Successfull.');
			redirect('users/users');
		}
	}

	public function users()
	{

		$data = array();

		$conditions['returnType'] = 'count';

		$totalRec = $this->User_Model->get_users(false, $conditions);

		$config['target']      = '#dataList';
		$config['base_url']    = base_url('users/ajaxPaginationuser/');
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		$config['link_func']   = 'searchFilter';

		// Init Pagination
		$this->ajax_pagination->initialize($config);

		$conditions = array(
			'limit' => $this->perPage
		);


		$data['title'] = 'Latest Users';

		$data['users'] = $this->User_Model->get_users(false, $conditions);


		$this->load->view('administrator/header-script');
		$this->load->view('administrator/header');
		$this->load->view('administrator/header-bottom');
		$this->load->view('users/users', $data);
		$this->load->view('administrator/footer');
	}


	function ajaxPaginationuser()
	{

		// Define offset 
		$page = $this->input->post('page');

		// echo '<pre>';
		// print_r($page);
		// echo '</pre>';
		// exit;
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
		$totalRec = $this->User_Model->get_users(false, $conditions);
		// Get record count 

		// Pagination configuration 
		$config['target']      = '#dataList';
		$config['base_url']    = base_url('users/ajaxPaginationuser/');
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		$config['link_func']   = 'searchFilter';

		// Initialize pagination library 
		$this->ajax_pagination->initialize($config);
		$conditions['start'] = $offset;
		$conditions['limit'] = $this->perPage;
		unset($conditions['returnType']);

		// Get records 
		$data['users'] = $this->User_Model->get_users(false, $conditions);

		// Load the data list view 
		$this->load->view('users/ajaxdatauser', $data, false);
	}



	public function update_user_data($id = NULL, $page = 'update-user')
	{
		if (!$this->session->userdata('login')) {
			redirect('administrator/index');
		}

		if (!file_exists(APPPATH . 'views/users/' . $page . '.php')) {
			show_404();
		}


		$data['user'] = $this->User_Model->get_user($id);
		$data['usergroups'] = $this->User_Model->get_usergroup();



		// Check login


		$data['title'] = 'Update User';



		$this->form_validation->set_rules('firstname', 'Firstname', 'required');

		$this->form_validation->set_rules('lastname', 'Lastname', 'required');


		$checkusername = $this->User_Model->chkusername();
		$chkemail = $this->User_Model->chkemail();
		$chkmobile = $this->User_Model->chkmobile();
		if ($checkusername == 1) {

			$this->form_validation->set_rules('username', 'Username', 'trim|xss_clean|required|is_unique[tr_user.username]');
		}

		if ($chkemail == 1) {

			$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|required|is_unique[tr_user.email]');
		}
		if ($chkmobile == 1) {

			$this->form_validation->set_rules('contact', 'Contact', 'trim|xss_clean|required|is_unique[tr_user.mobile]');
		}


		$this->form_validation->set_rules('gender', 'Gender', 'required');


		$this->form_validation->set_rules('password', 'Password', 'required');

		$this->form_validation->set_rules('confirmPassword', 'ConfirmPassword', 'required');



		$this->form_validation->set_rules('confirmPassword', 'Password Confirmation', 'trim|required|matches[password]');

		if (empty($_FILES['userfile']['name'])) {
			$this->form_validation->set_rules('userfile', 'Userfile', 'required');
		}


		if (empty($this->input->post('id'))) {
			$data['id'] = '';
		} else {
			$data['id'] = $this->input->post('id');
		}

		if (empty($this->input->post('firstname'))) {
			$data['firstname'] = '';
		} else {
			$data['firstname'] = $this->input->post('firstname');
		}

		if (empty($this->input->post('lastname'))) {
			$data['lastname'] = '';
		} else {
			$data['lastname'] = $this->input->post('lastname');
		}

		if (empty($this->input->post('username'))) {
			$data['username'] = '';
		} else {
			$data['username'] = $this->input->post('username');
		}

		if (empty($this->input->post('email'))) {
			$data['email'] = '';
		} else {
			$data['email'] = $this->input->post('email');
		}

		if (empty($this->input->post('contact'))) {
			$data['contact'] = '';
		} else {
			$data['contact'] = $this->input->post('contact');
		}

		if (empty($this->input->post('userfile'))) {
			$data['userfile'] = '';
		} else {
			$data['userfile'] = $this->input->post('userfile');
		}

		if (empty($this->input->post('gender'))) {
			$data['gender'] = '0';
		} else {
			$data['gender'] = $this->input->post('gender');
		}

		if (empty($this->input->post('status'))) {
			$data['status'] = '0';
		} else {
			$data['status'] = $this->input->post('status');
		}

		if (empty($this->input->post('user_group_id'))) {
			$data['user_group_id'] = '';
		} else {
			$data['user_group_id'] = $this->input->post('user_group_id');
		}

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('administrator/header-script');
			$this->load->view('administrator/header');
			$this->load->view('administrator/header-bottom');
			$this->load->view('users/' . $page, $data);
			$this->load->view('administrator/footer');
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
				$data['img'] = $this->User_Model->get_user($id);
				$errors =  array('error' => $this->upload->display_errors());
				$post_image = $data['img']['image'];
			} else {
				$data =  array('upload_data' => $this->upload->data());
				$post_image = $_FILES['userfile']['name'];
			}

			$user = $this->User_Model->update_user_data($post_image);
			$userid = $this->session->userdata();
			$ip = $this->User_Model->get_ip();
			$this->User_Model->save_update_history($user, $userid, $ip);

			//Set Message
			$this->session->set_flashdata('success', 'User has been Updated Successfull.');
			redirect('users/users');
		}
	}

	public function delete()
	{
		$id = $this->input->post('chk');
		$userid = $this->session->userdata();
		$ip = $this->User_Model->get_ip();
		$this->User_Model->delete($id);
		$this->User_Model->save_delete_history($id, $userid, $ip);
		$this->session->set_flashdata('success', 'Data has been deleted Successfully.');
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

	public function enable($id)
	{
		$table = base64_decode($this->input->get('table'));
		//$table = $this->input->post('table');
		$this->User_Model->enable($id, $table);
		$this->session->set_flashdata('success', 'Desabled Successfully.');
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

	public function desable($id)
	{

		$table = base64_decode($this->input->get('table'));
		//$table = $this->input->post('table');
		$this->User_Model->desable($id, $table);
		$this->session->set_flashdata('success', 'Enabled Successfully.');
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}


	// Register User
	public function register()
	{
		if ($this->session->userdata('login')) {
			redirect('posts');
		}

		$data['title'] = 'Sign Up';

		$this->form_validation->set_rules('firstname', 'First Name', 'required|trim|xss_clean');
		$this->form_validation->set_rules('lastname', 'Last Name', 'required|trim|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists|is_unique[tr_buyer.email]');
		$this->form_validation->set_rules('mobile', 'Mobile no', 'required|trim|xss_clean|exact_length[10]|numeric');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'matches[password]|trim|xss_clean');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header');
			$this->load->view('users/register', $data);
			$this->load->view('templates/footer');
		} else {
			//Encrypt Password
			$encrypt_password = md5($this->input->post('password'));
			$this->User_Model->register($encrypt_password);

			//Set Message
			$this->session->set_flashdata('user_registered', 'You are registered and can log in.');
			redirect('posts');
		}
	}

	// Log in User
	public function login()
	{
		$data['title'] = 'Sign In';

		$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header');
			$this->load->view('users/login', $data);
			$this->load->view('templates/footer');
		} else {
			// get username and Encrypt Password
			$email = $this->input->post('email');
			$encrypt_password = md5($this->input->post('password'));

			$user_id = $this->User_Model->login($email, $encrypt_password);
			
			if ($user_id) {
				//Create Session
				$user_data = array(
					'id' => $user_id->id,
					'email' => $user_id->email,
					'login' => true
				);

				$this->session->set_userdata($user_data);

				//Set Message
				$this->session->set_flashdata('user_loggedin', 'You are now logged in.');
				// redirect('users/dashboard');
				redirect(base_url());
			} else {
				$this->session->set_flashdata('login_failed', 'Login is invalid.');
				redirect('login');
			}
		}
	}

	
	// log user out
	public function logout()
	{
		// unset user data
		$this->session->unset_userdata('login');
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('email');

		//Set Message
		$this->session->set_flashdata('user_loggedout', 'You are logged out.');
		redirect(base_url());
	}


	// Check user name exists
	public function check_username_exists($username)
	{
		$this->form_validation->set_message('check_username_exists', 'That username is already taken, Please choose a different one.');

		if ($this->User_Model->check_username_exists($username)) {
			return true;
		} else {
			return false;
		}
	}


	// Check Email exists
	public function check_email_exists($email)
	{
		$this->form_validation->set_message('check_email_exists', 'This email is already registered.');

		if ($this->User_Model->check_email_exists($email)) {
			return true;
		} else {
			return false;
		}
	}

}
