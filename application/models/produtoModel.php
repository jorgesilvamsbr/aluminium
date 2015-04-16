<?php

class ProdutoModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getProduto() {
        $this->load->database();
        $this->db->order_by("nome", "asc");
        return $this->db->get('produto');
    }

    public function getEspecificProduto($idProduto) {
        $this->load->database();
        $this->db->order_by("nome", "asc");
        $this->db->where("id", $idProduto);
        return $this->db->get('produto');
    }

    public function setProduto($data) {
        $this->load->database();
        $this->db->insert("produto", $data);
    }

    public function updateProduto($idProduto, $data) {
        $this->load->database();
        $this->db->where("id", $idProduto);
        $this->db->update("produto", $data);
    }

    public function deleteProduto($idProduto) {
        $this->load->database();
        $this->db->where("id", $idProduto);
        $this->db->delete("produto");
    }
    
    public function getProdutoPorCategoria( $idCategoria ){
        $this->load->database();
        $this->db->where("id_categoria", $idCategoria);
        return $this->db->get('produto');
    }
    
    public function retornaUltimoProduto(){
        $this->load->database();
        $this->db->select_max("id");
        return $this->db->get("produto");
    }
}