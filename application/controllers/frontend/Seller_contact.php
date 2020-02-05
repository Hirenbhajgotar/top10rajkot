<?php
class Seller_contact extends CI_Controller
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
		$this->load->model('frontend/Sellerprofile');
		$this->load->library('ajax_pagination');
		$this->perPage = 5;
		
		  
	}
	
	
	
	public function contact($seo, $page = 'seller_contact')
    {
		
		$data['seo'] = $seo;
		
		$data['metaData'] = $this->Settings_model->get_settings();
		$data['seller'] = $this->Sellerprofile->get_seller($seo);
		
		$data['address'] = $this->Sellerprofile->get_address($data['seller']['seller_id']);
	    $data['country'] = $this->Sellerprofile->get_country($data['address']['country_id']);
		$data['state'] = $this->Sellerprofile->get_state($data['address']['state_id']);
		$data['sec_meta_data'] = $this->Sellerprofile->get_seller($seo);
		
		
		//$data['banner'] = $this->Sellerprofile->get_banner($seo);
		
		//$data['about'] = $this->Sellerprofile->get_about_us($seo);
		
		
		
		$this->load->view('frontend/theme/default/templates/header',$data);  
		$this->load->view('frontend/theme/default/seller/'.$page);
	    $this->load->view('frontend/theme/default/templates/footer');  
		    
    }
	public function submit_contact($seo, $page = 'seller_contact')
    {
		
		$data['seo'] = $seo;
		
		$data['metaData'] = $this->Settings_model->get_settings();
		$data['seller'] = $this->Sellerprofile->get_seller($seo);
		
		
		$data['address'] = $this->Sellerprofile->get_address($data['seller']['seller_id']);
	    $data['country'] = $this->Sellerprofile->get_country($data['address']['country_id']);
		$data['state'] = $this->Sellerprofile->get_state($data['address']['state_id']);
		$data['sec_meta_data'] = $this->Sellerprofile->get_seller($seo);
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('message', 'Message', 'required');
		
		
		if ($this->form_validation->run() === FALSE) { 
			$this->load->view('frontend/theme/default/templates/header',$data);  
		    $this->load->view('frontend/theme/default/seller/'.$page);
	        $this->load->view('frontend/theme/default/templates/footer');  
		}else{
			$this->load->library("email");
            $config['protocol'] = 'smtp';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'utf-8';
            $config['wordwrap'] = TRUE;

            $this->email->initialize($config);
            $this->email->from('bhajgotar8918514@gmail.com', 'Hiren');
            $this->email->to($this->input->post('email'));

            $this->email->subject('User registration');
            $this->email->message('Testing the email class.');
          

            if ($this->email->send()) {
               
               echo 'email has been sent';
            } else {
                show_error($this->email->print_debugger());
            }
			   
			
		}

		
	}

	
	

}
