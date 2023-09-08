<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Configuration_Model extends CI_Model {

    

        

		public function get_integration_list($aid)

        {

                /*$query = $this->db->get('website_integration');

                return $query->result();*/

               

                $this->db->select(" * ");

                $this->db->from('website_integration');

                
                $this->db->where('comp_id',$this->session->companey_id);
                
                $this->db->where('integration_type',$aid);

                $query = $this->db->get();

                return $query->result();

        }


#--------------------------------------------------payment gateway Start------------------------------------------------#
        public function get_gateway_list()
        {
            $this->db->select(" * ");
            $this->db->from('gateway_integration');
            $this->db->where('comp_id',$this->session->companey_id);
            $query = $this->db->get();
            return $query->result();
        }

        public function gateway_integrate($data)

        {
         $this->db->insert('gateway_integration', $data);
        }

#--------------------------------------------------payment gateway End------------------------------------------------#        

        public function get_portalintegration_list($aid)

        {

                /*$query = $this->db->get('website_integration');

                return $query->result();*/

               

                $this->db->select(" * ");

                $this->db->from('portals');

                

                $this->db->where('portal_type',$aid);

                $query = $this->db->get();

                return $query->result();

        }

        

        

       

		

        public function website_integrate($data)

        {

         $this->db->insert('website_integration', $data); 

         

        }

        

        public function web_enquiry($data)

        {

         $this->db->insert('enquiry', $data); 
         //$insert_id = $this->db->insert_id();
         //return  $insert_id;
         

        }

        

        

        public function delete_integration($integration = null)

        {

        $this->db->where('wid',$integration)

        ->delete('website_integration');

        

        if ($this->db->affected_rows()) {

        return true;

        } else {

        return false;

        }

        }

		

		

		///////////////////////// PORTAL INTEGRATION ////////////////////

		

		public function delete_portalintegration($pintegration = null)

        {

        $this->db->where('portal_id',$pintegration)

        ->delete('portals');

        

        if ($this->db->affected_rows()) {

        return true;

        } else {

        return false;

        }

        }

		

		public function portal_integrate($data)

        {

         $this->db->insert('portals', $data); 

         

        }

		

}