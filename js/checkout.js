// Carrega o Cartão de crédito como default e Muda o meio de pagamento
$(document).ready(function(){
    var meio_pagamento = $( "#meio_pagamento_cartao" );
    meio_pagamento.prop( "checked", true );
    meio_pagamento.val("cartao");
    $("#boleto").hide();
});

$('#meio_pagamento_cartao').click(function(){
    var meio_pagamento = $( "#meio_pagamento_cartao" );
    meio_pagamento.prop( "checked", true );
    meio_pagamento.val("cartao");
    $("#meio_pagamento_boleto").val('');
    $("#cartao").show("fadeIn");
    $("#boleto").hide("fadeOut");
});

$('#meio_pagamento_boleto').click(function(){
    var meio_pagamento = $( "#meio_pagamento_boleto" );
    meio_pagamento.prop( "checked", true );
    meio_pagamento.val("boleto");
    $("#meio_pagamento_cartao").val('');
    $("#boleto").show("fadeIn");
    $("#cartao").hide("fadeOut");
});

// Pega a bandeira do cartão
document.addEventListener('DOMContentLoaded', function(event) { 
    document.getElementsByName('CreditCardNumber')[0].addEventListener('payment.cardType', function(cartao) {
        $('#bandCartao').val(cartao.detail);
    });
});

// Envia os dados para a Monetizze
$('#ajax-comprar').on('submit', function(e) {
    e.preventDefault();
    var meio_pagamento;
    var fingerprint = $('#fingerprint').val();
    if($('#meio_pagamento_cartao').is(':checked')) { meio_pagamento = 'cartao'; }
    if($('#meio_pagamento_boleto').is(':checked')) { meio_pagamento = 'boleto'; }
    var dados = {
        //chave_checkout: chave_checkout,
        fingerprint: fingerprint,
        meio_pagamento: meio_pagamento,
        nome: $('#nome').val(),
        email: $('#email').val(),
        tel: $('#tel').val(),
        cnpj_cpf: $('#cnpj_cpf').val(),
        cep: $('#cep').val(),
        endereco: $('#endereco').val(),
        numero: $('#numero').val(),
        complemento: $('#complemento').val(),
        bairro: $('#bairro').val(),
        cidade: $('#cidade').val(),
        estado: $('#estado').val(),
        CreditCardNumber: $('#CreditCardNumber').val(),
        NameOnCard: $('#NameOnCard').val(),
        ExpiryDate_month: $('#ExpiryDate_month').val(),
        ExpiryDate_year: $('#ExpiryDate_year').val(),
        SecurityCode: $('#SecurityCode').val(),
        parcelamento: $('#parcelamento').val(),
        bandCartao: $('#bandCartao').val(),
    }
    console.log(dados);
    $.ajax({
        type: "POST",
        async: "true",
        url: "http://localhost:3000/processar.php",
        data: dados,
        dataType: "json"
    }).done(function(dados) {
        if (dados.status == 1) {
            alert(dados.obrigado);
        } else {
            alert(dados.msg);
        }
    }).fail(function(jqXHR, textStatus) {
        alert(jqXHR);
    });
    return false;
});

// Insere ano da validade do cartao 10 anos pra frente
$(document).ready(function(){
    var lastYear = (new Date).getFullYear() + 11;
    var currentYear = (new Date).getFullYear();
    while(currentYear <= lastYear){
        var ExpiryYears = {expiry_year : currentYear++}
        var select = $(`#ExpiryDate_year`);
        select.append(
            $('<option>')
            .text(ExpiryYears.expiry_year)
            .val(ExpiryYears.expiry_year)
        );
    }
});

// Insere todos os Meses do Ano
$(document).ready(function(){
    var select = $(`#ExpiryDate_month`);
    select.append(new Option("Janeiro", "01"));
    select.append(new Option("Fevereiro", "02"));
    select.append(new Option("Março", "03"));
    select.append(new Option("Abril", "04"));
    select.append(new Option("Maio", "05"));
    select.append(new Option("Junho", "06"));
    select.append(new Option("Julho", "07"));
    select.append(new Option("Agosto", "08"));
    select.append(new Option("Setembro", "09"));
    select.append(new Option("Outubro", "10"));
    select.append(new Option("Novembro", "11"));
    select.append(new Option("Dezembro", "12"));
});


// Pega o valor do produto parcelado na Monetizze
$(document).ready(function() {
    $.ajax({     
        type: "POST",
             async: "true",
             url: "https://alpha.monetizze.com.br/checkout/transparente/parcelamento",
             data: "ctk=b6p4zNiGXJaCSUCA3uZgUixRBsNzpooQ&referencia=PZA34484&valor=1000.00&maxParcelas=12",
             dataType: "json"    
    }).done(function(dados) {
        if (dados.status == 1) {    
            var options = ``;
            if (dados.parcelas) {
                var select = $(`#parcelamento`);
                dados.parcelas.map(parcela => {
                    select.append($('<option>')
                        .text(`${parcela.parcela} x de R$${parcela.valorFormatado}`)
                        .val(`${parcela.parcela}_${parcela.valor}`));
                });
            }
        } else {        
            alert('erro');    
        }    
    });
});

// Completa o endereço de acordo com o cep digitado
$(document).ready(function() {
    $('.cep-error-message').hide();
    function limpa_formulário_cep() {
        $("#endereco").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#estado").val("");
    }
    $("#cep").keyup(function() {
        if( this.value.length == 9 ){
            var cep = $(this).val().replace(/\D/g, '');
            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {
                if (!("erro" in dados)) {
                    $("#endereco").val(dados.logradouro);
                    $("#bairro").val(dados.bairro);
                    $("#cidade").val(dados.localidade);
                    $("#estado").val(dados.uf);
                    $("#cep").removeClass("has-error");
                    $('.cep-error-message').hide();
                    $("#ceploaded").show("fadeIn");
                    $("#numero").focus();
                } else {
                    limpa_formulário_cep();
                    $("#cep").addClass("has-error");
                    $('.cep-error-message').show();
                }
            });   
        }
    });
});

// Máscara dos inputs Js Mask
$(document).ready(function(){
  $('#cep').mask('00000-000');
  $('#tel').mask('(00) 00000-0000');
});

$("#cnpj_cpf").keydown(function(){
    try {
        $("#cnpj_cpf").unmask();
    } catch (e) {}
    var tamanho = $("#cnpj_cpf").val().length;
    if(tamanho < 11){
        $("#cnpj_cpf").mask("000.000.000-00");
    } else if(tamanho >= 11){
        $("#cnpj_cpf").mask("00.000.000/0000-00");
    }
    var elem = this;
    setTimeout(function(){
        elem.selectionStart = elem.selectionEnd = 10000;
    }, 0);
    var currentValue = $(this).val();
    $(this).val('');
    $(this).val(currentValue);
});

// Cart Checkout
$('form').card({
    container: '.card-wrapper',
});