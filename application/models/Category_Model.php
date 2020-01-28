<?php
class Category_Model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	// * create catefory
	public function create_category($image = '')
	{
		$data = [
			'parent_id' => $this->input->post('parent_id'),
			'category_name' => trim($this->input->post('category_name')),
			'seo_keyword' => trim($this->input->post('seo_keyword')),
			'meta_title' => trim($this->input->post('meta_title')),
			'meta_keyword' => trim($this->input->post('meta_keyword')),
			'category_image' => $image,
			'category_description' => trim($this->input->post('category_description')),
			'meta_description' => trim($this->input->post('meta_description')),
			'date_added' => date("Y-m-d H:i:s"),
			'date_modified' => date("Y-m-d H:i:s"),
			'status' => $this->input->post('status'),
			'feature_category' => $this->input->post('feature_category'),
		];

		$this->db->insert('tr_category', $data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}

	// * update category
	public function update_category($id = '', $image = '')
	{
		$data = [
			'parent_id' => $this->input->post('parent_id'),
			'category_name' => $this->input->post('category_name'),
			'seo_keyword' => $this->input->post('seo_keyword'),
			'meta_title' => $this->input->post('meta_title'),
			'meta_keyword' => $this->input->post('meta_keyword'),
			'category_image' => $image,
			'category_description' => $this->input->post('category_description'),
			'meta_description' => $this->input->post('meta_description'),
			// 'date_added' => date("Y-m-d H:i:s"),
            'date_added' => $this->input->post('date_added'),
			'date_modified' => date("Y-m-d H:i:s"),
			'status' => $this->input->post('status'),
			'feature_category' => $this->input->post('feature_category'),
		];

		$query = $this->db->where('id', $id)
						  ->update('tr_category', $data);
		// $insert_id = $this->db->insert_id();
		return  $id;						  
		// $query = $this->db->get_where('tr_category', ['id' => $id]);
		// return $query->row();
	}

	// * get categories
	public function get_categories()
	{
		 $query = $this->db->order_by('id', 'desc')
                              ->limit(5)
							  ->get('tr_category');
		return $query->result_array();
	}

	// * get all categories
	public function get_all_categories($jion = '')
	{
		if ($jion) {
			// SELECT c.*, s.seller_id, CONCAT(slr.firstname, ' ' , slr.lastname) as seller_name  FROM `tr_category` c LEFT JOIN `tr_seller_membership` s ON (c.id = s.category_id) JOIN tr_seller slr ON (slr.id = s.seller_id)

			$result = $this->db->select("c.*,s.seller_id, CONCAT(slr.firstname, ' ' , slr.lastname) as seller_name")
			->from('tr_category c')
			->join('tr_seller_membership s', 'c.id = s.category_id', 'left')
			->join('tr_seller slr', 'slr.id = s.seller_id', 'left')
			->get();
			return $result->result();
		} else {
			$query = $this->db->order_by('id', 'desc')
				// ->limit(5)
				->get('tr_category');
			return $query->result_array();
		}
		
	}

	

	// * get single row of categories
	public function get_category($id)
	{
		$query = $this->db->get_where('tr_category', array('id' => $id));
		 return $query->row_array();
	}

	// * delete category
	public function delete_category($id)
	{
		foreach ($id as $ids) {
			$data['category'] = $this->Category_Model->get_category($ids);
			
			if (file_exists('../assets/images/category/' . $data['category']->category_image)) {
				
				unlink('../assets/images/category/' . $data['category']->category_image);
			}
			
			$this->db->where_in('id', $ids);
			$this->db->delete('tr_category');
		}		
		return true;
	}

	//* usser history (add, update)
	public function user_history( $track_id = '', $ip_address, $comment = '')
	{
		$userid = $this->session->userdata();
		$userid = $userid['user_id'];

		$data = array(
			'user_id' => $userid,
			'track_id' => $track_id,
			'comment' => $comment,
			'ip' => $ip_address,
			'date_added' => date("Y-m-d H:i:s"),
			'is_view' => '0'
		);
		return $this->db->insert('tr_user_history', $data);
	}

	//* user history (delete)
	public function save_delete_history($ids, $ip)
	{
		
		$userid = $this->session->userdata();
		$userid = $userid['user_id'];
		if (count($ids) > 1) {
			// foreach ($ids as $id) {
			// 	$name = $this->Category_Model->get_category($id);
				
			// 	$data = array(
			// 		'user_id' => $userid,
			// 		'track_id' => '',
			// 		'comment' => 'Deleted category name : <b> ' . $name['category_name'] . '</b>',
			// 		'ip' => $ip,
			// 		'date_added' => date("Y-m-d H:i:s"),
			// 		'is_view' => 0
			// 	);
			// 	$this->db->insert('tr_user_history', $data);
			// }
			foreach ($ids as $id) {
				// $name = $this->Usergroup_Model->get_name($id);
				$row =  $this->Category_Model->get_category($id);
				$name[] = $row['category_name'];
			}
			$data = array(
				'user_id' => $userid,
				'track_id' => '',
				'comment' => 'deleted category: <b>' . implode(" , ", $name) . '</b>',
				'ip' => $ip,
				'date_added' => date("Y-m-d H:i:s"),
				'is_view' => 0
			);
			$this->db->insert('tr_user_history', $data);
		} else {
			
			$name = $this->Category_Model->get_category($ids[0]);
			
			$data = array(
				'user_id' => $userid,
				// 'track_id' => 'deleted category id  = ' . $id . '',
				'track_id' => '',
				'comment' => 'Deleted category name : <b> ' . $name['category_name'] . '</b>',
				'ip' => $ip,
				'date_added' => date("Y-m-d H:i:s"),
				'is_view' => 0
			);
			$this->db->insert('tr_user_history', $data);
		}
		
		return true;
	}

	public function get_name($id)
	{
		$query = $this->db->get_where('tr_category', array('id' => $id));
		// return $query->row();
		return $query->row_array();
		// echo '<pre>';
		// print_r($query->row_array());
		// echo 'test';
		// echo '</pre>';
		// exit;
	}



	public function get_categoriesPage($categoryName = FALSE, $params = array())
	{
		
		if ($categoryName === FALSE) {

			$this->db->select('*');
			$this->db->from('tr_category');

			if (array_key_exists("where", $params)) {
				foreach ($params['where'] as $key => $val) {
					$this->db->where($key, $val);
				}
			}

			if (array_key_exists("search", $params)) {
				// Filter data by searched keywords 
				if (!empty($params['search']['keywords'])) {
					$this->db->like('category_name', $params['search']['keywords']);
				}
			}

			// Sort data by ascending or desceding order 
			if (!empty($params['search']['sortBy'])) {
				// $this->db->order_by('category_name', $params['search']['sortBy']);
				$this->db->order_by('id', 'desc');
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

			return $result;
		}
		
		// $query = $this->db->get_where('tr_category', array('username' => $categoryName));
		// return $query->row_array();
	}

}
