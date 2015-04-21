<!-- Page Title -->
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Fale conosco</h1>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-sm-7">
                <!-- Map -->
                <div id="contact-us-map">

                </div>
                <!-- End Map -->
                <!-- Contact Info -->
                <p class="contact-us-details">
                    <b>Endereço:</b> Rua Treze de Maio, 1123, Centro - Campo Grande - MS<br/>
                    <b>CEP:</b> 79004-423<br/>
                    <b>Telefone:</b> (67) 3042-4400<br/>
                    <b>Email:</b> <a href="mailto:contato@aluminiumcenter.com.br">contato@aluminiumcenter.com.br</a>
                </p>
                <!-- End Contact Info -->
            </div>
            <div class="col-sm-5">
                <!-- Contact Form -->
                <h3>Fale Conosco</h3>
                <div class="contact-form-wrapper">
                    <form class="form-horizontal" role="form" action='enviaEmail'>
                        <div class="form-group">
                            <label for="Name" class="col-sm-3 control-label"><b>Nome</b></label>
                            <div class="col-sm-9">
                                <input class="form-control" id="Name" name="name" type="text" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="contact-email" class="col-sm-3 control-label"><b>Email</b></label>
                            <div class="col-sm-9">
                                <input class="form-control" id="contact-email" name="email" type="text" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="contact-message" class="col-sm-3 control-label"><b>Assunto</b></label>
                            <div class="col-sm-9">
                                <select class="form-control" id="prependedInput">
                                    <option>Selecione...</option>
                                    <option>Orçamento</option>
                                    <option>Contato</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="contact-message" class="col-sm-3 control-label"><b>Mensagem</b></label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="5" id="contact-message" name="message"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" class="btn pull-right">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- End Contact Info -->
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url() . 'js/template.js' ?>"></script>