<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Map_model extends CI_Model {


    public function get_users_map_feed($id) {
        $this->db->select("map_location_feed.id,tbl_admin.pk_i_admin_id,tbl_admin.employee_id,tbl_admin.s_display_name,tbl_admin.last_name,tbl_admin.s_user_email,tbl_admin.s_phoneno");
        $this->db->from('map_location_feed');        
        $this->db->join('tbl_admin', 'tbl_admin.pk_i_admin_id=map_location_feed.uid');        
        $this->db->group_by('map_location_feed.uid');
        $cid    =   $this->session->companey_id;
        $where = "tbl_admin.companey_id=$cid ";
        $where .= " AND map_location_feed.uid=$id ";        
        
        $filter_date = $this->session->attendance_filter_date;
        if(!empty($filter_date)){
            $where .=  " AND DATE(map_location_feed.created_date)='".$filter_date."'";   		  
        }else{
            $where .=  " AND DATE(map_location_feed.created_date)=CURDATE()";             
        }
        $this->db->where($where);
        $this->db->order_by('map_location_feed.id','DESC');
        $res = $this->db->get()->row();
        //echo $this->db->last_query();
        return $res;
    }

}