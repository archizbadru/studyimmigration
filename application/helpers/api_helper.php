<?php
    function is_user_access_api($userno = "", $text = null)
    {  
        $ci =& get_instance();
        $ci->load->database();
        $panel_menu = $ci->db->select("tbl_user_role.user_permissions")
         ->where('pk_i_admin_id', $userno)
         ->join('tbl_user_role','tbl_user_role.use_id=tbl_admin.user_permissions')
         ->get('tbl_admin')
         ->row();
        if (!empty($panel_menu->user_permissions)) {
             $module=explode(',',$panel_menu->user_permissions);
	    if (in_array($text,$module)){
	         return true;
		}else{
		    return false;  
		}
        } else {
            return false; 
        } 
    }