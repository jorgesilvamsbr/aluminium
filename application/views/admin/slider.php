<script type="text/javascript" src="<?php echo base_url(); ?>admin/js/admin/categoria.js" ></script>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Slider</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Insira uma nova categoria
                </div>
                <div class="panel-body">
                    <div class="row">
                        <label>Selecione as imagens</label>
                        <input type="file" class="form-control" id="filename" name="filename[]" multiple>
                        <p class="help-block">Somente imagens: jpeg, png.</p>
                        
                        <div class="col-lg-6">
                            <?php
                            $attributes = array('id' => 'formCadastro');
                            echo form_open("slider/cadastrarCategoria", $attributes);
                            ?>
                            <div class="form-group">
                                <input class="form-control" id="url" value="<?php echo base_url() . "index.php/categoria/excluirCategoria"; ?>" type="hidden">
                                <input class="form-control" id="idCategoria" value="-1" type="hidden">

                                <label>Nome Categoria</label>
                                <input class="form-control" id="nomeCategoria" name="nomeCategoria">
                                <p class="help-block">Examplo: Sala, Cozinha, etc.</p>

                                <label>Status</label>
                                <select class="form-control" name="statusCategoria" id="statusCategoria">
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
                                                        <th>Nome</th>
                                                        <th>Status</th>
                                                        <th>Data de Registro</th>
                                                        <th>Última Modificação</th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <!--<tbody>-->  
                                                <?php
                                                foreach ($query->result() as $categoria) {
                                                    echo "<tr class = 'odd gradeX'>" .
                                                    "<td data-id='" . $categoria->id . "'>" . $categoria->id . "</td>" .
                                                    "<td data-nome='" . $categoria->nome . "'>" . $categoria->nome . "</td>" .
                                                    "<td data-status='" . $categoria->status . "'>" . ($categoria->status == 1 ? 'Ativo' : 'Inativo') . "</td>" .
                                                    "<td>" . $categoria->data_criacao . "</td>" .
                                                    "<td>" . $categoria->data_modificacao . "</td>" .
                                                    "<td><button class='btn-info'>Editar</button></td>" .
                                                    "<td><button class='btn-danger'>Excluir</button></td>" .
                                                    "</tr>";
                                                }
                                                ?>
                                                <!--</tbody>-->
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
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
