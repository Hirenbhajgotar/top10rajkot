<?php
class Category extends CI_Controller
{
	public function __construct() {
		parent::__construct();
		$this->load->model('Category_Model');
		$this->load->model('Is_unique');
		$this->load->model('ScoUrl_Model'); // * sco url model
		$this->load->library('form_validation');
		$this->load->library('ajax_pagination');

		$this->perPage = 5; 
	}
		
	
	// * Add category
	public function addCategory()
	{
		// $this->load->library('parser');
		// check login
		if (!$this->session->userdata('login')) {
			redirect('administrator/index');
		}

		$data['title'] = 'Add Category';
		// $this->load->model('Category_Model');
		$data['parent_category'] = $this->Category_Model->get_all_categories();
		
		$this->form_validation->set_rules('category_name', 'Name', 'required|is_unique[tr_category.category_name]');
		$this->form_validation->set_rules('seo_keyword', 'SEO keyword', 'required');
		$this->form_validation->set_rules('category_description', 'Description', 'required');

		if ($this->form_validation->run() === FALSE) {
			
			$this->load->view('generalTheme/header');
			$this->load->view('generalTheme/sidebar');
			$this->load->view('categories/add_category', $data);
			$this->load->view('generalTheme/footer');
		} else {
			if ($_FILES['category_image']['size'] > 0) {
				//* Upload Image
				$this->load->library('upload');
				$imgPath = './assets/images/category';
				$name_parts = pathinfo($_FILES['category_image']['name']);
				$name_full  = preg_replace('/\s+/', '', $name_parts['filename']);
				$file_name  = $name_full . '-' . date('Ymd-his');

				$config['upload_path'] = $imgPath;
				$config['file_name'] = $file_name;
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '2048';
				$config['max_width'] = '2000';
				$config['max_height'] = '2000';

				$this->upload->initialize($config);
				if (!$this->upload->do_upload('category_image')) {
					$data['img_error'] = $this->upload->display_errors();


					$this->load->view('generalTheme/header');
					$this->load->view('generalTheme/sidebar');
					$this->load->view('categories/add_category', $data);
					$this->load->view('generalTheme/footer');
				} else {
					$data['upload_data'] = $this->upload->data();

					$image = $data['upload_data']['file_name'];

					// $this->load->model('Category_Model');
					if ($last_id = $this->Category_Model->create_category($image)) {

						if ($row = $this->Category_Model->get_category($last_id)) {
							$track_id = 'addedd_category_id=' . $last_id;
							$ip = $this->User_Model->get_ip();
							$comment = 'added category: <b>' . $row['category_name'] . '</b>';

							// * save sco url
							$keyword = $row['seo_keyword'];
							$query = "category_id=" . $last_id;
							$this->ScoUrl_Model->saveSco($query, $keyword);
							$this->Category_Model->user_history($track_id, $ip, $comment);
							$this->session->set_flashdata('success', 'Your category has been created.');
						}
					}

					redirect('Category/categoryList');
				}
			} else {
				if ($last_id = $this->Category_Model->create_category()) {

					if ($row = $this->Category_Model->get_category($last_id)) {
						$track_id = 'addedd_category_id=' . $last_id;
						$ip = $this->User_Model->get_ip();
						$comment = 'added category: <b>' . $row['category_name'] . '</b>';

						// * save sco url
						$keyword = $row['seo_keyword'];
						$query = "category_id=" . $last_id;
						$this->ScoUrl_Model->saveSco($query, $keyword);
						$this->Category_Model->user_history($track_id, $ip, $comment);
						$this->session->set_flashdata('success', 'Your category has been created.');
					}
				}
				redirect('Category/categoryList');
			}
			
		} 
		
	}

	// * update category
	public function updateCategory($id = '')
	{
		$data['title'] = 'Update category';
		$data['category'] = $this->Category_Model->get_category($id);
		$data['parent_category'] = $this->Category_Model->get_all_categories();

		$this->load->view('generalTheme/header');
		$this->load->view('generalTheme/sidebar');
		$this->load->view('categories/update_category', $data);
		$this->load->view('generalTheme/footer');

	}

	// * update category data
	public function updateCategoryData($id)
	{
		$data['title'] = 'Update category';
		$data['category'] = $this->Category_Model->get_category($id);
		$data['parent_category'] = $this->Category_Model->get_all_categories();

		// * set validatation rules
		$this->form_validation->set_rules('category_name', 'Category name', 'required');
		$this->form_validation->set_rules('seo_keyword', 'SEO keyword', 'required');
		$this->form_validation->set_rules('meta_title', 'Meta title', 'required');
		$this->form_validation->set_rules('meta_keyword', 'Meta keyword', 'required');
		$this->form_validation->set_rules('category_description', 'Description', 'required');
		$this->form_validation->set_rules('meta_description', 'Meta description', 'required');


		if ($this->form_validation->run() === FALSE) {
			
			$this->load->view('generalTheme/header');
			$this->load->view('generalTheme/sidebar');
			$this->load->view('categories/update_category', $data);
			$this->load->view('generalTheme/footer');
		} else {
			// * check unique value
			$category_name = $this->input->post('category_name');
			if ($this->Is_unique->check('category_name', 'tr_category', $category_name, $id)) {
				$data['img_error'] = "Please enter unique value in 'category name' field ";

				$this->load->view('generalTheme/header');
				$this->load->view('generalTheme/sidebar');
				$this->load->view('categories/update_category', $data);
				$this->load->view('generalTheme/footer');
			} else {
				// * remove image
				if (file_exists('./assets/images/category/' . $data['category']['category_image'])) {
					unlink('./assets/images/category/' . $data['category']['category_image']);
				}

				if ($_FILES['category_image']['size'] > 0) {
					//* Upload Image
					$this->load->library('upload');
					$imgPath = './assets/images/category';
					$name_parts = pathinfo($_FILES['category_image']['name']);
					$name_full  = preg_replace('/\s+/', '', $name_parts['filename']);
					$file_name  = $name_full . '-' . date('Ymd-his');

					$config['upload_path'] = $imgPath;
					$config['file_name'] = $file_name;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size'] = '2048';
					$config['max_width'] = '2000';
					$config['max_height'] = '2000';

					$this->upload->initialize($config);
					if (!$this->upload->do_upload('category_image')) {
						$data['img_error'] = $this->upload->display_errors();

						$this->load->view('generalTheme/header');
						$this->load->view('generalTheme/sidebar');
						$this->load->view('categories/update_category', $data);
						$this->load->view('generalTheme/footer');
					} else {
						$data['upload_data'] = $this->upload->data();
						$image = $data['upload_data']['file_name'];

						if ($last_id = $this->Category_Model->update_category($id, $image)) {
							if ($row = $this->Category_Model->get_category($last_id)) {
								// *save user ihstory
								$track_id = 'updated_category_id=' . $last_id;
								$ip = $this->User_Model->get_ip();
								$comment = 'updated category: <b>' . $row['category_name'] . '</b>';
								$this->Category_Model->user_history($track_id, $ip, $comment);

								// * save sco url
								$query = "category_id=" . $last_id;
								$sco = $this->ScoUrl_Model->getSco($query);

								$scoId = $sco->id;
								$scoQuery = $sco->query;
								$keyword = $row['seo_keyword'];
								$this->ScoUrl_Model->updateSco($scoId, $scoQuery, $keyword);
								$this->session->set_flashdata('success', 'Your category has been updated.');
							}
						}
						redirect('Category/categoryList');
					}
				} else {
					if ($last_id = $this->Category_Model->update_category($id)) {
						if ($row = $this->Category_Model->get_category($last_id)) {
							// *save user ihstory
							$track_id = 'updated_category_id=' . $last_id;
							$ip = $this->User_Model->get_ip();
							$comment = 'updated category: <b>' . $row['category_name'] . '</b>';
							$this->Category_Model->user_history($track_id, $ip, $comment);

							// * save sco url
							$query = "category_id=" . $last_id;
							$sco = $this->ScoUrl_Model->getSco($query);

							$scoId = $sco->id;
							$scoQuery = $sco->query;
							$keyword = $row['seo_keyword'];
							$this->ScoUrl_Model->updateSco($scoId, $scoQuery, $keyword);
							$this->session->set_flashdata('success', 'Your category has been updated.');
						}
					}
					redirect('Category/categoryList');
				}
				
			}
			
			
		} 
	}

	// *category list
	public function categoryList($id = NULL)
	{
		$data = array();

		 $conditions['returnType'] = 'count';

		$totalRec = $this->Category_Model->get_categoriesPage(false, $conditions);
		
		 $config['target']      = '#dataList';
		 $config['base_url']    = base_url('Category/ajaxPaginationCategory/');
		 $config['total_rows']  = $totalRec;
		 $config['per_page']    = $this->perPage;
		 $config['link_func']   = 'searchFilter';
		 
		 $this->ajax_pagination->initialize($config);

		 $conditions = array(
		 	'limit' => $this->perPage
		 );


		$data['title'] = 'Latest Users';
		// $data['categories'] = $this->Category_Model->get_categoriesPage();
		$data['categories'] = $this->Category_Model->get_categories();
		
		$this->load->view('generalTheme/header');
		$this->load->view('generalTheme/sidebar');
		$this->load->view('categories/category_list', $data);
		$this->load->view('generalTheme/footer');

		
	}

	public function posts($id)
	{
		$data['title'] = $this->Category_Model->get_category($id)->name;

		$data['posts'] = $this->Post_Model->get_posts_by_category($id);

		$this->load->view('templates/header');
		$this->load->view('posts/index', $data);
		$this->load->view('templates/footer');
	}


	// * delete category
	public function delete_categories()
	{
		$id = $this->input->post('chk');

		$track_id = $id;
		$ip = $this->User_Model->get_ip();
		// $comment = 'category updated id = ' . $last_id;
		$this->Category_Model->save_delete_history($track_id, $ip); //* save delege user history
		$this->ScoUrl_Model->deleteSco($id, "category_id="); //* save sco url
		if ($this->Category_Model->delete_category($id)) {
			
			$this->session->set_flashdata('success', 'Group has been deleted Successfully.');
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		// $this->Usergroup_Model->save_delete_history($id, $userid, $ip);	
	}

	// * search and filter data
	function ajaxPaginationCategory()
	{
		// Define offset 
		$page = $this->input->post('page');

		if (!$page) {
			$offset = 0;
		} else {
			$offset = $page;
		}
		$keywords = $this->input->post('keywords');
		$sortBy = $this->input->post('sortBy');
		if (!empty($keywords)) {
			$conditions['search']['keywords'] = $keywords;
		}
		if (!empty($sortBy)) {
			$conditions['search']['sortBy'] = $sortBy;
		}
		$conditions['returnType'] = 'count';
		// $totalRec = $this->User_Model->get_users(false, $conditions);
		$totalRec = $this->Category_Model->get_categoriesPage(false, $conditions);
		// Get record count 

		// Pagination configuration 
		$config['target']      = '#dataList';
		$config['base_url']    = base_url('Category/ajaxPaginationCategory/');
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		$config['link_func']   = 'searchFilter';

		// Initialize pagination library 
		$this->ajax_pagination->initialize($config);
		$conditions['start'] = $offset;
		$conditions['limit'] = $this->perPage;
		unset($conditions['returnType']);

		// Get records 
		// $data['users'] = $this->User_Model->get_users(false, $conditions);
		$data['categories'] = $this->Category_Model->get_categoriesPage(false, $conditions);
		$data['start'] = $offset;
		// Load the data list view 
		
		$this->load->view('categories/ajaxdata', $data, false);
	}

	
}
