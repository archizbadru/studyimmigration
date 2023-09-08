<?php 

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'website/user_model','enquiry_model','location_model')
	); 

	}
 

	public function index()
	{
		$data['title'] = "Home";
		#-------------------------------#
		// $data['items'] = $this->item_model->read();
		$this->load->view('website/index',$data);
		// $this->load->view('layout/main_wrapper',$data);
	}

    public function student()
	{
		$data['title'] = "Home";
		#-------------------------------#
		
		$this->load->view('website/student',$data);
		
	}

	public function university()
	{
		$data['title'] = "Home";
		#-------------------------------#
		// $data['items'] = $this->item_model->read();
		$this->load->view('website/univercity',$data);
		// $this->load->view('layout/main_wrapper',$data);
	}

	public function contact()
	{
		$data['title'] = "Contact Us";
		#-------------------------------#
		// $data['items'] = $this->item_model->read();
		$this->load->view('website/contact',$data);
		// $this->load->view('layout/main_wrapper',$data);
	}

	public function signup_user(){

		$data['title'] = "Home";
		#-------------------------------#
		 $data['city_list'] = $this->location_model->city_list1();
		$this->load->view('website/signup_user',$data);
		// $this->load->view('layout/main_wrapper',$data);
	} 

	public function signupuser(){

	$this->form_validation->set_rules('phone', 'Phone', 'trim|required|max_length[10]|min_length[10]');
	$this->form_validation->set_rules('email', 'email', 'trim|required|is_unique[tbl_admin.s_user_email]', array('is_unique'=>'Email already exist'));

	if($this->form_validation->run()==true){

		$encode = $this->get_enquery_code();

		$cityid = $this->input->post('city');

		$city = $this->location_model->get_statecnt($cityid);
        $encode = $this->get_enquery_code();

    if($_POST){

    $datasignup = array(

    's_display_name' => $this->input->post('fname'),
    'last_name' => $this->input->post('lname'),
    's_user_email' => $this->input->post('email'),
    's_phoneno' => $this->input->post('phone'),
    's_password' => md5($this->input->post('pw')),
    'user_permissions' => 111,
    'city_id' => $city->id,
    'state_id' => $city->stid,
    'country' => $city->cid,
    'companey_id' =>1
);

    $data_enq = array(
    'Enquery_id' => $encode,
    'name' => $this->input->post('fname'),
    'lastname' => $this->input->post('lname'),
    'email' => $this->input->post('email'),
    'city_id' => $city->id,
    'state_id' => $city->stid,
    'country_id' => $city->cid,
    'phone' => $this->input->post('phone'),
    'comp_id' =>1,
    'enquiry_source'=>77,
    'status' =>1,
    'created_by'=>154,
    'product_id'=>99
);

    $res = $this->user_model->insert($datasignup);
    $res1 = $this->user_model->insert_enq($data_enq);

    if($res && $res1){
    
     $this->session->set_flashdata('message','User signed up successfuly');
     redirect(base_url('website/home/signup_user'));

     }
     else{
     	     $this->session->set_flashdata('error','Failed');
              redirect(base_url('website/home/signup_user'));
     }

    }
}else{

	          $this->session->set_flashdata('error',validation_errors());
              redirect(base_url('website/home/signup_user'));

}
}


public function signupuniversity(){

	$this->form_validation->set_rules('phone', 'Phone', 'trim|required|max_length[10]|min_length[10]');
	$this->form_validation->set_rules('email', 'email', 'trim|required|is_unique[tbl_admin.s_user_email]', array('is_unique'=>'Email already exist'));


	if($this->form_validation->run()==true){

		$cityid = $this->input->post('city');

		$city = $this->location_model->get_statecnt($cityid);


        $encode = $this->get_enquery_code();

    if($_POST){

    $data = array(

    's_display_name' => $this->input->post('uname'),
    's_user_email' => $this->input->post('email'),
    's_phoneno' => $this->input->post('phone'),
    's_password' => md5($this->input->post('pw')),
    'user_permissions' => 110,
    'city_id' => $city->id,
    'state_id' => $city->stid,
    'country' => $city->cid,
    'companey_id' =>1
);

    $data_enq = array(
    'Enquery_id' => $encode,
    'name' => $this->input->post('uname'),
    'email' => $this->input->post('email'),
    'phone' => $this->input->post('phone'),
    'comp_id' =>1,
    'city_id' => $city->id,
    'state_id' => $city->stid,
    'country_id' => $city->cid,
    'enquiry_source'=>77,
    'status' =>1,
    'created_by'=>154,
    'product_id'=>98
);

    $res = $this->user_model->insert($data);
      $res1 = $this->user_model->insert_enq($data_enq);
    if($res){
    
     $this->session->set_flashdata('message','University has been created successfuly');
     redirect(base_url('website/home/signup_university'));

     }
     else{
     	     $this->session->set_flashdata('error','Failed');
              redirect(base_url('website/home/signup_university'));
     }

    }
}else{

	          $this->session->set_flashdata('error',validation_errors());
              redirect(base_url('website/home/signup_university'));

}
}



	public function signup_university(){

		$data['title'] = "Home";
		#-------------------------------#
		// $data['items'] = $this->item_model->read();
		$data['city_list'] = $this->location_model->city_list1();
		$this->load->view('website/signup_university',$data);
		// $this->load->view('layout/main_wrapper',$data);
	}


	public function login(){

		$data['title'] = "Login";
		#-------------------------------#
		// $data['items'] = $this->item_model->read();
		$this->load->view('website/login',$data);
	}

	public function login1(){

		$data['title'] = "Login";
		#-------------------------------#
		// $data['items'] = $this->item_model->read();
		$this->load->view('website/login1',$data);
	}


  public function get_enquery_code() {

        $code = $this->genret_code();
        $code2 = 'ENQ' . $code;
        $response = $this->enquiry_model->check_existance($code2);
        
        if ($response) {
            
            $this->get_enquery_code();

        } else {
            
            return $code2;
            
            //exit;
        }
        //exit;
    }


 function genret_code() {
        $pass = "";
        $chars = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");

        for ($i = 0; $i < 12; $i++) {
            $pass .= $chars[mt_rand(0, count($chars) - 1)];
        }
        return $pass;
 }

 public function aboutus(){

       $data['title'] = "About Us";
		#-------------------------------#
		// $data['items'] = $this->item_model->read();
		$this->load->view('website/aboutus',$data);

 }



}?>