<script type="text/javascript" src="<?php echo base_url(); ?>admin/js/admin/slider.js" ></script>
<!--<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>-->
<!--<script>
$("#filename0").change(function(){
    alert("atesasf");
    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#view-img').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    }
});
</script>-->

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
                    Insira um novo slider
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group">

                            <?php
                            $attributes = array('id' => 'formItem');
                            echo form_open_multipart("slider/cadastrarItem", $attributes);
                            ?>
                            <input type='hidden' id='count' name='count' value ='0'>
                            <input class="form-control" id="idItem" value="-1" type="hidden">
                            <input class="form-control" id="url" value="<?php echo base_url() . "index.php/item/excluirItem"; ?>" type="hidden">

                            <div class="col-lg-5 form-group">
                                <label>Selecione as imagens</label>
                                <div class='form-inline'>
                                    <!--<input id="imgInput" type="file" >-->
                                    <input type="file" class="form-control" id="filename0" name="filename0[]">
                                    <input type="button" id="botaoMais" onclick="maisImagens();" class="btn btn-primary" value="+ Mais" />
                                    <input type="file" class="form-control" id="filename1" name="filename0[]" multiple>
                                    <input type="file" class="form-control" id="filename2" name="filename0[]" multiple>
                                    <input type="file" class="form-control" id="filename3" name="filename0[]" multiple>
                                    <p class="help-block">Somente imagens: jpeg, png. Dimensão recomendada: 1920 x 480 pixels</p>
                                    <div id='imagensUpload'>

                                    </div>
                                </div>
                                <input type="button" id="botao" class="btn btn-default" value="Cadastrar" />
                                <button type="reset" class="btn btn-default">Limpar</button>

                                <div id="uploadItemTeste"> </div>
                            </div>
                            <!--<img id="view-img" src="<?php // echo base_url() . "img/homepage-slider/slide3.png";   ?>">-->
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
                                        Imagens Cadastradas
                                    </div>
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">
                                        <div class="table-responsive">

                                            <input type="hidden" value="<?php echo base_url(); ?>" id="base_url"/>
                                            <?php
//                                                $count = 1;
                                            foreach ($slider->result() as $img) {
                                                echo "<div class='col-lg-6 form-group'>";
                                                echo "<div class='col-lg-3 form-group'><strong>Escolher </strong>";
                                                echo "<input id='slider" . $img->id . "' type='checkbox'/></div>";
                                                echo "<div class='col-lg-3 form-group'><button class='btn-danger' onclick='excluirSlider(" . $img->id . ")'>X - Excluir</button></div>";
                                                echo "<img style='max-width: 100%;' id='view-img' src='" . base_url() . "img/homepage-slider/" . $img->nome . "'>";
                                                echo "</div>";
//                                                   if($count >= 3)
//                                                       break;
//                                                   $count++;
                                            }
                                            ?>
                                            <div class='col-lg-12 form-group'>
                                                <hr/>   
                                                <input type="button" id="botao" class="btn btn-primary" value="Salvar" />
                                            </div>
<!--                                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                <thead>
                                                    <tr>
                                                        <th>Id Produto</th>
                                                        <th>Id do Item</th>
                                                        <th>Nome do Item</th>
                                                        <th>Status</th>
                                                        <th>Data de Registro</th>
                                                        <th>Última Modificação</th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>  
                                            <?php
                                            foreach ($item->result() as $item) {
                                                echo "<tr class = 'odd gradeX'>" .
                                                "<td>" . $item->id_produto . "</td>" .
                                                "<td data-id='" . $item->id . "'>" . $item->id . "</td>" .
                                                "<td data-nome='" . $item->nome . "'>" . $item->nome . "</td>" .
                                                "<td>" . ($item->status == 1 ? 'Ativo' : 'Inativo') . "</td>" .
                                                "<td>" . $item->data_criacao . "</td>" .
                                                "<td>" . $item->data_modificacao . "</td>" .
                                                "<td><button class='btn-info'>Editar</button></td>" .
                                                "<td><button class='btn-danger'>Excluir</button></td>" .
                                                "</tr>";
                                            }
                                            ?>
                                                </tbody>
                                            </table>-->
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
                        <!--                        <div class="col-lg-6">
                                                    <h1>Disabled Form States</h1>
                                                    <form role="form">
                                                        <fieldset disabled>
                                                            <div class="form-group">
                                                                <label for="disabledSelect">Disabled input</label>
                                                                <input class="form-control" id="disabledInput" type="text" placeholder="Disabled input" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="disabledSelect">Disabled select menu</label>
                                                                <select id="disabledSelect" class="form-control">
                                                                    <option>Disabled select</option>
                                                                </select>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox">Disabled Checkbox
                                                                </label>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Disabled Button</button>
                                                        </fieldset>
                                                    </form>
                                                    <h1>Form Validation States</h1>
                                                    <form role="form">
                                                        <div class="form-group has-success">
                                                            <label class="control-label" for="inputSuccess">Input with success</label>
                                                            <input type="text" class="form-control" id="inputSuccess">
                                                        </div>
                                                        <div class="form-group has-warning">
                                                            <label class="control-label" for="inputWarning">Input with warning</label>
                                                            <input type="text" class="form-control" id="inputWarning">
                                                        </div>
                                                        <div class="form-group has-error">
                                                            <label class="control-label" for="inputError">Input with error</label>
                                                            <input type="text" class="form-control" id="inputError">
                                                        </div>
                                                    </form>
                                                    <h1>Input Groups</h1>
                                                    <form role="form">
                                                        <div class="form-group input-group">
                                                            <span class="input-group-addon">@</span>
                                                            <input type="text" class="form-control" placeholder="Username">
                                                        </div>
                                                        <div class="form-group input-group">
                                                            <input type="text" class="form-control">
                                                            <span class="input-group-addon">.00</span>
                                                        </div>
                                                        <div class="form-group input-group">
                                                            <span class="input-group-addon"><i class="fa fa-eur"></i>
                                                            </span>
                                                            <input type="text" class="form-control" placeholder="Font Awesome Icon">
                                                        </div>
                                                        <div class="form-group input-group">
                                                            <span class="input-group-addon">$</span>
                                                            <input type="text" class="form-control">
                                                            <span class="input-group-addon">.00</span>
                                                        </div>
                                                        <div class="form-group input-group">
                                                            <input type="text" class="form-control">
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-default" type="button"><i class="fa fa-search"></i>
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </form>
                                                </div>-->
                        <!-- /.col-lg-6 (nested) -->
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
