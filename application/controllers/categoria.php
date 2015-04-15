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

        $data['nome'] = $this->removeAscento($this->input->post("nomeCategoria"));
        $data['status'] = $this->input->post("statusCategoria");
        $data['data_criacao'] = date('Y-m-d H:i');

        // Cria a nova pasta com o nome da categoria
        mkdir("img/portfolio/" . $data['nome'], 0777);

        // Persiste
        $this->CategoriaModel->setCategoria($data);

        // Retorna para a página com a mensagem de sucesso
        header('Location:' . base_url() . 'index.php/categoria?sucess=' . urlencode('Cadastro realizado com sucesso!'));
    }

    public function editarCategoria() {
        $this->load->helper('url');

        //Chama model responsavel pela persistencia
        $this->load->model("CategoriaModel");

        // Preenche os campos coma s novas informações
        $idCategoria = $this->input->post("idCategoria");
        $data['nome'] = $this->removeAscento($this->input->post("nomeCategoria"));
        $data['status'] = $this->input->post("statusCategoria");

        // Renomeia a pasta com o novo nome da categoria
        $nomeAntigoPasta = $this->CategoriaModel->getEspecificCategoria($idCategoria)->row("nome");
        if ($nomeAntigoPasta != $data['nome']) {
            rename("img/portfolio/" . $nomeAntigoPasta, "img/portfolio/" . $data['nome']);
        }

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
        $nomeAntigoPasta = $this->CategoriaModel->getEspecificCategoria($idCategoria)->row("nome");
        $diretorio = "img/portfolio/" . $nomeAntigoPasta;
        $this->delTree($diretorio);

        // Persiste
        $this->excluiProdutosPertecentesACategoria($idCategoria);
        $this->CategoriaModel->deleteCategoria($idCategoria);
    }

    public function excluiProdutosPertecentesACategoria($idCategoria) {
        $this->load->model("ProdutoModel");
        $produtosDaCategoria = $this->ProdutoModel->getProdutoPorCategoria($idCategoria);

        foreach ($produtosDaCategoria->result() as $produtos) {
            $this->excluiItensPertecentesAoProduto($produtos->id);
            $this->ProdutoModel->deleteProduto($produtos->id);
        }
    }

    public function excluiItensPertecentesAoProduto($idProduto) {
        $this->load->model("ItemModel");
        $itensDoProduto = $this->ProdutoModel->getItemPorProduto($idProduto);

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
