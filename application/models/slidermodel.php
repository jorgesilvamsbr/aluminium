<?php

class SliderModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getSlider() {
        $this->load->database();
        $this->db->order_by("id", "desc");
        return $this->db->get('slider');
    }

    public function getEspecificImagemItem($idItem) {
        $this->load->database();
        $this->db->order_by("nome", "asc");
        $this->db->where("id", $idItem);
        return $this->db->get('imagem');
    }

    public function setSlider($data) {
        $this->load->database();
        $this->db->insert("slider", $data);
    }

    public function updateImagemItem($idItem, $data) {
        $this->load->database();
        $this->db->where("id", $idItem);
        $this->db->update("imagem", $data);
    }

    public function deleteSlider($idSlider) {
        $this->load->database();
        $this->db->where("id", $idSlider);
        $this->db->delete("slider");
    }

    public function getImagemPorItem( $idItem ) {
        $this->load->database();
        $this->db->where("id_item", $idItem );
        return $this->db->get('imagem_item');
    }

}
