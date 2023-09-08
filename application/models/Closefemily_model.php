<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Closefemily_model extends CI_Model {

    private $table = "tbl_close_family";

    public function insertRow($data = []) {
        return $this->db->insert($this->table, $data);
    }

    public function updateRow($data = []) {

        return $this->db->where('cf_id', $data['cf_id'])
                        ->update($this->table, $data);
    }

    public function readRow($cf_id = null) {
        return $this->db->select("*")
                        ->from($this->table)
                        ->where('cf_id', $cf_id)
                        ->get()
                        ->row();
    }

    public function close_femily_list($lead_code) {
        return $this->db->select("*")
                        ->from($this->table)
                        ->join('tbl_country', 'tbl_country.id_c = tbl_close_family.country_id')
                        ->where('unique_number', $lead_code)
                        ->get()
                        ->result();
    }

    public function findRows($cf_id) {
        return $this->db->select('*')
                        ->from($this->table)
                        ->where('cf_id', $cf_id)
                        ->get()
                        ->result();
    }

    public function deleteClosefemily($paramId = null) {
        $this->db->where('cf_id', $paramId)->delete($this->table);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

}
