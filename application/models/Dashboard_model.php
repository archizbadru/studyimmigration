<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Dashboard_model extends CI_Model {



	private $table = "tbl_admin"; 

	public function check_userByID($user_id)
	{
		$user=$this->db->where(array('user_id'=>$user_id,'user_role'=>2))->get('user');
		return $user;
	}
	public function check_userByMAIL($email)
	{
		$check_user=  $this->db->select("*")
         ->from('tbl_admin')
         ->join('user','user.user_id = tbl_admin.companey_id','left')			
         ->where(array('s_user_email'=>$email))
		 ->get();
		 return $check_user;
	}
 

	public function check_user($data = []){

		$where = "(tbl_admin.s_user_email='".$data['email']."' OR tbl_admin.s_phoneno='".$data['email']."') AND tbl_admin.s_password='".$data['password']."' AND tbl_admin.b_status = 1";
		
		return $this->db->select("*")
			->from($this->table)
			->join('user','user.user_id = tbl_admin.companey_id','left')			
			->where($where)
			->get();

	} 

	public function check_user_by_mail_phone($data = []){

		$where = "(tbl_admin.s_user_email='".$data['email']."' OR tbl_admin.s_phoneno='".$data['phone']."')";
		
		return $this->db->select("*")
			->from($this->table)
			->join('user','user.user_id = tbl_admin.companey_id','left')			
			->where($where)
			->get()->row();

	} 

	public function find_user_by_email($email){
		return $this->db->select("*")
			->from($this->table)
			->join('user','user.user_id = tbl_admin.companey_id','left')
			->where('tbl_admin.s_user_email',$email)			
			->where('tbl_admin.b_status',1)
			->get()
			->row();
	} 

  
	public function check_user_enquiry($user_id)

	{

		return $this->db->select("*")

			->from($this->table)

			->join('user','user.user_id = tbl_admin.companey_id','left')
			->where('tbl_admin.pk_i_admin_id',$user_id)

			->where('tbl_admin.b_status',1)

			->get();

	}
 


	public function check_patient($data = [])

	{

		return $this->db->select("*")

			->from("patient")

			->where('email',$data['email'])

			->where('password',$data['password'])

			->where('status',1)

			->get();

	}  



	public function read_by_id($user_id = null)

	{

		return $this->db->select("user.*, department.name AS department")

			->from('user')

			->join('department', 'department.dprt_id = user.department_id', 'left')

			->where('user.user_id',$user_id)

			->get()

			->row();

	} 



	public function profile($user_id = null)

	{

		return $this->db->select("*")

			->from("user") 

			->where('user_id', $user_id)

			->get()

			->row();

	} 

	public function enquiry()

	{

		return $this->db->select('enquiry_id, name, email, enquiry')

			->from('enquiry')

			->limit(4)

			->order_by('checked','asc')

			->order_by('created_date','desc')

			->order_by('enquiry_id','desc')

			->get()

			->result();

	}



 

	public function update($data = [])

	{

		return $this->db->where('user_id',$data['user_id'])

			->update("user" ,$data); 

	} 



	//Enquiry...

	public function get_reports()

	{

	    /* user roles

	    3 = Country Head

	    4 = Region Head

	    5 = Territory Head

	    6 = State Head

	    7 = City Head 

	    8 = User */

	    

	   $user_id   = $this->session->user_id;

	   $user_role = $this->session->user_role;

	   $region_id = $this->session->region_id;

	   $assign_country = $this->session->country_id;

	   $assign_region = $this->session->region_id;

	   $assign_territory = $this->session->territory_id;

	   $assign_state = $this->session->state_id;

	   $assign_city = $this->session->city_id;

	   

	   if($user_role==3){

	       

	       return $this->db->select('COUNT(*) AS total')

	                   ->from('enquiry')

	                   ->join('tbl_country','tbl_country.id_c=enquiry.country_id')

	                   ->where('enquiry.country_id',$assign_country)

	                   ->or_where('enquiry.created_by',$user_id)

	                   ->get()

	                   ->row();

	       

	   }else if($user_role==4){

	       

	       return $this->db->select('COUNT(*) AS total')

	                       ->from('enquiry')

	                       ->join('tbl_region','tbl_region.country_id=enquiry.region_id')

	                       ->where('enquiry.region_id',$assign_region)

	                        ->or_where('allleads.created_by',$user_id)

	                       ->get()

	                       ->row();

	       

	       

	   }else if($user_role==5){

	       

	        return $this->db->select('COUNT(*) AS total')

	                       ->from('enquiry')

	                       ->join('territory_id','territory_id.territory_id=enquiry.territory_id')

	                       ->where('enquiry.territory_id',$assign_territory)

	                       ->or_where('enquiry.created_by',$user_id)

	                       ->get()

	                       ->row();

	       

	       

	   }else if($user_role==6){

	       

	       return $this->db->select('COUNT(*) AS total')

	                       ->from('enquiry')

	                       ->join('state','state.id=enquiry.state_id')

	                       ->where('enquiry.state_id',$assign_state)

	                       ->or_where('enquiry.created_by',$user_id)

	                       ->get()

	                       ->row();

	       

	       

	   }else if($user_role==7){

	       

	        return $this->db->select('COUNT(*) AS total')

	                       ->from('enquiry')

	                       ->join('city','city.id=enquiry.city_id')

	                       ->where('enquiry.city_id',$assign_city)

	                       ->or_where('enquiry.created_by',$user_id)

	                       ->get()

	                       ->row();

	       

	   }elseif($user_role==8){

	       

	        return $this->db->select('COUNT(*) AS total')

	                       ->from('enquiry')

	                       ->where('aasign_to',$user_id)

	                        ->or_where('created_by',$user_id)

	                       ->get()

	                       ->row();

	       

	   }

	    

	    

	   

	}

	

	public function get_lead_report(){

	    

	    /* user roles

	    3 = Country Head

	    4 = Region Head

	    5 = Territory Head

	    6 = State Head

	    7 = City Head 

	    8 = User */

	    

	   $user_id   = $this->session->user_id;

	   $user_role = $this->session->user_role;

	   $region_id = $this->session->region_id;

	   $assign_country = $this->session->country_id;

	   $assign_region = $this->session->region_id;

	   $assign_territory = $this->session->territory_id;

	   $assign_state = $this->session->state_id;

	   $assign_city = $this->session->city_id;

	   

	   if($user_role==3){

	       

	       return $this->db->select('COUNT(*) AS total')

	                   ->from('allleads')

	                   ->join('tbl_country','tbl_country.id_c=allleads.country_id')

	                   ->where('allleads.country_id',$assign_country)

	                   ->or_where('allleads.create_by',$user_id)

	                   ->get()

	                   ->row();

	       

	   }else if($user_role==4){

	       

	       return $this->db->select('COUNT(*) AS total')

	                       ->from('allleads')

	                       ->join('tbl_region','tbl_region.country_id=allleads.region_id')

	                       ->where('allleads.region_id',$assign_region)

	                        ->or_where('allleads.create_by',$user_id)

	                       ->get()

	                       ->row();

	       

	       

	   }else if($user_role==5){

	       

	        return $this->db->select('COUNT(*) AS total')

	                       ->from('allleads')

	                       ->join('territory_id','territory_id.territory_id=allleads.territory_id')

	                       ->where('allleads.territory_id',$assign_territory)

	                       ->or_where('allleads.create_by',$user_id)

	                       ->get()

	                       ->row();

	       

	       

	   }else if($user_role==6){

	       

	       return $this->db->select('COUNT(*) AS total')

	                       ->from('allleads')

	                       ->join('state','state.id=allleads.state_id')

	                       ->where('allleads.state_id',$assign_state)

	                       ->or_where('allleads.create_by',$user_id)

	                       ->get()

	                       ->row();

	       

	       

	   }else if($user_role==7){

	       

	        return $this->db->select('COUNT(*) AS total')

	                       ->from('allleads')

	                       ->join('city','city.id=allleads.city_id')

	                       ->where('allleads.city_id',$assign_city)

	                       ->or_where('allleads.create_by',$user_id)

	                       ->get()

	                       ->row();

	       

	   }elseif($user_role==8){

	       

	        return $this->db->select('COUNT(*) AS total')

	                       ->from('allleads')

	                       ->where('adminid',$user_id)

	                        ->or_where('create_by',$user_id)

	                       ->get()

	                       ->row();

	       

	   }

	    

	    

	    

	}

	

	//Get List of total customer...

	public function get_customers_report(){

	    

	    /* user roles

	    3 = Country Head

	    4 = Region Head

	    5 = Territory Head

	    6 = State Head

	    7 = City Head 

	    8 = User */

	    

	   $user_id   = $this->session->user_id;

	   $user_role = $this->session->user_role;

	   $region_id = $this->session->region_id;

	   $assign_country = $this->session->country_id;

	   $assign_region = $this->session->region_id;

	   $assign_territory = $this->session->territory_id;

	   $assign_state = $this->session->state_id;

	   $assign_city = $this->session->city_id;

	   

	   if($user_role==3){

	       

	       return $this->db->select('COUNT(*) AS total')

	                   ->from('clients')

	                   ->join('tbl_country','tbl_country.id_c=clients.country_id')

	                   ->where('clients.country_id',$assign_country)

	                   ->or_where('clients.create_by',$user_id)

	                   ->get()

	                   ->row();

	       

	   }else if($user_role==4){

	       

	       return $this->db->select('COUNT(*) AS total')

	                       ->from('clients')

	                       ->join('tbl_region','tbl_region.country_id=clients.region_id')

	                       ->where('clients.region_id',$assign_region)

	                       ->or_where('clients.create_by',$user_id)

	                       ->get()

	                       ->row();

	       

	       

	   }else if($user_role==5){

	       

	        return $this->db->select('COUNT(*) AS total')

	                       ->from('clients')

	                       ->join('territory_id','territory_id.territory_id=clients.territory_id')

	                       ->where('clients.territory_id',$assign_territory)

	                       ->or_where('clients.create_by',$user_id)

	                       ->get()

	                       ->row();

	       

	       

	   }else if($user_role==6){

	       

	       return $this->db->select('COUNT(*) AS total')

	                       ->from('clients')

	                       ->join('state','state.id=clients.state_id')

	                       ->where('clients.state_id',$assign_state)

	                       ->or_where('clients.create_by',$user_id)

	                       ->get()

	                       ->row();

	       

	       

	   }else if($user_role==7){

	       

	        return $this->db->select('COUNT(*) AS total')

	                       ->from('clients')

	                       ->join('city','city.id=clients.city_id')

	                       ->where('clients.city_id',$assign_city)

	                        ->or_where('clients.create_by',$user_id)

	                       ->get()

	                       ->row();

	       

	   }else if($user_role==8){

	       

	        return $this->db->select('COUNT(*) AS total')

	                       ->from('clients')

	                       ->where('assign_to',$user_id)

	                       ->or_where('create_by',$user_id)

	                       ->get()

	                       ->row();

	       

	   }

	    

	    

	    

	}

	

	//Get total invoices...

	public function get_all_invoices(){

	    

	    /* user roles

	    3 = Country Head

	    4 = Region Head

	    5 = Territory Head

	    6 = State Head

	    7 = City Head 

	    8 = User */

	    

	   $user_id   = $this->session->user_id;

	   $user_role = $this->session->user_role;

	   $region_id = $this->session->region_id;

	   $assign_country = $this->session->country_id;

	   $assign_region = $this->session->region_id;

	   $assign_territory = $this->session->territory_id;

	   $assign_state = $this->session->state_id;

	   $assign_city = $this->session->city_id;

	   

	  

	   

	   if($user_role==3){

	       

	       return $this->db->select('COUNT(*) AS total')

	                   ->from('clients')

	                   ->join('tbl_country','tbl_country.id_c=clients.country_id')

	                   ->join('tbl_boq','tbl_boq.emp_id=clients.customer_code')

	                   ->where('clients.country_id',$assign_country)

	                   ->or_where('clients.create_by',$user_id)

	                   ->or_where('tbl_boq.create_by',$user_id)

	                   ->get()

	                   ->row();

	       

	   }else if($user_role==4){

	       

	       return $this->db->select('COUNT(*) AS total')

	                       ->from('clients')

	                       ->join('tbl_region','tbl_region.country_id=clients.region_id')

	                        ->join('tbl_boq','tbl_boq.emp_id=clients.customer_code')

	                       ->where('clients.region_id',$assign_region)

	                       ->or_where('clients.create_by',$user_id)

	                       ->or_where('tbl_boq.create_by',$user_id)

	                       ->get()

	                       ->row();

	       

	       

	   }else if($user_role==5){

	       

	        return $this->db->select('COUNT(*) AS total')

	                       ->from('clients')

	                       ->join('territory_id','territory_id.territory_id=clients.territory_id')

	                       ->join('tbl_boq','tbl_boq.emp_id=clients.customer_code')

	                       ->where('clients.territory_id',$assign_territory)

	                       ->or_where('clients.create_by',$user_id)

	                       ->or_where('tbl_boq.create_by',$user_id)

	                       ->get()

	                       ->row();

	       

	       

	   }else if($user_role==6){

	       

	       return $this->db->select('COUNT(*) AS total')

	                       ->from('clients')

	                       ->join('state','state.id=clients.state_id')

	                       ->join('tbl_boq','tbl_boq.emp_id=clients.customer_code')

	                       ->where('clients.state_id',$assign_state)

	                       ->or_where('clients.create_by',$user_id)

	                       ->or_where('tbl_boq.create_by',$user_id)

	                       ->get()

	                       ->row();

	       

	       

	   }else if($user_role==7){

	       

	        return $this->db->select('COUNT(*) AS total')

	                       ->from('clients')

	                       ->join('city','city.id=clients.city_id')

	                       ->join('tbl_boq','tbl_boq.emp_id=clients.customer_code')

	                       ->where('clients.city_id',$assign_city)

	                        ->or_where('clients.create_by',$user_id)

	                        ->or_where('tbl_boq.create_by',$user_id)

	                       ->get()

	                       ->row();

	       

	   }else if($user_role==8){

	       

	        return $this->db->select('COUNT(*) AS total')

	                       ->from('tbl_boq')

	                       ->where('create_by',$user_id)

	                       ->get()

	                       ->row();

	       

	   }

	    

	}

	

	//Get city,state,teritory,Region according to city...

	public function location_base_country($country){

	    

         $tbl_region = $this->db->select('*')->from('tbl_region')->where('country_id',$country)->get()->result();

         

         $tbl_territory = $this->db->select('*')->from('tbl_territory')->where('country_id',$country)->get()->result();

         

         $state = $this->db->select('*')->from('state')->where('country_id',$country)->get()->result();

         

         $city = $this->db->select('*')->from('city')->where('country_id',$country)->get()->result();

         

         return array('region'=>$tbl_region,'territory'=>$tbl_territory,'state'=>$state,'city'=>$city);

	    

	}

	

	public function all_locations(){

	    

	     $tbl_region = $this->db->select('*')->from('tbl_region')->get()->result();

         

         $tbl_territory = $this->db->select('*')->from('tbl_territory')->get()->result();

         

         $state = $this->db->select('*')->from('state')->get()->result();

         

         $city = $this->db->select('*')->from('city')->get()->result();

         

         return array('region'=>$tbl_region,'territory'=>$tbl_territory,'state'=>$state,'city'=>$city);

	}

    

    //change password...

    public function change_pass($email){

        

        $datas = array('reset_password'=>1);

        

            $data = $this->db->select('pk_i_admin_id,companey_id,s_user_email,s_password,reset_password')

                        ->from('tbl_admin')

                        ->where('s_user_email',$email)

                        ->get()

                        ->row();

                        

                if($data==true){

                    

                     $this->db->where('s_user_email',$email)->update('tbl_admin',$datas);

                     

                     return $data;

                }

                        

            

    }

    public function getUserDataByPhone($mob)
    {
    	if(!empty($mob))
    	{
    		return $this->db->select("*")->from('tbl_admin')->where('s_phoneno',$mob)->get()->row();
    	}
    	else
    	{
    		return "";
    	}

    }

    

    //change password

    public function set_new_pass($user,$data){

        

        $this->db->where('pk_i_admin_id',$user)

                        ->update('tbl_admin',$data);

                        

            if($this->db->affected_rows() >=0){

                

              return true; 

              

            }else{

                

              return false; //add your your code here

              

            }

    }

    

    //check link is dissabled or not

    public function disabl_reset_link($user){

        

        return $this->db->select('reset_password')

                        ->from('tbl_admin')

                        ->where('pk_i_admin_id',$user)

                        ->get()

                        ->row();

    }

  

}

