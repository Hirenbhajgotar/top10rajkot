<?php
class Seller_model extends CI_Model
{
    // 
    public function get_seller_membership($id = '')
    {
        if ($id) {
            // $query = $this->db->query("SELECT sm.*, s.* FROM `tr_seller_membership` sm LEFT JOIN `tr_seller` s ON (sm.id = s.id) WHERE sm.category_id = 84");
            $query = $this->db->select("seller_id")
                ->where(['category_id' => $id])
                ->from("tr_seller_membership")
                ->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        } else {
        }
    }

    
    // *get seller
    public function get_seller($id = '')
    {
        if ($id) {
            $query = $this->db->where(['id' => $id])
                ->where(['status' => 1])
                ->get("tr_seller");
            return $query->row();
        } else {
            $query = $this->db->order_by('firstname')
                              ->get("tr_seller");
            return $query->result();
        }
    }

    // * seller home content
    public function seller_all_info($id = '')
    {
        if ($id) {
            $query = $this->db->query("
                SELECT s.*, shc.*
                FROM `tr_seller` s
                LEFT JOIN `tr_seller_home_content` shc ON (s.id = shc.seller_id)
                WHERE s.id = $id AND s.status = 1
            ");
            return $query->row();
        }
    }


    // * seller info
    public function seller_info($id = '')
    {
        // $query = $this->db->query("SELECT b.id as banner_id, b.seller_id as b_seller_id, b.position as banner_position, b.name as banner_name, b.status as banner_status, s.id as s_seller_id, s.email as seller_email, s.mobile as seller_mobile, s.firstname as seller_firstname, s.lastname as seller_lastname, s.gst_number as seller_gst_number, s.last_login as seller_last_login, s.status as seller_status, bi.id as bi_id, bi.title as bi_title, bi.link as bi_link, bi.image as bi_image, bi.short_order as bi_short_order FROM `tr_banner` b LEFT JOIN `tr_seller` s ON (b.seller_id = s.id) LEFT JOIN `tr_banner_image` bi ON (b.id = bi.banner_id) WHERE b.seller_id = $id AND b.status = 1 AND bi.status = 1 AND s.status = 1");
        $query = $this->db->query(
            "SELECT b.id as banner_id, b.seller_id as b_seller_id, b.position as banner_position, b.name as banner_name, b.status as banner_status, 
            s.id as s_seller_id, s.email as seller_email, s.mobile as seller_mobile, s.firstname as seller_firstname, s.lastname as seller_lastname, s.gst_number as seller_gst_number, s.last_login as seller_last_login, s.status as seller_status, 
            bi.id as bi_id, bi.title as bi_title, bi.link as bi_link, bi.image as bi_image, bi.short_order as bi_short_order, 
            shc.id as shc_id, shc.logo_image as shc_logo_image, shc.description as shc_description
            FROM `tr_seller_banner` b 
            LEFT JOIN `tr_seller` s ON (b.seller_id = s.id) 
            LEFT JOIN `tr_banner_image` bi ON (b.id = bi.banner_id)
            LEFT JOIN `tr_seller_home_content` shc ON (s.id = shc.seller_id) 
            WHERE b.seller_id = 39 AND b.status = 1 AND bi.status = 1 AND s.status = 1 AND shc.status = 1"
        );
        return $query->row();
    }
}
