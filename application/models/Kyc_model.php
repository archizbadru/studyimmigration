<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kyc_model extends CI_Model {

    private $table = "tbl_kyc";

    public function insertRow($data = []) {
        return $this->db->insert($this->table, $data);
    }

    public function updateRow($data = []) {

        return $this->db->where('kyc_id', $data['kyc_id'])
                        ->update($this->table, $data);
    }

    public function readRow($kyc_id = null) {
        return $this->db->select("*")
                        ->from($this->table)
                        ->where('kyc_id', $kyc_id)
                        ->get()
                        ->row();
    }

    public function kyc_doc_list($lead_code) {
        return $this->db->select("*")
                        ->from($this->table)
                        ->where('unique_number', $lead_code)
                        ->get()
                        ->result();
    }

    public function findRows($kyc_id) {
        return $this->db->select('*')
                        ->from($this->table)
                        ->where('kyc_id', $kyc_id)
                        ->get()
                        ->result();
    }

    public function deleteKyc($paramId = null) {
        $this->db->where('kyc_id', $paramId)->delete($this->table);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

}
