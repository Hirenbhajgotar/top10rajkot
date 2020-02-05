<?php
class Seller_profile extends CI_Controller
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
	
	
	
	public function view($seo, $page = 'index')
    {
		$data['seo'] = $seo;
		
		$data['metaData'] = $this->Settings_model->get_settings();
		$data['seller'] = $this->Sellerprofile->get_seller($seo);
		$data['address'] = $this->Sellerprofile->get_address($data['seller']['seller_id']);
		$data['country'] = $this->Sellerprofile->get_country($data['address']['country_id']);
		$data['state'] = $this->Sellerprofile->get_state($data['address']['state_id']);
		$data['sec_meta_data'] = $this->Sellerprofile->get_seller($seo);
		$data['product'] = $this->Sellerprofile->get_product($seo);
		$data['banner'] = $this->Sellerprofile->get_banner($seo);		
		$data['about'] = $this->Sellerprofile->get_about_us($seo);
		
		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';
		// exit;
		// * set metadata
		$data['metaData']['title'] = $data['sec_meta_data']['meta_title'];
		$data['metaData']['description'] = $data['sec_meta_data']['meta_description'];
		$data['metaData']['keyword'] = $data['sec_meta_data']['meta_keyword'];
		$data['metaData']['icon'] = $data['metaData'][5]->value;
		$data['metaData']['logo'] = $data['metaData'][4]->value;
		
		$this->load->view('frontend/theme/default/templates/header',$data);  
		$this->load->view('frontend/theme/default/seller/'.$page);
	    $this->load->view('frontend/theme/default/templates/footer');  
		    
    }
	

	
	

}
