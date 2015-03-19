<?php

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->helper('url');
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/index');
        $this->load->view('admin/footer');
    }

    public function forms() {
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/forms');
        $this->load->view('admin/footer');
    }

    public function categoria() {
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

    public function produto() {
        // Chama model responsavel pela persistencia
        $this->load->model("CategoriaModel");
        $this->load->model("ProdutoModel");

        $data['categoria'] = $this->CategoriaModel->getCategoria();
        $data['produto'] = $this->ProdutoModel->getProduto();

        // Carrega as views
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/produto', $data);
        $this->load->view('admin/footer');
    }

    public function item() {

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
        header('Location:' . base_url() . 'index.php/admin/categoria?sucess=' . urlencode('Cadastro realizado com sucesso!'));
    }

    public function editarCategoria() {
        $this->load->helper('url');

        //Chama model responsavel pela persistencia
        $this->load->model("CategoriaModel");

        // Preenche os campos coma s novas informações
        $idCategoria = 13; //$this->input->post("idCategoria");
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
        header('Location:' . base_url() . 'index.php/admin/categoria?sucess=' . urlencode('Cadastro realizado com sucesso!'));
    }

    public function excluirCategoria() {
        //Chama model responsavel pela persistencia
        $this->load->model("CategoriaModel");
        $this->load->model("ProdutoModel");

        // Preenche os campos coma s novas informações
        $idCategoria = $this->input->post("idCategoria");

        $idProdutos = $this->ProdutoModel->getProdutoPorCategoria($idCategoria);

        // Exclui as pastas
        if ($idProdutos->num_rows()) {
            foreach ($idProdutos->result() as $id) {
                $this->deletarArquivosItensPorProduto($idCategoria, $id->id);
            }
        }

        $this->deletarPastaProdutosPorCategoria($idCategoria);

        $nomeAntigoPasta = $this->CategoriaModel->getEspecificCategoria($idCategoria)->row("nome");
        rmdir("img/portfolio/" . $nomeAntigoPasta);

        // Persiste
        $this->CategoriaModel->deleteCategoria($idCategoria);
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

    public function cadastrarProduto() {
        $this->load->helper('url');

        //Chama model responsavel pela persistencia
        $this->load->model("ProdutoModel");
        $this->load->model("CategoriaModel");


        //Define a zona para captura da data
        date_default_timezone_set('America/Sao_Paulo');

        $data['id_categoria'] = $this->removeAscento($this->input->post("categoriaProduto"));
        $data['nome'] = $this->removeAscento($this->input->post("nomeProduto"));
        $data['status'] = $this->input->post("statusProduto");
        $data['data_criacao'] = date('Y-m-d H:i');

        $nomeCategoria = $this->CategoriaModel->getEspecificCategoria($data['id_categoria']);

        // Cria a nova pasta com o nome da categoria
        mkdir("img/portfolio/" . $nomeCategoria ."/". $data['nome'], 0777);

        // Persiste
        $this->ProdutoModel->setProduto($data);

        // Retorna para a página com a mensagem de sucesso
        header('Location:' . base_url() . 'index.php/admin/produto?sucess=' . urlencode('Cadastro realizado com sucesso!'));
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
