<?php

class Sobre extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuarioModel');
        $this->usuarioModel->logged();
    }

    public function index() {
        $this->load->model("sobreModel");

        $data['sobre'] = $this->sobreModel->getSobre();

        $this->load->helper('url');
        $this->load->helper('form');

        $this->load->view("admin/header");
        $this->load->view("admin/menu");
        $this->load->view("admin/sobre", $data);
        $this->load->view("admin/footer");
    }

    public function salvarSobre() {
        $this->load->helper('url');
        $this->load->model("sobreModel");

        $data["sobre"] = $this->input->post("sobre");
        $data["usuario_edicao"] = "Jorge Arrumar no código depois";

        $this->sobreModel->updateSobre($data);

        header('Location:' . base_url() . 'index.php/sobre');
    }

}
