<?php
	class Sellerprofile extends CI_Model
	{
		public function __construct()
		{
			  parent::__construct();
			  $this->load->library('db_tables');
			  $this->db_tables->index();

		      $this->load->database();
		}
		

		public function get_seller($seo){
			$query = $this->db->query("Select * from ".DB_SEO_URL." se LEFT JOIN ".DB_SELLER_HOME_CONTENT." h ON TRIM(BOTH 'seller_id=' FROM se.query) = h.seller_id LEFT JOIN ".DB_SELLER." s ON TRIM(BOTH 'seller_id=' FROM se.query)  = s.id where se.query LIKE 'seller_id=%' AND se.keyword LIKE '$seo'");
			return $query->row_array();
		}

		public function get_address($id){
			
			$query = $this->db->query("Select * from ".DB_ADDRESS." a where a.seller_id = '$id'");
			
			return $query->row_array();
			
		}
		
		public function get_country($id){
			
			$query = $this->db->query("Select * from ".DB_COUNTRY." c where c.country_id = '$id'");
			
			return $query->row_array();
			
		}
		
		public function get_state($id){
			
			$query = $this->db->query("Select * from ".DB_STATE." s where s.state_id = '$id'");
			
			return $query->row_array();
			
		}
		
		
		
		public function get_product($seo){
			
			
			$query = $this->db->query("Select * from ".DB_SEO_URL." se LEFT JOIN ".DB_PRODUCTS." p ON TRIM(BOTH 'seller_id=' FROM se.query) = p.seller_id where se.query LIKE 'seller_id=%' AND se.keyword LIKE '$seo'");
		    			
			return $query->result_array();
			
		}
		public function get_banner($seo){
			
			$query = $this->db->query("Select * from ".DB_SEO_URL." se LEFT JOIN ".DB_BANNER." b ON TRIM(BOTH 'seller_id=' FROM se.query) = b.seller_id where se.query LIKE 'seller_id=%' AND se.keyword LIKE '$seo'");
			return $query->result_array();
			
		}
		public function get_about_us($seo){
			$query = $this->db->query("Select * from ".DB_SEO_URL." se LEFT JOIN ".DB_SELLER_HOME_CONTENT." h ON TRIM(BOTH 'seller_id=' FROM se.query) = h.seller_id where se.query LIKE 'seller_id=%' AND se.keyword LIKE '$seo'");
			return $query->row_array();
			
		}

		public function get_product_seo($id = '')
		{
			$sql = "SELECT distinct se.keyword as keyword FROM `tr_seo_url` as se WHERE TRIM(BOTH 'product_id=' FROM se.query) = $id  ";
			$query = $this->db->query($sql);
			return $query->row();
		}
		
		
		
		
	
	}