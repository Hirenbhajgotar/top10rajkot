<?php
class User_Model extends CI_Model
{



	public function add_user($post_image)
	{
		$data = array(
			'user_group_id' => $this->input->post('user_group_id'),
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
			'firstname' => $this->input->post('firstname'),
			'lastname' => $this->input->post('lastname'),
			'mobile' => $this->input->post('contact'),
			'email' => $this->input->post('email'),
			'gender' => $this->input->post('gender'),
			'role_id' => '2',
			'image' => $post_image,
			'date_added' => date("Y-m-d H:i:s"),
			'datemodify' => date("Y-m-d H:i:s"),
			'status' => $this->input->post('status')
		);
		$this->db->insert('tr_user', $data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}
	public function save_history($user, $userid, $ip)
	{
		$userid = $userid['user_id'];

		$data = array(
			'user_id' => $user,
			'track_id' => $userid,
			'comment' => 'Admin Created By user',
			'ip' => $ip,
			'date_added' => date("Y-m-d H:i:s"),
			'is_view' => '0'
		);
		return  $this->db->insert('tr_user_history', $data);
	}

	public function save_update_history($user, $userid, $ip)
	{
		$userid = $userid['user_id'];

		$data = array(
			'user_id' => $user,
			'track_id' => $userid,
			'comment' => 'Admin Updated user ',
			'ip' => $ip,
			'date_added' => date("Y-m-d H:i:s"),
			'is_view' => '0'
		);
		return  $this->db->insert('tr_user_history', $data);
	}


	public function save_delete_history($id, $userid, $ip)
	{

		$userid = $userid['user_id'];
		foreach ($id as $ids) {
			$data = array(
				'user_id' => $ids,
				'track_id' => $userid,
				'comment' => 'Admin deleted user ',
				'ip' => $ip,
				'date_added' => date("Y-m-d H:i:s"),
				'is_view' => '0'
			);
			$this->db->insert('tr_user_history', $data);
		}
		return true;
	}






	public function get_users($username = FALSE, $params = array())
	{
		if ($username === FALSE) {

			$this->db->select('*');
			$this->db->from('tr_user');

			if (array_key_exists("where", $params)) {
				foreach ($params['where'] as $key => $val) {
					$this->db->where($key, $val);
				}
			}

			if (array_key_exists("search", $params)) {
				// Filter data by searched keywords 
				if (!empty($params['search']['keywords'])) {
					$this->db->like('username', $params['search']['keywords']);
				}
			}

			// Sort data by ascending or desceding order 
			if (!empty($params['search']['sortBy'])) {
				$this->db->order_by('username', $params['search']['sortBy']);
			} else {
				$this->db->order_by('id', 'desc');
			}

			if (array_key_exists("returnType", $params) && $params['returnType'] == 'count') {
				$result = $this->db->count_all_results();
			} else {


				if (array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')) {
					if (!empty($params['id'])) {

						$this->db->where('id', $params['id']);
					}
					$query = $this->db->get();
					$result = $query->row_array();
				} else {

					$this->db->order_by('id', 'desc');
					if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
						$this->db->limit($params['limit'], $params['start']);
					} elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
						$this->db->limit($params['limit']);
					}

					$query = $this->db->get();
					$result = ($query->num_rows() > 0) ? $query->result_array() : FALSE;
				}
			}

			// Return fetched data 
			return $result;
		}

		$query = $this->db->get_where('tr_user', array('username' => $username));
		return $query->row_array();
	}

	public function get_user($id = FALSE)
	{
		if ($id === FALSE) {
			$query = $this->db->get('tr_user');
			return $query->result_array();
		}

		$query = $this->db->get_where('tr_user', array('id' => $id));
		return $query->row_array();
	}


	public function get_usergroup()
	{
		$this->db->order_by('tr_user_group.id', 'DESC');
		//$this->db->join('categories', 'categories.id = posts.category_id');
		$query = $this->db->get('tr_user_group');
		return $query->result_array();
	}


	public function update_user_data($post_image)
	{

		$data = array(
			'user_group_id' => $this->input->post('user_group_id'),
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
			'firstname' => $this->input->post('firstname'),
			'lastname' => $this->input->post('lastname'),
			'mobile' => $this->input->post('contact'),
			'email' => $this->input->post('email'),
			'gender' => $this->input->post('gender'),
			'role_id' => '2',
			'image' => $post_image,
			'datemodify' => date("Y-m-d H:i:s"),
			'status' => $this->input->post('status')
		);
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('tr_user', $data);
		$update_id = $this->input->post('id');
		return $update_id;
	}

	public function delete($id)
	{
		foreach ($id as $ids) {
			$this->db->where('id', $ids);
			$this->db->delete('tr_user');
		}

		return true;
	}

	public function register($encrypt_password)
	{
		$data = [
			'first_name' => $this->input->post('firstname'),
			'last_name' => $this->input->post('lastname'),
			'email' => $this->input->post('email'),
			'mobile_no' => $this->input->post('mobile'),
			'password' => $encrypt_password,
			'gender' => $this->input->post('gender'),
			'email_verify' => 1,
			'mobile_verify' => 1,
			'date_addedd' => date("Y-m-d H:i:s"),
			'date_modified' => date("Y-m-d H:i:s"),
			'last_login' => date("Y-m-d H:i:s"),
			'status' => 1,
		];
		
		return $this->db->insert('tr_buyer', $data);
	}

	public function login($email, $encrypt_password)
	{
		//Validate
		$this->db->where('email', $email);
		$this->db->where('password', $encrypt_password);

		$result = $this->db->get('tr_user');

		if ($result->num_rows() == 1) {
			return $result->row(0);
		} else {
			return false;
		}
	}

	// Check Username exists
	public function check_username_exists($username)
	{
		$query = $this->db->get_where('tr_buyer', array('username' => $username));

		if (empty($query->row_array())) {
			return true;
		} else {
			return false;
		}
	}

	// Check email exists
	public function check_email_exists($email)
	{
		$query = $this->db->get_where('tr_buyer', array('email' => $email));

		if (empty($query->row_array())) {
			return true;
		} else {
			return false;
		}
	}

	public function chkusername()
	{
		$this->db->select('username');
		$this->db->from('tr_user');
		$this->db->where_not_in('id', $this->input->post('id'));
		$this->db->where('username', $this->input->post('username'));
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return 1;
		} else {
			return 0;
		}
	}

	public function chkemail()
	{
		$this->db->select('email');
		$this->db->from('tr_user');
		$this->db->where_not_in('id', $this->input->post('id'));
		$this->db->where('username', $this->input->post('email'));
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return 1;
		} else {
			return 0;
		}
	}

	public function chkmobile()
	{
		$this->db->select('mobile');
		$this->db->from('tr_user');
		$this->db->where_not_in('id', $this->input->post('id'));
		$this->db->where('username', $this->input->post('mobile'));
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return 1;
		} else {
			return 0;
		}
	}

	public function enable($id, $table)
	{
		$data = array(
			'status' => 0
		);
		$this->db->where('id', $id);
		return $this->db->update($table, $data);
	}
	public function desable($id, $table)
	{
		$data = array(
			'status' => 1
		);
		$this->db->where('id', $id);
		return $this->db->update($table, $data);
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
}
