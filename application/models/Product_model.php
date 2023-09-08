<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Product_model extends CI_Model {



    private $table = "tbl_product";



    public function insertRow($data = []) {

        return $this->db->insert($this->table, $data);

    }

    

    public function updateRow($data = []) {



        return $this->db->where('product_id', $data['product_id'])

                        ->update($this->table, $data);

    }

    

    public function readRow($product_id = null) {

        return $this->db->select("*")

                        ->from($this->table)

                        ->where('product_id', $product_id)

                        ->get()

                        ->row();

    }



    public function productlist() {

        return $this->db->select("*")

                        ->from("tbl_product_country")
						->where("comp_id", $this->session->userdata('companey_id'))
                        ->get()

                        ->result();

    }
	
	public function productdetlist($act = "1",$status=0) {
		$limit   = 8; 
		$offset  = 0;
		$this->load->model('common_model');
		$retuser   = $this->common_model->get_categories($this->session->user_id);
         $this->db->select("tbl_proddetails.price,tbl_product_country.minimum_order_quantity,tbl_proddetails.image,tbl_inventory.qty as stock_qty,tbl_product_country.country_name,tbl_product_country.id as id,tbl_scheme.from_date,tbl_scheme.to_date,tbl_scheme.apply_qty,tbl_scheme.from_qty,tbl_scheme.to_qty,tbl_scheme.discount,tbl_scheme.calc_mth,concat_ws(' ',seller.s_display_name,seller.last_name) as seller,seller.s_phoneno as seller_phone,enquiry.enquiry_id");
		$this->db->from("tbl_product_country");
		$this->db->join("tbl_proddetails", "tbl_proddetails.prodid = tbl_product_country.id");
		$this->db->join("tbl_scheme", "tbl_scheme.id=tbl_proddetails.scheme", "LEFT");
		$this->db->join("tbl_inventory", "tbl_inventory.product_name=tbl_product_country.id", "LEFT");
		$this->db->join("tbl_admin seller", "seller.pk_i_admin_id=tbl_proddetails.seller_id");
		$this->db->join("enquiry", "enquiry.phone=seller.s_phoneno",'left');
		$this->db->where("tbl_product_country.comp_id", $this->session->userdata('companey_id'));
		if ($status == 0) {
			$this->db->where_in("tbl_proddetails.seller_id",$retuser);
		}
		if(isset($_GET['searched_product']))
		{
			$this->db->like("tbl_product_country.country_name", trim($_GET['searched_product']));
		}
		
		if(isset($_GET['sc']) && $_GET['sc'] !=''){
			
			$this->db->where("tbl_proddetails.subcatogory", $_GET['sc']);
		}
		if(isset($_GET['c']) && $_GET['c'] !=''){
			
			$this->db->where("tbl_proddetails.category", $_GET['c']);
		}
		if ($status) {
			$this->db->where("tbl_product_country.status", 1);											
		}
		
		if(isset($_GET['page'])){
			
			$offset = $limit * ($_GET['page'] - 1);
		}
		 
		$this->db->order_by("tbl_product_country.id DESC");
		
		if($act == 2 ) {
			return $this->db->count_all_results();
		}else{
			if ($status == 1) {
				$this->db->limit($limit, $offset);							
			}
			return	$this->db->get()->result();
		}
		//	echo $this->db->last_query();	

    }
	public function productdetin($prdarr) {

		
         $this->db->select("tbl_proddetails.*,tbl_product_country.*,tbl_product_country.id as sb_id,tbl_scheme.from_date,tbl_scheme.to_date,tbl_scheme.apply_qty,tbl_scheme.from_qty,tbl_scheme.to_qty,tbl_scheme.discount,tbl_scheme.calc_mth");
					$this->db->from("tbl_product_country");
					$this->db->join("tbl_proddetails", "tbl_proddetails.prodid = tbl_product_country.id", "LEFT");
					$this->db->join("tbl_scheme", "tbl_scheme.id=tbl_proddetails.scheme", "LEFT");
					$this->db->where("tbl_product_country.comp_id", $this->session->userdata('companey_id'));
					$this->db->where("tbl_proddetails.id IS NOT NULL");
					$this->db->where_in("tbl_product_country.id", $prdarr);
					return		$this->db->get()->result();
	
    }
	
	
	public function productdet($prodno) {

        return $this->db->select("tbl_product_country.*,tbl_inventory.qty as stock_qty,tbl_category.name as category_name,tbl_subcategory.subcat_name,concat_ws(tbl_admin.s_display_name,' ',tbl_admin.last_name) as seller_name,city.city as scity,tbl_proddetails.*,tbl_product_country.id as sb_id,measurement_unit.title as unit,tbl_admin.employee_id")
					->from("tbl_product_country")
					->join("tbl_inventory", "tbl_inventory.product_name=tbl_product_country.id", "LEFT")
					->join("tbl_proddetails", "tbl_proddetails.prodid = tbl_product_country.id", "LEFT")
					->join("tbl_admin", "tbl_proddetails.seller_id = tbl_admin.pk_i_admin_id", "LEFT")
					->join("tbl_category", "tbl_proddetails.category = tbl_category.id", "LEFT")
					->join("measurement_unit", "measurement_unit.id = tbl_proddetails.measurement_unit", "LEFT")
					->join("city", "city.id = tbl_admin.city_id", "LEFT")
					->join("tbl_subcategory", "tbl_proddetails.subcatogory = tbl_subcategory.id", "LEFT")
					->where("tbl_product_country.comp_id", $this->session->userdata('companey_id'))
					->where("tbl_product_country.id", $prodno)
					//->where("tbl_proddetails.id IS NOT NULL")
					->order_by("tbl_product_country.id DESC")
					->get()
					->row();

    }

    public function get_product_dynamic_fields_data($pid){
    	$res = array();
		if (!empty($pid)) {
			$comp_id = $this->session->companey_id;
			$this->db->select('product_fields.*,tbl_input.input_label');
			$this->db->from('product_fields');
			$this->db->where('product_id',$pid);
			$this->db->where('parent',$pid);
			$this->db->where('cmp_no',$comp_id);
			$this->db->join('tbl_input','tbl_input.input_id=product_fields.input','inner');
			$form_data = $this->db->get()->result_array();

			if (!empty($form_data)) {
				foreach ($form_data as $key => $value) {
					$fid = $value['input'];
					$res[$fid]['value'] = $value['fvalue'];
					$res[$fid]['title'] = $value['input_label'];
				}
			}
			$data['res'] = $res;						
		}
		return $res;
    }
    

    public function all_block($city_id) {

        return $this->db->select('*')->from('tbl_school')->where('city_id', $city_id)->get()->result();

    }

    

    public function findRows($product_id) {

        return $this->db->select('*')

                        ->from($this->table)

                        ->where('product_id', $product_id)

                        ->get()

                        ->result();

    }

    

    public function school_list_by_id($sIdArr){

        return $this->db->select('sch.*,sch.product_id,sch.school_name,sch.address,sch.contact_name,sch.contact_number,sch.dise_code,sch.created_date,sch.updated_date,tbl_block.block,city.city,state.state')

                        ->from('tbl_school as sch')                        

                        ->join('state', 'state.id = sch.state_id')

                        ->join('city', 'city.id = sch.city_id')

                        ->join('tbl_block', 'tbl_block.block_id = sch.block_id')

                        ->where_in('product_id',$sIdArr)

                        ->order_by('dise_code', "asc")

                        ->get()

                        ->result();

    } 

    

    public function school_contact_list_by_id($product_id){        

        return $this->db->select("*")

                        ->from("tbl_school_contact")

                        ->where('product_id',$product_id)

                        ->order_by('product_id', "desc")

                        ->get()

                        ->result();

        

    }
	
	public function getStock(){
        
  	    return $this->db->select("stk.*,prd.product_name,detl.*")->where("prd.comp_id", $this->session->userdata('companey_id'))->order_by("stk.id DESC")
  	                                            ->from("stock stk")
  	                                            ->join("tbl_product prd", "prd.sb_id = stk.product", "LEFT")
												->join("tbl_proddetails detl", "detl.prodid = prd.sb_id", "LEFT")
												->get()->result();
	  } 
	  
	  public function getstockwithDate($sdate = '',$edate = '')
	  {
		  $this->db->select("stk.*,prd.product_name,wrh.name");
		  $this->db->from('stock stk');
		  $this->db->join("tbl_product prd", "prd.sb_id = stk.product", "LEFT");
		  $this->db->join("tbl_warehouse wrh", "wrh.id = stk.warehouse", "LEFT");
		  $this->db->where("prd.comp_id", $this->session->userdata('companey_id'));
		  if(!empty($sdate) or !empty($edate)) {
			$this->db->where("added_date BETWEEN '$sdate' AND '$edate'");
		  }
		  return $this->db->get()->result();
	  }
     public function getStockById($stkid){
        
  	    return $this->db->select("stk.*,prd.product_name")->where("prd.comp_id", $this->session->userdata('companey_id'))->order_by("stk.id DESC")
				->where("stk.id", $stkid)       
				->from("stock stk")
				->join("tbl_product prd", "prd.sb_id = stk.product", "LEFT")
				->get()->row();
     }   
		public function getWarehouse(){
			return $this->db->select("*")->where("comp_id", $this->session->userdata('companey_id'))->get("tbl_warehouse")->result();
			}
		public function getSupplier(){				return $this->db->select("*")->where("company", $this->session->userdata('companey_id'))->where("role",  4)->get("users")->result();			}
	public function getProduct(){
	    
	    
	    return $this->db->select("*")->where("comp_id", $this->session->userdata('companey_id'))->get("tbl_product")->result();
	    
	}
	public function getProductById($prd){
	    
	    
	    return $this->db->select("*")->where("id", $prd)->where("comp_id", $this->session->userdata('companey_id'))->get("tbl_product")->result();
	    
	}
	

	public function showQuantityDetail($productid,$limit='',$start='')
	{
		$this->db->select('to.ord_no,op.quantity,usr.fname,usr.lname');
		$this->db->from('order_prdct op');
		$this->db->join('tbl_order to','to.id = op.ord_id','left');
		$this->db->join('users usr','usr.id = to.cus_id','left');
		$this->db->where('op.product',$productid);
		if($limit !="")
		{
		  $this->db->limit($limit,$start);
	
		}
		return $this->db->get()->result();
	}
	
	public function stock($act = "1"){
		
		$flrcol  = "prd.product_name,stk.price,stk.quantity";

		if($act == 1) {
			$this->db->select("stk.*,prd.sb_id as pid,prd.product_name");
		}

		if(isset($_GET["action"])){
			
			$filtr = $this->input->get("action");
			
			if($filtr == "created_today"){
				
				$this->db->where("added_date", date("Y-m-d"));
			}
			if($filtr == "updated_today"){
				
				$this->db->where("last_update", date("Y-m-d"));
			}
		}
		$this->db->where("stk.company", $this->session->userdata('companey_id'));

		$this->colfilter($flrcol);

		$this->db->order_by("stk.id DESC");

		$this->db->from("stock stk");

		$this->db->join("tbl_product prd", "prd.sb_id = stk.product", "LEFT");
		
		if($act == 1) {
			$this->limit();	
			return $this->db->get()->result();
		}else{
			return $this->db->count_all_results();
		}
	}
		 public function limit(){
		 
		 if(isset($_POST["length"])) {
				 $this->db->limit($_POST['length'], $_POST['start']);
		
		 }else{
			 $this->db->limit(30, 0);
		
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
	  
	  
	  public function order_by($ordcol){
		  
	
			if(isset($_POST['order'])) 
			{
				$ordpost = $_POST['order']['0']['column']; 
				
				if(!empty($ordcol[$ordpost])){
					$this->db->order_by($ordcol[$ordpost], $_POST['order']['0']['dir']);
				}	
				
			}else{
				//$this->db->order_by("")
			} 
	  }
	public function get_product_id_by_name($name){
    	$this->db->select('id');
    	$this->db->where('country_name',$name);
    	return $this->db->get('tbl_product_country')->row_array();
    }

    public function get_units(){
    	$this->db->select('measurement_unit.*,concat(tbl_admin.s_display_name," ",tbl_admin.last_name) as created_by_name');
    	$this->db->where('measurement_unit.comp_id',$this->session->companey_id);
    	$this->db->join('tbl_admin','tbl_admin.pk_i_admin_id=measurement_unit.created_by','inner');
    	return $this->db->get('measurement_unit')->result();
    }	

}

