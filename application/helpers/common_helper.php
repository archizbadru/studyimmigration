<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
//For new students rights are put here all other comany
define('applicant', array('214','219','223','231'));
define('admin', array('196','216','218','222','228','230'));

    function is_active_field($id,$process=0){
    	$ci =& get_instance();
    	$comp_id	=	$ci->session->companey_id;
    	$where = "field_id=$id ";    	
    	if ($process) {
    		$where .= " AND (FIND_IN_SET('".$process."',process_id) OR process_id='')";
    	}
    	$where .= " AND comp_id=$comp_id AND status=1";
	    $ci->db->where($where);	    
	    $row  = $ci->db->get('enquiry_fileds_basic')->row_array();	    
	    if(!empty($row)){
	    	return true;
	    }else{
	    	if(!empty($row['status']) && $row['status']){
				return true;
	    	}else{
	    		return false;
	    	}
	    }
    }

    function expirePreviousOTP($user)
    {   

        $ci = & get_instance();
        $ci->load->database();
        $ci->db->set('reset_password',1);
        $ci->db->where('pk_i_admin_id',$user);
        $ci->db->update('tbl_admin');

        $ci->db->set('status',2);
        $ci->db->where('user_id',$user);
        $ci->db->update('tbl_otp');
    }

    function getOrderNumber($id)
    {
        $ci = & get_instance();
        $ci->load->database();
        $data = $ci->db->select('ord_no')->from('tbl_order')->where('id',$id)->get()->row();
        return $data->ord_no;
    }
    function getOrderTotal($arr)
    {   
        $price  = 0;
        $tax    = 0;
        $ci     = & get_instance();
        $ci->load->database();
        $data = $ci->db->select('total_price,tax')->from('tbl_order')->where('ord_no',$arr[0]->ord_no)->get()->result_array();
        $total = 0;
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $prod_tot = $value['total_price'];
                
                /*if (!empty($value['tax'])) {
                    $tax =   $prod_tot*$value['tax']/100;
                    $prod_tot += $tax;
                }*/
                $total += $prod_tot;
            }
        }
        //ord_no
        return $total;
        //print_r($arr);die;
    }
    function getPaidAmount($id)
    {
        $ci = & get_instance();
        $ci->load->database();
        $data = $ci->db->select('sum(pay) as paid')->from('payment')->where('ord_id',$id)->get()->row();
        return $data->paid;
    }

    function is_active_field_api($id,$process=0,$comp_id){       
        $ci =& get_instance();
        $comp_id    =   $comp_id;
        $where = "field_id=$id ";       
        if ($process) {
            $where .= " AND (FIND_IN_SET('".$process."',process_id) OR process_id='')";
        }
        $where .= " AND comp_id=$comp_id AND status=1";
        $ci->db->where($where);     
        $row  = $ci->db->get('enquiry_fileds_basic')->row_array();      
        if(!empty($row)){
            return true;
        }else{
            if($row['status']){
                return true;
            }else{
                return false;
            }
        }
    }
    function get_stage_name($id) {
        $ci = & get_instance();
        $ci->load->database();
        return $ci->db->get_where('lead_stage', array('stg_id'    => $id))->row_array() ['lead_stage_name'];
    }
    function get_drop_status_name($id) {
        $ci = & get_instance();
        $ci->load->database();
        return $ci->db->get_where('tbl_drop', array('d_id'=> $id))->row_array() ['drop_reason'];
    }

    function get_enquery_code($id_prefix='ENQ') {
        $code = genret_code();
        $code2 = $id_prefix.$code;
        // Get a reference to the controller object
        $CI = get_instance();
        // You may need to load the model if it hasn't been pre-loaded
        $CI->load->model('enquiry_model');
        $response = $CI->enquiry_model->check_existance($code2);    
        if ($response) {        
            $this->get_enquery_code();
        } else {        
            return $code2;
        }
    }
    
    function genret_code() {
        $pass  = "";
        $chars = array("0","1","2","3","4","5","6","7","8","9");
        for ($i=0;$i<12;$i++) {
            $pass .= $chars[mt_rand(0, count($chars) - 1)];
        }
        return $pass;
    }
    function curl($options){    
        $url     =  $options['url'];
        $curl = curl_init();        
        $curl_settings    =   array(
                                  CURLOPT_URL => $url,
                                  CURLOPT_RETURNTRANSFER => true,
                                  CURLOPT_ENCODING => "",
                                  CURLOPT_MAXREDIRS => 10,
                                  CURLOPT_TIMEOUT => 0,
                                  CURLOPT_FOLLOWLOCATION => true,
                                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                  CURLOPT_CUSTOMREQUEST => $options['request_type']
                                );
        
        if (!empty($options['header'])) {
            $curl_settings[CURLOPT_HTTPHEADER] = $options['header'];
        }
        
        if (!empty($options['data'])) {
            $curl_settings[CURLOPT_POSTFIELDS] = $options['data'];
        }

        curl_setopt_array($curl, $curl_settings);
        $response = curl_exec($curl);       
        curl_close($curl);
        return $response;
    }

    function getProcessBynme($process)
    {
        $ci =& get_instance();
        $ci->load->database();
        $Ary = $ci->db->select('sb_id')->from('tbl_product')->where_in('product_name',explode(",", $process))->where('comp_id',$ci->session->companey_id)->get()->result();

        $ary = array();
        if(!empty($Ary))
        {
            foreach ($Ary as $key => $value) {
                //print_r($value->sb_id);die;
                array_push($ary, $value->sb_id);
            }
        }
        return (!empty($ary)) ? implode(",", $ary): '';
    }

    function getUserByName($user)
    {
        $ci =& get_instance();
        $ci->load->database();
        $Ary = $ci->db->select('pk_i_admin_id')->from('tbl_admin')->where('s_user_email',"$user")->or_where('s_phoneno',$user)->get()->row();
        return (!empty($Ary)) ? $Ary->pk_i_admin_id : '';
    }

    function getUserRight($right)
    {
        $ci =& get_instance();
        $ci->load->database();
        $Ary = $ci->db->select('use_id')->from('tbl_user_role')->where('user_role',"$right")->where('comp_id',$ci->session->companey_id)->get()->row();
        return (!empty($Ary)) ? $Ary->use_id : '';
    }

    function checkAlreadyExist($value,$param)
    {
        $ci =& get_instance();
        $ci->load->database();
        $Ary = array();
        if($param == 'email')
        {      
            if($value !='')
            {
                $Ary = $ci->db->select('pk_i_admin_id')->from('tbl_admin')->where('s_user_email',"$value")->where('companey_id',$ci->session->companey_id)->get()->row();
            }
            
        }
        else
        {   
            if($value !="")
            {
                $Ary = $ci->db->select('pk_i_admin_id')->from('tbl_admin')->where('s_phoneno',"$value")->where('companey_id',$ci->session->companey_id)->get()->row();
            }
            
        }
        return (!empty($Ary)) ? "yes" : 'no';
    }