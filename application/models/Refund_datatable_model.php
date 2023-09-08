<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Refund_datatable_model extends CI_Model {
 
    var $table = 'tbl_refund';

    var $column_order = array('','enquiry.enquiry_id','enquiry.name','enquiry.email','enquiry.phone','enquiry.created_by','enquiry.aasign_to'); //set column field database for datatable orderable

    var $column_search = array('enquiry.status','tbl_country.country_name','tbl_refund.created_date','tbl_refund.r_remark','enquiry.branch_name','enquiry.name_prefix','enquiry.enquiry_id','enquiry.name','enquiry.lastname','enquiry.email','enquiry.phone',"CONCAT(tbl_admin.s_display_name,' ',tbl_admin.last_name )","CONCAT(tbl_admin2.s_display_name,' ',tbl_admin2.last_name,tags.title)"); //set column field database for datatable searchable 

    var $column_order_pay = array('','payment_history.uid','payment_history.pay_email','payment_history.pay_mobile','payment_history.txnid','payment_history.amount','payment_history.response','payment_history.created_date'); //set column field database for datatable orderable

    var $column_search_pay = array('payment_history.uid','payment_history.pay_email','payment_history.pay_mobile','payment_history.txnid','payment_history.amount','payment_history.response','payment_history.created_date',"CONCAT(enquiry.name_prefix,' ',enquiry.name,' ',enquiry.lastname)"); //set column field database for datatable searchable 

    var $order = array('enquiry.enquiry_id' => 'desc'); // default order


function get_datatables(){
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);            
        $this->db->group_by('tbl_refund.enquiry_id');        
        $query = $this->db->get();
        return $query->result();
    }

function pay_get_datatables(){
        $this->pay_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);            
        $this->db->group_by('payment_history.txnid');        
        $query = $this->db->get();
        return $query->result();
    }

private function pay_get_datatables_query(){    
 
       $this->db->from('payment_history');       
       
        $user_id   = $this->session->user_id;       
        $where='';
        $payment_filters_sess   =   $this->session->payment_filters_sess;
        
        $from_created           =   !empty($payment_filters_sess['from_created'])?$payment_filters_sess['from_created']:'';
        $to_created             =   !empty($payment_filters_sess['to_created'])?$payment_filters_sess['to_created']:'';
        $email                  =   !empty($payment_filters_sess['email'])?$payment_filters_sess['email']:'';
        $employee               =   !empty($payment_filters_sess['employee'])?$payment_filters_sess['employee']:''; 
        $phone                  =   !empty($payment_filters_sess['phone'])?$payment_filters_sess['phone']:'';

        $select = "payment_history.uid,payment_history.pay_email,payment_history.pay_mobile,payment_history.txnid,payment_history.amount,payment_history.response,payment_history.created_date,enquiry.name_prefix,enquiry.name,enquiry.lastname";
    
        $this->db->select($select);
        $this->db->join('enquiry', 'enquiry.email = payment_history.pay_email', 'left');
        $where.=" payment_history.id!=0";

        if(!empty($from_created) && !empty($to_created)){
            $from_created = date("Y-m-d",strtotime($from_created));
            $to_created = date("Y-m-d",strtotime($to_created));
            $where .= " AND DATE(payment_history.created_date) >= '".$from_created."' AND DATE(payment_history.created_date) <= '".$to_created."'";
        }
        if(!empty($from_created) && empty($to_created)){
            $from_created = date("Y-m-d",strtotime($from_created));
            $where .= " AND DATE(payment_history.created_date) >=  '".$from_created."'";                        
        }
        if(empty($from_created) && !empty($to_created)){            
            $to_created = date("Y-m-d",strtotime($to_created));
            $where .= " AND DATE(payment_history.created_date) <=  '".$to_created."'";                                    
        }

        if(!empty($employee)){          
            $where .= " AND CONCAT_WS(' ',enquiry.name_prefix,enquiry.name,enquiry.lastname) LIKE  '%$employee%' ";
        }

        if(!empty($email)){ 
            $where .= " AND payment_history.pay_email =  '".$email."'";                                    
        }

        if(!empty($phone)){            
           
            $where .= " AND payment_history.pay_mobile =  '".$phone."'";                                    
        }

        $this->db->where($where);
            

        $i = 0;
     
        foreach ($this->column_search_pay as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search_pay) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }   
        
       
        if(isset($_POST['order'])) // here order processing
        {
            if(!empty($this->column_order_pay[$_POST['order']['0']['column']]) and $this->column_order_pay[$_POST['order']['0']['column']] < count($this->column_order_pay)){
                
                $this->db->order_by($this->column_order_pay[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
            }else{
                
                //$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }
            
        } 
        else if(isset($this->order))
        {

            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    private function _get_datatables_query(){    
       $all_reporting_ids    =   $this->common_model->get_categories($this->session->user_id);
       $this->db->from($this->table);       
       
        $user_id   = $this->session->user_id;       
        $where='';
        $refund_filters_sess   =   $this->session->refund_filters_sess;
        $top_filter             =   !empty($refund_filters_sess['top_filter'])?$refund_filters_sess['top_filter']:'';        
        $from_created           =   !empty($refund_filters_sess['from_created'])?$refund_filters_sess['from_created']:'';       
        $to_created             =   !empty($refund_filters_sess['to_created'])?$refund_filters_sess['to_created']:'';
        $email                  =   !empty($refund_filters_sess['email'])?$refund_filters_sess['email']:'';
        $employee               =   !empty($refund_filters_sess['employee'])?$refund_filters_sess['employee']:''; 
        $phone                  =   !empty($refund_filters_sess['phone'])?$refund_filters_sess['phone']:'';
        $createdby              =   !empty($refund_filters_sess['createdby'])?$refund_filters_sess['createdby']:'';
        $assign                 =   !empty($refund_filters_sess['assign'])?$refund_filters_sess['assign']:'';
        $stage                  =   !empty($refund_filters_sess['stage'])?$refund_filters_sess['stage']:'';
        $tags                   =   !empty($refund_filters_sess['tag'])?$refund_filters_sess['tag']:'';
        $final                  =   !empty($refund_filters_sess['final'])?$refund_filters_sess['final']:'';
        $status                 =   !empty($refund_filters_sess['status'])?$refund_filters_sess['status']:'';
//print_r($from_created);exit;
        $select = "tbl_country.country_name as final_country,enquiry.name_prefix,enquiry.enquiry_id,enquiry.created_by,enquiry.aasign_to,enquiry.Enquery_id,enquiry.name,enquiry.lastname,enquiry.email,enquiry.phone,enquiry.created_date,lead_stage.lead_stage_name,CONCAT(tbl_admin.s_display_name,' ',tbl_admin.last_name) as created_by_name,CONCAT(tbl_admin2.s_display_name,' ',tbl_admin2.last_name) as assign_to_name,enquiry_tags.refund_tagids,tbl_refund.consultant_name,tbl_refund.cancellation_person,tbl_refund.cancellation_person,tbl_refund.enquiry_id as refund_enq,tbl_refund.created_date,tbl_refund.r_remark,enquiry.branch_name,enquiry.status";
    
        $this->db->select($select);
        //$this->db->join('tbl_refund', 'tbl_refund.enquiry_id = enquiry.Enquery_id', 'left');
        $this->db->join('enquiry', 'enquiry.Enquery_id = tbl_refund.enquiry_id', 'left');                
        $this->db->join('lead_stage','lead_stage.stg_id = enquiry.lead_stage','left');   
        $this->db->join('tbl_admin as tbl_admin', 'tbl_admin.pk_i_admin_id = enquiry.created_by', 'left');
        $this->db->join('tbl_admin as tbl_admin2', 'tbl_admin2.pk_i_admin_id = enquiry.aasign_to', 'left');   
        $this->db->join('tbl_country','enquiry.country_id = tbl_country.id_c','left');
        $this->db->join('enquiry_tags','enquiry_tags.enq_id=enquiry.enquiry_id','left');
        $this->db->join('tags','tags.comp_id=enquiry.comp_id','left');

        $where.=" enquiry.drop_status=0";
                          
        if(isset($enquiry_filters_sess['lead_stages']) && $enquiry_filters_sess['lead_stages'] !=-1){
            $stage  =   $enquiry_filters_sess['lead_stages'];
            $where .= " AND enquiry.lead_stage=$stage";
        }  
        $where .= " AND ( tbl_refund.created_by IN (".implode(',', $all_reporting_ids).')';
        $where .= " OR tbl_refund.updated_by IN (".implode(',', $all_reporting_ids).'))';          


        if(!empty($tags)){
            $where .= " AND FIND_IN_SET($tags,enquiry_tags.refund_tagids) > 0 ";
        }

        if(!empty($from_created) && !empty($to_created)){
            $from_created = date("Y-m-d",strtotime($from_created));
            $to_created = date("Y-m-d",strtotime($to_created));
            $where .= " AND DATE(tbl_refund.created_date) >= '".$from_created."' AND DATE(tbl_refund.created_date) <= '".$to_created."'";
        }
        if(!empty($from_created) && empty($to_created)){
            $from_created = date("Y-m-d",strtotime($from_created));
            $where .= " AND DATE(tbl_refund.created_date) >=  '".$from_created."'";                        
        }
        if(empty($from_created) && !empty($to_created)){            
            $to_created = date("Y-m-d",strtotime($to_created));
            $where .= " AND DATE(tbl_refund.created_date) <=  '".$to_created."'";                                    
        }

        if(!empty($employee)){          
            $where .= " AND CONCAT_WS(' ',enquiry.name_prefix,enquiry.name,enquiry.lastname) LIKE  '%$employee%' ";
        }
        if(!empty($email)){ 
            $where .= " AND enquiry.email =  '".$email."'";                                    
        }

        if(!empty($phone)){            
           
            $where .= " AND enquiry.phone =  '".$phone."'";                                    
        }
        if(!empty($createdby)){            
           
            $where .= " AND enquiry.created_by =  '".$createdby."'";                                    
        }
         if(!empty($assign)){            
           
            $where .= " AND enquiry.aasign_to =  '".$assign."'";                                    
        }

        if(!empty($stage)){

            $where .= " AND enquiry.lead_stage='".$stage."'"; 

        }


if(!empty($final)){
    $where .= " AND enquiry.country_id='".$final."'"; 
}

if(!empty($status)){
    $where .= " AND enquiry.status='".$status."'"; 
}

        $this->db->where($where);
            

        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        
        
            if(!empty($_POST['search']['value'])) // if datatable send POST for search
            {
                $compid = $this->session->companey_id;
                $val = $_POST['search']['value'];
                $this->db->or_where("enquiry.enquiry_id IN (SELECT parent FROM extra_enquery WHERE cmp_no = '$compid' AND fvalue LIKE '%{$val}%')");
                
            }   
        
       
        if(isset($_POST['order'])) // here order processing
        {
            if(!empty($this->column_order[$_POST['order']['0']['column']]) and $this->column_order[$_POST['order']['0']['column']] < count($this->column_order)){
                
                $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
            }else{
                
                //$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }
            
        } 
        else if(isset($this->order))
        {

            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function count_all()
    {
        $all_reporting_ids    =   $this->common_model->get_categories($this->session->user_id);

        $this->db->from($this->table);        
        $where = "";
        $datatype = $_POST['data_type'];
        $where.=" tbl_refund.enquiry_id!=''";
        $user_id   = $this->session->user_id;
        $user_role = $this->session->user_role;

        $where .= " AND ( tbl_refund.created_by IN (".implode(',', $all_reporting_ids).')';
        $where .= " OR tbl_refund.updated_by IN (".implode(',', $all_reporting_ids).'))';  

        /*$enquiry_filters_sess    =   $this->session->enquiry_filters_sess;        
        $product_filter = !empty($enquiry_filters_sess['product_filter'])?$enquiry_filters_sess['product_filter']:'';

        if(!empty($this->session->process) && empty($product_filter)){   
        $arr = $this->session->process; 
        if(is_array($arr)){
            $where.=" AND enquiry.product_id IN (".implode(',', $arr).')';
        }            
        }else if (!empty($this->session->process) && !empty($product_filter)) {
            $where.=" AND enquiry.product_id IN (".implode(',', $product_filter).')';            
        }*/


        $this->db->where($where);
        $data_type = $_POST['data_type'];    
        
        $this->db->group_by('tbl_refund.enquiry_id');
        

        return $this->db->count_all_results();
    }

    public function pay_count_all()
    {
        $this->db->from('payment_history');        
        $where = "";
        $where.=" payment_history.id!='0'";
        $this->db->where($where);           
        $this->db->group_by('payment_history.txnid');
        return $this->db->count_all_results();
    }

    function pay_count_filtered()
    {
        $this->pay_get_datatables_query();
        $where = "";        
        $this->db->group_by('payment_history.txnid');
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();

        $where = "";
        $user_id   = $this->session->user_id;
        $user_role = $this->session->user_role;
        
        /*$all_reporting_ids    =   $this->common_model->get_categories($this->session->user_id);
        $where .= " AND ( enquiry.created_by IN (".implode(',', $all_reporting_ids).')';
        $where .= " OR enquiry.aasign_to IN (".implode(',', $all_reporting_ids).'))';  
        $this->db->where($where);*/

        $data_type = $_POST['data_type'];    
        
        $this->db->group_by('tbl_refund.enquiry_id');
        


        $query = $this->db->get();
        return $query->num_rows();
    }

}