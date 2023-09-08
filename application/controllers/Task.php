<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Task extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('user_agent');
        $this->load->model(array(
            'Task_Model', 'Leads_Model', 'Client_Model', 'enquiry_model', 'User_model','Taskstatus_model'
        ));
        if(empty($this->session->user_id)){
         redirect('login');   
        }
    }
    public function abc(){
        echo phpinfo();
        exit();
    }
    public function index() {
        $this->session->unset_userdata('filter_user_id');
        $aid = $this->session->userdata('user_id');

        /*if($this->input->post('from_exp')==''){
             $from ='';  
            }else{
           $dfrom= $this->input->post('from_exp');
           $from = date("d/m/Y", strtotime($dfrom));
            }
            if($this->input->post('to_exp')==''){
                $to ='';
            }else{
               $tto= $this->input->post('to_exp');
               $to = date("d/m/Y", strtotime($tto)); 
            }

            if($this->input->post('task_status')==''){
                $task_status ='';
            }else{
               $task_status= $this->input->post('task_status'); 
            }

            if($this->input->post('user_mobile')==''){
                $user_mobile ='';
            }else{
               $user_mobile= $this->input->post('user_mobile'); 
            }

            if($this->input->post('user_name')==''){
                $user_name ='';
            }else{
               $user_name = $this->input->post('user_name'); 
            }
                    
            $data_arr = array(
            'tfrom1'           =>  $from,
            'tto1'             =>  $to,
            'task_status1'    =>  $task_status,
            'user_mobile1'    =>  $user_mobile,
            'user_name1'      =>  $user_name
            );
        $this->session->set_userdata($data_arr);*/
        
        $data['title'] = 'Task';
        $data['recent_tasks'] = '';

        //$this->Task_Model->get_task_byid();
        //$data['recent_tasks'] = $this->Task_Model->get_task_level($aid);
        //$data['totalcount'] = $this->Task_Model->eventCount($aid);
        
        /*
        $data['totalcount'] = $this->Task_Model->eventCount($aid);
        $data['comment_details'] = $this->Task_Model->get_allcoment();
        $data['comment_details'] = $this->Task_Model->get_allcoment();
        $data['all_active'] = $this->enquiry_model->all_enquery();
        $data['all_mode_type'] = $this->Task_Model->all_mode_type();
        $data['org_name'] = $this->Task_Model->organisation_list();
        */
        $data['taskstatus_list'] = $this->Taskstatus_model->taskstatuslist();         
        $data['user_list'] = $this->User_model->read();
        $data['content'] = $this->load->view('task/tasks', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function get_update_task_content(){
        $id    =   $this->input->post('id');
        $data['taskstatus_list'] = $this->Taskstatus_model->taskstatuslist();                 
        $data['task']    =   $this->Task_Model->get_task($id);
        $data['all_branch'] = $this->Leads_Model->branch_select();
        $data['all_department'] = $this->Leads_Model->dept_select();
        $data['user_list'] = $this->User_model->read2();
        $content    = $this->load->view('task/update_task_modal_content',$data,true);
        echo $content;
    }

    public function get_calandar_feed($enq_id=0){
        //print_r($_POST);
        /*if(!empty($_POST['user_id'])){
        }   */
        $user_id = $this->input->post('user_id');
        $this->session->set_userdata('filter_user_id',$user_id);

        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $cal_feed    =   $this->Task_Model->get_task_calandar_feed($start,$end,$user_id,$enq_id);        
        //echo $this->db->last_query();
        $feed = array();
        
        foreach ($cal_feed as $task){
            $task_date1   =  date_create($task->task_date);
            $this->db->where('Enquery_id',$task->query_id);
            $enquiry_row   =    $this->db->get('enquiry')->row_array();            
            if(!empty($task_date1)){
                 $name = $enquiry_row['name_prefix'].''.$enquiry_row['name'].''.$enquiry_row['lastname'];
                 if ($name == '') {
                     $name = $task->mobile;
                     if (!$name) {
                        $name = 'NA';
                     }
                }
            if($task->task_status=='2'){
                $tcolr = '#1abc9c';
            }else{
                $tcolr = '#f85555';
            }
               $dt = date_format($task_date1,'Y-m-d'); 
               $feed[] = array(
                   'title' =>   $name,
                   'start' =>   $dt,
                   'backgroundColor' => $tcolr,
                   'url'    =>  '',
                   'borderColor'    => $tcolr
               );               
            }
        }

        echo json_encode($feed);

         /*echo '[{"title":"All Day Event","start":"2020-01-01"},{"title":"Long Event","start":"2020-01-07","end":"2020-01-10"},{"groupId":"999","title":"Repeating Event","start":"2020-01-09T16:00:00+00:00"},{"groupId":"999","title":"Repeating Event","start":"2020-01-16T16:00:00+00:00"},{"title":"Conference","start":"2020-01-15","end":"2020-01-17"},{"title":"Meeting","start":"2020-01-16T10:30:00+00:00","end":"2020-01-16T12:30:00+00:00"},{"title":"Lunch","start":"2020-01-16T12:00:00+00:00"},{"title":"Birthday Party","start":"2020-01-17T07:00:00+00:00"},{"url":"http:\/\/google.com\/","title":"Click for Google","start":"2020-01-28"},{"title":"Meeting","start":"2020-01-16T14:30:00+00:00"},{"title":"Happy Hour","start":"2020-01-16T17:30:00+00:00"},{"title":"Dinner","start":"2020-01-16T20:00:00+00:00"}]'; */
    }

     // enquiry datatable

    public function task_load(){
        $this->load->model('task_datatable_model');
        $list = $this->task_datatable_model->get_datatables();
        
        
        $data = array();
        $no = $_POST['start'];        
        $i = 1;        
        foreach ($list as $each) {        
            $no++;        
            $row = array();        


            if(!empty($each->task_date) && $each->task_date!='01-01-1970'){

              $d = strtotime($each->task_date);               
              $nd = date("Y/m/d",$d);               
              $nd = $each->task_date?$nd:'NA';                                 
              //$nt = date("H:i:s",$d);
            }else{
              $nd = 'NA';
              $nt = 'NA';
            }
            $row[] = $nd;
            $row[] = $each->task_time;
            $row[] = $each->subject;
            $row[] = $each->task_remark;
            $this->db->where('Enquery_id',$each->query_id);
            $enquiry_row   =    $this->db->get('enquiry')->row_array();
            if (!empty($enquiry_row)) {
              
              if ($enquiry_row['status'] == 1) {

                 $url = base_url().'enquiry/view/'.$enquiry_row['enquiry_id'];                  

              }else if ($enquiry_row['status'] == 2) {
                 
                 $url = base_url().'lead/lead_details/'.$enquiry_row['enquiry_id'];                  

              }else if ($enquiry_row['status'] == 3) {
                 
                 $url = base_url().'client/view/'.$enquiry_row['enquiry_id'].'/'.$enquiry_row['Enquery_id'];

              }else if ($enquiry_row['status'] == 4) {
                    $url = base_url().'refund/view/'.$enquiry_row['enquiry_id'].'/'.$enquiry_row['Enquery_id'];
              }else{
                  $url = 'javascript:void(0)';
                }              
            }else{
              $url = 'javascript:void(0)';
            }
            $name = $enquiry_row['name_prefix'].' '.$enquiry_row['name'].' '.$enquiry_row['lastname'];
            if(empty($name) || !isset($name) || $name=='  '){
                $name = 'NA';
            }
            $row[] = "<a href='".$url."'>".$name.'</a>';
            $row[] = $each->user_name;
                if (user_access(450)) {
                    $row[] = '##########';                    
                }else{
                    $row[] = $each->mobile;
                }

            

            $taskStatus = 'Pending';             
            
            $taskstatus_list = $this->Taskstatus_model->taskstatuslist(); 
            /*
            foreach($taskstatus_list as $val){
                if($each->task_status == $val->taskstatus_id){
                    $taskStatus = $val->taskstatus_name;
                    break;
                }
            }*/
            //$row[] =  $each->task_status?$each->task_status:$taskStatus;
            $tsksts =  $each->task_status?$each->task_status:$taskStatus;
            if($nd<date('Y/m/d') && $tsksts=='Pending'){
            $row[] = "<span style='background:#f85555;padding:5px;border-radius: 2px;color: #fff;'>".$tsksts."</span>";
            }else if($nd>date('Y/m/d') || $tsksts=='Complete'){
            $row[] = "<span style='background:#1abc9c;padding:5px;border-radius: 2px;color: #fff;'>".$tsksts."</span>";
            }else if($nd==date('Y/m/d') && $tsksts=='Pending'){
            $row[] = "<span style='background:#ff9f25;padding:5px;border-radius: 2px;color: #fff;'>".$tsksts."</span>";
            }
                $actions = '<a data-toggle="modal" type="button" title="Task Edit" data-target="#task_edit" onclick="get_modal_content('.$each->resp_id.')" ><i class="fa fa-edit btn btn-primary btn-sm"></i></a>';

                if(user_access(92)){ 
                   $actions .=  '<i class="fa fa-trash btn btn-danger btn-sm" title="Task Delete" onclick="delete_row('.$each->resp_id.')" ></i>';
                  
                }
                $row[] = $actions;                

                $data[] = $row;
                $i++;
            }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->task_datatable_model->count_all(),
            "recordsFiltered" => $this->task_datatable_model->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function tas_byid($aid = '') {
        $data['title'] = 'Task';
        //$data['tasks'] = $this->Task_Model->get_alltask($aid);
        $data['recent_tasks'] = $this->Task_Model->get_task_level($aid);
        //echo $this->db->last_query();
        //$data['comment_details'] = $this->Task_Model->get_allcoment();
        //$data['comment_details'] = $this->Task_Model->get_allcoment();
        //$data['all_active'] = $this->enquiry_model->created_byid($aid);
        //$data['all_mode_type'] = $this->Task_Model->all_mode_type();
        //$data['org_name'] = $this->Task_Model->organisation_list();
        //$data['user_list'] = $this->User_model->read();
        $data['taskstatus_list'] = $this->Taskstatus_model->taskstatuslist(); 
        $data['content'] = $this->load->view('task/task_list', $data);
    }


    public function search_filter_and_task() {

        $from = $this->input->post('from_exp')??'';
        $to= $this->input->post('to_exp')??'';
        $task_status = $this->input->post('task_status')??'';
        $user_mobile = $this->input->post('user_mobile')??'';
        $user_name = $this->input->post('user_name')??'';
        $details = ''; 

        $recent_tasks = $this->Task_Model->search_taskby_filter($from,$to,$task_status,$user_mobile,$user_name);

        $taskstatus_list = $this->Taskstatus_model->taskstatuslist(); 

        $details .= '<style>.paging_simple_numbers{text-align:center!important;}
            </style>
                    <table class="datatable1 table table-striped table-bordered"  cellspacing="0" width="100%">
                       <thead>
                          <tr>
                           <th>Date</th>
                           <th>Time</th>
                           <th>Task</th>
                           <th>Remark</th>
                           <th>Person Name</th>                           
                           <th>Created By</th>
                           <th>Mobile No </th>
                           <th>Task Status</th>                           
                           <th>Actions</th>                           
                          </tr>
                       </thead>
                       <tbody>
                          ';

        foreach ($recent_tasks as $task) {
            /*$d = date_create($task->upd_date);
            $nd = date_format($d, "Y/m/d");
            $nt = date_format($d, "H:i:s");*/
           
           /* $amt = explode(',', $task->km);
            $ttl = 0;
            for ($i = 0; $i < count($amt); $i++) {
                $ttl += $amt[$i];
            }*/
           
            $taskStatus = 'Pending'; 
          /*  foreach($taskstatus_list as $val){
                if($task->task_status == $val->taskstatus_id){
                    $taskStatus = $val->taskstatus_name;
                    break;
                }
            }*/
            $taskStatus = !empty($task->task_status)?$task->task_status:$taskStatus;
            $this->db->where('Enquery_id',$task->query_id);
            $enquiry_row   =    $this->db->get('enquiry')->row_array();
            $name = '';
            if (!empty($enquiry_row)) {
                if ($enquiry_row['status'] == 1) {
                    $url = base_url().'enquiry/view/'.$enquiry_row['enquiry_id'];
                }else if ($enquiry_row['status'] == 2) {
                    $url = base_url().'lead/lead_details/'.$enquiry_row['enquiry_id'];
                }else if ($enquiry_row['status'] == 3) {
                    $url = base_url().'client/view/'.$enquiry_row['enquiry_id'].'/'.$enquiry_row['Enquery_id'];
                }else if ($enquiry_row['status'] == 4) {
                    $url = base_url().'refund/view/'.$enquiry_row['enquiry_id'].'/'.$enquiry_row['Enquery_id'];
                }else{
                  $url = 'javascript:void(0)';
                }
                $name = $enquiry_row['name_prefix'].' '.$enquiry_row['name'].' '.$enquiry_row['lastname'];
            }else{
              
                  $url = 'javascript:void(0)';
              }            
            if(empty($name) || !isset($name) || $name=='  '){
                $name = 'NA';
            }
            if (user_access(450)) {
                $p = '##########';                    
            }else{
                $p = $task->mobile;
            }
              $details .= '
            <tr>
                <td>' . $task->task_date . '</td>
                <td>' . $task->task_time . '</td>
                <td>'. $task->subject. '</td>
                <td>'. $task->task_remark. '</td>
                <td><a href="'.$url.'">' . $name . '</a></td>
                <td>'.$task->user_name.'</td>
                <td>' . $p. '</td>
                <td>'.$taskStatus.'</td>
                <td><a data-toggle="modal" type="button" title="Task Edit" data-target="#task_edit" onclick="get_modal_content('.$task->resp_id.')" ><i class="fa fa-edit btn btn-primary btn-sm"></i></a>';

            if(user_access(92)){ 
               $details .=  '<i class="fa fa-trash btn btn-danger btn-sm" style="float:right;" onclick="delete_row('.$task->resp_id.')" title="Delete Task"></i>';
              
              }
              $details .= '</td>';

        }
        $details .= '</tbody></table><script> $(".datatable1").DataTable(); </script>';
        echo $details;
    }

    public function search_comment_and_task($date = '') {


        $details = '';
 
        $date = date_create($date);

        $date = date_format($date,'d-m-Y'); 

        $recent_tasks = $this->Task_Model->search_taskby_id($date);
     
        $taskstatus_list = $this->Taskstatus_model->taskstatuslist(); 

        $details .= '<style>.paging_simple_numbers{text-align:center!important;}
            </style>
                    <table class="datatable1 table table-striped table-bordered"  cellspacing="0" width="100%">
                       <thead>
                          <tr>
                           <th>Date</th>
                           <th>Time</th>
                           <th>Task</th>
                           <th>Remark</th>
                           <th>Person Name</th>                           
                           <th>Created By</th>
                           <th>Mobile No </th>
                           <th>Task Status</th>                           
                           <th>Actions</th>                           
                          </tr>
                       </thead>
                       <tbody>
                          ';

        foreach ($recent_tasks as $task) {
            /*$d = date_create($task->upd_date);
            $nd = date_format($d, "Y/m/d");
            $nt = date_format($d, "H:i:s");*/
           
           /* $amt = explode(',', $task->km);
            $ttl = 0;
            for ($i = 0; $i < count($amt); $i++) {
                $ttl += $amt[$i];
            }*/
           
            $taskStatus = 'Pending'; 
          /*  foreach($taskstatus_list as $val){
                if($task->task_status == $val->taskstatus_id){
                    $taskStatus = $val->taskstatus_name;
                    break;
                }
            }*/
            $taskStatus = !empty($task->task_status)?$task->task_status:$taskStatus;
            $this->db->where('Enquery_id',$task->query_id);
            $enquiry_row   =    $this->db->get('enquiry')->row_array();
            $name = '';
            if (!empty($enquiry_row)) {
                if ($enquiry_row['status'] == 1) {
                    $url = base_url().'enquiry/view/'.$enquiry_row['enquiry_id'];
                }else if ($enquiry_row['status'] == 2) {
                    $url = base_url().'lead/lead_details/'.$enquiry_row['enquiry_id'];
                }else if ($enquiry_row['status'] == 3) {
                    $url = base_url().'client/view/'.$enquiry_row['enquiry_id'].'/'.$enquiry_row['Enquery_id'];
                }else if ($enquiry_row['status'] == 4) {
                    $url = base_url().'refund/view/'.$enquiry_row['enquiry_id'].'/'.$enquiry_row['Enquery_id'];
                }else{
                  $url = 'javascript:void(0)';
                }
                $name = $enquiry_row['name_prefix'].' '.$enquiry_row['name'].' '.$enquiry_row['lastname'];
            }else{
              
                  $url = 'javascript:void(0)';
              }            
            if(empty($name) || !isset($name) || $name=='  '){
                $name = 'NA';
            }
            if (user_access(450)) {
                $p = '##########';                    
            }else{
                $p = $task->mobile;
            }
              $details .= '
            <tr>
                <td>' . $task->task_date . '</td>
                <td>' . $task->task_time . '</td>
                <td>'. $task->subject. '</td>
                <td>'. $task->task_remark. '</td>
                <td><a href="'.$url.'">' . $name . '</a></td>
                <td>'.$task->user_name.'</td>
                <td>' . $p. '</td>
                <td>'.$taskStatus.'</td>
                <td><a data-toggle="modal" type="button" title="Task Edit" data-target="#task_edit" onclick="get_modal_content('.$task->resp_id.')" ><i class="fa fa-edit btn btn-primary btn-sm"></i></a>';

            if(user_access(92)){ 
               $details .=  '<i class="fa fa-trash btn btn-danger btn-sm" style="float:right;" onclick="delete_row('.$task->resp_id.')" title="Delete Task"></i>';
              
              }
              $details .= '</td>';

        }
        $details .= '</tbody></table><script> $(".datatable1").DataTable(); </script>';
        echo $details;
    }
    
    
   /*     public function enquiry_response_updatetask() {            
            $resp_id = $this->input->post('resp_id');
            $task_type = $this->input->post('task_type');
            $meeting_date = $this->input->post('meeting_date');
            $contact_person = $this->input->post('contact_person');
            $mobileno = $this->input->post('mobileno');
            $email = $this->input->post('email');
            $designation = $this->input->post('designation');
            $task_remark = trim($this->input->post('conversation'));
            $subject = $this->input->post('subject');
            $task_status = $this->input->post('task_status');
            $task_time = $this->input->post('task_time');
            $org_name = $this->input->post('org_name');           
            $cdate2 = str_replace('/', '-', $meeting_date);

            //$adt = date("d-m-Y h:i:s a");           
            //$this->db->set('upd_date', $adt);
            $this->db->set('task_date', $cdate2);
            $this->db->set('task_time', $task_time);
            $this->db->set('contact_person', $contact_person);
            $this->db->set('mobile', $mobileno);
            $this->db->set('task_status', $task_status);
            $this->db->set('subject', $subject);
            $this->db->set('org_name', $org_name);            
            $this->db->set('email', $email);
            $this->db->set('designation', $designation);
            $this->db->set('conversation', $task_remark);
            $this->db->set('task_type', $task_type);
            $this->db->where('resp_id', $resp_id);
            $this->db->set('create_by', $this->session->user_id);
            $this->db->update('query_response');
            $this->session->set_flashdata('message', 'Task Updated Successfully');            
            redirect('task');
    }
    
    public function enquiry_response_task() {
        if (!empty($_POST)) {
            
            $ld_updt_by = $this->session->userdata('user_id');
            
            $lead_id = $this->input->post('enq_code');
            
            $task_type = $this->input->post('task_type');
            
            $meeting_date = $this->input->post('meeting_date');

            $contact_person = $this->input->post('contact_person');

            $mobileno = $this->input->post('mobileno');
            
            $email = $this->input->post('email');
            
            $designation = $this->input->post('designation');
            
            $conversation = trim($this->input->post('conversation'));
            
            $subject = $this->input->post('subject');
            
            $task_status = $this->input->post('task_status');
            if (!empty($this->enquiry_model->enquiry_by_code($lead_id))) {
                $org_name = $this->enquiry_model->enquiry_by_code($lead_id)->org_name;
            } else {
                $org_name = '';
            }
            $cdate2 = str_replace('/', '-', $meeting_date);
            $adt = date("d-m-Y h:i:s a");
            if (!empty($this->input->post('subject'))) {
                $this->db->set('query_id', $this->input->post('subject'));
            }
            if (!empty($this->input->post('billabled'))) {
                $this->db->set('bilable', $this->input->post('billabled'));
                $this->db->set('distance_from', implode(',', $this->input->post('from[]')));
                $this->db->set('distance_to', implode(',', $this->input->post('to[]')));
                $this->db->set('mode', implode(',', $this->input->post('mode[]')));
                $this->db->set('km', implode(',', $this->input->post('km[]')));
            }
            $this->db->set('query_id', $lead_id);
            $this->db->set('subject', $subject);
            $this->db->set('upd_date', $adt);
            $this->db->set('nxt_date', $cdate2);
            $this->db->set('contact_person', $contact_person);
            $this->db->set('mobile', $mobileno);
            $this->db->set('email', $email);
            $this->db->set('designation', $designation);
            $this->db->set('org_name', $org_name);
            $this->db->set('conversation', $conversation);
            $this->db->set('task_type', $task_type);
            $this->db->set('task_status', $task_status);
            $this->db->set('create_by', $this->session->user_id);
            $this->db->insert('query_response');
            $this->session->set_flashdata('message', 'Task Added Successfully');
            redirect($this->agent->referrer());
        } else {
            redirect('task');
        }
    }*/

    public function delete_task_row(){
        if (user_access('92') == true) {            
            $id    =   $this->input->post('id');
            $this->db->where('resp_id',$id);
            if($this->db->delete('query_response')){
                echo json_encode(array('status'=>true,'msg'=>display('task_delete_msg')));
            }else{
                echo json_encode(array('status'=>false,'msg'=>display('something_went_wrong')));            
            }
        }else{
            echo json_encode(array('status'=>false,'msg'=>display('access_denied')));            
        }                      
    }

}