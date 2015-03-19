<?php

class ItemModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getItem() {
        $this->load->database();
        $this->db->order_by("nome", "asc");
        return $this->db->get('item');
    }

    public function getEspecificItem($idItem) {
        $this->load->database();
        $this->db->order_by("nome", "asc");
        $this->db->where("id", $idItem);
        return $this->db->get('item');
    }

    public function setItem($data) {
        $this->load->database();
        $this->db->insert("item", $data);
    }

    public function updateItem($idItem, $data) {
        $this->load->database();
        $this->db->where("id", $idItem);
        $this->db->update("item", $data);
    }

    public function deleteItem($idItem) {
        $this->load->database();
        $this->db->where("id", $idItem);
        $this->db->delete("item");
    }

    public function getItemPorProduto($idProduto) {
        $this->load->database();
        $this->db->where("id_produto", $idProduto);
        return $this->db->get('item');
    }

}
