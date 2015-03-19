<script type="text/javascript" src="<?php echo base_url(); ?>admin/js/admin/categoria.js" ></script>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Categoria</h1>
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
                        <div class="col-lg-6">
                            <?php
                            $attributes = array('id' => 'formCadastro');
                            echo form_open("admin/cadastrarCategoria", $attributes);
                            ?>
                            <div class="form-group">
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
                            <!--                                <div class="form-group">
                                                                <label>Text Input with Placeholder</label>
                                                                <input class="form-control" placeholder="Enter text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Static Control</label>
                                                                <p class="form-control-static">email@example.com</p>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>File input</label>
                                                                <input type="file">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Text area</label>
                                                                <textarea class="form-control" rows="3"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Checkboxes</label>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" value="">Checkbox 1
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Inline Checkboxes</label>
                                                                <label class="checkbox-inline">
                                                                    <input type="checkbox">1
                                                                </label>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Radio Buttons</label>
                                                                <div class="radio">
                                                                    <label>
                                                                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>Radio 1
                                                                    </label>
                                                                </div>
                                                                <div class="radio">
                                                                    <label>
                                                                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Radio 2
                                                                    </label>
                                                                </div>
                                                                <div class="radio">
                                                                    <label>
                                                                        <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">Radio 3
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Inline Radio Buttons</label>
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline1" value="option1" checked>1
                                                                </label>
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline2" value="option2">2
                                                                </label>
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline3" value="option3">3
                                                                </label>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Multiple Selects</label>
                                                                <select multiple class="form-control">
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                    <option>4</option>
                                                                    <option>5</option>
                                                                </select>
                                                            </div>
                            -->
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
                                                        <!--<th>Editar</th>-->
                                                        <!--<th>Excluir</th>-->
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
                                                    "<td><button class='btn-info'>Editar</button>" .
                                                    "<td><button class='btn-danger'>Excluir</button>" .
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
