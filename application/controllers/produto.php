<?php

class Produto extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuarioModel');
        $this->usuarioModel->logged();
    }

    public function index() {
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

    public function cadastrarProduto() {
        $this->load->helper('url');

        //Chama model responsavel pela persistencia
        $this->load->model("ProdutoModel");

        //Define a zona para captura da data
        date_default_timezone_set('America/Sao_Paulo');

        $data['id_categoria'] = $this->input->post("idCategoria");
        $data['nome'] = $this->input->post("nomeProduto");
        $data['status'] = $this->input->post("statusProduto");
        $data['data_criacao'] = date('Y-m-d H:i');


        // Persiste
        $this->ProdutoModel->setProduto($data);
        $idDoProduto = $this->ProdutoModel->retornaUltimoProduto()->row('id');

        // Cria a nova pasta com o nome da categoria
        mkdir("img/portfolio/" . $data['id_categoria'] . "/" . $idDoProduto, 0777);

        // Retorna para a página com a mensagem de sucesso
        header('Location:' . base_url() . 'index.php/produto?sucess=' . urlencode('Cadastro realizado com sucesso!'));
    }

    public function editarProduto() {
        $this->load->helper('url');

        //Chama model responsavel pela persistencia
        $this->load->model("ProdutoModel");

        // Preenche os campos coma s novas informações
        $idDoProduto = $this->input->post("idProduto");
        $data["id_categoria"] = $this->input->post("idCategoria");
        $data["nome"] = $this->input->post("nomeProduto");
        $data["status"] = $this->input->post("statusProduto");

        // Caso houve mudança de categoria realiza a cópia dos arquivos para a nova categoria e exclui da antiga categoria
        $categoriaAtual = $this->ProdutoModel->getEspecificProduto($idDoProduto)->row("id_categoria");
        $caminhodaPastaAtual = "img/portfolio/" . $categoriaAtual . "/" . $idDoProduto;
        $caminhodaPastaDestino = "img/portfolio/" . $data['id_categoria'] . "/" . $idDoProduto;

        if ($caminhodaPastaAtual != $caminhodaPastaDestino) {
            $this->copiaArquivosEPastas($caminhodaPastaAtual, $caminhodaPastaDestino);
            $this->delTree($caminhodaPastaAtual);
        }
        
        // Persiste
        $this->ProdutoModel->updateProduto($idDoProduto, $data);

        // Retorna para a página com a mensagem de sucesso
        header('Location:' . base_url() . 'index.php/produto');
    }

    public function excluirProduto() {
        //Chama model responsavel pela persistencia
        $this->load->model("ProdutoModel");
        $this->load->model("CategoriaModel");

        // Preenche os campos coma s novas informações
        $idDoProduto = $this->input->post("idProduto");
        $informacoesDoProduto = $this->ProdutoModel->getEspecificProduto($idDoProduto);

        // Exclui as pastas
        $diretorio = "img/portfolio/" . $informacoesDoProduto->row('id_categoria') . "/" . $idDoProduto;
        $this->delTree($diretorio);

        // Persiste
        $this->excluiItensPertecentesAoProduto($idDoProduto);
        $this->ProdutoModel->deleteProduto($idDoProduto);
    }

    public function excluiItensPertecentesAoProduto($idProduto) {
        $this->load->model("ItemModel");
        $itensDoProduto = $this->ItemModel->getItemPorProduto($idProduto);

        if ($itensDoProduto->num_rows() > 0) {
            foreach ($itensDoProduto->result() as $itens) {
                $this->ItemModel->deleteItem($itens->id);
            }
        }
    }

    private static function delTree($dir) {
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? Categoria::delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

    private function copiaArquivosEPastas($source, $dest) {
        // COPIA UM ARQUIVO
        if (is_file($source)) {
            return copy($source, $dest);
        }

        // CRIA O DIRETÓRIO DE DESTINO
        if (!is_dir($dest)) {
            mkdir($dest);
        }

        // FAZ LOOP DENTRO DA PASTA
        $dir = dir($source);
        while (false !== $entry = $dir->read()) {
            // PULA "." e ".."
            if ($entry == '.' || $entry == '..') {
                continue;
            }

            // COPIA TUDO DENTRO DOS DIRETÓRIOS
            if ($dest !== "$source/$entry") {
                $this->copiaArquivosEPastas("$source/$entry", "$dest/$entry");
            }
        }

        $dir->close();
        return true;
    }
}
