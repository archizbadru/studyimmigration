<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse_model extends CI_Model {





	public function warehouse_list(){

        $company	=	$this->session->userdata('companey_id');
        return $this->db->select("tbl_warehouse.*,state.state as statename,city.city as cityname,tbl_country.country_name as cntryname")
                        ->from("tbl_warehouse")
                        ->join('state','state.id=tbl_warehouse.state','left')
                        ->join('city','city.id=tbl_warehouse.city','left')
                        ->join('tbl_country','tbl_country.id_c=tbl_warehouse.country','left')
						->where('tbl_warehouse.comp_id', $company)
                        ->get()
                        ->result();

}

	public function inventory_list(){

		$this->load->model('common_model');
		$retuser   = $this->common_model->get_categories($this->session->user_id);

        $company=$this->session->userdata('companey_id');
        return $this->db->select("tbl_inventory.*,tbl_product_country.country_name as proname,tbl_brand.name as brandname,tbl_warehouse.name as wrname,concat(tbl_admin.s_display_name,' ',tbl_admin.last_name) as seller_name,tbl_admin.s_user_email as email")
                        ->from("tbl_inventory")
                        ->join('tbl_product_country','tbl_product_country.id=tbl_inventory.product_name','left')
                        //->join('tbl_proddetails','tbl_proddetails.prodid=tbl_inventory.product_name','left')
                        ->join('tbl_brand','tbl_brand.id=tbl_inventory.brand','left')
                        ->join('tbl_warehouse','tbl_warehouse.id=tbl_inventory.warehouse','left')
                        ->join('tbl_admin','tbl_admin.pk_i_admin_id=tbl_inventory.created_by','left')
						->where('tbl_inventory.comp_id', $company)
						->where_in("tbl_inventory.created_by",$retuser)
                        ->get()
                        ->result();

}

public function addwarehouse($data){

	return $this->db->insert('tbl_warehouse',$data);
}


public function readwarehouse($id){


	$this->db->select('*');
	$this->db->from('tbl_warehouse');
	$this->db->where('id',$id);

	return $this->db->get()->row();
}


public function protype_list(){


	$this->db->select('tbl_typeofproduct.*,tbl_warehouse.name as wrname');
	$this->db->join('tbl_warehouse','tbl_warehouse.id=tbl_typeofproduct.warehouse','left');
	$this->db->from('tbl_typeofproduct');
	return $this->db->get()->result();


}

public function warehouse_list1(){

	$this->db->select('*');
	$this->db->from('tbl_warehouse');
	$this->db->where('comp_id',$this->session->userdata('companey_id'));
	return $this->db->get()->result();
}

public function addtypeofproduct($data){

return $this->db->insert('tbl_typeofproduct',$data);

}

public function readtypeofproduct($id){

	$this->db->select('*');
	$this->db->from('tbl_typeofproduct');
	$this->db->where('id',$id);

	return $this->db->get()->row();
}

public function updatetypeofproduct($data){

	 return $this->db->where('id', $data['id'])
                        ->update('tbl_typeofproduct', $data);
}

public function brand_list(){

	$this->db->select('tbl_brand.*,tbl_typeofproduct.name as proname');
	$this->db->from('tbl_brand');
	$this->db->join('tbl_typeofproduct','tbl_typeofproduct.id=tbl_brand.typeofpro','left');
	$this->db->where('tbl_brand.comp_id',$this->session->userdata('companey_id'));
	return $this->db->get()->result();
}


public function addbrand($data){

return $this->db->insert('tbl_brand',$data);

}

public function typeofproduct_list(){

    $this->db->select('*');
	$this->db->from('tbl_typeofproduct');
	return $this->db->get()->result();

}

public function readbrandlist($id){

     $this->db->select('*');
	$this->db->from('tbl_brand');
	$this->db->where('id',$id);

	return $this->db->get()->row();

}

public function get_productid_byname($name){

    $this->db->select('id');
	$this->db->from('tbl_product_country');
	$this->db->where('country_name',$name);

	return $this->db->get()->row();

}

public function get_warehouseid_byname($name){

    $this->db->select('id');
	$this->db->from('tbl_warehouse');
	$this->db->where('name',$name);

	return $this->db->get()->row();

}

public function get_brandid_byname($name){

    $this->db->select('id');
	$this->db->from('tbl_brand');
	$this->db->where('name',$name);

	return $this->db->get()->row();

}

public function addinventory($data){

	$pid    =   $data['product_name'];
    $comp_id = $this->session->companey_id;
    $this->db->where('comp_id',$comp_id);
    $this->db->where('product_name',$pid);
    $row    =   $this->db->get('tbl_inventory')->row_array();
    if (empty($row)) {
		return $this->db->insert('tbl_inventory',$data);
    }else{
    	$this->db->where('product_name',$pid);
    	$this->db->where('comp_id',$comp_id);
    	return $this->db->update('tbl_inventory',$data);
    }


}

public function productcountry(){

    $this->db->select('*');
	$this->db->from('tbl_product_country');
	$this->db->where('comp_id',$this->session->userdata('companey_id'));
	return $this->db->get()->result();

}



}
?>