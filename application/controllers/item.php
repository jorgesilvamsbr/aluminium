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

    public function cadastrarItem() {
        $this->load->model('ItemModel');
        $this->load->model('ProdutoModel');
        $this->load->model('CategoriaModel');

        //Define a zona para captura da data
        date_default_timezone_set('America/Sao_Paulo');

        $data['id_produto'] = $this->input->post('idProduto');
        $data['nome'] = $this->removeAscento($this->input->post('nomeItem'));
        $data['descricao'] = $this->input->post('descricaoItem');
        $data['status'] = $this->input->post('statusItem');
        $data['data_criacao'] = date('Y-m-d H:i');

        $arquivos = $_FILES["filename"];
        $quantidadeDeImagens = count($arquivos["name"]);

        $this->ItemModel->setItem($data);
        $this->inserirImagem($data, $quantidadeDeImagens, $arquivos);
    }

    private function inserirImagem($data, $quantidadeDeImagens, $arquivos) {
        $this->load->helper('url');
        $this->load->model('ItemModel');
        $this->load->model('ProdutoModel');
        $this->load->model('CategoriaModel');

        // Caminho de onde a imagem ficará
        $idItem = $this->ItemModel->getUltimoItem()->row('id');
        $pastaItem = $this->criarPastaDoItem($idItem, $data['id_produto']);

        for ($i = 0; $i < $quantidadeDeImagens; $i++) {

            // Aplica as configurações do arquivo
            $config = $this->aplicaConfiguracoesDoArquivo($arquivos, $pastaItem, $i);

            $this->load->library('upload', $config);

            // Realiza o upload do arquivo
            if (!$this->upload->do_upload()) {
                header('Location:' . base_url() . 'index.php/item?error=' . urlencode("Bugou! :/ Imagem inválida" . "<br>" . $this->upload->display_errors()));
                exit();
            } else {
                // Realiza o upload do arquivo
                $this->upload->data();

                $data = array('upload_data' => $this->upload->data());
                foreach ($data as $item) {

                    // Persiste a imagem na tabela "imagem_item"
                    $nomeDaImagemDoItem = md5(uniqid(time())) . "" . $item['file_ext'];
                    $this->cadastraImagemItem($nomeDaImagemDoItem, $idItem);

                    rename($pastaItem . "" . $item['file_name'], $pastaItem . $nomeDaImagemDoItem);
                }
            }
        }
        header('Location:' . base_url() . 'index.php/item?succsses=' . urlencode('Cadastro Realizado com sucesso!'));
    }

    private function cadastraImagemItem($nomeDaImagemDoItem, $idItem) {
        $this->load->model('ItemModel');

        //Define a zona para captura da data
        date_default_timezone_set('America/Sao_Paulo');

        $data['id_item'] = $idItem;
        $data['nome'] = $nomeDaImagemDoItem;
        $data['data_insercao'] = date('Y-m-d H:i');

        $this->ItemModel->setImagensItem($data);
    }

    private function criarPastaDoItem($idItem, $id_produto) {
        $this->load->model('ItemModel');
        $this->load->model('ProdutoModel');
        $this->load->model('CategoriaModel');

        // Caminho de onde a imagem ficará
        $nomeProdutoItem = $this->ProdutoModel->getEspecificProduto( $id_produto )->row('nome');
        $idCategoriaItem = $this->ProdutoModel->getEspecificProduto( $id_produto )->row('id_categoria');
        $nomeCategoriaItem = $this->CategoriaModel->getEspecificCategoria($idCategoriaItem)->row('nome');
        
        $pastaItem = "img/portfolio/" . $nomeCategoriaItem . "/" . $nomeProdutoItem . "/" . $idItem;

        mkdir($pastaItem);

        return $pastaItem .= "/";
    }

    private function aplicaConfiguracoesDoArquivo($arquivos, $pastaItem, $i) {
        $_FILES['userfile']['name'] = $arquivos['name'][$i];
        $_FILES['userfile']['type'] = $arquivos['type'][$i];
        $_FILES['userfile']['tmp_name'] = $arquivos['tmp_name'][$i];
        $_FILES['userfile']['error'] = $arquivos['error'][$i];
        $_FILES['userfile']['size'] = $arquivos['size'][$i];

        //Configurações da imagem
        $config['upload_path'] = $pastaItem;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '3000';
        $config['max_width'] = '10000';
        $config['max_height'] = '38000';

        return $config;
    }

    public function excluirItem() {
        $this->load->model("ItemModel");
        $idItem = 6;//$this->input->post("idItem");
        $idDoProdutoDoItem = 7;//$this->input->post("idDoProdutoDoItem");
        
        $item = $this->ItemModel->getEspecificItem($idItem);

        $this->ItemModel->deleteImagensItem($item->row('id'));
        $this->ItemModel->deleteItem($item->row('id'));
        
        $diretorio = $this->criarPastaDoItem( $idItem, $idDoProdutoDoItem );
        
        $this->delTree( $diretorio );
        
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
