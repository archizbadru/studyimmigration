<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Warehouse extends CI_Controller {
    public function __construct() {

        parent::__construct();
        $this->load->library('user_agent');
        $this->load->helper('date');
        $this->load->model(
                array('Leads_Model','common_model','enquiry_model', 'dashboard_model', 'Task_Model', 'User_model', 'location_model', 'Message_models','Institute_model','Datasource_model','Taskstatus_model','dash_model','Center_model','SubSource_model','Kyc_model','Education_model','SocialProfile_model','Closefemily_model','form_model','warehouse_model')
                );
        if (empty($this->session->user_id)) {
            redirect('login');
        }

   

    }


public function auto_logout(){

    // $minutes=3;//Set logout time in minutes    
    // if (!isset($_SESSION['time'])) {
    //     $_SESSION['time'] = time();
    // } else if (time()-$_SESSION['time']>$minutes*60) {
    //     session_destroy();
    //     redirect('login');//redirect user to a login page or any page to which we want to redirect.
    // }

}

public function warehouse(){


        $data['title'] = 'Warehouse List';
        $data['warehouse_list'] = $this->warehouse_model->warehouse_list();
        $data['content'] = $this->load->view('warehouse/warehouse_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);


}
public function get_product_stock(){
    $pid    =   $this->input->post('pid');
    $comp_id = $this->session->companey_id;
    $this->db->where('comp_id',$comp_id);
    $this->db->where('product_name',$pid);
    $row    =   $this->db->get('tbl_inventory')->row_array();
    if (!empty($row)) {
        echo json_encode($row);
    }else{
        echo 0;
    }

}
public function addwarehouse(){


      $data['title'] = 'Add Warehouse';
        if (empty($this->input->post('user_id'))) {
          $this->form_validation->set_rules('name', display('name'), 'required|max_length[50]');
        } else {
          $this->form_validation->set_rules('name', display('name'), 'required|max_length[50]');
        }     
        $data['formdata'] = (object) $postData = [
            'id' => $this->input->post('id', true),
            'comp_id' => $this->session->userdata('companey_id'),
            'name' => $this->input->post('name', true),
            'phone' => $this->input->post('phone', true),
            'email' => $this->input->post('email', true),
            'address' => $this->input->post('address', true),
            'country' => $this->input->post('country', true),
            'state' => $this->input->post('state', true),
            'city' => $this->input->post('city', true),
            'status' => $this->input->post('status', true),
            'created_by' => $this->session->userdata('user_id')
        ];
        if ($this->form_validation->run() === true) {
            if (empty($this->input->post('id'))) {
                if (user_role('30') == true) {}
                if ($this->warehouse_model->addwarehouse($postData)) {
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('warehouse/warehouse');
            } else {
                if (user_role('31') == true) {                    
                }
                if ($this->location_model->updateProductCountry($postData)) {
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('warehouse/warehouse');
            }
        } else {
            $data['country_list'] = $this->location_model->country();
            // print_r( $data['country_list']);exit();
            $data['content'] = $this->load->view('warehouse/add_warehouse', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
}


public function editwarehouse($id){


     if (user_role('31') == true) {}
        $data['title'] = 'Edit Product';
        $data['formdata'] = $this->warehouse_model->readwarehouse($id);
        $data['country_list'] = $this->location_model->country();
        $data['content'] = $this->load->view('warehouse/add_warehouse', $data, true);
        $this->load->view('layout/main_wrapper', $data);
}

public function deletewarehouse($id){

   $res = $this->db->where('id',$id)->delete('tbl_warehouse');

   if($res){

             redirect('warehouse/warehouse');
   }

}




public function typeofproduct(){

        $data['title'] = 'Product Type';
        $data['protype_list'] = $this->warehouse_model->protype_list();
        $data['content'] = $this->load->view('warehouse/typeofproduct', $data, true);
        $this->load->view('layout/main_wrapper', $data);

}

public function deletetypeofproduct($id){

   $res = $this->db->where('id',$id)->delete('tbl_typeofproduct');

   if($res){

             redirect('warehouse/typeofproduct');
   }
}


public function addtypeofproduct(){

      $data['title'] = 'Add Product Type';
        if (empty($this->input->post('user_id'))) {
          $this->form_validation->set_rules('name', display('name'), 'required|max_length[50]');
        } else {
          $this->form_validation->set_rules('name', display('name'), 'required|max_length[50]');
        }     
        $data['formdata'] = (object) $postData = [
            'id' => $this->input->post('id', true),
            'comp_id' => $this->session->userdata('companey_id'),
            'warehouse' => $this->input->post('warehousename', true),
            'name' => $this->input->post('name', true),
            'status' => $this->input->post('status', true),
            'created_by' => $this->session->userdata('user_id')
        ];
        if ($this->form_validation->run() === true) {
            if (empty($this->input->post('id'))) {
                if (user_role('30') == true) {}
                if ($this->warehouse_model->addtypeofproduct($postData)) {
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('warehouse/typeofproduct');
            } else {
                if (user_role('31') == true) {                    
                }
                if ($this->warehouse_model->updatetypeofproduct($postData)) {
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('warehouse/typeofproduct');
            }
        } else {
            $data['warehouse_list'] = $this->warehouse_model->warehouse_list1();
            // print_r( $data['country_list']);exit();
            $data['content'] = $this->load->view('warehouse/add_typeofproduct', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
}


public function edittypeofproduct($id){

     if (user_role('31') == true) {}
        $data['title'] = 'Edit Product';
        $data['formdata'] = $this->warehouse_model->readtypeofproduct($id);
        $data['warehouse_list'] = $this->warehouse_model->warehouse_list1();
        $data['content'] = $this->load->view('warehouse/add_typeofproduct', $data, true);
        $this->load->view('layout/main_wrapper', $data);
}

public function brand(){

        $data['title'] = 'Brand List';
        $data['brand_list'] = $this->warehouse_model->brand_list();
        $data['content'] = $this->load->view('warehouse/brand', $data, true);
        $this->load->view('layout/main_wrapper', $data);
}

public function deletebrand($id){

     $res = $this->db->where('id',$id)->delete('tbl_brand');

   if($res){

             redirect('warehouse/brand');
   }
}

public function addbrand(){

     $data['title'] = 'Add Brand';
        if (empty($this->input->post('user_id'))) {
          $this->form_validation->set_rules('name', display('name'), 'required|max_length[50]');
        } else {
          $this->form_validation->set_rules('name', display('name'), 'required|max_length[50]');
        }     
        $data['formdata'] = (object) $postData = [
            'id' => $this->input->post('id', true),
            'comp_id' => $this->session->userdata('companey_id'),
            'typeofpro' => $this->input->post('top', true),
            'name' => $this->input->post('name', true),
            'status' => $this->input->post('status', true),
            'created_by' => $this->session->userdata('user_id')
        ];
        if ($this->form_validation->run() === true) {
            if (empty($this->input->post('id'))) {
                if (user_role('30') == true) {}
                if ($this->warehouse_model->addbrand($postData)) {
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('warehouse/brand');
            } else {
                if (user_role('31') == true) {                    
                }
                if ($this->warehouse_model->updatebrand($postData)) {
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('warehouse/brand');
            }
        } else {
            $data['typeofpro_list'] = $this->warehouse_model->typeofproduct_list();
            // print_r( $data['country_list']);exit();
            $data['content'] = $this->load->view('warehouse/addbrand', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
}

public function editbrand($id){

        if (user_role('31') == true) {}
        $data['title'] = 'Edit Brand';
        $data['formdata'] = $this->warehouse_model->readbrandlist($id);
       $data['typeofpro_list'] = $this->warehouse_model->typeofproduct_list();
        $data['content'] = $this->load->view('warehouse/addbrand', $data, true);
        $this->load->view('layout/main_wrapper', $data);
}

public function inventory(){
    $this->load->model('Product_model');
        $data['title'] = 'Inventory List';
        $data['inventory_list'] = $this->warehouse_model->inventory_list();
        $data['warehouse_list'] = $this->warehouse_model->warehouse_list();
        $data['brand_list'] = $this->warehouse_model->brand_list();
        $data['country'] = $this->Product_model->productdetlist();
		
        $data['content'] = $this->load->view('warehouse/inventory', $data, true);
        $this->load->view('layout/main_wrapper', $data);

}

public function upload_inventory(){
    $this->load->library('upload');
 // echo  $_FILES['imgfile']['tmp_name'];exit();
      $count=0;
        $fp = fopen($_FILES['imgfile']['tmp_name'],'r') or die("can't open file");
        // print_r($fp);exit();
        while($csv_line = fgetcsv($fp,1024))
        {
            $count++;
            if($count == 1)
            {
                continue;
            }//keep this if condition if you want to remove the first row
            for($i = 0, $j = count($csv_line); $i < $j; $i++)
            {
                $insert_csv = array();

                $insert_csv['skuid'] = $csv_line[0];//remove if you want to have primary key,
                // $insert_csv['batchno'] = $csv_line[1];
                $insert_csv['serialno'] = $csv_line[1];
                $insert_csv['product_name'] = $csv_line[2];
                $insert_csv['warehouse'] = $csv_line[3];
                $insert_csv['qty'] = $csv_line[4];
                $insert_csv['brand'] = $csv_line[5];
                // $insert_csv['sts'] = $csv_line[5];
                // $insert_csv['age'] = $csv_line[6];
                // $insert_csv['address'] = $csv_line[7];
                // $insert_csv['sex'] = $csv_line[8];
         // print_r($insert_csv);

            }
            // $i++;
            $cnt = count($fp);
            //echo $cnt;
            for($i=0;$i<$cnt;$i++){
             $res_proid = $this->warehouse_model->get_productid_byname($insert_csv['product_name']); 
             $res_warehouse = $this->warehouse_model->get_warehouseid_byname($insert_csv['warehouse']); 
             $res_brand = $this->warehouse_model->get_brandid_byname($insert_csv['brand']); 

              $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 

             $batchno = substr(str_shuffle($str_result),0, 10); 

            // print_r($res['id']);

            $data = array(
                'comp_id'      => $this->session->userdata('companey_id'),
                'skuid'        =>  $insert_csv['skuid'] ,
                'batchno'      => $batchno,
                'serialno'     => $insert_csv['serialno'],
                'product_name' => $res_proid->id,
                'warehouse'    => $res_warehouse->id,
                'qty'          => $insert_csv['qty'],
                'brand'        => $res_brand->id,
                'created_by' => $this->session->userdata('user_id'),
                );

             $result = $this->warehouse_model->addinventory($data);
             // print_r($result);exit();

           
}
        }
        fclose($fp) or die("can't close file");

       /// if($result){
            $this->session->set_flashdata('message','Added successfuly');
            redirect('warehouse/inventory');
}




public function add_inventory(){

         $data['title'] = 'Add Warehouse';
        if (empty($this->input->post('user_id'))) {
          $this->form_validation->set_rules('proname', display('name'), 'required|max_length[50]');
        } else {
          $this->form_validation->set_rules('proname', display('name'), 'required|max_length[50]');
        }     

        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 

        $batchno = substr(str_shuffle($str_result),0, 10); 
 
        $data['formdata'] = (object) $postData = [
            //'id' => $this->input->post('id', true),
            'comp_id' => $this->session->userdata('companey_id'),
            'product_name' => $this->input->post('proname', true),
            'skuid' => $this->input->post('skuid', true),
            'batchno' => $batchno,
            'serialno' => $this->input->post('serialno', true),
            'warehouse' => $this->input->post('warehouse', true),
            'qty' => $this->input->post('qty', true),
            'brand' => $this->input->post('brand', true),
            'created_by' => $this->session->userdata('user_id')
        ];
        if ($this->form_validation->run() === true) {
            if (empty($this->input->post('id'))) {
               
                if ($this->warehouse_model->addinventory($postData)) {
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('warehouse/inventory');
            } else {
               // unset($postData['id']);
               
                if ($this->warehouse_model->updateinventory($postData)) {
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('warehouse/warehouse');
            }
        } else {
            
            // print_r($data['country']);exit();
            $data['content'] = $this->load->view('warehouse/inventory', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
}

public function select_skuid(){

    $id = $this->input->post('id');
    $this->db->select('*');
    $this->db->from('tbl_proddetails');
    $this->db->where('prodid',$id);
    $res = $this->db->get()->result();

    echo json_encode($res);
}

// public function select_brand(){

//     $id = $this->input->post('id');
//     $this->db->select('*');
//     $this->db->from('tbl_product_country');
//     $this->db->where('id',$id);
//     $resbrand = $this->db->get()->result();

//     echo json_encode($resbrand);
// }

}
?>