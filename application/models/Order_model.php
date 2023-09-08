<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {



	function __construct()
    {
        parent::__construct();
		
    }

	public function getOrder($ordno){
		
		return 	$this->db->select("ord.*,prd.id as prdid,prd.country_name as product_name, prddet.image,prddet.stock")
					 ->where("ord.company", $this->session->companey_id)
					 ->where("ord.ord_no", $ordno)
					 ->from("tbl_order ord")
					// ->join('users usr','usr.pk_i_admin_id=ord.cus_id','left')
				     ->join('tbl_product_country prd','prd.id=ord.product','left')
					 ->join('tbl_proddetails prddet','prd.id=prddet.prodid','left')
		
					 ->join('tbl_warehouse wh','ord.warehouse=wh.id','left')
					 ->get()
					 ->row();
	}

	/*public function getBuyers($ordno){
		
	 	$this->db->select("tbl_admin.s_display_name,tbl_admin.last_name,tbl_admin.add_ress,tbl_admin.contact_pname,tbl_admin.contact_phone,tbl_order.ord_no");
				$this->db->from('tbl_admin');
				$this->db->join('tbl_order','tbl_order.cus_id=tbl_admin.pk_i_admin_id','left');
				$this->db->where("tbl_order.ord_no", $ordno);
		return	$this->db->get()
					 ->row();
	}
	*/
	public function orders($act = "1",$sdate='',$edate=''){
		$this->load->model('common_model');
		$retuser   = $this->common_model->get_categories($this->session->user_id);
		$searchproduct 	= ($this->input->post('sproduct') !='') ? $this->input->post('sproduct') : "";
     	$searchseller 	= ($this->input->post('sseller') !='') ? $this->input->post('sseller') : "";
     	$searchstatus 	= ($this->input->post('sstatus') !="") ? $this->input->post('sstatus') : "";
     	$order_date 	= ($this->input->post('ord_date') !="") ? $this->input->post('ord_date') : "";
		if($act == 1){			
			$this->db->select("ord.*,concat_ws(' ',usr.s_display_name,usr.last_name) as customer,usr.s_phoneno,usr.add_ress,prd.country_name as product_name");
		}		
		$this->db->where("ord.company", $this->session->companey_id);
		$this->db->from("tbl_order ord");
		if(!empty($sdate) && !empty($edate)) 
		{
			$this->db->where("order_date BETWEEN '$sdate' AND '$edate' ", NULL, FALSE );
		}		
		if(isset($_GET["s"])){			
			$status = $this->input->get("s");			
			if($status == "unseen"){				
				$this->db->where("ord.confirm_order",0);
				$this->db->where("ord.status", 1);
			}			
		}
		if(isset($_GET["d"])){			
			$tday = $this->input->get("d");			
			if($tday == "dtoday"){				
				$this->db->where("ord.conf_delv", date("Y-m-d"));
			}else if($tday == "tpending"){				
				$this->db->where("ord.pend_delv", date("Y-m-d"));
			}			
		}		
		$this->db->join('tbl_product_country prd','prd.id=ord.product');			
		$this->db->join('tbl_proddetails prd2','prd2.prodid=prd.id');
		if ($this->session->user_right == 200) {
			$this->db->where('prd2.seller_id',$this->session->user_id);
		}else if($this->session->user_right == 201){
			$this->db->where('ord.cus_id',$this->session->user_id);			
		}else{
			if($searchseller == "")
			{
				$this->db->where_in("prd2.seller_id",$retuser);	
			}
				
		}
		// if(!empty($_POST))
		// {
			
		//}
		

		$this->db->join('tbl_admin usr','usr.pk_i_admin_id=ord.cus_id');	
		$ordcol = array("ord.id","prd.country_name");	
		if($searchproduct !='')
		{
			$this->db->where("prd.id",$searchproduct);
		}
		if($searchseller !='')
		{
			$this->db->where("prd2.seller_id",$searchseller);
		}
		if($searchstatus !='')
		{
			$this->db->join('ord_prod_stage','ord_prod_stage.ord_no=ord.ord_no','left');		
			$this->db->where("ord_prod_stage.status",$searchproduct);
		}
		if($order_date !='')
		{
			$this->db->where("DATE(ord.order_date)",$order_date);
		}
		if($act == 1) {
			$this->db->order_by("ord.id",'DESC');
			$this->limit();			
			$this->db->group_by('ord.ord_no');
			return $this->db->get()->result();	
		}else{			
			return $this->db->count_all_results();
		}
	}
	
	 public function colfilter($flrcol){
		  
	
			if(!empty($_POST['search']['value'])) 
			{
				 $likeqry = " ( ";
			
				 $val = $_POST['search']['value'];
				
				 
				 foreach($flrcol as $ind => $col){
					 
					 $likeqry .= $col." LIKE '%$val%' OR ";
				 }
				 $likeqry = trim($likeqry, "OR ");
				$likeqry .= ") ";	
				$this->db->where($likeqry);
					
			}
		  
	  }
	 public function limit(){
		 
		 if(isset($_POST["length"])) {
				 $this->db->limit($_POST['length'], $_POST['start']);
		
		 }else{
			 $this->db->limit(10, 0);
		
		 }	
	 } 
	  
	  public function order_by($ordcol){
		  
	
			if(isset($_POST['order'])) 
			{
				$ordpost = $_POST['order']['0']['column']; 
				
				if(!empty($ordcol[$ordpost])){
					$this->db->order_by($ordcol[$ordpost], $_POST['order']['0']['dir']);
				}	
				
			}else{
				$this->db->order_by("ord.id",'DESC');
			} 
	  }
	
	public function getOrderByCustomer(){
		
		 	$this->db->select("ord.*,ordprd.*,prd.id as prdid,prd.pro_name, prd.main_img");
				$this->db->where("ord.company", $this->session->companey_id);
				$limit  = 30;
		$offset = 0;
				if(isset($_GET["f"])){
					
					$filter = $this->input->get("f");
					
					if($filter == "pending"){
						
						$this->db->where("ordprd.pending_order > 0");
					}
					if($filter == "confirm"){
						
						$this->db->where("ordprd.confirm_order > 0");
					}
					if($filter == "today"){
						
						$currdate = date("Y-m-d");
						$this->db->where("ord.conf_delv", $currdate);
					}
					
				}
				
					if(isset($_GET["t"])){
						
						$limit = $this->input->get("t");
						
					}
					if(isset($_GET["p"])){
					
						$page   = $this->input->get("p");
						$offset = ($page - 1)*$limit; 
					
					}
					if(isset($_GET["o"])){
					
						$order = $this->input->get("o");
					
					}
				
				$this->db->where("cus_id", $this->session->user_id);
				$this->db->from("tbl_order ord");
				//$this->db->join("order_prdct ordprd",'ord.id=ordprd.ord_id','left');
				$this->db->join('tbl_product_country prd','prd.id=ord.product','left');
				$this->db->limit($limit, $offset);
		return		$this->db->get()->result();
	}

	 
	
	public function getOrders($ordno){
		
	 	$this->db->select("ord.*,prd.id as prdid,prd.country_name as product_name,prddet.price as unit_price, prddet.image,tbl_inventory.qty as stock_qty,concat_ws(' ',tbl_admin.s_display_name,tbl_admin.last_name) as seller_name,prddet.hsn,prddet.brand");
				$this->db->where("ord.company", $this->session->companey_id);
				$this->db->where("ord.ord_no", $ordno);				
				$this->db->from('tbl_order ord');
				//$this->db->join('users usr','usr.id=ord.cus_id','left');
				$this->db->join("tbl_inventory", "tbl_inventory.product_name=ord.product",'left');
				$this->db->join('tbl_product_country prd','prd.id=ord.product');
				$this->db->join('tbl_proddetails prddet','prd.id=prddet.prodid');
				$this->db->join('tbl_admin','tbl_admin.pk_i_admin_id=prddet.seller_id');
				$this->db->join('tbl_warehouse wh','ord.warehouse=wh.id','left');
		return	$this->db->get()
					 ->result();
	}
	
	public function getOrdersProduct($ordno){
		
		return 	$this->db->select("ord.*,prd.id as prdid,prd.country_name as product_name, prddet.image,prddet.stock")
					 ->where("ord.company", $this->session->companey_id)
					 ->where("ord.ord_no", $ordno)
					// ->from("order_prdct ordprd")
					 ->from('tbl_order ord')
					 ->join('tbl_product_country prd','prd.id=ord.product','left')
					->join('tbl_proddetails prddet','prd.id=prddet.prodid','left')
					 ->get()
					 ->result();
	}
	public function getOrdProduct($ordno){
		
		return 	$this->db->select("ord.*,ordprd.*,prd.id as prdid,prd.pro_name, prd.main_img")
					 ->where("ord.company", $this->session->companey_id)
					 ->where("ordprd.id", $ordno)
					 ->from("order_prdct ordprd")
					 ->join('tbl_order ord','ord.id=ordprd.ord_id','left')
					 ->join('tbl_product_country prd','prd.id=ordprd.product','left')
					 ->get()
					 ->row();
	}
	
	public function getProductUnit($id,$fld)
	{	

		return $this->db->select("$fld")->where('prd.sb_id',$id)->from('tbl_product_country prd')->get()->row();

	}
	
	public function getOrderById($ordno){
		
		return 	$this->db->select("ordprd.*,ord.*,prd.id as prdid,prd.pro_name, prd.main_img,st.state,cty.city,wh.address, concat(usr.fname, ' ', usr.lname) as customer, usr.email,usr.phone,usr.image")
					 ->where("ord.company", $this->session->companey_id)
					 ->where("ord.id", $ordno)
					 ->from("order_prdct ordprd")
					 ->join("tbl_order ord",'ord.id=ordprd.ord_id','left')
					 ->join('tbl_product_country prd','prd.id=ord.product','left')
					 ->join('tbl_warehouse wh','ord.warehouse=wh.id','left')
					 ->join('tbl_state st','st.id=wh.state','left')
					 ->join('tbl_city  cty','ord.warehouse=wh.city','left')
					 ->join('users usr','usr.id=ord.cus_id','left')
				     ->get()
					 ->row();
	}
	public function getPOrderById($ordno){
		
		return 	$this->db->select("ord.*,ordprd.*,prd.id as prdid,prd.pro_name, prd.main_img,st.state,cty.city,wh.address, concat(usr.fname, ' ', usr.lname) as customer, usr.email,usr.phone,usr.image")
					 ->where("ord.company", $this->session->companey_id)
					 ->where("ordprd.id", $ordno)
					 ->from("order_prdct ordprd")
					 ->join("tbl_order ord",'ord.id=ordprd.ord_id','left')
					 ->join('tbl_product_country prd','prd.id=ord.product','left')
					 ->join('tbl_warehouse wh','ord.warehouse=wh.id','left')
					 ->join('tbl_state st','st.id=wh.state','left')
					 ->join('tbl_city  cty','ord.warehouse=wh.city','left')
					 ->join('users usr','usr.id=ord.cus_id','left')
				     ->get()
					 ->row();
	}
	
	public function getDilevery($ordno){
		
		$this->db->select("*");
				  $this->db->where("company", $this->session->companey_id);
				  
				  $this->db->where("ord_no", $ordno);
				  $this->db->order_by("id ASC");
		$dlvarr =  $this->db->get("delivery")
				 ->result();
			
		$newarr = array();
		
		if(!empty($dlvarr)){
			foreach($dlvarr as $ind => $dlv){
				
				$newarr[$dlv->product][] = $dlv;
				
				
			}
			
		}
		return $newarr;
				 
	}
	public function getAllDilevery(){
		
		$this->db->select("*");
				  $this->db->where("company", $this->session->companey_id);
				  
				  $this->db->order_by("id DESC");
		$dlvarr =  $this->db->get("delivery")
				 ->result();
			
		$newarr = array();
		
		if(!empty($dlvarr)){
			foreach($dlvarr as $ind => $dlv){
				
				$newarr[$dlv->product][] = $dlv;
				
				
			}
			
		}
		return $newarr;
				 
	}
		public function getDileveryByOid($ordno){
		
		return $this->db->select("*")
				 ->where("company", $this->session->companey_id)
				 ->where("ord_id", $ordno)
				 ->order_by("id DESC")
				 ->get("delivery")
				->result();	
				 
	}
	
	
	public function getDileveryById($dlvno){
		
		return $this->db->select("dlv.*,ord.*,st.state,cty.city,wh.address, concat(usr.fname, ' ', usr.lname) as customer, usr.email,usr.phone,usr.image")
				 ->where("ord.company", $this->session->companey_id)
				 ->where("dlv.id", $dlvno)
				 ->from("delivery dlv")
				 ->join("tbl_order ord",'ord.id=dlv.ord_id','left')
				 ->join('tbl_warehouse wh','ord.warehouse=wh.id','left')
					 ->join('tbl_state st','st.id=wh.state','left')
					 ->join('tbl_city  cty','ord.warehouse=wh.city','left')
					 ->join('users usr','usr.id=ord.cus_id','left')
				     
				->get()	 
				->row();	
				 
	}
	
	public function getCurrentScheme(){
		
		$currdate  = date("Y-m-d");
		
		return $this->db->select("*")
						->where("'$currdate' > from_date and '$currdate' < to_date")
						->where("comp_id", $this->session->companey_id)
						->where("status", 1)
						->order_by("id DESC")
						->get("tbl_scheme")
						->result();	
		
	}

	public function get_pk_admin_id($emp_id){		
		return $this->db->select("pk_i_admin_id")
				->where("employee_id", $emp_id)
				->from("tbl_admin")
				->get()	 
				->row();					 
	}	
	public function placeorder($pk_i_admin_id = ''){		
		$ordno = "ORD".strtotime(date("Y-m-d h:i:s"));		
		$carts = $this->cart->contents();
		$ret   = false; 
		if(!empty($carts)){

			foreach($carts as $ind => $crt){				
				$arr[] = array(
							 "ord_no"  		=> $ordno,
							 "cus_id"  		=> $this->session->user_id,
							 "preferd_by"  	=> $pk_i_admin_id,
							 "enq_no"  		=> "",
							 "payment_mode" => $this->session->payment_mode,
							 "warehouse"    => "",
							 "product"		=> $crt['id'],
							 "conf_delv"    => 0,
							 "pend_delv"	=> $crt['qty'],
							 "delvr_date"	=> NULL,
							 "next_date"    => NULL,
							 "scheme"		=> 0,
							 "quantity"		=> $crt['qty'],
							 "price"		=> $crt['price'],		
							 "offer"        => $crt['discount'],
							 "tax"        	=> $crt['gst'],
							 "details"      => "",
							 "disc_meth"    => "",
							 "disc_price"   => $crt['discount'],
							 "disc_type"    => "",
							 "other_price"  => 0,
							 "total_price"  => $crt['price']*$crt['qty'],
							 "addedby"      => $this->session->user_id,
							 "order_date"   => date("Y-m-d h:i:s"),
							 "status"       => 1,
							 "company"      => $this->session->companey_id,
							 "ip"			=> ""
							 );		
			}
			$ret = $this->db->insert_batch("tbl_order", $arr);
		}
		if($ret){
			$this->cart->destroy();			
			return $ordno;
		}else{
			return false;
		}	
	}


	public function set_order_meta($ord_no,$comp_id,$user_id,$meta_key,$type){
        if (!empty($meta_key) && !empty($ord_no)) {
            foreach ($meta_key as $key=>$value) {
                $ins_arr = array(
                'comp_id'         => $comp_id,
                'order_id'        => $ord_no,
                'created_by'      => $user_id,
                'order_parameter' => $key,
                'order_value'     => $value,
                'type'     	      => $type,
                );
                $this->db->insert('order_parameters',$ins_arr);
            }
        }else{
            return false;
        }
    }


    public function get_order_meta($ord_no,$meta_key){
        if (!empty($meta_key) && !empty($ord_no)) {                        
            $this->db->select('order_parameter as parameter,order_value as value,type');
            $this->db->where('order_id',$ord_no);        
            $this->db->where_in('order_parameter',$meta_key);
            $result    =   $this->db->get('order_parameters')->result_array();
            $data = array();
            if (!empty($result)) {
                foreach ($result as $key => $value) {
                    $parm    =   $value['parameter'];
                    $type    =   $value['type'];
                    $data[$type][$parm]   = $value['value'];
                }
                return $data;   
            }else{
                return false;
            }
        }else{
            return false;
        }
    } 

    public function getBuyers($ordno){		
	  	$this->db->select("*");
	 			$this->db->from('order_parameters');
	 			$this->db->where("order_id", $ordno);
	 	return	$this->db->get()->result();
	}
}