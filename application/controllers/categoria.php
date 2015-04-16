<?php

class Categoria extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuarioModel');
        $this->usuarioModel->logged();
    }

    public function index() {
        // Chama model responsavel pela persistencia
        $this->load->model("CategoriaModel");

        $data['query'] = $this->CategoriaModel->getCategoria();

        // Carrega as views
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/categoria', $data);
        $this->load->view('admin/footer');
    }

    public function cadastrarCategoria() {
        $this->load->helper('url');

        //Chama model responsavel pela persistencia
        $this->load->model("CategoriaModel");

        //Define a zona para captura da data
        date_default_timezone_set('America/Sao_Paulo');

        $data['nome'] = $this->input->post("nomeCategoria");
        $data['status'] = $this->input->post("statusCategoria");
        $data['data_criacao'] = date('Y-m-d H:i');

        // Persiste
        $this->CategoriaModel->setCategoria($data);
        $ultimaCategoria = $this->CategoriaModel->retornaUltimaCategoria();
        
        // Cria a nova pasta com o nome da categoria
        mkdir("img/portfolio/" . $ultimaCategoria->row("id"), 0777);

        // Retorna para a página com a mensagem de sucesso
        header('Location:' . base_url() . 'index.php/categoria?sucess=' . urlencode('Cadastro realizado com sucesso!'));
    }

    public function editarCategoria() {
        $this->load->helper('url');

        //Chama model responsavel pela persistencia
        $this->load->model("CategoriaModel");

        // Preenche os campos coma s novas informações
        $idCategoria = $this->input->post("idCategoria");
        $data['nome'] = $this->input->post("nomeCategoria");
        $data['status'] = $this->input->post("statusCategoria");
        
        // Persiste
        $this->CategoriaModel->updateCategoria($idCategoria, $data);

        // Retorna para a página com a mensagem de sucesso
        header('Location:' . base_url() . 'index.php/categoria?sucess=' . urlencode('Cadastro realizado com sucesso!'));
    }

    public function excluirCategoria() {
        //Chama model responsavel pela persistencia
        $this->load->model("CategoriaModel");

        // Preenche os campos coma s novas informações
        $idCategoria = $this->input->post("idCategoria");

        // Exclui as pastas
        $diretorio = "img/portfolio/" . $idCategoria;

        $this->delTree($diretorio);

        // Persiste
        $this->excluiProdutosPertecentesACategoria($idCategoria);
        $this->CategoriaModel->deleteCategoria($idCategoria);
    }

    public function excluiProdutosPertecentesACategoria($idCategoria) {
        $this->load->model("ProdutoModel");
        $produtosDaCategoria = $this->ProdutoModel->getProdutoPorCategoria($idCategoria);

        foreach ($produtosDaCategoria->result() as $produtos) {
            echo $produtos->id;
            $this->excluiItensPertecentesAoProduto($produtos->id);
            $this->ProdutoModel->deleteProduto($produtos->id);
        }
    }

    public function excluiItensPertecentesAoProduto($idProduto) {
        $this->load->model("ItemModel");
        $itensDoProduto = $this->ItemModel->getItemPorProduto($idProduto);

        foreach ($itensDoProduto->result() as $itens) {
            $this->ItemModel->deleteItem($itens->id);
        }
    }

    private static function delTree($dir) {
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? Categoria::delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }
}
