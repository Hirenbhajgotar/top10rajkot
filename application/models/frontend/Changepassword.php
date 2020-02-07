<?php
	class Changepassword extends CI_Model
	{
		public function __construct()
		{
			  parent::__construct();
			  $this->load->library('db_tables');
			  $this->db_tables->index();

		      $this->load->database();
		}
		

		
	public function match_old_password($id, $password)
		{
			
			$pa = md5($password);
			$array = array('id' => $id, 'password' => $pa);

            $this->db->where($array); 

			$query = $this->db->get('tr_buyer');
			if($query->num_rows() > 0){
				return true; 
			}else{
				return false;
			}
			

		}
		
		public function update_password($id,$new_p)
		{
			$pa = md5($new_p);
			$data = array(  'password' => $pa
						  );
						  		
            $this->db->where('id', $id);
			$this->db->update('tr_buyer', $data);
			$update_id = $id;
			return $update_id;						 	
		}
		
		
		
		
		
	
	}