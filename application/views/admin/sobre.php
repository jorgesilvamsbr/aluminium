<script type="text/javascript" src="<?php echo base_url(); ?>admin/js/admin/sobre.js" ></script>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Sobre</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Inserir nova descrição da história da empresa
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <?php
                            $attributes = array('id' => 'formCadastro');
                            echo form_open("sobre/salvarSobre", $attributes);
                            ?>
                            <div class="form-group">
                                <input class="form-control" id="url" value="<?php echo base_url() . "index.php/categoria/excluirCategoria"; ?>" type="hidden">
                                <input class="form-control" id="idCategoria" value="-1" type="hidden">

                                <label>Descrição da Empresa</label>
                                <textarea class="form-control" name="sobre" id="sobre" cols="150" rows="15" placeholder="Escreva aqui sua descrição"></textarea>
                            </div>
                            <input type="button" id="botao" name="botao" class="btn btn-default" value="Cadastrar" />
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
                                                        <th>Sobre</th>
                                                        <th>Última Modificação</th>
                                                        <th>Úsuário da Modificação</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                        <?php
                                                        foreach ($sobre->result() as $sobre) {
                                                            echo "<tr class='odd gradeX'>" .
                                                            "<td data-sobre='" . $sobre->sobre . "'>" . $sobre->sobre . "</td>" .
                                                            "<td>" . $sobre->data_edicao . "</td>" .
                                                            "<td>" . $sobre->usuario_edicao . "</td>" .
                                                            "<td><button class='btn-info'>Editar</button></td>" .
                                                            "</tr>";
                                                        }
                                                        ?>
                                                    
                                                </tbody>
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
