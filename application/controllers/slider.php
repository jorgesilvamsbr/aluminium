<?php

class Slider extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuarioModel');
        $this->usuarioModel->logged();
    }

    public function index() {

        // Chama model responsavel pela persistencia
        $this->load->model("CategoriaModel");
        $this->load->model("ProdutoModel");
        $this->load->model("ItemModel");
        $this->load->model("SliderModel");


        $data['categoria'] = $this->CategoriaModel->getCategoria();
        $data['produto'] = $this->ProdutoModel->getProduto();
        $data['item'] = $this->ItemModel->getItem();
        $data['slider'] = $this->SliderModel->getSlider();


        // Carrega as views
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/slider', $data);
        $this->load->view('admin/footer');
    }

    public function cadastrarItem() {
        $this->load->model('ItemModel');
        $this->load->model('ProdutoModel');
        $this->load->model('CategoriaModel');

        //Define a zona para captura da data
        date_default_timezone_set('America/Sao_Paulo');

        $data['id_produto'] = $this->input->post('idProduto');
        $data['nome'] = $this->input->post('nomeItem');
        $data['descricao'] = $this->input->post('descricaoItem');
        $data['status'] = $this->input->post('statusItem');
        $data['data_criacao'] = date('Y-m-d H:i');

        $count =    $this->input->post('count');
//        echo $count;
//        $this->ItemModel->setItem($data);

            $arquivos = $_FILES["filename0"];
            $quantidadeDeImagens = count($arquivos["name"]);
//            echo $filename;
            $this->inserirImagem($data, $quantidadeDeImagens, $arquivos);
            
        header('Location:' . base_url() . 'index.php/slider');

    }

    private function inserirImagem($data, $quantidadeDeImagens, $arquivos) {
        $this->load->helper('url');
        $this->load->model('ItemModel');
        $this->load->model('ProdutoModel');
        $this->load->model('CategoriaModel');

        // Caminho de onde a imagem ficará
//        $idItem = $this->ItemModel->getUltimoItem()->row('id');
//        $idCategoria = $this->ProdutoModel->getEspecificProduto($data['id_produto'])->row('id_categoria');
        $pastaItem = "img/homepage-slider/";
        
//        if(!file_exists ($pastaItem))
//        {
//            mkdir($pastaItem);
//        }
//        $pastaItem .= "/";

        for ($i = 0; $i < $quantidadeDeImagens; $i++) {

            // Aplica as configurações do arquivo
            $_FILES['userfile']['name'] = $arquivos['name'][$i];
            $_FILES['userfile']['type'] = $arquivos['type'][$i];
            $_FILES['userfile']['tmp_name'] = $arquivos['tmp_name'][$i];
            $_FILES['userfile']['error'] = $arquivos['error'][$i];
            $_FILES['userfile']['size'] = $arquivos['size'][$i];

            //Configurações da imagem
            $config['upload_path'] = $pastaItem;
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '30000';
            $config['max_width'] = '100000';
            $config['max_height'] = '380000';


            $this->load->library('upload', $config);

            // Realiza o upload do arquivo
            if (!$this->upload->do_upload()) {
                header('Location:' . base_url() . 'index.php/slider');
                exit();
            } else {

                // Realiza o upload do arquivo
                $this->upload->data();

                $data = array('upload_data' => $this->upload->data());
                $this->persisteImagemNoBancoDeDados($data, $pastaItem);
            }
        }
//        header('Location:' . base_url() . 'index.php/item');
    }

    private function persisteImagemNoBancoDeDados($data, $pastaItem) {
        foreach ($data as $item) {
            // Persiste a imagem na tabela "imagem_item"
            $nomeDaImagemDoItem = md5(uniqid(time())) . "" . $item['file_ext'];
            $this->cadastraImagemItem($nomeDaImagemDoItem);

            rename($pastaItem . "" . $item['file_name'], $pastaItem . $nomeDaImagemDoItem);
        }
    }

    private function cadastraImagemItem($nomeDaImagemDoItem) {
        $this->load->model('SliderModel');

        //Define a zona para captura da data
        date_default_timezone_set('America/Sao_Paulo');

//        $data['id_item'] = $idItem;
        $data['nome'] = $nomeDaImagemDoItem;
        echo $nomeDaImagemDoItem;
        $data['data_insercao'] = date('Y-m-d H:i');

        $this->SliderModel->setSlider($data);
    }

    public function excluirItem() {
        $this->load->model("ItemModel");
        $this->load->model("ProdutoModel");

        $idItem = $this->input->post("idItem");
        $idDoProdutoDoItem = $this->ItemModel->getEspecificItem($idItem)->row("id_produto");
        $idDaCategoriaDoItem = $this->ProdutoModel->getEspecificProduto($idDoProdutoDoItem)->row("id_categoria");

        $this->ItemModel->deleteImagensItem($idItem);
        $this->ItemModel->deleteItem($idItem);

        $diretorio = "img/portfolio/" . $idDaCategoriaDoItem . "/" . $idDoProdutoDoItem . "/" . $idItem;

        $this->delTree($diretorio);
    }

    private static function delTree($dir) {
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? Categoria::delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

}
