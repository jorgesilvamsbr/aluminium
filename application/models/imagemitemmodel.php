<?php

class ImagemItemModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getImagemItem() {
        $this->load->database();
        $this->db->order_by("id", "asc");
        return $this->db->get('imagem_item');
    }

    public function getEspecificImagemItem($idItem) {
        $this->load->database();
        $this->db->order_by("id", "asc");
        $this->db->where("id", $idItem);
        return $this->db->get('imagem');
    }

    public function setImagemItem($data) {
        $this->load->database();
        $this->db->insert("imagem", $data);
    }

    public function updateImagemItem($idItem, $data) {
        $this->load->database();
        $this->db->where("id", $idItem);
        $this->db->update("imagem", $data);
    }

    public function deleteImagemItem($idItem) {
        $this->load->database();
        $this->db->where("id", $idItem);
        $this->db->delete("imagem");
    }

    public function getImagemPorItem( $idItem ) {
        $this->load->database();
        $this->db->order_by("id", "asc");
        $this->db->where("id_item", $idItem );
        return $this->db->get('imagem_item');
    }

}
