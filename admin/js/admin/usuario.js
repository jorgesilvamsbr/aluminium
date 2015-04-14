//Realiza a validação dos campos em branco
$(document).ready(function () {
    $("#botao").click(function () {
        var cont = 0;
        $("#formCadastro input").each(function () {
            if ($(this).val() === "")
            {
                $(this).css({"border": "1px solid #F00", "padding": "2px"});
                cont++;
            }
        });
        if ($("#senha").val() === $("#contraSenha").val()) {
            if (cont === 0)
            {
                $("#formCadastro").submit();
            } else {
                alert("Preencha os campos em vermelho!");
            }
        } else {
            alert("As senhas não conferem!");
        }

    });

});

// Captura o valor do id para a edição
$(function () {
    $(document).on('click', '.btn-info', function (e) {
        e.preventDefault;
        var id = $(this).closest('tr').find('td[data-id]').data('id');
        var nome = $(this).closest('tr').find('td[data-nome]').data('nome');
        var login = $(this).closest('tr').find('td[data-login]').data('login');

        $(this).val($("#idUsuario").val(id));
        $(this).val($("#nome").val(nome));
        $(this).val($("#login").val(login));
        $("#formCadastro").attr("action", "../index.php/usuario/editarUsuario");
        $('html,body').animate({scrollTop: 0}, 'fast');
    });
});


// Captura o valor do id para a exclusão
$(function () {
    $(document).on('click', '.btn-danger', function (e) {
        e.preventDefault;

        var id = $(this).closest('tr').find('td[data-id]').data('id');
        var nome = $(this).closest('tr').find('td[data-nome]').data('nome');
        var url = $("#url").val();
        
        if (confirm("Tem certeza que deseja excluir a categoria: " + nome + "?")) {

            $.ajax({
                type: "post",
                data: {idUsuario: id},
                url: url,
                success: function () {

                    $('html,body').animate({scrollTop: 0}, 'fast');
                    window.location.href = window.location.href;

                },
                error: function () {
                    alert("Calma calma não criemos pânico!\nNossos minions ja estão trabalhando na solução do problema.");
                }
            });

        }

    });
});

$(document).ready(function () {
    $('#dataTablesIDCategoria').dataTable();
});
