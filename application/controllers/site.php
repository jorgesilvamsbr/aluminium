<?php

class Site extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->helper('url');

        //Models
        $this->load->model('categoriaModel');
        $this->load->model('produtoModel');
        $this->load->model('itemModel');
        $this->load->model('imagemItemModel');
        $this->load->model('sliderModel');


        $data['categorias'] = $this->categoriaModel->getCategoria();
        $data['produtos'] = $this->produtoModel->getProduto();
        $data['itens'] = $this->itemModel->getItemDesc();
        $data['imagens'] = $this->imagemItemModel->getImagemItem();
        $data['sliders'] = $this->sliderModel->getSlider();

        $this->load->view('site/header', $data);
        $this->load->view('site/index');
        $this->load->view('site/footer');
    }

    public function produto() {
        $this->load->helper('url');

        $id_produto = $this->input->get('id'); // pega a informação via get
//        echo $id_produto;
        //Models
        $this->load->model('categoriaModel');
        $this->load->model('produtoModel');
        $this->load->model('itemModel');
        $this->load->model('imagemItemModel');

        $data['categorias'] = $this->categoriaModel->getCategoria();
        $data['produtos'] = $this->produtoModel->getProduto();
        $data['produto'] = $this->produtoModel->getEspecificProduto($id_produto);
        $data['itens'] = $this->itemModel->getItemPorProduto($id_produto);
        $data['imagemItem'] = $this->imagemItemModel->getImagemItem();

        $this->load->view('site/header', $data);
        $this->load->view('site/produto', $data);
        $this->load->view('site/footer');
    }

    public function item() {
        $this->load->helper('url');

        $id_item = $this->input->get('id'); // pega a informação via get
        //Models
        $this->load->model('categoriaModel');
        $this->load->model('produtoModel');
        $this->load->model('itemModel');
        $this->load->model('imagemItemModel');


        $data['categorias'] = $this->categoriaModel->getCategoria();
        $data['produtos'] = $this->produtoModel->getProduto();
        $item = $this->itemModel->getEspecificItem($id_item);
        $data['itemQuery'] = $this->itemModel->getEspecificItem($id_item);
        $data['imagemItem'] = $this->imagemItemModel->getImagemPorItem($id_item);



        foreach ($item->result() as $it) {
            $id_produto = $it->id_produto;
            $data['id_produto'] = $it->id_produto;
        }

        //pega id do produto
        $produto = $this->produtoModel->getEspecificProduto($id_produto);

        foreach ($produto->result() as $pro) {
            $data['id_categoria'] = $pro->id_categoria;
        }

        $this->load->view('site/header', $data);
        $this->load->view('site/item', $data);
        $this->load->view('site/footer');
    }

    public function contato() {
        $this->load->helper('url');

        //Models
        $this->load->model('categoriaModel');
        $this->load->model('produtoModel');


        $data['categorias'] = $this->categoriaModel->getCategoria();
        $data['produtos'] = $this->produtoModel->getProduto();

        $this->load->view('site/header', $data);
        $this->load->view('site/contato');
        $this->load->view('site/footer');
    }

    public function sobre() {
        $this->load->helper('url');

        //Models
        $this->load->model('categoriaModel');
        $this->load->model('produtoModel');
        $this->load->model('sobreModel');

        $data['categorias'] = $this->categoriaModel->getCategoria();
        $data['produtos'] = $this->produtoModel->getProduto();
        $data['sobre'] = $this->sobreModel->getSobre();


        $this->load->view('site/header', $data);
        $this->load->view('site/sobre');
        $this->load->view('site/footer');
    }

    public function enviaEmail() {
        $this->load->helper('url');
        $this->load->library('email');

        $name = $this->input->post("name");
        $email = $this->input->post("email");
        $message = $this->input->post("message");
//        echo $name;
//        echo $email;
              
        // ajusta as informações para envio
        $this->email->from("contato@aluminiumcenter.com.br", $name);
        $this->email->to("natanleitte@gmail.com");

        $this->email->subject("Aluminium Center - Contato: " );
        $this->email->message($message . "\n\n");

        // dispara o e-mail
        $this->email->send();
        header('Location:' . base_url() . 'index.php/site/contato');

    }

}
