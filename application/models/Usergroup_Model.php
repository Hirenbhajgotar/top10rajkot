<?php
	class Usergroup_Model extends CI_Model{
		
		
		public function add_group()
		{
			$data = array(  'name' => $this->input->post('name'), 
							'permission' => $this->input->post('permission'),
							'date_added' => date("Y-m-d H:i:s"),
							'datemodify' => date("Y-m-d H:i:s"),
							'status' => $this->input->post('status')
						  );
			 $this->db->insert('tr_user_group', $data);
			 $insert_id = $this->db->insert_id();
			 return  $insert_id;
		}
		public function save_usergroup_history($user, $userid, $ip)
		{
			$userid = $userid['user_id'];
			
			$data = array('user_id' => $user, 
							'track_id' => $userid,
							'comment' => 'Admin Created By usergroup',
							'ip' => $ip,
							'date_added' => date("Y-m-d H:i:s"),
							'is_view' => '0'
						  );
			return  $this->db->insert('tr_user_history', $data);
			
		}
		
		
		public function get_group($id = FALSE, $limit, $offset)
		{
			
			
			if ($limit) {
				$this->db->limit($limit, $offset);
			}

			if($id === FALSE){
				$this->db->order_by('tr_user_group.id', 'DESC');
				//$this->db->join('categories', 'categories.id = posts.category_id');
				$query = $this->db->get('tr_user_group');
				return $query->result_array(); 
			}
			
			$query = $this->db->get_where('tr_user_group', array('id' => $id));
			return $query->row_array();
			
		}
		function get_groups($id = FALSE, $params = array()){ 
		 
        if($id === FALSE){
             $this->db->select('*'); 
             $this->db->from('tr_user_group'); 
         
				if(array_key_exists("where", $params)){ 
					foreach($params['where'] as $key => $val){ 
						$this->db->where($key, $val); 
					} 
				} 
				 
				if(array_key_exists("search", $params)){ 
					// Filter data by searched keywords 
					if(!empty($params['search']['keywords'])){ 
						$this->db->like('name', $params['search']['keywords']); 
					} 
				} 
         
                // Sort data by ascending or desceding order 
				if(!empty($params['search']['sortBy'])){ 
					$this->db->order_by('name', $params['search']['sortBy']); 
				}else{ 
					$this->db->order_by('id', 'desc'); 
				} 
         
				if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
					$result = $this->db->count_all_results();
                   					
				}else{ 
				
				  
					if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
						if(!empty($params['id'])){ 
						 
							$this->db->where('id', $params['id']); 
						} 
						$query = $this->db->get(); 
						$result = $query->row_array(); 
					}else{ 
					
						$this->db->order_by('id', 'desc'); 
						if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
							$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
							$this->db->limit($params['limit']); 
						} 
						 
						$query = $this->db->get(); 
						$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
					} 
				} 
				 
				// Return fetched data 
				return $result;
		       }	
			   $query = $this->db->get_where('tr_user_group', array('id' => $id));
			
			   return $query->row_array();
			}
			
		 public function get_groupsss()
		 {
		   $this->db->order_by('tr_user_group.id', 'DESC');
			//$this->db->join('categories', 'categories.id = posts.category_id');
			$query = $this->db->get('tr_user_group');
			return $query->result_array(); 
	     }
		public function update_group_data()
		{ 
			$data = array(  'name' => $this->input->post('name'), 
							'permission' => $this->input->post('permission'),
							'datemodify' => date("Y-m-d H:i:s"),
							'status' => $this->input->post('status')
						  );
						

			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tr_user_group', $data);
			$update_id = $this->input->post('id');
			return $update_id;
			 
		}
		public function update_usergroup_history($user, $userid, $ip)
		{
			$userid = $userid['user_id'];
			
			$data = array('user_id' => $user, 
							'track_id' => $userid,
							'comment' => 'Admin Updated user',
							'ip' => $ip,
							'date_added' => date("Y-m-d H:i:s"),
							'is_view' => '0'
						  );
			return  $this->db->insert('tr_user_history', $data);
			
		}
		
		
		public function deletegroups($id)
		{
			foreach($id as $ids){
				$this->db->where_in('id', $ids);
				$this->db->delete('tr_user_group');
			}
			
			return true;
		}
		public function save_delete_history($id, $userid, $ip)
		{
			
			$userid = $userid['user_id'];
			foreach($id as $ids){	
			$data = array('user_id' => $ids, 
							'track_id' => $userid,
							'comment' => 'Admin deleted usergroup ',
							'ip' => $ip,
							'date_added' => date("Y-m-d H:i:s"),
							'is_view' => '0'
						  );
		        $this->db->insert('tr_user_history', $data);	
			}
			return true; 	
		}
		
		
		
		public function chkname(){
			 $this->db->select('name'); 
			 $this->db->from('tr_user_group');
			 $this->db->where_not_in('id', $this->input->post('id'));
			 $this->db->where('name', $this->input->post('name'));
			 $query = $this->db->get();
			 if ($query->num_rows() == 1) {
				 return 1;
			 } else {
				 return 0;
			 }
    
      }

		public function chkpermission(){
			 $this->db->select('permission'); 
			 $this->db->from('tr_user_group');
			 $this->db->where_not_in('id', $this->input->post('id'));
			 $this->db->where('permission', $this->input->post('permission'));
			 $query = $this->db->get();
			 if ($query->num_rows() == 1) {
				 return 1;
			 } else {
				 return 0;
			 }
			
		}
		
		public function enable($id,$table){
			$data = array(
				'status' => 0
			    );
			$this->db->where('id', $id);
			return $this->db->update($table, $data);
		}
		public function desable($id,$table){
			$data = array(
				'status' => 1
			    );
			$this->db->where('id', $id);
			return $this->db->update($table, $data);
		}
		
		
			
	}