<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Report_datatable_model extends CI_Model {    
    public function __construct(){
        parent::__construct();
        $this->load->model('common_model');     
    }
    var $table = 'enquiry'; 

    public function _get_datatables_query($keyword){
        //print_r($keyword);exit;
        $employe = $this->session->userdata('employe1');
        if ($this->session->hier_wise && $employe) {
           $uid = $employe[0];
           $employe    =    $this->common_model->get_categories($uid);                  
        }else{
           $all_reporting_ids    =    $this->common_model->get_categories($this->session->user_id);      
        }

        $from = $this->session->userdata('from1');
        $to= $this->session->userdata('to1');
        $phone = $this->session->userdata('phone1');
        $country = $this->session->userdata('country1');
        $institute = $this->session->userdata('institute1');
        $center = $this->session->userdata('center1');
        $source = $this->session->userdata('source1');
        $subsource = $this->session->userdata('subsource1');
        $datasource = $this->session->userdata('datasource1');
        $state = $this->session->userdata('state1');
        $lead_source = $this->session->userdata('lead_source1');
        
        $sub_disposition = $this->session->userdata('sub_disposition');

        $lead_subsource = $this->session->userdata('lead_subsource1');
        $final_country = $this->session->userdata('final_country1');

        $in_take = $this->session->userdata('in_take1');
        $visa_type = $this->session->userdata('visa_type1');
        $preferred_country = $this->session->userdata('preferred_country1');
        $nationality = $this->session->userdata('nationality1');
        $residing_country = $this->session->userdata('residing_country1');

        $enq_product = $this->session->userdata('enq_product1');
        $drop_status = $this->session->userdata('drop_status1');
        $productlst = $this->session->userdata('productlst');
        $branch_name = $this->session->userdata('branch_name1');
        $all = $this->session->userdata('all1');        
        if($all){
            $select = 'city.city as city_id,state.state as state_id,call_status as call_status,log.json_data as call_json,tc1.country_name as rcName,tbl_country.country_name as ncountry_name,enquiry.preferred_country,tbl_visa_type.*,tbl_visa_type.visa_type as visa_type_name,enquiry.in_take,tbl_country.country_name,tbl_branch.b_name as branch_name,tbl_payment.reg_fee,tbl_payment.family_fee,tbl_payment.lawyer_fee,tbl_payment.consultancy_fee,tbl_payment.stamp,tbl_payment.tax_value_reg,tbl_payment.tax_value_family,tbl_payment.tax_value_lawyer,tbl_payment.tax_value_consultancy,tbl_payment.tax_value_stamp,tbl_payment.total_reg,tbl_payment.total_family,tbl_payment.total_lawyer,tbl_payment.total_consultancy,tbl_payment.total_stamp,enquiry.enquiry_id,enquiry.name_prefix,enquiry.name,enquiry.lastname,enquiry.phone,enquiry.update_date,enquiry.email,enquiry.gender,enquiry.enquiry as enq_remark,tbl_drop.drop_reason as drop_status,enquiry.drop_reason,enquiry.status,lead_source.lead_name,tbl_subsource.subsource_name,lead_description.description,enquiry.lead_discription_reamrk,lead_score.score_name as lead_score,enquiry.status as inq_status,enquiry.created_date as inq_created_date, CONCAT(tbl_admin.s_display_name,tbl_admin.last_name) as created_by_name,CONCAT(admin2.s_display_name,admin2.last_name) as assign_to_name,tbl_product.product_name,lead_stage2.lead_stage_name as followup_name,tbl_product_country.country_name as enq_product_name,

            tbl_refund.refund_eligiblity,tbl_refund.created_date as trdate,

            tbl_installment.pay_amt,tbl_installment.Pay_status,tbl_installment.pay_date,
            tbl_payment.taxabal_amt,tbl_payment.advance,tbl_payment.enq_id,
            (SELECT SUM(onetime_pay_amt) FROM tbl_payment WHERE tbl_payment.status = 1 AND tbl_payment.enq_id = enquiry.Enquery_id) as final,
            (SELECT SUM(recieved_amt) FROM tbl_installment WHERE tbl_installment.Pay_status = 1 AND tbl_installment.enq_id = tbl_payment.enq_id) as installment,
            tcg.approve_status,tcg.signed_file,tat.template_name,tcg.created_date as agrmt_date';
            }else{
                $select = 'city.city as city_id,state.state as state_id,call_status as call_status,log.json_data as call_json,tc1.country_name as rcName,tbl_country.country_name as ncountry_name,enquiry.preferred_country,tbl_visa_type.*,tbl_visa_type.visa_type as visa_type_name,enquiry.in_take,tbl_country.country_name,tbl_branch.b_name as branch_name,tbl_payment.reg_fee,tbl_payment.family_fee,tbl_payment.lawyer_fee,tbl_payment.consultancy_fee,tbl_payment.stamp,tbl_payment.tax_value_reg,tbl_payment.tax_value_family,tbl_payment.tax_value_lawyer,tbl_payment.tax_value_consultancy,tbl_payment.tax_value_stamp,tbl_payment.total_reg,tbl_payment.total_family,tbl_payment.total_lawyer,tbl_payment.total_consultancy,tbl_payment.total_stamp,enquiry.enquiry_id,enquiry.name_prefix,enquiry.name,enquiry.lastname,enquiry.phone,enquiry.update_date,enquiry.email,enquiry.gender,enquiry.enquiry as enq_remark,tbl_drop.drop_reason as drop_status,enquiry.drop_reason,enquiry.status,lead_source.lead_name,tbl_subsource.subsource_name,lead_description.description,lead_score.score_name as lead_score,enquiry.lead_discription_reamrk,lead_stage.lead_stage_name as followup_name,enquiry.status,enquiry.created_date as inq_created_date, CONCAT(tbl_admin.s_display_name,tbl_admin.last_name) as created_by_name,CONCAT(admin2.s_display_name,admin2.last_name) as assign_to_name,tbl_product.product_name,tbl_product_country.country_name as enq_product_name,

                tbl_refund.refund_eligiblity,tbl_refund.created_date as trdate,

                tbl_installment.pay_amt,tbl_installment.Pay_status,tbl_installment.pay_date,
                tbl_payment.taxabal_amt,tbl_payment.advance,tbl_payment.enq_id,
                (SELECT SUM(onetime_pay_amt) FROM tbl_payment WHERE tbl_payment.status = 1 AND tbl_payment.enq_id = enquiry.Enquery_id) as final,
                (SELECT SUM(recieved_amt) FROM tbl_installment WHERE tbl_installment.Pay_status = 1 AND tbl_installment.enq_id = tbl_payment.enq_id) as installment,
                tcg.approve_status,tcg.signed_file,tat.template_name,tcg.created_date as agrmt_date';
            }
            $select .= ',enquiry.company';
            $this->db->select($select);                    
            $where = "enquiry.enquiry_id > 0";

        if($keyword=='1'){      
            if ($from && $to) {
                $to = str_replace('/', '-', $to);
                $from = str_replace('/', '-', $from);            
                $from = date('Y-m-d', strtotime($from));
                $to = date('Y-m-d', strtotime($to));            
                $where .= " AND Date(enquiry.created_date) >= '$from' AND Date(enquiry.created_date) <= '$to'";
            } else if ($from && !$to) {
                $from = str_replace('/', '-', $from);            
                $from = date('Y-m-d H:i:s', strtotime($from));
                $where .= " AND enquiry.created_date LIKE '%$from%'";
            } else if (!$from && $to) {            
                $to = str_replace('/', '-', $to);            $to = date('Y-m-d H:i:s', strtotime($to));
                $where .= " AND enquiry.created_date LIKE '%$to%'";
            }
        }else if($keyword=='2'){      
            if ($from && $to) {
                $to = str_replace('/', '-', $to);
                $from = str_replace('/', '-', $from);            
                $from = date('Y-m-d', strtotime($from));
                $to = date('Y-m-d', strtotime($to));            
                $where .= " AND Date(tbl_payment.created_date) >= '$from' AND Date(tbl_payment.created_date) <= '$to'";
            } else if ($from && !$to) {
                $from = str_replace('/', '-', $from);            
                $from = date('Y-m-d H:i:s', strtotime($from));
                $where .= " AND tbl_payment.created_date LIKE '%$from%'";
            } else if (!$from && $to) {            
                $to = str_replace('/', '-', $to);            $to = date('Y-m-d H:i:s', strtotime($to));
                $where .= " AND tbl_payment.created_date LIKE '%$to%'";
            }
        }else if($keyword=='3'){      
            if ($from && $to) {
                $to = str_replace('/', '-', $to);
                $from = str_replace('/', '-', $from);            
                $from = date('Y-m-d', strtotime($from));
                $to = date('Y-m-d', strtotime($to));            
                $where .= " AND Date(tbl_refund.created_date) >= '$from' AND Date(tbl_refund.created_date) <= '$to'";
            } else if ($from && !$to) {
                $from = str_replace('/', '-', $from);            
                $from = date('Y-m-d H:i:s', strtotime($from));
                $where .= " AND tbl_refund.created_date LIKE '%$from%'";
            } else if (!$from && $to) {            
                $to = str_replace('/', '-', $to);            $to = date('Y-m-d H:i:s', strtotime($to));
                $where .= " AND tbl_refund.created_date LIKE '%$to%'";
            }
        }else if($keyword=='4'){      
            if ($from && $to) {
                $to = str_replace('/', '-', $to);
                $from = str_replace('/', '-', $from);            
                $from = date('Y-m-d', strtotime($from));
                $to = date('Y-m-d', strtotime($to));            
                $where .= " AND Date(tbl_client_agreement.created_date) >= '$from' AND Date(tbl_client_agreement.created_date) <= '$to'";
            } else if ($from && !$to) {
                $from = str_replace('/', '-', $from);            
                $from = date('Y-m-d H:i:s', strtotime($from));
                $where .= " AND tbl_client_agreement.created_date LIKE '%$from%'";
            } else if (!$from && $to) {            
                $to = str_replace('/', '-', $to);            $to = date('Y-m-d H:i:s', strtotime($to));
                $where .= " AND tbl_client_agreement.created_date LIKE '%$to%'";
            }
        }else if($keyword=='5'){      
            if ($from && $to) {
                $to = str_replace('/', '-', $to);
                $from = str_replace('/', '-', $from);            
                $from = date('Y-m-d', strtotime($from));
                $to = date('Y-m-d', strtotime($to));            
                $where .= " AND Date(log.created_date) >= '$from' AND Date(log.created_date) <= '$to'";
            } else if ($from && !$to) {
                $from = str_replace('/', '-', $from);            
                $from = date('Y-m-d H:i:s', strtotime($from));
                $where .= " AND log.created_date LIKE '%$from%'";
            } else if (!$from && $to) {            
                $to = str_replace('/', '-', $to);            $to = date('Y-m-d H:i:s', strtotime($to));
                $where .= " AND log.created_date LIKE '%$to%'";
            }
        }

           if($employe!=''){                        
                $where .= " AND ( enquiry.created_by IN (".implode(',', $employe).')';
                $where .= " OR enquiry.aasign_to IN (".implode(',', $employe).'))';           
            }else{
                $where .= " AND ( enquiry.created_by IN (".implode(',', $all_reporting_ids).')';
                $where .= " OR enquiry.aasign_to IN (".implode(',', $all_reporting_ids).'))';  
            }    
            if($source!=''){
               $where .= " AND enquiry.enquiry_source IN (".implode(',', $source).')';  
            }
            if($subsource!=''){
               $where .= " AND enquiry.sub_source IN (".implode(',', $subsource).')';
            }
            if($datasource!=''){
               $where .= " AND enquiry.datasource_id IN (".implode(',', $datasource).')';  
            }
            if($state!=''){
               $where .= " AND enquiry.status IN (".implode(',', $state).')';  
            }
            if ($lead_source != '') {                
                $where .= " AND enquiry.lead_stage IN (".implode(',', $lead_source).')';
            }
            if ($sub_disposition != '') {                
                $where .= " AND enquiry.lead_discription IN (".implode(',', $sub_disposition).')';
            }
            if ($final_country != '') {                
                $where .= " AND enquiry.country_id IN (".implode(',', $final_country).')';
            }

if($in_take != ''){
    $where .= " AND (enquiry.in_take LIKE '%$in_take[0]%'";
            foreach ($in_take as $value) {
                 $where .= " OR enquiry.in_take LIKE '%$value%'";
                } 
                $where .= ")";
}
if($visa_type != ''){
    $where .= " AND (enquiry.visa_type='".$visa_type[0]."'";
            foreach ($visa_type as $value) {
                 $where .= " OR enquiry.visa_type='".$value."'";
                } 
                $where .= ")";
}
if($preferred_country != ''){
      $where .=" AND FIND_IN_SET('".implode(',', $preferred_country)."', enquiry.preferred_country)";
    //$where .= " AND enquiry.preferred_country IN='".$preferred."'"; 
}
if($nationality != ''){
    $where .= " AND (enquiry.nationality='".$nationality[0]."'";
            foreach ($nationality as $value) {
                 $where .= " OR enquiry.nationality='".$value."'";
                } 
                $where .= ")"; 
}
if($residing_country != ''){

    $where .= " AND (enquiry.residing_country='".$residing_country[0]."'";
            foreach ($residing_country as $value) {
                 $where .= " OR enquiry.residing_country='".$value."'";
                } 
                $where .= ")";
}

            if ($branch_name != '') { 
                 $where .= " AND (enquiry.branch_name LIKE '%$branch_name[0]%'";
            foreach ($branch_name as $value) {
                 $where .= " OR enquiry.branch_name LIKE '%$value%'";
                } 
                $where .= ")";          
            }
            if($productlst!=''){
               $where .= " AND enquiry.enquiry_subsource IN (".implode(',', $productlst).')';  
            }
            if($enq_product!=''){
               $where .= " AND enquiry.product_id IN (".implode(',', $enq_product).')';  
            }
            if($all!=''){
                $where.= "AND comment_msg='Stage Updated'";
                $this->db->join('tbl_comment','tbl_comment.lead_id=enquiry.Enquery_id','inner');              
                $this->db->join('lead_stage as lead_stage2','lead_stage2.stg_id=tbl_comment.stage_id','left'); 
            }
            if($drop_status!=''){            
                if(!empty($drop_status[0])){
                    if($drop_status[0]=='dropped'){
                        $where .= " AND enquiry.drop_status>0 ";
                    }
                }
                if(!empty($drop_status[1])){
                    if($drop_status[1]=='active'){
                        $where .= " AND enquiry.status=1";
                    }
                }
                if(!empty($drop_status[0])=='dropped' && !empty($drop_status[1])=='active'){
                    $where .= " AND enquiry.drop_status>0 AND enquiry.status=1";
                }
            }
            $comp_id = $this->session->companey_id;            
            
            $this->db->join('tbl_product_country','tbl_product_country.id=enquiry.enquiry_subsource','left');   
            $this->db->join('lead_source','lead_source.lsid=enquiry.enquiry_source','left');            
            $this->db->join('tbl_product','tbl_product.sb_id=enquiry.product_id','left');   
            $this->db->join("(select * from tbl_subsource where comp_id=$comp_id) as tbl_subsource",'tbl_subsource.subsource_id=enquiry.sub_source','left');        
            
            $this->db->join('tbl_datasource','tbl_datasource.datasource_id=enquiry.datasource_id','left');
            $this->db->join('tbl_admin','tbl_admin.pk_i_admin_id=enquiry.created_by','left');
            $this->db->join('tbl_admin as admin2','admin2.pk_i_admin_id=enquiry.aasign_to','left');      
            $this->db->join('lead_stage','lead_stage.stg_id=enquiry.lead_stage','left');        
            $this->db->join('lead_description','lead_description.id=enquiry.lead_discription','left');
            $this->db->join('tbl_drop','tbl_drop.d_id=enquiry.drop_status','left');
            $this->db->join('lead_score','lead_score.sc_id=enquiry.lead_score','left');
            $this->db->join('tbl_payment','tbl_payment.enq_id=enquiry.Enquery_id','left');
            $this->db->join('tbl_installment','tbl_installment.enq_id=tbl_payment.enq_id','left');
            $this->db->join('tbl_refund','tbl_refund.enquiry_id=enquiry.Enquery_id','left');
            $this->db->join('tbl_country','tbl_country.id_c=enquiry.country_id','left');

            $this->db->join('city','city.id=enquiry.city_id','left');
            $this->db->join('state','state.id=enquiry.state_id','left');
            $this->db->join('tbl_branch','tbl_branch.id=enquiry.branch_name','left');

            $this->db->join('tbl_visa_type','enquiry.visa_type = tbl_visa_type.id','left');
            $this->db->join('tbl_country as tc1','enquiry.residing_country = tc1.id_c','left');

            $this->db->join('tbl_client_agreement as tcg','tcg.enq_id = enquiry.Enquery_id','left');
            $this->db->join('tbl_agreement_template as tat','tat.id=tcg.agreement_name','left');
            $this->db->join('tbl_col_log as log','log.enq_id=enquiry.enquiry_id','left');

            $this->db->where($where);        
            if(!$all){
                if($keyword=='1'){
                $this->db->group_by('enquiry.enquiry_id');
                }else if($keyword=='2'){
                $this->db->group_by('tbl_payment.id');
                }else if($keyword=='3'){
                $this->db->group_by('tbl_refund.id');
                }else if($keyword=='4'){
                $this->db->group_by('tcg.id');
                }else if($keyword=='5'){
                $this->db->where('log.cll_state','7');
                $this->db->group_by('log.id');
                }         
            }else{
                $this->db->order_by('enquiry.enquiry_id,tbl_comment.created_date','DESC');                    
            }        
    }
    function get_datatables($keyword,$from='',$to='',$employe='',$phone='',$country='',$institute='',$center='',$source='',$subsource='',$datasource='',$state='',$lead_source='',$lead_subsource='',$enq_product='',$drop_status='',$branch_name='',$all='',$final_country=''){

        $from = $this->session->set_userdata('from1',$from);
        $to= $this->session->set_userdata('to1',$to);   
        $phone = $this->session->set_userdata('phone1',$phone);
        $country = $this->session->set_userdata('country1',$country);
        $institute = $this->session->set_userdata('institute1',$institute);
        $center = $this->session->set_userdata('center1',$center);
        $source = $this->session->set_userdata('source1',$source);
        $subsource = $this->session->set_userdata('subsource1',$subsource);
        $datasource = $this->session->set_userdata('datasource1',$datasource);
        $state = $this->session->set_userdata('state1',$state);
        $lead_source = $this->session->set_userdata('lead_source1',$lead_source);        
        $lead_subsource = $this->session->set_userdata('lead_subsource1',$lead_subsource);
        $final_country = $this->session->set_userdata('final_country1',$final_country);
        $enq_product = $this->session->set_userdata('enq_product1',$enq_product);
        $drop_status = $this->session->set_userdata('drop_status1',$drop_status);
        $branch_name = $this->session->set_userdata('branch_name1',$branch_name);

        $this->_get_datatables_query($keyword);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    function get_datatables1($keyword){
//print_r($keyword);exit;
        $this->_get_datatables_query($keyword);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get($this->table);
        return $query->result();
    }
    function count_filtered($keyword){
        $this->_get_datatables_query($keyword);
        $where = "";
        $user_id   = $this->session->user_id;
        $user_role = $this->session->user_role;
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    public function count_all($keyword){
        $all_reporting_ids    =   $this->common_model->get_categories($this->session->user_id);
        $this->db->from($this->table);        
        $where = "";                        
        $where .= " (enquiry.created_by IN (".implode(',', $all_reporting_ids).')';
        $where .= " OR enquiry.aasign_to IN (".implode(',', $all_reporting_ids).'))';          
        $this->db->where($where);
        return $this->db->count_all_results();
    }
}