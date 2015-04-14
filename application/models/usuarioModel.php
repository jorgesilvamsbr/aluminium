<?php

class UsuarioModel extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
   
    public function getUsuario() {
        $this->load->database();
        return $this->db->get("usuario");
    }

    public function setUsuario($data) {
        $this->load->database();
        $this->db->insert("usuario", $data);
    }

    public function updateUsuario($idItem, $data) {
        $this->load->database();
        $this->db->where("id",$idItem);
        $this->db->update("usuario", $data);
    }

    public function deleteUsuario($idItem) {
        $this->load->database();
        $this->db->where("id", $idItem);
        $this->db->delete("usuario");
    }
}