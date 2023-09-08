<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Enquiry_n extends CI_Controller {
    public function __construct() {
        parent::__construct();
       
        $this->load->model(
                array('Leads_Model', 'enquiry_model', 'dashboard_model', 'Task_Model', 'User_model', 'location_model', 'Installation_Model', 'Message_models','Institute_model','Datasource_model','Taskstatus_model','dash_model','Center_model','SubSource_model','Kyc_model','Workhistory_model','Education_model','SocialProfile_model','Travelhistory_model','Closefemily_model')
                );
        $this->load->library('email');
        if (empty($this->session->user_id)) {
            redirect('login');
        }
    }

   

    public function index($all='') {
        $this->session->unset_userdata('enquiry_filters_sess');
        if (user_role('60') == true) {}  
         if(!empty($this->session->enq_type)){
			$this->session->unset_userdata('enq_type',$this->session->enq_type);
		}		
        $data['title'] = display('enquiry_list');
		$data['user_list'] = $this->User_model->read();
        $data['products'] = $this->dash_model->product_list();
		
		
        $data['content'] = $this->load->view('enquiry_n', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    public function enq_load_data(){

    	$this->load->model('enquiry_datatable_model');

        $list = $this->enquiry_datatable_model->get_datatables();
       // echo $this->db->last_query();
        $data = array();

        $no = $_POST['start'];
        
        $i = 1;
        
        foreach ($list as $each) {
        
            $no++;
        
            $row = array();
        
            $row[] = '<input onclick="event.stopPropagation();" type="checkbox" name="enquiry_id[]" class="checkbox1" value="<?php echo $each->enquiry_id; ?>">';
            
            $row[] = $i;

            $row[] = $each->icon_url;

            $row[] = $each->company;

            $row[] = $each->name_prefix . " " . $each->name . " " . $each->lastname;

            $row[] = $each->email;

            $row[] = $each->phone;

            $row[] = $each->address;
            $row[] = $each->product_name;

            $row[] = $each->created_date;

            $row[] = $each->created_by_name;

            $row[] = $each->assign_to_name;

            $row[] = $each->datasource_name;

            
            $data[] = $row;

            $i++;

        }      
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->enquiry_datatable_model->count_all(),
            "recordsFiltered" => $this->enquiry_datatable_model->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
