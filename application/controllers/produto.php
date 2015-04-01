<?php

class Produto extends CI_Controller {

    public function __construct() {
        parent::__construct();
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
        $this->load->model("CategoriaModel");


        //Define a zona para captura da data
        date_default_timezone_set('America/Sao_Paulo');

        $data['id_categoria'] = $this->removeAscento($this->input->post("idCategoria"));
        $data['nome'] = $this->removeAscento($this->input->post("nomeProduto"));
        $data['status'] = $this->input->post("statusProduto");
        $data['data_criacao'] = date('Y-m-d H:i');

        $nomeCategoria = $this->CategoriaModel->getEspecificCategoria($data['id_categoria'])->row('nome');

        // Cria a nova pasta com o nome da categoria
        mkdir("img/portfolio/" . $nomeCategoria . "/" . $data['nome'], 0777);

        // Persiste
        $this->ProdutoModel->setProduto($data);

        // Retorna para a página com a mensagem de sucesso
        header('Location:' . base_url() . 'index.php/produto?sucess=' . urlencode('Cadastro realizado com sucesso!'));
    }

    public function editarProduto() {
        $this->load->helper('url');

        //Chama model responsavel pela persistencia
        $this->load->model("ProdutoModel");
        $this->load->model("CategoriaModel");

        // Preenche os campos coma s novas informações
        $idProduto = $this->input->post("idProduto");
        $data["id_categoria"] = $this->input->post("idCategoria");
        $data["nome"] = $this->removeAscento($this->input->post("nomeProduto"));
        $data["status"] = $this->input->post("statusProduto");

        // Caso necessário renomeia a pasta produto
        $this->renomeiaPastaProduto($idProduto, $data["nome"]);

        // Caso houve mudança de categoria realiza a cópia dos arquivos para a nova categoria e exclui da antiga categoria
        $caminhodaPasta = $this->reuperaOrigemEDestinoDaNovaPastaDoProduto($idProduto, $data["id_categoria"]);
        $this->copiaArquivosEPastas($caminhodaPasta["origem"], $caminhodaPasta["destino"]);
        $this->delTree($caminhodaPasta["origem"]);
        
        // Persiste
        $this->ProdutoModel->updateProduto($idProduto, $data);

        // Retorna para a página com a mensagem de sucesso
        header('Location:' . base_url() . 'index.php/produto?sucess=' . urlencode('Cadastro realizado com sucesso!'));
    }

    public function excluirProduto() {
        //Chama model responsavel pela persistencia
        $this->load->model("ProdutoModel");
        $this->load->model("CategoriaModel");

        // Preenche os campos coma s novas informações
        $idProduto = $this->input->post("idProduto");
        $informacoesDoProduto = $this->ProdutoModel->getEspecificProduto($idProduto);
        $nomeDoProduto = $informacoesDoProduto->row('nome');
        $idCategoriaDoProduto = $informacoesDoProduto->row('id_categoria');
        $nomeDaCategoria = $this->CategoriaModel->getEspecificCategoria($idCategoriaDoProduto)->row('nome');

        // Exclui as pastas
        $diretorio = "img/portfolio/" . $nomeDaCategoria . "/" . $nomeDoProduto;
        $this->delTree($diretorio);

        // Persiste
        $this->excluiItensPertecentesAoProduto($idProduto);
        $this->ProdutoModel->deleteProduto($idProduto);
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

    private function reuperaOrigemEDestinoDaNovaPastaDoProduto($idProduto, $idDaNovaCategoria){
            //Chama model responsavel pela persistencia
        $this->load->model("ProdutoModel");
        $this->load->model("CategoriaModel");

        // Renomeia a pasta com o novo nome da categoria
        $idDaPastaCategoria = $this->ProdutoModel->getEspecificProduto($idProduto)->row('id_categoria');
        $nomeAntigoDaPastaCategoria = $this->CategoriaModel->getEspecificCategoria($idDaPastaCategoria)->row("nome");
        $nomeDaNovaPastaCategoria = $this->CategoriaModel->getEspecificCategoria($idDaNovaCategoria)->row("nome");
        $nomeDaPastaProduto = $this->ProdutoModel->getEspecificProduto($idProduto)->row("nome");
        
        $origem = "img/portfolio/" . $nomeAntigoDaPastaCategoria . "/". $nomeDaPastaProduto;
        $destino = "img/portfolio/" . $nomeDaNovaPastaCategoria . "/". $nomeDaPastaProduto;
        
        return array("origem" => $origem, "destino" => $destino);
    }
    
    private function renomeiaPastaProduto($idProduto, $novoNomeDoProduto) {
        //Chama model responsavel pela persistencia
        $this->load->model("ProdutoModel");
        $this->load->model("CategoriaModel");

        // Renomeia a pasta com o novo nome da categoria
        $idDaPastaCategoria = $this->ProdutoModel->getEspecificProduto($idProduto)->row('id_categoria');
        $nomeDaPastaCategoria = $this->CategoriaModel->getEspecificCategoria($idDaPastaCategoria)->row("nome");
        $nomeAntigoDaPastaProduto = $this->ProdutoModel->getEspecificProduto($idProduto)->row("nome");

        if ($nomeAntigoDaPastaProduto != $novoNomeDoProduto) {
            rename("img/portfolio/" . $nomeDaPastaCategoria . "/" . $nomeAntigoDaPastaProduto, "img/portfolio/" . $nomeDaPastaCategoria . "/" . $novoNomeDoProduto);
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
