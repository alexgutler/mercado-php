function moeda2float(moeda){
    if(moeda == "" || moeda == undefined){
        return 0;
    }
    moeda = moeda.replaceAll(".", "");
    moeda = moeda.replace(",", ".");
    return parseFloat(moeda);
}
function float2moeda(number, decimals, dec_point, thousands_sep) {
    if (decimals == undefined){
        decimals = 2;
    }
    //decimals = casasDecimaisValor;
    dec_point  = ",";
    thousands_sep  = ".";

    number = (number + "")
        .replace(/[^0-9+\-Ee.]/g, "");
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === "undefined") ? "," : thousands_sep,
        dec = (typeof dec_point === "undefined") ? "." : dec_point,
        s = "",
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return "" + (Math.round(n * k) / k)
                .toFixed(prec);
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : "" + Math.round(n))
        .split(".");
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || "")
            .length < prec) {
        s[1] = s[1] || "";
        s[1] += new Array(prec - s[1].length + 1)
            .join("0");
    }
    return s.join(dec);
}

function formataQuantidade(number, decimals, dec_point, thousands_sep) {
    if(decimals == undefined){
        decimals = 2;
    }
    dec_point  = ",";
    thousands_sep  = ".";

    number = (number + "")
        .replace(/[^0-9+\-Ee.]/g, "");
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === "undefined") ? "," : thousands_sep,
        dec = (typeof dec_point === "undefined") ? "." : dec_point,
        s = "",
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return "" + (Math.round(n * k) / k)
                .toFixed(prec);
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : "" + Math.round(n))
        .split(".");
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || "")
            .length < prec) {
        s[1] = s[1] || "";
        s[1] += new Array(prec - s[1].length + 1)
            .join("0");
    }
    return s.join(dec);
}

$(function($) {

    $(document).on("keypress", ".mascara-num", function(e) {
        if (window.event) {
            tecla = e.keyCode;
        } else if (e.which) {
            tecla = e.which;
        }

        if ((tecla >= 48 && tecla <= 57 ) || (tecla == 8) || (tecla == 44) || (tecla == 46) || (tecla == 13) || e.ctrlKey) {
            return true;
        } else {
            return false;
        }
    });

    $(document).on("keypress", ".mascara-num_int", function(e) {
        if (window.event) {
            tecla = e.keyCode;
        } else if (e.which) {
            tecla = e.which;
        }

        if ((tecla >= 48 && tecla <= 57 ) || (tecla == 8) || (tecla == 13) || e.ctrlKey) {
            return true;
        } else {
            return false;
        }
    });

    $(document).on("keypress", ".mascara-quantidade", function(e) {
        if (window.event) {
            tecla = e.keyCode;
        } else if (e.which) {
            tecla = e.which;
        }

        if ((tecla >= 48 && tecla <= 57) || (tecla == 8 ) || (tecla == 44 ) || (tecla == 46) || (tecla == 13) || (tecla == 45) || e.ctrlKey) {
            if (tecla == 13) {
                $(this).blur();
            }
            return true;
        } else {
            return false;
        }
    });
    $(document).on("blur", ".mascara-quantidade", function(e) {
        $(this).attr("placeholder", "");
        quantidade = $(this).val();
        if (quantidade != "") {
            $(this).val( formataQuantidade(quantidade) );
            quantidade = moeda2float(quantidade);
            if ($(this).attr("casas") != undefined) {
                quantidade = formataQuantidade(quantidade, $(this).attr("casas"));
            } else {
                quantidade = formataQuantidade(quantidade);
            }
            $(this).val(quantidade);
        }
    });
    $(document).on("focus", ".mascara-quantidade", function(e) {
        var campo = $(this);
        window.setTimeout(function() {
            campo.select();
        }, 100);
        if ($(this).attr("casas") != undefined) {
            $(this).attr("placeholder", formataQuantidade(0, $(this).attr("casas")));
        } else {
            $(this).attr("placeholder", formataQuantidade(0));
        }
    });


    $(document).on("keypress", ".mascara-valor", function(e) {
        if (window.event) {
            tecla = e.keyCode;
        } else if (e.which) {
            tecla = e.which;
        }
        if ((tecla >= 48 && tecla <= 57) || (tecla == 8 ) || (tecla == 44 ) || (tecla == 46) || (tecla == 13) || (tecla == 45) || e.ctrlKey) {
            if (tecla == 13) {
                $(this).blur();
            }
            return true;
        } else {
            return false;
        }
    });
    $(document).on("blur", ".mascara-valor", function(e) {
        $(this).attr("placeholder", "");
        valor = $(this).val();
        if (valor != "") {
            $(this).val(float2moeda(valor));
            valor = moeda2float(valor);
            if ($(this).attr("casas") != undefined) {
                valor = float2moeda(valor, $(this).attr("casas"));
            } else {
                valor = float2moeda(valor);
            }
            $(this).val(valor);
        }
    });
    $(document).on("focus", ".mascara-valor", function(e) {
        if ($(this).attr("casas") != undefined) {
            $(this).attr("placeholder", float2moeda(0, $(this).attr("casas")));
        } else {
            $(this).attr("placeholder", float2moeda(0));
        }
        var campo = $(this);
        window.setTimeout(function() {
            campo.select();
        }, 100);
    });
});

$(function($) {
    console.log("APP");

    $("#btnAdicionarProduto").on("click",function() {

        var parent = $(".linha-produto").last(), // última linha adicionada
            clone = parent.clone(), // clonar a linha
            cloneIndex = clone.prop("id").replace("produtos-", ""),
            numProdutos = $(".linha-produto").length, // número de produtos
            novoIndex = (numProdutos + 1), // valor para o novo campo
            valorValido = false;

        while (!valorValido) { // validar para que o novo valor não seja repetido com nenhuma outra linha
            if ($(document).find("#produtos-" + novoIndex).length === 0)
                valorValido = true;
            else
                novoIndex++;
        }

        // ajustar o id com o índice encontrado
        clone.attr("id", "produtos-" + novoIndex);

        // ajustar campo do produto
        clone.find(".produto").attr("name", "produtos[" + novoIndex + "][produto_id]").val("")
            .attr("id", "produtos_produto-" + novoIndex);

        // ajustar campo do quantidade
        clone.find(".quantidade").attr("name", "produtos[" + novoIndex + "][quantidade]").val("")
            .attr("id", "produtos_quantidade-" + novoIndex);

        // ajustar campo do valor_unitario
        clone.find(".valor_unitario").attr("name", "produtos[" + novoIndex + "][valor_unitario]").val("")
            .attr("id", "produtos_valor_unitario-" + novoIndex);

        // ajustar campo do valor_unitario
        clone.find(".valor_total").attr("name", "produtos[" + novoIndex + "][valor_total]").val("")
            .attr("id", "produtos_valor_total-" + novoIndex);

        // inseri a nova linha no final
        clone.insertAfter( parent );
    });


    /*
    * Ao clicar para remover produto.
    * */
    $(document).on("click", ".btnRemoverProduto", function() {
        if ($(".linha-produto").length > 1) {
            var id = $(this).closest(".linha-produto").prop("id").replace("produtos-", "");
            $("#produtos-" + id).remove();
            calculaValorTotal();
        }
    });

    function calculaValorTotal() {
        var valorProdutos = 0;

        $("#produtos").find(".valor-unitario").each(function() {
            quantidade = $(this).closest(".box-produto").find(".quantidade").val();
            quantidade = (quantidade) ? moeda2float(quantidade) : 0;

            var valorUnitario = $(this).val();
            valorUnitario = (valorUnitario) ? moeda2float(valorUnitario) : 0;
            valorTotal = valorUnitario * quantidade;

            $(this).closest(".box-produto").find(".valor-total").val( float2moeda(valorTotal) );

            valorProdutos += valorTotal;
        });

        // $("#valor_total_produtos").val( float2moeda(valorProdutos) );
    }
});