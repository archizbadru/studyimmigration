<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
    
    function tab_content($tid,$comp_id,$enquiry_id=0,$tabname=''){		
    	
    	$ci =& get_instance();
        $data['tid'] = $tid;
		$data['comp_id'] = $comp_id;
 		$ci->db->select('*,input_types.title as input_type_title'); 		
 		$ci->db->where('tbl_input.form_id',$tid);  			
 		$ci->db->where('tbl_input.company_id',$comp_id);  			
 		$ci->db->join('input_types','input_types.id=tbl_input.input_type');  			
 		$data['form_fields']	= $ci->db->get('tbl_input')->result_array();
 		$data['details'] 		= $ci->Leads_Model->get_leadListDetailsby_id($enquiry_id); 
 		$data['basic_fields']	= $ci->User_model->get_input_basic_fields($comp_id); 		
 		$data['dynamic_field']  = $ci->enquiry_model->get_dyn_fld($enquiry_id,$tid);
        $data['products'] 		= $ci->dash_model->get_user_product_list(); 
        $data['product_contry'] = $ci->location_model->productcountry();
        $data['leadsource'] 	= $ci->Leads_Model->get_leadsource_list();

        $ci->db->select('form_type');
        $ci->db->where('id',$tid);        
        $r    =      $ci->db->get('forms')->row_array();
        $data['form_type'] = $r['form_type'];
    	
        $data['state_list'] 	= $ci->location_model->estate_list();
        $data['city_list'] 			= $ci->location_model->ecity_list();
        $data['all_country_list'] 	= $ci->location_model->country();
        $data['name_prefix'] 		= $ci->enquiry_model->name_prefix_list();
        $data['tabname'] = $tabname;       

    	return $ci->load->view('enquiry/enquiry_tab_content',$data,true);    
    }
?>