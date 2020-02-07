<?php
class Change_password extends CI_Controller
{

	public function __construct()
	{
		
		parent::__construct();
		$this->load->helper('text');
		$this->load->library('form_validation');
		 $where = ['key' => 'other_per_page_limit'];
        global $per_page; //* declare global var
        $per_page = $this->Settings_model->get_settings($where);
        $this->perPage = $per_page->value; 
		$this->load->model('frontend/Changepassword');
		$this->load->library('ajax_pagination');
		
		
		  
	}
	
	
	
	public function change($id, $page = 'change_password')
    {
		$u_id = $id;
		$data['id'] = $u_id;
		
		$data['metaData'] = $this->Settings_model->get_settings();
		
		$data['metaData']['title'] = $data['metaData'][7]->value;
        $data['metaData']['description'] = $data['metaData'][11]->value;
        $data['metaData']['keyword'] = $data['metaData'][6]->value;
        $data['metaData']['icon'] = $data['metaData'][5]->value;
        $data['metaData']['logo'] = $data['metaData'][4]->value;
			
			$this->form_validation->set_rules('old_p', 'Old Password', 'required');
			$this->form_validation->set_rules('new_p', 'New Password', 'required');
			$this->form_validation->set_rules('confirm_p', 'Confirm New Password', 'required|matches[new_p]');
			$password = $this->input->post('old_p');
			
			 
			if($this->form_validation->run() === FALSE){
				
		 	 	 $this->load->view('frontend/theme/default/templates/header',$data);  
		         $this->load->view('frontend/theme/default/buyer/'.$page);
	             $this->load->view('frontend/theme/default/templates/footer'); 
			}else{
				$match = $this->Changepassword->match_old_password($u_id, $password);
			
		     if($match == NULL){
				 
				
				 $data['error'] = 'Old Password Do Not Match';
				 $this->load->view('frontend/theme/default/templates/header',$data);  
		         $this->load->view('frontend/theme/default/buyer/'.$page);
	             $this->load->view('frontend/theme/default/templates/footer'); 
			 }
			 else {
				 
				 $new_p = $this->input->post('new_p');
				 
				$buyer_id = $this->Changepassword->update_password($u_id,$new_p);
				
				//Set Message
				$this->session->set_flashdata('success', 'Password has been Updated Successfull.');
				redirect('/');
			 }
		    }
    }
	
	
	


  		
	

	
	

}
