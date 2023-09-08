<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Forecasting extends CI_Controller {
    public function __construct() {
        parent::__construct();       
        $this->load->model(
                array('User_model','Forcasting_model')
                );
        if (empty($this->session->user_id)) {
            redirect('login');
        }
    }
    public function target() {        
        $data['title'] = 'Set Target';
		$data['user_list'] = $this->User_model->read();
		$data['product_list'] = $this->Forcasting_model->get_product();
        $data['content'] = $this->load->view('forecasting/forecasting_target', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
	
	public function target_view() {        
        $data['title'] = 'Target View';
		$data['user_list'] = $this->User_model->read();
		$data['product_list'] = $this->Forcasting_model->get_product();
        $data['content'] = $this->load->view('forecasting/forecasting_view', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
	
	public function user_target() {        
        $data['title'] = 'User Target Forecasting';
		$data['user_list'] = $this->User_model->user_read();
		$data['trgt_list'] = $this->Forcasting_model->get_trgt();
        $data['content'] = $this->load->view('forecasting/user_forcasting', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
	public function get_user($id,$pid){
    	    $this->db->where('pk_i_admin_id',$id);
    	    $res=$this->db->get('tbl_admin');
    	    $q=$res->result();
    	    if(!empty($q)){
    	    foreach($q as $value){
    	        echo '<input type="hidden" value="'.$value->pk_i_admin_id.'" name="user_id">';
				echo '<input type="hidden" value="'.$value->companey_id.'" name="comp_id">';
				echo '<input type="hidden" value="'.$pid.'" name="pro_id">';
    	       
    	    }    	    
    	    }
	    }
		
		public function get_trgt_datass($id,$pid){
    	    $this->db->where('u_id',$id);
			$this->db->where('p_id',$pid);
    	    $res=$this->db->get('tbl_target');
    	    $q=$res->result();
    	    if(!empty($q)){
    	    foreach($q as $value){
				echo '<input type="hidden" value="'.$pid.'" name="pro_id">';
    	        echo '<input type="hidden" value="'.$value->u_id.'" name="user_id">';
				echo '<input type="hidden" value="'.$value->comp_id.'" name="comp_id">';
		echo '<div class="form-group col-md-3"><label>January</label><input type="text" class="form-control" id="jan" name="jan" value="'.$value->jan.'"></div>';
		echo '<div class="form-group col-md-3"><label>February</label><input type="text" class="form-control" id="feb" name="feb" value="'.$value->feb.'"></div>';
		echo '<div class="form-group col-md-3"><label>March</label><input type="text" class="form-control" id="mar" name="mar" value="'.$value->mar.'"></div>';			
		echo '<div class="form-group col-md-3"><label>April</label><input type="text" class="form-control" id="apr" name="apr" value="'.$value->apr.'"></div>';
		echo '<div class="form-group col-md-3"><label>May</label><input type="text" class="form-control" id="may" name="may" value="'.$value->may.'"></div>';
		echo '<div class="form-group col-md-3"><label>June</label><input type="text" class="form-control" id="june" name="june" value="'.$value->jun.'"></div>';			
		echo '<div class="form-group col-md-3"><label>July</label><input type="text" class="form-control" id="july" name="july" value="'.$value->jly.'"></div>';
		echo '<div class="form-group col-md-3"><label>August</label><input type="text" class="form-control" id="aug" name="aug" value="'.$value->aug.'"></div>';
		echo '<div class="form-group col-md-3"><label>September</label><input type="text" class="form-control" id="sep" name="sep" value="'.$value->sep.'"></div>';			
		echo '<div class="form-group col-md-3"><label>October</label><input type="text" class="form-control" id="oct" name="oct" value="'.$value->oct.'"></div>';
		echo '<div class="form-group col-md-3"><label>November</label><input type="text" id="nov" class="form-control" name="nov" value="'.$value->nov.'"></div>';
		echo '<div class="form-group col-md-3"><label>December</label><input type="text" class="form-control" id="dec" name="dec" value="'.$value->dece.'"></div>';    	       
    	    }    	    
    	    }
	    }
		
		public function save_target() {
            $this->form_validation->set_rules('jan', 'January', '');
			$this->form_validation->set_rules('feb', 'Febuary', '');
			$this->form_validation->set_rules('mar', 'March', '');
			$this->form_validation->set_rules('apr', 'Aprial', '');
			$this->form_validation->set_rules('may', 'May', '');
			$this->form_validation->set_rules('june', 'June', '');
			$this->form_validation->set_rules('july', 'July', '');
			$this->form_validation->set_rules('aug', 'August', '');
			$this->form_validation->set_rules('sep', 'September', '');
			$this->form_validation->set_rules('oct', 'October', '');
			$this->form_validation->set_rules('nov', 'November', '');
			$this->form_validation->set_rules('dec', 'December', '');
					
		$data = array(
			'comp_id' => $this->input->post('comp_id', true),
            'u_id' => $this->input->post('user_id', true),
			'p_id' => $this->input->post('pro_id', true),
            'jan' => $this->input->post('jan', true),
			'feb' => $this->input->post('feb', true),
			'mar' => $this->input->post('mar', true),
			'apr' => $this->input->post('apr', true),
			'may' => $this->input->post('may', true),
			'jun' => $this->input->post('june', true),
			'jly' => $this->input->post('july', true),
			'aug' => $this->input->post('aug', true),
			'sep' => $this->input->post('sep', true),
			'oct' => $this->input->post('oct', true),
			'nov' => $this->input->post('nov', true),
			'dece' => $this->input->post('dec', true),
            'created_by' => $this->session->userdata('user_id')
        );
                if ($this->Forcasting_model->create($data)) {
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('forecasting/target');          
    }
	
	public function get_trgt_data($id,$pid){
    	    $this->db->where('u_id',$id);
    	    $res=$this->db->get('tbl_target');
    	    $q=$res->result();
    	    if(!empty($q)){
    	    foreach($q as $value){
				echo '<input type="hidden" value="'.$pid.'" name="pro_id">';
    	        echo '<input type="hidden" value="'.$value->u_id.'" name="user_id">';
				echo '<input type="hidden" value="'.$value->comp_id.'" name="comp_id">';
		echo '<div class="form-group col-md-3"><label>January</label><input type="text" class="form-control" id="jan" name="jan" value="'.$value->jan.'"></div>';
		echo '<div class="form-group col-md-3"><label>February</label><input type="text" class="form-control" id="feb" name="feb" value="'.$value->feb.'"></div>';
		echo '<div class="form-group col-md-3"><label>March</label><input type="text" class="form-control" id="mar" name="mar" value="'.$value->mar.'"></div>';			
		echo '<div class="form-group col-md-3"><label>April</label><input type="text" class="form-control" id="apr" name="apr" value="'.$value->apr.'"></div>';
		echo '<div class="form-group col-md-3"><label>May</label><input type="text" class="form-control" id="may" name="may" value="'.$value->may.'"></div>';
		echo '<div class="form-group col-md-3"><label>June</label><input type="text" class="form-control" id="june" name="june" value="'.$value->jun.'"></div>';			
		echo '<div class="form-group col-md-3"><label>July</label><input type="text" class="form-control" id="july" name="july" value="'.$value->jly.'"></div>';
		echo '<div class="form-group col-md-3"><label>August</label><input type="text" class="form-control" id="aug" name="aug" value="'.$value->aug.'"></div>';
		echo '<div class="form-group col-md-3"><label>September</label><input type="text" class="form-control" id="sep" name="sep" value="'.$value->sep.'"></div>';			
		echo '<div class="form-group col-md-3"><label>October</label><input type="text" class="form-control" id="oct" name="oct" value="'.$value->oct.'"></div>';
		echo '<div class="form-group col-md-3"><label>November</label><input type="text" id="nov" class="form-control" name="nov" value="'.$value->nov.'"></div>';
		echo '<div class="form-group col-md-3"><label>December</label><input type="text" class="form-control" id="dec" name="dec" value="'.$value->dece.'"></div>';    	       
    	    }    	    
    	    }
	    }
		
		public function save_forcast($uid,$pid,$cid,$val_forcast,$crrmonth) {
			$val_month=base64_decode($crrmonth);
					if($val_month=='f_jan'){$jan=$val_forcast;}else{$jan='';}
					if($val_month=='f_feb'){$feb=$val_forcast;}else{$feb='';}
					if($val_month=='f_mar'){$mar=$val_forcast;}else{$mar='';}
					if($val_month=='f_apr'){$apr=$val_forcast;}else{$apr='';}
					if($val_month=='f_may'){$may=$val_forcast;}else{$may='';}
					if($val_month=='f_jun'){$jun=$val_forcast;}else{$jun='';}
					if($val_month=='f_jly'){$jly=$val_forcast;}else{$jly='';}
					if($val_month=='f_aug'){$aug=$val_forcast;}else{$aug='';}
					if($val_month=='f_sep'){$sep=$val_forcast;}else{$sep='';}
					if($val_month=='f_oct'){$oct=$val_forcast;}else{$oct='';}
					if($val_month=='f_nov'){$nov=$val_forcast;}else{$nov='';}
					if($val_month=='f_dece'){$dece=$val_forcast;}else{$dece='';}
		$data = array(
			'comp_id' => $cid,
            'fu_id' => $uid,
			'fp_id' => $pid,
            'f_jan' => $jan,
			'f_feb' => $feb,
			'f_mar' => $mar,
			'f_apr' => $apr,
			'f_may' => $may,
			'f_jun' => $jun,
			'f_jly' => $jly,
			'f_aug' => $aug,
			'f_sep' => $sep,
			'f_oct' => $oct,
			'f_nov' => $nov,
			'f_dece' => $dece,
            'created_by' => $this->session->userdata('user_id')
        );
                if ($this->Forcasting_model->create_forcast($data)) {
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('forecasting/get_user_forecast/'.$uid);          
    }
	
	public function update_forcast($uid,$pid,$cid,$val_forcast,$crrmonth) {
		$this->db->select('*');
    	    $this->db->from('tbl_forecast');
			$this->db->where('fu_id',$uid);
			$this->db->where('fp_id',$pid);
			$this->db->where('comp_id',$cid);
    	    $q=$this->db->get()->result();
    	    if(!empty($q)){
    	    foreach($q as $value){
			$val_month=base64_decode($crrmonth);
					if($val_month=='f_jan'){$jan=$val_forcast;}else{$jan=$value->f_jan;}
					if($val_month=='f_feb'){$feb=$val_forcast;}else{$feb=$value->f_feb;}
					if($val_month=='f_mar'){$mar=$val_forcast;}else{$mar=$value->f_mar;}
					if($val_month=='f_apr'){$apr=$val_forcast;}else{$apr=$value->f_apr;}
					if($val_month=='f_may'){$may=$val_forcast;}else{$may=$value->f_may;}
					if($val_month=='f_jun'){$jun=$val_forcast;}else{$jun=$value->f_jun;}
					if($val_month=='f_jly'){$jly=$val_forcast;}else{$jly=$value->f_jly;}
					if($val_month=='f_aug'){$aug=$val_forcast;}else{$aug=$value->f_aug;}
					if($val_month=='f_sep'){$sep=$val_forcast;}else{$sep=$value->f_sep;}
					if($val_month=='f_oct'){$oct=$val_forcast;}else{$oct=$value->f_oct;}
					if($val_month=='f_nov'){$nov=$val_forcast;}else{$nov=$value->f_nov;}
					if($val_month=='f_dece'){$dece=$val_forcast;}else{$dece=$value->f_dece;}
		$data = array(
			'comp_id' => $cid,
            'fu_id' => $uid,
			'fp_id' => $pid,
            'f_jan' => $jan,
			'f_feb' => $feb,
			'f_mar' => $mar,
			'f_apr' => $apr,
			'f_may' => $may,
			'f_jun' => $jun,
			'f_jly' => $jly,
			'f_aug' => $aug,
			'f_sep' => $sep,
			'f_oct' => $oct,
			'f_nov' => $nov,
			'f_dece' => $dece,
            'created_by' => $this->session->userdata('user_id')
        );
                if ($this->Forcasting_model->update_forcast($data,$uid,$pid,$cid)) {
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                redirect('forecasting/get_user_forecast/'.$uid);    
			}
		}			
    }
	
	public function update_target() {
            $this->form_validation->set_rules('jan', 'January', '');
			$this->form_validation->set_rules('feb', 'Febuary', '');
			$this->form_validation->set_rules('mar', 'March', '');
			$this->form_validation->set_rules('apr', 'Aprial', '');
			$this->form_validation->set_rules('may', 'May', '');
			$this->form_validation->set_rules('june', 'June', '');
			$this->form_validation->set_rules('july', 'July', '');
			$this->form_validation->set_rules('aug', 'August', '');
			$this->form_validation->set_rules('sep', 'September', '');
			$this->form_validation->set_rules('oct', 'October', '');
			$this->form_validation->set_rules('nov', 'November', '');
			$this->form_validation->set_rules('dec', 'December', '');
				$id=$this->input->post('user_id', true);
                $pid=$this->input->post('pro_id', true);				
		$data = array(
			'comp_id' => $this->input->post('comp_id', true),
            'u_id' => $this->input->post('user_id', true),
			'p_id' => $this->input->post('pro_id', true),
            'jan' => $this->input->post('jan', true),
			'feb' => $this->input->post('feb', true),
			'mar' => $this->input->post('mar', true),
			'apr' => $this->input->post('apr', true),
			'may' => $this->input->post('may', true),
			'jun' => $this->input->post('june', true),
			'jly' => $this->input->post('july', true),
			'aug' => $this->input->post('aug', true),
			'sep' => $this->input->post('sep', true),
			'oct' => $this->input->post('oct', true),
			'nov' => $this->input->post('nov', true),
			'dece' => $this->input->post('dec', true),
            'created_by' => $this->session->userdata('user_id')
        );
                if ($this->Forcasting_model->update($data,$id,$pid)) {
					echo ($this->db->last_query());
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                    redirect('forecasting/target');          
    }
	
    public function myforecasting(){
        $data['title'] = 'Forecasting';
        $data['user_list'] = $this->User_model->read();
        $data['content'] = $this->load->view('forecasting/forecasting', $data, true);
        $this->load->view('layout/main_wrapper', $data);   
    }
	
	public function get_user_forecast($id){
			$this->db->select('*');
    	    $this->db->from('tbl_target');
			$this->db->where('u_id',$id);
			$this->db->join('tbl_forecast', 'tbl_forecast.fu_id=tbl_target.u_id AND tbl_forecast.fp_id=tbl_target.p_id', 'left');
			$this->db->join('tbl_product_country', 'tbl_product_country.id=tbl_target.p_id', 'left');
    	    $q=$this->db->get()->result();
    	    if(!empty($q)){
				$i=0;
    	    foreach($q as $value){
				$n=$i++;
				$month=date('m');
				if($month=='01'){
					$target='';
					$forecast='';
					$crr_target=$value->jan;
					$ins_target=$value->f_jan;
					$crr_month='f_jan';
				}else if($month=='02'){
					$target=$value->jan;
					$crr_target=$value->feb;
					$crr_month='f_feb';
					if(!empty($value->f_jan)){$f_target=$value->f_jan;}else{$f_target='';}
					if(!empty($value->f_feb)){$ins_target=$value->f_feb;}else{$ins_target='';}
				}else if($month=='03'){
					$target=$value->jan+$value->feb;
					$crr_target=$value->mar;
					$crr_month='f_mar';
					if(!empty($value->f_jan)){$f_target=$value->f_jan+$value->f_feb;}else{$f_target='';}
					if(!empty($value->f_mar)){$ins_target=$value->f_mar;}else{$ins_target='';}
				}else if($month=='04'){
					$target=$value->jan+$value->feb+$value->mar;
					$crr_target=$value->apr;
					$crr_month='f_apr';
					if(!empty($value->f_jan)){$f_target=$value->f_jan+$value->f_feb+$value->f_mar;}else{$f_target='';}
					if(!empty($value->f_apr)){$ins_target=$value->f_apr;}else{$ins_target='';}
				}else if($month=='05'){
					$target=$value->jan+$value->feb+$value->mar+$value->apr;
					$crr_target=$value->may;
					$crr_month='f_may';
					if(!empty($value->f_jan)){$f_target=$value->f_jan+$value->f_feb+$value->f_mar+$value->f_apr;}else{$f_target='';}
					if(!empty($value->f_may)){$ins_target=$value->f_may;}else{$ins_target='';}
				}else if($month=='06'){
					$target=$value->jan+$value->feb+$value->mar+$value->apr+$value->may;
					$crr_target=$value->jun;
					$crr_month='f_jun';
					if(!empty($value->f_jan)){$f_target=$value->f_jan+$value->f_feb+$value->f_mar+$value->f_apr+$value->f_may;}else{$f_target='';}
					if(!empty($value->f_jun)){$ins_target=$value->f_jun;}else{$ins_target='';}
				}else if($month=='07'){
					$target=$value->jan+$value->feb+$value->mar+$value->apr+$value->may+$value->jun;
					$crr_target=$value->jly;
					$crr_month='f_jly';
					if(!empty($value->f_jan)){$f_target=$value->f_jan+$value->f_feb+$value->f_mar+$value->f_apr+$value->f_may+$value->f_jun;}else{$f_target='';}
					if(!empty($value->f_jly)){$ins_target=$value->f_jly;}else{$ins_target='';}
				}else if($month=='08'){
					$target=$value->jan+$value->feb+$value->mar+$value->apr+$value->may+$value->jun+$value->jly;
					$crr_target=$value->aug;
					$crr_month='f_aug';
					if(!empty($value->f_jan)){$f_target=$value->f_jan+$value->f_feb+$value->f_mar+$value->f_apr+$value->f_may+$value->f_jun+$value->f_jly;}else{$f_target='';}
					if(!empty($value->f_aug)){$ins_target=$value->f_aug;}else{$ins_target='';}
				}else if($month=='09'){
					$target=$value->jan+$value->feb+$value->mar+$value->apr+$value->may+$value->jun+$value->jly+$value->aug;
					$crr_target=$value->sep;
					$crr_month='f_sep';
					if(!empty($value->f_jan)){$f_target=$value->f_jan+$value->f_feb+$value->f_mar+$value->f_apr+$value->f_may+$value->f_jun+$value->f_jly+$value->f_aug;}else{$f_target='';}
					if(!empty($value->f_sep)){$ins_target=$value->f_sep;}else{$ins_target='';}
				}else if($month=='10'){
					$target=$value->jan+$value->feb+$value->mar+$value->apr+$value->may+$value->jun+$value->jly+$value->aug+$value->sep;
					$crr_target=$value->oct;
					$crr_month='f_oct';
					if(!empty($value->f_jan)){$f_target=$value->f_jan+$value->f_feb+$value->f_mar+$value->f_apr+$value->f_may+$value->f_jun+$value->f_jly+$value->f_aug+$value->f_sep;}else{$f_target='';}
					if(!empty($value->f_oct)){$ins_target=$value->f_oct;}else{$ins_target='';}
				}else if($month=='11'){
					$target=$value->jan+$value->feb+$value->mar+$value->apr+$value->may+$value->jun+$value->jly+$value->aug+$value->sep+$value->oct;
					$crr_target=$value->nov;
					$crr_month='f_nov';
					if(!empty($value->f_jan)){$f_target=$value->f_jan+$value->f_feb+$value->f_mar+$value->f_apr+$value->f_may+$value->f_jun+$value->f_jly+$value->f_aug+$value->f_sep+$value->f_oct;}else{$f_target='';}
					if(!empty($value->f_nov)){$ins_target=$value->f_nov;}else{$ins_target='';}
				}else if($month=='12'){
					$target=$value->jan+$value->feb+$value->mar+$value->apr+$value->may+$value->jun+$value->jly+$value->aug+$value->sep+$value->oct+$value->nov;
					$crr_target=$value->dece;
					$crr_month='f_dece';
					if(!empty($value->f_jan)){$f_target=$value->f_jan+$value->f_feb+$value->f_mar+$value->f_apr+$value->f_may+$value->f_jun+$value->f_jly+$value->f_aug+$value->f_sep+$value->f_oct+$value->f_nov;}else{$f_target='';}
					if(!empty($value->f_dece)){$ins_target=$value->f_dece;}else{$ins_target='';}
				}
				
				      echo '<tr>';
					  echo '<td>'.$value->country_name.'</td>';
				      echo '<td><div class="form-group col-md-12"><input type="text" class="form-control" id="target" name="target" value="'.$target.'" readonly></div></td>';
                      echo '<td><div class="form-group col-md-12"><input type="text" class="form-control" id="forecast" name="forecast" value="'.$f_target.'" readonly></div></td>';
                      echo '<td><div class="form-group col-md-12"><input type="text" class="form-control" id="cmtarget" name="cmtarget" value="'.$crr_target.'" readonly></div></td>';
                      echo '<td><div class="form-group col-md-12"><input type="text" class="form-control" id="cmforecast'.$n.'" name="cmforecast" value="'.$ins_target.'"></div></td>';
					 $test= base64_encode($crr_month);
					 if(empty($ins_target)){
                      echo '<td><button class="btn btn-primary" onclick="ins_forcast('.$value->u_id.','.$value->p_id.',`'.$n.'`,'.$this->session->companey_id.',`'.$test.'`)"><i class="fa fa-floppy-o"></i></button></td>';
					 }else{
					  echo '<td><button class="btn btn-success"  onclick="update_forcast('.$value->u_id.','.$value->p_id.',`'.$n.'`,'.$this->session->companey_id.',`'.$test.'`)"><i class="fa fa-floppy-o"></i></button></td>'; 
					 }
                      echo '</tr>';					 
			}					 
    	    }
	    }

/************************************************forecast view**********************************************/
		
		public function get_all_forecast($id){
			$this->db->select('*');
    	    $this->db->from('tbl_target');
			$this->db->where('u_id',$id);
			$this->db->join('tbl_forecast', 'tbl_forecast.fu_id=tbl_target.u_id AND tbl_forecast.fp_id=tbl_target.p_id', 'left');
			$this->db->join('tbl_product_country', 'tbl_product_country.id=tbl_target.p_id', 'left');
    	    $q=$this->db->get()->result();
    	    if(!empty($q)){
    	    foreach($q as $value){
		              echo '<tr>';
                      echo '<td colspan="2">'.$value->country_name.'</td>';				  
				      echo '<td>'.$value->jan.'</td>';
                      echo '<td>'.$value->f_jan.'</td>';
					  echo '<td>'.$value->feb.'</td>';
                      echo '<td>'.$value->f_feb.'</td>';
					  echo '<td>'.$value->mar.'</td>';
                      echo '<td>'.$value->f_mar.'</td>';
					  echo '<td>'.$value->apr.'</td>';
                      echo '<td>'.$value->f_apr.'</td>';
					  echo '<td>'.$value->may.'</td>';
                      echo '<td>'.$value->f_may.'</td>';
					  echo '<td>'.$value->jun.'</td>';
                      echo '<td>'.$value->f_jun.'</td>';
					  echo '<td>'.$value->jly.'</td>';
                      echo '<td>'.$value->f_jly.'</td>';
					  echo '<td>'.$value->aug.'</td>';
                      echo '<td>'.$value->f_aug.'</td>';
					  echo '<td>'.$value->sep.'</td>';
                      echo '<td>'.$value->f_sep.'</td>';
					  echo '<td>'.$value->oct.'</td>';
                      echo '<td>'.$value->f_oct.'</td>';
					  echo '<td>'.$value->nov.'</td>';
                      echo '<td>'.$value->f_nov.'</td>';
					  echo '<td>'.$value->dece.'</td>';
                      echo '<td>'.$value->f_dece.'</td>';
                      echo '</tr>';
				
			}         					  
    	    }
	    }
/************************************************forecast view End**********************************************/
		
		public function get_product_User($id){
			$this->db->where('companey_id',$this->session->companey_id);
			$res1=$this->db->get('tbl_admin');
			$q1=$res1->result();
			if(!empty($q1)){
			$mypro = array();
    	    foreach($q1 as $value){
			$mypro = explode(',',$value->products);
			if(in_array($id, $mypro)){
				$this->db->where('comp_id',$this->session->companey_id);
	            $this->db->where('p_id',$id);
				$res2=$this->db->get('tbl_target');
			    $trgt_list=$res2->result();
				$myAppliedtrgt = array();
if(!empty($trgt_list)){
    foreach($trgt_list as $trdata){
        $myAppliedtr[] = $trdata->u_id;
    }
}

			               echo '<tr>';
						   echo '<td>'.$value->s_display_name.' '.$value->last_name.'</td>';
						   foreach ($trgt_list as $key => $tar) { if($value->pk_i_admin_id==$tar->u_id){ if($tar->jan!=''){echo '<td>'.$tar->jan.'</td>';}else{echo '<td></td>';} } }
                           foreach ($trgt_list as $key => $tar) { if($value->pk_i_admin_id==$tar->u_id){ if($tar->feb!=''){echo '<td>'.$tar->feb.'</td>';}else{echo '<td></td>';} } }
                           foreach ($trgt_list as $key => $tar) { if($value->pk_i_admin_id==$tar->u_id){ if($tar->mar!=''){echo '<td>'.$tar->mar.'</td>';}else{echo '<td></td>';} } }
                           foreach ($trgt_list as $key => $tar) { if($value->pk_i_admin_id==$tar->u_id){ if($tar->apr!=''){echo '<td>'.$tar->apr.'</td>';}else{echo '<td></td>';} } }
                           foreach ($trgt_list as $key => $tar) { if($value->pk_i_admin_id==$tar->u_id){ if($tar->may!=''){echo '<td>'.$tar->may.'</td>';}else{echo '<td></td>';} } }
                           foreach ($trgt_list as $key => $tar) { if($value->pk_i_admin_id==$tar->u_id){ if($tar->jun!=''){echo '<td>'.$tar->jun.'</td>';}else{echo '<td></td>';} } }
                           foreach ($trgt_list as $key => $tar) { if($value->pk_i_admin_id==$tar->u_id){ if($tar->jly!=''){echo '<td>'.$tar->jly.'</td>';}else{echo '<td></td>';} } }
                           foreach ($trgt_list as $key => $tar) { if($value->pk_i_admin_id==$tar->u_id){ if($tar->aug!=''){echo '<td>'.$tar->aug.'</td>';}else{echo '<td></td>';} } }
                           foreach ($trgt_list as $key => $tar) { if($value->pk_i_admin_id==$tar->u_id){ if($tar->sep!=''){echo '<td>'.$tar->sep.'</td>';}else{echo '<td></td>';} } }
                           foreach ($trgt_list as $key => $tar) { if($value->pk_i_admin_id==$tar->u_id){ if($tar->oct!=''){echo '<td>'.$tar->oct.'</td>';}else{echo '<td></td>';} } }
                           foreach ($trgt_list as $key => $tar) { if($value->pk_i_admin_id==$tar->u_id){ if($tar->nov!=''){echo '<td>'.$tar->nov.'</td>';}else{echo '<td></td>';} } }
                           foreach ($trgt_list as $key => $tar) { if($value->pk_i_admin_id==$tar->u_id){ if($tar->dece!=''){echo '<td>'.$tar->dece.'</td>';}else{echo '<td></td>';} } }
						   foreach ($trgt_list as $key => $tar) { if($value->pk_i_admin_id==$tar->u_id){ if($tar->jan!=''){echo '<td style="font-weight:900;">'.$total=$tar->jan+$tar->feb+$tar->mar+$tar->apr+$tar->may+$tar->jun+$tar->jly+$tar->aug+$tar->sep+$tar->oct+$tar->nov+$tar->dece.'</td>';}else{echo '<td></td>';} } }
                            if(in_array($value->pk_i_admin_id, $myAppliedtr)){
							   echo '<td><a class="btn btn-primary"  data-toggle="modal" type="button" title="Add Target" data-target="#updatetarget" data-toggle="modal" onclick="get_trgt_data('.$value->pk_i_admin_id.','.$id.')"><i class="fa fa-pencil"></i></a></td>';
							   }else{
							   echo '<td><a class="btn btn-success"  data-toggle="modal" type="button" title="Add Target" data-target="#addtarget" data-toggle="modal" onclick="getuid('.$value->pk_i_admin_id.','.$id.')"><i class="fa fa-plus"></i></a></td>';}
						   
						   echo '</tr>';


			
    }
			}
	$this->db->where('comp_id',$this->session->companey_id);
	$this->db->where('p_id',$id);
	$res2=$this->db->get('tbl_target');
	$trgt_list=$res2->result();
	                         echo '<tr>';
                             echo '<td>Total</td>';
							 foreach ($trgt_list as $key => $tar) {  $total_jan += $tar->jan; } echo '<td style="font-weight:900;">'.$total_jan.'</td>';
							 foreach ($trgt_list as $key => $tar) {  $total_feb += $tar->feb; } echo '<td style="font-weight:900;">'.$total_feb.'</td>';
							 foreach ($trgt_list as $key => $tar) {  $total_mar += $tar->mar; } echo '<td style="font-weight:900;">'.$total_mar.'</td>';
							 foreach ($trgt_list as $key => $tar) {  $total_apr += $tar->apr; } echo '<td style="font-weight:900;">'.$total_apr.'</td>';
							 foreach ($trgt_list as $key => $tar) {  $total_may += $tar->may; } echo '<td style="font-weight:900;">'.$total_may.'</td>';
							 foreach ($trgt_list as $key => $tar) {  $total_jun += $tar->jun; } echo '<td style="font-weight:900;">'.$total_jun.'</td>';
							 foreach ($trgt_list as $key => $tar) {  $total_jly += $tar->jly; } echo '<td style="font-weight:900;">'.$total_jly.'</td>';
							 foreach ($trgt_list as $key => $tar) {  $total_aug += $tar->aug; } echo '<td style="font-weight:900;">'.$total_aug.'</td>';
							 foreach ($trgt_list as $key => $tar) {  $total_sep += $tar->sep; } echo '<td style="font-weight:900;">'.$total_sep.'</td>';
							 foreach ($trgt_list as $key => $tar) {  $total_oct += $tar->oct; } echo '<td style="font-weight:900;">'.$total_oct.'</td>';
							 foreach ($trgt_list as $key => $tar) {  $total_nov += $tar->nov; } echo '<td style="font-weight:900;">'.$total_nov.'</td>';
							 foreach ($trgt_list as $key => $tar) {  $total_dece += $tar->dece; } echo '<td style="font-weight:900;">'.$total_dece.'</td>';
							 echo '<td style="font-weight:900;color:red;">'.$all_total=$total_jan+$total_feb+$total_mar+$total_apr+$total_may+$total_jun+$total_jly+$total_aug+$total_sep+$total_oct+$total_nov+$total_dece.'</td>';
                             echo '<td></td>';
                             echo '</tr>';
			}
	
}

}
