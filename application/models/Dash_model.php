<?php  /**** Creadte By Narendra Verma ***********/
defined('BASEPATH') OR exit('No direct script access allowed');
class Dash_model extends CI_Model {
	/**** user start ***********/
public function get_users(){
		return $this->db->get('tbl_admin')->result();
}
      public function noumber_of_boq(){
        $this->db->distinct();
        $this->db->select('baq_number,circuit_sheet,create_date,time_stapm,s_display_name');
        $this->db->from('tbl_boq');
        $this->db->join('tbl_admin', 'tbl_admin.pk_i_admin_id = tbl_boq.create_by');
          if($this->session->is_admin==1){
        }else{
           $this->db->where('tbl_boq.create_by',$this->session->user_id); 
        }
        return $query = $this->db->get()->num_rows();
}
	/**** area list ***********/	
	public function area_list(){
		return $this->db->get('tbl_area')->result();
     }
     	public function moduler_box(){
	//	return $this->db->get('tbl_modular_box')->result();
		    return $this->db->select('*')
		                    ->from('tbl_modular_box')
		                    ->order_by('m_input','ASC')
		                    ->get()
		                    ->result();
     }
     	public function disposition_list_graph(){	    
                    $company=$this->session->userdata('companey_id');
                    $this->db->select('*');
                    $this->db->from('lead_stage');
                    $this->db->where('comp_id', $company);
                    $this->db->order_by('stg_id','ASC');
                    return $this->db->get()->result();
		}
        public function all_comments(){	    
                    $company=$this->session->userdata('companey_id');
                    $this->db->select('*');
                    $this->db->from('tbl_comment');
                    $this->db->where('comp_id', $company);
					//$this->db->where('comment_msg', display('stage_updated'));
                    $this->db->order_by('comm_id','ASC');
                    return $this->db->get()->result();
		}
		public function task_list(){		    
                    //$company=$this->session->userdata('companey_id');
					$date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                    $currdt = $date->format('d-m-Y');
					$user = $this->session->user_id;
                    $this->db->select('*');
                    $this->db->from('query_response');
                    $this->db->where('create_by', $user);
					//$this->db->where('create_by', $user);
                    $this->db->order_by('resp_id','ASC');
                    return $this->db->get()->result();
		}

		public function product_list_graph(){		    
                    $company=$this->session->userdata('companey_id');
                    $this->db->select('*');
                    $this->db->from('tbl_product');
                    $this->db->where('comp_id', $company);
                    $this->db->order_by('sb_id','ASC');
                    return $this->db->get()->result();
		}
	  public function source_list_graph(){	    
                    $company=$this->session->userdata('companey_id');
                    $this->db->select('*');
                    $this->db->from('lead_source');
                    $this->db->where('comp_id', $company);
                    $this->db->order_by('lsid','ASC');
                    return $this->db->get()->result();
		}
			public function drop_list_graph(){	    
                    $company=$this->session->userdata('companey_id');
                    $this->db->select('*');
                    $this->db->from('tbl_drop');
                    $this->db->where('comp_id', $company);
                    $this->db->order_by('d_id','ASC');
                    return $this->db->get()->result();
		}
      public function insert_modular(){
            $ip=$_SERVER['REMOTE_ADDR'];
	        $this->db->set('m_name',$this->input->post('m_name'));
	        $this->db->set('m_input',$this->input->post('m_input'));
			$this->db->set('m_status ',1);
			$this->db->set('m_ip ',$ip);
			$this->db->set('m_create_date ',date('Y-m-d'));
			$this->db->set('m_creted_by',$this->session->user_id);
			$this->db->insert('tbl_modular_box');
     }
     public function update_modularbox(){
	        $this->db->set('m_name',$this->input->post('m_name'));
	        $this->db->set('m_input',$this->input->post('m_input'));
			$this->db->where('m_id ',$this->input->post('m_id'));
			$this->db->update('tbl_modular_box');
     }
      public function area_byid($id){
	     $this->db->select('*');
	     $this->db->where('a_id',$id);
		return $this->db->get('tbl_area')->result();
      }
     public function area_add(){
            $ip=$_SERVER['REMOTE_ADDR'];
	        $this->db->set('a_name',$this->input->post('area_name'));
			$this->db->set('area_status',1);
			$this->db->set('ip_address',$ip);
			$this->db->set('create_date',date('Y-m-d'));
			$this->db->set('create_by',$this->session->user_id);
			$this->db->insert('tbl_area');
     }
    public function area_updaete($id){
         $ip=$_SERVER['REMOTE_ADDR'];
	        $this->db->set('a_name',$this->input->post('area_name'));
			$this->db->set('area_status',1);
			$this->db->set('ip_address',$ip);
			$this->db->set('ubdated_date',date('Y-m-d'));
			$this->db->set('updated_by',$this->session->user_id);
				$this->db->where('a_id',$id);
			$this->db->update('tbl_area');
    }
    	/**** floor list ***********/	
	public function floor_list(){
		return $this->db->get('tbl_floor')->result();
     }
        public function floor_byid($id){
	     $this->db->select('*');
	     $this->db->where('f_id',$id);
		return $this->db->get('tbl_floor')->result();
      }
     public function floor_add(){
            $ip=$_SERVER['REMOTE_ADDR'];
	        $this->db->set('f_name',$this->input->post('area_name'));
			$this->db->set('foolr_status',1);
			$this->db->set('ip_address',$ip);
			$this->db->set('create_date',date('Y-m-d'));
			$this->db->set('create_by',$this->session->user_id);
			$this->db->insert('tbl_floor');
     } 
      public function floor_update($id){
            $ip=$_SERVER['REMOTE_ADDR'];
	        $this->db->set('f_name',$this->input->post('area_name'));
			$this->db->set('foolr_status',1);
			$this->db->set('ip_address',$ip);
			$this->db->set('ubdated_date',date('Y-m-d'));
			$this->db->set('updated_by',$this->session->user_id);
			$this->db->where('f_id',$id);
			$this->db->update('tbl_floor');
     }
     	/**** room list ***********/	
	public function room_list(){
		return $this->db->get('tbl_room')->result();
     }
   public function room_byid($id){
	     $this->db->select('*');
	     $this->db->where('r_id',$id);
		return $this->db->get('tbl_room')->result();
      }
     public function room_add(){
            $ip=$_SERVER['REMOTE_ADDR'];
	        $this->db->set('r_name',$this->input->post('area_name'));
			$this->db->set('room_status',1);
			$this->db->set('ip_address',$ip);
			$this->db->set('create_date',date('Y-m-d'));
			$this->db->set('create_by',$this->session->user_id);
			$this->db->insert('tbl_room');
     }
     public function room_update($id){
            $ip=$_SERVER['REMOTE_ADDR'];
	        $this->db->set('r_name',$this->input->post('area_name'));
			$this->db->set('room_status',1);
			$this->db->set('ip_address',$ip);
			$this->db->set('ubdated_date',date('Y-m-d'));
			$this->db->set('updated_by',$this->session->user_id);
			$this->db->where('r_id',$id);
			$this->db->update('tbl_room');
     }
     	/****  Creadte By Narendra Verma ***********/
	/****  start item ***********/
		public function allactive_rooms(){
		$this->db->select('*');
	     $this->db->where('area_status',1);
		return $this->db->get('tbl_area')->result();
        }					
		public function item_list(){
		$this->db->select('*');
        $this->db->from('tbl_itemlist');
        $this->db->join('tbl_area', 'tbl_area.a_id = tbl_itemlist.room_id');
        $this->db->join('tbl_product', 'tbl_product.sb_id = tbl_itemlist.item_name');
        return $query = $this->db->get()->result();
        }
		public function item_listbyid($id){
		$this->db->select('*');
	     $this->db->where('itemlist_id',$id);
		return $this->db->get('tbl_itemlist')->result();
        }
			public function add_item(){
	        $ip=$_SERVER['REMOTE_ADDR'];
	        $item=explode(',',$this->input->post('funtion_name'));
	        $this->db->set('item_name',$item[0]);
			$this->db->set('room_id',$item[1]);
			$this->db->set('item_hsncode',$this->input->post('item_shn'));
			$this->db->set('color',$this->input->post('color'));
		//	$this->db->set('moduels',$this->input->post('modules'));
			$this->db->set('Unite_p',$this->input->post('Unite_p'));
		//	$this->db->set('item_divid_by',$this->input->post('qty_divie_by'));
	     	$this->db->set('img_url',$this->input->post('img_url'));
			$this->db->set('ip_address',$ip);
			$this->db->set('item_status',1);
			$this->db->set('create_date',date('Y-m-d h:s:i'));
			$this->db->set('created_by',$this->session->user_id);
			$this->db->insert('tbl_itemlist');
            }
            public function update_item($id){
	        $ip=$_SERVER['REMOTE_ADDR'];
	        $item=explode(',',$this->input->post('funtion_name'));
	        $this->db->set('item_name',$item[0]);
			$this->db->set('room_id',$item[1]);
			$this->db->set('item_hsncode',$this->input->post('item_shn'));
			$this->db->set('color',$this->input->post('color'));
		//	$this->db->set('moduels',$this->input->post('modules'));
			$this->db->set('Unite_p',$this->input->post('Unite_p'));
		//	$this->db->set('item_divid_by',$this->input->post('qty_divie_by'));
	     	$this->db->set('img_url',$this->input->post('img_url'));
			$this->db->set('ip_address',$ip);
			$this->db->set('update_date',date('Y-m-d h:s:i'));
			$this->db->set('updated_by',$this->session->user_id);
			$this->db->where('itemlist_id',$id);
			$this->db->update('tbl_itemlist');
            }
	/****  end tax ***********/
	public function sub_function_list(){
        $this->db->select('*');
        $this->db->from('tbl_itemlist');
        $this->db->join('sub_function', 'sub_function.s_room_id = tbl_itemlist.itemlist_id');
        return $query = $this->db->get()->result();
        }
        public function item_sublistbyid($id){
		$this->db->select('*');
	     $this->db->where('s_itemlist_id',$id);
		return $this->db->get('sub_function')->result();
        }
        public function add_sub_function(){
	        $ip=$_SERVER['REMOTE_ADDR'];
	        $this->db->set('sub_f_name',$this->input->post('item_name'));
			$this->db->set('s_room_id',$this->input->post('rooms'));
			$this->db->set('ip_address',$ip);
			$this->db->set('item_status',1);
			$this->db->set('create_date',date('Y-m-d h:s:i'));
			$this->db->set('created_by',$this->session->user_id);
			$this->db->insert('sub_function');
            }
		public function  edit_sub_function($id){
	        $ip=$_SERVER['REMOTE_ADDR'];
	        $this->db->set('sub_f_name',$this->input->post('item_name'));
			$this->db->set('s_room_id',$this->input->post('rooms'));
			$this->db->set('ip_address',$ip);
			$this->db->set('item_status',1);
			$this->db->set('create_date',date('Y-m-d h:s:i'));
			$this->db->set('created_by',$this->session->user_id);
			$this->db->where('s_itemlist_id',$id);
			$this->db->update('sub_function');
            }	
		/**** Creadte By Narendra Verma ***********/
		//Add mail signature...
		public function add_mail_signature($data){
		   if($this->db->insert('mail_signature',$data)){
		       return true;
		   }
		}
		//Get signature list..
		public function signaturList(){
		    return $this->db->select('*')
		                ->from('mail_signature')
		                ->where('user_id',$this->session->user_id)
		                ->get()
		                ->result();
		}
		//Edit Signature..
		public function edit_user_signature($row_id,$data){
		    $this->db->where('id',$row_id);
		    $this->db->update('mail_signature',$data);
		   if($this->db->affected_rows()){
		       return true;
		   }
		}
		//Delete Signature...
		public function Delete_signatures($ids){
		    for($i=0; $i < count($ids); $i++){
		        $this->db->query('DELETE FROM mail_signature WHERE id="'.$ids[$i].'"');
		    }
		}
		//Add switch box..
		public function add_switch_box($data){
		   if($this->db->insert('tbl_switch_box',$data)){
		       return true;
		   }
		}
		//update switch box..
		public function update_switch_box($data){
		    $this->db->where('sb_id',$this->input->post('sb_id'));
		   if($this->db->update('tbl_switch_box',$data)){
		       return true;
		   }
		}
		//List of switch boxes..
		public function switch_box_list(){
		    return $this->db->select('*')
		                    ->from('tbl_switch_box')
		                    ->order_by('sb_id','ASC')
		                    ->get()
		                    ->result();
		}
		
		// Delete switch boxes....
		// List of switch boxes..

		public function get_user_product_list(){
			$this->db->select('process');
			$this->db->where('pk_i_admin_id',$this->session->user_id);
			$user_process	=	$this->db->get('tbl_admin')->row_array();
			// print_r($user_process);exit();
			if(!empty($user_process)){
				$user_process = $user_process['process'];
				$user_process	=	explode(',', $user_process);
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


         public function get_bank_list(){

         	$company=$this->session->userdata('companey_id');

         	$this->db->select('*');
         	$this->db->from('tbl_bank');
         	$this->db->where('comp_id',$company);
         	return $this->db->get()->result();
         }
			public function get_user_product_list_api($compno){
			$this->db->select('process');
			$this->db->where('pk_i_admin_id',$this->session->userno);
			$user_process	=	$this->db->get('tbl_admin')->row_array();
			// print_r($user_process);exit();
			if(!empty($user_process)){
				$user_process = $user_process['process'];
				$user_process	=	explode(',', $user_process);
			}else{
				$user_process = array();
			}
			// echo $company;
			$this->db->select('*');
			$this->db->from('tbl_product');			
			$this->db->where_in('sb_id',$user_process);
			$this->db->where('comp_id', $compno);
			$this->db->order_by('sb_id','ASC');
			return  $this->db->get()->result();
			// print_r($res);exit();
		}

		public function get_user_product_list_bycompany($comp_id){			
			$this->db->select('*');
			$this->db->from('tbl_product');			
			$this->db->where('comp_id', $comp_id);
			$this->db->order_by('sb_id','ASC');
			return  $this->db->get()->result();
		}

		public function product_list(){		    
                    $company=$this->session->userdata('companey_id');
                    $this->db->select('*');
                    $this->db->from('tbl_product');

                    if($this->session->process){
                    	$this->db->where_in('sb_id',$this->session->process);
                    }

                    $this->db->where('comp_id', $company);
                    $this->db->order_by('sb_id','ASC');
                    return $this->db->get()->result();
		}

		public function product_list_byqr_comp($wid){


			$this->db->select('comp_id');
			$this->db->from('website_integration');
			$this->db->where('wid',$wid);

			$res_com = $this->db->get()->row_array();

			if($res_com){

				$compid = $res_com['comp_id'];

             $this->db->select("*");
             $this->db->from('tbl_product');
             $this->db->where('comp_id',$compid);

             return $this->db->get()->result();

			}
		}

		public function all_process_list(){		    
                    $company=$this->session->userdata('companey_id');
                   
                    $this->db->select('*');
                    $this->db->from('tbl_product');
                 

                    $this->db->where('comp_id', $company);
                    $this->db->order_by('sb_id','ASC');
                    return $this->db->get()->result();
		}
		
		public function all_product_list(){		    
                    $company=$this->session->userdata('companey_id');
                    $this->db->select('*');
                    $this->db->from('tbl_product_country');
                    $this->db->where('comp_id', $company);
                    $this->db->order_by('id','ASC');
                    return $this->db->get()->result();
		}
		
		public function product_list_by_ses(){		    
                    $user_id = $this->session->user_id;
                    $this->db->select('process');
                    $this->db->where('pk_i_admin_id',$user_id);                    
                    $user_res	=	$this->db->get('tbl_admin')->row_array();
                    $user_res = explode(',', $user_res['process']);
                    $this->db->select('*');
                    $this->db->from('tbl_product');
                    $this->db->where_in('sb_id',$user_res);                    
                    $this->db->order_by('sb_id','ASC');
                    return $this->db->get()->result();
		}
		public function add_product($data){
		   if($this->db->insert('tbl_product',$data)){
		       return true;
		   }
		}
		public function update_product($data){
		    $this->db->where('sb_id',$this->input->post('sb_id'));
		   if($this->db->update('tbl_product',$data)){
		       return true;
		   }
		}
		//Delete switch boxes....
		public function delete_switch_boxes($ids){
		    for($i=0; $i < count($ids); $i++){
		         $this->db->query('DELETE FROM tbl_switch_box WHERE sb_id="'.$ids[$i].'"');
		    }
		}
}