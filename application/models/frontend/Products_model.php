<?php
class Products_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('db_tables');
        $this->db_tables->index();
    }

    // !get products
    public function get_products($seo = '')
    {
        // $query = $this->db->get_where("tr_products", $id);
        // return $query->result();
        $query = $this->db->query("Select * from " . DB_SEO_URL . " se LEFT JOIN " . DB_PRODUCTS . " p ON TRIM(BOTH 'seller_id=' FROM se.query) = p.seller_id where se.query LIKE 'seller_id=%' AND se.keyword LIKE '$seo'");
        return $query->result();
    }

    public function get_seller_metadata($seo)
    {
        $query = $this->db->query("Select * from " . DB_SEO_URL . " se LEFT JOIN " . DB_SELLER_HOME_CONTENT . " h ON TRIM(BOTH 'seller_id=' FROM se.query) = h.seller_id where se.query LIKE 'seller_id=%' AND se.keyword LIKE '$seo'");
        return $query->row();
    }

    public function get_product_details($seo)
    {

        $query = $this->db->query("Select * from " . DB_SEO_URL . " se LEFT JOIN " . DB_PRODUCTS . " p ON TRIM(BOTH 'product_id=' FROM se.query) = p.id where se.query LIKE 'product_id=%' AND se.keyword LIKE '$seo'");
        return $query->row_array();
    }
    public function get_releted_products($id)
    {

        $query = $this->db->query("Select * from " . DB_PRODUCTS . " p where p.category_id = $id");
        return $query->result_array();
    }

    // !get search product
    public function get_search_products($product = '', $filter_catefory = '')
    {
        if ($filter_catefory) {
            $sql = "
                SELECT c.id as category_id, c.parent_id as category_parent_id, c.category_name as category_name, c.category_description as category_description, c.status as category_status, 
                p.id as product_id, p.seller_id as p_seller_id, p.category_id as p_category_id, p.product_name as p_product_name, p.product_model as p_product_model, p.product_image as p_product_image, p.product_description as p_product_description, p.status as p_status,
                s.id as seller_id, s.email as seller_email, s.mobile as seller_mobile, s.firstname as seller_firstname, s.lastname as seller_lastname, s.gst_number as seller_gst_bumber, s.email_verify as seller_email_verify, s.mobile_verify as seller_mobile_verify, s.status as seller_status,
                sm.id as sm_id, sm.membership_id as sm_membership_id, sm.seller_id as sm_seller_id, sm.category_id as sm_category_id, sm.name as sm_package_name, sm.start_date as sm_start_date, sm.end_added as sm_end_added, sm.status as sm_status
                FROM ". DB_CATEGORY ." c 
                LEFT JOIN ". DB_PRODUCTS . " p ON (c.id = p.category_id)
                LEFT JOIN ". DB_SELLER . " s ON (p.seller_id = s.id)
                LEFT JOIN ". DB_SELLER_MEMBERSHIP . " sm ON (s.id = sm.seller_id)
                WHERE c.category_name = '$filter_catefory' AND c.status = 1 GROUP BY seller_id
            ";
            // exit;
            $query = $this->db->query($sql);
            return $query->result();
        } else {
            $sql = "
                SELECT p.id as product_id, p.seller_id as p_seller_id, p.category_id as p_category_id, p.product_name as p_product_name, p.product_model as p_product_model, p.product_image as p_product_image, p.product_description as p_product_description, p.status as p_status, 
                s.id as seller_id, s.email as seller_email, s.mobile as seller_mobile, s.firstname as seller_firstname, s.lastname as seller_lastname, s.gst_number as seller_gst_bumber, s.email_verify as seller_email_verify, s.mobile_verify as seller_mobile_verify, s.status as seller_status,
                c.id as category_id, c.parent_id as category_parent_id, c.category_name as category_name, c.category_description as category_description, c.status as category_status, 
                sm.id as sm_id, sm.membership_id as sm_membership_id, sm.seller_id as sm_seller_id, sm.category_id as sm_category_id, sm.name as sm_package_name, sm.start_date as sm_start_date, sm.end_added as sm_end_added, sm.status as sm_status
                FROM " .  DB_PRODUCTS . " p
                LEFT JOIN " . DB_CATEGORY . " c ON (p.category_id = c.id)
                RIGHT JOIN " . DB_SELLER . " s ON (p.seller_id = s.id)
                LEFT JOIN " . DB_SELLER_MEMBERSHIP . " sm ON (s.id = sm.seller_id)
                WHERE (p.product_name LIKE '%$product%' OR p.product_description LIKE '%$product%') AND p.status = 1 AND s.status = 1 AND c.status = 1  GROUP BY seller_id
            ";
            // exit;
            $query = $this->db->query($sql);
            return $query->result();
        }
    }
}
