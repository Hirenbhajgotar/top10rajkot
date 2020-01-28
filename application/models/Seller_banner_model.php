<?php 
class Seller_banner_model extends CI_Model
{
    public function get_banner_info($id)
    {
        $query = $this->db->query(
            "SELECT b.id as banner_id, b.seller_id as b_seller_id, b.position as banner_position, b.name as banner_name, b.status as banner_status,
            bi.id as bi_id, bi.banner_id as bi_banner_id, bi.title as banner_title, bi.link as bi_link, bi.image as bi_image, bi.short_order as bi_short_order, bi.status as bi_status
            FROM `tr_seller_banner` b 
            LEFT JOIN `tr_banner_image` bi ON (b.id = bi.banner_id) 
            WHERE b.seller_id =". $id." AND b.status = 1 AND bi.status = 1"
        );
        return $query->result();
    }
}

?>