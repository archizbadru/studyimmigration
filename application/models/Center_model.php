<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Center_model extends CI_Model {



    private $table = "tbl_center";



    public function insertRow($data = []) {

        return $this->db->insert($this->table, $data);

    }

    

    public function updateRow($data = []) {



        return $this->db->where('center_id', $data['center_id'])

                        ->update($this->table, $data);

    }

    

    public function readRow($center_id = null) {

        return $this->db->select("*")

                        ->from($this->table)

                        ->where('center_id', $center_id)

                        ->get()

                        ->row();

    }



    public function centerlist() {

        return $this->db->select("tbl_center.*,tbl_country.country_name")
                        ->from("tbl_center")
                        ->join('tbl_country', 'tbl_country.id_c = tbl_center.country_id','left')
                        ->where('tbl_center.comp_id',$this->session->companey_id)
                        ->get()
                        ->result();

    }

    

    public function all_center() {

        return $this->db->select('*')->from('tbl_center')->where('status', 1)->get()->result();

    }

    

    public function findRows($center_id) {

        return $this->db->select('*')

                        ->from($this->table)

                        ->where('center_id', $center_id)

                        ->get()

                        ->result();

    }    

    public function center_list_by_id($sIdArr){

        return $this->db->select('sch.*,sch.center_id,sch.center_name,sch.address,sch.contact_name,sch.contact_number,sch.dise_code,sch.created_date,sch.updated_date,tbl_block.block,city.city,state.state')

                        ->from('tbl_center as sch')                        

                        ->join('state', 'state.id = sch.state_id')

                        ->join('city', 'city.id = sch.city_id')

                        ->join('tbl_block', 'tbl_block.block_id = sch.block_id')

                        ->where_in('center_id',$sIdArr)

                        ->order_by('dise_code', "asc")

                        ->get()

                        ->result();

    } 

    

    public function center_contact_list_by_id($center_id){        

        return $this->db->select("*")

                        ->from("tbl_center_contact")

                        ->where('center_id',$center_id)

                        ->order_by('center_id', "desc")

                        ->get()

                        ->result();        

    }

    

    public function deleteCenter($paramId = null)

	{

		$this->db->where('center_id',$paramId)->delete('tbl_center');

		if ($this->db->affected_rows()) {

			return true;

		} else {

			return false;

		}

	} 

}

