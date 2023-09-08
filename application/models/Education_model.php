<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Education_model extends CI_Model {

    private $table = "tbl_education";

    public function insertRow($data = []) {
        return $this->db->insert($this->table, $data);
    }

    public function updateRow($data = []) {

        return $this->db->where('edu_id', $data['edu_id'])
                        ->update($this->table, $data);
    }

    public function readRow($edu_id = null) {
        return $this->db->select("*")
                        ->from($this->table)
                        ->where('edu_id', $edu_id)
                        ->get()
                        ->row();
    }

    public function education_list($lead_code) {
        return $this->db->select("*")
                        ->from($this->table)
                        ->where('unique_number', $lead_code)
                        ->get()
                        ->result();
    }

    public function findRows($edu_id) {
        return $this->db->select('*')
                        ->from($this->table)
                        ->where('edu_id', $edu_id)
                        ->get()
                        ->result();
    }

    public function deleteEducation($paramId = null) {
        $this->db->where('edu_id', $paramId)->delete($this->table);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

}
