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
    
    public function ehUmUsuarioCadastrado($data){
        $this->load->database();
        $this->db->where("login", $data["login"]);
        $this->db->where("senha", $data["senha"]);
        $query = $this->db->get("usuario");
        return $query->num_rows() > 0;
    }
    
    public function logged(){
        $this->load->helper('url');
        
        $logged = $this->session->userdata("logged");

        if(!$logged){
            redirect( base_url() . 'index.php/admin');
            die();
        }
    }
}