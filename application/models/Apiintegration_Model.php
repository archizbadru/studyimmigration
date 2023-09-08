<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Apiintegration_Model extends CI_Model {

    

        

		public function get_api_list($api_for)

        {

                //$query = $this->db->get('api_integration');

                //return $query->result();

               

                $this->db->select(" * ");

                $this->db->from('api_integration');

                

                $this->db->where('api_for',$api_for);
                $this->db->where('comp_id',$this->session->companey_id);

                $query = $this->db->get();

                return $query->result();

        }

        

        

        public function get_template_list($api_for)

        {

                //$query = $this->db->get('api_integration');

                //return $query->result();

               

                $this->db->select(" * ");

                $this->db->from('api_templates');

                

                $this->db->where('temp_for',$api_for);
                $this->db->where('comp_id',$this->session->companey_id);
                $query = $this->db->get();

                return $query->result();

        }

		

        public function clientdetail_by_id($client_id)

        {	

            return $this->db->select(" * ")

            ->from('clients')

            //->join('user','user.user_id = enquiry.checked_by','left')

            ->where('cli_id',$client_id)

            ->get();

        

        }

		

        public function addsmsapi($data){
            $this->db->insert('api_integration', $data); 
        }

        

        

        public function addTemplates($data)

        {

         $this->db->insert('api_templates', $data); 

         

        }

        

        public function addTemplate($data,$insert)

        {

            $this->db->insert('api_templates', $data);

            

            $insert_id = $this->db->insert_id();

            

            if($insert_id){

                

                for($i=0; $i < count($insert); $i++){

                    

                    $this->db->query('insert into mail_template_attachments(templt_id,files,added_by) VALUES("'.$insert_id.'","'.$insert[$i]['files'].'","'.$insert[$i]['added_by'].'")');

                    

                }

                

                

            }

         

        }

        public function get_email_list(){
            $this->db->where('comp_id',$this->session->companey_id);
            return $this->db->get('email_integration')->result_array();            
        }

        public function add_emaiapi($data){
            $this->db->insert('email_integration', $data);             
        }

		
        public function get_reminder_templates($type){
             
			$data=$this->db->where(array('comp_id'=>$this->session->companey_id,'reminder_type'=>$type))->get('reminder_message');
            return $data; 
        }

		

}