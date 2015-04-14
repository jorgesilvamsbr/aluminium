<?php

class SobreModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getSobre() {
        $this->load->database();
        return $this->db->get("sobre");
    }

    public function setSobre($data) {
        $this->load->database();
        $this->db->insert("sobre", $data);
    }

    public function updateSobre($data) {
        $this->load->database();
        $this->db->where("id",1);
        $this->db->update("sobre", $data);
    }

    public function deleteSobre($idItem) {
        $this->load->database();
        $this->db->where("id", $idItem);
        $this->db->delete("sobre");
    }

}
