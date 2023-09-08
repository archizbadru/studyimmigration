<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
class Client_Model extends CI_Model
{
    private $table = "clients";
    public function get_Client_list()
    {
        $query = $this->db->get('enquiry');
        return $query->result();
    }
    
    public function clientdetail_by_id($client_id)
    {
        return $this->db->select("*")
                ->from('enquiry')
                ->join('lead_source', 'lead_source.lsid=enquiry.enquiry_source', 'left')
                ->join('tbl_admin', 'tbl_admin.pk_i_admin_id=enquiry.created_by','left')
               // ->join('tbl_product_country', 'tbl_product_country.id = enquiry.country_id', 'left')
                ->where('enquiry.enquiry_id', $client_id)->get()->row();
    }
    
    public function get_clientid_bycustomerCODE($leadcode)
    {
        $this->db->select("*");
        $this->db->from('clients');
        $this->db->where('customer_code', $leadcode);
        return $query = $this->db->get()->result();
    }

    
    public function clientContact_by_id($client_id)
    {
        return $this->db->select(" * ")->from('tbl_client_contacts')->where('client_id', $client_id)->get()->result();
    }
    public function clientadd($data)
    {
        $this->db->insert('clients', $data);
        
    }
    
    
    public function clientContact($data)
    {
        $this->db->insert('tbl_client_contacts', $data);
        
    }
	
	public function insert_installment($data)
    {
        $this->db->insert('tbl_installment', $data);
        
    }
    
    ////////////////////////////////////////////
    
    
    public function all_clients()
    {   
        $user_id          = $this->session->user_id;
        $user_role        = $this->session->user_role;
        $assign_country   = $this->session->country_id;
        
        $this->db->select("*,tbl_datasource.datasource_name,tbl_product.product_name as product_name");
        $this->db->from('enquiry');
        $this->db->join('tbl_datasource', 'enquiry.datasource_id=tbl_datasource.datasource_id', 'left');
        $this->db->join('tbl_product', 'tbl_product.sb_id = enquiry.product_id', 'left');

        $where = '';

        $where .= " enquiry.status=3";

        if ($user_role == 3) {
            
            $where .= " AND enquiry.country_id=".$assign_country;

            //$this->db->where('country_id', $assign_country);

        } elseif ($user_role == 8 || $user_role == 9) {
            
            $where.=" AND (enquiry.aasign_to=$user_id OR (enquiry.created_by=$user_id AND  enquiry.aasign_to IS NULL))";
           

            $process = $this->session->process;
            $where.= " AND enquiry.product_id=$process";



            //$this->db->where('aasign_to', $user_id);
            //$this->db->or_where('created_by', $user_id);

        }

        //$where .= " AND enquiry.client_drop_status=0";
        $where .= " AND enquiry.status=3";

        //$this->db->where('enquiry.status', 3);
        //$this->db->where('client_drop_status', 0);   

        $this->db->where($where);
        
        $this->db->order_by('enquiry.country_id', 'desc');
        return $this->db->get();
    }
    
    
    public function all_created_today()
    {
        $user_id          = $this->session->user_id;
        $user_role        = $this->session->user_role;
        $assign_country   = $this->session->country_id;   
        $this->db->select("*,tbl_datasource.datasource_name,tbl_product.product_name as product_name");
        $this->db->from('enquiry');
        $this->db->join('tbl_datasource', 'enquiry.datasource_id=tbl_datasource.datasource_id', 'left');
        $this->db->join('tbl_product', 'tbl_product.sb_id = enquiry.product_id', 'left');


        $where = '';

        $where .= " enquiry.status=3";
        
        $where .= " AND enquiry.client_drop_status=0";   

        if ($user_role == 3) {
            $where .= " AND enquiry.country_id =".$assign_country;
            //$this->db->where('enquiry.country_id', $assign_country);
        }elseif ($user_role == 8 || $user_role == 9) {

            $where.=" AND (enquiry.aasign_to=$user_id OR (enquiry.created_by=$user_id AND  enquiry.aasign_to IS NULL))";
           

            $process = $this->session->process;
            $where.= " AND enquiry.product_id=$process";

            //$this->db->where('aasign_to', $user_id);
            //$this->db->or_where('created_by', $user_id);
        }
        

        //$this->db->where('status', 3);
        //$this->db->where('client_drop_status', 0);   
        
        //$this->db->like('enquiry.created_date', date('Y-m-d'));
        $where .= " AND enquiry.status=3";
        
        $date=date('Y-m-d');
            
        $where.=" AND enquiry.created_date LIKE '%$date%'";


        $this->db->where($where);

        $this->db->order_by('country_id', 'desc');

        return $this->db->get();        
    }
    
    
    public function all_Updated_today()
    {
        $user_id          = $this->session->user_id;
        $user_role        = $this->session->user_role;
        $assign_country   = $this->session->country_id;   
        $this->db->select("*,tbl_datasource.datasource_name,tbl_product.product_name as product_name");

        $this->db->from('enquiry');
        $this->db->join('tbl_datasource', 'enquiry.datasource_id=tbl_datasource.datasource_id', 'left');
        $this->db->join('tbl_product', 'tbl_product.sb_id = enquiry.product_id', 'left');
        
        $where = '';

        $where .= " enquiry.status=3";

        $where .= " AND enquiry.client_drop_status=0";

        if ($user_role == 3) {
            $where .= " AND enquiry.country_id=".$assign_country;
            
            //$this->db->where('country_id', $assign_country);

        } elseif ($user_role == 8 || $user_role == 9) {
            
            $where.=" AND (enquiry.aasign_to=$user_id OR (enquiry.created_by=$user_id AND  enquiry.aasign_to IS NULL))";
          

            $process = $this->session->process;
            $where.= " AND enquiry.product_id=$process";

            //$this->db->or_where('enquiry.created_by', $user_id);

        }
        
        
        //$where .= " AND enquiry.client_drop_status=0";

        //$this->db->where('status', 3);

        //$this->db->where('client_drop_status', 0);
        $date=date('Y-m-d');
            
        $where.=" AND enquiry.update_date LIKE '%$date%'";

        //$this->db->like('enquiry.update_date', date('Y-m-d'));
        
        $where .= " AND enquiry.status=3";        


        $this->db->where($where);
        $this->db->order_by('enquiry.enquiry_id', 'desc');
        return $this->db->get();        
    }
    
    
    public function all_Active_clients()
    {
        $all_reporting_ids    =   $this->common_model->get_categories($this->session->user_id);

        $user_id          = $this->session->user_id;
        $user_role        = $this->session->user_role;
        $assign_country   = $this->session->country_id;
        $cpny_id=$this->session->companey_id;		
        
        $this->db->select("*,tbl_datasource.datasource_name,tbl_product.product_name as product_name");
        
        $this->db->from('enquiry');
        
        $this->db->join('tbl_datasource', 'enquiry.datasource_id=tbl_datasource.datasource_id', 'left');
        $this->db->join('tbl_product', 'tbl_product.sb_id = enquiry.product_id', 'left');

        
        $where = '';
        
        $where .= " enquiry.status=3";
        $where .= " AND enquiry.client_drop_status=0";        

        $where .= " AND ( enquiry.created_by IN (".implode(',', $all_reporting_ids).')';
        $where .= " OR enquiry.aasign_to IN (".implode(',', $all_reporting_ids).'))';
        $where.=" AND enquiry.comp_id=$cpny_id";		
        $this->db->where($where);

        $this->db->order_by('enquiry_id', 'desc');        

        return $this->db->get();
    }
 
    public function all_InActive_clients()
    {
        $user_id          = $this->session->user_id;
        $user_role        = $this->session->user_role;
        $region_id        = $this->session->region_id;
        $assign_country   = $this->session->country_id;
        $this->db->select("*,tbl_datasource.datasource_name,tbl_product.product_name as product_name");
        $this->db->from('enquiry');
        $this->db->join('tbl_datasource', 'enquiry.datasource_id=tbl_datasource.datasource_id', 'left');
        $this->db->join('tbl_product', 'tbl_product.sb_id = enquiry.product_id', 'left');
        
        
        $where = '';

        $where .= "enquiry.status=3";

        if ($user_role == 3) {
            $where .= "enquiry.country_id=".$assign_country;       
            //$this->db->where('country_id', $assign_country);
        
        } else if ($user_role == 8 || $user_role == 9) {
            $where .= " AND enquiry.aasign_to=".$user_id;       

            //$this->db->where('aasign_to', $user_id);
            
            $where .= " OR enquiry.created_by=".$user_id;       

            //$this->db->or_where('created_by', $user_id);
        }
        $where .= " AND enquiry.status=3";
        $where .= " AND enquiry.client_drop_status=1";       
        

        //$this->db->where('status', 3);
        //$this->db->where('client_drop_status', 1);        
        $this->db->order_by('enquiry.enquiry_id', 'desc');
        return $this->db->get();
    }    
    public function all_clients_Tickets()
    {        
        $user_id          = $this->session->user_id;
        $user_role        = $this->session->user_role;
        $region_id        = $this->session->region_id;
        $assign_country   = $this->session->country_id;
        $assign_region    = $this->session->region_id;
        $assign_territory = $this->session->territory_id;
        $assign_state     = $this->session->state_id;
        $assign_city      = $this->session->city_id;

        $this->db->select("*");
        $this->db->from('enquiry');
        $this->db->join('ticket', 'ticket.cl_id = enquiry.country_id', 'left');
        $this->db->where('ticket.cl_id = enquiry.country_id');
        
        if ($user_role == 3) {
            $this->db->where('enquiry.country_id', $assign_country);
        }elseif ($user_role == 8 || $user_role == 9) {
            $this->db->where('enquiry.aasign_to', $user_id);
         //   $this->db->or_where('enquiry.created_by', $user_id);
        }
        $this->db->where('enquiry.status', 3);
        $this->db->where('enquiry.client_drop_status', 0);
        $this->db->order_by('enquiry.enquiry_id', 'desc');
        return $this->db->get();        
    }
/**************************************************insert agreement************************************************/	
	public function set_agreement_meta($enq_no,$cmp_no,$meta_key,$type){
        if (!empty($meta_key) && !empty($enq_no)) {
            foreach ($meta_key as $key=>$value) {
                $ins_arr = array(
                'enq_id'         => $enq_no,
                'comp_id'        => $cmp_no,
                'key_parameter'  => $key,
                'key_value'      => $value,
                'key_type'       => $type,
                'created_by'     => $this->session->user_id,
                );
                $this->db->insert('tbl_aggriment',$ins_arr);
            }
        }else{
            return false;
        }
    }
	
    public function payment_by_account($data)
    {
        $this->db->insert('tbl_payment', $data);
        
    }
/**************************************************insert agreement end************************************************/
}