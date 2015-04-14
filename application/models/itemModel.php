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
    
    public function getItemDesc() {
        $this->load->database();
        $this->db->order_by("id", "desc");
        return $this->db->get('item');
    }

    public function getEspecificItem($idItem) {
        $this->load->database();
        $this->db->order_by("nome", "asc");
        $this->db->where("id", $idItem);
        return $this->db->get('item');
    }

    public function getUltimoItem() {
        $this->load->database();
        $this->db->select_max('id');
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

    public function deleteImagensItem($idItem) {
        $this->load->database();
        $this->db->where("id_item", $idItem);
        $query = $this->db->get("imagem_item");
        
        foreach($query->result() as $nomeDaImagemDoItem){
            $this->db->where("id", $nomeDaImagemDoItem->id); 
            $this->db->delete("imagem_item");
        }
    }

    public function setImagensItem($data) {
        $this->load->database();
        $this->db->insert('imagem_item', $data);
    }

    public function getItemPorProduto($idProduto) {
        $this->load->database();
        $this->db->where("id_produto", $idProduto);
        return $this->db->get('item');
    }

}
