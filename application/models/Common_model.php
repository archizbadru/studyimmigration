<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model {

    /* User reporting funcitons start */

    private $list = array();

    function fetch_recursive($tree){
        
        foreach($tree as $k => $v){
            
            $this->list[] = $v->pk_i_admin_id;

            $this->fetch_recursive($v->sub);

        }
    
        return $this->list;
    
    }
    
    public function get_categories($user_id){   

        $categories = array();
        $this->db->select('pk_i_admin_id');
        $this->db->from('tbl_admin');
        $this->db->where('report_to',$user_id);
        $parent = $this->db->get();       

        $categories = $parent->result();

        $i=0;
        foreach($categories as $p_cat){
            $categories[$i]->sub = $this->sub_categories($p_cat->pk_i_admin_id);
            $i++;
        }
        
        $categories    =   $this->fetch_recursive($categories);

        array_push($categories, $user_id);
        
        return $categories;
    }


    public function tree_get_categories($user_id){   

        $categories = array();
        $this->db->select('pk_i_admin_id');
        $this->db->from('tbl_admin');
        $this->db->where('report_to',$user_id);
        $parent = $this->db->get();       

        $categories = $parent->result();

        $i=0;
        foreach($categories as $p_cat){
            $categories[$i]->sub = $this->sub_categories($p_cat->pk_i_admin_id);
            $i++;
        }
        
        //$categories    =   $this->fetch_recursive($categories);

        //array_push($categories, $user_id);
        
        return $categories;
    }

    public function sub_categories($id){
        $this->db->select('pk_i_admin_id');
        $this->db->from('tbl_admin');
        $this->db->where('report_to', $id);
        $child = $this->db->get();
        $categories = $child->result();
        $i=0;
        foreach($categories as $p_cat){
            $categories[$i]->sub = $this->sub_categories($p_cat->pk_i_admin_id);
            $i++;
        }
        return $categories;       
    }


    /* User reporting functions end */

    public function get_user_product_list(){
        $this->db->select('process');
        $this->db->where('pk_i_admin_id',$this->session->user_id);
        $user_process   =   $this->db->get('tbl_admin')->row_array();
        // print_r($user_process);exit();
        if(!empty($user_process)){
            $user_process = $user_process['process'];
            $user_process   =   explode(',', $user_process);
        }else{
            $user_process = array();
        }
        $company=$this->session->userdata('companey_id');
        // echo $company;
        $this->db->select('*');
        $this->db->from('tbl_product');         
        $this->db->where_in('sb_id',$user_process);
        $this->db->where('comp_id', $company);
        $this->db->order_by('sb_id','ASC');
        return  $this->db->get()->result();
        // print_r($res);exit();
    }

     public function get_filterData($type)
   {
       $comp_id=$this->session->companey_id;
       $user_id=$this->session->user_id;
        $values=$this->db->where(array('user_id'=>$user_id,'comp_id'=>$comp_id,'type'=>$type))->get('tbl_filterdata');
        $filter=$values->row();
         $pdata=[];
        
        if(!empty($filter)){
            
        $value=json_decode($filter->filter_data);
        if($type==1){
            $pdata=[
                     
                'from_created' =>$value->from_created??NULL,
                'to_created' =>$value->to_created??NULL,
                'source' =>$value->source??NULL, 
                'subsource' => $value->subsource??NULL,
                'email' => $value->email??NULL,
                'employee' => $value->employee??NULL,
                'enq_product' =>$value->enq_product??NULL,
                'phone' =>$value->phone??NULL,
                'createdby' =>$value->createdby??NULL,
                'assign' =>$value->assign??NULL,
                'address' =>$value->address??NULL,
                'prodcntry' =>$value->prodcntry??NULL,
                'state' =>$value->state??NULL,
                'city' =>$value->city??NULL,
                'stage' =>$value->stage??NULL,
                'final' =>$value->final??NULL,
                'intake' =>$value->intake??NULL,
                'visatype' =>$value->visatype??NULL,
                'preferred' =>$value->preferred??NULL,
                'nationality' =>$value->nationality??NULL,
                'residing' =>$value->residing??NULL,
                'tag' =>$value->tag??NULL,
                'datasource' =>$value->datasource??NULL,                                                           
                    
            ];
        }else{
            $pdata=[
                    
                'from_created' =>$value->from_created??NULL,
                'to_created' =>$value->to_created??NULL,
                'source' =>$value->source??NULL, 
                'subsource' => $value->subsource??NULL,
                'email' => $value->email??NULL,
                'employee' => $value->employee??NULL,
                'enq_product' =>$value->enq_product??NULL,
                'phone' =>$value->phone??NULL,
                'createdby' =>$value->createdby??NULL,
                'assign' =>$value->assign??NULL,
                'address' =>$value->address??NULL,
                'prodcntry' =>$value->prodcntry??NULL,
                'state' =>$value->state??NULL,
                'city' =>$value->city??NULL,
                'stage' =>$value->stage??NULL,
                'final' =>$value->final??NULL,
                'intake' =>$value->intake??NULL,
                'visatype' =>$value->visatype??NULL,
                'preferred' =>$value->preferred??NULL,
                'nationality' =>$value->nationality??NULL,
                'residing' =>$value->residing??NULL,
                'tag' =>$value->tag??NULL,
                'datasource' =>$value->datasource??NULL,
        ];
    }
    }else{
        if($type==1){
            $pdata=[ 'tag' =>'','residing' =>'','nationality' =>'','preferred' =>'','visatype' =>'','intake' =>'','final' =>'','from_created' =>'', 'to_created' =>'', 'source' =>'','filter_checkbox' =>'','subsource' =>'','email' =>'','employee' =>'','datasource' => '','company' =>'','enq_product' => '','phone' =>'','createdby' =>'','assign' =>'','address' =>'','prodcntry' =>'','state' =>'','city' =>'','stage' =>'','top_filter' =>''];
        }else{
            $pdata=[ 'tag' =>'','residing' =>'','nationality' =>'','preferred' =>'','visatype' =>'','intake' =>'','final' =>'','from_created' =>'', 'to_created' =>'', 'source' =>'','filter_checkbox' =>'','subsource' =>'','email' =>'','employee' =>'','datasource' => '','company' =>'','enq_product' => '','phone' =>'','createdby' =>'','assign' =>'','address' =>'','prodcntry' =>'','state' =>'','city' =>'','stage' =>'','top_filter' =>''];
           }
    }
    return $pdata;

   }
}