<?php

class Usuario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuarioModel');
        $this->usuarioModel->logged();
    }

    public function index() {
        $this->load->helper("url");
        $this->load->helper("form");

        $this->load->model("usuarioModel");

        $data["usuario"] = $this->usuarioModel->getUsuario();

        $this->load->view("admin/header");
        $this->load->view("admin/menu", $data);
        $this->load->view("admin/usuario");
        $this->load->view("admin/footer");
    }

    public function salvarUsuario() {
        $this->load->helper('url');
        $this->load->model("usuarioModel");

        $data = $this->obterValoresDosCampos();

        $this->usuarioModel->setUsuario($data);

        header('Location:' . base_url() . 'index.php/usuario');
    }

    public function editarUsuario() {
        $this->load->helper('url');
        $this->load->model("usuarioModel");
        
        $idItem = $this->input->post("idUsuario");
        $data = $this->obterValoresDosCampos();
        
        $this->usuarioModel->updateUsuario($idItem, $data);
        
        header('Location:' . base_url() . 'index.php/usuario');
    }

    public function excluirUsuario(){
        $this->load->helper('url');
        $this->load->model("usuarioModel");
        
        $idItem = $this->input->post("idUsuario");
        $this->usuarioModel->deleteUsuario($idItem);
        
        header('Location:' . base_url() . 'index.php/usuario');
    }
    
    private function obterValoresDosCampos() {
        $data["nome"] = $this->input->post("nome");
        $data["login"] = $this->input->post("login");
        $data["senha"] = $this->input->post("senha");
//        $data["senha"] = $this->geraSenhaHash($this->input->post("senha"));
        
        return $data;
    }

    private function geraSenhaHash($senha) {
        $custo = '08';
        $salt = 'Cf1f11ePArKlBJomM0F6aJ';

        // Gera um hash baseado em bcrypt
        return crypt($senha, '$2a$' . $custo . '$' . $salt);
    }

}
