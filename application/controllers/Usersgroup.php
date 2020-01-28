<?php
	class Usersgroup extends CI_Controller
	{
		public function __construct() {
        parent::__construct();
       $this->load->library('form_validation');
	   
	   $this->load->library('ajax_pagination');
	   
	   $this->perPage = 5; 
     }
	 
	 public function usergroup()
		{
		
			    $data = array(); 
				
				$conditions['returnType'] = 'count'; 
				
				$totalRec = $this->Usergroup_Model->get_groups(false, $conditions);
				 
				$config['target']      = '#dataList'; 
				$config['base_url']    = base_url('usergroup/ajaxPaginationData/'); 
				$config['total_rows']  = $totalRec;
				$config['per_page']    = $this->perPage;
                $config['link_func']   = 'searchFilter'; 				
	  
			    $this->ajax_pagination->initialize($config); 
				
				$conditions = array( 
                    'limit' => $this->perPage 
                ); 
				

				 $data['title'] = 'Latest Users';
				 $data['groups'] = $this->Usergroup_Model->get_groups(false, $conditions);
			

			 	 $this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom');
		   		 $this->load->view('usergroup/usergrouplist', $data);
		  		 $this->load->view('administrator/footer');
		}

         function ajaxPaginationData(){ 
			// Define offset 
			$page = $this->input->post('page'); 
	       
			
			if(!$page){ 
				$offset = 0; 
			}else{ 
				$offset = $page; 
			} 
			 $keywords = $this->input->post('keywords'); 
             $sortBy = $this->input->post('sortBy'); 
			if(!empty($keywords)){ 
				$conditions['search']['keywords'] = $keywords; 
			} 
			if(!empty($sortBy)){ 
				$conditions['search']['sortBy'] = $sortBy; 
			} 
			$conditions['returnType'] = 'count'; 
			$totalRec = $this->Usergroup_Model->get_groups(false, $conditions);
			// Get record count 
            
			// Pagination configuration 
			$config['target']      = '#dataList'; 
			$config['base_url']    = base_url('usergroup/ajaxPaginationData/'); 
			$config['total_rows']  = $totalRec; 
			$config['per_page']    = $this->perPage; 
			$config['link_func']   = 'searchFilter'; 
			 
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config); 
			 $conditions['start'] = $offset; 
             $conditions['limit'] = $this->perPage; 
             unset($conditions['returnType']); 
			
			// Get records 
			 $data['groups'] = $this->Usergroup_Model->get_groups(false, $conditions);
			 
			// Load the data list view 
		   	$this->load->view('usergroup/ajaxdata', $data, false);
		
			     
     } 




		public function addgroup($page = 'addgroup')
		  {
			if (!file_exists(APPPATH.'views/usergroup/'.$page.'.php')) {
		    show_404();
		    }
			
			
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}
			
			if(empty($this->input->post('name'))) {
				$data['name'] = '';
			}
				
			if($this->input->post('name')){
				$data['name'] = $this->input->post('name');	
			}
			
			if(empty($this->input->post('permission'))) {
				$data['permission'] = '';
			}
			
			if($this->input->post('permission')){
				$data['permission'] = $this->input->post('permission');	
			}
           			
		
			$data['title'] = 'Create UserGroup';
			
			//$this->form_validation->set_rules('name', 'Name', 'required');
			
			$this->form_validation->set_rules('permission', 'Permission', 'required|is_unique[tr_user_group.permission]');
			
			$this->form_validation-> set_rules('name','Name','required|is_unique[tr_user_group.name]');

			
			
			if($this->form_validation->run() === FALSE){
				 $this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom');
		   		 $this->load->view('usergroup/'.$page, $data);
		  		 $this->load->view('administrator/footer');
			}else{
				
				$user = $this->Usergroup_Model->add_group();
				$userid = $this->session->userdata();
                $ip = $this->User_Model->get_ip();
				$this->Usergroup_Model->save_usergroup_history($user, $userid, $ip);

				//Set Message
				$this->session->set_flashdata('success', 'Group has been created Successfull.');
				redirect('usersgroup/usersgroup');
			}
			
		}
		
		
		
		
		public function update_groups($id = NULL, $page = 'updategroups')
		
		{
			
			
		  if (!file_exists(APPPATH.'views/usergroup/'.$page.'.php')) {
		    show_404();
		  }
			
			$data['groups'] = $this->Usergroup_Model->get_groups($id);
			$data['unique'] = $this->Usergroup_Model->get_groupsss();
			
			
			if(empty($this->input->post('name'))) {
				$data['name'] = '';
			}
			else{
				$data['name'] = $this->input->post('name');	
			}
			
			
			
			if(empty($this->input->post('permission'))) {
				$data['permission'] = '';
			}
			else{
				$data['permission'] = $this->input->post('permission');	
			}
			
			if(empty($this->input->post('status'))) {
				$data['status'] = 0;
			}
			else{
				$data['status'] = $this->input->post('status');	
			}
			
			if(empty($this->input->post('id'))) {
				$data['id'] = '';
			}
			else{
				$data['id'] = $this->input->post('id');	
			}
			

			$data['title'] = 'Update User';
			$name = $this->Usergroup_Model->chkname();
			$permission = $this->Usergroup_Model->chkpermission();
			if($name == 1){
				
				$this->form_validation->set_rules('name', 'Name', 'trim|xss_clean|required|is_unique[tr_user_group.name]');
			}
			
			if($permission == 1){
				
				$this->form_validation->set_rules('permission', 'Permission', 'trim|xss_clean|required|is_unique[tr_user_group.permission]');
			}
			
			$this->form_validation-> set_rules('name','Name','required');
			$this->form_validation->set_rules('permission', 'Permission', 'required');

			if($this->form_validation->run() === FALSE){
				
				 $this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom');
		   		 $this->load->view('usergroup/'.$page, $data);
		  		 $this->load->view('administrator/footer');
			}else{
				
				$user = $this->Usergroup_Model->update_group_data();
				
				$userid = $this->session->userdata();
                $ip = $this->User_Model->get_ip();
				$this->Usergroup_Model->update_usergroup_history($user, $userid, $ip);

				//Set Message
				$this->session->set_flashdata('success', 'Groups has been Updated Successfull.');
				redirect('usersgroup/usergroup');
			}

		}
		
		
		public function deletegroups()
		{
			
			$id = $this->input->post('chk');
			$userid = $this->session->userdata();
            $ip = $this->User_Model->get_ip();
			$this->Usergroup_Model->deletegroups($id);
            $this->Usergroup_Model->save_delete_history($id, $userid, $ip);					
			
			$this->session->set_flashdata('success', 'Group has been deleted Successfully.');
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			
	    }
		
		public function enable($id)
		{
			$table = base64_decode($this->input->get('table'));
			//$table = $this->input->post('table');
			$this->Usergroup_Model->enable($id,$table);       
			$this->session->set_flashdata('success', 'Desabled Successfully.');
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		public function desable($id)
		{
			
			$table = base64_decode($this->input->get('table'));
			//$table = $this->input->post('table');
			$this->Usergroup_Model->desable($id,$table);       
			$this->session->set_flashdata('success', 'Enabled Successfully.');
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		
	}