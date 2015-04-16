<?php

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->view('admin/login');
    }

    public function login() {
        $this->load->helper("url");
        $this->load->model("usuarioModel");

        $data = $this->obterValoresDosCampos();

        if ($this->usuarioModel->ehUmUsuarioCadastrado($data)) {
            $dadosDeSessao = array(
                'username' => $data['login'],
                'logged' => true
            );

            $this->session->set_userdata($dadosDeSessao);

            header('Location:' . base_url() . 'index.php/categoria');
        } else {
            header('Location:' . base_url() . 'index.php/admin');
        }
    }

    private function obterValoresDosCampos() {
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

    public function sair() {
        $this->load->helper('url');
        $this->session->sess_destroy();
        redirect(base_url() . 'index.php/admin');
    }

}
