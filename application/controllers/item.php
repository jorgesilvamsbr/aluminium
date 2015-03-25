<?php

class Item extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        // Chama model responsavel pela persistencia
        $this->load->model("CategoriaModel");
        $this->load->model("ProdutoModel");
        $this->load->model("ItemModel");

        $data['categoria'] = $this->CategoriaModel->getCategoria();
        $data['produto'] = $this->ProdutoModel->getProduto();
        $data['item'] = $this->ItemModel->getItem();

        // Carrega as views
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/item', $data);
        $this->load->view('admin/footer');
    }

    public function inserirImagem($data) {
        $this->load->model('ItemModel');
        $this->load->model('ProdutoModel');
        $this->load->model('CategoriaModel');

        // Caminho de onde a imagem ficará
        $nomeProdutoItem = $this->ProdutoModel->getEspecificProduto($data['id_produto'])->row('nome');
        $idCategoriaItem = $this->ProdutoModel->getEspecificProduto($data['id_produto'])->row('id_categoria');
        $nomeCategoriaItem = $this->CategoriaModel->getEspecificCategoria($idCategoriaItem)->row('nome');

        $pastaItem = "img/portfolio/" . $nomeCategoriaItem . "/" . $nomeProdutoItem . "/" . $nomeItem;

        mkdir($pastaItem);

        $pastaItem = $pastaItem . "/";

        //Configurações da imagem
        $config['upload_path'] = $pastaItem;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '3000';
        $config['max_width'] = '285';
        $config['max_height'] = '380';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            header('Location:' . base_url() . 'index.php/item?error=' . urlencode("Bugou! :/ Imagem inválida" . "<br>" . $this->upload->display_errors()));
            exit();
        } else {
            $this->upload->data();
            $this->ItemModel->setItem($data);
            $idItem = $this->ItemModel->getEspecificItem();
            /*
             * Função inacabada !!!!
             */
        }
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

        $this->inserirImagem($data);
    }

    public function deletarPastaProdutosPorCategoria($idCategoria) {
        //Chama model responsavel pela persistencia
        $this->load->model("CategoriaModel");
        $this->load->model("ProdutoModel");

        $nomeAntigoPasta = $this->CategoriaModel->getEspecificCategoria($idCategoria)->row("nome");
        $nomePastaProdutos = $this->ProdutoModel->getProdutoPorCategoria($idCategoria);

        if ($nomePastaProdutos->num_rows()) {
            foreach ($nomePastaProdutos->result() as $path) {
                rmdir("img/portfolio/" . $nomeAntigoPasta . "/" . $path->nome);
            }
        }
    }

    public function deletarArquivosItensPorProduto($idCategoria, $idProduto) {
        //Chama model responsavel pela persistencia
        $this->load->model("CategoriaModel");
        $this->load->model("ProdutoModel");
        $this->load->model("ItemModel");
        $this->load->model("ImagemItemModel");

        $nomePastaCategoria = $this->CategoriaModel->getEspecificCategoria($idCategoria)->row("nome");
        $nomePastaProduto = $this->ProdutoModel->getEspecificProduto($idProduto)->row("nome");
        $idItem = $this->ItemModel->getItemPorProduto($idProduto);
        $nomeImagensItem = $this->ImagemItemModel->getImagemPorItem($idItem->row('id'));

        foreach ($nomeImagensItem->result() as $file) {
            unlink("img/portfolio/" . $nomePastaCategoria . "/" . $nomePastaProduto . "/" . $file->nome);
        }
    }

    private function removeAscento($string) {
        $map = array(
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
            'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E',
            'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ð' => 'D', 'Ñ' => 'N',
            'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O',
            'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Ŕ' => 'R',
            'Þ' => 's', 'ß' => 'B', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
            'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
            'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
            'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
            'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y',
            'þ' => 'b', 'ÿ' => 'y', 'ŕ' => 'r'
        );
        return strtr($string, $map); // funciona corretamente
    }

}
