<?php
	class Editaccount extends CI_Model
	{
		public function __construct()
		{
			  parent::__construct();
			  $this->load->library('db_tables');
			  $this->db_tables->index();

		      $this->load->database();
		}
		

		public function get_buyer($id){
			$query = $this->db->get_where(DB_BUYER, array('id' => $id));
			return $query->row_array();
			
		}
		
		/* public function get_seller($id){
			$query = $this->db->get_where(DB_BUYER, array('id' => $id));
			return $query->row_array();
			
		} */
		
		
		public function get_state($id)
		{
			
			$query = $this->db->get_where(DB_STATE, array('country_id' => $id));
		
			return  $query->result_array();
				
		}
		public function get_states($country_id)
		{
			
			$query = $this->db->get_where(DB_STATE, array('country_id' => $country_id));
		
			return  $query->result_array();
				
		}
		
		public function get_address($id)
		{
			
			$query = $this->db->get_where(DB_ADDRESS, array('buyer_id' => $id));
		
			return  $query->row_array();
				
		}
		
		
		
		public function get_country()
		{
				$query = $this->db->get(DB_COUNTRY);
				return $query->result_array(); 
			
		}
		public function update_buyer($id)
		{
			
			$data = array(  'first_name' => $this->input->post('firstname'), 
							'last_name' => $this->input->post('lastname')
						  );
						  		
            $this->db->where('id', $id);
			$this->db->update('tr_buyer', $data);
			$update_id = $id;
			return $update_id;						 	
		}
		
		public function add_address($buyer_id)
		{
			
			$check = $this->Editaccount->check_buyer($buyer_id);
			
			$buyer = $this->Editaccount->get_buyer($buyer_id);
			
			if($check > 0) {
				
				$data = array( 
							'seller_id' => 0,
							'firstname' => $buyer['first_name'],
							'lastname' => $buyer['last_name'], 
							'address_1' => $this->input->post('a_1'), 
							'address_2' => $this->input->post('a_2'), 
							'city' => $this->input->post('city'),
							'postcode	' => $this->input->post('postcode'),
							'country_id	' => $this->input->post('country_id'),
							'state_id' => $this->input->post('state_id'), 
	                        'date_modified	' =>date("Y-m-d H:i:s")
						  );
						  		
							$this->db->where('buyer_id', $buyer_id);
							$this->db->update('tr_address', $data);
							$update_id = $buyer_id;
							return $update_id;		
			
			               }
		             	else{
				
						$data = array(  'buyer_id' => $buyer_id, 
									'seller_id' => 0,
									'firstname' => $buyer['first_name'],
									'lastname' => $buyer['last_name'], 
									'address_1' => $this->input->post('a_1'), 
									'address_2' => $this->input->post('a_2'), 
									'city' => $this->input->post('city'),
									'postcode	' => $this->input->post('postcode'),
									'country_id	' => $this->input->post('country_id'),
									'state_id' => $this->input->post('state_id'), 
									'date_added' => date("Y-m-d H:i:s"),
									'date_modified	' =>date("Y-m-d H:i:s")
								  );		 
								 $this->db->insert('tr_address', $data);
								 $insert_id = $this->db->insert_id();
								 return  $insert_id;
				
			               }
				
		      }
		
		public function save_buyer_history($id, $userid, $ip, $username)
	    {
		$data = array(
			'user_id' => $id,
			'track_id' => $userid,
			'comment' => $username,
			'ip' => $ip,
			'date_added' => date("Y-m-d H:i:s"),
			'is_view' => '0'
		);
		return  $this->db->insert('tr_user_history', $data);
	    }
		
		function get_ip()
	    {
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	    }
	
	    public function match_old_password($password)
		{
			$id = $this->session -> userdata('user_id');
			if($id === FALSE){
				$query = $this->db->get('tr_user');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('tr_user', array('password' => $password));
			return $query->row_array();

		}
		
		 public function check_buyer($buyer_id)
		{
			$query = $this->db->get_where(DB_ADDRESS, array('buyer_id' => $buyer_id));
			if($query->num_rows() > 0) {
				return True;
			}else{
				return False;
			}

		}
		
		
		
		
		
	
	}