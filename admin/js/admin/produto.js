//Realiza a validação dos campos em branco
$(document).ready(function () {
    $("#botao").click(function () {
        var cont = 0;
        $("#formProduto input").each(function () {
            if ($(this).val() === "")
            {
                $(this).css({"border": "1px solid #F00", "padding": "2px"});
                cont++;
            }
        });
        if (cont === 0)
        {
            $("#formProduto").submit();
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
        var categoria = $(this).closest('tr').find('td[data-categoria]').data('categoria');

        $(this).val($("#idProduto").val(id));
        $(this).val($("#nomeProduto").val(nome));
        $("#statusProduto option[value='" + status + "']").attr("selected", true);
        $("#idCategoria option[value='" + categoria + "']").attr("selected", true);
        $("#formProduto").attr("action", "../index.php/produto/editarProduto");
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
        
        if (confirm("Tem certeza que deseja excluir o produto: " + nome + "?")) {

            $.ajax({
                type: "post",
                data: {idProduto: id},
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
    $('#dataTablesIDProduto').dataTable();
});
