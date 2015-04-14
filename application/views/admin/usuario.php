<script type="text/javascript" src="<?php echo base_url(); ?>admin/js/admin/usuario.js" ></script>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Cadastro de Usuários</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Cadastrar usuário
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <?php
                            $attributes = array('id' => 'formCadastro');
                            echo form_open("usuario/salvarUsuario", $attributes);
                            ?>
                            <div class="form-group">
                                <input class="form-control" id="url" value="<?php echo base_url() . "index.php/usuario/excluirUsuario"; ?>" type="hidden">
                                <input class="form-control" name="idUsuario" id="idUsuario" value="-1" type="hidden">

                                <label>Nome do usuário</label>
                                <input class="form-control" type="text" id="nome" name="nome" />
                                <label>Login</label>
                                <input class="form-control" type="text" id="login" name="login" />
                                <label>Senha</label>
                                <input class="form-control" type="password" id="senha" name="senha" />
                                <label>Confirme a senha</label>
                                <input class="form-control" type="password" id="contraSenha" name="contraSenha" />

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
                                                        <th>Id</th>
                                                        <th>Nome</th>
                                                        <th>Login</th>
                                                        <th>Último Login</th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                        <?php
                                                        foreach ($usuario->result() as $usuario) {
                                                            echo "<tr class='odd gradeX'>" .
                                                            "<td data-id='" . $usuario->id . "'>" . $usuario->id . "</td>" .
                                                            "<td data-nome='" . $usuario->nome . "'>" . $usuario->nome . "</td>" .
                                                            "<td data-login='" . $usuario->login . "'>" . $usuario->login . "</td>" .
                                                            "<td>" . $usuario->data_ultimo_acesso . "</td>" .
                                                            "<td><button class='btn-info'>Editar</button></td>" .
                                                            "<td><button class='btn-danger'>Excluir</button></td>" .
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
