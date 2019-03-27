<?php
   function chaveUnica(){
        return md5(uniqid(rand(), true));
    }
    $fingerprint = chaveUnica();
?>
<!DOCTYPE html>
<html lang="">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Checkout</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
      <script type="text/javascript" src="https://alpha.monetizze.com.br/checkout/transparente/js?ctk=b6p4zNiGXJaCSUCA3uZgUixRBsNzpooQ&referencia=PZA34484"></script>
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="css/custom.css">
   </head>
   <body>
      <div class="topo">
         <div class="container">
            <div class="row text-center">
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <img src="imgs/imagemtopo.jpg">
               </div>
            </div>
            <div class="row text-left">
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <p>Vendedor: Quitoplan - Whatsapp (21) 95903-0021</p>
               </div>
            </div>
         </div>
      </div>
      <div class="content">
         <div class="container">
            <div class="row">
               <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                  <img class="siteseguro" src="imgs/siteblindado.jpg">
                  <form data-toggle="validator" id="ajax-comprar" method="post" action="processar.php">
                     <input type="hidden" value="<?=$fingerprint?>" id="fingerprint" name="fingerprint">
                     <div class="box-title">
                        <h3>1 - Dados cadastrais</h3>
                     </div>
                     <div class="box-dados">
                        <label for="nome">Nome Completo</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome completo">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email">
                        <div class="row">
                           <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                              <label for="celular">Celular com DDD</label>
                              <input type="text" class="form-control" id="tel" name="tel">
                           </div>
                           <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                              <label for="cnpj_cpf">CPF ou CNPJ</label>
                              <input type="text" class="form-control" id="cnpj_cpf" name="cnpj_cpf" placeholder="Digite seu cpf ou cnpj">
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                              <label for="cep">CEP</label>
                              <input type="text" class="form-control" id="cep" name="cep" placeholder="Digite seu CEP">
                              <p class="cep-error-message">CEP inválido, digite novamente.</p>
                           </div>
                        </div>
                        <div class="row">
                           <div id="ceploaded" style="display: none;">
                              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                 <label for="endereco">Endereço</label>
                                 <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Digite seu Endereço">
                              </div>
                              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                 <label for="numero">Numero</label>
                                 <input type="text" class="form-control" id="numero" name="numero">
                              </div>
                              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                 <label for="complemento">Complemento</label>
                                 <input type="text" class="form-control" id="complemento" name="complemento">
                              </div>
                              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                 <label for="bairro">Bairro</label>
                                 <input type="text" class="form-control" id="bairro" name="bairro" placeholder="bairro">
                              </div>
                              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                 <label for="bairro">Cidade</label>
                                 <input type="text" class="form-control" id="cidade" name="cidade" placeholder="cidade">
                              </div>
                              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                 <label for="estado">Estado</label>
                                 <input type="text" class="form-control" id="estado" name="estado" placeholder="estado">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="box-title">
                        <h3>2 - Selecionar Pagamento</h3>
                     </div>
                     <div class="box-dados">
                        <div class="row">
                           <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-left">
                              <div class="custom-control custom-radio custom-control-inline">
                                 <input type="radio" id="meio_pagamento_cartao" name="meio_pagamento" class="custom-control-input">
                                 <label class="custom-control-label" for="meio_pagamento_cartao">Cartão de Crédito</label>
                              </div>
                           </div>
                           <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                              <div class="custom-control custom-radio custom-control-inline">
                                 <input type="radio" id="meio_pagamento_boleto" name="meio_pagamento" class="custom-control-input">
                                 <label class="custom-control-label" for="meio_pagamento_boleto">Boleto Bancário</label>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                              <div id="cartao">
                                 <div class='card-wrapper'></div>
                                 <label for="CreditCardNumber">Número do Cartão</label>
                                 <input type="text" class="form-control" id="CreditCardNumber" name="CreditCardNumber" placeholder="Número do Cartão">
                                 <label for="NameOnCard">Nome impresso no cartão</label>
                                 <input type="text" class="form-control" id="NameOnCard" name="NameOnCard" placeholder="Nome Impresso no Cartão">
                                 <div class="row">
                                    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
                                       <label for="ExpiryDate_month">Validade</label>
                                       <select name="ExpiryDate_month" id="ExpiryDate_month" class="form-control">
                                       </select>
                                    </div>
                                    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
                                       <select name="ExpiryDate_year" id="ExpiryDate_year" class="form-control"></select>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                       <label for="SecurityCode">CVV</label>
                                       <input type="text" class="form-control" id="SecurityCode" name="SecurityCode" placeholder="CVV">
                                    </div>
                                 </div>
                                 <label for="parcelamento">Parcelamento</label>
                                 <select id="parcelamento" class="form-control" name="parcelamento"></select>
                                 <input type="hidden" id="bandCartao" name="bandCartao">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                              <div id="boleto">
                                 <img src="imgs/boleto.png">
                                 <ol>
                                    <li>Boleto (somente à vista)</li>
                                    <li>Pagamentos com Boleto Bancário levam até 3 dias úteis para serem compensados e então terem os produtos liberados</li>
                                    <li>Depois do pagamento, fique atento ao seu e-mail para receber os dados de acesso ao produto (verifique também a caixa de SPAM)</li>
                                 </ol>
                              </div>
                           </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-lg btn-block">COMPRAR</button>
                     </div>
               </div>
               </form>
               <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                  <img src="imgs/sidebar.jpg">
               </div>
            </div>
         </div>
      </div>
      <script type="text/javascript" src="//s3.amazonaws.com/alphamonetizze/js/jquery.min.js"></script>
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- <script src="js/validator.min.js"></script> -->
      <script src="js/jquery.mask.min.js"></script>
      <script src="js/jquery.card.js"></script>
      <script src="js/checkout.js"></script>
      <script src="https://h.online-metrix.net/fp/tags.js?org_id=1snn5n9w&session_id=monetizze<?php echo $fingerprint; ?>" type="text/javascript"></script>
   </body>
</html>