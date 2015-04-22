<script type="text/javascript" src="<?php echo base_url(); ?>admin/js/admin/produto.js" ></script>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Produto</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Insira um novo produto
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-4 form-group-sm">
                            <?php
                            $attributes = array('id' => 'formProduto');
                            echo form_open("produto/cadastrarProduto", $attributes);
                            ?>
                            <div class="form-group">
                                <input class="form-control" id="url" value="<?php echo base_url() . "index.php/produto/excluirProduto";?>" type="hidden">
                                <input class="form-control" id="idProduto" name="idProduto" value="-1" type="hidden">
                                <!--<label>Nome Categoria</label>-->
<!--                                <select class="form-control" name="idCategoria" id="idCategoria" display="none">
                                    <?php
                                    foreach ($categoria->result() as $row) {
                                        echo "<option value='" . $row->id . "'>" . $row->nome . "</option>";
                                    }
                                    ?>
                                </select>-->
                                <br/>
                                <label>Nome Produto</label>
                                <input class="form-control" id="nomeProduto" name="nomeProduto" />
                                <p class="help-block">Exemplo: Mesa, poltrona, etc.</p>

                                <label>Status</label>
                                <select class="form-control" name="statusProduto" id="statusProduto">
                                    <option value="1">Ativo</option>
                                    <option value="0">Inativo</option>
                                </select>

                            </div>
                            <input type="button" id="botao" class="btn btn-default" value="Cadastrar" />
                            <button type="reset" class="btn btn-default">Limpar</button>
                            <?php echo form_close(); ?>
                        </div>
                        <!-- /.col-lg-6 (nested) -->

                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header"></h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Categorias Cadastradas
                                    </div>
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover" id="dataTablesIDCategoria">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Nome Categoria</th>
                                                        <th>Nome Produto</th>
                                                        <th>Status</th>
                                                        <th>Data de Registro</th>
                                                        <th>Última Modificação</th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                    <?php
                                                    foreach ($produto->result() as $produto) {

                                                        foreach ($categoria->result() as $cat) {
                                                            if ($cat->id == $produto->id_categoria) {
                                                                $idCategoria = $cat->id;
                                                                $nomeCategoria = $cat->nome;
                                                            }
                                                        }

                                                        echo "<tr class = 'odd gradeX'>" .
                                                        "<td data-id='" . $produto->id . "'>" . $produto->id . "</td>" .
                                                        "<td data-categoria='" . $idCategoria . "'>" . $nomeCategoria . "</td>" .
                                                        "<td data-nome='" . $produto->nome . "'>" . $produto->nome . "</td>" .
                                                        "<td data-status='".$produto->status."'>" . ($produto->status == 1 ? 'Ativo' : 'Inativo') . "</td>" .
                                                        "<td>" . $produto->data_criacao . "</td>" .
                                                        "<td>" . $produto->data_modificacao . "</td>" .
                                                        "<td><button class='btn-info'>Editar</button></td>" .
                                                        "<td><button class='btn-danger'>Excluir</button></td>" .
                                                        "</tr>";
                                                    }
                                                    ?>
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                    <!-- /.panel-body -->

                                </div>
                                <!-- /.panel -->
                            </div>
                            <!-- /.col-lg-12 -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
<!-- /#wrapper -->
