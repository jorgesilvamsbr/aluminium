<?php

class CategoriaModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getCategoria() {
        $this->load->database();
        $this->db->order_by("nome", "asc");
        return $this->db->get('categoria');
    }

    public function getEspecificCategoria( $idCategoria ) {
        $this->load->database();
        $this->db->order_by("nome", "asc");
        $this->db->where( "id", $idCategoria );
        return $this->db->get('categoria');
    }

    public function setCategoria($data) {
        $this->load->database();
        $this->db->insert("categoria", $data);
    }

    public function updateCategoria($idCategoria, $data) {
        $this->load->database();
        $this->db->where("id", $idCategoria);
        $this->db->update("categoria", $data);
    }

    public function deleteCategoria($idCategoria) {
        $this->load->database();
        $this->db->where("id", $idCategoria);
        $this->db->delete("categoria");
    }

}
