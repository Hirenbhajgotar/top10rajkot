<?php
	class Seller_contact extends CI_Model
	{
		public function __construct()
		{
			  parent::__construct();
			  $this->load->library('db_tables');
			  $this->db_tables->index();

		      $this->load->database();
		}
		

		
		
	
	}