<?php
	$url = 'https://alpha.monetizze.com.br/checkout/transparente/processar';
	$key = 'c1dhKqfIpIJozgq2oLPKjw0wWVQfi733qozTE8Md2W5r06oK';


	$dados = array();
	$dados['referencia'] = 'PZA34484';
	$dados['chave_checkout'] = $_POST['chave_checkout'];

	$dados['meio_pagamento'] = $_POST['meio_pagamento'];


    $dados['nome'] = $_POST['nome'];
    $dados['email'] = $_POST['email'];
    $dados['cep'] = $_POST['cep'];
    $dados['cnpj_cpf'] = $_POST['cnpj_cpf'];
    $dados['quantidade'] = 1;

    $dados['NameOnCard'] = $_POST['NameOnCard'];
    $dados['CreditCardNumber'] = $_POST['CreditCardNumber'];
    $dados['ExpiryDate_month'] = $_POST['ExpiryDate_month'];
    $dados['ExpiryDate_year'] = $_POST['ExpiryDate_year'];
    $dados['SecurityCode'] = $_POST['SecurityCode'];
    $dados['bandCartao'] = $_POST['bandCartao'];
    $dados['parcelamento'] = $_POST['parcelamento'];
            
    $header = array();
    $header[] = 'Content-Type: application/json';
    $header[] = 'Api-Key: ' . $key ; 
    
  
	$data_string = json_encode($dados);
	$header[] = 'Content-Length: ' . strlen($data_string);


    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, POST);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);  
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);

    curl_close($ch);

    echo $result;

    // $r =  json_decode($result,true);