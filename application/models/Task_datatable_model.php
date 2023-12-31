<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Task_datatable_model extends CI_Model {
 
    var $table = 'query_response';


    //var $column_order = array('query_response.query_id','query_response.upd_date', 'query_response.task_remark','admin.user_name','query_response.mobile'); //set column field database for datatable orderable
    
    var $column_order = array(
    'query_response.task_date',
    'query_response.task_time',
    'query_response.subject',
    'query_response.task_remark',
    'enquiry.name',
    'tbl_admin.s_display_name',
    'query_response.mobile',
    'tbl_taskstatus.taskstatus_name',
    ); //set column field database for datatable orderable

    //var $column_search = array('query_response.query_id','query_response.upd_date', 'query_response.task_remark','admin.user_name','query_response.mobile'); //set column field database for datatable searchable 
    var $column_search = array(
    'query_response.task_date',
    'query_response.task_time',
    'query_response.subject',
    'query_response.task_remark',
    'tbl_admin.s_display_name',
    'query_response.mobile',
    "CONCAT(enquiry.name_prefix,' ',enquiry.name,' ',enquiry.lastname)",
    'tbl_taskstatus.taskstatus_name'
    ); //set column field database for datatable searchable 

    var $order = array('query_response.resp_id' => 'desc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('common_model');      
    }
 
    private function _get_datatables_query()
    {
        // $all_reporting_ids    =   $this->common_model->get_categories($this->session->user_id);
        $this->db->from($this->table);
        
        $user_role = $this->session->user_role; 
        $user_id = $this->session->user_id;

        /*$from = $this->session->userdata('tfrom1');
        $to= $this->session->userdata('tto1');
        $task_status = $this->session->userdata('task_status1');
        $user_mobile = $this->session->userdata('user_mobile1');
        $user_name = $this->session->userdata('user_name1');*/      

        $where = '';
        $this->db->select("query_response.resp_id,query_response.query_id,query_response.upd_date,query_response.task_date,query_response.task_time,query_response.task_remark,query_response.subject,query_response.task_status,query_response.mobile,tbl_admin.s_display_name as user_name,tbl_taskstatus.taskstatus_name as task_status");
       
            
      
        $this->db->join('tbl_admin', 'tbl_admin.pk_i_admin_id=query_response.create_by', 'left');
        $this->db->join('enquiry', 'enquiry.Enquery_id=query_response.query_id', 'left');
        $this->db->join('tbl_taskstatus', 'tbl_taskstatus.taskstatus_id=query_response.task_status', 'left');
        $this->db->where('query_response.mobile!=',null);
        // if($user_role==3 || $user_role==2){
        // }else{
            // $this->db->where('query_response.create_by',$user_id);
        // }
/*//TASK FILTER CODE START HERE            
            if ($from && $to) {
                $to = str_replace('/', '-', $to);
                $from = str_replace('/', '-', $from);            
                $from = date('Y-m-d', strtotime($from));
                $to = date('Y-m-d', strtotime($to));            
                $where .= " STR_TO_DATE(query_response.task_date,'%d-%m-%Y') >= '$from' AND STR_TO_DATE(query_response.task_date,'%d-%m-%Y') <= '$to'";
                $where .= ' AND ';
            } else if ($from && !$to) {
                $from = str_replace('/', '-', $from);            
                $from = date('Y-m-d H:i:s', strtotime($from));
                $where .= " STR_TO_DATE(query_response.task_date,'%d-%m-%Y') LIKE '%$from%'";
                $where .= ' AND ';
            } else if (!$from && $to) {            
                $to = str_replace('/', '-', $to);
                $to = date('Y-m-d H:i:s', strtotime($to));
                $where .= " STR_TO_DATE(query_response.task_date,'%d-%m-%Y') LIKE '%$to%'";
                $where .= ' AND ';
            }

            if ($task_status=='1') { 
                $today = date('Y-m-d');           
                $where .= " STR_TO_DATE(query_response.task_date,'%d-%m-%Y') = '$today' AND  query_response.task_status = '1'";
                $where .= ' AND ';
            }else if ($task_status=='2') {
                $today = date('Y-m-d');
                $where .= " STR_TO_DATE(query_response.task_date,'%d-%m-%Y') > '$today' AND  query_response.task_status = '1'";
                $where .= ' AND ';
            }else if ($task_status=='3') {
                $today = date('Y-m-d');
                $where .= " STR_TO_DATE(query_response.task_date,'%d-%m-%Y') < '$today' AND  query_response.task_status = '1'";
                $where .= ' AND ';
            }else if ($task_status=='4') {
                $where .= "query_response.task_status = '2'";
                $where .= ' AND ';
            }

            if (!empty($user_mobile)) {            
                $where .= " enquiry.phone LIKE '%$user_mobile%'";
                $where .= ' AND ';
            }

            if (!empty($user_name)) {            
                $where .= " enquiry.name LIKE '%$user_name%' OR enquiry.lastname LIKE '%$user_name%'";
                $where .= ' AND ';
            }
//TASK FILTER CODE END HERE*/

                $filter_user_id = $this->session->filter_user_id;
                if($this->session->filter_user_id){                    
                    //$where = " query_response.create_by=".$this->session->filter_user_id;
                    $where = "( enquiry.created_by=$filter_user_id OR enquiry.aasign_to=$filter_user_id)";

                }else{
                    $where .= " (enquiry.created_by=$user_id OR enquiry.aasign_to=$user_id)";
                  //$where = "  query_response.create_by IN (".implode(',', $all_reporting_ids).')';                
                }
                $today = date('Y-m-d');
                //For Today Pending task only           
                //$where .= "AND STR_TO_DATE(query_response.task_date,'%d-%m-%Y') = '$today' AND  (query_response.task_status = '1' OR query_response.task_status IS NULL) ";
                $where .= "AND (query_response.task_status = '1' OR query_response.task_status IS NULL) ";

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
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();

        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();

        /*echo $this->db->last_query();
        exit();*/
        return $query->result();

        /*echo "<pre>";
        print_r($query->result());*/
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        $this->db->join('tbl_admin', 'tbl_admin.pk_i_admin_id=query_response.create_by', 'left');
        $this->db->join('enquiry', 'enquiry.Enquery_id=query_response.query_id', 'left');
        $filter_user_id = $this->session->filter_user_id;
        $user_id = $this->session->user_id;  
        $where='';
        if($this->session->filter_user_id){                                
            $where = " enquiry.created_by=$filter_user_id OR enquiry.aasign_to=$filter_user_id";
        }else{
            $where .= " enquiry.created_by=$user_id OR enquiry.aasign_to=$user_id";          
        }

        $this->db->where($where);
        return $this->db->count_all_results();
    }
 
}