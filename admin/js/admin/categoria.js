
$(document).ready(function () {
    $("#botao").click(function () {
        var cont = 0;
        $("#formCadastro input").each(function () {
            if ($(this).val() == "")
            {
                $(this).css({"border": "1px solid #F00", "padding": "2px"});
                cont++;
            }
        });
        if (cont == 0)
        {
            $("#formCadastro").submit();
        } else {
            alert("Preencha os campos em vermelho!");
        }
    });

});

// Captura o valor do id para a edição
$(function () {
    $(document).on('click', '.btn-info', function (e) {
        e.preventDefault;
        var id = $(this).closest('tr').find('td[data-id]').data('id');
        var nome = $(this).closest('tr').find('td[data-nome]').data('nome');
        var status = $(this).closest('tr').find('td[data-status]').data('status');

        $(this).val($("#idCategoria").val(id));
        $(this).val($("#nomeCategoria").val(nome));
        $("#statusCategoria option[value='" + status + "']").attr("selected", true);
        $("#formCadastro").attr("action", "../../index.php/admin/editarCategoria");
        $('html,body').animate({scrollTop: 0}, 'fast');
    });
});


// Captura o valor do id para a exclusão
$(function () {
    $(document).on('click', '.btn-danger', function (e) {
        e.preventDefault;

        var id = $(this).closest('tr').find('td[data-id]').data('id');
        var nome = $(this).closest('tr').find('td[data-nome]').data('nome');

        if (confirm("Tem certeza que deseja excluir a categoria: " + nome + "?")) {

            $.ajax({
                type: "post",
                data: {idCategoria: id},
                url: "../../index.php/admin/excluirCategoria",
                success: function () {

//                                history.go(0);
                    $('html,body').animate({scrollTop: 0}, 'fast');
                    window.location.href = window.location.href;

                },
                error: function () {
                    alert("erro");
                }
            });

        }

    });
});

$(document).ready(function () {
    $('#dataTablesIDCategoria').dataTable();
});
