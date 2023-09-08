<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SocialProfile_model extends CI_Model {

    private $table = "tbl_social_profile";

    public function insertRow($data = []) {
        return $this->db->insert($this->table, $data);
    }

    public function updateRow($data = []) {

        return $this->db->where('sp_id', $data['sp_id'])
                        ->update($this->table, $data);
    }

    public function readRow($sp_id = null) {
        return $this->db->select("*")
                        ->from($this->table)
                        ->where('sp_id', $sp_id)
                        ->get()
                        ->row();
    }

    public function social_profile_list($lead_code) {
        return $this->db->select("*")
                        ->from($this->table)
                        ->where('unique_number', $lead_code)
                        ->get()
                        ->result();
    }

    public function findRows($sp_id) {
        return $this->db->select('*')
                        ->from($this->table)
                        ->where('sp_id', $sp_id)
                        ->get()
                        ->result();
    }

    public function deleteSocialProfile($paramId = null) {
        $this->db->where('sp_id', $paramId)->delete($this->table);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

}
