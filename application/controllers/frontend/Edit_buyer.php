<?php
class Edit_buyer extends CI_Controller
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
		$this->load->model('frontend/Editaccount');
		$this->load->library('ajax_pagination');
		
		if (!$this->session->userdata('authenticated_buyer_mobile')) {
            redirect('/');
        }
			  
	}
	
	
	
	public function edit($id, $page = 'edit_account')
    {
		
		$u_id = $id;
		$country_id = $this->input->post('country_id');
		$data['metaData'] = $this->Settings_model->get_settings();
	
		$data['buyer'] = $this->Editaccount->get_buyer($u_id);
		$address_buyer = $this->Editaccount->get_address($u_id);
		if($address_buyer) {
			$data['address_buyer'] = $address_buyer;
		}
		
		
		// * set metadata
        $data['metaData']['title'] = $data['metaData'][7]->value;
        $data['metaData']['description'] = $data['metaData'][11]->value;
        $data['metaData']['keyword'] = $data['metaData'][6]->value;
        $data['metaData']['icon'] = $data['metaData'][5]->value;
        $data['metaData']['logo'] = $data['metaData'][4]->value;
		
		
		$data['country'] = $this->Editaccount->get_country();
	    $data['state'] = $this->Editaccount->get_state($id = 1);
		$data['state1'] = $this->Editaccount->get_states($country_id);
		
		    
		
		
		if($this->input->post('country_id')){
				$data['country_id'] = $this->input->post('country_id');	
			}
			else{
				$data['country_id'] = '';
			}
			
			if($this->input->post('state_id')){
				$data['state_id'] = $this->input->post('state_id');	
				
			}
			else{
				$data['state_id'] = '';
			}
			
			if($this->input->post('firstname')){
				$data['firstname'] = $this->input->post('firstname');	
			}
			else{
				$data['firstname'] = '';
			}
			
			if($this->input->post('lastname')){
				$data['lastname'] = $this->input->post('lastname');	
				
			}
			else{
				$data['lastname'] = '';
			}
			
			if($this->input->post('city')){
				$data['city'] = $this->input->post('city');	
				
			}
			else{
				$data['city'] = '';
			}
			
			if($this->input->post('postcode')){
				$data['postcode'] = $this->input->post('postcode');	
				
			}
			else{
				$data['postcode'] = '';
			}
			
			$this->form_validation->set_rules('firstname', 'Firstname', 'required');
			$this->form_validation->set_rules('a_1', 'Address 1', 'required');
			$this->form_validation->set_rules('city', 'City', 'required');
			$this->form_validation->set_rules('postcode', 'Postcode', 'required');
			$this->form_validation->set_rules('lastname', 'Lastname', 'required');
			
			if($this->form_validation->run() === FALSE){
				
		 	 	 $this->load->view('frontend/theme/default/templates/header',$data);  
		         $this->load->view('frontend/theme/default/buyer/'.$page);
	             $this->load->view('frontend/theme/default/templates/footer'); 
			}else{
				
				$buyer_id = $this->Editaccount->update_buyer($u_id);
				
				$address_id = $this->Editaccount->add_address($buyer_id);
                
				$name = $this->Editaccount->get_buyer($buyer_id);
                $id = 'buyer_id = '.$buyer_id;
                
				$username = 'Updated Buyer : <b> '.$name['first_name'].'</b>';
				$userid = 1;
                $ip = $this->Editaccount->get_ip();

				$this->Editaccount->save_buyer_history($id, $userid, $ip, $username);

				//Set Message
				$this->session->set_flashdata('success', 'Buyer has been Updated Successfull.');
				redirect('/');
		
		    }
    }
	
	
	 public function get_states()
		{
			$id = $this->input->post('country_id');
			
			
			$getstate = $this->Editaccount->get_state($id);
			
			
             echo json_encode($getstate);
	 
	    }


  		
	

	
	

}
