<?php 
class Categories_model extends CI_Model
{
    // * features categories
    public function get_feature_categories()
    {
        $sql = "SELECT C.*, seo.id as seo_id, seo.query as seo_query, seo.keyword as keyword
            FROM `tr_category` C
            LEFT JOIN `tr_seo_url` seo ON (c.id = TRIM(BOTH 'category_id=' FROM seo.query))
            WHERE feature_category = 1";
        $query = $this->db->query($sql);        
        return $query->result();
    }

    public function get_categories($id = '')
    {
        if ($id) {
            $query = $this->db->get_where("tr_category", $id);
            return $query->row();
        } else {
            $query = $this->db->select()
            ->from("tr_category")
            ->get();
            return $query->result();
        }
    }

    // *get category id
    public function get_cat_id($seo = '')
    {
        $query = $this->db->query("SELECT id, TRIM(BOTH 'category_id=' FROM query) as cate_id  FROM `tr_seo_url` WHERE `query` LIKE 'category_id=%' AND `keyword` LIKE '$seo'");                          
        return $query->row();
    }


    // *get products
    // public function get_products($id = '')
    // {
    //     $query = $this->db->query("
    //         SELECT distinct s.id as seller_id, s.email as seller_email, s.mobile as seller_mobile, s.firstname as seller_firstname, s.lastname as seller_lastname, s.gst_number as seller_gst_number, s.date_added as seller_date_added, s.email_verify as seller_email_verify, s.mobile_verify as seller_mobile_verify, p.*
    //         FROM `tr_products` p
    //         LEFT JOIN `tr_seller` s ON (p.seller_id = s.id)
    //         WHERE p.category_id = $id AND p.status = 1 AND s.status = 1
    //     ");
    //     return $query->result();
    // }

    public function get_products($id = '', $limit, $start)
    {
        $sql = "SELECT distinct s.id as seller_id, s.email as seller_email, s.mobile as seller_mobile, s.firstname as seller_firstname, s.lastname as seller_lastname, s.gst_number as seller_gst_number, s.date_added as seller_date_added, s.email_verify as seller_email_verify, s.mobile_verify as seller_mobile_verify, p.*
            FROM `tr_products` p
            LEFT JOIN `tr_seller` s ON (p.seller_id = s.id) WHERE p.category_id = $id AND p.status = 1 AND s.status = 1  ";

        if (!isset($start)) {
            $start = 0;
        }
        if (isset($limit)) {

            $sql .= "limit " . $start . ", " . $limit;
        }
        $query = $this->db->query($sql);
        return $query->result();
    }


    public function get_seller_seo($id = '')
    {
        $sql = "SELECT distinct se.keyword as keyword FROM `tr_seo_url` as se WHERE TRIM(BOTH 'seller_id=' FROM se.query) = $id  ";
        $query = $this->db->query($sql);
        return $query->row();
    }

    public function get_product_seo($id = '')
    {
        $sql = "SELECT distinct se.keyword as keyword FROM `tr_seo_url` as se WHERE TRIM(BOTH 'product_id=' FROM se.query) = $id  ";
        $query = $this->db->query($sql);
        return $query->row();
    }


    public function get_product($id = '')
    {
        $query = $this->db->query("
            SELECT distinct s.id as seller_id, s.email as seller_email, s.mobile as seller_mobile, s.firstname as seller_firstname, s.lastname as seller_lastname, s.gst_number as seller_gst_number, s.date_added as seller_date_added, s.email_verify as seller_email_verify, s.mobile_verify as seller_mobile_verify, p.*
            FROM `tr_products` p
            LEFT JOIN `tr_seller` s ON (p.seller_id = s.id)
            WHERE p.category_id = $id AND p.status = 1 AND s.status = 1
        ");

        return $query->num_rows();
    }  


}

?>